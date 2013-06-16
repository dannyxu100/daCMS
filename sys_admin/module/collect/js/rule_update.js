
var g_rid = "";

/**显示来源网址配置面板
*/
function showurlpad( obj ){
	da("#LIST_pad").hide();
	da("#NUMBER_pad").hide();
	da("#SINGLE_pad").hide();
	da("#RSS_pad").hide();
	
	da("#"+ obj.value +"_pad").show();
}

/**显示内容分页标志面板
*/
function showsplitpad( obj ){
	if( "PREVNEXT" == obj.value ){
		da("#PREVNEXT_pad").show();
	}
	else{
		da("#PREVNEXT_pad").hide();
	}
	
}

/**保存采集规则
*/
function updaterule(){
	var data = {
		dataType: "json"
	};

	da("input:text,textarea").each(function(idx, obj){
		data[obj.id] = da(obj).val();
	});
	data["r_id"] = g_rid;
	data["r_pagecode"] = da("input[name=r_pagecode]:checked").val();
	data["r_urltype"] = da("input[name=r_urltype]:checked").val();
	data["r_split"] = da("input[name=r_split]:checked").val();
	data["r_splittype"] = da("input[name=r_splittype]:checked").val();
	data["r_downloadimg"] = da("input[name=r_downloadimg]:checked").val();
	
	
	if( !daValid.all() ){
		alert("对不起，请仔细查看，是否有未填写的必填项。");
		return;
	}
	
	da.runDB("/sys_admin/module/collect/action/rule_update_item.php", data,
	function(res){
		if("FALSE" != res){
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
	if( "" == g_rid ){
		alert("对不起，没有指定规则id");
		return;
	}
	
	loading(true);
	da.runDB("/sys_admin/module/collect/action/rule_get_item.php", {
		dataType: "json",
		rid: g_rid
	},
	function(data){
		if("FALSE" != data){
			for(var fld in data){
				da("#"+fld).val(data[fld]);
			}
			
			var radioobj = da("input[name=r_pagecode][value="+ data.r_pagecode +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			radioobj = da("input[name=r_urltype][value="+ data.r_urltype +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			radioobj = da("input[name=r_split][value="+ data.r_split +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			radioobj = da("input[name=r_splittype][value="+ data.r_splittype +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			radioobj = da("input[name=r_downloadimg][value="+ data.r_downloadimg +"]");
			radioobj.attr("checked", "checked");
			radioobj.dom[0].checked = true;
			
			showurlpad(da("input[name=r_urltype]:checked").dom[0]);
			showsplitpad(da("input[name=r_splittype]:checked").dom[0]);
			
			autoframeheight();
			loading(false);
		}
	},function(code,msg,ex){
		// debugger;
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
			da("#pad_5").hide();
			autoframeheight();
		}
	});

	daTab0.appendItem("item02","文章内容规则","/images/menu_icon/user.png",{
		click:function(){
			da("#pad_1").hide();
			da("#pad_2").show();
			da("#pad_3").hide();
			da("#pad_4").hide();
			da("#pad_5").hide();
			autoframeheight();
		}
	});
	
	daTab0.appendItem("item03","内容分页规则","/images/menu_icon/user.png",{
		click:function(){
			da("#pad_1").hide();
			da("#pad_2").hide();
			da("#pad_3").show();
			da("#pad_4").hide();
			da("#pad_5").hide();
			autoframeheight();
		}
	});
	
	
	daTab0.appendItem("item04","扩展规则","/images/menu_icon/menu.png",{
		click:function(){
			da("#pad_1").hide();
			da("#pad_2").hide();
			da("#pad_3").hide();
			da("#pad_4").show();
			da("#pad_5").hide();
			autoframeheight();
		}
	});
	daTab0.appendItem("item05","其他配置","/images/menu_icon/menu.png",{
		click:function(){
			da("#pad_1").hide();
			da("#pad_2").hide();
			da("#pad_3").hide();
			da("#pad_4").hide();
			da("#pad_5").show();
			autoframeheight();
		}
	});
	daTab0.click("item01");
}

daLoader("daMsg,daTab,daTable,daIframe,daWin,daValid", function(){
	/*页面加载完毕*/
	da(function(){
		var arrParam = da.urlParams();
		g_rid = arrParam["rid"];
		
		loadtab();
		loadinfo();
	});
	
});
