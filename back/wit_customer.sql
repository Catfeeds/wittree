SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_customer`;
CREATE TABLE `wit_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `sex` char(2) NOT NULL DEFAULT '' COMMENT '性别0-男1-女',
  `face` varchar(255) NOT NULL COMMENT '用户头像',
  `integral` varchar(20) NOT NULL COMMENT '积分',
  `id_number` varchar(50) NOT NULL COMMENT '身份证号',
  `phone` varchar(50) NOT NULL COMMENT '联系电话',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `bank_number` varchar(50) NOT NULL COMMENT '银行卡号',
  `fid` varchar(32) NOT NULL COMMENT '父编号（wit_customer.ID）',
  `money` decimal(10,2) NOT NULL COMMENT '余额',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `openid` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-正常2-禁用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

insert into `wit_customer`(`id`,`username`,`sex`,`face`,`integral`,`id_number`,`phone`,`address`,`bank_number`,`fid`,`money`,`password`,`openid`,`status`,`create_time`,`update_time`) values('4','walt','0','/upload/face/20181114/bae6d8343b7fb3972e4853254a48f22c.png','','410928199511064210','13521170283','雅荷家园','654613213132','','0.00','fc494bd92b4f0f7bffbf5eab7385ad58','','1','0','0');
insert into `wit_customer`(`id`,`username`,`sex`,`face`,`integral`,`id_number`,`phone`,`address`,`bank_number`,`fid`,`money`,`password`,`openid`,`status`,`create_time`,`update_time`) values('5','walt-zhou','0','/upload/face/20181114/c6808ccaced51437a9dfd9f69023ebf8.png','','410928199511064210','13521170283','雅荷家园','654613213132','','0.00','fc494bd92b4f0f7bffbf5eab7385ad58','','1','1542179338','1542179338');
