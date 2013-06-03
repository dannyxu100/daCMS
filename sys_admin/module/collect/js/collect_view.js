
var g_cid = "";

/**加载信息
*/
function loadinfo(){
	if( "" == g_cid ){
		alert("对不起，没有指定文章id");
		return;
	}
	
	loading(true);
	da.setForm( "#formlist", 
	"/sys_admin/module/collect/action/collect_get_item.php", {
		dataType: "json",
		cid: g_cid
		
	},function( fld, val, row, ds ){
		return val;
		
	},function( data ){
		//debugger;
		da("#formlist").show();
		loading(false);
		autoframeheight();
		
	},function( msg, code, content ){
		debugger;
	});
	
}

daLoader("daMsg,daTab,daTable,daIframe,daWin", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParam = da.urlParams();
		g_cid = arrParam["cid"];
		
		loadinfo();
	});
	
});
