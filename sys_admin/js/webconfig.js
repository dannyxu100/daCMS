
function savewebconfig(){
	if( !daValid.all() ){
		return;
	}
	
	da.runDB("/sys_admin/action/webconfig_update_item.php",{
		dataType: "json",
		c_id: da("#c_id").val(),
		c_company: da("#c_company").val(),
		c_address: da("#c_address").val(),
		c_user: da("#c_user").val(),
		c_phone: da("#c_phone").val(),
		c_telephone: da("#c_telephone").val(),
		c_email: da("#c_email").val(),
		c_fax: da("#c_fax").val(),
		c_zipcode: da("#c_zipcode").val(),
		c_name: da("#c_name").val(),
		c_website: da("#c_website").val(),
		c_icp: da("#c_icp").val(),
		c_img: da("#c_img").val(),
		c_keywords: da("#c_keywords").val(),
		c_description: da("#c_description").val(),
		c_pushemail: da("#c_pushemail").val(),
		c_pushpwd: da("#c_pushpwd").val(),
		c_remark: da("#c_remark").val()
		
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

/**加载信息
*/
function loadinfo(){
	loading(true);
	da.runDB("/sys_admin/action/webconfig_get_item.php",{
		dataType: "json"
		
	},function(data){
		if("FALSE"!= data){
			for(var fld in data){
				da("#"+fld).val(data[fld]);
			}
			
			da("#c_img_view").attr("src", data.c_img);
			
			autoframeheight();
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daIframe,daWin,daValid",function(){
	da(function(){
		
		loadinfo();
	});
});
