SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_award`;
CREATE TABLE `wit_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '礼物标题',
  `url` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

insert into `wit_award`(`id`,`title`,`url`,`create_time`,`update_time`) values('2','精致礼物','/upload/Award/20181121/9ff0bd14dfdc727c33f16e92e3f57520.png','1542763072','1542763072');
