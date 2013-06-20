
function kwpm( item ){
	var html = [], num = 0;
	
	for( var n in item.res ){
		if( !da.isNumeric(n) ){
			continue;
		}
	
		num = parseInt(n) + 1 + item.pagenum;
		html.push('<a href="javascript:void(0)">'+ num +'</a>');
	}
	
	return html.join(", ");
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
	da.runDB("action/keywords.php", {
		dataType: "json",
		domain: da("#domain").val(),
		keys: da("#keywords").val(),
		engine: da("#engine").val(),
		rn: da("#rn").val()
		
	},function( data ){
		g_runing = false;
		
		if( null == data){
			alert("对不起，操作失败，数据量太大，导致超时。");
			loading(false);
		}
		
		if("FALSE" != data ){
			var html = [], item;
			
			html.push([
				'<table class="grid" style="text-align:center;">',
					'<tr>',
						'<td style="width:120px;background:#f0f0f0;">关键词</td>',
						'<td style="width:220px;background:#f0f0f0;">排名</td>',
						'<td style="width:100px;background:#f0f0f0;">密度</td>',
					'</tr>'
			].join(""));
			
			for( var i=0; i<data.keys.length; i++ ){
				item = [
					'<tr>',
						'<td>', data.keys[i], '</td> ',
						'<td>', kwpm( data.seo[i] ), '</td> ',
						'<td>0</td> ',
					'</tr>'
				];
				
				html.push( item.join("") );
			}
		
			html.push('</table>');
			
			da("#seo_pad").html( html.join("") );
			autoframeheight();
			loading(false);
		}
		
	},function(res, msg, ex){
		// debugger;
		g_runing = false;
	});
}



daLoader("daMsg,daLoading,daIframe,daWin,daKey",function(){
	da(function(){
		
	});
});
