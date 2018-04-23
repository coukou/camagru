var __notificationTimeout;
function showNotification(text, opts) {
	opts = Object.assign({time: 1000, bg: '#000', fg: '#fff'}, opts);
	var notif = document.getElementById('header-notification');
	notif.innerText = text;
	notif.style.background = opts.bg;
	notif.style.color = opts.fg;
	notif.classList.add('opened');
	clearTimeout(__notificationTimeout);
	__notificationTimeout = setTimeout(() => { notif.classList.remove('opened')}, opts.time);
}
