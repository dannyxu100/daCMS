
/**显示隐藏详细面板
*/
function showdetail( obj ){
	var listobj = da(obj).next();
	
	if( listobj.is(":hidden") ){
		listobj.show();
		da(obj).text("[点击收起]");
	}
	else{
		listobj.hide();
		da(obj).text("[查看详细]");
	}
	
	autoframeheight();
}

function kwpm( obj ){
	var html=[], orderlist=[], detaillist=[], num = 0, first=0;
	
	for( var n in obj.items ){
		if( !da.isNumeric(n) ){
			continue;
		}
		
		num = parseInt(n) + 1 + obj.pagenum;		//排名 = 行索引值 + 1 + 当页起始值
		
		if( 0 == first ){		//当前关键词，最靠前排名
			first = num;
		}
		
		var link = 'http://www.baidu.com/s?wd='+ obj.keyword +"&rn="+ obj.rownum +"&pn="+ (parseInt(parseInt(n)/10)*10) +"#"+ num;
		orderlist.push('<a href="'+ link +'" target="_blank" title="'+ obj.items[n].title +'" >'+ (10>=num?('<span style="color:#900;font-weight:bold">'+num+'</span>'):num) +'</a>');
		detaillist.push([
			'<li style="list-style:none;">',
				num, " - ", obj.items[n].title,
				" - ", '<a href="'+ obj.items[n].href +'" target="_blank">(网页)</a>',
				" - ", '<a href="'+ link +'" target="_blank">(搜索引擎)</a>',
			'</li>'
		].join(""));
	}
	html.push( orderlist.join(", ") );
	html.push([
		'<a href="javascript:void(0)" onclick="showdetail(this)" style="color:#ccc;margin-left:20px;">[查看详细]</a>',
		'<div style="display:none; position:relative;">',
			'<div class="detaillist daShadow" style="position:absolute; top:0px; left:0px; width:100%; padding:5px; border:1px solid #444;background:#fff;">', 
				detaillist.join(""), 
			'</div>',
		'</div>'
	].join(""));
	
	return {
		first: first,
		html: 0 < orderlist.length ? html.join("") : '<span style="color:#ccc">'+da("#rn").val()+'名后</span>'
	}
}

/**获取数据
*/
function getdata( idx, keyword, fn, fnerror ){
	da.runDB("action/keywords.php", {
		dataType: "json",
		domain: da("#domain").val(),
		engine: da("#engine").val(),
		rn: da("#rn").val(),
		keys: keyword
		
	},function( data ){
		fn( idx, data );
		
	},function(res, msg, ex){
		fnerror(res, msg, ex);
	});
}

var g_runing = false;
/**关键词排名查询
*/
function seosearch(){
	// window.open('keys/keys.php?domain='+getid('s').value+'&keys='+getid('kw').value+'&val='+getid('ctl00_Main_SEnginType').value);
	if( g_runing ){
		alert("拜托，请不要重复执行查询，遭不住。");
		return;
	}
	
	g_runing = true;
	
	loading(true);
	
	var keywords = da("#keywords").val();
	keywords = keywords.replace(/,| |　|，|，]/ig, ",").trim();
	keywords = keywords.split(",");
	keywords = keywords.distinct();		//去除重复关键词

	da("#seo_pad").html([
		'<table id="seo_keywordlist" class="grid" style="width:100%">',
			'<tbody class="header">',
				'<tr>',
					'<td style="width:120px;background:#f0f0f0;">关键词</td>',
					'<td style="background:#f0f0f0;">排名</td>',
					'<td style="width:200px;background:#f0f0f0;">密度</td>',
				'</tr>',
			'</tbody>',
			'<tbody class="body"></tbody>',
			'<tbody class="body_out"></tbody>',
		'</table>'
	].join(""));
	autoframeheight();
	
	var listbody = da(".body", "#seo_keywordlist"), 
		listbody_out = da(".body_out", "#seo_keywordlist"), 
		listfrist = [],
		item = "", 
		kwpmobj = null;
	
	for( var i=0; i<keywords.length; i++ ){
		getdata( i, keywords[i], 
		function( idx, data ){
			// debugger;
			if( null == data){
				alert("对不起，操作失败，数据量太大，导致超时。");
			}
			
			if("FALSE" != data ){
				for( var j=0; j<data.keys.length; j++ ){
					kwpmobj = kwpm( data.result[j] );
					
					item = [
						'<tr class="', kwpmobj.first,'">',
							'<td style="text-align:center; vertical-align:top;">', data.keys[j], '</td> ',
							'<td>', kwpmobj.html, '</td> ',
							'<td>&nbsp;</td> ',
						'</tr>'
					].join("");
				}
				
				if( 0 == kwpmobj.first ){		//排名不在查询范围内，直接添加在最后
					listbody_out.append( item );
				}
				else{							//排名在范围内，要进行排序显示
					var is_insert = false;
					
					for( var k in listfrist ){			//查找比自己排名大的关键词，找到后插入在其前面
						if( k > kwpmobj.first ){
							da("." + k, listbody).eq(0).before( item );
							listfrist[kwpmobj.first] = true;
							is_insert = true;
							break;
						}
					}
					
					if( !is_insert ){
						listbody.append( item );
						listfrist[kwpmobj.first] = true;
					}
				}
				
			}
			
			if( keywords.length-1 == idx ){			//最后一个关键词
				g_runing = false;
				loading(false);
			}
			autoframeheight();
		},
		function(res, msg, ex){
			// debugger;
			alert(msg);
			g_runing = false;
		});
	}
	
}



daLoader("daMsg,daLoading,daIframe,daWin,daKey",function(){
	da(function(){
		
	});
});
