var g_atid = "";

/**选中全部
*/
function checkall( obj ){
	if( da(obj).is(":checked") ){
		da("[name=chkitem]").attr("checked", "checked");
	}
	else{
		da("[name=chkitem]").removeAttr("checked");
	}
}

var setting = {
	view: {
		addHoverDom: addHoverDom,
		removeHoverDom: removeHoverDom,
		selectedMulti: false
	},
	edit: {
		enable: true,
		editNameSelectAll: true
	},
	data: {
		simpleData: {
			enable: true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: 0
		}
	},
	callback: {
		// beforeDrag: beforeDrag,
		beforeMouseUp: clicknode,
		beforeEditName: beforeEditName,
		beforeRemove: beforeRemove,
		beforeRename: beforeRename
	}
};

function beforeEditName(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treearticletype");
	zTree.selectNode(treeNode);
	return true; //confirm("进入【" + treeNode.name + "】的编辑状态吗？");
}
function beforeRemove(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treearticletype");
	zTree.selectNode(treeNode);
	
	confirm("确认删除分类【" + treeNode.name + "】吗？",
	function(){
		da.runDB("/sys_admin/module/article/action/articletype_get_list.php",{			//检查是否拥有下级节点
			atpid: treeNode.id
		},
		function(res){
			if('FALSE'==res){
				da.runDB("/sys_admin/module/article/action/articletype_delete_item.php",{
					atid: treeNode.id
				},
				function(res){
					if("FALSE"==res){
						alert("操作失败");
						loadtree();
					}
				});
			}
			else{
				alert("对不起，【" + treeNode.name + "】拥有子节点，请先删除子节点。");
				loadtree();
			}
		});
	
		return true;
	},
	function(){
		return false;
	});
}

function beforeRename(treeId, treeNode, newName) {
	if (newName.length == 0) {
		alert("名称不能为空.");
		var zTree = $.fn.zTree.getZTreeObj("treearticletype");
		zTree.editName(treeNode)
		// setTimeout(function(){zTree.editName(treeNode)}, 10);
		return false;
	}
	else{
		da.runDB("/sys_admin/module/nav/action/nav_update_item.php",{
			nid: treeNode.id,
			nname: newName
		},
		function(res){
			if(res=="FALSE"){
				alert("对不起，修改失败。");
			}
			else{
				alert("修改成功。");
			}
			loadtree();
		});
	}
	return true;
}

/*点击添加节点*/
function addHoverDom(treeId, treeNode) {
	var sObj = $("#" + treeNode.tId + "_span");
	if (treeNode.editNameFlag || $("#addBtn_"+treeNode.id).length>0) return;
	var addStr = "<span class='button add' id='addBtn_" + treeNode.id
		+ "' title='add node' onfocus='this.blur();'></span>";
	sObj.after(addStr);
	
	var btn = $("#addBtn_"+treeNode.id);				//"添加按钮" click事件
	if (btn) btn.bind("click", function(){
		var zTree = $.fn.zTree.getZTreeObj("treearticletype");

		da.runDB("/sys_admin/module/nav/action/nav_add_item.php",{
			pid: treeNode.id,
			level: treeNode.navlevel+1,
			name: "新建导航"
		},
		function(res){
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建分类", navlevel:treeNode.navlevel+1});
			}
		});
		
		return false;
	});
};
/*移除节点*/
function removeHoverDom(treeId, treeNode) {
	$("#addBtn_"+treeNode.id).unbind().remove();
};

/**加载列表
*/
function loadlist(){
	var data1 = {
			dataType: "json",
			opt: "qry",
			atid: g_atid
		};

	daTable({
		id: "tb_list",
		url: "/sys_admin/module/article/action/article_get_page.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("a_title"==fld){
				val = (row.a_img?'<img class="crtimg" src="/images/sys_icon/img.png" src2="'+ row.a_img +'" style="vertical-align:middle;"/> ' 
				: '<img class="crtimg" src="/images/sys_icon/img2.png" src2="" style="vertical-align:middle;"/> ')
				+ '<a href="javascript:void(0)" onclick="updatearticle('+row.a_id+')" title="'+ row.a_description +'" >'+val+'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			da(".crtimg").live("mouseover",function( event ){
				var src2 = da(this).attr("src2");
				if( ""==src2 ) return;
			
				var imgtip = '<div id="imgtip" style="display:none; position:absolute; border:1px solid #009900; background:#fff; padding:2px; "><img src="'
				+ da(this).attr("src2") 
				+'" alt="预览图"/></div>'; //创建 容器元素
				
				da("body").append(imgtip);	//把它追加到文档中

				da("#imgtip").css({
					"top": (event.pageY + 10) + "px",
					"left":  (event.pageX + 10) + "px"
				}).show("50");	  				//设置x坐标和y坐标，并且显示
			
			}).live("mousemove",function( event ){
				$("#imgtip").css({
					"top": (event.pageY+10) + "px",
					"left":  (event.pageX+10) + "px"
				});
				
			});
			da(".crtimg").live("mouseout",function( event ){
				da("#imgtip").remove();	 //移除 
				
			});
			
			autoframeheight();
		}
	}).load();

}

/**加载分类基本信息
*/
function loadinfo(){
	da.runDB("/sys_admin/module/article/action/articletype_get_list.php",{
		dataType: "json",
		atid: g_atid
	},
	function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
			
			da("#at_img_view").attr("src",res[0].at_img);
		}
	});
}

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_atid = treeNode.id;

	loadinfo();
	loadlist();
}


/**修改文章
*/
function updatearticle( aid ){
	goto("/sys_admin/module/article/article_update.php?aid="+ aid);
}

/** 修改分类信息
*/
function updatetype(){
	da.runDB("/sys_admin/module/article/action/articletype_update_item.php",{
		atid: da("#at_id").val(),
		atname: da("#at_name").val(),
		atsort: da("#at_sort").val(),
		atimg: da("#at_img").val(),
		atkeywords: da("#at_keywords").val(),
		atdescription: da("#at_description").val(),
		atremark: da("#at_remark").val()
	},
	function(res){
		if(res=="FALSE"){
			alert("对不起，修改失败。");
		}
		else{
			alert("修改成功。");
		}
		loadtree();
	});
}

/**添加文章
*/
function addarticle(){
	if( "" == g_atid){
		alert("请先选择一个分类");
		return;
	}

	goto("/sys_admin/module/article/article_add.php?atid="+ g_atid);
}

/**添加一级分类
*/
function addroottype(){
	var zTree = $.fn.zTree.getZTreeObj("treearticletype");
	
	da.runDB("/sys_admin/module/article/action/articletype_add_item.php",{
		pid: 0,
		name: "新建分类"
	},
	function(res){
		if("FALSE"!=res){
			zTree.addNodes(null, {id:res, pId:0, name:"新建分类"});
		}
	});
}

/*加载左边分类树*/
function loadtree(){
	da.runDB("/sys_admin/module/article/action/articletype_get_list.php",{
		dataType: "json",
	},
	function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].at_id,
				pId: data[i].at_pid,
				name: data[i].at_name,
				open: true
			});
		}
		
		$.fn.zTree.init($("#treearticletype"), setting, zNodes);
		
	});
}


/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","分类信息","/images/menu_icon/menu.png",{
		click:function(){
			da("#pad_list").hide();
			da("#pad_info").show();
		}
	});

	daTab0.appendItem("item02","文章列表","/images/sys_icon/tables.png",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").show();
		}
	});
	
	daTab0.click("item02");
}

daLoader("daMsg,daTab,daTable,daWin,daIframe", function(){
	/*页面加载完毕*/
	da(function(){
		loadtab();
		loadtree();
	});
});
