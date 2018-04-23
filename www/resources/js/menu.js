function closeMenu(element_id) {
	var element = document.getElementById(element_id);
	if (!element.classList.contains('opened'))
		return ;
	var overlay = document.getElementById('menu-overlay');
	element.classList.remove('opened');
	document.body.classList.remove('stop-scrolling');
	element.parentElement.removeChild(overlay);
}

function openMenu(element_id, color = '#0008') {
	var element = document.getElementById(element_id);
	if (element.classList.contains('opened'))
		return ;
	var overlay = document.createElement('div');
	overlay.setAttribute('id', 'menu-overlay');
	overlay.style.background = color;
	element.classList.add('opened');
	document.body.classList.add('stop-scrolling');
	overlay.addEventListener('click', () => {
		closeMenu(element_id);
	});
	element.parentElement.prepend(overlay);
}

function toggleMenu(element_id, color) {
	var element = document.getElementById(element_id);
	if (!element.classList.contains('opened')) {
		openMenu(element_id, color);
	} else {
		closeMenu(element_id);
	}
}
