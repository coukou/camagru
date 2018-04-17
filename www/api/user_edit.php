<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');
require_once('includes/sendmail.php');
session_start();

if (!isset($_SESSION['username']) || !isset($_GET['action']))
	return print(json_encode(array('success' => false)));
if ($_GET['action'] == 'username')
	$fields = array('username', 'password');
if ($_GET['action'] == 'password')
	$fields = array('password', 'password-1', 'password-2');
if ($_GET['action'] == 'email')
	$fields = array('email', 'password');
if ($_GET['action'] == 'delete')
	$fields = array('password');
if ($_GET['action'] == 'notification')
	$fields = array();
$errors = array();
foreach ($fields as $field) {
	if (!isset($_POST[$field]))
	$errors[] = array('field' => $field, 'message' => 'field is missing');
	if ($_POST[$field] === "")
	$errors[] = array('field' => $field, 'message' => 'field can\'t be empty');
}
if (count($errors) === 0)
{
	$db = new Database();
	if (array_key_exists('password', $fields))
	{
		$password = hash('sha256', $_POST['password']);
		if ($db->getUserById($_SESSION['user_id'])['password'] !== $password)
			$errors[] = array('field' => 'password', 'message' => 'invalid password');
	}
	if (count($errors) === 0)
	{
		if ($_GET['action'] == 'username')
		{
			$username = htmlspecialchars($_POST['username']);
			if (!$db->getUserByUsername($username))
			{
				$_SESSION['username'] = $username;
				$db->changeUserUsername($_SESSION['user_id'], $username);
				return print(json_encode(array('success' => true)));
			}
			else
				$errors[] = array('field' => 'username', 'message' => 'username already taken');
		}
		if ($_GET['action'] == 'email')
		{
			$email = htmlspecialchars($_POST['email']);
			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				if (!$db->getUserByEmail($email))
				{
					$_SESSION['email'] = $email;
					$db->changeUserEmail($_SESSION['user_id'], $email);
					return print(json_encode(array('success' => true)));
				}
				else
					$errors[] = array('field' => 'email', 'message' => 'email already taken');
			}
			else
				$errors[] = array('field' => 'email', 'message' => 'is not a valid email');
		}
		if ($_GET['action'] == 'password')
		{
			if ($_POST['password-1'] === $_POST['password-2'])
			{
				$password = htmlspecialchars($_POST['password-1']);
				$db->changeUserPassword($_SESSION['user_id'], $password);
				return print(json_encode(array('success' => true)));
			}
			else
			$errors[] = array('field' => 'password-2', 'message' => 'password doesn\'t match');
		}
		if ($_GET['action'] == 'delete')
		{
			if ($db->deleteUser($_SESSION['user_id']))
			{
				session_destroy();
				return print(json_encode(array('success' => true)));
			}
		}
		if ($_GET['action'] == 'notification')
		{
			$value = $_SESSION['notification'] ? 0 : 1;
			if ($db->updateUserNotification($_SESSION['user_id'], $value))
			{
				$_SESSION['notification'] = $value;
				return print(json_encode(array('success' => true, 'enabled' => $value)));
			}
		}
	}
}
print(json_encode(array('success' => false, 'errors' => $errors)));
