<?php $disable_footer = true; ?>
<script src="/resources/js/sign.js"></script>
<form
	id="sign-form"
	location='/api/user_edit.php?action=delete'
	success-message="account deleted"
	redirect-location="/"
	>
	<div id="sign-form-container" class="middle-container">
		<div style="color: red">WARNING: all your data will be lost. No backward is possible.</div>
		<input type="password" name="password" placeholder='password' />
		<input type="submit" class="show-desktop sign-button" value="delete my account"></a>
	</div>
	<div id="mobile-buttons" class="show-mobile">
		<input type="submit" class="sign-button" value="delete my account">
	</div>
</form>
