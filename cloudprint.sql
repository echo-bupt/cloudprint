-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 10 月 16 日 01:14
-- 服务器版本: 5.5.20-log
-- PHP 版本: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cloudprint`
--
CREATE DATABASE IF NOT EXISTS `cloudprint` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cloudprint`;

-- --------------------------------------------------------

--
-- 表的结构 `price`
--

CREATE TABLE IF NOT EXISTS `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_size` int(11) DEFAULT NULL COMMENT '打印纸张大小(A3/A4等) ，以数组方式存储，此处保持数组键值',
  `paper_type` int(11) DEFAULT NULL COMMENT '打印纸张类型（照片纸、普通打印纸等），以数组方式存储，此处保持数组键值',
  `print_type` int(11) DEFAULT NULL COMMENT '打印方式（缩印、单面打印等），以数组方式存储，此处保持数组键值',
  `price` decimal(2,0) DEFAULT NULL COMMENT '价格',
  `user_b_id` int(11) DEFAULT NULL COMMENT '商家id',
  PRIMARY KEY (`id`),
  KEY `fk_price_user1_idx` (`user_b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家定价表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `printer`
--

CREATE TABLE IF NOT EXISTS `printer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '打印机名称',
  `user_id` int(11) DEFAULT NULL COMMENT '所有者id',
  `location` varchar(45) DEFAULT NULL COMMENT '打印机位置',
  `category_key` int(11) DEFAULT NULL COMMENT '打印机类别以数组方式存储，此处保持数组键值',
  `print_time` int(11) DEFAULT '0' COMMENT '在线打印次数',
  `visible` tinyint(1) DEFAULT NULL COMMENT '可否显示',
  `acl_state` varchar(20) DEFAULT '1' COMMENT '可使用权限',
  `brand` varchar(20) DEFAULT NULL COMMENT '打印机品牌',
  `type` varchar(45) DEFAULT NULL COMMENT '打印机型号',
  `weight` tinyint(4) NOT NULL COMMENT '排序权重',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `pc_id` varchar(50) NOT NULL COMMENT '关联电脑的唯一标识',
  `driver_id` varchar(50) NOT NULL COMMENT '关联打印设备在系统中的唯一标识',
  PRIMARY KEY (`id`),
  KEY `fk_printer_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='打印机信息表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `printer`
--

INSERT INTO `printer` (`id`, `name`, `user_id`, `location`, `category_key`, `print_time`, `visible`, `acl_state`, `brand`, `type`, `weight`, `add_time`, `pc_id`, `driver_id`) VALUES
(2, 'HP LaserJet P1108', 5, '燕山大学-信息馆419', 1, 42, 1, '2', 'HP惠普', 'LaserJet P1108', 8, '2013-10-15 09:35:29', '00000', 'HP LaserJet Professional P1108'),
(3, 'test123', 5, 'test location', 1, 10, 0, '1', '', '', 0, '2013-10-15 09:38:31', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT '资源标题',
  `description` varchar(500) DEFAULT NULL COMMENT '资源描述',
  `type` varchar(50) DEFAULT NULL COMMENT '资源类型（扩展名）',
  `size` int(11) DEFAULT NULL COMMENT '文件大小（b）',
  `img_dir` varchar(200) DEFAULT NULL COMMENT '资源图片的地址',
  `dir` varchar(200) DEFAULT NULL COMMENT '资源地址',
  `tag` varchar(200) DEFAULT NULL COMMENT '资源标签',
  `add_time` timestamp NULL DEFAULT NULL COMMENT '资源添加时间',
  `view_num` int(11) DEFAULT NULL COMMENT '资源访问量',
  `weight` bigint(20) DEFAULT NULL COMMENT '资源在同一分类中的排序权重',
  `visible` tinyint(1) DEFAULT NULL COMMENT '是否可见',
  `cat_id` bigint(20) DEFAULT NULL COMMENT '资源分类的id',
  `user_id` int(11) DEFAULT NULL COMMENT '资源所有者的id',
  `share` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否共享资源',
  PRIMARY KEY (`id`),
  KEY `fk_source_s_cat_idx` (`cat_id`),
  KEY `fk_source_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='资源表，即用户共享的各种打印文件' AUTO_INCREMENT=122 ;

--
-- 转存表中的数据 `source`
--

INSERT INTO `source` (`id`, `title`, `description`, `type`, `size`, `img_dir`, `dir`, `tag`, `add_time`, `view_num`, `weight`, `visible`, `cat_id`, `user_id`, `share`) VALUES
(115, '测试.txt', '', 'text/plain', 6, '', 'uploads/u_090104010106_id5/%E6%B5%8B%E8%AF%95.txt', '', '2013-09-08 00:46:21', NULL, NULL, 0, 0, 5, 1),
(116, '新建 Microsoft Word 文档.doc', NULL, 'application/msword', 19968, '', 'uploads/u_BAIJICHUAN_id18/%E6%96%B0%E5%BB%BA%20Microsoft%20Word%20%E6%96%87%E6%A1%A3.doc', NULL, '2013-09-08 01:46:34', NULL, NULL, 0, NULL, 18, 0),
(118, '研究生信息表.doc', '', 'application/msword', 33792, '', 'uploads/u_090104010106_id5/%E7%A0%94%E7%A9%B6%E7%94%9F%E4%BF%A1%E6%81%AF%E8%A1%A8.doc', '', '2013-09-09 00:41:02', NULL, NULL, 0, 0, 5, 1),
(119, '科研项目劳务费发放表.doc', '', 'application/msword', 53760, '', 'uploads/u_090104010106_id5/%E7%A7%91%E7%A0%94%E9%A1%B9%E7%9B%AE%E5%8A%B3%E5%8A%A1%E8%B4%B9%E5%8F%91%E6%94%BE%E8%A1%A8.doc', '', '2013-09-09 00:43:12', NULL, NULL, 0, 0, 5, 1),
(120, '“三助”审批表(助管)白继川.doc', NULL, 'application/octet-stream', 19456, '', 'uploads/u_BAIJICHUAN_id18/%E2%80%9C%E4%B8%89%E5%8A%A9%E2%80%9D%E5%AE%A1%E6%89%B9%E8%A1%A8%28%E5%8A%A9%E7%AE%A1%29%E7%99%BD%E7%BB%A7%E5%B7%9D.doc', NULL, '2013-09-23 09:10:24', NULL, NULL, 0, NULL, 18, 0),
(121, '翻译-董奇峰-类型1成绩单.xls', '', 'application/kset', 11776, '', 'uploads/u_090104010106_id5/%E7%BF%BB%E8%AF%91-%E8%91%A3%E5%A5%87%E5%B3%B0-%E7%B1%BB%E5%9E%8B1%E6%88%90%E7%BB%A9%E5%8D%95.xls', '', '2013-10-08 08:43:19', NULL, NULL, 0, 0, 5, 1);

-- --------------------------------------------------------

--
-- 表的结构 `s_cat`
--

CREATE TABLE IF NOT EXISTS `s_cat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '分类名称',
  `f_link` varchar(45) DEFAULT NULL COMMENT '父分类路径',
  `weight` float DEFAULT NULL COMMENT '排序权重',
  `f_id` bigint(20) DEFAULT NULL COMMENT '父级分类id',
  PRIMARY KEY (`id`),
  KEY `fk_s_cat_s_cat1_idx` (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='资源分类表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `s_cat`
--

INSERT INTO `s_cat` (`id`, `name`, `f_link`, `weight`, `f_id`) VALUES
(0, '顶级', NULL, NULL, NULL),
(4, '计算机科学与技术', '0', 2, 0),
(5, '机械电子工程', '0', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `printer_id` int(11) DEFAULT NULL COMMENT '打印机id',
  `user_c_id` int(11) DEFAULT NULL COMMENT '打印用户id',
  `user_b_id` int(11) DEFAULT NULL COMMENT '打印商家id',
  `user_i_id` int(11) DEFAULT NULL COMMENT '打印接口商id',
  `print_method` tinyint(4) DEFAULT NULL COMMENT '打印方式，关联数组id',
  `add_time` timestamp NULL DEFAULT NULL COMMENT '任务添加时间',
  `submit_time` timestamp NULL DEFAULT NULL COMMENT '任务提交时间',
  `print_time` timestamp NULL DEFAULT NULL COMMENT '任务打印时间',
  `get_time` timestamp NULL DEFAULT NULL COMMENT '用户取货时间',
  `state` int(11) DEFAULT NULL COMMENT '任务状态 ',
  `totle_price` decimal(2,0) DEFAULT NULL COMMENT '总价',
  PRIMARY KEY (`id`),
  KEY `fk_task_printer1_idx` (`printer_id`),
  KEY `fk_task_user1_idx` (`user_c_id`),
  KEY `fk_task_user2_idx` (`user_b_id`),
  KEY `fk_task_user3_idx` (`user_i_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='打印任务表' AUTO_INCREMENT=107 ;

--
-- 转存表中的数据 `task`
--

INSERT INTO `task` (`id`, `printer_id`, `user_c_id`, `user_b_id`, `user_i_id`, `print_method`, `add_time`, `submit_time`, `print_time`, `get_time`, `state`, `totle_price`) VALUES
(91, 2, 5, 5, NULL, 1, '2013-09-08 08:49:42', '2013-09-08 08:50:04', '2013-09-08 08:51:04', NULL, 6, NULL),
(92, 2, 5, 5, NULL, 1, '2013-09-08 08:56:58', '2013-09-08 08:59:40', '2013-09-08 08:59:44', NULL, 6, NULL),
(93, 2, 5, 5, NULL, 1, '2013-09-08 12:42:34', '2013-09-09 00:41:15', '2013-09-09 00:41:20', NULL, 6, NULL),
(94, 2, 5, 5, NULL, 1, '2013-09-09 00:43:20', '2013-09-09 00:43:27', '2013-09-09 00:43:31', NULL, 6, NULL),
(95, 2, 5, 5, NULL, 1, '2013-09-10 01:35:58', '2013-10-08 08:45:32', '2013-10-08 08:45:36', NULL, 6, NULL),
(96, 2, 18, 5, NULL, 1, '2013-09-23 09:10:25', '2013-09-23 09:10:41', '2013-09-23 09:39:11', NULL, 6, NULL),
(97, 2, 5, 5, NULL, 1, '2013-10-08 08:47:10', '2013-10-08 08:47:17', '2013-10-08 08:48:37', NULL, 6, NULL),
(98, 2, 5, 5, NULL, 0, '2013-10-08 08:52:53', '2013-10-15 09:18:59', NULL, NULL, 1, NULL),
(99, 2, 5, 5, NULL, 0, '2013-10-15 09:18:59', '2013-10-15 09:29:53', NULL, NULL, 1, NULL),
(100, 2, 5, 5, NULL, 0, '2013-10-15 09:29:52', '2013-10-15 09:30:14', NULL, NULL, 1, NULL),
(101, 2, 5, 5, NULL, 0, '2013-10-15 09:30:12', '2013-10-15 09:32:13', NULL, NULL, 1, NULL),
(102, 3, 5, 5, NULL, 0, '2013-10-15 09:32:19', '2013-10-15 09:34:00', NULL, NULL, 1, NULL),
(103, 2, 5, 5, NULL, 0, '2013-10-15 09:34:00', '2013-10-15 09:35:29', NULL, NULL, 1, NULL),
(104, 3, 5, 5, NULL, 0, '2013-10-15 09:35:21', '2013-10-15 09:36:42', NULL, NULL, 1, NULL),
(105, 3, 5, 5, NULL, 0, '2013-10-15 09:36:33', '2013-10-15 09:38:31', NULL, NULL, 1, NULL),
(106, NULL, 5, NULL, NULL, NULL, '2013-10-15 09:38:42', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `task_file`
--

CREATE TABLE IF NOT EXISTS `task_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL COMMENT '关联的任务id',
  `source_id` int(11) DEFAULT NULL COMMENT '关联的资源id',
  `number` int(11) DEFAULT NULL COMMENT '打印份数',
  `pager_size` tinyint(4) NOT NULL COMMENT '纸张大小的id（数组）',
  `pager_type` tinyint(4) NOT NULL COMMENT '纸张类型的id（数组）',
  `print_type` tinyint(4) NOT NULL COMMENT '打印类型的id（数组）',
  `color_type` tinyint(4) DEFAULT '1' COMMENT '打印色彩选择(数组)',
  `price_id` int(11) DEFAULT NULL COMMENT '关联的定价策略',
  `price` decimal(2,0) DEFAULT NULL COMMENT '总价',
  `message` varchar(200) NOT NULL COMMENT '关于此文件的打印留言',
  `state` tinyint(4) NOT NULL COMMENT '打印状态',
  PRIMARY KEY (`id`),
  KEY `fk_task_file_task1_idx` (`task_id`),
  KEY `fk_task_file_price1_idx` (`price_id`),
  KEY `fk_task_file_source1_idx` (`source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='打印任务中的打印文件信息表' AUTO_INCREMENT=211 ;

--
-- 转存表中的数据 `task_file`
--

INSERT INTO `task_file` (`id`, `task_id`, `source_id`, `number`, `pager_size`, `pager_type`, `print_type`, `color_type`, `price_id`, `price`, `message`, `state`) VALUES
(1, 91, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 4),
(2, 92, 115, 2, 1, 1, 1, 1, NULL, NULL, '', 4),
(4, 93, 118, 1, 1, 1, 1, 1, NULL, NULL, '', 4),
(5, 94, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 4),
(6, 96, 120, 1, 1, 1, 1, 1, NULL, NULL, '', 4),
(7, 95, 121, 1, 1, 1, 1, 1, NULL, NULL, '', 4),
(8, 97, 121, 1, 1, 1, 1, 1, NULL, NULL, '', 4),
(15, 98, 121, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(22, 99, 121, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(23, 100, 121, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(24, 101, 121, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(25, 102, 121, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(32, 103, 118, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(33, 104, 118, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(34, 105, 118, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(37, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(39, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(40, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(41, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(42, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(43, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(44, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(46, 106, 119, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(48, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(49, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(50, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(51, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(52, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(53, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(54, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(55, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(56, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(57, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(58, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(59, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(60, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(61, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(62, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(63, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(64, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(65, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(66, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(67, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(68, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(69, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(70, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(71, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(72, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(73, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(74, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(75, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(76, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(77, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(78, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(79, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(80, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(81, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(82, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(83, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(84, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(85, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(86, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(87, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(88, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(89, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(90, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(91, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(92, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(93, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(94, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(95, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(96, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(97, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(98, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(99, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(100, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(101, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(102, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(103, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(104, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(105, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(106, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(107, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(108, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(109, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(110, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(111, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(112, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(113, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(114, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(115, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(116, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(117, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(118, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(119, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(120, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(121, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(122, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(123, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(124, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(125, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(126, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(127, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(128, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(129, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(130, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(131, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(132, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(133, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(134, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(135, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(136, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(137, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(138, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(139, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(140, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(141, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(142, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(143, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(144, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(145, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(146, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(147, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(148, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(149, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(150, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(151, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(152, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(153, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(154, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(155, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(156, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(157, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(158, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(159, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(160, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(161, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(162, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(163, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(164, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(165, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(166, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(167, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(168, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(169, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(170, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(171, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(172, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(173, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(174, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(175, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(176, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(177, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(178, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(179, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(180, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(181, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(182, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(183, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(184, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(185, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(186, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(187, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(188, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(189, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(190, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(191, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(192, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(193, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(194, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(195, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(196, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(197, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(198, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(199, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(200, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(201, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(202, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(203, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(204, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(205, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(206, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(207, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(208, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(209, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0),
(210, 106, 115, 1, 1, 1, 1, 1, NULL, NULL, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '用户名',
  `password` varchar(200) DEFAULT NULL COMMENT '用户密码',
  `role` varchar(45) DEFAULT NULL COMMENT '用户角色（‘普通用户’，‘商业用户’，‘接口用户’）\nuser_common,user_business,user_interface',
  `add_time` timestamp NULL DEFAULT NULL COMMENT '用户注册时间',
  `login_time` int(11) DEFAULT NULL COMMENT '用户登录次数',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '用户最后一次登录时间',
  `phone_num` varchar(11) DEFAULT NULL COMMENT '用户电话',
  `img_dir` varchar(200) DEFAULT NULL COMMENT '头像存储路径',
  `ip` varchar(45) DEFAULT NULL COMMENT '最后一次登录ip',
  `role_id` int(11) DEFAULT NULL COMMENT '此用户在不同角色的用户信息表中的id',
  `grad` int(11) DEFAULT NULL COMMENT '用户等级',
  `integral` int(11) DEFAULT NULL COMMENT '用户积分',
  PRIMARY KEY (`id`),
  KEY `fk_user_user_commen1_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='通用用户表' AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `role`, `add_time`, `login_time`, `last_login_time`, `phone_num`, `img_dir`, `ip`, `role_id`, `grad`, `integral`) VALUES
(5, '090104010106', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 03:12:21', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL),
(6, '090104010107', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 18:31:09', NULL, NULL, NULL, NULL, '127.0.0.1', 5, 1, NULL),
(7, '090104010108', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 19:08:13', NULL, NULL, NULL, NULL, '127.0.0.1', 6, 1, NULL),
(8, '090104010109', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 19:11:28', NULL, NULL, NULL, NULL, '127.0.0.1', 7, 1, NULL),
(9, '090104010105', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 19:47:24', NULL, NULL, NULL, NULL, '127.0.0.1', 8, 1, NULL),
(10, '090104010104', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 19:52:51', NULL, NULL, NULL, NULL, '127.0.0.1', 9, 1, NULL),
(11, '090104010103', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 19:55:04', NULL, NULL, NULL, NULL, '127.0.0.1', 10, 1, NULL),
(12, '090104010102', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 20:04:25', NULL, NULL, NULL, NULL, '127.0.0.1', 11, 1, NULL),
(13, '090104010101', '4297f44b13955235245b2497399d7a93', '1', '2013-04-30 20:29:46', NULL, NULL, NULL, NULL, '127.0.0.1', 12, 1, NULL),
(14, '090104010100', '4297f44b13955235245b2497399d7a93', '1', '2013-06-16 08:04:01', NULL, NULL, NULL, NULL, '127.0.0.1', 13, 1, NULL),
(15, '090101010037', '4297f44b13955235245b2497399d7a93', '1', '2013-06-23 07:45:05', NULL, NULL, NULL, NULL, '127.0.0.1', 14, 1, NULL),
(16, '090104010116', '4297f44b13955235245b2497399d7a93', '1', '2013-06-23 07:50:06', NULL, NULL, NULL, NULL, '127.0.0.1', 15, 1, NULL),
(17, '090104010117', '4297f44b13955235245b2497399d7a93', '1', '2013-06-23 07:54:14', NULL, NULL, NULL, NULL, '127.0.0.1', 16, 1, NULL),
(18, 'BAIJICHUAN', '52bdc0c7c6501e4e9eaa46f48b825128', '1', '2013-09-08 01:45:55', NULL, NULL, NULL, NULL, '202.206.249.79', 17, 1, NULL),
(19, 'libeina', '076ae99a92d01bb2d86fa785e0025928', '1', '2013-09-09 02:41:40', NULL, NULL, NULL, NULL, '202.206.249.193', 18, 1, NULL),
(20, 'xiaoxuesheng', '72585e33f348d5756dd979c2192a9899', '1', '2013-09-09 02:43:46', NULL, NULL, NULL, NULL, '202.206.249.193', 19, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_business`
--

CREATE TABLE IF NOT EXISTS `user_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL COMMENT '关联用户表id',
  `address` varchar(200) DEFAULT NULL COMMENT '地址',
  `shop_name` varchar(20) DEFAULT NULL COMMENT '店铺名称',
  `shop_whole_name` varchar(45) DEFAULT NULL COMMENT '店铺全称',
  `host_name` varchar(45) DEFAULT NULL COMMENT '店主姓名',
  `header_dir` varchar(200) DEFAULT NULL COMMENT '店铺主页标题图片的路径',
  `socket_ip` varchar(15) NOT NULL COMMENT '客户端程序ip',
  `socket_port` varchar(8) NOT NULL COMMENT '客户端程序端口',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商业用户信息表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `user_business`
--

INSERT INTO `user_business` (`id`, `u_id`, `address`, `shop_name`, `shop_whole_name`, `host_name`, `header_dir`, `socket_ip`, `socket_port`) VALUES
(3, 5, NULL, NULL, NULL, NULL, NULL, '202.206.249.6', '8018');

-- --------------------------------------------------------

--
-- 表的结构 `user_commen`
--

CREATE TABLE IF NOT EXISTS `user_commen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(15) DEFAULT NULL COMMENT '学号',
  `real_name` varchar(4) DEFAULT NULL COMMENT '真实姓名',
  `idcard_dir` varchar(200) DEFAULT NULL COMMENT 'id卡存储路径',
  `verify_state` tinyint(4) DEFAULT NULL COMMENT '真实性验证的状态',
  `verify_time` varchar(45) DEFAULT NULL COMMENT '真实性验证的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='普通用户信息表' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `user_commen`
--

INSERT INTO `user_commen` (`id`, `studentid`, `real_name`, `idcard_dir`, `verify_state`, `verify_time`) VALUES
(4, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, NULL, NULL, NULL),
(19, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_interface`
--

CREATE TABLE IF NOT EXISTS `user_interface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(100) DEFAULT NULL COMMENT '接口站点网址',
  `site_name` varchar(45) DEFAULT NULL COMMENT '接口站点名称',
  `host_name` varchar(4) DEFAULT NULL COMMENT '站长姓名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口用户信息表' AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `fk_price_user1` FOREIGN KEY (`user_b_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `printer`
--
ALTER TABLE `printer`
  ADD CONSTRAINT `fk_printer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `source`
--
ALTER TABLE `source`
  ADD CONSTRAINT `fk_source_s_cat` FOREIGN KEY (`cat_id`) REFERENCES `s_cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_source_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `s_cat`
--
ALTER TABLE `s_cat`
  ADD CONSTRAINT `fk_s_cat_s_cat1` FOREIGN KEY (`f_id`) REFERENCES `s_cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_printer1` FOREIGN KEY (`printer_id`) REFERENCES `printer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_user1` FOREIGN KEY (`user_c_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_user2` FOREIGN KEY (`user_b_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_user3` FOREIGN KEY (`user_i_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `task_file`
--
ALTER TABLE `task_file`
  ADD CONSTRAINT `fk_task_file_price1` FOREIGN KEY (`price_id`) REFERENCES `price` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_file_source1` FOREIGN KEY (`source_id`) REFERENCES `source` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_file_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_user_commen1` FOREIGN KEY (`role_id`) REFERENCES `user_commen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `user_interface`
--
ALTER TABLE `user_interface`
  ADD CONSTRAINT `fk_user_interface_user1` FOREIGN KEY (`id`) REFERENCES `user` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
