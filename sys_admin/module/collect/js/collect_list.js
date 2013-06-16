
var g_rid = "";

/**选中全部
*/
function checkall( obj ){
	var checkobj = da("[name=chkitem]");
	
	if( da(obj).is(":checked") ){
		checkobj.attr("checked", "checked");
		checkobj.each(function(){
			this.checked = true;
		});
	}
	else{
		checkobj.removeAttr("checked");
		checkobj.each(function(){
			this.checked = false;
		});
	}
}

function showcontent( cid ){
	daWin({
		width: 800,
		height: 600,
		title: "查看已采集文章内容",
		url: "/sys_admin/module/collect/collect_view.php?cid="+ cid
	});
}

/**批量引用
*/
function exportlist(){
	var items = da("[name=chkitem]:checked");
	var cids = [];
	
	items.each(function(idx, obj){
		cids.push(obj.value);
	});
	
	exportcontent( cids.join(",") );
}

/**批量文章
*/
function exportcontent( cids ){
	daWin({
		width: 400,
		height: 500,
		title: "选择引用文章分类",
		url: "/sys_admin/module/article/plugin/select_articletype.htm?ismulti=true",
		back: function( data ){
			var atids = [];
			
			for(var atid in data){
				atids.push(atid);
			}
			
			atids = atids.join(",");

			da.runDB("/sys_admin/module/collect/action/collect2article_update_list.php",{
				atids: atids,
				cids: cids
			
			},function(res){
				if("FALSE" != res){
					var arr = (cids+"").split(","), chkobj, btobj, objtmp;
					
					for( var i=0; i<arr.length; i++ ){
						chkobj = da("#chkitem_"+ arr[i] );
						btobj = da("#bt_export_"+ arr[i] );
						
						objtmp = document.createElement("span");
						objtmp.innerHTML = "已经引用";
						btobj.dom[0].parentNode.insertBefore(objtmp, btobj.dom[0] );
						btobj.remove();
						chkobj.remove();
					}
					// loadlist();
				}
			
			},function(code, msg, ex){
				// debugger;
			});
		}
	});
}

/**加载文件列表
*/
function loadlist(){
	var data1 = {
			dataType: "json",
			opt: "qry",
			c_rid: g_rid
		};

	daTable({
		id: "tb_list",
		url: "/sys_admin/module/collect/action/collect_get_page.php",
		data: data1,
		// loading: false,
		// page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			switch( fld ){
				case "checkbox":
					val = "TRUE" == row.c_isused ? ' ':'<input id="chkitem_'+ row.c_id +'" type="checkbox" name="chkitem" value="'+ row.c_id +'" />';
					break;
				case "c_title":
					val = '<a href="javascript:void(0)" onclick="showcontent('+ row.c_id +')">'+ val +'</a>';
					break;
				case "c_url":
					val = '<a href="'+ val +'" target="_blank" title="'+ row.c_description +'">'+ da.limitStr(val, 50) +'</a>';
					break;
				case "tools":
					val = "TRUE" == row.c_isused ? '已经引用':'<a id="bt_export_'+ row.c_id +'" class="bt_link" href="javascript:void(0)" onclick="exportcontent('+ row.c_id +')">引用文章</a>';
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
		var arrParam = da.urlParams();
		g_rid = arrParam["rid"];
		
		loadlist();
	});
});
