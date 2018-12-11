SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_chapter`;
CREATE TABLE `wit_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '章节',
  `course_id` int(11) NOT NULL COMMENT '课程id（表course_id）',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='章节表';

insert into `wit_chapter`(`id`,`title`,`course_id`,`create_time`,`update_time`) values('2','第一章','1','1542350624','1542350624');
insert into `wit_chapter`(`id`,`title`,`course_id`,`create_time`,`update_time`) values('3','第一章','1','1542356139','1542788900');
insert into `wit_chapter`(`id`,`title`,`course_id`,`create_time`,`update_time`) values('4','第二章','3','1542357048','1542357057');
