
/**添加注册项
*/
function additem(){
	daWin({
		width: 400,					//窗口宽
		height: 350,				//窗口高
		url: "/sys_admin/module/vip/registeritem_add.php",	//url地址
		title: "添加注册项",		//caption标题
		after: function(data){		//窗体内页操作完毕返回数据执行
			loaditemlist();
		}
	});

}

/**删除注册项
*/
function deleteitem( vrid ){
	confirm("您确定要删除该注册项吗？", function(){
		da.runDB("/sys_admin/module/vip/action/registeritem_delete_item.php", {
			vr_id: vrid
			
		},function( res ){
			if( "FALSE" != res ){
				loaditemlist();
			}
		
		},function(code, msg, ex){
			// debugger;
		});
	});

}

/**修改注册项
*/
function updateitem( vrid ){
	daWin({
		width: 400,					//窗口宽
		height: 350,				//窗口高
		url: "/sys_admin/module/vip/registeritem_update.php?vrid="+ vrid,	//url地址
		title: "修改注册项",		//caption标题
		after: function(data){		//窗体内页操作完毕返回数据执行
			loaditemlist();
		}
	});
}

/**修改注册项状态
*/
function updatestatus( vrid, obj ){
	var status = da(obj).text();

	da.runDB("/sys_admin/module/vip/action/registeritem_update_status.php", {
		vr_id: vrid,
		vr_status: ("启用"==status ? "STOP" : "RUN")
		
	},function( res ){
		if( "FALSE" != res ){
			if( "启用" == status ){
				da(obj).html('<span style="color:#900">x</span>');
			}
			else{
				da(obj).html("启用");
			}
		}
	
	},function(code, msg, ex){
		// debugger;
	});
}

/**修改注册项必填
*/
function updatemust( vrid, obj ){
	var must = da(obj).text();

	da.runDB("/sys_admin/module/vip/action/registeritem_update_ismust.php", {
		vr_id: vrid,
		vr_ismust: ("必填"==must ? 0 : 1)
		
	},function( res ){
		if( "FALSE" != res ){
			if( "必填" == must ){
				da(obj).html('<span style="color:#900">x</span>');
			}
			else{
				da(obj).html("必填");
			}
		}
	
	},function(code, msg, ex){
		// debugger;
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
		pageSize: 9999,
		
		field: function( fld, val, row, ds ){
			switch( fld ){
				case "vr_name":
					val = ( 1 == row.vr_issys ) ? val : '<a href="javascript:void(0)" onclick="updateitem('+ row.vr_id +')">'+val+'</a>';
					break;
				case "vr_items":
					val = '<span style="color:#900">'+ row.vr_items +'</span>';
					break;
				case "vr_issys":
					val = ( 1 == row.vr_issys ) ? '<span style="color:#aaa">系统保留</span>' : "自定义扩展";
					break;
				case "vr_status":
					val = '<a href="javascript:void(0)" onclick="updatestatus('+ row.vr_id +', this)">'+ ( "STOP" == row.vr_status ? '<span style="color:#900">x</span>':'启用' ) +'</a>';
					break;
				case "vr_ismust":
					val = '<a href="javascript:void(0)" onclick="updatemust('+ row.vr_id +', this)">'+ ( 0 == row.vr_ismust ?'<span style="color:#900">x</span>':'必填') +'</a>';
					break;
				case "tools":
					if( 1 != row.vr_issys ){
						val = '<a class="bt_link" href="javascript:void(0)" onclick="deleteitem('+ row.vr_id +')"><img src="/images/sys_icon/delete.png"/> 删除</a>';
					}
					break;
			}
			
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		},
		error: function(code, msg, ex){
			// debugger;
		}
	}).load();

}


daLoader("daMsg,daTable,daIframe,daWin", function(){
	da(function(){
		loaditemlist();
	});
});