SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_message_read`;
CREATE TABLE `wit_message_read` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mess_id` int(11) NOT NULL COMMENT '消息id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `is_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-未读1-已读',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

insert into `wit_message_read`(`id`,`mess_id`,`uid`,`is_read`,`create_time`,`update_time`) values('5','7','11','1','1544151754','0');
insert into `wit_message_read`(`id`,`mess_id`,`uid`,`is_read`,`create_time`,`update_time`) values('6','7','11','1','1544151757','0');
insert into `wit_message_read`(`id`,`mess_id`,`uid`,`is_read`,`create_time`,`update_time`) values('7','8','11','1','1544151759','0');
