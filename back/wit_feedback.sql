SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_feedback`;
CREATE TABLE `wit_feedback` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id(表customer的主键id)',
  `type` mediumint(8) NOT NULL COMMENT '反馈类型',
  `desc` varchar(255) NOT NULL COMMENT '问题描述',
  `url` varchar(255) NOT NULL,
  `linkman` varchar(50) NOT NULL COMMENT '联系人',
  `phone` char(11) NOT NULL COMMENT '联系电话',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0-未处理1-已处理2-已查看',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户反馈信息表';

