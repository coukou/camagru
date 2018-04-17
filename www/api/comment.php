<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');
require_once('includes/sendmail.php');

if (isset($_SESSION['username']) && isset($_POST['comment']) && isset($_POST['post_id']))
{
	if (strlen(trim($_POST['comment'])) > 0)
	{
		$db = new Database();
		$post = $db->getPostById($_POST['post_id']);
		if ($post)
		{
			$post_author = $db->getUserById($post['user_id']);
			$date = time();
			if ($db->addComment($_SESSION['user_id'], $_POST['post_id'], htmlspecialchars($_POST['comment']), $date))
			{
				if ($_SESSION['notification'])
				{
					sendmail(
						$post_author['email'],
						'someone commented your post',
						sprintf('<a href="http://%s?page=post&id=%s">%s</a> post has been commented by %s', $_SERVER['HTTP_HOST'], $post['id'], $post['title'], $_SESSION['username'])
					);
				}
				return print(json_encode(array('success' => true, 'data' => array(
					'author' => $_SESSION['username'],
					'date' => date("D, d M Y H:i:s", $date),
					'comment' => $_POST['comment']
				))));
			}
		}
	}
}
print(json_encode(array('success' => false)));
