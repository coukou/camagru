<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');

$message = '';
if (isset($_GET['code']) && isset($_GET['email']))
{
	$db = new Database();
	$user = $db->getUserByEmail($_GET['email']);
	$link = $db->getLink($_SERVER['REQUEST_URI']);
	if (!$user)
		$message = 'email address doesn\'t exists.';
		else if (!$link)
		$message = 'invalid activate link.';
	else
	{
		if ($user['activated'] == 1)
			$message = 'account already activated.';
		else if ($link['used'] == 1)
			$message = 'activate link already used.';
		else
		{
			$db->activateUser($_GET['email']);
			$db->useLink($_SERVER['REQUEST_URI']);
			$message = 'account activated.';
		}
	}
}
else
	$message = "invalid params";
?>
<?= $message ?>
