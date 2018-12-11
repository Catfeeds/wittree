SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_news`;
CREATE TABLE `wit_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `url` varchar(255) NOT NULL COMMENT '图片链接',
  `desc` varchar(200) NOT NULL,
  `keywords` varchar(120) NOT NULL COMMENT '关键词',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `status` tinyint(1) NOT NULL COMMENT '-1删除0启用1禁用',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

