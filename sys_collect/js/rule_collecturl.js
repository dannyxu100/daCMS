﻿var g_rid;

function collecturl(){
	// loading(true);
	// da.runDB("/sys_collect/action/url_get_list.php",{
		// dataType: "json",
		// rid: g_rid
		
	// },function(data){
		// var arr = [];
		// for(var i=0; i<data.length; i++){
			// arr.push('<div>'+ data[i].title +'</div>');
			// arr.push('<div style="border-bottom:1px dashed #f5f5f5; margin-bottom:10px;">'+ data[i].url +'</div>');
		// }
		// da("#list").html(arr.join(""));
		// da("#count").html("共"+data.length+"条");
		// autoframeheight();
		// loading(false);
		
	// },function(code,msg,ex){
		//// debugger;
	// });
	
	var data1 = {
			dataType: "json",
			opt: "qry",
			rid: g_rid
		};

	daTable({
		id: "tb_list",
		url: "/sys_collect/action/url_get_list.php",
		data: data1,
		// loading: false,
		// page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			switch( fld ){
				case "url":
					val = '<a href="'+ val +'" target="_blank">'+ val +'</a>';
					break;
				case "tools":
					val = '<a class="bt_link" href="javascript:void(0)" onclick="testrule('+ row.r_id +')">获取内容</a>';
			}
			
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			autoframeheight();
		},
		error: function( msg, code, content ){
			debugger;
		}
	}).load();
}

daLoader("daMsg,daTable,daWin,daIframe", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParam = da.urlParams();
		g_rid = arrParam["rid"];
		
		collecturl();
	});
});