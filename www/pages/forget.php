<?php
if (isset($_SESSION['username']))
	return include('pages/errors/500.php');
?>
<script src="/resources/js/sign.js"></script>
<form
	id="sign-form"
	location='/api/forget.php'
	success-message="password reset link sent check your mail"
	redirect-location="<?= isset($_GET['redirect']) ? $_GET['redirect'] : '/?page=signin'; ?>"
	>
	<div id="sign-form-container" class="middle-container">
		<input type="text" name="email" placeholder='email' />
		<input type="submit" class="show-desktop sign-button" value="reset password"></a>
	</div>
	<div id="mobile-buttons" class="show-mobile">
		<input type="submit" class="sign-button" value="reset password">
	</div>
</form>
