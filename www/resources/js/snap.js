var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');


canvas.width = window.innerWidth;
canvas.height = 3 * window.innerWidth / 4;

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
		video.src = window.URL.createObjectURL(stream);
		video.play();
	});
}

document.getElementById("snap").addEventListener("click", function() {
	const height = 3 * canvas.height / 4;
	context.drawImage(video, 0, (canvas.height - height) / 2, canvas.width, height);
});
