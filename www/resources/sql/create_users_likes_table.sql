DROP TABLE IF EXISTS `user_likes`;
CREATE TABLE IF NOT EXISTS `users_likes`
(
	`id` int NOT NULL AUTO_INCREMENT,
	`user_id` int NOT NULL,
	`post_id` int NOT NULL,
	PRIMARY KEY (`id`)
);
