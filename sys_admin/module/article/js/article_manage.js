var g_atid = "";

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

var setting = {
	view: {
		selectedMulti: false
	},
	edit: {
		enable: true,
		editNameSelectAll: true
	},
	data: {
		simpleData: {
			enable: true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: 0
		}
	},
	callback: {
		beforeMouseUp: clicknode
	}
};


/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	if( !treeNode || !treeNode.id ) return;
	
	g_atid = treeNode.id;

	loadtypeinfo(function(){
		loadlist();
	});
}


/**批量设置标签
*/
function updatetag(){
	var items = da("[name=chkitem]:checked");
	
	if( 0>=items.dom.length){
		alert("请先勾选文章。");
		return;
	}

	daWin({
		width: 400,
		height: 500,
		title: "批量设置标签",
		url: "/sys_admin/module/tag/tag_manage.php?ismulti=true&type=ARTICLE",
		back: function( data ){
			var aids = [],
				tids = [];
			
			items.each(function(idx, obj){
				aids.push(obj.value);
			});
			
			for( var k in data){
				tids.push(k);
			}
			
			da.runDB("/sys_admin/module/tag/action/tagmap_add_list.php",{
				type: "ARTICLE",
				ids: aids.join(","),
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

/**修改文章
*/
function updatearticle( aid ){
	goto("/sys_admin/module/article/article_update.php?aid="+ aid);
}


/**添加文章
*/
function addarticle(){
	if( "" == g_atid){
		alert("请先选择一个分类");
		return;
	}

	goto("/sys_admin/module/article/article_add.php?atid="+ g_atid);
}


/**加载标签
*/
function loadtag(){
	da.runDB("/sys_admin/module/tag/action/tag_get_type.php",{
		dataType: "json",
		type: "ARTICLE"
		
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
		debugger;
	});
}

/**加载列表
*/
function loadlist(){
	if( "" == g_atid){
		alert("请先选择一个分类");
		return;
	}
	
	var data1 = {
			dataType: "json",
			opt: "qry",
			atid: g_atid
		};
	
	if( g_tid ){
		data1["tid"] = g_tid;
	}
	
	daTable({
		id: "tb_list",
		url: "/sys_admin/module/article/action/article_get_page.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("a_title"==fld){
				val = (row.a_img?'<img class="crtimg" src="/images/sys_icon/img.png" src2="'+ row.a_img +'" style="vertical-align:middle;"/> ' 
				: '<img class="crtimg" src="/images/sys_icon/img2.png" src2="" style="vertical-align:middle;"/> ')
				+ '<a href="javascript:void(0)" onclick="updatearticle('+row.a_id+')" title="'+ row.a_description +'" >'+val+'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			da(".crtimg").live("mouseover",function( event ){
				var src2 = da(this).attr("src2");
				if( ""==src2 ) return;
			
				var imgtip = '<div id="imgtip" style="display:none; position:absolute; border:1px solid #009900; background:#fff; padding:2px; "><img src="'
				+ da(this).attr("src2") 
				+'" alt="预览图"/></div>'; //创建 容器元素
				
				da("body").append(imgtip);	//把它追加到文档中

				da("#imgtip").css({
					"top": (event.pageY + 10) + "px",
					"left":  (event.pageX + 10) + "px"
				}).show("50");	  				//设置x坐标和y坐标，并且显示
			
			}).live("mousemove",function( event ){
				$("#imgtip").css({
					"top": (event.pageY+10) + "px",
					"left":  (event.pageX+10) + "px"
				});
				
			});
			da(".crtimg").live("mouseout",function( event ){
				da("#imgtip").remove();	 //移除 
				
			});
			
			autoframeheight();
		},
		error: function(code,msg,ex){
			// debugger;
		}
	}).load();

}

/**加载分类基本信息
*/
function loadtypeinfo( fn ){
	da.runDB("/sys_admin/module/article/action/articletype_get_list.php",{
		dataType: "json",
		atid: g_atid
	},
	function(data){
		if("FALSE"!= data && data[0]){
			if( "SINGLEPAGE" == data[0].at_style ){
				da("#pad_config").hide();
				da("#norecord").show();
				
				da("#at_name").text(data[0].at_name);
			}
			else{
				da("#pad_config").show();
				da("#norecord").hide();
				
				fn();
			}
		}
	});
}

/*加载左边分类树*/
function loadtree(){
	da.runDB("/sys_admin/module/article/action/articletype_get_articlecount.php",{
		dataType: "json"
	},
	function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].at_id,
				pId: data[i].at_pid,
				name: data[i].at_name+ ' ('+ data[i].total +')',
				open: true
			});
		}
		
		$.fn.zTree.init($("#treearticletype"), setting, zNodes);
		
	});
}


/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","分类信息","/images/menu_icon/menu.png",{
		click:function(){
			da("#pad_list").hide();
			da("#pad_info").show();
			
			// da("#leftpad").show();
		}
	});

	daTab0.appendItem("item02","文章列表","/images/sys_icon/tables.png",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").show();
			
			// da("#leftpad").hide();
		}
	});
	
	daTab0.click("item02");
}

daLoader("daMsg,daTab,daTable,daIframe,daWin", function(){
	/*页面加载完毕*/
	da(function(){
		// loadtab();
		loadtree();
		loadtag();
	});
});
