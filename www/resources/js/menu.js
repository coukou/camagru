function toggleMenu(element_id, color = {r: 0, g: 0, b: 0, o: .7}) {
	const element = document.getElementById(element_id);
	if (!element.classList.contains('opened')) {
		const overlay = document.createElement('div');
		overlay.setAttribute('id', 'menu-overlay');
		overlay.style.background = `rgba(${color.r}, ${color.g}, ${color.b}, ${color.o})`;
		element.classList.add('opened');

		document.body.classList.add('stop-scrolling');
		overlay.addEventListener('click', () => {
			toggleMenu(element_id);
		});
		document.body.appendChild(overlay);
	} else {
		const overlay = document.getElementById('menu-overlay');
		element.classList.remove('opened');
		document.body.classList.remove('stop-scrolling');
		document.body.removeChild(overlay);
	}
}
