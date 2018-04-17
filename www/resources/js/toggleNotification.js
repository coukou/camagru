function toggleNotification(elem) {
	const data = new FormData();
	const req = new XMLHttpRequest();
	req.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200) {
				const response = JSON.parse(this.responseText);
				if (response.success) {
					showNotification(
						`Notification ${response.enabled ? 'enabled' : 'disabled'}`, {
							time: 2500,
							bg: 'green'
						}
					);
					elem.innerText = elem.innerText.replace(/enable|disable/i, response.enabled ? 'Disable' : 'Enable');
				}
			}
		}
	};
	req.open('POST', '/api/user_edit.php?action=notification', true);
	req.send(data);
}
