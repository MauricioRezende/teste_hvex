DROP TABLE IF EXISTS `favorite_activity`;
CREATE TABLE IF NOT EXISTS `favorite_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `key_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;