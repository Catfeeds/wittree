SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_teacher`;
CREATE TABLE `wit_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '讲师名字',
  `url` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '老师类别',
  `status` tinyint(4) NOT NULL COMMENT '0-禁用1-启用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

