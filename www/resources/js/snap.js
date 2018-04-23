function drawFilterImg(ctx) {
	var filterImg = document.getElementById("filter-img");
	var top = (ctx.canvas.height - filterImg.height / 2) / 2;
	var left = (ctx.canvas.width - filterImg.width / 2) / 2;
	var height = filterImg.height / 2;
	var width = filterImg.width / 2;
	ctx.drawImage(filterImg, left, top, width, height);
}

function setFilter(filter, id) {
	var res = /url\(\"(.+?)\"\)/.exec(filter.style.backgroundImage);
	var filterImg = document.getElementById('filter-img');
	filterImg.src = res[1];
	filterImg.setAttribute('filter-id', id);
	document.getElementById("snap").classList.remove('disabled');
	context = document.getElementById('preview').getContext('2d');
	var height = 3 * context.canvas.height / 4;
	context.drawImage(document.getElementById('uploaded-img'), 0, (context.canvas.height - height) / 2, context.canvas.width, height);
	drawFilterImg(context);
}

function drawPreviewImg(event) {
	var preview = document.getElementById('preview');
	var ctx = preview.getContext('2d');
	var input = event.target;
    var reader = new FileReader();
    reader.onload = function() {
        var dataURL = reader.result;
        var image = document.getElementById('uploaded-img');
        image.src = dataURL;
        image.onload = function() {
			var height = 3 * preview.height / 4;
			ctx.drawImage(image, 0, (preview.height - height) / 2, preview.width, height);
			drawFilterImg(ctx);
        }
    }
    reader.readAsDataURL(input.files[0]);
}

(() => {
	var preview = document.getElementById('preview');
	var image = document.createElement('canvas');
	var previewContext = preview.getContext('2d');
	var imageContext = image.getContext('2d');
	var video = document.createElement('video');
	var webcamEnabled = false;

	preview.width = window.innerWidth;
	preview.height = 3 * window.innerWidth / 4;

	image.width = window.innerWidth;
	image.height = 3 * window.innerWidth / 4;

	if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
		navigator.mediaDevices.getUserMedia({ video: true })
		.then((stream) => {
			video.src = window.URL.createObjectURL(stream);
			video.play();
			webcamEnabled = true;
			setInterval(() => {
				var height = 3 * preview.height / 4;
				previewContext.drawImage(video, 0, (preview.height - height) / 2, preview.width, height);
				drawFilterImg(previewContext);
			}, 1000 / 30);
		})
		.catch(() => {
			document.getElementById('upload-img').style.display = 'initial';
		})
	}

	document.getElementById("snap").addEventListener("click", function() {
		var filterId = document.getElementById("filter-img").getAttribute('filter-id');
		if (!filterId)
			return;
		if (webcamEnabled)
			imageContext.drawImage(video, 0, 0, image.width, image.height);
		else
			imageContext.drawImage(document.getElementById('uploaded-img'), 0, 0, image.width, image.height);
		var req = new XMLHttpRequest();
		req.onreadystatechange = function(event) {
			if (this.readyState === XMLHttpRequest.DONE) {
				if (this.status === 200) {
					var response = JSON.parse(this.response);
					if (response.success) {
						var uploadElem = document.createElement('a');
						uploadElem.classList.add('upload-card');
						uploadElem.style.backgroundImage = `url('/uploaded_img/${response.imgId}.jpg')`;
						uploadElem.href = `?page=post&id=${response.postId}`;
						document.getElementById('uploads-container').append(uploadElem);
					}
				}
			}
		};
		req.open('POST', '/api/upload.php', true);
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		req.send(`filter_id=${filterId}&img_data=${imageContext.canvas.toDataURL('image/jpg')}`);
	});

})();
