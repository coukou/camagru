<?php $disable_footer = true; ?>
<div class="middle-container">
	<a href="?panel=edit/username" class='button'>Change username</a>
	<a href="?panel=edit/password" class='button'>Change password</a>
	<a href="?panel=edit/email" class='button'>Change email</a>
	<?php if ($_SESSION['notification']) { ?>
	<a onclick="toggleNotification(this)" class='button'>Disable notification</a>
	<?php } else { ?>
	<a onclick="toggleNotification(this)" class='button'>Enable notification</a>
	<?php } ?>
	<a href="?panel=edit/delete" class='button' style="background: red;">Delete account</a>
</div>
