<?php
$filename = "index.php";
if (isset($_GET['page'])) {
	$page = htmlspecialchars($_GET['page']);
	if ($page !== "")
		$filename = "$page.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Camagru</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="/resources/css/main.css">
	<link rel="manifest" href="/manifest.json">
	<script src="/resources/js/header.js"></script>
	<script src="/resources/js/menu.js"></script>
</head>
<body>
	<?php include("components/header.php"); ?>
	<?php
		if (!file_exists("pages/$filename"))
			include("pages/errors/404.php");
		else
			include("pages/$filename");
	?>
	<?php include("components/footer.php"); ?>
</body>
</html>
