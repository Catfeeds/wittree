SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_lesson`;
CREATE TABLE `wit_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL COMMENT '课时标题',
  `course_id` int(11) NOT NULL COMMENT '属于哪个课程id（course表id）',
  `chapter_id` int(11) NOT NULL COMMENT '章节id（表chapter.id）暂时不用',
  `lesson` varchar(20) NOT NULL COMMENT '课节',
  `url` varchar(255) NOT NULL COMMENT '课程链接',
  `status` tinyint(1) NOT NULL COMMENT '0-禁用1-启用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='课时表';

insert into `wit_lesson`(`id`,`title`,`course_id`,`chapter_id`,`lesson`,`url`,`status`,`create_time`,`update_time`) values('1','什么是词语','3','4','第一节','/upload/lesson/20181116/cb71f2120ed7be4010bbad8595062fa4.png','0','1542357754','1542357754');
