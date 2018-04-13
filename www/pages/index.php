<?php
require_once('includes/Database.class.php');
$db = new Database();
$posts = $db->getPosts();
?>
<div id="card-container" class="container">
	<?php foreach($posts as $post) { ?>
	<a id="card-<?= $post['id']; ?>" href="?page=post&id=<?= $post['id']; ?>" class="card" style="background-image: url('<?= '/uploaded_img/'. $post['img_id'] . '.jpg' ?>')">
		<div class="card-overlay">
			<span class="card-author"><?= $db->getUserById($post['user_id'])['username']; ?></span>
			<div class="card-like">
				<span class="card-like-count"><?= $db->countPostLikes($post['id']); ?></span>
				<span class="card-like-button <?= $db->doUserLikePost($_SESSION['user_id'], $post['id']) ? 'liked' : ''; ?>"></span>
			</div>
			<span class="card-title"><?= $post['title']; ?></span>
		</div>
	</a>
	<?php } ?>
</div>
<a id="load-more-button" class='button' onclick="loadPosts(this)">Load More</a>
