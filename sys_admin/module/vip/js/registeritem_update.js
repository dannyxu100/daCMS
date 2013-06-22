
var g_vrid = "",
	g_oldfield = "";

function saveitem(){
	if( !daValid.all() ){
		return;
	}
	
	da.runDB("/sys_admin/module/vip/action/registeritem_update_item.php",{
		dataType: "json",
		vr_id: g_vrid,
		vr_name: da("#vr_name").val(),
		vr_field1: g_oldfield,
		vr_field2: da("#vr_field").val(),
		vr_sort: da("#vr_sort").val(),
		vr_type: da("#vr_type").val(),
		vr_items: da("#vr_items").val(),
		vr_ismust: da("[name=vr_ismust]:checked").val(),
		vr_status: da("[name=vr_status]:checked").val()
		
	},function(data){
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex){
		// debugger;
	});
}

/**显示隐藏选项编辑栏
*/
function showedit(){
	var opobj = da("#vr_type option:selected");
	
	if( "下拉" == opobj.text() || "单选" == opobj.text() || "多选" == opobj.text() ){
		da("#pad_items").show();
	}
	else{
		da("#pad_items").hide();
	}

	
	autoframeheight();
}

/**加载注册项信息
*/
function loadinfo(){
	da.runDB("/sys_admin/module/vip/action/registeritem_get_item.php",{
		dataType: "json",
		vr_id: g_vrid
		
	},function(data){
		if("FALSE"!= data){
			for(var fld in data){
				da("#"+fld).val(data[fld]);
			}
			
			g_oldfield = data.vr_field;
			
			var radioobj = da("input[name=vr_ismust][value="+ data.vr_ismust +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			radioobj = da("input[name=vr_status][value="+ data.vr_status +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			showedit();
			
			autoframeheight();
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daValid,daTable,daIframe,daWin", function(){
	da(function(){
		var arrParam = da.urlParams();
		g_vrid = arrParam["vrid"];
		
		loadinfo();
	});
});