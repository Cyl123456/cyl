<?php /*a:3:{s:71:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\user\tupu.html";i:1555927819;s:74:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_meta.html";i:1530598598;s:76:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_footer.html";i:1530598598;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/page.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/style.css" />
<style>
	.table-bg thead th {
	     background-color:rgba(255,255,255,0); 
	}
	.bg-1 {
	    background-color:rgba(255,255,255,0);
	}
</style>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<link rel="stylesheet" href="/static/ztree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<title></title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>团队管理 <span class="c-gray en">&gt;</span> 团队管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
	 <form class="Huiform">
      <input type="text" class="input-text" style="width:200px" placeholder="会员编号/手机号码/用户姓名" id="" name="us_account" value="">
  		<input type="text" hidden="hidden" class="ptel" value="">
      <button type="button" class="btn btn-success radius search" ><i class="Hui-iconfont">&#xe665;</i>搜索</button>
  		<button type="button" onclick="fff()"  class="btn btn-success radius" ><i class="Hui-iconfont">&#xe6db;</i> 返回上级</button>
      <button type="button" class="btn btn-success radius jiedian" ><i class="Hui-iconfont">&#xe6db;</i> 返回节点人</button>
		</form>
	</div>
	<div class="mt-20">
		<div class="tuandui_wrap">
            <div class="box-body table-responsive ztt" style="overflow-x: scroll;">
                    <div  id="myDiagramDiv" style="height:400px; background-color: #DAE4E4;"></div>
            </div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script>
	var aa = "<?php echo htmlentities(app('request')->controller()); ?>";
	var bb = "<?php echo htmlentities(app('request')->action()); ?>";
	// console.log(aa+"/"+bb);
</script>

<!--请在下方写此页面业务相关的脚本-->
<script src="/static/mine/gojs/go-debug.js"></script>
<script>
  window.onload=function (){
    $('.jiedian').click(function(){
      console.log(11);
      var a_acc = $('.ptel').val();
      console.log($('.ptel').val());
      
      if(!a_acc){
        layer.msg('节点人不存在');
        return;
      }
      eee(a_acc);
    });
     $('.search').click(function(){
      var acc = $('input[name="us_account"]').val();
      if(!acc){
        layer.msg('不能搜索空字符');
        return;
      }
      eee(acc);
    });



  }
  


  var account = "<?php echo htmlentities($us_account); ?>";
/*--------------------------------------------------新的----------------------------------------------------*/
 // function init() {
    // if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var A = go.GraphObject.make;  // for conciseness in defining templates

    var myDiagram =
      A(go.Diagram, "myDiagramDiv", // must be the ID or reference to div
        {
          initialContentAlignment: go.Spot.Center,
          maxSelectionCount: 1, // users can select only one part at a time
          validCycle: go.Diagram.CycleDestinationTree, // make sure users can only create trees
          "clickCreatingTool.archetypeNodeData": {}, // allow double-click in background to create a new node
          "clickCreatingTool.insertPart": function(loc) {  // customize the data for the new node
            this.archetypeNodeData = {
              key: getNextKey(), // assign the key based on the number of nodes
              name: "(new person)",
              title: ""
            };
            return go.ClickCreatingTool.prototype.insertPart.call(this, loc);
          },
          layout:
            A(go.TreeLayout,
              {
                treeStyle: go.TreeLayout.StyleLastParents,
                arrangement: go.TreeLayout.ArrangementHorizontal,
                // properties for most of the tree:
                angle: 90,
                layerSpacing: 35,
                // properties for the "last parents":
                alternateAngle: 90,
                alternateLayerSpacing: 35,
                alternateAlignment: go.TreeLayout.AlignmentBus,
                alternateNodeSpacing: 20
              }),
          "undoManager.isEnabled": true // enable undo & redo
        });

    // when the document is modified, add a "*" to the title and enable the "Save" button
    myDiagram.addDiagramListener("Modified", function(e) {
      var button = document.getElementById("SaveButton");
      if (button) button.disabled = !myDiagram.isModified;
      var idx = document.title.indexOf("*");
      if (myDiagram.isModified) {
        if (idx < 0) document.title += "*";
      } else {
        if (idx >= 0) document.title = document.title.substr(0, idx);
      }
    });

    // manage boss info manually when a node or link is deleted from the diagram
    myDiagram.addDiagramListener("SelectionDeleting", function(e) {
      var part = e.subject.first(); // e.subject is the myDiagram.selection collection,
                                    // so we'll get the first since we know we only have one selection
      myDiagram.startTransaction("clear boss");
      if (part instanceof go.Node) {
        var it = part.findTreeChildrenNodes(); // find all child nodes
        while(it.next()) { // now iterate through them and clear out the boss information
          var child = it.value;
          var bossText = child.findObject("boss"); // since the boss TextBlock is named, we can access it by name
          if (bossText === null) return;
          bossText.text = "";
        }
      } else if (part instanceof go.Link) {
        var child = part.toNode;
        var bossText = child.findObject("boss"); // since the boss TextBlock is named, we can access it by name
        if (bossText === null) return;
        bossText.text = "";
      }
      myDiagram.commitTransaction("clear boss");
    });

    var levelColors = ["#AC193D", "#2672EC", "#8C0095", "#5133AB",
                       "#008299", "#D24726", "#008A00", "#094AB2"];

    // override TreeLayout.commitNodes to also modify the background brush based on the tree depth level
    myDiagram.layout.commitNodes = function() {
      go.TreeLayout.prototype.commitNodes.call(myDiagram.layout);  // do the standard behavior
      // then go through all of the vertexes and set their corresponding node's Shape.fill
      // to a brush dependent on the TreeVertex.level value
      myDiagram.layout.network.vertexes.each(function(v) {
        if (v.node) {
          var level = v.level % (levelColors.length);
          var color = levelColors[level];
          var shape = v.node.findObject("SHAPE");
          if (shape) shape.fill = A(go.Brush, "Linear", { 0: color, 1: go.Brush.lightenBy(color, 0.05), start: go.Spot.Left, end: go.Spot.Right });
        }
      });
    };

    // This function is used to find a suitable ID when modifying/creating nodes.
    // We used the counter combined with findNodeDataForKey to ensure uniqueness.
    function getNextKey() {
      var key = nodeIdCounter;
      while (myDiagram.model.findNodeDataForKey(key) !== null) {
        key = nodeIdCounter--;
      }
      return key;
    }

    var nodeIdCounter = -1; // use a sequence to guarantee key uniqueness as we add/remove/modify nodes

    // when a node is double-clicked, add a child to it
    function nodeDoubleClick(e, obj) {
      var clicked = obj.part;
      if (clicked !== null) {
        var thisemp = clicked.data;
        myDiagram.startTransaction("add employee");
        var newemp = { key: getNextKey(), name: "(new person)", title: "", parent: thisemp.key };
        myDiagram.model.addNodeData(newemp);
        myDiagram.commitTransaction("add employee");
      }
    }

    // this is used to determine feedback during drags
    function mayWorkFor(node1, node2) {
      if (!(node1 instanceof go.Node)) return false;  // must be a Node
      if (node1 === node2) return false;  // cannot work for yourself
      if (node2.isInTreeOf(node1)) return false;  // cannot work for someone who works for you
      return true;
    }

    // This function provides a common style for most of the TextBlocks.
    // Some of these values may be overridden in a particular TextBlock.
    function textStyle() {
      return { font: "9pt  Segoe UI,sans-serif", stroke: "white" };
    }

    // define the Node template
    myDiagram.nodeTemplate =
      A(go.Node, "Auto",
        // for sorting, have the Node.text be the data.name
        new go.Binding("text", "name"),
        // bind the Part.layerName to control the Node's layer depending on whether it isSelected
        new go.Binding("layerName", "isSelected", function(sel) { return sel ? "Foreground" : ""; }).ofObject(),
        // define the node's outer shape
        A(go.Shape, "Rectangle",
          {
            name: "SHAPE", fill: "white", stroke: null,
            // set the port properties:
            portId: "", fromLinkable: true, toLinkable: true, cursor: "pointer"
          }),
        A(go.Panel, "Horizontal",
          A(go.Picture,
            { 
              name: "Picture",
              desiredSize: new go.Size(39, 50),
              margin: new go.Margin(6, 8, 6, 10),
              // background: "red" 
            },
            new go.Binding("source")),
         
          A(go.Panel, "Table",
            {
              maxSize: new go.Size(200, 999),
              margin: new go.Margin(6, 10, 0, 3),
              defaultAlignment: go.Spot.Left
            },
            A(go.RowColumnDefinition, { column: 2, width: 4 }),
            A(go.TextBlock, textStyle(),  // the name
              {
                row: 0, column: 0, columnSpan: 5,
                font: "12pt Segoe UI,sans-serif",
                editable: true, isMultiline: false,
                minSize: new go.Size(10, 16)
              },
              new go.Binding("text", "name").makeTwoWay()),
            A(go.RowColumnDefinition, { column: 2, width: 4 }),
            A(go.TextBlock, textStyle(),  // the name
              {
                row: 1, column: 0, columnSpan: 5,
                font: "12pt Segoe UI,sans-serif",
                editable: true, isMultiline: false,
                minSize: new go.Size(10, 16)
              },
              new go.Binding("text", "tel").makeTwoWay()),
            A(go.RowColumnDefinition, { column: 2, width: 4 }),
            A(go.TextBlock, textStyle(),  // the name
              {
                row: 2, column: 0, columnSpan: 5,
                font: "12pt Segoe UI,sans-serif",
                editable: true, isMultiline: false,
                minSize: new go.Size(10, 16)
              },
              new go.Binding("text", "zuo").makeTwoWay()),
            A(go.RowColumnDefinition, { column: 2, width: 4 }),
            A(go.TextBlock, textStyle(),  // the name
              {
                row: 3, column: 0, columnSpan: 5,
                font: "12pt Segoe UI,sans-serif",
                editable: true, isMultiline: false,
                minSize: new go.Size(10, 16)
              },
              new go.Binding("text", "you").makeTwoWay()),
            A(go.RowColumnDefinition, { column: 2, width: 4 }),
            A(go.TextBlock, textStyle(),  // the name
              {
                row: 4, column: 0, columnSpan: 5,
                font: "12pt Segoe UI,sans-serif",
                editable: true, isMultiline: false,
                minSize: new go.Size(10, 16)
              },
              new go.Binding("text", "level").makeTwoWay()),
         
            A(go.TextBlock, textStyle(),  // the comments
              {
                row: 4, column: 0, columnSpan: 5,
                font: "italic 9pt sans-serif",
                wrap: go.TextBlock.WrapFit,
                editable: true,  // by default newlines are allowed
                minSize: new go.Size(10, 14)
              },
              new go.Binding("text", "comments").makeTwoWay())
          )  // end Table Panel
        ) // end Horizontal Panel
      );  // end Node
    // define the Link template
    myDiagram.linkTemplate =
      A(go.Link, go.Link.Orthogonal,
        { corner: 5, relinkableFrom: true, relinkableTo: true },
        A(go.Shape, { strokeWidth: 4, stroke: "#00a4a4" }));  // the link shape

    if (window.Inspector) myInspector = new Inspector("myInspector", myDiagram,
      {
        properties: {
          "key": { readOnly: true },
          "comments": {}
        }
      });
  var array = [];
  var  bbb;
  function eee(us_account){

    array.push(us_account);
    $.ajax({
        type: "post",
        async: false,
        dataType : "json",
        url : "tupu",
        data:{us_account:us_account},
        success : function(data){
          console.log(data);
           if(data.code){
              var clas = {
                  "class": "go.TreeModel",
                  "nodeDataArray":data.data,
              };
              $('.ptel').val(data.ptel);
              bbb = data.data;
              myDiagram.model = go.Model.fromJson(clas);
           }else{
              layer.msg(data.msg);
           }
            
        }           
    });
    return false;
}
function fff(){
  array.pop();
  var us_account = array[array.length-1];
  if(!us_account){
    us_account = account;
  }
  $.ajax({
        type: "post",
        async: false,
        dataType : "json",
        url : "tupu",
        data:{us_account:us_account},
        success : function(data){
            if(data.code){
              var clas = {
                  "class": "go.TreeModel",
                  "nodeDataArray":data.data,
              };
              $('input[name="ptel"]').val(data.ptel);
              bbb = data.data;
              myDiagram.model = go.Model.fromJson(clas);
           }else{
              layer.msg(data.msg);
           }
        }           
    });
    return false;
}
eee(account);




  myDiagram.addDiagramListener("ObjectSingleClicked", function(e) {

    var k = e.subject.part.data.parent; //父位置    

    var key = e.subject.part.data.key; //当前位置
    var qu = 0;

    if(key==2 ||key==4 || key==6){
      qu = 1;
    }

    var us_account = e.subject.part.data.name 
    if(us_account && us_account!="未注册"){
       eee(us_account);
       return;
    }

    var kk = bbb[k].k; 
    if(!kk){
      layer.msg('请先添加节点人');return;
    }

    layer.msg('添加用户')
    setTimeout(function(){
        var url = "<?php echo url('add'); ?>?qu="+qu+"&us_aid="+kk;
        creatIframe(url,'添加用户');
    },500)
      
  });

</script> 
</body>
</html>