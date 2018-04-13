<?php

function mutiple_isset_check($arr, ...$keys) {
	foreach ($keys as $k) {
		if (!isset($arr[$k]))
			return false;
	}
	return true;
}
