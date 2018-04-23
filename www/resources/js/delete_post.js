function deletePost(post_id) {
	if (!confirm("WARNING: this action can't be undo"))
		return ;
	var data = new FormData();
	data.append('post_id', post_id);
	var req = new XMLHttpRequest();
	req.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200) {
				var response = JSON.parse(this.responseText);
				if (response.success) {
					window.location = '/';
				}
			}
		}
	};
	req.open('POST', '/api/delete_post.php', true);
	req.send(data);
}
