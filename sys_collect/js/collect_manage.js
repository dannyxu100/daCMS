

function addrule(){
	goto("/sys_collect/rule_add.php");
}

function updaterule( rid ){
	goto("/sys_collect/rule_update.php?rid="+ rid);
}

function collecturl( rid ){
	goto("/sys_collect/rule_collecturl.php?rid="+ rid);
}


/**加载文件列表
*/
function loadlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};

	daTable({
		id: "tb_list",
		url: "/sys_collect/action/rule_get_page.php",
		data: data1,
		// loading: false,
		// page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			switch( fld ){
				case "r_name":
					val = '<a href="javascript:void(0)" onclick="updaterule('+ row.r_id +')">'+ val +'</a>';
					break;
				case "tools":
					val = '<a class="bt_link" href="javascript:void(0)" onclick="collecturl('+ row.r_id +')">抓取地址</a>';
					val += '<a class="bt_link" href="javascript:void(0)" onclick="testrule('+ row.r_id +')">抓取内容</a>';
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
		loadlist();
	});
});
