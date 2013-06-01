var g_aid = "";

function savearticle(){
	// 将编辑器的HTML数据同步到textarea
	g_editor.sync();

	if( "" == g_aid ){
		alert("对不起，没有指定分类");
		return;
	}

	if( !daValid.all() ){
		return;
	}
	
	da.runDB("/sys_article/action/article_update_item.php",{
		dataType: "json",
		aid: g_aid,
		atitle: da("#a_title").val(),
		atitle2: da("#a_title2").val(),
		asort: da("#a_sort").val(),
		acount: da("#a_count").val(),
		akeywords: da("#a_keywords").val(),
		adescription: da("#a_description").val(),
		aimg: da("#a_img").val(),
		acontent: encodeURIComponent(da("#a_content").val())
		
	},function(data){
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex){
		// debugger;
	});
}

/**加载信息
*/
function loadinfo(){
	if( "" == g_aid ){
		alert("对不起，没有指定分类");
		return;
	}

	loading(true);
	da.runDB("/sys_article/action/article_get_item.php",{
		dataType: "json",
		aid: g_aid
		
	},function(data){
		if("FALSE"!= data){
			for(var fld in data){
				da("#"+fld).val(data[fld]);
			}
			
			da("#a_img_view").attr("src", data.a_img);
			g_editor.html(data.a_content);
			
			autoframeheight();
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	g_editor = KindEditor.create('#a_content', {
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

daLoader("daMsg,daWin,daIframe,daValid", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParam = da.urlParams();
		g_aid = arrParam["aid"];
	
		loadeditor();
		loadinfo();
		
		autoframeheight();
	});
});
