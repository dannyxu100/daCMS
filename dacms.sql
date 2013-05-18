/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : dacms

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-05-18 17:07:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `p_menu`
-- ----------------------------
DROP TABLE IF EXISTS `p_menu`;
CREATE TABLE `p_menu` (
  `pm_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `pm_pid` int(10) NOT NULL COMMENT '菜单父id',
  `pm_name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '菜单名',
  `pm_level` int(10) NOT NULL COMMENT '菜单级别',
  `pm_sort` int(10) NOT NULL COMMENT '排序',
  `pm_url` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '页面链接地址',
  `pm_img` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '图标文件地址',
  `pm_remark` text CHARACTER SET utf8 NOT NULL COMMENT '备注',
  PRIMARY KEY (`pm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='系统菜单表';

-- ----------------------------
-- Records of p_menu
-- ----------------------------

-- ----------------------------
-- Table structure for `p_menu2role`
-- ----------------------------
DROP TABLE IF EXISTS `p_menu2role`;
CREATE TABLE `p_menu2role` (
  `m2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单角色映射id',
  `m2r_pmid` int(10) NOT NULL COMMENT '菜单id',
  `m2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`m2r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单角色映射表';

-- ----------------------------
-- Records of p_menu2role
-- ----------------------------

-- ----------------------------
-- Table structure for `p_role`
-- ----------------------------
DROP TABLE IF EXISTS `p_role`;
CREATE TABLE `p_role` (
  `pr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `pr_pid` int(10) NOT NULL COMMENT '父级角色id',
  `pr_name` varchar(50) NOT NULL COMMENT '角色名称',
  `pr_sort` int(10) NOT NULL COMMENT '排序',
  `pr_date` datetime NOT NULL COMMENT '角色创建时间',
  `pr_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of p_role
-- ----------------------------

-- ----------------------------
-- Table structure for `p_user`
-- ----------------------------
DROP TABLE IF EXISTS `p_user`;
CREATE TABLE `p_user` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of p_user
-- ----------------------------
INSERT INTO `p_user` VALUES ('1', '0', 'xufei', 'c4ca4238a0b923820dcc509a6f75849b', '徐飞', '', '', '', '', '', '', '', '2013-05-18 14:52:26', '0', '');

-- ----------------------------
-- Table structure for `p_user2role`
-- ----------------------------
DROP TABLE IF EXISTS `p_user2role`;
CREATE TABLE `p_user2role` (
  `u2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射角色id',
  `u2r_puid` int(10) NOT NULL COMMENT '用户id',
  `u2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`u2r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户映射角色表';

-- ----------------------------
-- Records of p_user2role
-- ----------------------------
