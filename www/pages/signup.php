<?php
if (isset($_SESSION['username']))
	return include('pages/errors/500.php');
?>
<script src="/resources/js/sign.js"></script>
<form
	id="sign-form"
	location='/api/signup.php'
	success-message="account successfuly created"
	redirect-location="?page=signin"
	>
	<div id="sign-form-container" class="middle-container">
		<input type="text" name="email" placeholder='email' />
		<input type="text" name="username" placeholder='username' />
		<input type="password" name="password-1" placeholder='password'/>
		<input type="password" name="password-2" placeholder='re-password'/>
		<input type="submit" class="show-desktop sign-button"></a>
	</div>
	<div id="mobile-buttons" class="show-mobile">
		<input type="submit" class="sign-button" value="create account">
	</div>
</form>
