DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links`
(
	`id` int NOT NULL AUTO_INCREMENT,
	`link` varchar(256) NOT NULL,
	`used` ENUM('0', '1') DEFAULT '0',
	PRIMARY KEY (`id`)
);
