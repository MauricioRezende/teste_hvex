CREATE TABLE IF NOT EXISTS `favorite_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `key_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)