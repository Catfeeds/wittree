SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_course`;
CREATE TABLE `wit_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `cat_id` int(11) NOT NULL COMMENT '教程类别',
  `price` decimal(10,2) NOT NULL COMMENT '课程价格',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `url` varchar(255) NOT NULL COMMENT '视频链接',
  `keywords` varchar(120) NOT NULL COMMENT '关键词',
  `desc` varchar(120) NOT NULL COMMENT '描述',
  `content` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1删除0启用1禁用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='课程表';

insert into `wit_course`(`id`,`title`,`cat_id`,`price`,`thumb`,`url`,`keywords`,`desc`,`content`,`status`,`create_time`,`update_time`) values('1','数学三教程','2','1000.00','/upload/Course/20181115/0b95c22ca4e1ba48466ebc9b6e3eb59a.png','','成语,论语','语文好111','<p>语文好111</p>','0','1542272724','1542607917');
insert into `wit_course`(`id`,`title`,`cat_id`,`price`,`thumb`,`url`,`keywords`,`desc`,`content`,`status`,`create_time`,`update_time`) values('3','英语教程','4','100.00','/upload/Course/20181115/6f7e3cd1045e0162c087b4207bb46f87.png','','lesson,math ','English','<p>English</p>','0','1542272945','1542607899');
insert into `wit_course`(`id`,`title`,`cat_id`,`price`,`thumb`,`url`,`keywords`,`desc`,`content`,`status`,`create_time`,`update_time`) values('4','数学教程','2','100.00','/upload/Course/20181115/6cba6417f0618a2ea62474d8f4d5364f.png','','math','数学逻辑','<p>数学逻辑</p>','0','1542273435','1542607880');
