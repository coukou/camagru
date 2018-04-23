<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');
session_start();

if (!isset($_POST['post_id']))
	return print(json_encode(array('success' => false)));
$post_id = $_POST['post_id'];
$db = new Database();
$post = $db->getPostById($post_id);
if ($post)
{
	if ($post['user_id'] === $_SESSION['user_id'])
		return print(json_encode(array('success' => $db->deletePost($post_id))));
}
print(json_encode(array('success' => false)));
