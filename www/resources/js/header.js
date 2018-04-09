window.addEventListener('scroll', () => {
	const headerPinnedY = 40;
	const container = document.querySelector('#header-bar');
	if (window.pageYOffset >= headerPinnedY)
		container.classList.add('pinned');
	if (window.pageYOffset < headerPinnedY)
		container.classList.remove('pinned');
})
