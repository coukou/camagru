<?php
session_start();
if (!$_SESSION['username'])
	return print(json_encode(array('success' => false)));
session_destroy();
print(json_encode(array('success' => true)));
