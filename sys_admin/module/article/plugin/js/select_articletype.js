var g_ismulti = false;

var setting = {
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {
		clicknode: clicknode,
	}
};

function clicknode( treeId, treeNode ) {
	if( !treeNode || !treeNode.id ) return;
	
	selectitem(treeNode.id);
	
	if( !g_ismulti ){  		//单选直接返回结果
		backitem();
	}
}


var g_ds = {};		//缓存数据

/*加载左边部门数据*/
function loadtree(){
	 $.ajax({
	   url: "/sys_admin/module/article/action/articletype_get_list.php",
	   dataType: "json",
	   success: function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				zNodes.push({
					id: data[i].at_id,
					pId: data[i].at_pid,
					data: data[i].at_name,
					name: data[i].at_name,
					open: true
				});
				
				g_ds[data[i].at_id] = data[i];
			}
			$.fn.zTree.init($("#roletree"), setting, zNodes);
			autoframeheight();
	   }
	 });
}


var g_chkItems = {};
/**选择分类
*/
function selectitem( atid ){
	g_chkItems[atid] = g_ds[atid];
	showitem();
}

/**取消选中的分类
*/
function cancelitem( atid ){
	delete g_chkItems[atid];
	showitem();
}

/**显示选中的分类
*/
function showitem(){
	var outObj = da("#out_pad"),
		strHTML = '';
		
	for( var k in g_chkItems ){
		strHTML += '<div class="item" ondblclick="cancelitem('+ g_chkItems[k].at_id +')">'+ g_chkItems[k].at_name +'</div>';
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
	delete g_chkItems;
	g_chkItems = {};
	showitem();
}

daLoader("daMsg,daIframe", function(){
	da(function(){
		arrParams = da.urlParams();
		g_ismulti = !!arrParams["ismulti"];
		//alert(g_prid);
		
		loadtree();
	});

});
//-->