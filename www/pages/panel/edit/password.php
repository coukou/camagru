<script src="/resources/js/sign.js"></script>
<form
	id="sign-form"
	location='/api/user_edit.php?action=password'
	success-message="password changed"
	redirect-location="/?panel=account"
	>
	<div id="sign-form-container" class="middle-container">
		<input type="password" name="password-1" placeholder='new password' />
		<input type="password" name="password-2" placeholder='re-enter new password' />
		<input type="password" name="password" placeholder='password' />
		<input type="submit" class="show-desktop sign-button" value="change password"></a>
	</div>
	<div id="mobile-buttons" class="show-mobile">
		<input type="submit" class="sign-button" value="change password">
	</div>
</form>
