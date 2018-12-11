SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wit_score`;
CREATE TABLE `wit_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `sc_score` smallint(6) DEFAULT '0',
  `sc_detail` varchar(1000) NOT NULL,
  `sc_type` tinyint(4) DEFAULT '1',
  `sc_status` tinyint(4) DEFAULT '1',
  `sc_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plus_minus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

