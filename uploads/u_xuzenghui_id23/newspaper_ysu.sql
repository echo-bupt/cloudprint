-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 03 月 12 日 11:05
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `newspaper@ysu`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `mid` int(8) NOT NULL AUTO_INCREMENT COMMENT '评论表的主键id',
  `content` varchar(100) NOT NULL COMMENT '评论表内容',
  `name` varchar(16) CHARACTER SET utf16 NOT NULL COMMENT '评论的人的署名',
  `time` varchar(16) NOT NULL COMMENT '评论发表时间',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=44 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`mid`, `content`, `name`, `time`) VALUES
(1, 'ssssss', 'fffff', '1344'),
(2, '嘿嘿', 'haha', '0'),
(3, '试试啊', '', ''),
(4, '怎么回事', '', ''),
(5, '看看怎么样啊', '', '1394598327'),
(6, '是啊', '', '1394598868'),
(7, '怎么了', '1', '1394598889'),
(8, '啊啊啊', '', '1394599133'),
(9, 'sss', '', '1394599199'),
(10, 'sss', '', '1394599221'),
(11, 'sss', '', '1394599286'),
(12, 'sss', '', '1394599356'),
(13, 'sss', '', '1394599407'),
(14, '试试', '匿名网友', '1394599582'),
(15, '试试', '111', '1394599658'),
(16, '轻轻巧巧', '222', '1394599693'),
(17, 'sss', '', '1394599777'),
(18, 'sss', '匿名网友', '1394599826'),
(19, 'sss', '121', '1394599836'),
(20, 'sss', '333', '1394599844'),
(21, '啊啊啊啊', 'sss', '1394599879'),
(22, '试试', '匿名网友', '1394599942'),
(23, '我说呢', '匿名网友', '1394599970'),
(24, '哈哈', '111', '1394603046'),
(25, '啊啊啊', '啊啊', '1394603291'),
(27, 'sssww', '匿名网友', '1394615146'),
(28, 'SSS', '匿名网友', '1394616002'),
(29, 'aaaaa', '匿名网友', '1394616754'),
(30, 'aaaaa', '匿名网友', '1394616754'),
(31, 'aaaa', '匿名网友', '1394616758'),
(32, 'aaaa', '匿名网友', '1394616758'),
(33, 'aaaa', '匿名网友', '1394616766'),
(34, 'aaaa', '匿名网友', '1394616766'),
(35, '啊啊啊', '匿名网友', '1394616773'),
(36, '啊啊啊', '匿名网友', '1394616773'),
(37, '1111', '匿名网友', '1394616781'),
(38, '1111', '匿名网友', '1394616781'),
(39, 'eeee', '匿名网友', '1394616809'),
(40, 'eeee', '匿名网友', '1394616813'),
(41, '三十岁', '匿名网友', '1394617063'),
(42, 'sjhi', '匿名网友', '1394617339'),
(43, 'sss', '匿名网友', '1394619546');

-- --------------------------------------------------------

--
-- 表的结构 `newscon`
--

CREATE TABLE IF NOT EXISTS `newscon` (
  `cid` int(8) NOT NULL AUTO_INCREMENT COMMENT '新闻内容表主键',
  `content` text NOT NULL COMMENT '新闻内容',
  `vid` int(8) NOT NULL COMMENT '用于和版关联的字段',
  `coords` varchar(32) NOT NULL COMMENT '该条新闻在前端的显示位置',
  `time` varchar(16) NOT NULL COMMENT '新闻发表时间',
  `title` varchar(64) NOT NULL COMMENT '新闻题目',
  `click` int(8) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='新闻内容表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `newscon`
--

INSERT INTO `newscon` (`cid`, `content`, `vid`, `coords`, `time`, `title`, `click`) VALUES
(1, '<div align="center">\r\n	<p>\r\n		<span style="font-size:32px;">我校第18届"潮汐杯"辩论赛开赛</span> \r\n	</p>\r\n	<p align="left">\r\n		<span style="font-size:32px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:18px;">&nbsp;&nbsp;&nbsp;</span><span style="font-size:18px;">燕山大学源于哈尔滨工业大学，办学历史悠久，始建于1920年，1958 年燕山大学哈尔滨工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重型机械学院。1960年成建制独立办学，定名东北重型机械学院，隶属于机械工业部（机械部四小龙之一）。 燕山大学于1961年开始招收培养研究生，1978年恢复招收培养硕士研究生，是全国首批硕士研究生学位授权单位，1983年获得博士学位授予权。1978年该校被国务院确定为全国重点大学。1984年学校开始启用现校名“燕山大学”，1985 年至1997 年该校整体南迁河北省秦皇岛市，1997 年整体更名为燕山大学。1998年，由原机械工业部划到河北省，实行中央与地方共建，以河北省管理为主。2006年，国防科工委和河北省共建燕山大学；2009年，工业和信息化部、国防科工局和河北省共建燕山大学。燕山大学沿海区位优势明显，是中国最美丽的大学之一。燕山大学地处环渤海经济圈的核心地区京津冀都市圈区域内，所在城市为中国首批14个沿海开放城市河北省秦皇岛市；该校将依托河北沿海地区发展规划的政策优势，加大服务区域发展力度，积极推进河北沿海地区成为全国综合实力较强的地区之一。燕山大学占地面积4000亩，建筑面积100万平方米，优美典雅的环境内充满着丰富多彩、魅力无穷的校园生活。校园以现代建筑为基调，建筑风格简洁流畅。校园内绿草青青，树木成荫，湖光山色，景色优雅的环境让莘莘学子感受到自然的风景和浓厚的人文气息。</span><br />\r\n<br />\r\n<span style="font-size:18px;">厚德载物，博学强识，求真求是。博大精深的历史文化，源远流长。</span><br />\r\n<br />\r\n<span style="font-size:18px;">依山傍海，云气潮升，山海燕鸣。诗情画意的四季光影，秀美怡人。</span><br />\r\n<br />\r\n<span style="font-size:18px;">名师荟萃，英才云集，桃李满园。浓郁深厚的人文气息，蔚然成风。</span><br />\r\n<br />\r\n<span style="font-size:18px;">每一个燕大人都想把这些在青春年华里相伴左右的画面永远清晰的保留在记忆深处：</span><br />\r\n<br />\r\n&nbsp;<br />\r\n</span> \r\n	</p>\r\n</div>', 1, '0,125,270,275', '1394380800', '我校18届"潮汐杯"开赛了', 246),
(2, '<div align="center">\r\n	<p>\r\n		<span style="font-size:32px;">青年志愿者协会举办"爱心大使"招募活动</span>\r\n	</p>\r\n	<p align="left">\r\n		&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:16px;">&nbsp;&nbsp; </span><span style="font-size:16px;">燕山大学源于哈尔滨工业大学，办学历史悠久，始建于1920年，1958 年燕山大学哈尔滨工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重型机械学院。1960年成建制独立办学，定名东北重型机械学院，隶属于机械工业部（机械部四小龙之一）。 燕山大学于1961年开始招收培养研究生，1978年恢复招收培养硕士研究生，是全国首批硕士研究生学位授权单位，1983年获得博士学位授予权。1978年该校被国务院确定为全国重点大学。1984年学校开始启用现校名“燕山大学”，1985 年至1997 年该校整体南迁河北省秦皇岛市，1997 年整体更名为燕山大学。1998年，由原机械工业部划到河北省，实行中央与地方共建，以河北省管理为主。2006年，国防科工委和河北省共建燕山大学；2009年，工业和信息化部、国防科工局和河北省共建燕山大学。燕山大学沿海区位优势明显，是中国最美丽的大学之一。燕山大学地处环渤海经济圈的核心地区京津冀都市圈区域内，所在城市为中国首批14个沿海开放城市河北省秦皇岛市；该校将依托河北沿海地区发展规划的政策优势，加大服务区域发展力度，积极推进河北沿海地区成为全国综合实力较强的地区之一。燕山大学占地面积4000亩，建筑面积100万平方米，优美典雅的环境内充满着丰富多彩、魅力无穷的校园生活。校园以现代建筑为基调，建筑风格简洁流畅。校园内绿草青青，树木成荫，湖光山色，景色优雅的环境让莘莘学子感受到自然的风景和浓厚的人文气息。</span><br />\r\n<br />\r\n<span style="font-size:16px;">厚德载物，博学强识，求真求是。博大精深的历史文化，源远流长。</span><br />\r\n<br />\r\n<span style="font-size:16px;">依山傍海，云气潮升，山海燕鸣。诗情画意的四季光影，秀美怡人。</span><br />\r\n<br />\r\n<span style="font-size:16px;">名师荟萃，英才云集，桃李满园。浓郁深厚的人文气息，蔚然成风。</span><br />\r\n<br />\r\n<span style="font-size:16px;">每一个燕大人都想把这些在青春年华里相伴左右的画面永远清晰的保留在记忆深处：</span><br />\r\n<br />\r\n&nbsp;<br />\r\n<span style="font-size:32px;"></span><span style="font-size:32px;"></span>\r\n	</p>\r\n</div>', 1, '270,125,405,320', '1394380800', '爱心招募', 19),
(3, '<div align="center">\r\n	<p>\r\n		<span style="font-size:32px;">燕山大学举办2013年迎新晚会</span>\r\n	</p>\r\n	<p align="left">\r\n		<span style="font-size:32px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:16px;">&nbsp;</span><span style="font-size:16px;">燕山大学源于哈尔滨工业大学，办学历史悠久，始建于1920年，1958 年燕山大学哈尔滨工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重型机械学院。1960年成建制独立办学，定名东北重型机械学院，隶属于机械工业部（机械部四小龙之一）。 燕山大学于1961年开始招收培养研究生，1978年恢复招收培养硕士研究生，是全国首批硕士研究生学位授权单位，1983年获得博士学位授予权。1978年该校被国务院确定为全国重点大学。1984年学校开始启用现校名“燕山大学”，1985 年至1997 年该校整体南迁河北省秦皇岛市，1997 年整体更名为燕山大学。1998年，由原机械工业部划到河北省，实行中央与地方共建，以河北省管理为主。2006年，国防科工委和河北省共建燕山大学；2009年，工业和信息化部、国防科工局和河北省共建燕山大学。燕山大学沿海区位优势明显，是中国最美丽的大学之一。燕山大学地处环渤海经济圈的核心地区京津冀都市圈区域内，所在城市为中国首批14个沿海开放城市河北省秦皇岛市；该校将依托河北沿海地区发展规划的政策优势，加大服务区域发展力度，积极推进河北沿海地区成为全国综合实力较强的地区之一。燕山大学占地面积4000亩，建筑面积100万平方米，优美典雅的环境内充满着丰富多彩、魅力无穷的校园生活。校园以现代建筑为基调，建筑风格简洁流畅。校园内绿草青青，树木成荫，湖光山色，景色优雅的环境让莘莘学子感受到自然的风景和浓厚的人文气息。</span><br />\r\n<br />\r\n<span style="font-size:16px;">厚德载物，博学强识，求真求是。博大精深的历史文化，源远流长。</span><br />\r\n<br />\r\n<span style="font-size:16px;">依山傍海，云气潮升，山海燕鸣。诗情画意的四季光影，秀美怡人。</span><br />\r\n<br />\r\n<span style="font-size:16px;">名师荟萃，英才云集，桃李满园。浓郁深厚的人文气息，蔚然成风。</span><br />\r\n<br />\r\n<span style="font-size:16px;">每一个燕大人都想把这些在青春年华里相伴左右的画面永远清晰的保留在记忆深处：</span><br />\r\n<br />\r\n&nbsp;<br />\r\n</span>\r\n	</p>\r\n</div>', 1, '0,275,270,405', '1394380800', '迎新晚会', 15),
(4, '<div align="center">\r\n	<p>\r\n		<span style="font-size:32px;">2013国庆视角</span>\r\n	</p>\r\n	<p align="left">\r\n		<span style="font-size:32px;">燕山大学源于哈尔滨工业大学，办学历史悠久，始建于1920年，1958 年燕山大学哈尔滨工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重型机械学院。1960年成建制独立办学，定名东北重型机械学院，隶属于机械工业部（机械部四小龙之一）。 燕山大学于1961年开始招收培养研究生，1978年恢复招收培养硕士研究生，是全国首批硕士研究生学位授权单位，1983年获得博士学位授予权。1978年该校被国务院确定为全国重点大学。1984年学校开始启用现校名“燕山大学”，1985 年至1997 年该校整体南迁河北省秦皇岛市，1997 年整体更名为燕山大学。1998年，由原机械工业部划到河北省，实行中央与地方共建，以河北省管理为主。2006年，国防科工委和河北省共建燕山大学；2009年，工业和信息化部、国防科工局和河北省共建燕山大学。燕山大学沿海区位优势明显，是中国最美丽的大学之一。燕山大学地处环渤海经济圈的核心地区京津冀都市圈区域内，所在城市为中国首批14个沿海开放城市河北省秦皇岛市；该校将依托河北沿海地区发展规划的政策优势，加大服务区域发展力度，积极推进河北沿海地区成为全国综合实力较强的地区之一。燕山大学占地面积4000亩，建筑面积100万平方米，优美典雅的环境内充满着丰富多彩、魅力无穷的校园生活。校园以现代建筑为基调，建筑风格简洁流畅。校园内绿草青青，树木成荫，湖光山色，景色优雅的环境让莘莘学子感受到自然的风景和浓厚的人文气息。<br />\r\n<br />\r\n厚德载物，博学强识，求真求是。博大精深的历史文化，源远流长。<br />\r\n<br />\r\n依山傍海，云气潮升，山海燕鸣。诗情画意的四季光影，秀美怡人。<br />\r\n<br />\r\n名师荟萃，英才云集，桃李满园。浓郁深厚的人文气息，蔚然成风。<br />\r\n<br />\r\n每一个燕大人都想把这些在青春年华里相伴左右的画面永远清晰的保留在记忆深处：<br />\r\n<br />\r\n&nbsp;<span style="font-size:16px;"></span><br />\r\n</span>\r\n	</p>\r\n</div>', 1, '270,320,405,600', '1394380800', '国庆视角', 25),
(5, '<div align="center">\r\n	<p>\r\n		<span style="font-size:32px;">图片新闻</span>\r\n	</p>\r\n	<p align="left">\r\n		<span style="font-size:16px;">燕山大学源于哈尔滨工业大学，办学历史悠久，始建于1920年，1958 年燕山大学哈尔滨工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重工业大学重型机械系及相关专业迁至工业重镇齐齐哈尔市富拉尔基区，组建了哈尔滨工业大学重型机械学院。1960年成建制独立办学，定名东北重型机械学院，隶属于机械工业部（机械部四小龙之一）。 燕山大学于1961年开始招收培养研究生，1978年恢复招收培养硕士研究生，是全国首批硕士研究生学位授权单位，1983年获得博士学位授予权。1978年该校被国务院确定为全国重点大学。1984年学校开始启用现校名“燕山大学”，1985 年至1997 年该校整体南迁河北省秦皇岛市，1997 年整体更名为燕山大学。1998年，由原机械工业部划到河北省，实行中央与地方共建，以河北省管理为主。2006年，国防科工委和河北省共建燕山大学；2009年，工业和信息化部、国防科工局和河北省共建燕山大学。燕山大学沿海区位优势明显，是中国最美丽的大学之一。燕山大学地处环渤海经济圈的核心地区京津冀都市圈区域内，所在城市为中国首批14个沿海开放城市河北省秦皇岛市；该校将依托河北沿海地区发展规划的政策优势，加大服务区域发展力度，积极推进河北沿海地区成为全国综合实力较强的地区之一。燕山大学占地面积4000亩，建筑面积100万平方米，优美典雅的环境内充满着丰富多彩、魅力无穷的校园生活。校园以现代建筑为基调，建筑风格简洁流畅。校园内绿草青青，树木成荫，湖光山色，景色优雅的环境让莘莘学子感受到自然的风景和浓厚的人文气息。</span><br />\r\n<br />\r\n<span style="font-size:16px;">厚德载物，博学强识，求真求是。博大精深的历史文化，源远流长。</span><br />\r\n<br />\r\n<span style="font-size:16px;">依山傍海，云气潮升，山海燕鸣。诗情画意的四季光影，秀美怡人。</span><br />\r\n<br />\r\n<span style="font-size:16px;">名师荟萃，英才云集，桃李满园。浓郁深厚的人文气息，蔚然成风。</span><br />\r\n<br />\r\n<span style="font-size:16px;">每一个燕大人都想把这些在青春年华里相伴左右的画面永远清晰的保留在记忆深处：</span><br />\r\n<br />\r\n<span style="font-size:16px;">&nbsp;</span><br />\r\n<span style="font-size:32px;"></span><span style="font-size:32px;"></span>\r\n	</p>\r\n</div>', 1, '0,405,270,600', '1394380800', '图片新闻', 18);

-- --------------------------------------------------------

--
-- 表的结构 `newspaper`
--

CREATE TABLE IF NOT EXISTS `newspaper` (
  `nid` int(8) NOT NULL AUTO_INCREMENT COMMENT '报纸表主键id',
  `time` varchar(32) NOT NULL COMMENT '发布时间',
  `num` int(8) NOT NULL COMMENT '评分次数',
  `total` int(8) NOT NULL COMMENT '总分数',
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='报纸表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `newspaper`
--

INSERT INTO `newspaper` (`nid`, `time`, `num`, `total`) VALUES
(1, '1394380800', 2, 6),
(2, '1394294400', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `versions`
--

CREATE TABLE IF NOT EXISTS `versions` (
  `vid` int(8) NOT NULL AUTO_INCREMENT COMMENT '版本表主键id',
  `sort` int(16) NOT NULL COMMENT '版本号',
  `nid` int(8) NOT NULL COMMENT '与报纸表关联的字段',
  `theme` varchar(64) NOT NULL COMMENT '某版的主题内容',
  `is_display` tinyint(2) NOT NULL DEFAULT '1' COMMENT '该板块是否显示',
  `thumb` varchar(100) NOT NULL COMMENT '版的缩略图地址',
  `time` varchar(16) NOT NULL COMMENT '板块发表时间',
  PRIMARY KEY (`vid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='版本表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `versions`
--

INSERT INTO `versions` (`vid`, `sort`, `nid`, `theme`, `is_display`, `thumb`, `time`) VALUES
(1, 1, 1, '两会', 1, 'http://localhost/myblog/upload/79331394453905.jpg', '1394380800'),
(2, 2, 1, '十八大', 1, 'http://localhost/myblog/upload/69041394453976.jpg', '1394380800'),
(3, 3, 1, '燕大', 1, 'http://localhost/myblog/upload/75911394453993.jpg', '1394380800'),
(4, 4, 1, '青年社', 1, 'http://localhost/myblog/upload/18941394454010.jpg', '1394380800'),
(5, 1, 2, '测试', 1, 'http://localhost/myblog/upload/95571394454460.jpg', '1394294400');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
