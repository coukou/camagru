function createComment(data) {
	const comment = document.createElement('div');
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
	const message = form.querySelector('textarea[name=comment]').value;
	const commentsContainer = document.getElementById('comments-container');
	const data = new FormData();
	data.append('post_id', post_id);
	data.append('comment', message);
	const req = new XMLHttpRequest();
	req.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200) {
				const response = JSON.parse(this.responseText);
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
