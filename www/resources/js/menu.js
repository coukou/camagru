window.addEventListener('load', () => {
	const button = document.getElementById('header-menu-button');
	const closeButton = document.getElementById('menu-close-button');
	const menu = document.getElementById('menu');

	function menuClose(e) {
		if (e.target !== menu) {
			menu.classList.remove('opened');
			document.body.classList.remove('stop-scrolling');
			document.body.removeEventListener('click', menuClose);
		}
	}

	button.addEventListener('click', () => {
		menu.classList.add('opened');
		document.body.classList.add('stop-scrolling');
		setTimeout(() => {
			document.body.addEventListener('click', menuClose);
		}, 0)
	})
})
