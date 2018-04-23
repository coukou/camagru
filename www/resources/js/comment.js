function createComment(data) {
	var comment = document.createElement('div');
	comment.className = 'comment';
	comment.innerHTML = `
	<div class="comment-data">
		<div class="comment-author">${data.author}</div>
		<div class="comment-message">${data.comment}</div>
		<div class="comment-date">${data.date}</div>
	</div>
	`;
	return comment;
}

function onCommentSubmit(form, post_id) {
	var message = form.querySelector('textarea[name=comment]').value;
	var commentsContainer = document.getElementById('comments-container');
	var data = new FormData();
	data.append('post_id', post_id);
	data.append('comment', message);
	var req = new XMLHttpRequest();
	req.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200) {
				var response = JSON.parse(this.responseText);
				if (response.success) {
					commentsContainer.prepend(createComment(response.data));
					form.querySelector('textarea[name=comment]').value = "";
				}
			}
		}
	};
	req.open('POST', '/api/comment.php', true);
	req.send(data);
	return false;
}
