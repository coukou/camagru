<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');
session_start();

if (isset($_SESSION['username']))
	return print(json_encode(array('success' => false)));
$fields = array('email', 'password');
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
	$password = hash('sha256', htmlspecialchars($_POST['password']));
	$db = new Database();
	if (filter_var($email, FILTER_VALIDATE_EMAIL))
	$user = $db->getUserByEmail($email);
	else
	$user = $db->getUserByUsername($email);
	if ($user == null)
	$errors[] = array('field' => 'email', 'message' => 'invalid email / username');
	if (count($errors) === 0)
	{
		if ($password !== $user['password'])
		$errors[] = array('field' => 'password', 'message' => 'password is invalid');
	}
}
if (count($errors) > 0)
	echo json_encode(array('success' => false, 'errors' => $errors));
else
{

	$_SESSION['user_id'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['email'] = $user['email'];
	echo json_encode(array('success' => true));
}
