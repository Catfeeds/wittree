/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : wittree

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-12-11 13:42:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wit_address
-- ----------------------------
DROP TABLE IF EXISTS `wit_address`;
CREATE TABLE `wit_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(50) NOT NULL COMMENT '联系人',
  `uid` int(11) NOT NULL COMMENT '用户ID 跟用户表user主键关联',
  `province_name` varchar(50) NOT NULL COMMENT '省',
  `city_name` varchar(50) NOT NULL COMMENT '市',
  `area` varchar(255) NOT NULL COMMENT '区',
  `address` varchar(255) NOT NULL COMMENT '详细地址',
  `phone` char(11) NOT NULL COMMENT '联系电话',
  `doorplate` varchar(50) NOT NULL COMMENT '门牌号',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-否1-默认',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_address
-- ----------------------------
INSERT INTO `wit_address` VALUES ('5', '周周', '4', '', '', '未央区', '雅荷家园', '13521170283', '', '0', '1544068291', '1544068291');
INSERT INTO `wit_address` VALUES ('3', '周红伟', '4', '', '', '未央区', '雅荷家园', '18339306470', '', '0', '1544067712', '1544067712');
INSERT INTO `wit_address` VALUES ('6', '周洲', '4', '', '', '未央区', '雅荷家园', '13521170283', '', '1', '1544068775', '1544068775');
INSERT INTO `wit_address` VALUES ('7', '亚洲', '4', '', '', '雅虎家园', '莲湖无', '18339306470', '', '0', '1544068335', '1544068335');

-- ----------------------------
-- Table structure for wit_articles
-- ----------------------------
DROP TABLE IF EXISTS `wit_articles`;
CREATE TABLE `wit_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(155) NOT NULL COMMENT '文章标题',
  `description` varchar(255) NOT NULL COMMENT '文章描述',
  `keywords` varchar(155) NOT NULL COMMENT '文章关键字',
  `thumbnail` varchar(255) NOT NULL COMMENT '文章缩略图',
  `content` text NOT NULL COMMENT '文章内容',
  `add_time` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_articles
-- ----------------------------
INSERT INTO `wit_articles` VALUES ('2', '文章标题', '文章描述', '关键字1,关键字2,关键字3', '/upload/20170916/1e915c70dbb9d3e8a07bede7b64e4cff.png', '<p><img src=\"/upload/image/20170916/1505555254.png\" title=\"1505555254.png\" alt=\"QQ截图20170916174651.png\"/></p><p>测试文章内容</p><p>测试内容</p>', '2017-09-16 17:47:44');

-- ----------------------------
-- Table structure for wit_award
-- ----------------------------
DROP TABLE IF EXISTS `wit_award`;
CREATE TABLE `wit_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '礼物标题',
  `integral` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_award
-- ----------------------------
INSERT INTO `wit_award` VALUES ('2', '精致礼物', '10', '/upload/Award/20181121/9ff0bd14dfdc727c33f16e92e3f57520.png', '1544423124', '1544423124');

-- ----------------------------
-- Table structure for wit_category
-- ----------------------------
DROP TABLE IF EXISTS `wit_category`;
CREATE TABLE `wit_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(120) NOT NULL COMMENT '课程分类名',
  `fid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `url` varchar(255) NOT NULL,
  `division_id` int(11) NOT NULL COMMENT '专区',
  `sort` mediumint(8) NOT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_category
-- ----------------------------
INSERT INTO `wit_category` VALUES ('2', '学霸右脑', '0', '/upload/category/20181130/47bfbd3d22b011294ae9a52457fbdd29.png', '0', '11', '1544263536', '1544263536');
INSERT INTO `wit_category` VALUES ('4', '英语', '0', '/upload/category/20181130/ccfc5d8f9844f07c887033ca75e5a660.png', '0', '343', '1543545656', '1543545656');
INSERT INTO `wit_category` VALUES ('5', '语文字词', '0', '/upload/category/20181130/1103ccde0134e10b4eb24f3d952aaf11.png', '0', '13', '1544169132', '1544169132');
INSERT INTO `wit_category` VALUES ('7', '滥竽充数', '0', '', '0', '4', '1544271016', '1544271016');

-- ----------------------------
-- Table structure for wit_chapter
-- ----------------------------
DROP TABLE IF EXISTS `wit_chapter`;
CREATE TABLE `wit_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '章节',
  `course_id` int(11) NOT NULL COMMENT '课程id（表course_id）',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='章节表';

-- ----------------------------
-- Records of wit_chapter
-- ----------------------------
INSERT INTO `wit_chapter` VALUES ('2', '第一章', '1', '1542350624', '1542350624');
INSERT INTO `wit_chapter` VALUES ('3', '第一章', '1', '1542356139', '1542788900');
INSERT INTO `wit_chapter` VALUES ('4', '第二章', '3', '1542357048', '1542357057');

-- ----------------------------
-- Table structure for wit_compound
-- ----------------------------
DROP TABLE IF EXISTS `wit_compound`;
CREATE TABLE `wit_compound` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '起始金额',
  `end_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最高金额',
  `rate` float(10,2) NOT NULL COMMENT '利率',
  `year` varchar(10) NOT NULL COMMENT '年数',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='复利设置表';

-- ----------------------------
-- Records of wit_compound
-- ----------------------------
INSERT INTO `wit_compound` VALUES ('1', '200.00', '1000.00', '12.00', '', '1544256658', '1544256658');

-- ----------------------------
-- Table structure for wit_course
-- ----------------------------
DROP TABLE IF EXISTS `wit_course`;
CREATE TABLE `wit_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `cat_id` int(11) NOT NULL COMMENT '教程类别',
  `price` varchar(20) NOT NULL COMMENT '课程消耗积分',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `url` varchar(255) NOT NULL COMMENT '视频链接',
  `keywords` varchar(120) NOT NULL COMMENT '关键词',
  `desc` varchar(120) NOT NULL COMMENT '描述',
  `content` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-已上线1-未上线',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of wit_course
-- ----------------------------
INSERT INTO `wit_course` VALUES ('19', '跟着老外学口语10', '4', '300', '/upload/Course/20181208/1b3f1c054d8947b0883156d47840f3d0.png', '', '', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267688', '1544267688');
INSERT INTO `wit_course` VALUES ('20', '跟着老外学口语9', '4', '100', '/upload/Course/20181208/fc9851dd90bef0fb2078edba91080ae6.png', '', '', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267669', '1544267669');
INSERT INTO `wit_course` VALUES ('21', '跟着老外学口语8', '4', '1000', '/upload/Course/20181208/4eef5d7ff1693e70ec443d192136f09e.png', '', '', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267639', '1544267639');
INSERT INTO `wit_course` VALUES ('29', '跟着老外学口语7', '4', '300', '/upload/Course/20181208/82c8a08d49929c62bd8a63e75d6df3db.png', '', '', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267618', '1544267618');
INSERT INTO `wit_course` VALUES ('30', '跟着老外学口语6', '4', '100', '/upload/Course/20181208/63bdd2f6fe9eb5ec86b73114bce57eac.png', '', '', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267205', '1544267205');
INSERT INTO `wit_course` VALUES ('31', '跟着老外学口语5', '4', '1000', '/upload/Course/20181208/d40a6113fb9e54cab0d802e2eb484818.png', '', '', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267182', '1544267182');
INSERT INTO `wit_course` VALUES ('33', '跟着老外学口语4', '4', '100.00', '/upload/Course/20181208/a5e1c722ac504b39b0dfbafc330bd082.png', '', 'lesson,math ', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '<p>English</p>', '1', '0', '1544267164', '1544267164');
INSERT INTO `wit_course` VALUES ('35', '最强大脑班(7-12岁)', '2', '300', '/upload/Course/20181208/48972ff18c262b7f95fc12ab506a7f99.png', '', '', '《超级专注力该机阶段课程》10-50倍提升专注力，做45分钟内聚精会神的优秀学生。\n   《超级记忆力》10-50倍提升记忆力，所有课本知识点统统拿下。\n   《思维导图》国际最科学的学习工具，大幅度提升分析思维、归纳思维、总结思维。\n  ', '', '1', '0', '1544265975', '1544265975');
INSERT INTO `wit_course` VALUES ('36', '走向学霸班(6-7岁)', '2', '300', '/upload/Course/20181208/00fa5347a4803ab635795c73cf6d0175.png', '', '', '通过八大智能高级课程的训练，孩子的各项能力得到了很大的提升，重点培养拼音、识字、古诗、文章、算术等基础知识和《超级专注力》第二阶段，真正做到身体坐得住，眼睛认真看、耳朵仔细听、大脑跟着转、双手动起来，五位合一达到专注效果，在课堂45分钟时间', '', '1', '0', '1544265966', '1544265966');
INSERT INTO `wit_course` VALUES ('37', '学能提升班(3-6岁)', '2', '100', '/upload/Course/20181208/3cf93f1ed08053d123b8b2ce7145d29e.png', '', '', '宝宝独立的学习、能力锻炼的开始，3岁儿童的大脑重景接近成年人的90%，此阶段是宝宝人生的“黄金阶段”，通过幼儿部八大智能中级课程训练，在孩子正常观察能力的基础上，10-50倍提升宝宝的想象力、记忆力、观察力、空间感知、数学思维、逻辑推理、抗', '', '1', '0', '1544266542', '1544266542');
INSERT INTO `wit_course` VALUES ('38', '幼儿初级潜能班(12-36个月)', '2', '100', '/upload/Course/20181208/4164cf823f6ffb16cd1566131667ed04.png', '', '', '根据婴幼儿大脑生长规律、身体发育的特点，以及宝宝1-3岁阶段的各个敏感期，通过八大智能初级教材、益智玩具、结合蒙特梭利的专业理念及教具，通过五感的刺激而促进宝宝的大脑发育以及行为习惯的养成。', '', '1', '0', '1544266535', '1544266535');
INSERT INTO `wit_course` VALUES ('39', '跟着老外学口语3', '4', '300', '/upload/Course/20181208/65e2f087d89eb3d1e7580257929a01ce.png', '', '', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267150', '1544267150');
INSERT INTO `wit_course` VALUES ('40', '跟着老外学口语2', '4', '100', '/upload/Course/20181208/cb709f0d664a2f1cf8be969748a7edca.png', '', '英语', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267141', '1544267141');
INSERT INTO `wit_course` VALUES ('41', '跟着老外学口语1', '4', '1000', '/upload/Course/20181208/6f607a7d033cdc27634c30d0adca0607.png', '', '英语', '纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。纯正地道的老外，教你说一口纯正地道的英语。学外语就是现在，就选我们“智慧树”。', '', '1', '0', '1544267034', '1544267034');

-- ----------------------------
-- Table structure for wit_customer
-- ----------------------------
DROP TABLE IF EXISTS `wit_customer`;
CREATE TABLE `wit_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `real_name` varchar(50) NOT NULL DEFAULT '',
  `sex` char(2) NOT NULL DEFAULT '2' COMMENT '性别0-男1-女2-未知',
  `face` varchar(255) NOT NULL COMMENT '用户头像',
  `integral` varchar(20) NOT NULL COMMENT '积分',
  `id_number` varchar(50) NOT NULL COMMENT '身份证号',
  `phone` varchar(50) NOT NULL COMMENT '联系电话',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `bank_number` varchar(50) NOT NULL COMMENT '银行卡号',
  `fid` int(11) NOT NULL DEFAULT '0' COMMENT '父编号（wit_customer.ID）推荐人id',
  `money` decimal(10,2) NOT NULL COMMENT '余额',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `openid` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-正常2-禁用',
  `code` varchar(10) NOT NULL COMMENT '用户推广码',
  `last_code` varchar(10) NOT NULL COMMENT '推荐人码',
  `id_url` varchar(255) NOT NULL COMMENT '身份证件照',
  `code_url` varchar(255) NOT NULL COMMENT '二维码链接',
  `is_auth` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否实名认证0-未认证1-已认证2-提交申请',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '绑定角色id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_customer
-- ----------------------------
INSERT INTO `wit_customer` VALUES ('4', 'walt', '周红伟', '1', '/upload/face/20181114/bae6d8343b7fb3972e4853254a48f22c.png', '337740', '410928199511064210', '13521170283', '雅荷家园', '654613213132', '9', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', 'ffuEa', '/upload/checkid/20181210/9ec728b8cca8d59eef048ead26822276.png', '', '2', '1', '1544173385', '1544409214');
INSERT INTO `wit_customer` VALUES ('19', 'wittree_17629005156', '', '2', '', '99870', '', '17629005156', '', '', '0', '0.00', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '', '', '', '', '0', '0', '1544254409', '0');
INSERT INTO `wit_customer` VALUES ('20', 'wittree_18339306478', '', '2', '', '', '', '18339306478', '', '', '0', '0.00', '25d55ad283aa400af464c76d713c07ad', '', '1', '', '', '', '', '0', '0', '1544264906', '0');
INSERT INTO `wit_customer` VALUES ('8', 'walt-zhou-wei', '', '0', '/upload/face/20181123/48e5a39784ac1dd68e50bec6924a7912.png', '', '', '18339306475', '雅荷家园', '654613213132', '0', '0.00', 'fc494bd92b4f0f7bffbf5eab7385ad58', '', '1', '', '', '', '', '0', '0', '1542940164', '1542940164');
INSERT INTO `wit_customer` VALUES ('9', 'zhouhouzhou1111', '', '0', '/upload/face/20181123/01850f8d2b8ef33d6e9020325213053c.png', '', '', '13521170287', '雅荷家园', '654613213132', '0', '0.00', 'fc494bd92b4f0f7bffbf5eab7385ad58', '', '1', 'ffuEa', '', '', '', '0', '0', '1542940689', '1542940689');
INSERT INTO `wit_customer` VALUES ('11', 'wittree_18339306470', '周红伟', '0', '/upload/checkid/20181204/c858bc677668770d68b2c2e9f0523f6e.png', '790', '410928199511064210', '18339306470', '', '', '0', '0.00', '25d55ad283aa400af464c76d713c07ad', '', '1', '', '', '/upload/checkid/20181204/c858bc677668770d68b2c2e9f0523f6e.png', '', '1', '0', '1543907316', '1543907316');
INSERT INTO `wit_customer` VALUES ('13', 'wittree_15398007612', '', '2', '', '60', '', '15398007612', '', '', '0', '0.00', '1bbd886460827015e5d605ed44252251', '', '1', '', '', '', '', '0', '0', '1544079476', '0');
INSERT INTO `wit_customer` VALUES ('14', '周小伟', '', '0', '', '', '410928199511064210', '13521170281', '雅荷家园', '', '0', '0.00', 'fc494bd92b4f0f7bffbf5eab7385ad58', '', '1', 'vnJj1', '', '', '', '0', '0', '1544080351', '1544080351');
INSERT INTO `wit_customer` VALUES ('17', 'wittree_17782630535', '', '2', '', '190', '', '17782630535', '', '', '0', '0.00', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '', '', '', '', '0', '0', '1544081414', '0');
INSERT INTO `wit_customer` VALUES ('18', '大唐', '', '2', '', '90', '610321199303260655', '12345678998', '西安市雁塔区', '', '0', '0.00', 'fc494bd92b4f0f7bffbf5eab7385ad58', '', '1', '8XZLh', '', '', '', '0', '0', '1544167253', '1544167253');
INSERT INTO `wit_customer` VALUES ('16', '僵da鱼', '', '1', '', '', '6103211995060650532', '15563563368', '陕西省西安市未央区凤城一路', '', '0', '0.00', 'fc494bd92b4f0f7bffbf5eab7385ad58', '', '1', 'fxxTH', '', '', '', '0', '0', '1544080908', '1544080908');
INSERT INTO `wit_customer` VALUES ('21', 'wittree_18339306476', '', '2', '', '', '', '18339306476', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544408124', '0');
INSERT INTO `wit_customer` VALUES ('22', 'wittree_13521170284', '', '2', '', '', '', '13521170284', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544408379', '0');
INSERT INTO `wit_customer` VALUES ('23', 'wittree_13521170285', '', '2', '', '', '', '13521170285', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544408413', '0');
INSERT INTO `wit_customer` VALUES ('24', 'wittree_13521170286', '', '2', '', '', '', '13521170286', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544408577', '0');
INSERT INTO `wit_customer` VALUES ('25', 'wittree_13521170288', '', '2', '', '', '', '13521170288', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544408694', '0');
INSERT INTO `wit_customer` VALUES ('26', 'wittree_13521170289', '', '2', '', '', '', '13521170289', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544408802', '0');
INSERT INTO `wit_customer` VALUES ('27', 'wittree_18339306575', '', '2', '', '', '', '18339306575', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544408926', '0');
INSERT INTO `wit_customer` VALUES ('28', 'wittree_18810951135', '', '2', '', '', '', '18810951135', '', '', '0', '0.00', '25d55ad283aa400af464c76d713c07ad', '', '1', '', '', '', '', '0', '0', '1544409506', '0');
INSERT INTO `wit_customer` VALUES ('29', 'wittree_13521170280', '', '2', '', '', '', '13521170280', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544422715', '0');
INSERT INTO `wit_customer` VALUES ('30', 'wittree_13521170270', '', '2', '', '', '', '13521170270', '', '', '4', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544422996', '0');
INSERT INTO `wit_customer` VALUES ('31', 'wittree_13521170294', '', '2', '', '', '', '13521170294', '', '', '4', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544425656', '0');
INSERT INTO `wit_customer` VALUES ('32', 'wittree_13521170263', '', '2', '', '', '', '13521170263', '', '', '0', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544425680', '0');
INSERT INTO `wit_customer` VALUES ('33', 'wittree_13521170223', '', '2', '', '', '', '13521170223', '', '', '4', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544425772', '0');
INSERT INTO `wit_customer` VALUES ('34', 'wittree_13521170324', '', '2', '', '', '', '13521170324', '', '', '4', '0.00', '25f9e794323b453885f5181f1b624d0b', '', '1', '', '', '', '', '0', '0', '1544425851', '0');

-- ----------------------------
-- Table structure for wit_customer_draw
-- ----------------------------
DROP TABLE IF EXISTS `wit_customer_draw`;
CREATE TABLE `wit_customer_draw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `draw_num` int(11) NOT NULL COMMENT '抽奖次数',
  `uid` int(11) NOT NULL COMMENT '用户id(customer表主键id)',
  `draw_time` varchar(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_customer_draw
-- ----------------------------
INSERT INTO `wit_customer_draw` VALUES ('8', '2', '4', '2018-12-08 ', '0');
INSERT INTO `wit_customer_draw` VALUES ('7', '2', '11', '2018-12-08 ', '0');
INSERT INTO `wit_customer_draw` VALUES ('9', '2', '17', '2018-12-08 ', '0');
INSERT INTO `wit_customer_draw` VALUES ('10', '2', '19', '2018-12-08 ', '0');

-- ----------------------------
-- Table structure for wit_customer_log
-- ----------------------------
DROP TABLE IF EXISTS `wit_customer_log`;
CREATE TABLE `wit_customer_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `integral` int(20) NOT NULL DEFAULT '0' COMMENT '积分',
  `from_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0-签到积分1-购买消耗积分2-复利3-抽奖4-后台上分5-后台下分6.注册7.推荐积分',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `operator_id` int(11) NOT NULL COMMENT '操作人id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=288 DEFAULT CHARSET=utf8 COMMENT='用户积分记录表';

-- ----------------------------
-- Records of wit_customer_log
-- ----------------------------
INSERT INTO `wit_customer_log` VALUES ('1', '4', '300', '0', '0', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('2', '4', '500', '0', '0', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('3', '4', '600', '0', '0', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('4', '4', '700', '0', '0', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('5', '4', '800', '0', '0', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('6', '4', '900', '0', '0', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('7', '4', '400', '0', '0', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('8', '4', '400', '0', '0', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('9', '4', '500', '0', '0', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('10', '4', '600', '0', '0', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('11', '4', '700', '0', '0', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('12', '4', '800', '0', '0', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('13', '4', '900', '0', '0', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('14', '4', '400', '0', '0', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('15', '4', '400', '0', '0', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('16', '4', '1500', '0', '0', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('17', '4', '600', '0', '0', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('18', '4', '700', '0', '0', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('19', '4', '2800', '0', '0', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('20', '4', '900', '0', '0', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('21', '4', '400', '0', '0', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('22', '4', '400', '0', '0', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('23', '4', '1500', '0', '0', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('24', '4', '2600', '0', '0', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('25', '4', '3700', '0', '0', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('26', '4', '2800', '0', '0', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('27', '4', '900', '0', '0', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('28', '4', '400', '0', '0', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('29', '4', '400', '0', '0', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('30', '4', '1500', '0', '0', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('31', '4', '2600', '0', '0', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('32', '4', '3700', '0', '0', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('33', '4', '2800', '0', '0', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('34', '4', '2900', '0', '0', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('35', '4', '2400', '0', '0', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('36', '4', '400', '0', '0', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('37', '4', '1500', '0', '0', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('38', '4', '22600', '0', '0', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('39', '4', '32700', '0', '0', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('40', '4', '2800', '0', '0', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('41', '4', '2900', '0', '0', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('42', '4', '2400', '0', '0', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('43', '4', '400', '0', '0', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('44', '4', '1500', '0', '0', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('45', '4', '22600', '0', '0', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('46', '4', '32700', '0', '0', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('47', '4', '2800', '0', '0', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('48', '4', '22900', '0', '0', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('49', '4', '22400', '0', '0', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('50', '4', '400', '0', '2', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('51', '4', '500', '0', '2', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('52', '4', '600', '0', '2', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('53', '4', '700', '0', '2', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('54', '4', '900', '0', '2', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('55', '4', '1000', '0', '2', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('56', '4', '2000', '0', '2', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('57', '4', '500', '0', '2', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('58', '4', '600', '0', '2', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('59', '4', '700', '0', '2', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('60', '4', '900', '0', '2', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('61', '4', '1000', '0', '2', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('62', '4', '2000', '0', '2', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('63', '4', '3000', '0', '2', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('64', '4', '600', '0', '2', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('65', '4', '700', '0', '2', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('66', '4', '800', '0', '2', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('67', '4', '1000', '0', '2', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('68', '4', '2000', '0', '2', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('69', '4', '3000', '0', '2', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('70', '4', '4000', '0', '2', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('71', '4', '700', '0', '2', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('72', '4', '800', '0', '2', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('73', '4', '900', '0', '2', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('74', '4', '2000', '0', '2', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('75', '4', '3000', '0', '2', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('76', '4', '4000', '0', '2', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('77', '4', '5000', '0', '2', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('78', '4', '800', '0', '2', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('79', '4', '900', '0', '2', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('80', '4', '1000', '0', '2', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('81', '4', '3000', '0', '2', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('82', '4', '4000', '0', '2', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('83', '4', '5000', '0', '2', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('84', '4', '6000', '0', '2', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('85', '4', '900', '0', '2', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('86', '4', '1000', '0', '2', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('87', '4', '2000', '0', '2', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('88', '4', '4000', '0', '2', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('89', '4', '5000', '0', '2', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('90', '4', '6000', '0', '2', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('91', '4', '7000', '0', '2', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('92', '4', '1000', '0', '2', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('93', '4', '2000', '0', '2', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('94', '4', '3000', '0', '2', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('95', '4', '4000', '0', '2', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('96', '4', '6000', '0', '2', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('97', '4', '7000', '0', '2', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('98', '4', '8000', '0', '2', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('99', '4', '10', '0', '4', '', '1', '1542780254', '1542780254');
INSERT INTO `wit_customer_log` VALUES ('100', '5', '30', '0', '5', '', '1', '1542780367', '1542780367');
INSERT INTO `wit_customer_log` VALUES ('101', '1', '0', '0', '6', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('102', '2', '0', '0', '6', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('103', '3', '0', '0', '6', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('104', '4', '0', '0', '6', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('105', '5', '0', '0', '6', '', '0', '1542611387', '0');
INSERT INTO `wit_customer_log` VALUES ('106', '6', '0', '0', '6', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('107', '7', '0', '0', '6', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('108', '8', '0', '0', '6', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('109', '9', '0', '0', '6', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('110', '10', '0', '0', '6', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('111', '11', '0', '0', '6', '', '0', '1542697787', '0');
INSERT INTO `wit_customer_log` VALUES ('112', '11', '0', '0', '6', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('113', '12', '0', '0', '6', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('114', '13', '0', '0', '6', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('115', '14', '0', '0', '6', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('116', '15', '0', '0', '6', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('117', '16', '0', '0', '6', '', '0', '1542784187', '0');
INSERT INTO `wit_customer_log` VALUES ('118', '17', '0', '0', '6', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('119', '18', '0', '0', '6', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('120', '19', '0', '0', '6', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('121', '20', '0', '0', '6', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('122', '21', '0', '0', '6', '', '0', '1542870587', '0');
INSERT INTO `wit_customer_log` VALUES ('123', '21', '0', '0', '6', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('124', '22', '0', '0', '6', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('125', '23', '0', '0', '6', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('126', '24', '0', '0', '6', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('127', '25', '0', '0', '6', '', '0', '1542956987', '0');
INSERT INTO `wit_customer_log` VALUES ('128', '26', '0', '0', '6', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('129', '27', '0', '0', '6', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('130', '28', '0', '0', '6', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('131', '29', '0', '0', '6', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('132', '30', '0', '0', '6', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('133', '31', '0', '0', '6', '', '0', '1543043387', '0');
INSERT INTO `wit_customer_log` VALUES ('134', '31', '0', '0', '6', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('135', '32', '0', '0', '6', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('136', '33', '0', '0', '6', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('137', '34', '0', '0', '6', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('138', '35', '0', '0', '6', '', '0', '1543129787', '0');
INSERT INTO `wit_customer_log` VALUES ('139', '5', '99', '0', '2', '', '0', '1543485039', '1543485039');
INSERT INTO `wit_customer_log` VALUES ('140', '5', '99', '0', '2', '', '0', '1543485916', '1543485916');
INSERT INTO `wit_customer_log` VALUES ('141', '5', '99', '0', '2', '', '0', '1543485917', '1543485917');
INSERT INTO `wit_customer_log` VALUES ('142', '5', '99', '0', '2', '', '0', '1543485918', '1543485918');
INSERT INTO `wit_customer_log` VALUES ('143', '5', '99', '0', '2', '', '0', '1543485919', '1543485919');
INSERT INTO `wit_customer_log` VALUES ('144', '5', '99', '0', '2', '', '0', '1543485920', '1543485920');
INSERT INTO `wit_customer_log` VALUES ('145', '5', '99', '0', '2', '', '0', '1543485921', '1543485921');
INSERT INTO `wit_customer_log` VALUES ('146', '5', '99', '0', '2', '', '0', '1543485922', '1543485922');
INSERT INTO `wit_customer_log` VALUES ('147', '5', '99', '0', '2', '', '0', '1543485923', '1543485923');
INSERT INTO `wit_customer_log` VALUES ('148', '5', '99', '0', '2', '', '0', '1543485924', '1543485924');
INSERT INTO `wit_customer_log` VALUES ('149', '5', '99', '0', '2', '', '0', '1543485925', '1543485925');
INSERT INTO `wit_customer_log` VALUES ('150', '5', '99', '0', '2', '', '0', '1543485926', '1543485926');
INSERT INTO `wit_customer_log` VALUES ('151', '5', '99', '0', '2', '', '0', '1543485927', '1543485927');
INSERT INTO `wit_customer_log` VALUES ('152', '5', '99', '0', '2', '', '0', '1543485928', '1543485928');
INSERT INTO `wit_customer_log` VALUES ('153', '5', '99', '0', '2', '', '0', '1543485929', '1543485929');
INSERT INTO `wit_customer_log` VALUES ('154', '5', '99', '0', '2', '', '0', '1543485930', '1543485930');
INSERT INTO `wit_customer_log` VALUES ('155', '5', '8', '0', '0', '签到+8', '0', '0', '0');
INSERT INTO `wit_customer_log` VALUES ('156', '5', '8', '0', '0', '签到+8', '0', '0', '0');
INSERT INTO `wit_customer_log` VALUES ('157', '5', '8', '0', '0', '签到+8', '0', '1543572539', '0');
INSERT INTO `wit_customer_log` VALUES ('158', '5', '8', '0', '0', '签到+8', '0', '1543572605', '0');
INSERT INTO `wit_customer_log` VALUES ('159', '5', '8', '0', '0', '签到+8', '0', '1543572634', '0');
INSERT INTO `wit_customer_log` VALUES ('160', '5', '8', '0', '0', '签到+8', '0', '1543572677', '0');
INSERT INTO `wit_customer_log` VALUES ('161', '5', '8', '0', '0', '签到+8', '0', '1543572736', '0');
INSERT INTO `wit_customer_log` VALUES ('162', '5', '8', '0', '0', '签到+8', '0', '1543572799', '0');
INSERT INTO `wit_customer_log` VALUES ('163', '5', '8', '0', '0', '签到+8', '0', '1543644297', '0');
INSERT INTO `wit_customer_log` VALUES ('164', '0', '8', '0', '0', '签到+8', '0', '1543644878', '0');
INSERT INTO `wit_customer_log` VALUES ('165', '11', '10', '0', '0', '签到+10', '0', '1543649781', '0');
INSERT INTO `wit_customer_log` VALUES ('166', '11', '10', '0', '0', '签到+10', '0', '1543649832', '0');
INSERT INTO `wit_customer_log` VALUES ('167', '11', '10', '0', '0', '签到+10', '0', '1543650123', '0');
INSERT INTO `wit_customer_log` VALUES ('168', '11', '10', '0', '0', '签到+10', '0', '1543651496', '0');
INSERT INTO `wit_customer_log` VALUES ('169', '11', '10', '0', '0', '签到+10', '0', '1543651641', '0');
INSERT INTO `wit_customer_log` VALUES ('170', '11', '10', '0', '0', '签到+10', '0', '1543651705', '0');
INSERT INTO `wit_customer_log` VALUES ('171', '11', '10', '0', '0', '签到+10', '0', '1543651757', '0');
INSERT INTO `wit_customer_log` VALUES ('172', '11', '10', '0', '0', '签到+10', '0', '1543651785', '0');
INSERT INTO `wit_customer_log` VALUES ('173', '11', '10', '0', '0', '签到+10', '0', '1543651812', '0');
INSERT INTO `wit_customer_log` VALUES ('174', '11', '10', '0', '0', '签到+10', '0', '1543652094', '0');
INSERT INTO `wit_customer_log` VALUES ('175', '11', '10', '0', '0', '签到+10', '0', '1543655273', '0');
INSERT INTO `wit_customer_log` VALUES ('176', '11', '10', '0', '0', '签到+10', '0', '1543655876', '0');
INSERT INTO `wit_customer_log` VALUES ('177', '11', '10', '0', '0', '签到+10', '0', '1543657370', '0');
INSERT INTO `wit_customer_log` VALUES ('178', '11', '10', '0', '0', '签到+10', '0', '1543657931', '0');
INSERT INTO `wit_customer_log` VALUES ('179', '11', '10', '0', '0', '签到+10', '0', '1543799865', '0');
INSERT INTO `wit_customer_log` VALUES ('180', '0', '10', '0', '0', '签到+10', '0', '1543800477', '0');
INSERT INTO `wit_customer_log` VALUES ('181', '11', '100', '0', '1', '', '0', '0', '0');
INSERT INTO `wit_customer_log` VALUES ('182', '11', '100', '0', '1', '', '0', '1543801310', '0');
INSERT INTO `wit_customer_log` VALUES ('183', '4', '10', '0', '0', '签到+10', '0', '1543828722', '0');
INSERT INTO `wit_customer_log` VALUES ('184', '11', '20', '0', '0', '签到+20', '0', '1543886834', '0');
INSERT INTO `wit_customer_log` VALUES ('185', '11', '300', '0', '1', '', '0', '1543894597', '0');
INSERT INTO `wit_customer_log` VALUES ('186', '11', '10', '0', '0', '签到+10', '0', '1544058394', '0');
INSERT INTO `wit_customer_log` VALUES ('187', '4', '10', '0', '0', '签到+10', '0', '1544058474', '0');
INSERT INTO `wit_customer_log` VALUES ('188', '4', '40', '0', '3', '', '0', '1544063275', '1544063275');
INSERT INTO `wit_customer_log` VALUES ('189', '4', '50', '0', '3', '', '0', '1544063288', '1544063288');
INSERT INTO `wit_customer_log` VALUES ('190', '4', '40', '0', '3', '', '0', '1544063306', '1544063306');
INSERT INTO `wit_customer_log` VALUES ('191', '4', '40', '0', '3', '', '0', '1544063308', '1544063308');
INSERT INTO `wit_customer_log` VALUES ('192', '4', '30', '0', '3', '', '0', '1544063544', '1544063544');
INSERT INTO `wit_customer_log` VALUES ('193', '4', '30', '0', '3', '', '0', '1544063547', '1544063547');
INSERT INTO `wit_customer_log` VALUES ('194', '4', '30', '0', '3', '', '0', '1544063555', '1544063555');
INSERT INTO `wit_customer_log` VALUES ('195', '4', '50', '0', '3', '', '0', '1544063558', '1544063558');
INSERT INTO `wit_customer_log` VALUES ('196', '4', '50', '0', '3', '', '0', '1544063638', '1544063638');
INSERT INTO `wit_customer_log` VALUES ('197', '4', '20', '0', '3', '', '0', '1544063648', '1544063648');
INSERT INTO `wit_customer_log` VALUES ('198', '4', '40', '0', '3', '', '0', '1544063658', '1544063658');
INSERT INTO `wit_customer_log` VALUES ('199', '4', '20', '0', '3', '', '0', '1544065018', '1544065018');
INSERT INTO `wit_customer_log` VALUES ('200', '4', '50', '0', '3', '', '0', '1544066128', '1544066128');
INSERT INTO `wit_customer_log` VALUES ('201', '4', '20', '0', '3', '', '0', '1544066266', '1544066266');
INSERT INTO `wit_customer_log` VALUES ('202', '4', '40', '0', '3', '', '0', '1544066742', '1544066742');
INSERT INTO `wit_customer_log` VALUES ('203', '4', '50', '0', '3', '', '0', '1544066857', '1544066857');
INSERT INTO `wit_customer_log` VALUES ('204', '4', '30', '0', '3', '', '0', '1544066928', '1544066928');
INSERT INTO `wit_customer_log` VALUES ('205', '4', '20', '0', '3', '', '0', '1544066939', '1544066939');
INSERT INTO `wit_customer_log` VALUES ('206', '4', '50', '0', '3', '', '0', '1544075046', '1544075046');
INSERT INTO `wit_customer_log` VALUES ('207', '4', '20', '0', '3', '', '0', '1544075057', '1544075058');
INSERT INTO `wit_customer_log` VALUES ('208', '4', '40', '0', '3', '', '0', '1544075072', '1544075072');
INSERT INTO `wit_customer_log` VALUES ('209', '4', '50', '0', '3', '', '0', '1544075086', '1544075086');
INSERT INTO `wit_customer_log` VALUES ('210', '4', '20', '0', '3', '', '0', '1544079070', '1544079070');
INSERT INTO `wit_customer_log` VALUES ('211', '4', '30', '0', '3', '', '0', '1544079314', '1544079314');
INSERT INTO `wit_customer_log` VALUES ('212', '4', '40', '0', '3', '', '0', '1544079393', '1544079393');
INSERT INTO `wit_customer_log` VALUES ('213', '4', '40', '0', '3', '', '0', '1544079407', '1544079407');
INSERT INTO `wit_customer_log` VALUES ('214', '4', '50', '0', '3', '', '0', '1544079486', '1544079486');
INSERT INTO `wit_customer_log` VALUES ('215', '13', '10', '0', '0', '签到+10', '0', '1544079534', '0');
INSERT INTO `wit_customer_log` VALUES ('216', '13', '50', '0', '3', '', '0', '1544079576', '1544079576');
INSERT INTO `wit_customer_log` VALUES ('217', '4', '40', '0', '3', '', '0', '1544079711', '1544079711');
INSERT INTO `wit_customer_log` VALUES ('218', '4', '50', '0', '3', '', '0', '1544081382', '1544081382');
INSERT INTO `wit_customer_log` VALUES ('219', '17', '10', '0', '0', '签到+10', '0', '1544081479', '0');
INSERT INTO `wit_customer_log` VALUES ('220', '17', '30', '0', '3', '', '0', '1544081514', '1544081514');
INSERT INTO `wit_customer_log` VALUES ('221', '17', '40', '0', '3', '', '0', '1544081525', '1544081525');
INSERT INTO `wit_customer_log` VALUES ('222', '4', '100', '0', '1', '购买函数方程式课程', '0', '1544081758', '0');
INSERT INTO `wit_customer_log` VALUES ('223', '4', '20', '0', '0', '签到+20', '0', '1544145066', '0');
INSERT INTO `wit_customer_log` VALUES ('224', '11', '20', '0', '0', '签到+20', '0', '1544166442', '0');
INSERT INTO `wit_customer_log` VALUES ('225', '18', '90', '0', '4', '', '1', '1544168915', '1544168915');
INSERT INTO `wit_customer_log` VALUES ('226', '17', '20', '0', '0', '签到+20', '0', '1544170838', '0');
INSERT INTO `wit_customer_log` VALUES ('227', '4', '50', '0', '3', '', '0', '1544175460', '1544175460');
INSERT INTO `wit_customer_log` VALUES ('228', '4', '30', '0', '3', '', '0', '1544175474', '1544175474');
INSERT INTO `wit_customer_log` VALUES ('229', '4', '30', '0', '3', '', '0', '1544175621', '1544175621');
INSERT INTO `wit_customer_log` VALUES ('230', '4', '20', '0', '3', '', '0', '1544175631', '1544175631');
INSERT INTO `wit_customer_log` VALUES ('231', '4', '30', '0', '3', '', '0', '1544175640', '1544175640');
INSERT INTO `wit_customer_log` VALUES ('232', '4', '50', '0', '3', '', '0', '1544175649', '1544175649');
INSERT INTO `wit_customer_log` VALUES ('233', '4', '30', '0', '3', '', '0', '1544175756', '1544175756');
INSERT INTO `wit_customer_log` VALUES ('234', '4', '50', '0', '3', '', '0', '1544175790', '1544175790');
INSERT INTO `wit_customer_log` VALUES ('235', '4', '30', '0', '0', '签到+30', '0', '1544231611', '0');
INSERT INTO `wit_customer_log` VALUES ('236', '17', '30', '0', '0', '签到+30', '0', '1544236300', '0');
INSERT INTO `wit_customer_log` VALUES ('237', '11', '30', '0', '3', '', '0', '1544236891', '1544236891');
INSERT INTO `wit_customer_log` VALUES ('238', '11', '50', '0', '3', '', '0', '1544236901', '1544236901');
INSERT INTO `wit_customer_log` VALUES ('239', '4', '40', '0', '3', '', '0', '1544237111', '1544237111');
INSERT INTO `wit_customer_log` VALUES ('240', '4', '40', '0', '3', '', '0', '1544237121', '1544237121');
INSERT INTO `wit_customer_log` VALUES ('241', '17', '100', '0', '1', '购买函数方程式课程', '0', '1544237425', '0');
INSERT INTO `wit_customer_log` VALUES ('242', '4', '20', '0', '3', '', '0', '1544237666', '1544237666');
INSERT INTO `wit_customer_log` VALUES ('243', '4', '50', '0', '3', '', '0', '1544237675', '1544237675');
INSERT INTO `wit_customer_log` VALUES ('244', '4', '30', '0', '3', '', '0', '1544237686', '1544237686');
INSERT INTO `wit_customer_log` VALUES ('245', '17', '30', '0', '3', '', '0', '1544237687', '1544237687');
INSERT INTO `wit_customer_log` VALUES ('246', '17', '50', '0', '3', '', '0', '1544237696', '1544237696');
INSERT INTO `wit_customer_log` VALUES ('247', '17', '30', '0', '3', '', '0', '1544237706', '1544237706');
INSERT INTO `wit_customer_log` VALUES ('248', '17', '10', '0', '3', '', '0', '1544237719', '1544237719');
INSERT INTO `wit_customer_log` VALUES ('249', '17', '50', '0', '3', '', '0', '1544237731', '1544237731');
INSERT INTO `wit_customer_log` VALUES ('250', '4', '20', '0', '3', '', '0', '1544237792', '1544237792');
INSERT INTO `wit_customer_log` VALUES ('251', '4', '20', '0', '3', '', '0', '1544237802', '1544237802');
INSERT INTO `wit_customer_log` VALUES ('252', '17', '50', '0', '3', '', '0', '1544237826', '1544237826');
INSERT INTO `wit_customer_log` VALUES ('253', '17', '40', '0', '3', '', '0', '1544237840', '1544237840');
INSERT INTO `wit_customer_log` VALUES ('254', '4', '20', '0', '3', '', '0', '1544237975', '1544237975');
INSERT INTO `wit_customer_log` VALUES ('255', '4', '50', '0', '3', '', '0', '1544237986', '1544237986');
INSERT INTO `wit_customer_log` VALUES ('256', '4', '20', '0', '3', '', '0', '1544238015', '1544238015');
INSERT INTO `wit_customer_log` VALUES ('257', '4', '20', '0', '3', '', '0', '1544238025', '1544238025');
INSERT INTO `wit_customer_log` VALUES ('258', '4', '10', '0', '3', '', '0', '1544238051', '1544238051');
INSERT INTO `wit_customer_log` VALUES ('259', '4', '30', '0', '3', '', '0', '1544238060', '1544238060');
INSERT INTO `wit_customer_log` VALUES ('260', '17', '100', '0', '1', '购买数学发展史课程', '0', '1544238298', '0');
INSERT INTO `wit_customer_log` VALUES ('261', '19', '10', '0', '0', '签到+10', '0', '1544254726', '0');
INSERT INTO `wit_customer_log` VALUES ('262', '4', '0', '0', '6', '', '0', '1544168996', '0');
INSERT INTO `wit_customer_log` VALUES ('263', '11', '0', '0', '6', '', '0', '1544168996', '0');
INSERT INTO `wit_customer_log` VALUES ('264', '19', '20', '0', '3', '', '0', '1544258616', '1544258616');
INSERT INTO `wit_customer_log` VALUES ('265', '19', '40', '0', '3', '', '0', '1544258626', '1544258626');
INSERT INTO `wit_customer_log` VALUES ('266', '20', '0', '0', '6', '', '0', '1544264906', '1544264906');
INSERT INTO `wit_customer_log` VALUES ('267', '11', '40', '0', '3', '', '0', '1544267786', '1544267786');
INSERT INTO `wit_customer_log` VALUES ('268', '11', '20', '0', '3', '', '0', '1544268059', '1544268059');
INSERT INTO `wit_customer_log` VALUES ('269', '19', '100000', '0', '4', '', '1', '1544269256', '1544269256');
INSERT INTO `wit_customer_log` VALUES ('270', '19', '100', '0', '1', '购买幼儿初级潜能班(12-36个月)课程', '0', '1544269469', '0');
INSERT INTO `wit_customer_log` VALUES ('271', '19', '100', '0', '1', '购买学能提升班(3-6岁)课程', '0', '1544270341', '0');
INSERT INTO `wit_customer_log` VALUES ('272', '4', '40', '0', '0', '签到+40', '0', '1544405250', '0');
INSERT INTO `wit_customer_log` VALUES ('273', '21', '0', '0', '6', '', '0', '1544408124', '1544408124');
INSERT INTO `wit_customer_log` VALUES ('274', '22', '0', '0', '6', '', '0', '1544408379', '1544408379');
INSERT INTO `wit_customer_log` VALUES ('275', '23', '0', '0', '6', '', '0', '1544408413', '1544408413');
INSERT INTO `wit_customer_log` VALUES ('276', '24', '0', '0', '6', '', '0', '1544408577', '1544408577');
INSERT INTO `wit_customer_log` VALUES ('277', '25', '0', '0', '6', '', '0', '1544408694', '1544408694');
INSERT INTO `wit_customer_log` VALUES ('278', '26', '0', '0', '6', '', '0', '1544408803', '1544408803');
INSERT INTO `wit_customer_log` VALUES ('279', '27', '0', '0', '6', '', '0', '1544408926', '1544408926');
INSERT INTO `wit_customer_log` VALUES ('280', '28', '0', '0', '6', '', '0', '1544409506', '1544409506');
INSERT INTO `wit_customer_log` VALUES ('281', '29', '0', '0', '6', '', '0', '1544422715', '1544422715');
INSERT INTO `wit_customer_log` VALUES ('282', '30', '0', '0', '6', '', '0', '1544422996', '1544422996');
INSERT INTO `wit_customer_log` VALUES ('283', '31', '0', '0', '6', '', '0', '1544425656', '1544425656');
INSERT INTO `wit_customer_log` VALUES ('284', '32', '0', '0', '6', '', '0', '1544425680', '1544425680');
INSERT INTO `wit_customer_log` VALUES ('285', '4', '0', '0', '7', '您的好友wittree_13521170223通过注册给您返利10', '0', '1544425772', '1544425772');
INSERT INTO `wit_customer_log` VALUES ('286', '4', '10', '0', '7', '您的好友wittree_13521170324通过注册给您返利10', '0', '1544425851', '1544425851');
INSERT INTO `wit_customer_log` VALUES ('287', '4', '50', '0', '0', '签到+50', '0', '1544492570', '0');

-- ----------------------------
-- Table structure for wit_customer_message
-- ----------------------------
DROP TABLE IF EXISTS `wit_customer_message`;
CREATE TABLE `wit_customer_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id（用户表customer主键id）',
  `message_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_customer_message
-- ----------------------------
INSERT INTO `wit_customer_message` VALUES ('4', '0', '39', '1544434501', '0');
INSERT INTO `wit_customer_message` VALUES ('5', '11', '40', '1544434509', '0');

-- ----------------------------
-- Table structure for wit_cus_reg_log
-- ----------------------------
DROP TABLE IF EXISTS `wit_cus_reg_log`;
CREATE TABLE `wit_cus_reg_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '注册用户id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户注册记录表';

-- ----------------------------
-- Records of wit_cus_reg_log
-- ----------------------------

-- ----------------------------
-- Table structure for wit_draw
-- ----------------------------
DROP TABLE IF EXISTS `wit_draw`;
CREATE TABLE `wit_draw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `se_num` int(11) NOT NULL COMMENT '设置签到次数',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_draw
-- ----------------------------
INSERT INTO `wit_draw` VALUES ('1', '2', '1544088952', '0');

-- ----------------------------
-- Table structure for wit_draw_new
-- ----------------------------
DROP TABLE IF EXISTS `wit_draw_new`;
CREATE TABLE `wit_draw_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id(customer表主键id)',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_draw_new
-- ----------------------------
INSERT INTO `wit_draw_new` VALUES ('1', '4', 'walt06抽奖获得20分', '1544065018', '1544065018');
INSERT INTO `wit_draw_new` VALUES ('2', '4', 'walt抽奖获得50分', '1544066128', '1544066128');
INSERT INTO `wit_draw_new` VALUES ('3', '4', 'walt抽奖获得20分', '1544066266', '1544066266');
INSERT INTO `wit_draw_new` VALUES ('4', '4', 'walt抽奖获得40分', '1544066742', '1544066742');
INSERT INTO `wit_draw_new` VALUES ('5', '4', 'walt抽奖获得50分', '1544066857', '1544066857');
INSERT INTO `wit_draw_new` VALUES ('6', '4', 'walt抽奖获得30分', '1544066928', '1544066928');
INSERT INTO `wit_draw_new` VALUES ('7', '4', 'walt抽奖获得20分', '1544066939', '1544066939');
INSERT INTO `wit_draw_new` VALUES ('8', '4', 'walt抽奖获得50分', '1544075046', '1544075046');
INSERT INTO `wit_draw_new` VALUES ('9', '4', 'walt抽奖获得20分', '1544075058', '1544075058');
INSERT INTO `wit_draw_new` VALUES ('10', '4', 'walt抽奖获得40分', '1544075072', '1544075072');
INSERT INTO `wit_draw_new` VALUES ('11', '4', 'walt抽奖获得50分', '1544075086', '1544075086');
INSERT INTO `wit_draw_new` VALUES ('12', '4', 'walt抽奖获得20分', '1544079070', '1544079070');
INSERT INTO `wit_draw_new` VALUES ('13', '4', 'walt抽奖获得30分', '1544079314', '1544079314');
INSERT INTO `wit_draw_new` VALUES ('14', '4', 'walt抽奖获得40分', '1544079393', '1544079393');
INSERT INTO `wit_draw_new` VALUES ('15', '4', 'walt抽奖获得40分', '1544079407', '1544079407');
INSERT INTO `wit_draw_new` VALUES ('16', '4', 'walt抽奖获得50分', '1544079486', '1544079486');
INSERT INTO `wit_draw_new` VALUES ('17', '13', 'wittree_15398007612抽奖获得50分', '1544079576', '1544079576');
INSERT INTO `wit_draw_new` VALUES ('18', '4', 'walt抽奖获得40分', '1544079711', '1544079711');
INSERT INTO `wit_draw_new` VALUES ('19', '4', 'walt抽奖获得50分', '1544081382', '1544081382');
INSERT INTO `wit_draw_new` VALUES ('20', '17', 'wittree_17782630535抽奖获得30分', '1544081514', '1544081514');
INSERT INTO `wit_draw_new` VALUES ('21', '17', 'wittree_17782630535抽奖获得40分', '1544081525', '1544081525');
INSERT INTO `wit_draw_new` VALUES ('22', '4', 'walt抽奖获得50分', '1544175460', '1544175460');
INSERT INTO `wit_draw_new` VALUES ('23', '4', 'walt抽奖获得30分', '1544175474', '1544175474');
INSERT INTO `wit_draw_new` VALUES ('24', '4', 'walt抽奖获得30分', '1544175621', '1544175621');
INSERT INTO `wit_draw_new` VALUES ('25', '4', 'walt抽奖获得20分', '1544175631', '1544175631');
INSERT INTO `wit_draw_new` VALUES ('26', '4', 'walt抽奖获得30分', '1544175640', '1544175640');
INSERT INTO `wit_draw_new` VALUES ('27', '4', 'walt抽奖获得50分', '1544175649', '1544175649');
INSERT INTO `wit_draw_new` VALUES ('28', '4', 'walt抽奖获得30分', '1544175756', '1544175756');
INSERT INTO `wit_draw_new` VALUES ('29', '4', 'walt抽奖获得50分', '1544175790', '1544175790');
INSERT INTO `wit_draw_new` VALUES ('30', '11', 'wittree_18339306470抽奖获得30分', '1544236891', '1544236891');
INSERT INTO `wit_draw_new` VALUES ('31', '11', 'wittree_18339306470抽奖获得50分', '1544236901', '1544236901');
INSERT INTO `wit_draw_new` VALUES ('32', '4', 'walt抽奖获得40分', '1544237111', '1544237111');
INSERT INTO `wit_draw_new` VALUES ('33', '4', 'walt抽奖获得40分', '1544237121', '1544237121');
INSERT INTO `wit_draw_new` VALUES ('34', '4', 'walt抽奖获得20分', '1544237666', '1544237666');
INSERT INTO `wit_draw_new` VALUES ('35', '4', 'walt抽奖获得50分', '1544237675', '1544237675');
INSERT INTO `wit_draw_new` VALUES ('36', '4', 'walt抽奖获得30分', '1544237686', '1544237686');
INSERT INTO `wit_draw_new` VALUES ('37', '17', 'wittree_17782630535抽奖获得30分', '1544237687', '1544237687');
INSERT INTO `wit_draw_new` VALUES ('38', '17', 'wittree_17782630535抽奖获得50分', '1544237696', '1544237696');
INSERT INTO `wit_draw_new` VALUES ('39', '17', 'wittree_17782630535抽奖获得30分', '1544237706', '1544237706');
INSERT INTO `wit_draw_new` VALUES ('40', '17', 'wittree_17782630535抽奖获得10分', '1544237719', '1544237719');
INSERT INTO `wit_draw_new` VALUES ('41', '17', 'wittree_17782630535抽奖获得50分', '1544237731', '1544237731');
INSERT INTO `wit_draw_new` VALUES ('42', '4', 'walt抽奖获得20分', '1544237792', '1544237792');
INSERT INTO `wit_draw_new` VALUES ('43', '4', 'walt抽奖获得20分', '1544237802', '1544237802');
INSERT INTO `wit_draw_new` VALUES ('44', '17', 'wittree_17782630535抽奖获得50分', '1544237826', '1544237826');
INSERT INTO `wit_draw_new` VALUES ('45', '17', 'wittree_17782630535抽奖获得40分', '1544237840', '1544237840');
INSERT INTO `wit_draw_new` VALUES ('46', '4', 'walt抽奖获得20分', '1544237975', '1544237975');
INSERT INTO `wit_draw_new` VALUES ('47', '4', 'walt抽奖获得50分', '1544237986', '1544237986');
INSERT INTO `wit_draw_new` VALUES ('48', '4', 'walt抽奖获得20分', '1544238015', '1544238015');
INSERT INTO `wit_draw_new` VALUES ('49', '4', 'walt抽奖获得20分', '1544238025', '1544238025');
INSERT INTO `wit_draw_new` VALUES ('50', '4', 'walt抽奖获得10分', '1544238051', '1544238051');
INSERT INTO `wit_draw_new` VALUES ('51', '4', 'walt抽奖获得30分', '1544238060', '1544238060');
INSERT INTO `wit_draw_new` VALUES ('52', '19', 'wittree_17629005156抽奖获得20分', '1544258616', '1544258616');
INSERT INTO `wit_draw_new` VALUES ('53', '19', 'wittree_17629005156抽奖获得40分', '1544258626', '1544258626');
INSERT INTO `wit_draw_new` VALUES ('54', '11', 'wittree_18339306470抽奖获得40分', '1544267786', '1544267786');
INSERT INTO `wit_draw_new` VALUES ('55', '11', 'wittree_18339306470抽奖获得20分', '1544268059', '1544268059');

-- ----------------------------
-- Table structure for wit_feedback
-- ----------------------------
DROP TABLE IF EXISTS `wit_feedback`;
CREATE TABLE `wit_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id(表customer的主键id)',
  `type` mediumint(8) NOT NULL COMMENT '反馈类型',
  `desc` varchar(255) NOT NULL COMMENT '问题描述',
  `url` varchar(255) NOT NULL,
  `linkman` varchar(50) NOT NULL COMMENT '联系人',
  `phone` char(11) NOT NULL COMMENT '联系电话',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0-未处理1-已处理2-已查看',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='用户反馈信息表';

-- ----------------------------
-- Records of wit_feedback
-- ----------------------------
INSERT INTO `wit_feedback` VALUES ('2', '4', '0', '课程反馈', '/upload/feedback/20181203/981c1682ebc9fe92df2a364f5df321a0.png', '范德萨范德萨', '153153', '2', '1543832717', '1543832717');
INSERT INTO `wit_feedback` VALUES ('13', '17', '0', '好好干吧', '', '', '', '0', '1544236892', '1544236892');
INSERT INTO `wit_feedback` VALUES ('14', '19', '0', '我的课程有问题', '', '1231321321', '3213213213', '0', '1544257802', '1544257802');

-- ----------------------------
-- Table structure for wit_integral_config
-- ----------------------------
DROP TABLE IF EXISTS `wit_integral_config`;
CREATE TABLE `wit_integral_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(20) NOT NULL COMMENT '天数',
  `integral` varchar(30) NOT NULL COMMENT '积分数',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='积分规则表';

-- ----------------------------
-- Records of wit_integral_config
-- ----------------------------
INSERT INTO `wit_integral_config` VALUES ('1', '1', '10', '1543547371', '1543547371');
INSERT INTO `wit_integral_config` VALUES ('2', '2', '20', '1543547378', '1543547378');
INSERT INTO `wit_integral_config` VALUES ('3', '3', '30', '1543547386', '1543547387');
INSERT INTO `wit_integral_config` VALUES ('4', '4', '40', '1543547395', '1543547395');
INSERT INTO `wit_integral_config` VALUES ('5', '5', '50', '1543547402', '1543547402');
INSERT INTO `wit_integral_config` VALUES ('6', '6', '60', '1543547409', '1543547409');
INSERT INTO `wit_integral_config` VALUES ('8', '7', '90', '1544167360', '1544167360');

-- ----------------------------
-- Table structure for wit_lesson
-- ----------------------------
DROP TABLE IF EXISTS `wit_lesson`;
CREATE TABLE `wit_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '课时标题',
  `course_id` int(11) NOT NULL COMMENT '属于哪个课程id（course表id）',
  `chapter_id` int(11) NOT NULL COMMENT '章节id（表chapter.id）暂时不用',
  `lesson` varchar(20) NOT NULL COMMENT '课节',
  `url` varchar(255) NOT NULL COMMENT '课程链接',
  `status` tinyint(1) NOT NULL COMMENT '0-已学习1-未学习',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='课时表';

-- ----------------------------
-- Records of wit_lesson
-- ----------------------------
INSERT INTO `wit_lesson` VALUES ('4', '英语语法', '3', '4', '第二节', '/upload/lesson/20181123/ccf37842acf0693e07ada98548eebf93.png', '0', '1542939787', '1543225767');
INSERT INTO `wit_lesson` VALUES ('5', '什么谓语', '3', '4', '第一节', '/upload/lesson/20181123/1115d625141a7eaaba7c7b9fd6c0348a.png', '0', '1542939812', '1542939812');
INSERT INTO `wit_lesson` VALUES ('6', '英语口语', '3', '0', '第二节', '/upload/lesson/20181123/6ba0ec916c78873eb667ed127c01e208.png', '0', '1543658418', '1543658418');
INSERT INTO `wit_lesson` VALUES ('7', '英语常用短语', '3', '0', '第二节', '/upload/lesson/20181123/5f5ddb2af2bd639d32352f52e6f5e926.png', '0', '1542966783', '1542966783');
INSERT INTO `wit_lesson` VALUES ('8', '函数', '4', '0', '第一节', '/upload/lesson/20181127/132ecd6aaa5c46654af2d064de739304.png', '0', '1543653663', '1543653663');
INSERT INTO `wit_lesson` VALUES ('10', '学霸右脑第一课', '38', '0', '1', '/upload/lesson/20181208/e4d1711d8f28bab3f47c8c8604c93358.png', '0', '1544269816', '1544269816');
INSERT INTO `wit_lesson` VALUES ('11', '学霸右脑第二课', '38', '0', '2', '/upload/lesson/20181208/94d996f754847d5e576ad50434480b2d.png', '0', '1544269856', '1544269856');
INSERT INTO `wit_lesson` VALUES ('12', '学霸右脑第三课', '38', '0', '3', '/upload/lesson/20181208/3b05d7af417fadd3437babb8bace1f6a.png', '0', '1544269883', '1544269883');
INSERT INTO `wit_lesson` VALUES ('13', '学霸右脑第四课', '38', '0', '4', '/upload/lesson/20181208/21d2d74af0aa993bd50de9c8d958b288.png', '0', '1544269908', '1544269908');
INSERT INTO `wit_lesson` VALUES ('14', '学霸右脑第伍课', '38', '0', '5', '/upload/lesson/20181208/d29f1eadea23e3857ecbb45eb70b1b04.png', '0', '1544269946', '1544269946');
INSERT INTO `wit_lesson` VALUES ('15', '学霸右脑第六课', '37', '0', '6', '/upload/lesson/20181208/88543f9691c93c389463943ceb0a793e.png', '0', '1544269992', '1544269992');
INSERT INTO `wit_lesson` VALUES ('16', '学霸右脑第七课', '37', '0', '7', '/upload/lesson/20181208/3e5268fdd57f0f43b8ce4ae9e0bd264e.png', '0', '1544270022', '1544270022');
INSERT INTO `wit_lesson` VALUES ('17', '学霸右脑第八课', '37', '0', '8', '/upload/lesson/20181208/a1a684d1aaa6e8f5ee3285a741f8884b.png', '0', '1544270049', '1544270049');
INSERT INTO `wit_lesson` VALUES ('18', '学霸右脑第九课', '37', '0', '9', '/upload/lesson/20181208/3d4b85e9b563650e3bd26f17994d6efc.png', '0', '1544270079', '1544270079');
INSERT INTO `wit_lesson` VALUES ('19', '学霸右脑第十课', '37', '0', '10', '/upload/lesson/20181208/a76d488ec26601906a2bc1fa3c6b99af.png', '0', '1544270099', '1544270099');
INSERT INTO `wit_lesson` VALUES ('20', '学霸右脑第十一课', '36', '0', '11', '/upload/lesson/20181208/aa7e2fc04794cd7552557963505bdf7a.png', '0', '1544270123', '1544270123');
INSERT INTO `wit_lesson` VALUES ('21', '学霸右脑第十二课', '36', '0', '12', '/upload/lesson/20181208/85b5bcc70c0911bd9c8f99edb0e95b39.png', '0', '1544270141', '1544270141');
INSERT INTO `wit_lesson` VALUES ('22', '学霸右脑第十三课', '36', '0', '13', '/upload/lesson/20181208/58d046d5b727b5fa5a6783c39d942028.png', '0', '1544270159', '1544270159');
INSERT INTO `wit_lesson` VALUES ('23', '学霸右脑第十四课', '36', '0', '14', '/upload/lesson/20181208/10021b2346a30e865b5619620b3280ec.png', '0', '1544270177', '1544270177');
INSERT INTO `wit_lesson` VALUES ('24', '学霸右脑第十伍课', '36', '0', '15', '/upload/lesson/20181208/7503fabdae539f4ddca0115242889c04.png', '0', '1544270196', '1544270196');
INSERT INTO `wit_lesson` VALUES ('25', '学霸右脑第十六课', '35', '0', '16', '/upload/lesson/20181208/d5879b9334f76c070b17fe9b2ffbad83.png', '0', '1544270216', '1544270216');
INSERT INTO `wit_lesson` VALUES ('26', '学霸右脑第十七课', '35', '0', '17', '/upload/lesson/20181208/55e4ae5443b563e2f00de230a8d63862.png', '0', '1544270237', '1544270237');
INSERT INTO `wit_lesson` VALUES ('27', '学霸右脑第十八课', '35', '0', '18', '/upload/lesson/20181208/f38a01f68e191b727fa805bbd40cf4a5.png', '0', '1544270258', '1544270258');
INSERT INTO `wit_lesson` VALUES ('28', '学霸右脑第十九课', '35', '0', '19', '/upload/lesson/20181208/d3d91c39260c537cac5d82f23578d8a9.png', '0', '1544270276', '1544270276');
INSERT INTO `wit_lesson` VALUES ('29', '学霸右脑第二十课', '35', '0', '20', '/upload/lesson/20181208/a7378ecda64fb6d89904bd3e1baba481.png', '0', '1544270295', '1544270295');

-- ----------------------------
-- Table structure for wit_lotto
-- ----------------------------
DROP TABLE IF EXISTS `wit_lotto`;
CREATE TABLE `wit_lotto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '标题',
  `integral` varchar(50) NOT NULL COMMENT '奖品',
  `odds` int(12) NOT NULL COMMENT '中奖几率',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_lotto
-- ----------------------------
INSERT INTO `wit_lotto` VALUES ('1', '10积分', '10', '1', '1543910725', '1543910725');
INSERT INTO `wit_lotto` VALUES ('2', '20积分', '20', '2', '1543910736', '1543910736');
INSERT INTO `wit_lotto` VALUES ('3', '30积分', '30', '3', '1543910750', '1543910750');
INSERT INTO `wit_lotto` VALUES ('4', '40积分', '40', '4', '1543910763', '1543910763');
INSERT INTO `wit_lotto` VALUES ('5', '50积分', '50', '5', '1544168052', '1544168052');
INSERT INTO `wit_lotto` VALUES ('6', '谢谢参与', '0', '0', '1543919211', '1543919211');

-- ----------------------------
-- Table structure for wit_message
-- ----------------------------
DROP TABLE IF EXISTS `wit_message`;
CREATE TABLE `wit_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL COMMENT '消息内容',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_message
-- ----------------------------
INSERT INTO `wit_message` VALUES ('38', '多发发大水法萨芬', '1544434496', '1544434496');
INSERT INTO `wit_message` VALUES ('39', '方式发顺丰的', '1544434501', '1544434501');
INSERT INTO `wit_message` VALUES ('40', '发发撒的发生的', '1544434509', '1544434509');

-- ----------------------------
-- Table structure for wit_message_read
-- ----------------------------
DROP TABLE IF EXISTS `wit_message_read`;
CREATE TABLE `wit_message_read` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mess_id` int(11) NOT NULL COMMENT '消息id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `is_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-未读1-已读2-已删除',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_message_read
-- ----------------------------
INSERT INTO `wit_message_read` VALUES ('49', '39', '4', '1', '1544434729', '1544434729');
INSERT INTO `wit_message_read` VALUES ('53', '39', '11', '2', '0', '0');
INSERT INTO `wit_message_read` VALUES ('51', '40', '11', '1', '1544435098', '1544435098');
INSERT INTO `wit_message_read` VALUES ('52', '39', '11', '1', '1544436146', '1544436146');

-- ----------------------------
-- Table structure for wit_news
-- ----------------------------
DROP TABLE IF EXISTS `wit_news`;
CREATE TABLE `wit_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `url` varchar(255) NOT NULL COMMENT '图片链接',
  `desc` varchar(200) NOT NULL,
  `keywords` varchar(120) NOT NULL COMMENT '关键词',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `link_url` varchar(255) NOT NULL COMMENT '新闻链接',
  `status` tinyint(1) NOT NULL COMMENT '-1删除0启用1禁用',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_news
-- ----------------------------
INSERT INTO `wit_news` VALUES ('3', '广播通知广播通知！！！', '/upload/news/20181114/3b23fc42e697a408b5b352b4c0c14527.png', '娱乐你的神经', '娱乐,实时', '<p>娱乐新闻</p>', 'https://baike.baidu.com/item/%E6%99%BA%E6%85%A7%E6%A0%91/33028?fr=aladdin', '0', '1544263471', '1544263471');
INSERT INTO `wit_news` VALUES ('4', '智慧树新课程上线了“学霸右脑”让您的孩子耿聪', '/upload/news/20181114/5605367202795b90ea88c171c1e96a6e.png', '微信项目', '微信,官网', '<p>项目上线了</p>', 'http://www.baidu.com', '0', '1544263392', '1544263393');
INSERT INTO `wit_news` VALUES ('6', '恭喜用户“小希”，完成学霸右脑所有课程', '/upload/news/20181207/c08813a66bd579d30fb362fb25579fee.jpg', '哒哒哒哒哒哒多多', '官网', '<p>哒哒哒哒哒哒多多多多多</p>', 'http://www.baidu.com', '0', '1544263349', '1544263349');

-- ----------------------------
-- Table structure for wit_node
-- ----------------------------
DROP TABLE IF EXISTS `wit_node`;
CREATE TABLE `wit_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `type_id` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of wit_node
-- ----------------------------
INSERT INTO `wit_node` VALUES ('1', '权限管理', '#', '#', '2', '0', 'fa fa-users');
INSERT INTO `wit_node` VALUES ('2', '管理员管理', 'user', 'index', '2', '1', '');
INSERT INTO `wit_node` VALUES ('3', '添加管理员', 'user', 'useradd', '1', '2', '');
INSERT INTO `wit_node` VALUES ('4', '编辑管理员', 'user', 'useredit', '1', '2', '');
INSERT INTO `wit_node` VALUES ('5', '删除管理员', 'user', 'userdel', '1', '2', '');
INSERT INTO `wit_node` VALUES ('6', '角色管理', 'role', 'index', '2', '1', '');
INSERT INTO `wit_node` VALUES ('7', '添加角色', 'role', 'roleadd', '1', '6', '');
INSERT INTO `wit_node` VALUES ('8', '编辑角色', 'role', 'roleedit', '1', '6', '');
INSERT INTO `wit_node` VALUES ('9', '删除角色', 'role', 'roledel', '1', '6', '');
INSERT INTO `wit_node` VALUES ('10', '分配权限', 'role', 'giveaccess', '1', '6', '');
INSERT INTO `wit_node` VALUES ('11', '系统管理', '#', '#', '2', '0', 'fa fa-desktop');
INSERT INTO `wit_node` VALUES ('12', '数据备份/还原', 'data', 'index', '2', '11', '');
INSERT INTO `wit_node` VALUES ('13', '备份数据', 'data', 'importdata', '1', '12', '');
INSERT INTO `wit_node` VALUES ('14', '还原数据', 'data', 'backdata', '1', '12', '');
INSERT INTO `wit_node` VALUES ('15', '节点管理', 'node', 'index', '2', '1', '');
INSERT INTO `wit_node` VALUES ('16', '添加节点', 'node', 'nodeadd', '1', '15', '');
INSERT INTO `wit_node` VALUES ('17', '编辑节点', 'node', 'nodeedit', '1', '15', '');
INSERT INTO `wit_node` VALUES ('18', '删除节点', 'node', 'nodedel', '1', '15', '');
INSERT INTO `wit_node` VALUES ('25', '个人中心', '#', '#', '1', '0', '');
INSERT INTO `wit_node` VALUES ('27', '编辑头像', 'profile', 'headedit', '1', '25', '');
INSERT INTO `wit_node` VALUES ('28', '上传头像', 'profile', 'uploadheade', '1', '25', '');
INSERT INTO `wit_node` VALUES ('29', '用户管理', 'customer', 'index', '2', '0', 'glyphicon glyphicon-user');
INSERT INTO `wit_node` VALUES ('30', '用户列表', 'customer', 'index', '2', '29', '');
INSERT INTO `wit_node` VALUES ('31', '用户添加', 'customer', 'customeradd', '1', '30', '');
INSERT INTO `wit_node` VALUES ('32', '用户编辑', 'customer', 'customeredit', '1', '30', '');
INSERT INTO `wit_node` VALUES ('33', '用户删除', 'customer', 'customerdel', '1', '30', '');
INSERT INTO `wit_node` VALUES ('34', '每日签到管理', '#', '#', '2', '0', 'glyphicon glyphicon-book');
INSERT INTO `wit_node` VALUES ('35', '签到设置列表', 'integralconfig', 'index', '2', '34', '');
INSERT INTO `wit_node` VALUES ('36', '签到设置添加', 'integralconfig', 'integralconfigadd', '1', '34', '');
INSERT INTO `wit_node` VALUES ('37', '签到设置编辑', 'integralconfig', 'integralconfigedit', '1', '34', '');
INSERT INTO `wit_node` VALUES ('38', '签到设置删除', 'integralconfig', 'integralconfigdel', '1', '34', '');
INSERT INTO `wit_node` VALUES ('39', '活动新闻管理', '#', '#', '2', '0', 'glyphicon glyphicon-th-list');
INSERT INTO `wit_node` VALUES ('40', '活动新闻列表', 'news', 'index', '2', '39', '');
INSERT INTO `wit_node` VALUES ('41', '添加活动新闻', 'news', 'newsadd', '1', '39', '');
INSERT INTO `wit_node` VALUES ('42', '编辑活动新闻', 'news', 'newsedit', '1', '39', '');
INSERT INTO `wit_node` VALUES ('43', '活动新闻删除', 'news', 'newsdel', '1', '39', '');
INSERT INTO `wit_node` VALUES ('44', '修改密码', 'profile', 'index', '1', '25', '');
INSERT INTO `wit_node` VALUES ('45', '积分抽奖管理', '#', '#', '2', '0', 'glyphicon glyphicon-cloud');
INSERT INTO `wit_node` VALUES ('46', '课程管理', '#', '#', '2', '0', 'glyphicon glyphicon-book');
INSERT INTO `wit_node` VALUES ('47', '上/下分管理', '#', '#', '2', '0', 'glyphicon glyphicon-bookmark');
INSERT INTO `wit_node` VALUES ('48', '复利管理', '#', '#', '2', '0', 'glyphicon glyphicon-compressed');
INSERT INTO `wit_node` VALUES ('49', '统计管理', '#', '#', '2', '0', 'glyphicon glyphicon-stats');
INSERT INTO `wit_node` VALUES ('50', '消费明细管理', '#', '#', '2', '0', 'glyphicon glyphicon-exclamation-sign');
INSERT INTO `wit_node` VALUES ('52', '抽奖奖励添加', 'lotto', 'lottoadd', '1', '112', '');
INSERT INTO `wit_node` VALUES ('55', '抽奖奖励编辑', 'lotto', 'lottoedit', '1', '112', '');
INSERT INTO `wit_node` VALUES ('56', '抽奖奖励删除', 'lotto', 'lottodel', '1', '112', '');
INSERT INTO `wit_node` VALUES ('57', '课程分类管理', 'category', 'index', '2', '46', '');
INSERT INTO `wit_node` VALUES ('59', '课程分类添加', 'category', 'categoryadd', '1', '57', '');
INSERT INTO `wit_node` VALUES ('60', '课程分类编辑', 'category', 'categoryedit', '1', '57', '');
INSERT INTO `wit_node` VALUES ('61', '课程分类删除', 'category', 'categorydel', '1', '57', '');
INSERT INTO `wit_node` VALUES ('62', '课程列表管理', 'course', 'index', '2', '46', '');
INSERT INTO `wit_node` VALUES ('63', '课程列表添加', 'course', 'courseadd', '1', '62', '');
INSERT INTO `wit_node` VALUES ('64', '课程列表编辑', 'course', 'courseedit', '1', '62', '');
INSERT INTO `wit_node` VALUES ('65', '课程列表删除', 'course', 'coursedel', '1', '62', '');
INSERT INTO `wit_node` VALUES ('66', '消费明细查询', 'consumerdetail', 'index', '2', '50', '');
INSERT INTO `wit_node` VALUES ('71', '课时管理', 'lesson', 'index', '2', '46', '');
INSERT INTO `wit_node` VALUES ('73', '课时添加', 'course', 'lessonadd', '1', '62', '');
INSERT INTO `wit_node` VALUES ('74', '课时编辑', 'lesson', 'lessonedit', '1', '71', '');
INSERT INTO `wit_node` VALUES ('75', '课时删除', 'lesson', 'lessondel', '1', '71', '');
INSERT INTO `wit_node` VALUES ('76', '上下分', 'updown', 'uppoint', '2', '47', '');
INSERT INTO `wit_node` VALUES ('80', '复利设置列表', 'compound', 'index', '2', '48', '');
INSERT INTO `wit_node` VALUES ('81', '添加复利设置', 'compound', 'compoundadd', '1', '80', '');
INSERT INTO `wit_node` VALUES ('82', '编辑复利设置', 'compound', 'compoundedit', '1', '80', '');
INSERT INTO `wit_node` VALUES ('83', '删除复利设置', 'compound', 'compounddel', '1', '80', '');
INSERT INTO `wit_node` VALUES ('84', '用户地址列表', 'customeraddress', 'index', '2', '29', '');
INSERT INTO `wit_node` VALUES ('85', '用户地址添加', 'customeraddress', 'customeraddressadd', '1', '84', '');
INSERT INTO `wit_node` VALUES ('86', '用户地址编辑', 'customeraddress', 'customeraddressedit', '1', '84', '');
INSERT INTO `wit_node` VALUES ('87', '用户地址删除', 'customeraddress', 'customeraddressdel', '1', '84', '');
INSERT INTO `wit_node` VALUES ('88', '统计列表', 'stat', 'index', '2', '49', '');
INSERT INTO `wit_node` VALUES ('89', '推荐人奖励设置', 'award', 'index', '2', '29', '');
INSERT INTO `wit_node` VALUES ('90', '推荐人奖励设置添加', 'award', 'awardadd', '1', '89', '');
INSERT INTO `wit_node` VALUES ('91', '推荐人奖励设置编辑', 'award', 'awardedit', '1', '89', '');
INSERT INTO `wit_node` VALUES ('92', '推荐人奖励设置删除', 'award', 'awarddel', '1', '89', '');
INSERT INTO `wit_node` VALUES ('93', '反馈管理', '#', '#', '2', '0', 'glyphicon glyphicon-pencil');
INSERT INTO `wit_node` VALUES ('94', '反馈列表', 'feedback', 'index', '2', '93', '');
INSERT INTO `wit_node` VALUES ('95', '查看反馈', 'feedback', 'checkfeed', '1', '94', '');
INSERT INTO `wit_node` VALUES ('96', '删除反馈', 'feedback', 'feedbackdel', '1', '94', '');
INSERT INTO `wit_node` VALUES ('97', '处理反馈', 'feedback', 'check_feed_back', '1', '94', '');
INSERT INTO `wit_node` VALUES ('103', '课程进度查询', 'order', 'courseindex', '2', '29', '');
INSERT INTO `wit_node` VALUES ('104', '课时进度查询', 'order', 'lessonindex', '1', '103', '');
INSERT INTO `wit_node` VALUES ('105', '课时进度设置', 'order', 'lessonset', '1', '103', '');
INSERT INTO `wit_node` VALUES ('106', '查看用户', 'customer', 'findcustomer', '1', '30', '');
INSERT INTO `wit_node` VALUES ('107', '查看用户课程进度', 'customer', 'findcourse', '1', '30', '');
INSERT INTO `wit_node` VALUES ('108', '查看课程', 'course', 'lookcourse', '1', '62', '');
INSERT INTO `wit_node` VALUES ('110', '实名认证审核', 'customer', 'authindex', '2', '29', '');
INSERT INTO `wit_node` VALUES ('111', '审核操作', 'customer', 'authsave', '1', '110', '');
INSERT INTO `wit_node` VALUES ('112', '抽奖奖励管理', 'lotto', 'index', '2', '45', '');
INSERT INTO `wit_node` VALUES ('113', '抽奖次数管理', 'lotto', 'setting', '2', '45', '');
INSERT INTO `wit_node` VALUES ('114', '消息管理', '#', '#', '2', '0', 'glyphicon glyphicon-new-window');
INSERT INTO `wit_node` VALUES ('115', '消息列表管理', 'message', 'index', '2', '114', '');
INSERT INTO `wit_node` VALUES ('116', '消息添加', 'message', 'messageadd', '1', '115', '');
INSERT INTO `wit_node` VALUES ('117', '消息编辑', 'message', 'messageedit', '1', '115', '');
INSERT INTO `wit_node` VALUES ('118', '消息删除', 'message', 'messagedel', '1', '115', '');

-- ----------------------------
-- Table structure for wit_order
-- ----------------------------
DROP TABLE IF EXISTS `wit_order`;
CREATE TABLE `wit_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `course_id` int(11) NOT NULL COMMENT '课程id',
  `order_number` varchar(32) NOT NULL COMMENT '订单号',
  `total_price` decimal(10,2) NOT NULL COMMENT '总价',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未完结1已完结',
  `pay_time` int(11) NOT NULL,
  `over_time` int(11) NOT NULL COMMENT '课程完结时间',
  `pay_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-已支付1-未支付',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_order
-- ----------------------------
INSERT INTO `wit_order` VALUES ('1', '4', '1', '2018111907617', '1000.00', '0', '1542608772', '0', '1', '1542608772', '1542608772');
INSERT INTO `wit_order` VALUES ('2', '4', '3', '2018111987374', '100.00', '1', '1542608783', '1542966901', '1', '1542608783', '1542608783');
INSERT INTO `wit_order` VALUES ('3', '4', '4', '2018111910549', '100.00', '1', '1542608788', '1544169987', '1', '1542608788', '1542608788');
INSERT INTO `wit_order` VALUES ('4', '5', '1', '2018111946726', '1000.00', '0', '1542608793', '0', '1', '1542608793', '1542608793');
INSERT INTO `wit_order` VALUES ('5', '5', '3', '2018111922029', '100.00', '0', '1542608799', '0', '1', '1542608799', '1542608799');
INSERT INTO `wit_order` VALUES ('6', '5', '4', '2018111901563', '100.00', '0', '1542608803', '0', '1', '1542608803', '1542608803');
INSERT INTO `wit_order` VALUES ('7', '11', '38', '2018120349303', '100.00', '0', '1543801141', '0', '1', '1543801141', '0');
INSERT INTO `wit_order` VALUES ('9', '11', '36', '2018120445730', '300.00', '0', '1543894597', '0', '1', '1543894597', '0');
INSERT INTO `wit_order` VALUES ('10', '4', '37', '2018120607867', '100.00', '0', '1544081758', '0', '1', '1544081758', '0');
INSERT INTO `wit_order` VALUES ('11', '17', '37', '2018120861530', '100.00', '0', '1544237425', '0', '1', '1544237425', '0');
INSERT INTO `wit_order` VALUES ('12', '17', '38', '2018120825629', '100.00', '0', '1544238298', '0', '1', '1544238298', '0');
INSERT INTO `wit_order` VALUES ('13', '19', '38', '2018120809631', '100.00', '0', '1544269469', '0', '1', '1544269469', '0');
INSERT INTO `wit_order` VALUES ('14', '19', '37', '2018120874861', '100.00', '0', '1544270340', '0', '1', '1544270340', '0');

-- ----------------------------
-- Table structure for wit_order_course
-- ----------------------------
DROP TABLE IF EXISTS `wit_order_course`;
CREATE TABLE `wit_order_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `course_id` int(11) NOT NULL COMMENT '课程id',
  `price` decimal(10,2) NOT NULL COMMENT '购买价格',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='订单课程表';

-- ----------------------------
-- Records of wit_order_course
-- ----------------------------
INSERT INTO `wit_order_course` VALUES ('1', '1', '4', '1', '1000.00');
INSERT INTO `wit_order_course` VALUES ('2', '2', '4', '3', '100.00');
INSERT INTO `wit_order_course` VALUES ('3', '3', '4', '4', '100.00');
INSERT INTO `wit_order_course` VALUES ('4', '4', '5', '1', '1000.00');
INSERT INTO `wit_order_course` VALUES ('5', '5', '5', '3', '100.00');
INSERT INTO `wit_order_course` VALUES ('6', '6', '5', '4', '100.00');

-- ----------------------------
-- Table structure for wit_order_learn
-- ----------------------------
DROP TABLE IF EXISTS `wit_order_learn`;
CREATE TABLE `wit_order_learn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id(表customer主键id)',
  `order_id` int(11) NOT NULL,
  `lesson_id` varchar(120) NOT NULL COMMENT '已学课时id',
  `course_id` int(11) NOT NULL,
  `learn_status` tinyint(4) NOT NULL COMMENT '0-未学习1-已学习',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_order_learn
-- ----------------------------
INSERT INTO `wit_order_learn` VALUES ('15', '5', '5', '4', '3', '1', '1543305978', '0');
INSERT INTO `wit_order_learn` VALUES ('16', '5', '5', '5', '3', '1', '1543306345', '0');
INSERT INTO `wit_order_learn` VALUES ('10', '4', '2', '5', '3', '1', '1542953010', '0');
INSERT INTO `wit_order_learn` VALUES ('11', '4', '2', '4', '3', '1', '1542953011', '0');
INSERT INTO `wit_order_learn` VALUES ('12', '4', '2', '6', '3', '1', '1542963319', '0');
INSERT INTO `wit_order_learn` VALUES ('17', '4', '3', '8', '4', '1', '1544169987', '0');
INSERT INTO `wit_order_learn` VALUES ('14', '4', '2', '7', '3', '1', '1542966901', '0');

-- ----------------------------
-- Table structure for wit_role
-- ----------------------------
DROP TABLE IF EXISTS `wit_role`;
CREATE TABLE `wit_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of wit_role
-- ----------------------------
INSERT INTO `wit_role` VALUES ('1', '超级管理员', '*');
INSERT INTO `wit_role` VALUES ('2', '系统维护员', '1,2,3,4,5,6,7,8,9,10,15,16,17,18,11,12,13,14,29,30,31,32');

-- ----------------------------
-- Table structure for wit_score
-- ----------------------------
DROP TABLE IF EXISTS `wit_score`;
CREATE TABLE `wit_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `sc_score` smallint(6) DEFAULT '0',
  `sc_detail` varchar(1000) NOT NULL,
  `sc_type` tinyint(4) DEFAULT '1',
  `sc_status` tinyint(4) DEFAULT '1',
  `sc_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plus_minus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_score
-- ----------------------------
INSERT INTO `wit_score` VALUES ('5', '5', '8', '签到+8', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('6', '5', '8', '签到+8', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('7', '5', '8', '签到+8', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('8', '5', '8', '签到+8', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('9', '0', '8', '签到+8', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('10', '0', null, '签到+', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('11', '11', null, '签到+', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('12', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('13', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('14', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('15', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('16', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('17', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('18', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('19', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('20', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('21', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('22', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('23', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('24', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('25', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('26', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('27', '0', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('28', '4', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('29', '11', '20', '签到+20', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('30', '11', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('31', '4', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('32', '13', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('33', '17', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('34', '4', '20', '签到+20', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('35', '11', '20', '签到+20', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('36', '17', '20', '签到+20', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('37', '4', '30', '签到+30', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('38', '17', '30', '签到+30', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('39', '19', '10', '签到+10', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('40', '4', '40', '签到+40', '0', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `wit_score` VALUES ('41', '4', '50', '签到+50', '0', '1', '0000-00-00 00:00:00', '1');

-- ----------------------------
-- Table structure for wit_sign
-- ----------------------------
DROP TABLE IF EXISTS `wit_sign`;
CREATE TABLE `wit_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id(customer表主键id)',
  `si_count` tinyint(3) unsigned DEFAULT '0',
  `si_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='用户签到表';

-- ----------------------------
-- Records of wit_sign
-- ----------------------------
INSERT INTO `wit_sign` VALUES ('41', '11', '2', '2018-12-07 15:07:22');
INSERT INTO `wit_sign` VALUES ('43', '4', '5', '2018-12-11 09:42:50');
INSERT INTO `wit_sign` VALUES ('44', '13', '1', '2018-12-06 14:58:54');
INSERT INTO `wit_sign` VALUES ('45', '17', '3', '2018-12-08 10:31:40');
INSERT INTO `wit_sign` VALUES ('46', '19', '1', '2018-12-08 15:38:46');

-- ----------------------------
-- Table structure for wit_teacher
-- ----------------------------
DROP TABLE IF EXISTS `wit_teacher`;
CREATE TABLE `wit_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '讲师名字',
  `url` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '老师类别',
  `status` tinyint(4) NOT NULL COMMENT '0-禁用1-启用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_teacher
-- ----------------------------

-- ----------------------------
-- Table structure for wit_user
-- ----------------------------
DROP TABLE IF EXISTS `wit_user`;
CREATE TABLE `wit_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '密码',
  `head` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '头像',
  `login_times` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '真实姓名',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of wit_user
-- ----------------------------
INSERT INTO `wit_user` VALUES ('1', 'admin', 'a9ddd2e7bdff202e3e9bca32765e9ba0', '/upload/head/rZHqi40SYOBxovRgUh15nG7DpPa9tLFw.png', '83', '127.0.0.1', '1544405226', 'admin', '1', '1');
INSERT INTO `wit_user` VALUES ('2', '三才', 'a9ddd2e7bdff202e3e9bca32765e9ba0', '/static/admin/images/profile_small.jpg', '4', '127.0.0.1', '1543398567', 'admin', '1', '2');
INSERT INTO `wit_user` VALUES ('4', '刘十三', '84386805f4fa719c7023544210fea50c', '/static/admin/images/profile_small.jpg', '1', '192.168.31.93', '1544145819', '刘十二', '1', '1');

-- ----------------------------
-- Table structure for wit_wxaccount
-- ----------------------------
DROP TABLE IF EXISTS `wit_wxaccount`;
CREATE TABLE `wit_wxaccount` (
  `wx_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `wx_appid` varchar(20) DEFAULT NULL COMMENT '微信 id',
  `wx_appsecret` varchar(32) DEFAULT '' COMMENT '微信appcecert',
  `wx_access_time` int(10) DEFAULT '0' COMMENT '获取token时间',
  `wx_accesstoken` varchar(200) DEFAULT NULL COMMENT '微信 accesstoken',
  `jsapi_ticket` text COMMENT 'js 权限签名',
  PRIMARY KEY (`wx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wit_wxaccount
-- ----------------------------
