SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_category`;
CREATE TABLE `wit_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(120) NOT NULL COMMENT '课程分类名',
  `fid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `sort` mediumint(8) NOT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

insert into `wit_category`(`id`,`cat_name`,`fid`,`sort`,`create_time`,`update_time`) values('2','数学','0','11','1542271390','1542273355');
insert into `wit_category`(`id`,`cat_name`,`fid`,`sort`,`create_time`,`update_time`) values('3','语文','0','33','1542273278','1542273278');
insert into `wit_category`(`id`,`cat_name`,`fid`,`sort`,`create_time`,`update_time`) values('4','英语','0','343','1542273592','1542273592');
