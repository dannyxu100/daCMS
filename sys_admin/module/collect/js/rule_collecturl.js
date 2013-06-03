var g_rid;
var g_arrlink = {};

/**获取详细内容
*/
function collectcontent( ids ){
	var arrid = (ids+"").split("|"),
		arrurl = [],
		arrtitle = [];
		
	for( var i=0; i<arrid.length; i++ ){
		arrurl.push( g_arrlink[arrid[i]].url );
		arrtitle.push( g_arrlink[arrid[i]].title );
	}

	var data = {
		dataType: "json",
		rid: g_rid,
		urls: arrurl.join("□"),
		titles: arrtitle.join("□"),
	};

	da.runDB("/sys_admin/module/collect/action/collect_add_item.php", data,
	function(res){
		if("FALSE" != res){
			alert("成功获取："+ res +" 篇文章。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex){
		debugger;
	});
}


/**获取文章链接地址集
*/
function collecturl(){
	var data1 = {
			dataType: "json",
			opt: "qry",
			rid: g_rid
		};
	
	daTable({
		id: "tb_list",
		url: "/sys_admin/module/collect/action/url_get_list.php",
		data: data1,
		// loading: false,
		// page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			switch( fld ){
				case "order":
					g_arrlink[row.id] = row;
					break;
				case "url":
					val = '<a href="'+ val +'" target="_blank">'+ val +'</a>';
					break;
				case "tools":
					val = "true"==row.isold ? '已采集':'<a class="bt_link" href="javascript:void(0)" onclick="collectcontent('+ row.id +')">获取内容</a>';
			}
			
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			autoframeheight();
		},
		error: function( msg, code, content ){
			// debugger;
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
