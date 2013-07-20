var g_ctype = "PRODUCT_COMMENT";	//默认加载文章评论

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
		alert("请先勾选评论。");
		return;
	}

	daWin({
		width: 400,
		height: 500,
		title: "批量设置标签",
		url: "/sys_admin/module/tag/tag_manage.php?ismulti=true&type=PRODUCT_COMMENT",
		back: function( data ){
			var cids = [],
				tids = [];
			
			items.each(function(idx, obj){
				cids.push(obj.value);
			});
			
			for( var k in data){
				tids.push(k);
			}
			
			da.runDB("/sys_admin/module/tag/action/tagmap_add_list.php",{
				type: "PRODUCT_COMMENT",
				ids: cids.join(","),
				tids: tids.join(",")
			},
			function(res){debugger;
				if(res=="FALSE"){
					alert("对不起，标注失败。");
				}
				else{
					alert("标注成功。");
				}
			});
			
		}
	});
}

/**加载标签
*/
function loadtag(){
	da.runDB("/sys_admin/module/tag/action/tag_get_type.php",{
		dataType: "json",
		type: "PRODUCT_COMMENT"
		
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

/**改变评论审核状态
* obj: 标签对象
* cid: 评论 id
*/
function updatepassed( obj, cid ){
	var ispass = "未审核"==da(obj).text() ? 1 : 0;
	
	da.runDB("/sys_admin/module/message/action/comment_update_pass.php",{
		c_id: cid,
		c_ispass: ispass
		
	},function(data){
		if("FALSE"!= data){
			alert("状态设置成功");
			da(obj).html( 1==ispass?'<span style="color:#999">通过审核</span>':'<span style="color:#900">未审核</span>' );
			
			autoframeheight();
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}


/**添加回复信息
* obj: 标签对象
* cid: 评论 id
* ccid: 文章 id
*/
function addrevert( obj, cid, ccid ){
	var pObj = da(obj).parents("div"),
		textObj = da("[name=text_revert]", pObj);

	da.runDB("/sys_admin/module/message/action/commentrevert_add_item.php",{
		c_type: "PRODUCT_COMMENT_REVERT",
		c_id: cid,
		c_cid: ccid,
		c_content: textObj.val()
		
	},function(data){
		if("FALSE"!= data){
			alert("回复成功");
			textObj.val("");
			
			autoframeheight();
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**查看回复信息
* obj: 标签对象
* cid: 评论 id
*/
function viewrevert( obj, cid ){
	var trObj = da(obj).parents("tr"),
		reverttrObj = trObj.next("tr[name=revertrow]"),
		padObj = da("div[name=revertinfo]", reverttrObj);

	if( 0>=reverttrObj.dom.length ){
		alert("后台没有配置，显示业务进度面板");
	}
	
	if( "none" != reverttrObj.css("display")){
		reverttrObj.hide();
		return;
	}
	else{
		reverttrObj.show();
	}
		
	padObj.empty();
	
	var tranlist = da("#tb_list_revert").dom[0].cloneNode(true);
	tranlist.id = "tb_list_revert_"+cid;
	tranlist.setAttribute("id", "tb_list_revert_"+cid);
	padObj.append(tranlist);
	
	daTable({
		id: tranlist.id,
		url: "/sys_admin/module/message/action/commentrevert_get_page.php",
		data: {
			// opt: "qry",
			dataType: "json",
			c_type: "PRODUCT_COMMENT_REVERT",
			c_commentid: cid
		},
		// loading: false,
		// page: false,
		pageSize: 99999,
		
		field: function( fld, val, row, ds ){
			if( "pu_code" == fld ){
				val = '<span title="'+ row.pu_name +'">'+ val +'</span>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			// link_click("#tb_list tbody[name=details_auto] tr");
			autoframeheight();
		},
		error: function(code,msg,ex){
			debugger;
		}
	}).load(); 
	
}

/**加载列表
*/
function loadlist(){
	if( "" == g_ctype){
		alert("请先确定一个评论分类");
		return;
	}
	
	var data1 = {
			dataType: "json",
			opt: "qry",
			c_type: g_ctype
		};
	
	if( g_tid ){
		data1["tid"] = g_tid;
	}
	
	daTable({
		id: "tb_list",
		url: "/sys_admin/module/message/action/comment_get_page.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			switch( fld ){
				case "v_code":
					val = '<span title="'+ row.v_name +'">'+ val +'</span>';
					break;
				case "c_content":
					val = '<a href="'+ row.c_url +'" target="_blank">'+ val +'</a>';
					break;
				case "c_title":
					val = '<span title="'+ val +'">'+ da.limitStr(val,20) +'</span>';
					break;
				case "c_ispass":
					val = '<a href="javascript:void(0)" onclick="updatepassed(this, '+ row.c_id +')">'+ (0==val?'<span style="color:#900">未审核</span>':'<span style="color:#999">通过审核</span>') +'</a>';
					break;
				case "tools":
					val = '<a class="bt_link" href="javascript:void(0)" onclick="viewrevert(this, '+ row.c_id +')"><img src="/images/sys_icon/down.gif"/> 回复</a>';
					break;
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			
			autoframeheight();
		},
		error: function(code,msg,ex){
			// debugger;
		}
	}).load();

}


daLoader("daMsg,daTable,daIframe,daWin", function(){
	/*页面加载完毕*/
	da(function(){
		loadlist();
		loadtag();
	});
});
