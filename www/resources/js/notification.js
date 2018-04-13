function showNotification(text, opts) {
	opts = Object.assign({time: 1000, bg: '#000', fg: '#fff'}, opts);
	const notif = document.getElementById('header-notification');
	notif.innerText = text;
	notif.style.background = opts.bg;
	notif.style.color = opts.fg;
	notif.classList.add('opened');
	setTimeout(() => { notif.classList.remove('opened')}, opts.time);
}
