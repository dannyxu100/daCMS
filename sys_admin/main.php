<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<title>后台首页</title>
	<link rel="icon" href="/images/ico.gif" type="image/x-icon" />
	<link rel="stylesheet" href="/css/base.css"/>


	</head>
<body>
	<table id="tb_form" class="grid" style="width:900px; margin:20px auto;font-size:14px;">
		<tr>
			<td colspan="4" style="font-size:22px; line-height:50px; font-weight:bold; text-align:center;">网站服务器信息</td>
		</tr>
		<tr>
			<td class="header" style="width:120px;">服务器域名</td>
			<td style="width:300px;"><?php echo $_SERVER["HTTP_HOST"] ?></td>
			<td class="header" style="width:120px;">服务器语言</td>
			<td><?php echo $_SERVER["HTTP_ACCEPT_LANGUAGE"] ?></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td class="header">操作系统类型</td>
			<td><?php echo php_uname('s') ?></td>
			<td class="header">操作系统版本</td>
			<td><?php echo php_uname('r') ?></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td class="header">PHP运行方式</td>
			<td><?php echo $_SERVER["SERVER_SOFTWARE"]?></td>
			<td class="header">PHP版本</td>
			<td><?php echo PHP_VERSION ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td class="header">MySQL版本</td>
			<td><?php echo mysql_get_server_info() ?></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td class="header" style="width:120px;">远程文件获取</td>
			<td><?php echo ini_get("allow_url_fopen") ? "支持" : "不支持" ?></td>
			<td class="header">最大上传限制</td>
			<td><?php echo ini_get("file_uploads") ? ini_get("upload_max_filesize") : "不允许上传" ?></td>
		</tr>
		<tr>
			<td class="header" style="width:120px;">脚本最大执行时间</td>
			<td><?php echo ini_get("max_execution_time")."秒" ?></td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td class="header" style="width:120px;">服务器IP</td>
			<td><?php echo GetHostByName($_SERVER['SERVER_NAME']) ?></td>
			<td class="header" style="width:120px;">Web端口</td>
			<td><?php echo $_SERVER['SERVER_PORT'] ?></td>
		</tr>
		<tr>
			<td class="header">您的IP</td>
			<td><?php echo $_SERVER['REMOTE_ADDR'] ?></td>
			<td class="header">服务器时间</td>
			<td><?php date_default_timezone_set("Etc/GMT-8"); echo date("Y-m-d H:i:s",time()) ?></td>
		</tr>
	</table>
	
</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/index.js"></script>
