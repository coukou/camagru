<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');

$fields = array('email', 'username', 'password-1', 'password-2');
$errors = array();
foreach ($fields as $field) {
	if (!isset($_POST[$field]))
		$errors[] = array('field' => $field, 'message' => 'field is missing');
	if ($_POST[$field] === "")
		$errors[] = array('field' => $field, 'message' => 'field can\'t be empty');
}
if (count($errors) === 0)
{
	$email = htmlspecialchars($_POST['email']);
	$username = htmlspecialchars($_POST['username']);
	$password1 = htmlspecialchars($_POST['password-1']);
	$password2 = htmlspecialchars($_POST['password-2']);

	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		$errors[] = array('field' => 'email', 'message' => 'is not a valid email');
	if (strlen($username) > 16)
		$errors[] = array('field' => 'username', 'message' => 'username can\'t exceed 16 characters');
	if (strlen($username) < 4)
		$errors[] = array('field' => 'username', 'message' => 'username must be atleast 4 characters long');
	if (strlen($password1) < 4)
		$errors[] = array('field' => 'password-1', 'message' => 'password must be atleast 4 characters long');
	if ($password1 !== $password2)
		$errors[] = array('field' => 'password-2', 'message' => 'password doesnt match');
	if (count($errors) === 0)
	{
		$db = new Database();
		if ($db->getUserByEmail($email))
			$errors[] = array('field' => 'email', 'message' => 'email already taken');
		if ($db->getUserByUsername($username))
			$errors[] = array('field' => 'username', 'message' => 'username already taken');
		if (count($errors) === 0)
		{
			$db->addUser($email, $username, $password1);
		}
	}
}
if (count($errors) > 0)
	echo json_encode(array('success' => false, 'errors' => $errors));
else
	echo json_encode(array('success' => true));
