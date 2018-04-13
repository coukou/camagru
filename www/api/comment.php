<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');

if (isset($_SESSION['username']) && isset($_POST['comment']) && isset($_POST['post_id']))
{
	if (strlen(trim($_POST['comment'])) > 0)
	{
		$db = new Database();
		$date = time();
		if ($db->addComment($_SESSION['user_id'], $_POST['post_id'], htmlspecialchars($_POST['comment']), $date))
		{
			return print(json_encode(array('success' => true, 'data' => array(
				'author' => $_SESSION['username'],
				'date' => date("D, d M Y H:i:s", $date),
				'comment' => $_POST['comment']
			))));
		}
	}
}
print(json_encode(array('success' => false)));
