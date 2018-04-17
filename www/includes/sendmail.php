<?php
function sendmail($to, $subject, $body) {
	$headers = "From: Camagru" . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$body = "<html><body>$body</body></html>";
	return mail($to, $subject, $body, $headers);
}
