SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_integral_config`;
CREATE TABLE `wit_integral_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(20) NOT NULL COMMENT '天数',
  `integral` varchar(30) NOT NULL COMMENT '积分数',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='积分规则表';

insert into `wit_integral_config`(`id`,`day`,`integral`,`create_time`,`update_time`) values('2','1','100','1542181855','1542182259');
insert into `wit_integral_config`(`id`,`day`,`integral`,`create_time`,`update_time`) values('3','3','30','1542181910','1542182229');
