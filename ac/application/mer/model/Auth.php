<?php

namespace app\admin\model;

use think\Db;

class Auth
{

    //默认配置
    protected $_config = array(
        'AUTH_ON' => true, // 认证开关
        'ROLE' => 'new_role', // 用户组数据表名
        'RULE' => 'new_rule', // 权限规则表
        'USER' => 'new_admin', // 用户信息表
    );
    /**
     * 检查权限
     * @param name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
     * @param uid  int           认证用户的id
     * @param string mode        执行check的模式
     * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
     * @return boolean           通过验证返回true;失败返回false
     */
    public function check($name, $uid, $meth)
    {
        if (!$this->_config['AUTH_ON']) {
            return true;
        }
        // strtoupper($string);
        //检验当前访问规则在不在我们所有的检验规则中 如果不在 return true;
        $info = db('rule')->where('name', $name)->where('meth',$meth)->find()
        if (!$info) {
            return true;
        }
        $ro_id = db('admin')->where('id',$uid)->value('ro_id');
        $role_rule = db('role')->where('id',$ro_id)->value('rules');
        $array = explode(',',$role_rule);
        if(in_array($info['id'],$array)){
            return true;
        }
        return false;
        $authList = $this->getAuthList($uid); //获取用户需要验证的所有有效规则列表

        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') !== false) {
                $name = explode(',', $name);
            } else {
                $name = array($name);
            }
        }
        $list = array(); //保存验证通过的规则名
        if ($mode == 'url') {
            $REQUEST = unserialize(strtolower(serialize($_REQUEST)));
        }
        foreach ($authList as $auth) {
            $query = preg_replace('/^.+\?/U', '', $auth);
            if ($mode == 'url' && $query != $auth) {
                parse_str($query, $param); //解析规则中的param
                $intersect = array_intersect_assoc($REQUEST, $param);
                $auth = preg_replace('/\?.*$/U', '', $auth);
                if (in_array($auth, $name) && $intersect == $param) {
                    //如果节点相符且url参数满足
                    $list[] = $auth;
                }
            } else if (in_array($auth, $name)) {
                $list[] = $auth;
            }
        }
        if ($relation == 'or' and !empty($list)) {
            return true;
        }
        $diff = array_diff($name, $list);
        if ($relation == 'and' and empty($diff)) {
            return true;
        }
        return false;
    }

    /**
     * 根据用户id获取用户组,返回值为数组
     * @param  uid int     用户id
     * @return array       用户所属的用户组 array(
     *     array('uid'=>'用户id','group_id'=>'用户组id','title'=>'用户组名称','rules'=>'用户组拥有的规则id,多个,号隔开'),
     *     ...)
     */
    public function getGroups($uid)
    {
        static $groups = array();
        if (isset($groups[$uid])) {
            return $groups[$uid];
        }

        $role_id = Db::name('admin')->where('id', $uid)->value('role_id');
        $role = Db::name('adminRole')->where('id', $role_id)->find();
        $user_groups = [
            'uid' => $uid,
            'role_id' => $role_id,
            'title' => $role['title'],
            'rules' => $role['rules'],
        ];
        $groups[$uid] = $user_groups ?: array();
        return $groups[$uid];
    }

    /**
     * 获得权限列表
     * @param integer $uid  用户id
     * @param integer $type
     */
    protected function getAuthList($uid)
    {
        static $_authList = array(); //保存用户验证通过的权限列表
        $t = implode(',', (array) $type);
        db($this->_config['USER'])->where('id', $uid)->value('ro');

        //读取用户所属用户组
        $groups = $this->getGroups($uid);
        $ids = []; //保存用户所属用户组设置的所有权限规则id
        $ids = array_merge($ids, explode(',', trim($groups['rules'], ',')));
        $ids = array_unique($ids);
        if (empty($ids)) {
            $_authList[$uid . $t] = array();
            return array();
        }

        $map = array(
            'id' => array('in', $ids),
            'status' => 1,
        );
        //读取用户组所有权限规则
        $rules = Db::table($this->_config['AUTH_RULE'])->where($map)->field('condition,name')->select();

        //循环规则，判断结果。
        $authList = array(); //
        foreach ($rules as $rule) {
            if (!empty($rule['condition'])) {
                //根据condition进行验证
                $user = $this->getUserInfo($uid); //获取用户信息,一维数组

                $command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
                //dump($command);//debug
                @(eval('$condition=(' . $command . ');'));
                if ($condition) {
                    $authList[] = strtolower($rule['name']);
                }
            } else {
                //只要存在就记录
                $authList[] = strtolower($rule['name']);
            }
        }
        $_authList[$uid . $t] = $authList;
        if ($this->_config['AUTH_TYPE'] == 2) {
            //规则列表结果保存到session
            $_SESSION['_AUTH_LIST_' . $uid . $t] = $authList;
        }
        return array_unique($authList);
    }

}
