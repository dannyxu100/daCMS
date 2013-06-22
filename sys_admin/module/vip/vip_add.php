<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
  <TITLE>添加会员</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">会员信息</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="showsimple(this);" >完全模式</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savevip();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<div id="form_register"></div>
	
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/vip_add.js"></script>

