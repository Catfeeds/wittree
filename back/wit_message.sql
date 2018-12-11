SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_message`;
CREATE TABLE `wit_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `link` varchar(255) NOT NULL COMMENT '公告链接',
  `content` varchar(255) NOT NULL COMMENT '消息内容',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

insert into `wit_message`(`id`,`uid`,`link`,`content`,`create_time`,`update_time`) values('9','0','customer/notice','','1544148562','1544148562');
insert into `wit_message`(`id`,`uid`,`link`,`content`,`create_time`,`update_time`) values('8','0','','系统消息','1544147353','1544147353');
insert into `wit_message`(`id`,`uid`,`link`,`content`,`create_time`,`update_time`) values('7','0','','积分消息','1544147340','1544147340');
