SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_lotto`;
CREATE TABLE `wit_lotto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '标题',
  `integral` varchar(50) NOT NULL COMMENT '奖品',
  `odds` int(12) NOT NULL COMMENT '中奖几率',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

insert into `wit_lotto`(`id`,`title`,`integral`,`odds`,`create_time`,`update_time`) values('2','20积分','20','30','1542247016','1542266771');
