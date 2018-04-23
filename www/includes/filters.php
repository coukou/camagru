<?php
function getFilters() {
	$filters = [];
	if ($handle = opendir($_SERVER['DOCUMENT_ROOT'] . '/resources/filters/')) {
		while (($entry = readdir($handle)) !== false) {
			if ($entry == '.' || $entry == '..')
				continue ;
			if (preg_match("/\.png$/", $entry))
				$filters[] = $entry;
		}
		closedir($handle);
	}
	return $filters;
}

function getFilterById($id) {
	$filters = getFilters();
	if (isset($filters[$id]))
		return $filters[$id];
	return null;
}
?>
