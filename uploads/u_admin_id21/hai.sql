/*
Navicat MySQL Data Transfer

Source Server         : duty
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : hai

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-05-16 22:12:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for card
-- ----------------------------
DROP TABLE IF EXISTS `card`;
CREATE TABLE `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasword` varchar(255) DEFAULT NULL,
  `remain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of card
-- ----------------------------
INSERT INTO `card` VALUES ('1', '2323', '1000');
INSERT INTO `card` VALUES ('2', '2323', '1000');
INSERT INTO `card` VALUES ('3', '2323', '1000');
INSERT INTO `card` VALUES ('4', '2323', '1000');
INSERT INTO `card` VALUES ('5', '2323', '1000');
INSERT INTO `card` VALUES ('6', '2323', '1000');
INSERT INTO `card` VALUES ('7', '2323', '1000');
INSERT INTO `card` VALUES ('8', '2323', '1000');
INSERT INTO `card` VALUES ('9', '2323', '1000');
INSERT INTO `card` VALUES ('10', '2323', '1000');
INSERT INTO `card` VALUES ('11', '2323', '1000');
INSERT INTO `card` VALUES ('12', '2323', '1000');
INSERT INTO `card` VALUES ('13', '2323', '1000');
INSERT INTO `card` VALUES ('14', '2323', '1000');
INSERT INTO `card` VALUES ('15', '2323', '1000');
INSERT INTO `card` VALUES ('16', '2323', '1000');
INSERT INTO `card` VALUES ('17', '2323', '1000');

-- ----------------------------
-- Table structure for consume
-- ----------------------------
DROP TABLE IF EXISTS `consume`;
CREATE TABLE `consume` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `discount` float(11,2) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `way` tinyint(2) DEFAULT NULL,
  `ordertime` datetime DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of consume
-- ----------------------------
INSERT INTO `consume` VALUES ('3', '波', '1', '4.00', '8.00', '0', null, null, null, null, null, '不知道好不好');
INSERT INTO `consume` VALUES ('4', '2', '2', '5.00', '9.00', '1', null, null, null, null, null, '不知道好不好');
INSERT INTO `consume` VALUES ('5', '3', '3', '6.00', '10.00', '2', '150', '1', null, '2014-05-11 11:04:25', '2014-05-20 11:04:28', '不错');
INSERT INTO `consume` VALUES ('6', '4', '4', '7.00', '8.00', '0', null, null, null, null, null, '不知道好不好');
INSERT INTO `consume` VALUES ('7', '5', '5', '8.00', '9.00', '2', '150', '0', null, '2014-05-06 11:05:41', '2014-05-07 11:05:44', '还行便宜');
INSERT INTO `consume` VALUES ('24', 'udy4', '4', '6.00', '0.00', 'end', '0.0', '0', null, '2014-05-16 21:51:43', '2014-05-16 21:52:23', '不错');
INSERT INTO `consume` VALUES ('25', 'udy4', '4', '6.00', '0.00', 'cancel', '0', '0', '2014-05-16 21:52:58', null, null, null);

-- ----------------------------
-- Table structure for park
-- ----------------------------
DROP TABLE IF EXISTS `park`;
CREATE TABLE `park` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lat` float(20,6) DEFAULT NULL,
  `lng` float(20,6) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `discount` float(11,2) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `now` int(11) DEFAULT NULL,
  `ordered` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of park
-- ----------------------------
INSERT INTO `park` VALUES ('3', 'park3', '22.600000', '33.000000', '5.00', null, '334', '0', '0');
INSERT INTO `park` VALUES ('4', 'park4', '23.400000', '250.000000', '6.00', null, '334', '17', '9');
INSERT INTO `park` VALUES ('5', 'park5', '100.250000', '22.000000', '7.00', null, '334', '0', '0');
INSERT INTO `park` VALUES ('6', 'park6', '80.199997', '1.000000', '8.00', null, '334', '0', '0');
INSERT INTO `park` VALUES ('7', 'park7', '11.000000', '220.000000', '9.00', null, '334', '0', '0');

-- ----------------------------
-- Table structure for share
-- ----------------------------
DROP TABLE IF EXISTS `share`;
CREATE TABLE `share` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `discount` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `log` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `max` int(20) DEFAULT NULL,
  `now` int(20) DEFAULT NULL,
  `ordered` int(20) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of share
-- ----------------------------
INSERT INTO `share` VALUES ('1', '8', '22.5', '55.6', 'udy4', '1', null, null, '2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '2', 's', null);
INSERT INTO `user` VALUES ('3', '2', '23s', null);
INSERT INTO `user` VALUES ('4', '2', '23a', null);
INSERT INTO `user` VALUES ('5', '2', '23b', null);
INSERT INTO `user` VALUES ('6', '2', '23c', null);
INSERT INTO `user` VALUES ('7', '2', '23d', null);
INSERT INTO `user` VALUES ('8', '2', '23f', null);
INSERT INTO `user` VALUES ('9', 'p1', 'whb', null);
INSERT INTO `user` VALUES ('11', 'p1', 'wanghai', null);
INSERT INTO `user` VALUES ('12', 'p11', 'wanghaitian', null);
INSERT INTO `user` VALUES ('29', 'pwd', 'udy4', '0');
INSERT INTO `user` VALUES ('30', '2341', 'udy', null);
