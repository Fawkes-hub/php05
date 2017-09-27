/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50711
Source Host           : 127.0.0.1:3306
Source Database       : ss19_shop

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-09-25 18:53:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `typeid` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `store` int(11) NOT NULL,
  `sales` int(11) NOT NULL DEFAULT '0',
  `pic` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `company` varchar(255) NOT NULL,
  `descr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('9', '小米6           ', '41', '2499.00', '10', '1', '789442219c1d513a5516dabcd274077d.jpg', '0', '小米公司', '陶瓷尊享版 6GB+128GB\r\n骁龙835 \r\n最高主频 2.45GHz\r\nAdreno 540 \r\n');
INSERT INTO `goods` VALUES ('10', '小米note3   ', '41', '2399.00', '100', '1', 'c4e52eca206ae382c9bdf789f81ad1d5.jpg', '0', '小米公司', '小米222222222222222');
INSERT INTO `goods` VALUES ('11', '小米Mix2        ', '41', '3399.00', '100', '1', '13d8ccb3f28e678d738205e32950fd51.jpg', '0', '小米公司', '小米MIX');
INSERT INTO `goods` VALUES ('12', '小米MAX2    ', '41', '1599.00', '100', '1', 'e05c38751badf916a153d2e64b090246.jpg', '0', '小米公司', '小米MAX2');
INSERT INTO `goods` VALUES ('13', '红米5A     ', '42', '599.00', '100', '1', 'dfbf82554901a3a6509d6e690176f1ed.jpg', '0', '小米公司红米', '红米');
INSERT INTO `goods` VALUES ('14', '红米5A高配版    ', '42', '899.00', '100', '1', 'fef554bd0c247d9cc2c00dfc43b5be21.jpg', '0', '小米公司红米', '红米5A');
INSERT INTO `goods` VALUES ('15', '小米笔记本Air 12.5``', '45', '3599.00', '100', '1', 'd135eb3708bbc4510c790f8a9be3ced3.jpg', '0', '小米公司', '小米笔记本Air 12.5``');
INSERT INTO `goods` VALUES ('16', '小米笔记本Air 13.3``', '45', '4999.00', '100', '1', '9ddf4185f5eeced418942e8170b0eca7.jpg', '0', '小米公司', '小米笔记本13.3``');
INSERT INTO `goods` VALUES ('17', '小米平板2', '46', '1599.00', '100', '1', '259b19a96904f896e66453883852a7a0.png', '0', '小米公司', '小米笔记本');
INSERT INTO `goods` VALUES ('18', '红米Note 4X  ', '42', '999.00', '100', '1', '24ebaa33438b2720c1ed367ef8b3db12.jpg', '0', '小米公司', '小米红米Note 4X');
INSERT INTO `goods` VALUES ('19', '红米4X', '42', '799.00', '100', '1', 'f516a12997c220f98877a8ace5cf2932.jpg', '0', '小米公司', '红米4X');
INSERT INTO `goods` VALUES ('20', '小米5X', '28', '1299.00', '100', '1', '3ba8a2a7248d687288237c4b187739d7.jpg', '0', '小米公司', '小米5X');
INSERT INTO `goods` VALUES ('21', '123', '61', '123.00', '1', '1', 'edc6b57f20163c3286e820f23f544350.png', '0', '1', '1');

-- ----------------------------
-- Table structure for hyperlink
-- ----------------------------
DROP TABLE IF EXISTS `hyperlink`;
CREATE TABLE `hyperlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkname` varchar(18) NOT NULL,
  `linkadd` varchar(255) NOT NULL,
  `display` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hyperlink
-- ----------------------------
INSERT INTO `hyperlink` VALUES ('1', '百度', 'https://www.baidu.com', '0');
INSERT INTO `hyperlink` VALUES ('2', '小米', 'https://www.mi.com', '0');
INSERT INTO `hyperlink` VALUES ('3', '兄弟连教育', 'http://php.itxdl.cn/', '0');
INSERT INTO `hyperlink` VALUES ('4', '小米', 'https://www.mi.com', '1');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `linkname` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `code` char(6) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('152', '27', '11111', '犀浦金樽三街', '18880407560', '1000', '2499.00', '0');
INSERT INTO `orders` VALUES ('153', '27', '11111', '犀浦金樽三街', '18880407560', '1000', '7398.00', '0');
INSERT INTO `orders` VALUES ('154', '28', '1212', '犀浦金樽三街', '18880407560', '11', '7498.00', '2');
INSERT INTO `orders` VALUES ('155', '1', '冯轲', '犀浦金樽三街', '18880407560', '10000', '5998.00', '0');
INSERT INTO `orders` VALUES ('156', '1', '冯轲', '犀浦金樽三街', '18880407560', '10000', '2399.00', '0');
INSERT INTO `orders` VALUES ('157', '1', '冯轲', '犀浦金樽三街', '18880407560', '10000', '3399.00', '0');
INSERT INTO `orders` VALUES ('158', '1', '冯轲', '犀浦金樽三街', '18880407560', '10000', '3399.00', '2');

-- ----------------------------
-- Table structure for orders_u
-- ----------------------------
DROP TABLE IF EXISTS `orders_u`;
CREATE TABLE `orders_u` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `gname` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `gnum` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders_u
-- ----------------------------
INSERT INTO `orders_u` VALUES ('62', '152', '9', '小米6         ', '2499.00', '1', '27', '789442219c1d513a5516dabcd274077d.jpg');
INSERT INTO `orders_u` VALUES ('63', '153', '10', '小米note3   ', '2399.00', '1', '27', 'c4e52eca206ae382c9bdf789f81ad1d5.jpg');
INSERT INTO `orders_u` VALUES ('64', '153', '16', '小米笔记本Air 13.3``', '4999.00', '1', '27', '9ddf4185f5eeced418942e8170b0eca7.jpg');
INSERT INTO `orders_u` VALUES ('65', '154', '9', '小米6           ', '2499.00', '1', '28', '789442219c1d513a5516dabcd274077d.jpg');
INSERT INTO `orders_u` VALUES ('66', '154', '16', '小米笔记本Air 13.3``', '4999.00', '1', '28', '9ddf4185f5eeced418942e8170b0eca7.jpg');
INSERT INTO `orders_u` VALUES ('67', '155', '10', '小米note3   ', '2399.00', '1', '1', 'c4e52eca206ae382c9bdf789f81ad1d5.jpg');
INSERT INTO `orders_u` VALUES ('68', '155', '15', '小米笔记本Air 12.5``', '3599.00', '1', '1', 'd135eb3708bbc4510c790f8a9be3ced3.jpg');
INSERT INTO `orders_u` VALUES ('69', '156', '10', '小米note3   ', '2399.00', '1', '1', 'c4e52eca206ae382c9bdf789f81ad1d5.jpg');
INSERT INTO `orders_u` VALUES ('70', '157', '11', '小米Mix2        ', '3399.00', '1', '1', '13d8ccb3f28e678d738205e32950fd51.jpg');
INSERT INTO `orders_u` VALUES ('71', '158', '11', '小米Mix2        ', '3399.00', '1', '1', '13d8ccb3f28e678d738205e32950fd51.jpg');

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `display` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('28', '手机 | 配件', '0', '0,', '0');
INSERT INTO `type` VALUES ('30', '平板 | 笔记本', '0', '0,', '0');
INSERT INTO `type` VALUES ('31', '电视 | 盒子', '0', '0,', '0');
INSERT INTO `type` VALUES ('32', '智能硬件', '0', '0,', '0');
INSERT INTO `type` VALUES ('33', '耳机 | 音响', '0', '0,', '0');
INSERT INTO `type` VALUES ('41', '小米手机', '28', '0,28,', '0');
INSERT INTO `type` VALUES ('42', '红米', '28', '0,28,', '0');
INSERT INTO `type` VALUES ('43', '配件', '28', '0,28,', '0');
INSERT INTO `type` VALUES ('44', '米粉卡', '28', '0,28,', '0');
INSERT INTO `type` VALUES ('45', '笔记本', '30', '0,30,', '0');
INSERT INTO `type` VALUES ('46', '平板', '30', '0,30,', '0');
INSERT INTO `type` VALUES ('47', '电脑配件', '30', '0,30,', '0');
INSERT INTO `type` VALUES ('48', '智能电视', '31', '0,31,', '0');
INSERT INTO `type` VALUES ('49', '小米盒子', '31', '0,31,', '0');
INSERT INTO `type` VALUES ('50', '附属配件', '31', '0,31,', '0');
INSERT INTO `type` VALUES ('51', '耳塞式', '33', '0,33,', '0');
INSERT INTO `type` VALUES ('52', '头戴式', '33', '0,33,', '0');
INSERT INTO `type` VALUES ('53', '蓝牙音箱', '33', '0,33,', '0');
INSERT INTO `type` VALUES ('54', '线材 | 支架', '0', '0,', '0');
INSERT INTO `type` VALUES ('55', '箱包 | 服饰', '0', '0,', '0');
INSERT INTO `type` VALUES ('56', '箱包', '55', '0,55,', '0');
INSERT INTO `type` VALUES ('57', '服饰', '55', '0,55,', '0');
INSERT INTO `type` VALUES ('58', '运动鞋 板鞋', '55', '0,55,', '0');
INSERT INTO `type` VALUES ('59', '眼镜', '55', '0,55,', '0');
INSERT INTO `type` VALUES ('60', '米兔 | 周边', '0', '0,', '0');
INSERT INTO `type` VALUES ('61', '米兔玩偶', '60', '0,60,', '0');
INSERT INTO `type` VALUES ('63', '家庭硬件', '32', '0,32,', '0');
INSERT INTO `type` VALUES ('64', '出行工具', '32', '0,32,', '0');
INSERT INTO `type` VALUES ('65', '线材', '54', '0,54,', '0');
INSERT INTO `type` VALUES ('66', '支架', '54', '0,54,', '0');
INSERT INTO `type` VALUES ('67', '1233', '28', '0,28,', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL,
  `password` char(32) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '良辰', 'd41d8cd98f00b204e9800998ecf8427e', '0', '1505696001');
INSERT INTO `user` VALUES ('2', '雷布斯', 'd41d8cd98f00b204e9800998ecf8427e', '2', '1505462677');
INSERT INTO `user` VALUES ('4', '许薇', 'd41d8cd98f00b204e9800998ecf8427e', '0', '1506052842');
INSERT INTO `user` VALUES ('5', '李四', '81dc9bdb52d04dc20036dbd8313ed055', '1', '1505401569');
INSERT INTO `user` VALUES ('9', '王五', '202cb962ac59075b964b07152d234b70', '0', '1505386018');
INSERT INTO `user` VALUES ('10', '大傻逼', '202cb962ac59075b964b07152d234b70', '2', '1505399777');
INSERT INTO `user` VALUES ('11', '二傻比', 'd9b1d7db4cd6e70935368a1efb10e377', '2', '1505399938');
INSERT INTO `user` VALUES ('12', '1111', 'b59c67bf196a4758191e42f76670ceba', '0', '1505409506');
INSERT INTO `user` VALUES ('13', '121212', 'c20ad4d76fe97759aa27a0c99bff6710', '0', '1505401884');
INSERT INTO `user` VALUES ('15', 'fengke', 'e10adc3949ba59abbe56e057f20f883e', '2', '1505404590');
INSERT INTO `user` VALUES ('16', 'aa', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1505454676');
INSERT INTO `user` VALUES ('17', '李涛', '4124bc0a9335c27f086f24ba207a4912', '0', '1505455222');

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `addname` varchar(18) NOT NULL,
  `phone` char(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `code` char(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_address
-- ----------------------------
INSERT INTO `user_address` VALUES ('1', '1', '冯轲', '18880407560', '犀浦金樽三街', '10000');
INSERT INTO `user_address` VALUES ('2', '17', '冯轲', '18880407560', '犀浦金樽三街', '1000');
INSERT INTO `user_address` VALUES ('3', '18', 'a12', '18880407560', '犀浦金樽三街', '1000');
INSERT INTO `user_address` VALUES ('4', '19', 'a1234', '18880407560', '犀浦金樽三街', '1');
INSERT INTO `user_address` VALUES ('5', '26', 'a222', '18880407560', '犀浦金樽三街', '10000');
INSERT INTO `user_address` VALUES ('6', '27', '11111', '18880407560', '犀浦金樽三街', '1000');
INSERT INTO `user_address` VALUES ('7', '28', '1212', '18880407560', '犀浦金樽三街', '11');

-- ----------------------------
-- Table structure for user_home
-- ----------------------------
DROP TABLE IF EXISTS `user_home`;
CREATE TABLE `user_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL,
  `phone` char(11) DEFAULT NULL,
  `sex` tinyint(3) unsigned NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_home
-- ----------------------------
INSERT INTO `user_home` VALUES ('1', 'fengke', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('10', 'admin', '11111111111', '1', 'e10adc3949ba59abbe56e057f20f883e', '11111@aaa.com', null);
INSERT INTO `user_home` VALUES ('15', 'lingjia', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('16', 'xuwei', '18880407560', '0', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('17', 'fengke111', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('18', 'a123456', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('19', 'a1212', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '125@qq.com', null);
INSERT INTO `user_home` VALUES ('20', 'aqqqqq', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '11111@aaa.com', null);
INSERT INTO `user_home` VALUES ('21', 'aaa1111222', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('22', 'a1222222', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('23', 'a13333', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('24', 'axxx1111', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('25', 'axxx1111222', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('26', 'axxx1111222333', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);
INSERT INTO `user_home` VALUES ('27', 'zz111111111', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '11111@aaa.com', null);
INSERT INTO `user_home` VALUES ('28', 'a4444', '18880407560', '1', 'e10adc3949ba59abbe56e057f20f883e', '549015441@qq.com', null);

-- ----------------------------
-- Table structure for user_u
-- ----------------------------
DROP TABLE IF EXISTS `user_u`;
CREATE TABLE `user_u` (
  `uid` int(11) NOT NULL,
  `name` varchar(18) NOT NULL,
  `age` tinyint(3) unsigned NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL,
  `phone` char(11) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `marry` tinyint(3) unsigned DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_u
-- ----------------------------
INSERT INTO `user_u` VALUES ('0', '1', '30', '0', '18880407560', '549015441@qq.com', null, '1', '0', '30');
INSERT INTO `user_u` VALUES ('1', '今夜良辰', '20', '1', '18880407560', '549015441@qq.com', 'd6a398f3bdda2186539b9f34a1eda24f.jpg', '网上冲浪', '0', '20');
INSERT INTO `user_u` VALUES ('2', '11', '11', '0', '111221', '111', 'a5cec508b536a0e6666d4c3b0b1bc92d.png', '11', '0', '11');
INSERT INTO `user_u` VALUES ('4', '许薇', '20', '0', '18888888888', '8888888@qq.com', null, '唱歌吃饭 睡觉', '0', '兄弟连教育');
INSERT INTO `user_u` VALUES ('9', '张三', '20', '1', '1111', '111', 'a35493171903c0b4df3af59428446308.png', '11', '0', '2333');
INSERT INTO `user_u` VALUES ('10', '张三', '30', '1', '18880407560', '11111@aaa.com', null, '球球', '0', '');
INSERT INTO `user_u` VALUES ('11', '张三', '111', '1', '1212123321', '1212', '434ba145b2d5de3e53879a94051050a6.jpg', '121', '0', '111');
INSERT INTO `user_u` VALUES ('13', '11', '11', '0', '111', '11', '5faf4db54392c35c215aa2446a0b8274.jpg', '11', '1', '11');
