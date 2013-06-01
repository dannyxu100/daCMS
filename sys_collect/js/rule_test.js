var g_rid;

function collecturl(){
	loading(true);
	da.runDB("/sys_collect/action/url_get_list.php",{
		dataType: "json",
		rid: g_rid
		
	},function(data){
		var arr = [];
		for(var i=0; i<data.length; i++){
			arr.push('<div>'+ data[i].title +'</div>');
			arr.push('<div style="border-bottom:1px dashed #f5f5f5; margin-bottom:10px;">'+ data[i].url +'</div>');
		}
		da("#list").html(arr.join(""));
		da("#count").html("共"+data.length+"条");
		autoframeheight();
		loading(false);
		
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daTable,daWin,daIframe", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParam = da.urlParams();
		g_rid = arrParam["rid"];
		
		collecturl();
	});
});
