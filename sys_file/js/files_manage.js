var g_dir = "";

var g_filetype = {
	def: "/images/file_icon/unknown.png",
	folder: "/images/file_icon/folder.png",
	
	html: "/images/file_icon/html.png",
	htm: "/images/file_icon/html.png",
	php: "/images/file_icon/php.png",
	js: "/images/file_icon/js.png",
	css: "/images/file_icon/css.png",
	sql: "/images/file_icon/sql.png",
	xml: "/images/file_icon/xml.png",
	txt: "/images/file_icon/text.png",
	log: "/images/file_icon/log.png",
	
	jpg: "/images/file_icon/jpg.png",
	gif: "/images/file_icon/gif.png",
	png: "/images/file_icon/png.png",
	bmp: "/images/file_icon/bmp.png",
	
	rar: "/images/file_icon/rar.png",
	zip: "/images/file_icon/zip.png",
	gzip: "/images/file_icon/gzip.png",
	tar: "/images/file_icon/tar.png",
	pdf: "/images/file_icon/pdf.png",
	rtf: "/images/file_icon/rtf.png",
	doc: "/images/file_icon/doc.png",
	docx: "/images/file_icon/doc.png",
	
	psd: "/images/file_icon/psd.png",
	mp3: "/images/file_icon/playlist.png",
	flv: "/images/file_icon/video.png",
	mp4: "/images/file_icon/video.png",
	avi: "/images/file_icon/video.png",
	swf: "/images/file_icon/video.png",
};

var g_edittype = {
	php: true,
	htm: true,
	html: true,
	css: true,
	js: true,
	log: true,
	txt: true,
	sql: true
};

/**删除文件
*/
function deletefile( dir, filename ){
	confirm("你确定要删除文件 \""+ decodeURIComponent(filename) +"\" 吗？<span style='color:#f00'>(一旦删除，将不能恢复)</span>", 
	function(){
		da.runDB("/sys_file/action/file_delete_item.php", {
			dir: dir,
			filename: filename
			
		},function(res){
			if("FALSE"!= res){
				alert("文件删除成功");
				loadlist();
			}
			
		},function(code,msg,ex){
			// debugger;
		});
	});
	
}

/**编辑文件
*/
function editfile( dir, filename, filetype ){
	daWin({
		width: 800,
		height: 600,
		title: "文件编辑",
		url: '/sys_file/edit_file.php?dir='+ dir +'&filename='+ filename +'&filetype='+ filetype
	});
}

/**跳转目录
*/
function nextdir( dir ){
	g_dir = dir;
	loadlist();
}

/**加载文件列表
*/
function loadlist(){
	var data1 = {
			dataType: "json",
			opt: "qry",
			currentdir: g_dir
		};

	daTable({
		id: "tb_list",
		url: "/sys_file/action/files_get_list.php",
		data: data1,
		//loading: false,
		// page: false,
		pageSize: 9999,
		
		field: function( fld, val, row, ds ){
			switch(fld){
				case "f_name":
					if( "current"==val ){
						val = '<span style="color:#999;">'+ row.dir +'</span>';
						break;
					}
					else if( "root"==val ){
						val = '<span style="color:#999;">网站根目录</span>';
						break;
					}
					else if( "back"==val ){
						val = "上一级目录";
					}
					
					if( "folder" == row.f_type ){
						val = '<a href="javascript:void(0)" onclick="nextdir(\''+ encodeURIComponent(row.dir) +'\')" >'+ val +'</a>';
					}
					break;
					
				case "f_type":
					val = '<img src="'+ (g_filetype[val]?g_filetype[val]:g_filetype["def"]) +'" style="vertical-align:middle;" /> ';
					break;
					
				case "f_size":
					val = '<span style="color:#999">'+ val +'</span>';
					break;
					
				case "tools":
					if( "folder" != row.f_type && g_edittype[row.f_type] ){
						val = '<a class="bt_link" href="javascript:void(0)" onclick="editfile(\''
						+ encodeURIComponent(row.dir) +'\', \''
						+ encodeURIComponent(row.f_name) +'\', \''
						+ row.f_type +'\' )"><img src="/images/menu_icon/edit.png" /> 编辑</a>';
						
						val += '<a class="bt_link" href="javascript:void(0)" onclick="deletefile(\''
						+ encodeURIComponent(row.dir) +'\', \''
						+ encodeURIComponent(row.f_name) +'\' )"><img src="/images/sys_icon/delete.png" /> 删除</a>';
					}
					break;
			}
	
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			autoframeheight();
		},
		error: function( msg, code, content ){
			// debugger;
		}
	}).load();

}

daLoader("daMsg,daTable,daWin,daIframe", function(){
	/*页面加载完毕*/
	da(function(){
		debugger;
		loadlist();
	});
});
