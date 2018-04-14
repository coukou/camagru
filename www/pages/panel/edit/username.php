<script src="/resources/js/sign.js"></script>
<form
	id="sign-form"
	location='/api/user_edit.php?action=username'
	success-message="username changed"
	redirect-location="/?panel=account"
	>
	<div id="sign-form-container" class="middle-container">
		<input type="text" name="username" placeholder='new username' />
		<input type="password" name="password" placeholder='password' />
		<input type="submit" class="show-desktop sign-button" value="change username"></a>
	</div>
	<div id="mobile-buttons" class="show-mobile">
		<input type="submit" class="sign-button" value="change username">
	</div>
</form>
