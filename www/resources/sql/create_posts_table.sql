DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts`
(
	`id` int NOT NULL AUTO_INCREMENT,
	`user_id` int NOT NULL,
	`img_id` varchar(32) NOT NULL,
	`date` int NOT NULL,
	PRIMARY KEY (`id`)
);
