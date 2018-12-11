SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_cus_reg_log`;
CREATE TABLE `wit_cus_reg_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '注册用户id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户注册记录表';

