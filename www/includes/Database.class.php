<?php
require_once("config/database.php");

class Database extends PDO {
	public function __construct() {
		global $DB_DSN, $DB_USER, $DB_PASSWORD;
		parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
	}

	public function getUserByEmail($email) {
		$stmt = $this->prepare("SELECT * FROM `users` WHERE `email` = ?");
		$stmt->execute(array($email));
		return $stmt->fetch();
	}

	public function getUserByUsername($username) {
		$stmt = $this->prepare("SELECT * FROM `users` WHERE `username` = ?");
		$stmt->execute(array($username));
		return $stmt->fetch();
	}

	public function getUserById($id) {
		$stmt = $this->prepare("SELECT * FROM `users` WHERE `id` = ?");
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	public function addUser($email, $user, $password) {
		$stmt = $this->prepare("INSERT INTO `users`(`email`, `username`, `password`) VALUES (?,?,?)");
		$stmt->execute(array($email, $user, hash('sha256', $password)));
		return $stmt->rowCount() > 0;
	}

	public function deleteUser($email) {
		$stmt = $this->prepare("DELETE FROM `users` WHERE `email`=?");
		$stmt->execute(array($email));
		return $stmt->rowCount() > 0;
	}

	public function getPosts($from = 0) {
		$stmt = $this->prepare("SELECT * FROM `posts` WHERE `id` >= ? LIMIT 5");
		$stmt->execute(array($from));
		return $stmt->fetchAll();
	}

	public function getPostById($id) {
		$stmt = $this->prepare("SELECT * FROM `posts` WHERE `id` = ?");
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	public function deletePost($id) {
		$stmt = $this->prepare("DELETE FROM `posts` WHERE `id` = ?");
		$stmt->execute(array($id));
		return $stmt->rowCount() > 0;
	}

	public function getPostComments($id) {
		$stmt = $this->prepare("SELECT * FROM `comments` WHERE `post_id` = ? ORDER BY `date` DESC");
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}

	public function countPostLikes($id) {
		$stmt = $this->prepare("SELECT count(*) FROM `users_likes` WHERE `post_id` = ?");
		$stmt->execute(array($id));
		return $stmt->fetchColumn();
	}

	public function doUserLikePost($user_id, $post_id) {
		$stmt = $this->prepare("SELECT count(*) FROM `users_likes` WHERE `user_id` = ? AND `post_id` = ?");
		$stmt->execute(array($user_id, $post_id));
		return $stmt->fetchColumn() == 1;
	}

	public function likePost($user_id, $post_id) {
		if ($this->doUserLikePost($user_id, $post_id))
			return true;
		$stmt = $this->prepare("INSERT INTO `users_likes`(`user_id`, `post_id`) VALUES (?,?)");
		$stmt->execute(array($user_id, $post_id));
		return $stmt->rowCount() > 0;
	}

	public function unlikePost($user_id, $post_id) {
		if (!$this->doUserLikePost($user_id, $post_id))
			return true;
		$stmt = $this->prepare("DELETE FROM `users_likes` WHERE `user_id` = ? AND `post_id` = ?");
		$stmt->execute(array($user_id, $post_id));
		return $stmt->rowCount() > 0;
	}

	public function addComment($user_id, $post_id, $comment, $date) {
		$stmt = $this->prepare("INSERT INTO `comments`(`user_id`, `post_id`, `message`, `date`) VALUES (?,?,?,?)");
		$stmt->execute(array($user_id, $post_id, $comment, $date));
		return $stmt->rowCount() > 0;
	}


/*
TODO:
	public function addPost($user_id, $title, $img_id) {

	}
*/
}