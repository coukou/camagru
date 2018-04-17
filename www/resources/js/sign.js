function createErrorElement(error) {
	const e = document.createElement('span');
	e.innerText = error.message;
	e.id = `${error.field}-error`;
	e.classList.add('field-error');
	return e;
}
window.addEventListener('load', () => {
	document.getElementById('sign-form').addEventListener('submit', function (e) {
		e.preventDefault();
		const form = document.getElementById('sign-form-container');
		const data = new FormData();
		form.childNodes.forEach((c) => {
			if (c.tagName === 'SPAN')
				form.removeChild(c);
		});
		form.childNodes.forEach((c) => {
			if (c.type === 'submit')
				return;
			if (c.tagName === 'SPAN')
				c.style = undefined;
			data.append(c.name, c.value);
		})
		const req = new XMLHttpRequest();
		req.onreadystatechange = function(event) {
			if (this.readyState === XMLHttpRequest.DONE) {
				if (this.status === 200) {
					const response = JSON.parse(this.responseText);
					if (response.success === false) {
						response.errors.forEach((error) => {
							const field = document.body.querySelector(`input[name=${error.field}]`);
							field.style.borderColor = 'red';
							field.parentElement.insertBefore(createErrorElement(error), field);
						})
					}
					else
					{
						const successMsg = e.target.getAttribute('success-message');
						const redirectLocation = e.target.getAttribute('redirect-location')
						showNotification(
							`${successMsg} / you will be redirected in 3 seconds`, {
								time: 2500,
								bg: 'green'
							}
						);
						setTimeout(() => document.location = redirectLocation, 3000);
					}
				}
			}
		};
		req.open('POST', e.target.getAttribute('location'), true);
		req.send(data);
	})
})
