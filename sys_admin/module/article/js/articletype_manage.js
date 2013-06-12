var g_atid = "";

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
		da.runDB("/sys_admin/module/article/action/articletype_update_item.php",{
			atid: treeNode.id,
			atname: newName
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

		da.runDB("/sys_admin/module/article/action/articletype_add_item.php",{
			pid: treeNode.id,
			level: treeNode.navlevel+1,
			name: "新建分类"
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

/**显示列表风格配置面板
*/
function showstylepad( obj ){
	da("#LINK_pad").hide();
	da("#SINGLEPAGE_pad").hide();
	
	da("#"+ obj.value +"_pad").fadeIn(500);
	autoframeheight();
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
			
			var radioobj = da("input[name=article_style][value="+ res[0]["at_style"] +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			showstylepad(radioobj.dom[0]);
			
			var viewobj = da("#at_img_view");
			viewobj.attr("src", res[0].at_img?res[0].at_img:"/images/no_img.gif");
			viewobj.dom[0].src = res[0].at_img?res[0].at_img:"/images/no_img.gif";
			
			g_editor.html(res[0].at_content);
		}
	});
}

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_atid = treeNode.id;

	loadinfo();
}


/** 修改分类信息
*/
function updatetype(){
	// 将编辑器的HTML数据同步到textarea
	g_editor.sync();
	
	da.runDB("/sys_admin/module/article/action/articletype_update_item.php",{
		atid: da("#at_id").val(),
		atname: da("#at_name").val(),
		atsort: da("#at_sort").val(),
		atlistnum: da("#at_listnum").val(),
		aturl: da("#at_url").val(),
		atcontent: encodeURIComponent(da("#at_content").val()),
		atimg: da("#at_img").val(),
		atstyle: da("[name=article_style]:checked").val(),
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
		dataType: "json"
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
			
			// da("#leftpad").show();
		}
	});

	daTab0.appendItem("item02","文章列表","/images/sys_icon/tables.png",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").show();
			
			// da("#leftpad").hide();
		}
	});
	
	daTab0.click("item01");
}

var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	g_editor = KindEditor.create('#at_content', {
		resizeType: 1,
		filterMode: false,		//不过滤危险标签
		newlineTag: "br",
		allowPreviewEmoticons : false,
		fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
		allowFileManager : true,
		items : [
			'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
			'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
			'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
			'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
			'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
			'anchor', 'link', 'unlink'
		]
	});
}

daLoader("daMsg,daTab,daTable,daWin,daIframe", function(){
	/*页面加载完毕*/
	da(function(){
		// loadtab();
		loadeditor();
		loadtree();
	});
});
