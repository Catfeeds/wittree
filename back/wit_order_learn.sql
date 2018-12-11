SET FOREIGN_KEY_CHECKS=0;
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

insert into `wit_order_learn`(`id`,`uid`,`order_id`,`lesson_id`,`course_id`,`learn_status`,`create_time`,`update_time`) values('8','5','5','4','3','1','1542939827','0');
insert into `wit_order_learn`(`id`,`uid`,`order_id`,`lesson_id`,`course_id`,`learn_status`,`create_time`,`update_time`) values('9','5','5','5','3','1','1542939831','0');
insert into `wit_order_learn`(`id`,`uid`,`order_id`,`lesson_id`,`course_id`,`learn_status`,`create_time`,`update_time`) values('10','4','2','5','3','1','1542953010','0');
insert into `wit_order_learn`(`id`,`uid`,`order_id`,`lesson_id`,`course_id`,`learn_status`,`create_time`,`update_time`) values('11','4','2','4','3','1','1542953011','0');
insert into `wit_order_learn`(`id`,`uid`,`order_id`,`lesson_id`,`course_id`,`learn_status`,`create_time`,`update_time`) values('12','4','2','6','3','1','1542963319','0');
insert into `wit_order_learn`(`id`,`uid`,`order_id`,`lesson_id`,`course_id`,`learn_status`,`create_time`,`update_time`) values('13','5','5','6','3','1','1542963358','0');
insert into `wit_order_learn`(`id`,`uid`,`order_id`,`lesson_id`,`course_id`,`learn_status`,`create_time`,`update_time`) values('14','4','2','7','3','1','1542966901','0');
