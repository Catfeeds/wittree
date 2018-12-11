SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_address`;
CREATE TABLE `wit_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID 跟用户表user主键关联',
  `province_name` varchar(50) NOT NULL COMMENT '省',
  `city_name` varchar(50) NOT NULL COMMENT '市',
  `area` varchar(255) NOT NULL COMMENT '区',
  `address` varchar(255) NOT NULL COMMENT '详细地址',
  `phone` char(11) NOT NULL COMMENT '联系电话',
  `doorplate` varchar(50) NOT NULL COMMENT '门牌号',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1删除0启用1禁用',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

