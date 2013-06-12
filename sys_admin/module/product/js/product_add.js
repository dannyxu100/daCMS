var g_ptid = "";

/**设置标签
*/
function updatetag(){
	daWin({
		width: 400,
		height: 500,
		title: "设置标签",
		url: "/sys_admin/module/tag/tag_manage.php?ismulti=true&type=ARTICLE",
		back: function( data ){
			var tids = [];
			
			for( var k in data){
				tids.push(k);
			}
			
/* 			da.runDB("/sys_admin/module/article/action/article2tag_add_list.php",{
				tagtype: "ARTICLE",
				aids: g_aid,
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
			}); */
			
		}
	});
}

function saveproduct(){
	// 将编辑器的HTML数据同步到textarea
	g_editor.sync();
	
	if( "" == g_ptid ){
		alert("对不起，没有指定分类");
		return;
	}

	if( !daValid.all() ){
		alert("对不起，请仔细查看，是否有未填写的必填项。");
		return;
	}
	
	var data = {
		dataType: "json",
		p_ptid: g_ptid
	};

	da("input:text,textarea").each(function(idx, obj){
		data[obj.id] = da(obj).val();
	});
	data["p_status"] = da("input[name=p_status]:checked").val();
	
	da.runDB("/sys_admin/module/product/action/product_add_item.php", data,
	function(res){
		if("FALSE" != res){
			alert("添加成功。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex,aa){
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
		g_ptid = arrParam["ptid"];
	
		loadeditor();
		loadtab();
		
		autoframeheight();
	});
});
