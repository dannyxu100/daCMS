//ASCII 转换 Unicode
function AsciiToUnicode() {
	if (parseFloat(ScriptEngineMajorVersion() + '.' + ScriptEngineMinorVersion()) < 5.5){ 
	alert('您的脚本引擎版本过低，请升级为5.5以上'); 
	return; 
	}
	if (content.value == '') { 
	alert('文本框中没有代码！'); 
	return; 
	}
	result.value = '';
	for (var i=0; i<content.value.length; i++)
	result.value += '&#' + content.value.charCodeAt(i) + ';';
	document.getElementById('content').focus();
}

//Unicode 转换 ASCII
function UnicodeToAscii() { 
	var code = content.value.match(/&#(\d+);/g);
	if (code == null) { 
	alert('文本框中没有合法的Unicode代码！'); document.getElementById('content').focus();
	return; 
	}
	result.value = '';
	for (var i=0; i<code.length; i++)
	result.value += String.fromCharCode(code[i].replace(/[&#;]/g, ''));
	document.getElementById('content').focus();
}
function preview() {
	var win = window.open();
	win.document.open('text/html', 'replace');
	win.document.writeln(result.value);
	win.document.close();
}

function copy(obj)
{
  var Result=document.getElementById(obj).value;
  if(Result=="")
  {
    return ;
  }
  else 
  {
  window.clipboardData.setData("Text",Result); 
  document.getElementById(obj).select(); 
  window.alert('已复制成功。');
  }
}