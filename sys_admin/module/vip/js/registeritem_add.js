
function saveitem(){
	if( !daValid.all() ){
		return;
	}
	
	da.runDB("/sys_admin/module/vip/action/registeritem_add_item.php",{
		dataType: "json",
		vr_name: da("#vr_name").val(),
		vr_field: da("#vr_field").val(),
		vr_sort: da("#vr_sort").val(),
		vr_type: da("#vr_type").val(),
		vr_items: da("#vr_items").val(),
		vr_ismust: da("[name=vr_ismust]:checked").val(),
		vr_status: da("[name=vr_status]:checked").val()
		
	},function(data){
		if("FALSE" != data){
			alert("添加成功。");
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

daLoader("daMsg,daValid,daTable,daIframe,daWin", function(){
	da(function(){
		
	});
});