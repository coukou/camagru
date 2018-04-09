<header>
	<div id="header-bar">
		<div id="header-bar-container">
			<div>
				<div id="menu"></div>
				<div class="show-mobile">
					<span id="header-menu-button" class="material-icons" onclick="toggleMenu('menu')">menu</span>
				</div>
			</div>
			<div id="logo" class="text-center">
				<a href="/">
					Camagru
				</a>
			</div>
			<div class="text-right">
				<div id="account-menu">
					<a href="?page=signin">Sign in</a>
					<a onclick="toggleMenu('account-menu');toggleMenu('signup-popup', {r: 255, g: 255, b: 255, o: .5});">Sign up</a>
				</div>
				<div class="show-mobile">
					<span id="header-account-button" class="material-icons" onclick="toggleMenu('account-menu')">account_circle</span>
				</div>
				<?php include("components/signup.php"); ?>
			</div>
		</div>
	</div>
</header>
