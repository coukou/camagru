function logout() {
	const req = new XMLHttpRequest();
	req.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200) {
				let response = JSON.parse(this.responseText);
				if (response.success === false)
					showNotification('unable to logout', {time: 2500, bg: 'red'})
				else
				{
					showNotification('successfuly logged out, page will reload in 3 seconds', {time: 2500, bg: 'green'})
					setTimeout(() => document.location.reload(), 3000);
				}
			}
		}
	};
	req.open('GET', '/api/logout.php', true);
	req.send();
}
