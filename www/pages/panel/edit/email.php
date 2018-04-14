<script src="/resources/js/sign.js"></script>
<form
	id="sign-form"
	location='/api/user_edit.php?action=email'
	success-message="email changed"
	redirect-location="/?panel=account"
	>
	<div id="sign-form-container" class="middle-container">
		<input type="text" name="email" placeholder='new email' />
		<input type="password" name="password" placeholder='password' />
		<input type="submit" class="show-desktop sign-button" value="change email"></a>
	</div>
	<div id="mobile-buttons" class="show-mobile">
		<input type="submit" class="sign-button" value="change email">
	</div>
</form>
