-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 06 月 01 日 00:02
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dacms`
--

-- --------------------------------------------------------

--
-- 表的结构 `p_admin`
--

DROP TABLE IF EXISTS `p_admin`;
CREATE TABLE IF NOT EXISTS `p_admin` (
  `pa_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `pa_code` varchar(50) NOT NULL COMMENT '管理员账号',
  `pa_pwd` varchar(50) NOT NULL COMMENT '管理员密码',
  `pa_name` varchar(20) NOT NULL COMMENT '管理员名称',
  `pa_icon` text NOT NULL COMMENT '管理员头像',
  PRIMARY KEY (`pa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='超级管理员' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `p_admin`
--

INSERT INTO `p_admin` (`pa_id`, `pa_code`, `pa_pwd`, `pa_name`, `pa_icon`) VALUES
(1, 'dacms', 'd6614210ba093b21425dfffb9312cff2', 'dacms', '/uploads/adminico/dacms_1.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `p_menu`
--

DROP TABLE IF EXISTS `p_menu`;
CREATE TABLE IF NOT EXISTS `p_menu` (
  `pm_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `pm_pid` int(10) NOT NULL COMMENT '菜单父id',
  `pm_name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '菜单名',
  `pm_level` int(10) NOT NULL COMMENT '菜单级别',
  `pm_sort` int(10) NOT NULL COMMENT '排序',
  `pm_url` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '页面链接地址',
  `pm_img` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '图标文件地址',
  `pm_remark` text CHARACTER SET utf8 NOT NULL COMMENT '备注',
  PRIMARY KEY (`pm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='系统菜单表' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `p_menu`
--

INSERT INTO `p_menu` (`pm_id`, `pm_pid`, `pm_name`, `pm_level`, `pm_sort`, `pm_url`, `pm_img`, `pm_remark`) VALUES
(1, 0, 'daCMS后台菜单', -1, 999, '', '', ''),
(4, 1, '系统配置', 1, 999, '/sys_power/index.php?menu=4', '/images/menu_icon/setting.png', ''),
(5, 1, '内容管理', 1, 20, '/sys_power/index.php?menu=5', '/images/menu_icon/desk.png', ''),
(6, 4, '用户管理', 2, 0, '/sys_power/user_manage.php', '/images/menu_icon/user.png', ''),
(7, 4, '角色管理', 2, 10, '/sys_power/role_manage.php', '/images/menu_icon/role.png', ''),
(11, 1, '导航管理', 1, 10, '/sys_nav/nav_manage.php', '/images/menu_icon/business.png', ''),
(12, 5, '文章管理', 2, 1, '/sys_article/article_manage.php', '', ''),
(13, 5, '产品管理', 2, 10, '', '/images/menu_icon/box.png', ''),
(14, 5, '案例管理', 2, 30, '', '/images/menu_icon/gift.png', ''),
(18, 4, '操作日志', 2, 999, '', '/images/menu_icon/keytype.png', ''),
(19, 1, '会员管理', 1, 30, '/sys_power/index.php?menu=19', '/images/menu_icon/user.png', ''),
(20, 19, '会员信息', 2, 1, '', '/images/menu_icon/user.png', ''),
(21, 19, '留言信息', 2, 10, '', '/images/menu_icon/comment_edit.png', ''),
(22, 1, '在线订单', 1, 40, '', '/images/menu_icon/form.png', ''),
(23, 4, '网站配置', 2, 998, '/sys_admin/webconfig.php', '/images/menu_icon/module.png', ''),
(25, 19, '评论信息', 2, 20, '', '/images/menu_icon/comment.png', ''),
(26, 5, '图片管理', 2, 40, '', '', ''),
(27, 4, '文章采集', 2, 997, '/sys_collect/collect_manage.php', '/images/menu_icon/database_refresh.png', ''),
(29, 1, '后台首页', 1, 0, '', '', ''),
(30, 4, '文件管理', 2, 30, '/sys_file/files_manage.php', '/images/menu_icon/new.png', '');

-- --------------------------------------------------------

--
-- 表的结构 `p_menu2role`
--

DROP TABLE IF EXISTS `p_menu2role`;
CREATE TABLE IF NOT EXISTS `p_menu2role` (
  `m2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单角色映射id',
  `m2r_pmid` int(10) NOT NULL COMMENT '菜单id',
  `m2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`m2r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单角色映射表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `p_menu2role`
--

INSERT INTO `p_menu2role` (`m2r_id`, `m2r_pmid`, `m2r_prid`) VALUES
(8, 11, 2),
(9, 12, 2),
(10, 5, 2),
(11, 13, 2);

-- --------------------------------------------------------

--
-- 表的结构 `p_role`
--

DROP TABLE IF EXISTS `p_role`;
CREATE TABLE IF NOT EXISTS `p_role` (
  `pr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `pr_pid` int(10) NOT NULL COMMENT '父级角色id',
  `pr_name` varchar(50) NOT NULL COMMENT '角色名称',
  `pr_sort` int(10) NOT NULL COMMENT '排序',
  `pr_date` datetime NOT NULL COMMENT '角色创建时间',
  `pr_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `p_role`
--

INSERT INTO `p_role` (`pr_id`, `pr_pid`, `pr_name`, `pr_sort`, `pr_date`, `pr_remark`) VALUES
(1, -1, 'daCMS用户角色', 0, '0000-00-00 00:00:00', ''),
(2, 1, '信息管理员', 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- 表的结构 `p_user`
--

DROP TABLE IF EXISTS `p_user`;
CREATE TABLE IF NOT EXISTS `p_user` (
  `pu_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id号',
  `pu_oid` int(10) NOT NULL COMMENT '所属组织id号',
  `pu_code` varchar(50) NOT NULL COMMENT '账号',
  `pu_pwd` varchar(50) NOT NULL COMMENT '密码',
  `pu_name` varchar(20) NOT NULL COMMENT '姓名',
  `pu_icon` text NOT NULL COMMENT '用户头像图片地址',
  `pu_gender` varchar(4) NOT NULL COMMENT '性别',
  `pu_phone` varchar(50) NOT NULL COMMENT '手机',
  `pu_telephone` varchar(50) NOT NULL COMMENT '电话',
  `pu_address` varchar(500) NOT NULL COMMENT '地址',
  `pu_email` varchar(200) NOT NULL COMMENT '用户电子邮箱',
  `pu_qq` varchar(50) NOT NULL COMMENT '用户qq号码',
  `pu_lastlogin` datetime NOT NULL COMMENT '最后一次登陆系统',
  `pu_logincount` int(11) NOT NULL COMMENT '登陆系统次数',
  `pu_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `p_user`
--

INSERT INTO `p_user` (`pu_id`, `pu_oid`, `pu_code`, `pu_pwd`, `pu_name`, `pu_icon`, `pu_gender`, `pu_phone`, `pu_telephone`, `pu_address`, `pu_email`, `pu_qq`, `pu_lastlogin`, `pu_logincount`, `pu_remark`) VALUES
(2, 0, 'xufei', 'c4ca4238a0b923820dcc509a6f75849b', '徐飞', '/uploads/userico/徐飞_2.jpg', '', '', '', '', '', '', '2013-05-31 20:51:12', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `p_user2role`
--

DROP TABLE IF EXISTS `p_user2role`;
CREATE TABLE IF NOT EXISTS `p_user2role` (
  `u2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射角色id',
  `u2r_puid` int(10) NOT NULL COMMENT '用户id',
  `u2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`u2r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户映射角色表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `p_user2role`
--

INSERT INTO `p_user2role` (`u2r_id`, `u2r_puid`, `u2r_prid`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `sys_collect`
--

DROP TABLE IF EXISTS `sys_collect`;
CREATE TABLE IF NOT EXISTS `sys_collect` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '采集文章id',
  `c_rid` int(10) NOT NULL COMMENT '采集规则id',
  `c_url` varchar(2000) NOT NULL COMMENT '采集网址',
  `c_title` varchar(500) NOT NULL COMMENT '文章标题',
  `c_keywords` varchar(2000) NOT NULL COMMENT '文章关键词',
  `c_description` varchar(4000) NOT NULL COMMENT '文章描述',
  `c_content` text NOT NULL COMMENT '文章内容',
  `c_date` datetime NOT NULL COMMENT '抓取日期',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章采集内容表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sys_collectrule`
--

DROP TABLE IF EXISTS `sys_collectrule`;
CREATE TABLE IF NOT EXISTS `sys_collectrule` (
  `r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '文章采集规则id',
  `r_name` varchar(200) NOT NULL COMMENT '文章采集规则名称',
  `r_pagecode` varchar(50) NOT NULL COMMENT '采集页面编码',
  `r_urltype` varchar(50) NOT NULL COMMENT '网址类型',
  `r_urlsource` text NOT NULL COMMENT '来源网址',
  `r_urlallowed` varchar(200) NOT NULL COMMENT '网址必须包含字符',
  `r_urlunallowed` varchar(200) NOT NULL COMMENT '网址不能包含字符',
  `r_urlrange1` varchar(1000) NOT NULL COMMENT '网址来源范围开始位置',
  `r_urlrange2` varchar(1000) NOT NULL COMMENT '网址来源范围结束位置',
  `r_titlerule` varchar(1000) NOT NULL COMMENT '标题匹配规则',
  `r_titleclear` varchar(1000) NOT NULL COMMENT '标题清除字符规则',
  `r_keywordsrule` varchar(1000) NOT NULL COMMENT '关键词匹配规则',
  `r_keywordsclear` varchar(1000) NOT NULL COMMENT '关键词清除字符规则',
  `r_descriptionrule` varchar(1000) NOT NULL COMMENT '描述匹配规则',
  `r_descriptionclear` varchar(1000) NOT NULL COMMENT '描述清除字符规则',
  `r_contentrule` varchar(1000) NOT NULL COMMENT '文章内容匹配规则',
  `r_contentclear` varchar(1000) NOT NULL COMMENT '文章内容清除字符规则',
  `r_downloadimg` tinyint(4) NOT NULL COMMENT '是否下载图片',
  `r_date` datetime NOT NULL COMMENT '最近采集日期',
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章采集规则表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `sys_collectrule`
--

INSERT INTO `sys_collectrule` (`r_id`, `r_name`, `r_pagecode`, `r_urltype`, `r_urlsource`, `r_urlallowed`, `r_urlunallowed`, `r_urlrange1`, `r_urlrange2`, `r_titlerule`, `r_titleclear`, `r_keywordsrule`, `r_keywordsclear`, `r_descriptionrule`, `r_descriptionclear`, `r_contentrule`, `r_contentclear`, `r_downloadimg`, `r_date`) VALUES
(1, '凤凰网科技栏目', 'UTF8', 'LIST', 'http://tech.ifeng.com/', 'tech.ifeng.com', '', '<div class="col_m">', '<div class="col_r">', '', '', '', '', '', '', '', '', 0, '2013-06-01 00:13:24'),
(2, '凤凰网-互联网版块', 'GBK', 'LIST', 'http://tech.ifeng.com/internet/list_0/0.shtml', 'http://tech.ifeng.com/internet/', '', '<div class="main">', '<div class="pic950">', '', '', '', '', '', '', '', '', 1, '2013-06-01 02:19:26');

-- --------------------------------------------------------

--
-- 表的结构 `web_article`
--

DROP TABLE IF EXISTS `web_article`;
CREATE TABLE IF NOT EXISTS `web_article` (
  `a_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `a_atid` int(10) NOT NULL COMMENT '文章分类id',
  `a_title` varchar(500) NOT NULL COMMENT '文章标题',
  `a_title2` varchar(500) NOT NULL COMMENT '文章副标题',
  `a_sort` int(10) NOT NULL COMMENT '排序',
  `a_img` text NOT NULL COMMENT '文章略缩图',
  `a_count` int(10) NOT NULL COMMENT '浏览次数',
  `a_content` text NOT NULL COMMENT '文章内容',
  `a_keywords` varchar(2000) NOT NULL COMMENT 'seo关键字',
  `a_description` varchar(4000) NOT NULL COMMENT 'seo描述',
  `a_createdate` datetime NOT NULL COMMENT '创建日期',
  `a_updatedate` datetime NOT NULL COMMENT '最近更新日期',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章信息表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `web_article`
--

INSERT INTO `web_article` (`a_id`, `a_atid`, `a_title`, `a_title2`, `a_sort`, `a_img`, `a_count`, `a_content`, `a_keywords`, `a_description`, `a_createdate`, `a_updatedate`) VALUES
(2, 1, '成都户外休闲椅2', '成都户外休闲椅为你把阳台 打造出不一样的生活享受', 2, 'http://tu.xunbo.cc/20130515204135308.jpg', 1, '<div class="box list1 left" style="margin:0px;padding:0px;float:left;clear:none;overflow:hidden;width:260px;display:inline-block;height:443px;color:#A2A2A2;font-family:宋体, ''Arial Narrow'', HELVETICA;line-height:20px;white-space:normal;background-color:#FFFFFF;">\n	<div class="tit" style="margin:0px;padding:0px;height:40px;line-height:40px;overflow:hidden;">\n		<h1 style="margin:0px;padding:0px 0px 0px 12px;font-size:14px;color:#25749C;float:left;">\n			今日更新61部\n		</h1>\n<a href="http://www.2tu.cc/newlist.html" style="outline:none;text-decoration:none;color:#0071BC;float:right;padding-right:12px;">最近更新&gt;&gt;</a> \n	</div>\n	<ul style="margin:0px;padding:8px 0px 0px;list-style:none;background-image:url(http://www.2tu.cc/template/vkaifa/images/num.png);background-position:10px 5px;background-repeat:no-repeat no-repeat;">\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP15154.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">如果还有明天第四季[4]</a>家庭生活\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP15300.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">闯关东前传2013[5]</a>传奇大戏\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP12946.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">陆贞传奇/女相[45]</a>励志古装\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP14995.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">翼空之巅/极限运动[30]</a>手指滑板\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP11562.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">侠岚[89]</a>神话励志\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP12370.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">爱回家[263]</a>家族情感\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP3068.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">型男大主厨</a>05-22\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP15255.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">宝贝[24]</a>家庭轻喜\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP15047.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">抗争之城[6]</a>科幻暴力\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<br />\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP2836.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">完全娱乐</a>05-22\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP14988.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">爱在阳光下[45]</a>爱情生活\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP15313.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">上阵父子兵[1]</a>父子情深\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP14283.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">Line Offlin..[57]</a>卡通动漫\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP2835.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">娱乐百分百</a>05-21\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP5778.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">TVBS哈新闻</a>05-22\n			</p>\n05-22\n		</li>\n		<li style="margin:0px;padding:0px 0px 0px 30px;height:28px;line-height:28px;color:#FF7E00;">\n			<p style="margin-top:0px;margin-bottom:0px;padding:0px 10px 0px 0px;width:176px;float:left;color:#A1A1A1;overflow:hidden;height:28px;">\n				<a href="http://www.2tu.cc/Html/GP15274.html" style="outline:none;text-decoration:none;color:#467691;padding-right:6px;float:left;">天地风云录之九龙变[16]</a>古装科幻\n			</p>\n05-22\n		</li>\n	</ul>\n</div>\n<div class="tab tabw1" style="margin:0px;padding:0px;width:458px;float:left;color:#A2A2A2;font-family:宋体, ''Arial Narrow'', HELVETICA;line-height:20px;white-space:normal;background-color:#FFFFFF;">\n	<div class="tit" style="margin:0px;padding:0px;height:40px;line-height:40px;overflow:hidden;">\n		<h1 style="margin:0px;padding:0px 0px 0px 12px;font-size:14px;color:#25749C;float:left;">\n			热播推荐\n		</h1>\n		<ul style="margin:0px;padding:0px 10px 0px 0px;list-style:none;float:right;">\n			<li id="ph1" class="active" style="margin:0px;padding:0px;float:left;background-image:url(http://www.2tu.cc/template/vkaifa/images/ico.png);color:#0071BC;background-position:50% -273px;background-repeat:no-repeat no-repeat;">\n				<a href="" style="outline:none;text-decoration:none;color:#636363;display:block;height:40px;padding:0px 10px;float:left;">电影</a> \n			</li>\n			<li id="ph2" class="" style="margin:0px;padding:0px;float:left;">\n				<a href="" style="outline:none;text-decoration:none;color:#636363;display:block;height:40px;padding:0px 10px;float:left;">电视剧</a> \n			</li>\n			<li id="ph3" class="" style="margin:0px;padding:0px;float:left;">\n				<a href="" style="outline:none;text-decoration:none;color:#636363;display:block;height:40px;padding:0px 10px;float:left;">综艺</a> \n			</li>\n			<li id="ph4" class="" style="margin:0px;padding:0px;float:left;">\n				<a href="" style="outline:none;text-decoration:none;color:#636363;display:block;height:40px;padding:0px 10px;float:left;">动漫</a> \n			</li>\n		</ul>\n	</div>\n	<ul class="pic plist1" id="con_ph_1" style="margin:0px;padding:0px;list-style:none;">\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP13669.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.xunbo.cc/20130515204135308.jpg" alt="虎胆龙威5" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1280超清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP13669.html" style="outline:none;text-decoration:none;color:#0071BC;">虎胆龙威5</a></b> \n			</p>\n<em style="font-style:normal;">2013-动作片</em> \n		</li>\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP14580.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.xunbo.cc/20130218133022299.jpg" alt="温暖的尸体/血肉之躯/热血丧男/殭尸哪有那么帅/血仍未冷" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1280超清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP14580.html" style="outline:none;text-decoration:none;color:#0071BC;">温暖的尸体/..</a></b> \n			</p>\n<em style="font-style:normal;">2013-喜剧片</em> \n		</li>\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP13715.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.xunbo.cc/20130506155227043.jpg" alt="韩赛尔与格蕾特：女巫猎人" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1280超清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP13715.html" style="outline:none;text-decoration:none;color:#0071BC;">韩赛尔与格蕾..</a></b> \n			</p>\n<em style="font-style:normal;">2013-动作片</em> \n		</li>\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP15188.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.xunbo.cc/20130505164657374.jpg" alt="同谋" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1280超清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP15188.html" style="outline:none;text-decoration:none;color:#0071BC;">同谋</a></b> \n			</p>\n<em style="font-style:normal;">2013-动作片</em> \n		</li>\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP15289.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.xunbo.cc/20130520120749953.jpg" alt="超级英雄必死/致命格斗" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1280高清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP15289.html" style="outline:none;text-decoration:none;color:#0071BC;">超级英雄必死..</a></b> \n			</p>\n<em style="font-style:normal;">2012-动作片</em> \n		</li>\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP1014.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.2tu.cc/newpic/1014.jpg" alt="星际传奇" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1024超清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP1014.html" style="outline:none;text-decoration:none;color:#0071BC;">星际传奇</a></b> \n			</p>\n<em style="font-style:normal;">2000-科幻片</em> \n		</li>\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP15306.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.xunbo.cc/20130521201958316.jpg" alt="阳光橱窗" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1280超清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP15306.html" style="outline:none;text-decoration:none;color:#0071BC;">阳光橱窗</a></b> \n			</p>\n<em style="font-style:normal;">2013-爱情片</em> \n		</li>\n		<li style="margin:0px;padding:16px 13px 0px;float:left;width:86px;height:180px;overflow:hidden;">\n			<a href="http://www.2tu.cc/Html/GP9079.html" class="i" style="outline:none;text-decoration:none;color:#467691;position:relative;width:86px;height:122px;padding:2px;border:1px solid #DDDDDD;display:block;"><img src="http://tu.2tu.cc/newpic/9079.jpg" alt="B+侦探" style="margin:0px;padding:0px;width:86px;height:122px;" /><em class="v" style="font-style:normal;background-image:url(http://www.2tu.cc/template/vkaifa/images/bg_v.png);color:#FFFFFF;display:block;height:14px;line-height:14px;overflow:hidden;padding-right:3px;text-align:right;width:83px;position:absolute;left:2px;top:108px;background-repeat:no-repeat no-repeat;">1280超清</em></a> \n			<p style="margin-top:0px;margin-bottom:0px;padding:10px 0px 6px;line-height:14px;height:14px;clear:both;">\n				<b class="c0071bc" style="float:left;font-weight:normal;"><a href="http://www.2tu.cc/Html/GP9079.html" style="outline:none;text-decoration:none;color:#0071BC;">B+侦探</a></b> \n			</p>\n<em style="font-style:normal;">2011-剧情片</em> \n		</li>\n	</ul>\n</div>', '成都户外休闲椅,休闲椅,户外', '成都户外休闲椅为你把阳台 打造出不一样的生活享受成都户外休闲椅为你把阳台 打造出不一样的生活享受成都户外休闲椅为你把阳台 打造出不一样的生活享受', '2013-05-21 23:24:06', '2013-05-22 22:48:42');

-- --------------------------------------------------------

--
-- 表的结构 `web_articletype`
--

DROP TABLE IF EXISTS `web_articletype`;
CREATE TABLE IF NOT EXISTS `web_articletype` (
  `at_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '文章分类id',
  `at_pid` int(10) NOT NULL COMMENT '文章分类父亲id',
  `at_name` varchar(500) NOT NULL COMMENT '文章分类名称',
  `at_sort` int(10) NOT NULL COMMENT '排序',
  `at_img` text NOT NULL COMMENT '文章分类略缩图',
  `at_keywords` varchar(2000) NOT NULL COMMENT '分类seo关键字',
  `at_description` varchar(4000) NOT NULL COMMENT '分类seo描述',
  `at_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`at_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章分类信息表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `web_articletype`
--

INSERT INTO `web_articletype` (`at_id`, `at_pid`, `at_name`, `at_sort`, `at_img`, `at_keywords`, `at_description`, `at_remark`) VALUES
(1, 0, '行业新闻', 1, '', 'dacms,建站系统,网站,网页设计', '', ''),
(2, 0, '技术动态', 10, '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `web_config`
--

DROP TABLE IF EXISTS `web_config`;
CREATE TABLE IF NOT EXISTS `web_config` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '网站id',
  `c_name` varchar(200) NOT NULL COMMENT '网站名称',
  `c_company` varchar(200) NOT NULL COMMENT '企业名称',
  `c_address` varchar(500) NOT NULL COMMENT '企业地址',
  `c_user` varchar(20) NOT NULL COMMENT '联系人',
  `c_phone` varchar(50) NOT NULL COMMENT '联系人手机',
  `c_telephone` varchar(50) NOT NULL COMMENT '企业联系电话',
  `c_email` varchar(200) NOT NULL COMMENT '企业电子邮箱',
  `c_fax` varchar(50) NOT NULL COMMENT '企业传真',
  `c_zipcode` varchar(50) NOT NULL COMMENT '企业邮编',
  `c_website` varchar(500) NOT NULL COMMENT '网站域名',
  `c_img` text NOT NULL COMMENT '网站logo图片',
  `c_icp` varchar(200) NOT NULL COMMENT 'icp备案号',
  `c_keywords` varchar(2000) NOT NULL COMMENT '整站SEO关键字',
  `c_description` varchar(4000) NOT NULL COMMENT '整站SEO描述',
  `c_pushemail` varchar(50) NOT NULL COMMENT '推送邮箱账号',
  `c_pushpwd` varchar(50) NOT NULL COMMENT '推送邮箱密码',
  `c_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_id` (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='网站基本配置信息表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `web_config`
--

INSERT INTO `web_config` (`c_id`, `c_name`, `c_company`, `c_address`, `c_user`, `c_phone`, `c_telephone`, `c_email`, `c_fax`, `c_zipcode`, `c_website`, `c_img`, `c_icp`, `c_keywords`, `c_description`, `c_pushemail`, `c_pushpwd`, `c_remark`) VALUES
(1, 'daCMS新网', 'daCMS', '', '徐飞', '13688387776', '', 'dannyxu100@139.com', '', '', 'www.fancy100.com', '/images/logo.jpg', '蜀000000001', '凡色网,凡色,成都网站建设,成都网站设计,成都建站', '建站热线：13688387776,QQ：723158958,成都网站建设,成都网站制作,成都网站设计,成都网页设计,公司网站建设|凡色双认证,成都网站建设专家', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `web_nav`
--

DROP TABLE IF EXISTS `web_nav`;
CREATE TABLE IF NOT EXISTS `web_nav` (
  `n_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '导航id',
  `n_pid` int(10) NOT NULL COMMENT '导航父id',
  `n_enname` varchar(100) NOT NULL COMMENT '导航菜单英文名称',
  `n_name` varchar(100) NOT NULL COMMENT '导航名称',
  `n_level` int(10) NOT NULL COMMENT '导航菜单级别',
  `n_sort` int(10) NOT NULL COMMENT '导航菜单排序',
  `n_url` text NOT NULL COMMENT '链接地址',
  `n_img` text NOT NULL COMMENT '导航菜单图片',
  `n_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='网站前端导航菜单' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `web_nav`
--

INSERT INTO `web_nav` (`n_id`, `n_pid`, `n_enname`, `n_name`, `n_level`, `n_sort`, `n_url`, `n_img`, `n_remark`) VALUES
(1, 0, 'home', '首页', 1, 1, 'http://www.cdbly8.com/', '/images/menu_icon/desk.png', ''),
(2, 0, 'products', '产品中心', 1, 10, 'http://www.cdbly8.com/', '', ''),
(3, 0, 'news', '新闻动态', 1, 20, 'http://www.baidu.com', '', ''),
(4, 0, '', '新建导航', 1, 0, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `web_product`
--

DROP TABLE IF EXISTS `web_product`;
CREATE TABLE IF NOT EXISTS `web_product` (
  `p_id` int(10) NOT NULL COMMENT '产品id',
  `P_ptid` int(10) NOT NULL COMMENT '产品分类id',
  `p_name` varchar(500) NOT NULL COMMENT '产品名称',
  `p_abscrite` int(11) NOT NULL COMMENT '摘要',
  `p_sort` int(10) NOT NULL COMMENT '排序',
  `p_code` varchar(100) NOT NULL COMMENT '产品编号',
  `p_price` float NOT NULL COMMENT '销售价格',
  `p_price2` float NOT NULL COMMENT '市场价格',
  `p_price3` float NOT NULL COMMENT '打折价格',
  `p_img` text NOT NULL COMMENT '产品略缩图',
  `p_content` text NOT NULL COMMENT '产品详细信息',
  `p_keywords` varchar(2000) NOT NULL COMMENT 'SEO关键字',
  `p_description` varchar(4000) NOT NULL COMMENT 'SEO描述',
  `p_createdate` datetime NOT NULL COMMENT '产品上架日期',
  `p_updatedate` datetime NOT NULL COMMENT '产品更新日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品基本信息表';

-- --------------------------------------------------------

--
-- 表的结构 `web_vip`
--

DROP TABLE IF EXISTS `web_vip`;
CREATE TABLE IF NOT EXISTS `web_vip` (
  `v_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '会员id',
  `v_code` varchar(50) NOT NULL COMMENT '会员账号',
  `v_pwd` varchar(50) NOT NULL COMMENT '会员密码',
  `v_name` varchar(50) NOT NULL COMMENT '会员名称',
  `v_type` varchar(20) NOT NULL COMMENT '会员分类',
  `v_gender` varchar(4) NOT NULL COMMENT '性别',
  `v_email` varchar(200) NOT NULL COMMENT '邮箱',
  `v_qq` varchar(50) NOT NULL COMMENT 'QQ',
  `v_telephone` varchar(50) NOT NULL COMMENT '电话',
  `v_phone` int(11) NOT NULL COMMENT '手机',
  `v_address` varchar(500) NOT NULL COMMENT '地址',
  `v_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员信息表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
