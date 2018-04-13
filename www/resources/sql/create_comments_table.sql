DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments`
(
	`id` int NOT NULL AUTO_INCREMENT,
	`user_id` int NOT NULL,
	`post_id` int NOT NULL,
	`message` varchar(256) NOT NULL,
	`date` int NOT NULL,
	PRIMARY KEY (`id`)
);
