﻿var g_ismulti = false;

 
var g_ds = {};		//缓存数据

function loaduserlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};
		
	//考虑到多页选择，就不清楚缓存了。
	// g_ds = {};	//清除缓存数据
	daTable({
		id: "tb_list",
		url: "/sys_admin/module/power/action/user_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 10,
		
		field: function( fld, val, row, ds ){
			if("checkbox" == fld){				//
				if(g_chkItems[row.pu_id]){		//判断是否被选过
					return '<input id="chkbox_'+ row.pu_id +'" type="checkbox" checked name="chklist" value="'+ row.pu_id +'"/>';
				}
				else{
					return '<input id="chkbox_'+ row.pu_id +'" type="checkbox" name="chklist" value="'+ row.pu_id +'"/>';
				}
			}
			// da.out($v[_pu_remark]);
			// if( "pu_count" == fld )
				// return 0==val?"完整SQL":"不完整SQL";
			if("pu_id"==fld){
				g_ds[val] = row;
			}
			// if("pu_name"==fld){
				// return '<a href="javascript:void(0)" onclick="updateuser('+row.pu_id+')">'+val+'</a>';
			// }
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
			autoframeheight();
		}
	}).load();

}

var g_chkItems = {};
/**选择人员
*/
function selectitem( trObj ){
	var puid = da(trObj).attr("value"),
		chkObj = da("input[name=chklist]",trObj);

	if(chkObj.dom[0].checked){
		delete g_chkItems[puid];
		chkObj.dom[0].checked = false;
		chkObj.removeAttr("checked");
	}
	else{
		g_chkItems[puid] = g_ds[puid];
		chkObj.dom[0].checked = true;
		chkObj.attr("checked","true");
	}

	if(!g_ismulti){
		backitem();
	}
	
	showitem();
}

/**取消选中的人员
*/
function cancelitem( puid ){
	delete g_chkItems[puid];

	var chkObj = da("#chkbox_"+puid);
	if(0<chkObj.dom.length){
		chkObj.dom[0].checked = false;
		chkObj.removeAttr("checked");
	}
	
	showitem();
}

/**显示选中的人员
*/
function showitem(){
	var outObj = da("#out_pad"),
		strHTML = '';
		
	for( var k in g_chkItems ){
		strHTML += '<div class="item" ondblclick="cancelitem('+ g_chkItems[k].pu_id +')">'+ g_chkItems[k].pu_name +'</div>';
	}
	
	outObj.html(strHTML);
	autoframeheight();
}

/**返回选择结果
*/
function backitem(){
	back(g_chkItems);
}

/**清除
*/
function clear(){
	for( var k in g_chkItems ){
		cancelitem(k);
	}
	delete g_chkItems;
	g_chkItems = {};
	showitem();
}


daLoader("daTable,daWin,daIframe", function(){
	//da.out("加载成功");
	da(function(){
		arrParams = da.urlParams();
		g_ismulti = !!arrParams["ismulti"];
		
		loaduserlist();
	});
});
//-->