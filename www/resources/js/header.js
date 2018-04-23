window.addEventListener('scroll', () => {
	var headerPinnedY = 40;
	var container = document.querySelector('#header-bar');
	if (window.pageYOffset >= headerPinnedY)
		container.classList.add('pinned');
	if (window.pageYOffset === 0)
		container.classList.remove('pinned');
})
