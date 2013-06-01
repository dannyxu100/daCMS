<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<title>文件编辑</title>
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/plugin/codemirror/codemirror.css"/>
	<link rel="stylesheet" href="/plugin/codemirror/night.css"/>
	<link rel="stylesheet" href="/plugin/codemirror/solarized.css"/>
	<link rel="stylesheet" href="/plugin/codemirror/ambiance.css"/>
	
    <style type="text/css">
		.codepad {
			height:490px;
			overflow-y: auto;
		}
		
		.CodeMirror {
			border: 1px solid #eee;
			height: auto;
			font-size: 14px;
		}
		.CodeMirror-scroll {
			overflow-y: hidden;
			overflow-x: auto;
		}
		
    </style>
</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title"><input type="text" id="filepath" disabled="false" style="width:400px;"/></div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savefile()" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<div class="codepad">
		<textarea id="codearea" style="width:100%" ></textarea>
	</div>
</body>
</html>

<script src="/plugin/codemirror/codemirror.js"></script>
<script src="/plugin/codemirror/htmlmixed.js"></script>
<script src="/plugin/codemirror/javascript.js"></script>
<script src="/plugin/codemirror/css.js"></script>
<script src="/plugin/codemirror/xml.js"></script>
<script src="/plugin/codemirror/clike.js"></script>
<script src="/plugin/codemirror/php.js"></script>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/edit_file.js"></script>