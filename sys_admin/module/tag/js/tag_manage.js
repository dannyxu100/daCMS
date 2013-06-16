var g_tagtype = "",
	g_ismulti = false;

function updatecolor( tid, obj ){
	da.runDB("/sys_admin/module/tag/action/tag_update_item.php",{
		tid: tid,
		color: da(obj).val()
		
	},function(res){
		if( "FALSE" != res ){
			alert("修改成功");
		}
		else{
			alert("对不起, 操作失败");
		}
	},function(code,msg,ex){
		//debugger;
	});
}

function deletetag(tagid, tagname){
	confirm("您确认要删除 ("+ tagname +") 标签吗？", function(){
		da.runDB("/sys_admin/module/tag/action/tag_delete_item.php",{
			tagid: tagid
			
		},function(res){
			if( "FALSE" != res ){
				loadlist();
			}
		});
	});
}

/**添加标签
*/
function addtag(){
	if( !daValid.all() ){
		return;
	}

	da.runDB("/sys_admin/module/tag/action/tag_add_item.php",{
		tagname: da("#tagname").val(),
		tagtype: g_tagtype
		
	},function(res){
		if( "FALSE" != res ){
			loadlist();
		}
	});
}

var g_ds = {};		//缓存数据
/**加载列表
*/
function loadlist(){
	var data1 = {
			dataType: "json",
			tagtype: g_tagtype
		};
	
	daTable({
		id: "tb_list",
		url: "/sys_admin/module/tag/action/tag_get_page.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 8,
		
		field: function( fld, val, row, ds ){
			if("checkbox" == fld){				//
				if(g_chkItems[row.t_id]){		//判断是否被选过
					return '<input id="chkbox_'+ row.t_id +'" type="checkbox" checked name="chklist" value="'+ row.t_id +'"/>';
				}
				else{
					return '<input id="chkbox_'+ row.t_id +'" type="checkbox" name="chklist" value="'+ row.t_id +'"/>';
				}
			}
			else if("t_id"==fld){
				g_ds[val] = row;
			}
			else if("t_color" == fld){
				val = '<input class="color" style="width:50px;" onchange="updatecolor('+ row.t_id +', this)" value="'+ (val?val:'FFFFFF') +'"/>';
			}
			else if( "tools"==fld ){
				val = '<a class="" href="javascript:void(0)" onclick="deletetag('+ row.t_id +',\''+ row.t_name +'\')">删除</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			da("input.color", "#tb_list").bind("click.stop",function(){
				return false;
				
			}).each(function(idx, obj){
					var col = new jscolor.color( obj );
					
			});
			
			autoframeheight();
		},
		error: function(code,msg,ex){
			// debugger;
		}
	}).load();

}


var g_chkItems = {};
/**选择人员
*/
function selectitem( trObj ){
	var ttid = da(trObj).attr("value"),
		chkObj = da("input[name=chklist]",trObj);

	if(chkObj.dom[0].checked){
		delete g_chkItems[ttid];
		chkObj.dom[0].checked = false;
		chkObj.removeAttr("checked");
	}
	else{
		g_chkItems[ttid] = g_ds[ttid];
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
function cancelitem( ttid ){
	delete g_chkItems[ttid];

	var chkObj = da("#chkbox_"+ttid);
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
		strHTML += '<div class="item" ondblclick="cancelitem('+ g_chkItems[k].t_id +')">'+ g_chkItems[k].t_name +'</div>';
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
function clearitem(){
	for( var k in g_chkItems ){
		cancelitem(k);
	}
	delete g_chkItems;
	g_chkItems = {};
	showitem();
}


daLoader("daMsg,daTable,daWin,daIframe,daValid", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParams = da.urlParams();
		g_tagtype = arrParams["type"];
		g_ismulti = !!arrParams["ismulti"];
		
		loadlist();
	});
});