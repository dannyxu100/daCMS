 
function adduser(){
	daWin({
		width: 400,					//窗口宽
		height: 600,				//窗口高
		url: "/sys_admin/module/power/user_add.php",	//url地址
		title: "添加人员",			//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loaduserlist();
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

function loaduserlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};

	daTable({
		id: "tb_list",
		url: "/sys_admin/module/power/action/user_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			// da.out($v[_pu_remark]);
			// if( "pu_count" == fld )
				// return 0==val?"完整SQL":"不完整SQL";
			if("pu_name"==fld){
				return '<a href="javascript:void(0)" onclick="updateuser('+row.pu_id+')">'+val+'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();

}


daLoader("daMsg,daTable,daWin", function(){
	//da.out("加载成功");

	da(function(){
		loaduserlist();
	});
});
//-->