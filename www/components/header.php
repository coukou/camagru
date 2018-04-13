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
				<?php if (!isset($_SESSION['username'])) { ?>
					<a href="?page=signin">Sign in</a>
					<a href="?page=signup">Sign up</a>
				<?php } else { ?>
					<a href="?panel=account">my account</a>
					<a onclick="closeMenu('account-menu');logout()">logout</a>
				<?php } ?>
				</div>
				<div class="show-mobile">
					<span id="header-account-button" class="material-icons" onclick="toggleMenu('account-menu')">account_circle</span>
				</div>
			</div>
		</div>
		<div id="header-notification"></div>
	</div>
</header>
