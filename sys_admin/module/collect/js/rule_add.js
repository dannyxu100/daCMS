
/**显示来源网址配置面板
*/
function showurlpad( obj ){
	da("#LIST_pad").hide();
	da("#NUMBER_pad").hide();
	da("#SINGLE_pad").hide();
	da("#RSS_pad").hide();
	
	da("#"+ obj.value +"_pad").show();
}


/**保存采集规则
*/
function saverule(){
	if( !daValid.all() ){
		alert("对不起，请仔细查看，是否有未填写的必填项。");
		return;
	}
	
	var data = {
		dataType: "json"
	};

	da("input:text,textarea").each(function(idx, obj){
		data[obj.id] = da(obj).val();
	});
	data["r_pagecode"] = da("input[name=r_pagecode]:checked").val();
	data["r_urltype"] = da("input[name=r_urltype]:checked").val();
	data["r_split"] = da("input[name=r_split]:checked").val();
	data["r_splittype"] = da("input[name=r_splittype]:checked").val();
	data["r_downloadimg"] = da("input[name=r_downloadimg]:checked").val();
	
	da.runDB("/sys_admin/module/collect/action/rule_add_item.php", data,
	function(res){
		if("FALSE" != res){
			alert("添加成功。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex){
		debugger;
	});
}

/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","采集网址","/images/menu_icon/form.png",{
		click:function(){
			da("#pad_1").show();
			da("#pad_2").hide();
			da("#pad_3").hide();
			da("#pad_4").hide();
		}
	});

	daTab0.appendItem("item02","文章内容规则","/images/menu_icon/user.png",{
		click:function(){
			da("#pad_1").hide();
			da("#pad_2").show();
			da("#pad_3").hide();
			da("#pad_4").hide();
		}
	});
	
	daTab0.appendItem("item03","扩展规则","/images/menu_icon/menu.png",{
		click:function(){
			da("#pad_1").hide();
			da("#pad_2").hide();
			da("#pad_3").show();
			da("#pad_4").hide();
		}
	});
	daTab0.appendItem("item04","其他配置","/images/menu_icon/menu.png",{
		click:function(){
			da("#pad_1").hide();
			da("#pad_2").hide();
			da("#pad_3").hide();
			da("#pad_4").show();
		}
	});
	daTab0.click("item01");
}

daLoader("daMsg,daTab,daTable,daIframe,daWin,daValid", function(){
	/*页面加载完毕*/
	da(function(){
		loadtab();
	});
	
});
