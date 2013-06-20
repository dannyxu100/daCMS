
/**加载菜单
*/
function seosearch(){
	// window.open('keys/keys.php?domain='+getid('s').value+'&keys='+getid('kw').value+'&val='+getid('ctl00_Main_SEnginType').value);
	
	da.runDB("action/keywords.php", {
		dataType: "json",
		domain: da("#domain").val(),
		keys: da("#keywords").val(),
		engine: da("#engine").val(),
		rn: da("#rn").val()
		
	},function(data){
		if("FALSE" != data ){
			debugger;
			da("#seo_pad").html( data.result );
		}
		
	},function(res, msg, ex){
		debugger;
	});
}



daLoader("daMsg,daIframe,daWin,daKey",function(){
	da(function(){
		
	});
});
