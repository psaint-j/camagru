(function() {

  var streaming = false,
  video        = document.querySelector('#video'),
  cover        = document.querySelector('#cover'),
  canvas       = document.querySelector('#canvas'),
  photo        = document.querySelector('#photo'),
  startbutton  = document.querySelector('#startbutton'),
  width = 560,
  height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
   navigator.webkitGetUserMedia ||
   navigator.mozGetUserMedia ||
   navigator.msGetUserMedia);

  navigator.getMedia(
  {
    video: true,
    audio: false
  },
  function(stream) {
    if (navigator.mozGetUserMedia) {
      video.mozSrcObject = stream;
    } else {
      var vendorURL = window.URL || window.webkitURL;
      video.src = vendorURL.createObjectURL(stream);
    }
    video.play();
  },
  function(err) {
    console.log("An error occured! " + err);
  }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function loadImage(src, onload) {
    var img = new Image();
    
    img.onload = onload;
    img.src = src;

    return img;
}
  
  function takePicture() {
    // canvas.width = width;
    // canvas.height = height;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0);
    ctx.globalAlpha = 1;
    ctx.drawImage(img, 80,0);
    var data = canvas.toDataURL('image/png');
    canvas.setAttribute('src', data);
  }
  var img = loadImage('img/dog.png', takePicture);
  startbutton.addEventListener('click', function(ev){
    takePicture();
    ev.preventDefault();
  }, false);


})();