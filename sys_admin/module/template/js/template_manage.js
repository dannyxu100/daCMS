
/**还原模板
*/
function restoretemplate(){
	loading(true);

	da.runDB("/sys_admin/module/template/action/template_restore.php",{
		dataType: "json"
		
	},function( data ){
		if("FALSE"!= data){
			alert("还原成功。");
			
			loadtemplateinfo();
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**备份模板
*/
function backuptemplate(){
	loading(true);

	da.runDB("/sys_admin/module/template/action/template_backup.php",{
		dataType: "json"
		
	},function( data ){
		if("FALSE"!= data){
			alert("备份成功。");
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**显示图片函数，根据接收的index值显示相应的内容
*/
function showPics( idx ) {
	var nowLeft = -idx * $("#focus").width();	//根据index值计算ul元素的left值
	$("#focus ul").stop(true,false).animate({"left":nowLeft},300); 		//通过animate()调整ul元素滚动到计算出的position
	//$("#focus .btn span").removeClass("on").eq(idx).addClass("on"); 	//为当前的按钮切换到选中的效果
	$("#focus .btn span").stop(true,false).animate({"opacity":"0.4"},300).eq(idx).stop(true,false).animate({"opacity":"1"},300); //为当前的按钮切换到选中的效果
}

var g_idx = 0,
	g_picTimer;
/**加载图片切换插件
*/
function loadslider(){
	g_idx = 0;
	if( g_picTimer ){
		clearInterval(g_picTimer);
	}
	
	var sWidth = $("#focus").width();			//获取焦点图的宽度（显示面积）
	var len = $("#focus ul li").length; 		//获取焦点图个数
	
	var btn = "<div class='btnBg'></div><div class='btn'>";		//以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
	for(var i=0; i < len; i++) {
		btn += "<span></span>";
	}
	btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
	$("#focus").append(btn);
	$("#focus .btnBg").css("opacity",0.5);

	$("#focus .btn span").css("opacity",0.4).mouseover(function() {	//为小按钮添加鼠标滑入事件，以显示相应的内容
		g_idx = $("#focus .btn span").index(this);
		showPics(g_idx);
	}).eq(0).trigger("mouseover");

	$("#focus .preNext").css("opacity",0.2).hover(function() {		//上一页、下一页按钮透明度处理
		$(this).stop(true,false).animate({"opacity":"0.5"},300);
	},function() {
		$(this).stop(true,false).animate({"opacity":"0.2"},300);
	});

	$("#focus .pre").click(function() {		//上一页按钮
		g_idx -= 1;
		if(g_idx == -1) {g_idx = len - 1;}
		showPics(g_idx);
	});

	$("#focus .next").click(function() {	//下一页按钮
		g_idx += 1;
		if(g_idx == len) {g_idx = 0;}
		showPics(g_idx);
	});

	$("#focus ul").css("width",sWidth * (len));		//左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
	
	$("#focus").hover(function() {					//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
		clearInterval(g_picTimer);
		
	},function() {
		g_picTimer = setInterval(function() {		//此4000代表自动播放的间隔，单位：毫秒
			showPics(g_idx);
			g_idx++;
			if(g_idx == len) {g_idx = 0;}
			
		},4000);
		
	}).trigger("mouseleave");
	
}

/**加载当前模板配置信息
*/
function loadtemplateinfo(){
	loading(true);
	
	da.runDB("/sys_admin/module/template/action/template_get_config.php",{
		dataType: "json"
		
	},function( data ){
		if("FALSE"!= data){
			for(var key in data){
				switch( key ){
					case "tl_images":
						if( 0 < data.tl_images.length ){
							var slider = ['<ul>'];
								
							for(var i=0; i<data.tl_images.length; i++){
								slider.push('<li><img src="/web/_sys_templateinfo/images/'+ data.tl_images[i] +'" /></li>');
							}
							
							slider.push('</ul>');
							da("#focus").html( slider.join('') );
						}
						break;
					case "tl_name":
					case "tl_code":
					case "tl_url":
						da("#"+key ).html('<a href="'+ data.tl_url +'" target="_blank">'+ data[key] +'</a>');
						break;
					default:
						da("#"+ key).text( data[key] );
				}
			}
			
			
			loadslider();
			autoframeheight();
			
			loading(false);
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daIframe,daWin,daToolbar,daKey",function(){
	da(function(){
		loadtemplateinfo();
	});
});
