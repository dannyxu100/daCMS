var g_nid = "";

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
	var zTree = $.fn.zTree.getZTreeObj("treenavtype");
	zTree.selectNode(treeNode);
	return true; //confirm("进入【" + treeNode.name + "】的编辑状态吗？");
}
function beforeRemove(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treenavtype");
	zTree.selectNode(treeNode);
	
	confirm("确认删除导航【" + treeNode.name + "】吗？",
	function(){
		da.runDB("/sys_admin/module/nav/action/nav_get_list.php",{			//检查是否拥有下级节点
			npid: treeNode.id
		},
		function(res){
			if('FALSE'==res){
				da.runDB("/sys_admin/module/nav/action/nav_delete_item.php",{
					nid: treeNode.id
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
		var zTree = $.fn.zTree.getZTreeObj("treenavtype");
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
		var zTree = $.fn.zTree.getZTreeObj("treenavtype");

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


/**上传略缩图
*/
function uploadimg(){
	if( "" == g_nid ){
		alert("对不起，没有指定某一栏目");
		return;
	}

	var newfolder = "/uploads/nav/"+ new Date().format("yyyymmdd") + "/";

	fn_uploadfile("允许上传文件类型：gif、jpg、png", {
        "fileTypeDesc": "图片文件",
		// "multi": true,
		"fileTypeExts": "*.gif; *.jpg; *.png",
		"formData": {
			"folder": newfolder
		}
	},function( files, res ){
		for( var k in files ){
			url = newfolder + res[files[k].name];
		}
		
		da.runDB("/sys_admin/module/nav/action/nav_update_img.php",{
			n_id: g_nid,
			n_img: url
			
		},function( res ){
			if("FALSE"!= res){
				da("#n_img").val( url );
				var viewobj = da("#n_img_view");
				viewobj.attr("src", url?url:"/images/no_img.gif");
				viewobj.dom[0].src = url?url:"/images/no_img.gif";
				
			}
			else{
				alert("对不起，操作失败。");
			}
		});
	});
}

/**上传相册
*/
function uploadpicture(){
	if( "" == g_nid ){
		alert("对不起，没有指定某一栏目");
		return;
	}

	var newfolder = "/uploads/picture/"+ new Date().format("yyyymmdd") + "/";

	fn_uploadfile("允许上传文件类型：gif、jpg、png", {
        "fileTypeDesc": "图片文件",
		"multi": true,
		"fileTypeExts": "*.gif; *.jpg; *.png",
		"formData": {
			"folder": newfolder
		}
	},function( files, res ){
		var newfile="", urls = [], names=[];
		
		for( var k in files ){
			newfile = res[files[k].name];
			urls.push( newfolder + newfile );
			names.push( newfile );
		}
		
		da.runDB("/sys_admin/module/picture/action/picture_add_list.php",{
			type: "NAV",
			cid: g_nid,
			urls: urls.join("□"),
			names: names.join("□")
		},function( res ){
			if("FALSE"!= res){
				loadpicture();
			}
			else{
				alert("对不起，操作失败。");
			}
		});
	});
}

/**删除相册
*/
function deletepic( pid ){
	confirm("您确定要删除吗？", function(){
		da.runDB("/sys_admin/module/picture/action/picture_delete_item.php", {
			dataType: "json",
			p_id: pid
			
		},function(res){
			if("FALSE"!= res){
				loadpicture();
			}
			else{
				alert("对不起，操作失败。");
			}
			
		},function(code,msg,ex){
			// debugger;
		});
	});
}

/**修改相册信息
*/
function updatepic( pid ){
	var data = {
		dataType: "json",
		p_type: "NAV", 
		p_id: pid
	};

	da("input,textarea", "#picitem_"+pid ).each(function( idx, obj ){
		data[ obj.name ] = obj.value
	});
	
	da.runDB("/sys_admin/module/picture/action/picture_update_item.php", data,
	function(res){
		if("FALSE"!= res){
			alert("修改成功。");
			loadpicture();
		}
		else{
			alert("对不起，操作失败。");
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**加载相册
*/
function loadpicture(){
	var viewpad = da("#n_picture_view");
	viewpad.empty();
	
	da.runDB("/sys_admin/module/picture/action/picture_get_list.php",{
		dataType: "json",
		type: "NAV", 
		cid: g_nid
		
	},function(data){
		if("FALSE"!= data){
			var strHTML = [];
			
			for(var i=0; i<data.length; i++){
				strHTML.push('<div class="picitem">'
								+'<a href="'+ data[i].p_url +'" target="_blank"><img src="'+ data[i].p_url +'"/></a>'
								+'<div id="picitem_'+ data[i].p_id +'" class="inputs">'
									+'标题: <input type="text" name="p_name" value="'+ data[i].p_name +'"/><br/>'
									+'图片: <input type="text" name="p_url" value="'+ data[i].p_url +'" disabled="disabled"/><br/>'
									+'链接: <input type="text" name="p_href" value="'+ data[i].p_href +'" /><br/>'
									+'简介: <textarea name="p_text" >'+ data[i].p_text +'</textarea><br/>'
								+'</div>'
								+'<div class="tools">'
									+'<a class="bt_link" href="javascript:void(0)" onclick="updatepic('+ data[i].p_id +')" ><img src="/images/sys_icon/save.png" /> 保存</a>'
									+'<a class="bt_link" href="javascript:void(0)" onclick="deletepic('+ data[i].p_id +')" ><img src="/images/sys_icon/delete.png" /> 删除</a>'
								+'</div>'
								+'<div style="clear:both; "></div>'
							+'</div>');
			}
			viewpad.html(strHTML.join(""));
			
			autoframeheight();
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}


/**加载导航基本信息
*/
function loadinfo(){
	da.runDB("/sys_admin/module/nav/action/nav_get_list.php",{
		dataType: "json",
		nid: g_nid
	},
	function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
			
			var radioobj = da("input[name=n_urltarget][value="+ res[0]["n_urltarget"] +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			var viewobj = da("#n_img_view");
			viewobj.attr("src", res[0].n_img?res[0].n_img:"/images/no_img.gif");
			viewobj.dom[0].src = res[0].n_img?res[0].n_img:"/images/no_img.gif";
			
			autoframeheight();
		}
	});
}

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_nid = treeNode.id;

	loadinfo();
	loadpicture();
}

/** 修改导航信息
*/
function updatenav(){
	da.runDB("/sys_admin/module/nav/action/nav_update_item.php",{
		nid: da("#n_id").val(),
		nname: da("#n_name").val(),
		nenname: da("#n_enname").val(),
		nlevel: da("#n_level").val(),
		nsort: da("#n_sort").val(),
		nurl: da("#n_url").val(),
		nurltarget: da("[name=n_urltarget]:checked").val(),
		nimg: da("#n_img").val(),
		nremark: da("#n_remark").val()
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

/**添加一级导航
*/
function addrootnav(){
	var zTree = $.fn.zTree.getZTreeObj("treenavtype");
	
	da.runDB("/sys_admin/module/nav/action/nav_add_item.php",{
		pid: 0,
		level: 1,
		name: "新建导航"
	},
	function(res){
		if("FALSE"!=res){
			zTree.addNodes(null, {id:res, pId:0, name:"新建导航", navlevel:1});
		}
	});
}

/*加载左边导航树*/
function loadtree(){
	da.runDB("/sys_admin/module/nav/action/nav_get_list.php",{
		dataType: "json",
	},
	function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].n_id,
				pId: data[i].n_pid,
				name: data[i].n_name,
				navlevel: data[i].n_level,
				open: true
			});
		}
		
		$.fn.zTree.init($("#treenavtype"), setting, zNodes);
		
	});
}

daLoader("daMsg,daTab,daTable,daWin,daIframe", function(){
	//daUI();
	
	/*页面加载完毕*/
	da(function(){
		loadtree();
	});
});
