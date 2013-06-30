<?php /* Smarty version Smarty-3.1.13, created on 2013-06-28 01:11:02
         compiled from "D:\work\daCMS\web\article\_sys_articlecomment.htm" */ ?>
<?php /*%%SmartyHeaderCode:1934551c993c4ceed31-92053264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfbfb872708e295a32c4c5fccc76eed9204bff4f' => 
    array (
      0 => 'D:\\work\\daCMS\\web\\article\\_sys_articlecomment.htm',
      1 => 1372353061,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1934551c993c4ceed31-92053264',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c993c4cff115_66098475',
  'variables' => 
  array (
    'url' => 0,
    'puname' => 0,
    'pucode' => 0,
    'article' => 0,
    'pager_Total' => 0,
    'commentlist' => 0,
    'pager_Number' => 0,
    'pager_Prev' => 0,
    'pager_Links' => 0,
    'pager_Next' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c993c4cff115_66098475')) {function content_51c993c4cff115_66098475($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\work\\daCMS\\action\\smarty\\plugins\\modifier.date_format.php';
?>
<div class="cmtBox clearfix" id="cmtBox">
	<div class="tit02" id="banner">网友评论</div>
	
	<!-- 分享代码 -->
 	<div id="sns">
		<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare share">
			<a class="bds_tsina" title="分享到新浪微博" href="#"></a>
			<a class="bds_tqq" title="分享到腾讯微博" href="#"></a>
			<a class="bds_t163" title="分享到网易微博"></a>
			<a class="bds_qzone" title="分享到QQ空间" href="#"></a>
			<a class="bds_renren" title="分享到人人网"></a>
			<span class="bds_more">更多</span>
		</div>
		<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6695170" ></script>
		<script type="text/javascript" id="bdshell_js"></script>
		<script type="text/javascript">
		document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
		</script>
	</div>
	<!--/ 分享代码 -->
	
	<div class="commentLoginBox clearfix">
		<div class="commentLogin clearfix" id="cmtInput">
			<form action="<?php echo fn_urlstatic(array('url'=>''),$_smarty_tpl);?>
" method="post" id="spec_frm">
				<input type="hidden" name="backurl" id="specBackUrl" value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
				<div id="specLogin">
					
					<label style="vertical-align:middle">用户名</label><input id="spec_uname" name="uname"/>&nbsp;&nbsp;
					<label style="vertical-align:middle">密码</label><input id="spec_pass" type="password" name="pass" />
					
					<input type="submit" id="cmtfrmbutton" class="btn" value="登 录" />
					<input type="button" class="btn" value="注 册" />
				</div>
				<div class="userInfo" id="specLogined"><em><?php echo $_smarty_tpl->tpl_vars['puname']->value;?>
</em> ( <?php echo $_smarty_tpl->tpl_vars['pucode']->value;?>
 ) </div>
			</form>
		
			<form action="<?php echo fn_urlstatic(array('url'=>'action/comment_add_item.php'),$_smarty_tpl);?>
" method="post" target="_blank">
				<textarea name="c_content" id="c_content" class="content"></textarea>
				
				<input type="hidden" name="srcid" id="srcid" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['a_id'];?>
"/>
				<input type="hidden" name="srctitle" id="srctitle" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['a_title'];?>
"/>
				<input type="hidden" name="srcurl" id="srcurl"  value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"/>
				<input type="submit" id="submitForm" class="btn" value="发表评论" />
			</form>
		
		</div>
		
		<div class="view">
			<a href="javascript:void(0);">共有<span id="specAllCmt01" class="cRed"><?php echo $_smarty_tpl->tpl_vars['article']->value['a_count'];?>
</span>人参与</a>　
			<a href="javascript:void(0);">评论<span id="specCmt01" class="cRed"><?php echo $_smarty_tpl->tpl_vars['pager_Total']->value;?>
</span>条</a>
		</div>
		<div id="cmtlistdiv" class="commentlist clearfix">
			<!-- 评论列表 -->
			<div>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['name'] = "list";
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['commentlist']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = (int)$_smarty_tpl->tpl_vars['pager_Total']->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total']);
?>
				<div style="margin:20px 0px;">
					<span><?php echo $_smarty_tpl->tpl_vars['commentlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['v_code'];?>
</span>
					- <span><?php echo $_smarty_tpl->tpl_vars['commentlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['c_content'];?>
</span>
					- <span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['commentlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['c_date'],'%Y-%m-%d');?>
</span>
				</div>
			<?php endfor; endif; ?>
			</div>

			<div class="daPage">
			总共<?php echo $_smarty_tpl->tpl_vars['pager_Total']->value;?>
条，共<?php echo $_smarty_tpl->tpl_vars['pager_Number']->value;?>
页，<?php echo $_smarty_tpl->tpl_vars['pager_Prev']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Links']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Next']->value;?>

			</div>
			<!--/ 评论列表 -->
		</div>
		
	</div>
	
</div><?php }} ?>