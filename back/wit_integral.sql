SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_integral`;
CREATE TABLE `wit_integral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `inregral` varchar(20) NOT NULL COMMENT '积分',
  `type` tinyint(4) NOT NULL COMMENT '0-签到积分2-消费积分',
  `creaate_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户积分表';

