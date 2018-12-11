SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_node`;
CREATE TABLE `wit_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `type_id` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('1','权限管理','#','#','2','0','fa fa-users');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('2','管理员管理','user','index','2','1','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('3','添加管理员','user','useradd','1','2','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('4','编辑管理员','user','useredit','1','2','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('5','删除管理员','user','userdel','1','2','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('6','角色管理','role','index','2','1','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('7','添加角色','role','roleadd','1','6','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('8','编辑角色','role','roleedit','1','6','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('9','删除角色','role','roledel','1','6','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('10','分配权限','role','giveaccess','1','6','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('11','系统管理','#','#','2','0','fa fa-desktop');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('12','数据备份/还原','data','index','2','11','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('13','备份数据','data','importdata','1','12','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('14','还原数据','data','backdata','1','12','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('15','节点管理','node','index','2','1','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('16','添加节点','node','nodeadd','1','15','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('17','编辑节点','node','nodeedit','1','15','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('18','删除节点','node','nodedel','1','15','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('25','个人中心','#','#','1','0','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('27','编辑头像','profile','headedit','1','25','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('28','上传头像','profile','uploadheade','1','25','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('29','用户管理','customer','index','2','0','glyphicon glyphicon-user');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('30','用户列表','customer','index','2','29','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('31','用户添加','customer','customeradd','1','30','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('32','用户编辑','customer','customeredit','1','30','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('33','用户删除','customer','customerdel','1','30','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('34','每日签到管理','#','#','2','0','glyphicon glyphicon-book');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('35','签到设置列表','integralconfig','index','2','34','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('36','签到设置添加','integralconfig','integralconfigadd','1','34','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('37','签到设置编辑','integralconfig','integralconfigedit','1','34','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('38','签到设置删除','integralconfig','integralconfigdel','1','34','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('39','活动新闻管理','#','#','2','0','glyphicon glyphicon-th-list');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('40','活动新闻列表','news','index','2','39','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('41','添加活动新闻','news','newsadd','1','39','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('42','编辑活动新闻','news','newsedit','1','39','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('43','活动新闻删除','news','newsdel','1','39','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('44','修改密码','profile','index','1','25','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('45','积分抽奖管理','#','#','2','0','glyphicon glyphicon-cloud');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('46','课程管理','#','#','2','0','glyphicon glyphicon-book');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('47','上/下分管理','#','#','2','0','glyphicon glyphicon-bookmark');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('48','复利管理','#','#','2','0','glyphicon glyphicon-compressed');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('49','统计管理','#','#','2','0','glyphicon glyphicon-stats');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('50','消费明细管理','#','#','2','0','glyphicon glyphicon-exclamation-sign');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('52','积分抽奖设置添加','lotto','lottoadd','1','45','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('54','积分抽奖设置查询','lotto','index','2','45','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('55','积分抽奖设置编辑','lotto','lottoedit','1','45','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('56','积分抽奖设置删除','lotto','lottodel','1','45','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('57','课程分类管理','category','index','2','46','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('59','课程分类添加','category','categoryadd','1','57','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('60','课程分类编辑','category','categoryedit','1','57','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('61','课程分类删除','category','categorydel','1','57','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('62','课程列表管理','course','index','2','46','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('63','课程列表添加','course','courseadd','1','62','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('64','课程列表编辑','course','courseedit','1','62','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('65','课程列表删除','course','coursedel','1','62','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('66','消费明细查询','consumerdetail','index','2','50','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('67','课程章节管理','chapter','index','2','46','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('68','课程章节添加','chapter','chapteradd','1','67','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('69','课程章节编辑','chapter','chapteredit','1','67','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('70','课程章节删除','chapter','chapterdel','1','67','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('71','课时管理','lesson','index','2','46','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('73','课时添加','course','lessonadd','1','62','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('74','课时编辑','lesson','lessonedit','1','71','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('75','课时删除','lesson','lessondel','1','71','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('76','上分','updown','uppoint','2','47','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('77','下分','updown','downpoint','2','47','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('78','购买课程查询','updown','payprojectlist','2','47','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('80','复利设置列表','compound','index','2','48','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('81','添加复利设置','compound','compoundadd','1','80','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('82','编辑复利设置','compound','compoundedit','1','80','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('83','删除复利设置','compound','compounddel','1','80','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('84','用户地址列表','customeraddress','index','2','29','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('85','用户地址添加','customeraddress','customeraddressadd','1','84','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('86','用户地址编辑','customeraddress','customeraddressedit','1','84','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('87','用户地址删除','customeraddress','customeraddressdel','1','84','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('88','统计列表','stat','index','2','49','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('89','推荐人奖励设置','award','index','2','29','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('90','推荐人奖励设置添加','award','awardadd','1','89','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('91','推荐人奖励设置编辑','award','awardedit','1','89','');
insert into `wit_node`(`id`,`node_name`,`control_name`,`action_name`,`is_menu`,`type_id`,`style`) values('92','推荐人奖励设置删除','award','awarddel','1','89','');
