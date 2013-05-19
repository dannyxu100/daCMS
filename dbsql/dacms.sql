-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 19 日 13:44
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='系统菜单表' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `p_menu`
--

INSERT INTO `p_menu` (`pm_id`, `pm_pid`, `pm_name`, `pm_level`, `pm_sort`, `pm_url`, `pm_img`, `pm_remark`) VALUES
(1, 0, 'daCMS后台菜单', -1, 999, '', '', ''),
(4, 1, '系统配置', 1, 999, '/sys_power/index.php?menu=4', '/images/menu_icon/setting.png', ''),
(5, 1, '内容管理', 1, 1, '/sys_power/index.php?menu=5', '/images/menu_icon/desk.png', ''),
(6, 4, '用户管理', 2, 0, '/sys_power/user_manage.php', '/images/menu_icon/user.png', ''),
(7, 4, '角色管理', 2, 10, '/sys_power/role_manage.php', '/images/menu_icon/role.png', ''),
(11, 1, '导航管理', 1, 0, '', '/images/menu_icon/business.png', ''),
(12, 5, '文章管理', 2, 1, '', '', ''),
(13, 5, '产品管理', 2, 10, '', '/images/menu_icon/box.png', ''),
(14, 5, '案例管理', 2, 30, '', '/images/menu_icon/gift.png', ''),
(18, 4, '操作日志', 2, 999, '', '/images/menu_icon/keytype.png', ''),
(19, 1, '会员管理', 1, 30, '/sys_power/index.php?menu=19', '/images/menu_icon/user.png', ''),
(20, 19, '会员信息', 2, 1, '', '/images/menu_icon/user.png', ''),
(21, 19, '留言信息', 2, 10, '', '/images/menu_icon/comment_edit.png', ''),
(22, 1, '在线订单', 1, 40, '', '/images/menu_icon/form.png', ''),
(23, 4, '网站配置', 2, 998, '', '/images/menu_icon/module.png', ''),
(25, 19, '评论信息', 2, 20, '', '/images/menu_icon/comment.png', '');

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
(2, 0, 'xufei', 'c4ca4238a0b923820dcc509a6f75849b', '徐飞', '/uploads/userico/徐飞_2.jpg', '', '', '', '', '', '', '2013-05-19 18:07:48', 0, '');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
