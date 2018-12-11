SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_order`;
CREATE TABLE `wit_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `order_number` varchar(32) NOT NULL COMMENT '订单号',
  `project_id` int(11) NOT NULL COMMENT '课程id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1删除0启用1禁用',
  `pay_time` int(11) NOT NULL,
  `pay_status` tinyint(1) NOT NULL COMMENT '0-已支付1-未支付',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

