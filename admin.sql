/*
Navicat MySQL Data Transfer

Source Server         : hai
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : cloudprint

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-04-07 21:30:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `uid` int(8) NOT NULL AUTO_INCREMENT COMMENT '管理员表的主键id',
  `uname` varchar(16) NOT NULL COMMENT '管理员姓名',
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'admin');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `time` varchar(32) NOT NULL,
  `user_id` int(8) NOT NULL,
  `is_read` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用于给用户发消息的表';

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '\r\n                          文件正在打印         ', '2014-04-07 12:43:34', '23', '0');
INSERT INTO `message` VALUES ('3', '\r\n                    rewterwtwertf          hello     来取文件吧', '2014-04-07 15:28:25', '21', '1');
INSERT INTO `message` VALUES ('4', '快点来拿吧', '2014-04-07 15:28:26', '20', '0');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `nid` int(8) NOT NULL AUTO_INCREMENT,
  `content` varchar(128) NOT NULL,
  `time` varchar(32) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='公告表';

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('4', '云打印让打印更加随意!     ', '2014-04-07 08:33:35');
INSERT INTO `notice` VALUES ('5', '\r\n                                  共享资源,让资源更加丰富!', '2014-04-07 08:34:10');
INSERT INTO `notice` VALUES ('6', '\r\n                            上传资源会给您更大的回报!      ', '2014-04-07 08:34:46');
INSERT INTO `notice` VALUES ('7', '\r\n                                   为云打印贡献自己的力量!', '2014-04-07 08:35:01');
INSERT INTO `notice` VALUES ('8', '\r\n                             传递正能量，奉献爱心!      ', '2014-04-07 08:35:20');
INSERT INTO `notice` VALUES ('9', '\r\n                                   云打印需要大家的参与!', '2014-04-07 08:35:37');
INSERT INTO `notice` VALUES ('10', '\r\n                                   join us!', '2014-04-07 08:36:20');
INSERT INTO `notice` VALUES ('11', '\r\n                                   让资源更透明!', '2014-04-07 08:36:36');
INSERT INTO `notice` VALUES ('12', '\r\n                                  可以上传您最近的考试资料 ', '2014-04-07 08:37:12');
INSERT INTO `notice` VALUES ('13', '\r\n                                   可以上传您的课堂笔记哦', '2014-04-07 08:37:37');
INSERT INTO `notice` VALUES ('14', '资源分享更容易，资源针对性更强，工作者的福音！！', '2014-04-07 17:23:05');

-- ----------------------------
-- Table structure for price
-- ----------------------------
DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_size` int(11) DEFAULT NULL COMMENT '打印纸张大小(A3/A4等) ，以数组方式存储，此处保持数组键值',
  `paper_type` int(11) DEFAULT NULL COMMENT '打印纸张类型（照片纸、普通打印纸等），以数组方式存储，此处保持数组键值',
  `print_type` int(11) DEFAULT NULL COMMENT '打印方式（缩印、单面打印等），以数组方式存储，此处保持数组键值',
  `price` decimal(2,0) DEFAULT NULL COMMENT '价格',
  `user_b_id` int(11) DEFAULT NULL COMMENT '商家id',
  PRIMARY KEY (`id`),
  KEY `fk_price_user1_idx` (`user_b_id`),
  CONSTRAINT `fk_price_user1` FOREIGN KEY (`user_b_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家定价表';

-- ----------------------------
-- Records of price
-- ----------------------------

-- ----------------------------
-- Table structure for printer
-- ----------------------------
DROP TABLE IF EXISTS `printer`;
CREATE TABLE `printer` (
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
  KEY `fk_printer_user1_idx` (`user_id`),
  CONSTRAINT `fk_printer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='打印机信息表';

-- ----------------------------
-- Records of printer
-- ----------------------------
INSERT INTO `printer` VALUES ('2', 'HP LaserJet P1108', '5', '燕山大学-信息馆419', '1', '53', '1', '2', 'HP惠普', 'LaserJet P1108', '8', '2014-04-07 12:41:06', '00000', 'HP LaserJet Professional P1108');
INSERT INTO `printer` VALUES ('3', 'test123', '5', 'test location', '1', '10', '0', '1', '', '', '0', '2013-10-15 17:38:31', '', '');

-- ----------------------------
-- Table structure for source
-- ----------------------------
DROP TABLE IF EXISTS `source`;
CREATE TABLE `source` (
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
  `cat_id` bigint(20) DEFAULT '0' COMMENT '资源分类的id',
  `user_id` int(11) DEFAULT NULL COMMENT '资源所有者的id',
  `share` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否共享资源',
  PRIMARY KEY (`id`),
  KEY `fk_source_s_cat_idx` (`cat_id`),
  KEY `fk_source_user1_idx` (`user_id`),
  CONSTRAINT `fk_source_s_cat` FOREIGN KEY (`cat_id`) REFERENCES `s_cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_source_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8 COMMENT='资源表，即用户共享的各种打印文件';

-- ----------------------------
-- Records of source
-- ----------------------------
INSERT INTO `source` VALUES ('162', '316LN钢动态再结晶微观组织预测仿真系统.doc', '', 'application/kswps', '373760', '', 'uploads/u_admin_id21/系统代码-316LN钢动态再结晶微观组织预测仿真系统 (1).doc', '', '2014-04-06 11:12:06', null, null, '0', '0', '21', '1');
INSERT INTO `source` VALUES ('163', '深度、简易C++', '', 'application/pdf', '1677456', '', 'uploads/u_admin_id21/0_0201112141544409370258644 (1).pdf', '', '2014-04-06 11:12:06', null, null, '0', '0', '21', '1');
INSERT INTO `source` VALUES ('164', '空之境界-未来福音', '', 'text/plain', '1635', '', 'uploads/u_admin_id21/测试文字.txt', '', '2014-04-06 11:12:06', null, null, '0', '0', '21', '1');
INSERT INTO `source` VALUES ('165', '计算机专业生解惑100', '', 'application/kset', '497147', '', 'uploads/u_admin_id21/jQuery1.10.3_20130708.chm', '', '2014-04-06 11:12:06', null, null, '0', '0', '21', '1');
INSERT INTO `source` VALUES ('166', '空之境界全集', '', 'application/msword', '497147', '', 'uploads/u_admin_id21/jQuery1.10.3_20130708 (1).chm', '', '2014-04-06 11:13:31', null, null, '0', '0', '21', '1');
INSERT INTO `source` VALUES ('167', '仙灵图谱', '', 'application/office', '497147', '', 'uploads/u_admin_id21/jQuery1.10.3_20130708 (2).chm', '', '2014-04-06 11:13:31', null, null, '0', '0', '21', '1');
INSERT INTO `source` VALUES ('168', '三年高考五年模拟', '', 'application/powerpoint', '20512', '', 'uploads/u_xuzenghui_id23/newspaper_ysu.sql', '', '2014-04-06 21:35:55', null, null, '0', '4', '23', '1');
INSERT INTO `source` VALUES ('169', '百度面试60题', '经典中的经典', 'text/plain', '32330', '', 'uploads/u_admin_id21/cloudprint.sql', null, '2014-04-07 15:34:22', null, null, '0', '0', '21', '0');
INSERT INTO `source` VALUES ('170', '大物习题解', '考试必备', 'application/octet-stream', '32330', '', 'uploads/u_admin_id21/cloudprint (1).sql', null, '2014-04-07 15:42:19', null, null, '0', '0', '21', '0');
INSERT INTO `source` VALUES ('171', '毛概复习题全集', '吐血推荐', 'application/octet-stream', '681184', '', 'uploads/u_admin_id21/Firefox-latest.exe', null, '2014-04-07 15:42:19', null, null, '0', '0', '21', '0');
INSERT INTO `source` VALUES ('172', '电子技术复习题全集', '吐血推荐', 'application/octet-stream', '681184', '', 'uploads/u_admin_id21/Firefox-latest.exe', '', '2014-04-07 15:42:19', null, null, '0', '0', '21', '0');
INSERT INTO `source` VALUES ('173', '电子技术复习题全集', '吐血推荐', 'application/octet-stream', '32330', '', 'uploads/u_admin_id21/cloudprint (4).sql', '', '2014-04-07 21:15:34', null, null, '0', '6', '21', '1');
INSERT INTO `source` VALUES ('174', '思想政治复习题全集', '考试必备', 'application/octet-stream', '780', '', 'uploads/u_admin_id21/Cool PDF Reader.lnk', '', '2014-04-07 21:15:34', null, null, '0', '6', '21', '1');
INSERT INTO `source` VALUES ('175', '考研数学', '必看', 'application/octet-stream', '646', '', 'uploads/u_admin_id21/eclipse.exe.lnk', '', '2014-04-07 21:15:34', null, null, '0', '0', '21', '1');
INSERT INTO `source` VALUES ('176', '寒蝉鸣泣之时', '考研必备', 'application/octet-stream', '611', '', 'uploads/u_admin_id21/proxy.exe.lnk', '', '2014-04-07 21:15:34', null, null, '0', '6', '21', '1');

-- ----------------------------
-- Table structure for s_cat
-- ----------------------------
DROP TABLE IF EXISTS `s_cat`;
CREATE TABLE `s_cat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '分类名称',
  `f_link` varchar(45) DEFAULT NULL COMMENT '父分类路径',
  `weight` float DEFAULT NULL COMMENT '排序权重',
  `f_id` bigint(20) DEFAULT NULL COMMENT '父级分类id',
  PRIMARY KEY (`id`),
  KEY `fk_s_cat_s_cat1_idx` (`f_id`),
  CONSTRAINT `fk_s_cat_s_cat1` FOREIGN KEY (`f_id`) REFERENCES `s_cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='资源分类表';

-- ----------------------------
-- Records of s_cat
-- ----------------------------
INSERT INTO `s_cat` VALUES ('0', '顶级', null, null, null);
INSERT INTO `s_cat` VALUES ('4', '计算机科学与技术', '0', '2', '0');
INSERT INTO `s_cat` VALUES ('5', '机械电子工程', '0', '1', '0');
INSERT INTO `s_cat` VALUES ('6', '考试专区', '0', '3', '0');
INSERT INTO `s_cat` VALUES ('7', '考研分享区', '0', '4', '0');
INSERT INTO `s_cat` VALUES ('8', '考研专区（免费分享区）', '0', '5', '0');
INSERT INTO `s_cat` VALUES ('9', '最新小说', '0', '6', '0');
INSERT INTO `s_cat` VALUES ('10', '模版专区', '0', '7', '0');

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
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
  KEY `fk_task_user3_idx` (`user_i_id`),
  CONSTRAINT `fk_task_printer1` FOREIGN KEY (`printer_id`) REFERENCES `printer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_user1` FOREIGN KEY (`user_c_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_user2` FOREIGN KEY (`user_b_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_user3` FOREIGN KEY (`user_i_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COMMENT='打印任务表';

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('114', '2', '21', '5', null, '1', '2014-04-06 11:26:42', '2014-04-06 11:27:10', null, null, '6', null);
INSERT INTO `task` VALUES ('116', '2', '21', '5', null, '1', '2014-04-06 15:02:39', '2014-04-06 15:18:54', null, null, '6', null);
INSERT INTO `task` VALUES ('117', '2', '23', '5', null, '1', '2014-04-06 21:36:32', '2014-04-06 21:36:44', null, null, '6', null);
INSERT INTO `task` VALUES ('118', '2', '23', '5', null, '1', '2014-04-07 12:13:27', '2014-04-07 12:29:58', null, null, '6', null);
INSERT INTO `task` VALUES ('119', '2', '23', '5', null, '1', '2014-04-07 12:40:03', '2014-04-07 12:40:15', null, null, '1', null);
INSERT INTO `task` VALUES ('120', '2', '23', '5', null, '1', '2014-04-07 12:40:52', '2014-04-07 12:41:06', null, null, '2', null);
INSERT INTO `task` VALUES ('121', null, '21', null, null, null, '2014-04-07 15:34:22', null, null, null, '0', null);

-- ----------------------------
-- Table structure for task_file
-- ----------------------------
DROP TABLE IF EXISTS `task_file`;
CREATE TABLE `task_file` (
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
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8 COMMENT='打印任务中的打印文件信息表';

-- ----------------------------
-- Records of task_file
-- ----------------------------
INSERT INTO `task_file` VALUES ('1', '91', '115', '1', '1', '1', '1', '1', null, null, '', '4');
INSERT INTO `task_file` VALUES ('2', '92', '115', '2', '1', '1', '1', '1', null, null, '', '4');
INSERT INTO `task_file` VALUES ('4', '93', '118', '1', '1', '1', '1', '1', null, null, '', '4');
INSERT INTO `task_file` VALUES ('5', '94', '119', '1', '1', '1', '1', '1', null, null, '', '4');
INSERT INTO `task_file` VALUES ('6', '96', '120', '1', '1', '1', '1', '1', null, null, '', '4');
INSERT INTO `task_file` VALUES ('7', '95', '121', '1', '1', '1', '1', '1', null, null, '', '4');
INSERT INTO `task_file` VALUES ('8', '97', '121', '1', '1', '1', '1', '1', null, null, '', '4');
INSERT INTO `task_file` VALUES ('15', '98', '121', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('22', '99', '121', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('23', '100', '121', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('24', '101', '121', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('25', '102', '121', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('32', '103', '118', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('33', '104', '118', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('34', '105', '118', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('37', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('39', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('40', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('41', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('42', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('43', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('44', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('46', '106', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('48', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('49', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('50', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('51', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('52', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('53', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('54', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('55', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('56', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('57', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('58', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('59', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('60', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('61', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('62', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('63', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('64', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('65', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('66', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('67', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('68', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('69', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('70', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('71', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('72', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('73', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('74', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('75', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('76', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('77', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('78', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('79', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('80', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('81', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('82', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('83', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('84', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('85', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('86', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('87', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('88', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('89', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('90', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('91', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('92', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('93', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('94', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('95', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('96', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('97', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('98', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('99', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('100', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('101', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('102', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('103', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('104', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('105', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('106', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('107', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('108', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('109', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('110', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('111', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('112', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('113', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('114', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('115', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('116', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('117', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('118', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('119', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('120', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('121', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('122', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('123', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('124', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('125', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('126', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('127', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('128', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('129', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('130', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('131', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('132', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('133', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('134', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('135', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('136', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('137', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('138', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('139', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('140', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('141', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('142', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('143', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('144', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('145', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('146', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('147', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('148', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('149', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('150', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('151', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('152', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('153', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('154', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('155', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('156', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('157', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('158', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('159', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('160', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('161', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('162', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('163', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('164', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('165', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('166', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('167', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('168', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('169', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('170', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('171', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('172', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('173', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('174', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('175', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('176', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('177', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('178', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('179', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('180', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('181', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('182', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('183', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('184', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('185', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('186', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('187', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('188', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('189', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('190', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('191', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('192', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('193', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('194', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('195', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('196', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('197', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('198', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('199', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('200', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('201', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('202', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('203', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('204', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('205', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('206', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('207', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('208', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('209', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('210', '106', '115', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('211', '107', '123', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('212', '107', '119', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('213', '107', '118', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('214', '108', '123', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('215', '110', '125', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('216', '110', '126', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('217', '109', '166', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('218', '112', '167', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('219', '114', '167', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('220', '116', '162', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('221', '117', '168', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('224', '118', '166', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('225', '119', '162', '1', '1', '1', '1', '1', null, null, '', '0');
INSERT INTO `task_file` VALUES ('226', '120', '168', '1', '1', '1', '1', '1', null, null, '', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='通用用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('5', '090104010106', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 11:12:21', null, null, null, null, null, '4', '1', null);
INSERT INTO `user` VALUES ('6', '090104010107', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 02:31:09', null, null, null, null, '127.0.0.1', '5', '1', null);
INSERT INTO `user` VALUES ('7', '090104010108', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 03:08:13', null, null, null, null, '127.0.0.1', '6', '1', null);
INSERT INTO `user` VALUES ('8', '090104010109', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 03:11:28', null, null, null, null, '127.0.0.1', '7', '1', null);
INSERT INTO `user` VALUES ('9', '090104010105', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 03:47:24', null, null, null, null, '127.0.0.1', '8', '1', null);
INSERT INTO `user` VALUES ('10', '090104010104', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 03:52:51', null, null, null, null, '127.0.0.1', '9', '1', null);
INSERT INTO `user` VALUES ('11', '090104010103', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 03:55:04', null, null, null, null, '127.0.0.1', '10', '1', null);
INSERT INTO `user` VALUES ('12', '090104010102', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 04:04:25', null, null, null, null, '127.0.0.1', '11', '1', null);
INSERT INTO `user` VALUES ('13', '090104010101', '4297f44b13955235245b2497399d7a93', '1', '2013-05-01 04:29:46', null, null, null, null, '127.0.0.1', '12', '1', null);
INSERT INTO `user` VALUES ('14', '090104010100', '4297f44b13955235245b2497399d7a93', '1', '2013-06-16 16:04:01', null, null, null, null, '127.0.0.1', '13', '1', null);
INSERT INTO `user` VALUES ('15', '090101010037', '4297f44b13955235245b2497399d7a93', '1', '2013-06-23 15:45:05', null, null, null, null, '127.0.0.1', '14', '1', null);
INSERT INTO `user` VALUES ('16', '090104010116', '4297f44b13955235245b2497399d7a93', '1', '2013-06-23 15:50:06', null, null, null, null, '127.0.0.1', '15', '1', null);
INSERT INTO `user` VALUES ('17', '090104010117', '4297f44b13955235245b2497399d7a93', '1', '2013-06-23 15:54:14', null, null, null, null, '127.0.0.1', '16', '1', null);
INSERT INTO `user` VALUES ('18', 'BAIJICHUAN', '52bdc0c7c6501e4e9eaa46f48b825128', '1', '2013-09-08 09:45:55', null, null, null, null, '202.206.249.79', '17', '1', null);
INSERT INTO `user` VALUES ('19', 'libeina', '076ae99a92d01bb2d86fa785e0025928', '1', '2013-09-09 10:41:40', null, null, null, null, '202.206.249.193', '18', '1', null);
INSERT INTO `user` VALUES ('20', 'xiaoxuesheng', '72585e33f348d5756dd979c2192a9899', '1', '2013-09-09 10:43:46', null, null, null, null, '202.206.249.193', '19', '1', null);
INSERT INTO `user` VALUES ('21', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '2014-04-01 20:58:13', null, null, null, null, '127.0.0.1', '20', '1', null);
INSERT INTO `user` VALUES ('22', 'wanghibo', 'e10adc3949ba59abbe56e057f20f883e', '1', '2014-03-03 15:46:55', null, null, null, null, '127.0.0.1', '21', '1', null);
INSERT INTO `user` VALUES ('23', 'xuzenghui', '59ff8ab35555b6f71eba5d26a4fc2067', '1', '2014-04-03 15:50:10', null, null, null, null, '127.0.0.1', '22', '1', null);

-- ----------------------------
-- Table structure for user_business
-- ----------------------------
DROP TABLE IF EXISTS `user_business`;
CREATE TABLE `user_business` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商业用户信息表';

-- ----------------------------
-- Records of user_business
-- ----------------------------
INSERT INTO `user_business` VALUES ('3', '5', null, null, null, null, null, '202.206.249.6', '8018');
INSERT INTO `user_business` VALUES ('4', '23', null, null, null, null, null, '', '');

-- ----------------------------
-- Table structure for user_commen
-- ----------------------------
DROP TABLE IF EXISTS `user_commen`;
CREATE TABLE `user_commen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(15) DEFAULT NULL COMMENT '学号',
  `real_name` varchar(4) DEFAULT NULL COMMENT '真实姓名',
  `idcard_dir` varchar(200) DEFAULT NULL COMMENT 'id卡存储路径',
  `verify_state` tinyint(4) DEFAULT NULL COMMENT '真实性验证的状态',
  `verify_time` varchar(45) DEFAULT NULL COMMENT '真实性验证的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='普通用户信息表';

-- ----------------------------
-- Records of user_commen
-- ----------------------------
INSERT INTO `user_commen` VALUES ('4', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('5', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('6', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('7', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('8', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('9', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('10', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('11', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('12', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('13', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('14', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('15', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('16', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('17', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('18', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('19', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('20', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('21', null, null, null, null, null);
INSERT INTO `user_commen` VALUES ('22', null, null, null, null, null);

-- ----------------------------
-- Table structure for user_interface
-- ----------------------------
DROP TABLE IF EXISTS `user_interface`;
CREATE TABLE `user_interface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(100) DEFAULT NULL COMMENT '接口站点网址',
  `site_name` varchar(45) DEFAULT NULL COMMENT '接口站点名称',
  `host_name` varchar(4) DEFAULT NULL COMMENT '站长姓名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口用户信息表';

-- ----------------------------
-- Records of user_interface
-- ----------------------------
