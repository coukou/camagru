<?php
session_start();
if (!isset($_SESSION['username']))
	return false;
return true;
