
var g_dir,
	g_filename,
	g_filetype,
	g_codemirror;

	
function savefile(){
	//同步编辑器和textarea的内容;
	g_codemirror.save();
	
	loading(true);
	da.runDB("/sys_admin/module/file/action/file_update_item.php",{
		dir: g_dir,
		filename: g_filename,
		filetype: g_filetype,
		content: encodeURIComponent(da("#codearea").val())
		
	},function(res){
		if("FALSE" != res){
			alert("修改成功");
		}
		else{
			alert("对不起，操作失败");
		}
		loading(false);
		
	},function(code,msg,ex){
		// debugger;
	});
}

var g_mode = {
		sql: "text/x-sql",
		htm: "htmlmixed",
		html: "htmlmixed",
		xml: "xml",
		php: "application/x-httpd-php",
		js: "javascript",
		css: "text/css"
	};
	
/**加载文件列表
*/
function loadfile(){
	loading(true);
	da.runDB("/sys_admin/module/file/action/file_get_item.php",{
		dir: g_dir,
		filename: g_filename,
		filetype: g_filetype
		
	},function(data){
		if("FALSE"!= data){
			da("#codearea").val(data);
			g_codemirror = CodeMirror.fromTextArea(da("#codearea").dom[0], {
				lineNumbers: true,
				lineWrapping: true,
				// theme: "ambiance",
				mode: g_mode[g_filetype]
			});

			autoframeheight();
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daTable,daWin,daIframe", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParam = da.urlParams();
		g_dir = arrParam["dir"];
		g_filename = arrParam["filename"];
		g_filetype = arrParam["filetype"];
		
		da("#filepath").val(decodeURIComponent(g_dir) +"\\"+ decodeURIComponent(g_filename));
		
		loadfile();
	});
});
