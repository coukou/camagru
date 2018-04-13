let loadMoreFrom = 6;

function createPost(data) {
	const post = document.createElement('a');
	post.id = `card-${data.id}`;
	post.className = 'card';
	post.href = `?page=post&id=${data.id}`;
	post.style.backgroundImage = `url('/uploaded_img/${data.img_id}.jpg')`;
	post.innerHTML = `
	<div class="card-overlay">
		<span class="card-author">${data.author}</span>
		<div class="card-like">
			<span class="card-like-count">${data.likes}</span>
			<span class="card-like-button ${data.liked ? 'liked' : ''}"></span>
		</div>
		<span class="card-title">${data.title}</span>
	</div>
	`;
	return post;
}

function loadPosts(button) {
	const data = new FormData();
	const cardsContainer = document.getElementById('card-container');
	data.append('from', loadMoreFrom);
	const req = new XMLHttpRequest();
	req.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200) {
				let response = JSON.parse(this.responseText);
				if (response.success === false)
					document.removeChild(button);
				else {
					response.posts.forEach((post) => {
						cardsContainer.appendChild(createPost(post));
					});
					loadMoreFrom += response.posts.length;
					if (response.posts.length < 5)
						button.parentNode.removeChild(button);
				}
			}
		}
	};
	req.open('POST', '/api/posts.php', true);
	req.send(data);
}
