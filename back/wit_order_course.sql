SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_order_course`;
CREATE TABLE `wit_order_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `course_id` int(11) NOT NULL COMMENT '课程id',
  `price` decimal(10,2) NOT NULL COMMENT '购买价格',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='订单课程表';

insert into `wit_order_course`(`id`,`order_id`,`uid`,`course_id`,`price`) values('1','1','4','1','1000.00');
insert into `wit_order_course`(`id`,`order_id`,`uid`,`course_id`,`price`) values('2','2','4','3','100.00');
insert into `wit_order_course`(`id`,`order_id`,`uid`,`course_id`,`price`) values('3','3','4','4','100.00');
insert into `wit_order_course`(`id`,`order_id`,`uid`,`course_id`,`price`) values('4','4','5','1','1000.00');
insert into `wit_order_course`(`id`,`order_id`,`uid`,`course_id`,`price`) values('5','5','5','3','100.00');
insert into `wit_order_course`(`id`,`order_id`,`uid`,`course_id`,`price`) values('6','6','5','4','100.00');
