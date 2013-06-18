var g_pid = "";


function saveproduct(){
	// 将编辑器的HTML数据同步到textarea
	g_editor.sync();
	
	if( "" == g_pid ){
		alert("对不起，没有指定商品");
		return;
	}

	if( !daValid.all() ){
		alert("对不起，请仔细查看，是否有未填写的必填项。");
		return;
	}
	
	var data = {
		dataType: "json",
		p_id: g_pid
	};

	da("input:text,textarea").each(function(idx, obj){
		data[obj.id] = da(obj).val();
	});
	data["p_status"] = da("input[name=p_status]:checked").val();
	
	da.runDB("/sys_admin/module/product/action/product_update_item.php", data,
	function(res){
		if("FALSE" != res){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex,aa){
		// debugger;
	});
}

/**取消标签
*/
function canceltag( tid ){
	da.runDB("/sys_admin/module/tag/action/tagmap_delete_item.php",{
		type: "product", 
		tid: tid,
		id: g_pid
		
	},function(res){
		if(res=="FALSE"){
			alert("对不起，操作失败。");
		}
		else{
			alert("取消标签成功。");
			loadtag();
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**设置标签
*/
function updatetag(){
	daWin({
		width: 400,
		height: 500,
		title: "设置标签",
		url: "/sys_admin/module/tag/tag_manage.php?ismulti=true&type=PRODUCT",
		back: function( data ){
			var tids = [];
			
			for( var k in data){
				tids.push(k);
			}
			
			da.runDB("/sys_admin/module/tag/action/tagmap_add_list.php",{
				type: "PRODUCT",
				ids: g_pid,
				tids: tids.join(",")
			},
			function(res){
				if(res=="FALSE"){
					alert("对不起，标注失败。");
				}
				else{
					alert("标注成功。");
					loadtag();
				}
			});
			
		}
	});
}


/**上传略缩图
*/
function uploadimg(){
	if( "" == g_pid ){
		alert("对不起，没有指定某一商品");
		return;
	}

	var newfolder = "/uploads/product/"+ new Date().format("yyyymmdd") + "/";

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
		
		da.runDB("/sys_admin/module/product/action/product_update_img.php",{
			p_id: g_pid,
			p_img: url
			
		},function( res ){
			if("FALSE"!= res){
				da("#p_img").val( url );
				var viewobj = da("#p_img_view");
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
	if( "" == g_pid ){
		alert("对不起，没有指定某一商品");
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
			type: "PRODUCT",
			cid: g_pid,
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
		p_type: "PRODUCT", 
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
	var viewpad = da("#p_picture_view");
	viewpad.empty();
	
	da.runDB("/sys_admin/module/picture/action/picture_get_list.php",{
		dataType: "json",
		type: "PRODUCT", 
		cid: g_pid
		
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

/**加载标签
*/
function loadtag(){
	da.runDB("/sys_admin/module/tag/action/tagmap_get_list.php",{
		dataType: "json",
		type: "PRODUCT", 
		id: g_pid
		
	},function(data){
		if("FALSE"!= data){
			var strHTML = "";
				tagpad = da("#tagpad");
			
			tagpad.empty();
			for(var i=0; i<data.length; i++){
				strHTML += '<div class="tagitem" style="border-color:#'+ data[i].t_color +'" ondblclick="canceltag('+ data[i].t_id +')">'+ data[i].t_name +'</div>';
			}
			tagpad.html(strHTML);
			
			autoframeheight();
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**加载信息
*/
function loadinfo(){
	if( "" == g_pid ){
		alert("对不起，没有指定分类");
		return;
	}

	loading(true);
	da.runDB("/sys_admin/module/product/action/product_get_item.php",{
		dataType: "json",
		pid: g_pid
		
	},function(data){
		if("FALSE"!= data){
			for(var fld in data){
				da("#"+fld).val(data[fld]);
			}
			
			var radioobj = da("input[name=p_status][value="+ data.p_status +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			var viewobj = da("#p_img_view");
			viewobj.attr("src", data.p_img?data.p_img:"/images/no_img.gif");
			viewobj.dom[0].src = data.p_img?data.p_img:"/images/no_img.gif";

			g_editor.html(data.p_content);
			
			autoframeheight();
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","商品基本信息 »","/images/sys_icon/info.png",{
		click:function(){
			da("#pad_step1").show();
			da("#pad_step2").hide();
			da("#pad_step3").hide();
			da("#pad_step4").hide();
			da("#pad_step5").hide();
			
			autoframeheight();
		}
	});

	daTab0.appendItem("item02","商品属性 »","/images/sys_icon/tables.png",{
		click:function(){
			da("#pad_step1").hide();
			da("#pad_step2").show();
			da("#pad_step3").hide();
			da("#pad_step4").hide();
			da("#pad_step5").hide();
			
			autoframeheight();
		}
	});

	daTab0.appendItem("item03","图片展示 »","/images/sys_icon/img.png",{
		click:function(){
			da("#pad_step1").hide();
			da("#pad_step2").hide();
			da("#pad_step3").show();
			da("#pad_step4").hide();
			da("#pad_step5").hide();
			
			autoframeheight();
		}
	});
	
	daTab0.appendItem("item04","详细介绍 »","/images/sys_icon/content.png",{
		click:function(){
			da("#pad_step1").hide();
			da("#pad_step2").hide();
			da("#pad_step3").hide();
			da("#pad_step4").show();
			da("#pad_step5").hide();
			
			autoframeheight();
		}
	});
	
	daTab0.appendItem("item05","其他设置","/images/sys_icon/shape.png",{
		click:function(){
			da("#pad_step1").hide();
			da("#pad_step2").hide();
			da("#pad_step3").hide();
			da("#pad_step4").hide();
			da("#pad_step5").show();
			
			autoframeheight();
		}
	});
	daTab0.click("item01");
}

var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	g_editor = KindEditor.create('#p_content', {
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

daLoader("daMsg,daTab,daWin,daIframe,daValid", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParam = da.urlParams();
		g_pid = arrParam["pid"];
	
		loadeditor();
		loadtab();
		loadinfo();
		loadtag();
		loadpicture();
		
		autoframeheight();
	});
});
