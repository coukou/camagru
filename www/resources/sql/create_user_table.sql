DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
	`id` int NOT NULL AUTO_INCREMENT,
	`email` varchar(32) NOT NULL,
	`username` varchar(16) NOT NULL,
	`password` varchar(64) NOT NULL,
	`activated` ENUM('0', '1') DEFAULT '0',
	`notification` ENUM('0', '1') DEFAULT '0',
	PRIMARY KEY (`id`)
);
