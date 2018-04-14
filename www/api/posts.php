<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');

if (isset($_POST['from']))
{
	$db = new Database();
	$posts = $db->getPosts($_POST['from']);
	foreach ($posts as &$post)
	{
		$post['author'] = $db->getUserById($post['user_id'])['username'];
		$post['likes'] =  $db->countPostLikes($post['id']);
		$post['liked'] = isset($_SESSION['user_id']) ? $db->doUserLikePost($_SESSION['user_id'], $post['id']) : false;
	}
	print(json_encode(array('success' => true, 'posts' => $posts)));
}
else
	print(json_encode(array('success' => false)));
