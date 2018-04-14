<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');
require_once('includes/sendmail.php');
session_start();

if (isset($_SESSION['username']))
	return print(json_encode(array('success' => false)));
$fields = array('email');
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
	$db = new Database();
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		$errors[] = array('field' => "email", 'message' => "invalid email address");
	else if(!($user = $db->getUserByEmail($email)))
		$errors[] = array('field' => "email", 'message' => "email address doesn't exists");
	if (count($errors) === 0)
	{
		$new_pass = uniqid("dont_forget_this_one");
		$db->changeUserPassword($user['id'], $new_pass);
		sendmail($email, "reset password", "your new password: $new_pass");
		return print(json_encode(array('success' => true)));
	}
}
print(json_encode(array('success' => false, 'errors' => $errors)));
