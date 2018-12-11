SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_customer_log`;
CREATE TABLE `wit_customer_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `integral` int(20) NOT NULL DEFAULT '0' COMMENT '积分',
  `type` tinyint(4) NOT NULL COMMENT '0-签到积分1-消费积分2-复利3-抽奖4-后台上分5-后台下分',
  `operator_id` int(11) NOT NULL COMMENT '操作人id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='用户积分记录表';

insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('1','4','400','0','0','1542611387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('2','4','500','0','0','1542611387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('3','4','600','0','0','1542611387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('4','4','700','0','0','1542611387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('5','4','800','0','0','1542611387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('6','4','900','0','0','1542611387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('7','4','400','0','0','1542611387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('8','4','400','0','0','1542697787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('9','4','500','0','0','1542697787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('10','4','600','0','0','1542697787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('11','4','700','0','0','1542697787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('12','4','800','0','0','1542697787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('13','4','900','0','0','1542697787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('14','4','400','0','0','1542697787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('15','4','400','0','0','1542784187','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('16','4','1500','0','0','1542784187','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('17','4','600','0','0','1542784187','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('18','4','700','0','0','1542784187','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('19','4','2800','0','0','1542784187','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('20','4','900','0','0','1542784187','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('21','4','400','0','0','1542784187','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('22','4','400','0','0','1542870587','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('23','4','1500','0','0','1542870587','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('24','4','2600','0','0','1542870587','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('25','4','3700','0','0','1542870587','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('26','4','2800','0','0','1542870587','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('27','4','900','0','0','1542870587','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('28','4','400','0','0','1542870587','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('29','4','400','0','0','1542956987','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('30','4','1500','0','0','1542956987','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('31','4','2600','0','0','1542956987','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('32','4','3700','0','0','1542956987','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('33','4','2800','0','0','1542956987','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('34','4','2900','0','0','1542956987','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('35','4','2400','0','0','1542956987','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('36','4','400','0','0','1543043387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('37','4','1500','0','0','1543043387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('38','4','22600','0','0','1543043387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('39','4','32700','0','0','1543043387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('40','4','2800','0','0','1543043387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('41','4','2900','0','0','1543043387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('42','4','2400','0','0','1543043387','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('43','4','400','0','0','1543129787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('44','4','1500','0','0','1543129787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('45','4','22600','0','0','1543129787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('46','4','32700','0','0','1543129787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('47','4','2800','0','0','1543129787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('48','4','22900','0','0','1543129787','0');
insert into `wit_customer_log`(`id`,`uid`,`integral`,`type`,`operator_id`,`create_time`,`update_time`) values('49','4','22400','0','0','1543129787','0');
