
var g_status = "RUN";

function savevip(){
	if( !daValid.all() ){
		return;
	}

	da.runDB("/sys_admin/module/vip/action/vip_add_item.php",{
		v_name: da("#v_name").val(),
		v_code: da("#v_code").val(),
		v_pwd: da("#v_pwd").val(),
		v_phone: da("#v_phone").val(),
		v_telephone: da("#v_telephone").val(),
		v_address: da("#v_address").val(),
		v_email: da("#v_email").val(),
		v_qq: da("#v_qq").val(),
		v_remark: da("#v_remark").val()
		
	},function( res ){
		if( "FALSE" != res ){
			alert("添加成功。");
		}
		else{
			alert("操作失败");
		}
	},function(code,msg,ex){
		// debugger;
	});
}

/**访客模式
*/
function showsimple( obj ){
	var btobj = da(obj);
	
	if( "访客模式" == btobj.text() ){
		da(obj).text("完全模式");
		
		g_status = "RUN";
		loadregisteritem();
	}
	else{
		da(obj).text("访客模式");
		
		g_status = "";
		loadregisteritem();
	}
}

/**格式化注册项
*/
function formatitem( column, items ){
	var html = "";
	
	if( "" == column.vr_items ) {
		if( /^int.*$/ig.test( column.vr_type ) ){				//整数型注册项
			html = '<input id="'+ column.vr_field +'" type="text" valid="int'+ (column.vr_ismust?',false':'') +'" validinfo="不能为空" />' 
		}
		else if( /^float.*$/ig.test( column.vr_type ) ){		//浮点型注册项
			html = '<input id="'+ column.vr_field +'" type="text" valid="float'+ (column.vr_ismust?',false':'') +'" />';
		}
		else if( /^datetime$/ig.test( column.vr_type ) ){		//日期型注册项
			html = '<input id="'+ column.vr_field +'" type="text" fmt="date" />';
		}
		else if( /^text$/ig.test( column.vr_type ) ){			//大文本注册项
			html = '<textarea id="'+ column.vr_field +'" style="width:200px; height:100px;" ></textarea>';
		}
		else if( /^varchar\(\d*\)$/ig.test( column.vr_type ) ){	//短文本注册项
			html = '<input id="'+ column.vr_field +'" type="text" valid="anything'+ (column.vr_ismust?',false':'') +'" />';
		} 
		
		html += ( column.vr_ismust ? '<span class="must">*</span>' : '');
	}
	else {
		var list = items[ column.vr_items ];

		if( "未配置可选项" == list ){	//未配置可选项
			html = '<span style="color:#aaa">'+ list +'</span>';
		}
		else {							//加载可选项
			var arr = [];
			
			if( "varchar(200)" == column.vr_type ){				//下拉注册项
				html = '<select id="'+ column.vr_field +'" >';
				for( var i=0; i<list.length; i++ ){		
					arr.push('<option value="'
					+ list[i].i_value +'" '
					// + ( 0 == i ? ' selected="selected" ' : '' ) 
					+'>'
					+ list[i].i_name +'</option>');
				}
				html += arr.join("");
				html += '</select>';
			}
			else {												//单选、复选注册项
				for( var i=0; i<list.length; i++ ){		
					arr.push('<label style="margin-right:10px;"><input name="'
						+ column.vr_field +'" type="'
						+ ( "varchar(300)" == column.vr_type ? 'radio' : 'checkbox') 
						+'" value="'
						+ list[i].i_value +'" '
						/* + ( 0 == i ? ' checked="checked" ' : '' )  */
						+ '/> '
						+ list[i].i_name +'</label>');
				}
				html = arr.join("");
			}
			
		}
	}
	
	return html;
}

/**加载注册项
*/
function loadregisteritem(){
	loading(true);
	
	var data = {
		dataType: "json"
	};
	
	if( "" != g_status ){
		data["vr_status"] = g_status;
	}
	
	da.runDB("/sys_admin/module/vip/action/registeritem_get_list.php", data
	,function( data ){
		if( data && data.column ){
			var html = [], item;
			
			html.push('<table class="grid" style="width:100%">');
			
			for( var i=0; i<data.column.length; i++ ){
				item = [
					'<tr>',
						'<td class="header" ', ( 0 == i ? ' style="width:80px;" ' : '' ), '>', data.column[i].vr_name, '</td> ',
						'<td>', formatitem( data.column[i], data.items ), '</td> ',
					'</tr>'
				];
				
				html.push( item.join("") );
			}
		
			html.push('</table>');
			da("#form_register").html( html.join("") );
			
			autoframeheight();
			loading(false);
		}
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daLoading,daValid,daIframe,daWin", function(){
	da(function(){
		loadregisteritem();
		
	});
});