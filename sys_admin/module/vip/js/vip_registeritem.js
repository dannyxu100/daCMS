
/**添加注册项
*/
function additem(){
	daWin({
		width: 400,					//窗口宽
		height: 300,				//窗口高
		url: "/sys_admin/module/vip/registeritem_add.php",	//url地址
		title: "添加注册项",		//caption标题
		after: function(data){		//窗体内页操作完毕返回数据执行
			loaditemlist();
		}
	});

}

function updateuser(puid){
	daWin({
		width: 400,					//窗口宽
		height: 600,				//窗口高
		url: "/sys_admin/module/power/user_update.php?puid="+puid,		//url地址
		title: "修改人员信息",								//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loaduserlist();
		}
	});
}

function loaditemlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};

	daTable({
		id: "tb_list",
		url: "/sys_admin/module/vip/action/registeritem_get_page.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("pu_name"==fld){
				return '<a href="javascript:void(0)" onclick="updateuser('+row.pu_id+')">'+val+'</a>';
			}
			else if( "tools" == fld ){
				val = '<a href="javascript:void(0)" onclick="">启用</a>　';
				val += '<a href="javascript:void(0)" onclick="">必填项</a>';
				switch( row.COLUMN_NAME ){
					case "v_id":
					case "v_name":
					case "v_code":
						break;
				}
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();

}


daLoader("daMsg,daTable,daIframe,daWin", function(){
	da(function(){
		loaditemlist();
	});
});