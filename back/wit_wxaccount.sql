SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_wxaccount`;
CREATE TABLE `wit_wxaccount` (
  `wx_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `wx_appid` varchar(20) DEFAULT NULL COMMENT '微信 id',
  `wx_appsecret` varchar(32) DEFAULT '' COMMENT '微信appcecert',
  `wx_access_time` int(10) DEFAULT '0' COMMENT '获取token时间',
  `wx_accesstoken` varchar(200) DEFAULT NULL COMMENT '微信 accesstoken',
  `jsapi_ticket` text COMMENT 'js 权限签名',
  PRIMARY KEY (`wx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

