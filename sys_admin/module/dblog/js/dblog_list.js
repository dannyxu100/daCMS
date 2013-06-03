
/**加载数据库操作日志列表
*/
function loadlist(){
	var data1 = {
			dataType: "json"
		};

	daTable({
		id: "tb_list",
		url: "/sys_admin/module/dblog/action/dblog_get_page.php",
		data: data1,
		// loading: false,
		// page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			switch( fld ){
				case "l_type":
					switch( val ){
						case "INSERT":
							val = '<span style="color:#090">添加</span>';
							break;
						case "DELETE":
							val = '<span style="color:#900">删除数据</span>';
							break;
						case "UPDATE":
							val = '<span style="color:#990">更新</span>';
							break;
						case "RUNSQL":
							val = '<span style="color:#900">执行</span>';
							break;
					}
					break;
				case "l_sql":
					val = '<span title="'+ row.l_sql +'">'+ da.limitStr(val, 80) + '</span>';
					break;
				case "tools":
					break;
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
		
		loadlist();
	});
});
