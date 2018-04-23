function toggleLike(elem, post_id) {
	var data = new FormData();
	data.append('post_id', post_id);
	if (elem.classList.contains('liked'))
		data.append('action', 'unlike');
	else
		data.append('action', 'like');
	var req = new XMLHttpRequest();
	req.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200) {
				var response = JSON.parse(this.responseText);
				if (response.success)
				{
					elem.classList.toggle('liked');
					if (elem.classList.contains('liked'))
						elem.parentElement.querySelector('.card-like-count').innerText++;
					else
						elem.parentElement.querySelector('.card-like-count').innerText--;
				}
			}
		}
	};
	req.open('POST', '/api/like.php', true);
	req.send(data);
}
