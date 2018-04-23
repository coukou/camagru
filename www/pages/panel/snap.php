<?php
require_once('includes/Database.class.php');
require_once('includes/filters.php');
$db = new Database();
$uploads = $db->getUserPosts($_SESSION['user_id']);
?>
<div class="snap-container">
	<div class="container">
		<img id="filter-img" style="display: none;" />
		<img id="uploaded-img" style="display: none;" />
		<canvas id="preview" class="card"></canvas>
		<input id="upload-img" style="display: none;" type='file' accept='image/*' onchange='drawPreviewImg(event)'>
		<input id="snap" class='button disabled' type="submit" value="SNAP" />
		<span style="text-align: center;margin-top:10px;">Filters</span>
		<div id="filters-container">
		<?php foreach (getFilters() as $id => $filter) { ?>
			<a onclick="setFilter(this, <?= $id ?>)" class="filter-card" style="background-image: url('/resources/filters/<?= $filter ?>')"></a>
		<?php } ?>
		</div>
		<div class="separator"></div>
	</div>
	<div id="uploads-container">
		<?php foreach($uploads as $upload) { ?>
		<a href="?page=post&id=<?= $upload['id']; ?>" class="upload-card" style="background-image: url('<?= '/uploaded_img/'. $upload['img_id'] . '.jpg' ?>')"></a>
		<?php } ?>
	</div>
</div>
<script src="/resources/js/snap.js"></script>
