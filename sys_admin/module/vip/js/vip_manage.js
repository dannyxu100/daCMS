
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

function addvip(){
	daWin({
		width: 500,					//窗口宽
		height: 450,				//窗口高
		url: "/sys_admin/module/vip/vip_add.php",	//url地址
		title: "添加会员",			//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loadlist();
		}
	});

}

function updatevip(vid){
	daWin({
		width: 500,					//窗口宽
		height: 450,				//窗口高
		url: "/sys_admin/module/vip/vip_add.php?vid="+vid,		//url地址
		title: "修改会员信息",								//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loadlist();
		}
	});
}

/**显示隐藏标签条
*/
function slidetagbar(){
	if( da("#tagpad").is(":hidden") ){
		da("#tagpad").show();
	}
	else{
		da("#tagpad").hide();
	}
	autoframeheight();
}

var g_tid = "", g_tagobj;
function selecttag( tid, obj ){
	if( !da(obj).hasClass("tagitem2") ){
		da(g_tagobj).removeClass("tagitem2");
		da(obj).addClass("tagitem2");
		g_tid = tid;
		g_tagobj = obj;
	}
	else{
		g_tid = "";
		da(obj).removeClass("tagitem2");
	}
	
	loadlist();
}

/**批量设置标签
*/
function updatetag(){
	var items = da("[name=chkitem]:checked");
	
	if( 0>=items.dom.length){
		alert("请先勾选会员。");
		return;
	}

	daWin({
		width: 400,
		height: 500,
		title: "批量设置标签",
		url: "/sys_admin/module/tag/tag_manage.php?ismulti=true&type=VIP",
		back: function( data ){
			var vids = [],
				tids = [];
			
			items.each(function(idx, obj){
				vids.push(obj.value);
			});
			
			for( var k in data){
				tids.push(k);
			}
			
			da.runDB("/sys_admin/module/tag/action/tagmap_add_list.php",{
				type: "VIP",
				ids: vids.join(","),
				tids: tids.join(",")
			},
			function(res){
				if(res=="FALSE"){
					alert("对不起，标注失败。");
				}
				else{
					alert("标注成功。");
				}
			},function(code,msg,ex){
				// debugger;
			});
			
		}
	});
}

/**加载标签
*/
function loadtag(){
	da.runDB("/sys_admin/module/tag/action/tag_get_type.php",{
		dataType: "json",
		type: "VIP"
		
	},function(data){
		if("FALSE"!= data){
			var strHTML = "";
				tagpad = da("#tagpad");
			
			tagpad.empty();
			for(var i=0; i<data.length; i++){
				strHTML += '<div class="tagitem" style="border-color:#'+ data[i].t_color +'" onclick="selecttag('+ data[i].t_id +', this)">'+ data[i].t_name +'</div>';
			}
			tagpad.html(strHTML);
			
			autoframeheight();
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

function loadlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};

	if( g_tid ){
		data1["tid"] = g_tid;
	}
	
	daTable({
		id: "tb_list",
		url: "/sys_admin/module/vip/action/vip_get_page.php",
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


daLoader("daMsg,daTable,daIframe,daWin", function(){
	//da.out("加载成功");

	da(function(){
		loadlist();
		loadtag();
	});
});
//-->