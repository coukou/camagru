<?php
require_once('includes/Database.class.php');
$db = new Database();
if (!isset($_GET['id']) || !($post = $db->getPostById($_GET['id'])))
	return include('pages/errors/404.php');
?>
<div id="card-container" class="container">
	<div id="card-<?= $post['id']; ?>" href="?page=post&id=<?= $post['id']; ?>" class="card" style="background-image: url('<?= '/uploaded_img/'. $post['img_id'] . '.jpg' ?>')">
		<div class="card-overlay">
			<span class="card-author"><?= $db->getUserById($post['user_id'])['username']; ?></span>
			<div class="card-like">
				<span class="card-like-count"><?= $db->countPostLikes($post['id']); ?></span>
				<span onclick="toggleLike(this, <?= $post['id']; ?>)" class="card-like-button <?= $db->doUserLikePost($_SESSION['user_id'], $post['id']) ? 'liked' : ''; ?>"></span>
			</div>
		</div>
	</div>
</div>
<?php if (isset($_SESSION['username'])) { ?>
<?php if ($_SESSION['user_id'] === $post['user_id']) { ?>
<input class='button' type="submit" onclick="deletePost(<?= $post['id']; ?>)" style="background-color: red;" value="Delete post" />
<?php } ?>
<div class="container">
	<form onsubmit="return onCommentSubmit(this, <?= $post['id']; ?>)">
		<textarea name="comment" rows="10" class="comment-input" placeholder="Wow you look so beautiful..."></textarea>
		<input class='button' type="submit" value="Send Comment" />
	</form>
</div>
<?php } else { ?>
<a href="?page=signin&redirect=<?= urlencode($_SERVER['REQUEST_URI']); ?>" class="button">signin to comment this post</a>
<?php } ?>
<div id="comments-container" class="container">
	<?php foreach ($db->getPostComments($_GET['id']) as $comment) { ?>
	<div class="comment">
		<div class="comment-data">
			<div class="comment-author"><?= $db->getUserById($comment['user_id'])['username']; ?></div>
			<div class="comment-message"><?= $comment['message']; ?></div>
			<div class="comment-date"><?= date("D, d M Y H:i:s", $comment['date']); ?></div>
		</div>
	</div>
	<?php } ?>
</div>
