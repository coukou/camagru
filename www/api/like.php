<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['post_id']) || !isset($_POST['action']))
	return print(json_encode(array('success' => false)));

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$action = $_POST['action'];

$db = new Database();

if ($action === 'like')
	return print(json_encode(array('success' => $db->likePost($user_id, $post_id))));

if ($action === 'unlike')
	return print(json_encode(array('success' => $db->unlikePost($user_id, $post_id))));

print(json_encode(array('success' => false)));
