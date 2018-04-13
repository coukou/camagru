<?php
if (isset($_SESSION['username']))
	return include('pages/errors/500.php');
?>
<script src="/resources/js/sign.js"></script>
<form
	id="sign-form"
	location='/api/signin.php'
	success-message="successfuly authed"
	redirect-location="<?= isset($_GET['redirect']) ? $_GET['redirect'] : '/'; ?>"
	>
	<div id="sign-form-container">
		<input type="text" name="email" placeholder='email or username' />
		<input type="password" name="password" placeholder='password' />
		<input type="submit" class="show-desktop sign-button" value="sign-in"></a>
	</div>
	<div id="mobile-buttons" class="show-mobile">
		<input type="submit" class="sign-button" value="sign-in">
	</div>
</form>
