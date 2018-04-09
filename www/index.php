<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<header>
		<div id="header-bar">
			<div id="header-bar-container">
				<div>
					<span id="header-menu-button" class="material-icons">menu</span>
				</div>
				<div id="logo">Camagru</div>
				<div>
					<span id="header-account-button" class="material-icons">account_circle</span>
				</div>
			</div>
		</div>
	</header>
	<div id="menu">
	</div>
	<div id="card-container">
		<?php for($i = 0; $i < 10; $i++) { ?>
		<div class="card card-img-fake">
			<div class="card-overlay">
				<span class="card-author">Author</span>
				<span class="card-like-button"></span>
				<span class="card-title">Lorem ipsum dolor sit amet</span>
			</div>
		</div>
		<?php } ?>
	</id>
	<footer></footer>
</body>
</html>
