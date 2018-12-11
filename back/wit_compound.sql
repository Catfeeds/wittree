SET FOREIGN_KEY_CHECKS=0;
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

insert into `wit_compound`(`id`,`from_money`,`end_money`,`rate`,`year`,`create_time`,`update_time`) values('1','1000.00','2000.00','0.99','','1542619381','1542620315');
insert into `wit_compound`(`id`,`from_money`,`end_money`,`rate`,`year`,`create_time`,`update_time`) values('2','3000.00','4000.00','0.55','','1542619532','1542619924');
insert into `wit_compound`(`id`,`from_money`,`end_money`,`rate`,`year`,`create_time`,`update_time`) values('3','4000.00','5000.00','0.66','','1542619590','1542619917');
insert into `wit_compound`(`id`,`from_money`,`end_money`,`rate`,`year`,`create_time`,`update_time`) values('4','6000.00','7000.00','0.77','','1542619699','1542619909');
insert into `wit_compound`(`id`,`from_money`,`end_money`,`rate`,`year`,`create_time`,`update_time`) values('5','8000.00','9000.00','0.88','2','1542619733','1542692834');
insert into `wit_compound`(`id`,`from_money`,`end_money`,`rate`,`year`,`create_time`,`update_time`) values('7','20000.00','30000.00','0.77','1','1542692830','1542699588');
