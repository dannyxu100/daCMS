
/**还原模板
*/
function restoretemplate(){
	back( da("[name=chkitem]:checked").val() );
}

/**加载模板备份列表
*/
function loadbackuplist(){
	daTable({
		id: "tb_list",
		url: "/sys_admin/module/template/action/template_get_backuplist.php",
		data: {
			dataType: "json"
		},
		//loading: false,
		// page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			autoframeheight();
		},
		error: function(code,msg,ex){
			// debugger;
		}
	}).load();
	
}

daLoader("daMsg,daTable,daIframe,daWin",function(){
	da(function(){
		loadbackuplist();
	});
});
