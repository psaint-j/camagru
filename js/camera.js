(function() {

  var streaming = false,
  video        = document.querySelector('#video'),
  cover        = document.querySelector('#cover'),
  canvas       = document.querySelector('#canvas'),
  photo        = document.querySelector('#photo'),
  startbutton  = document.querySelector('#startbutton'),
  fileInput    = document.getElementById('file'),
  upload    = document.getElementById('upload'),
  width = 601,
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

  function loadImage(src) {
    var img = new Image();
    
    img.onload = onload = function(){};
    img.src = src;

    return img;
  }

  var getHttpRequest = function () {
    var httpRequest = false;

  if (window.XMLHttpRequest) { // Mozilla, Safari,...
    httpRequest = new XMLHttpRequest();
    if (httpRequest.overrideMimeType) {
      httpRequest.overrideMimeType('text/xml');
    }
  }
  else if (window.ActiveXObject) { // IE
    try {
      httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e) {
      try {
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e) {}
    }
  }

  if (!httpRequest) {
    alert('Abandon :( Impossible de créer une instance XMLHTTP');
    return false;
  }

  return httpRequest
}

upload.addEventListener('click', function()
{
  var reader = new FileReader();
  reader.addEventListener('load', function() {
  console.log(reader.result);
  });
  reader.readAsDataURL(fileInput.files[0]);
});


var file = reader.result;
function takePicture() {
  var img = witchOne();
  if (img)
  {
    var ctx = canvas.getContext('2d');
    var file = imgToUpload();
    if (file)
    {
      ctx.drawImage(file, 0, 0);
    }
    else
    {
      //ctx.drawImage(video, 0, 0);
    }
    ctx.globalAlpha = 1;
    ctx.drawImage(img, 0,50);
    var data = canvas.toDataURL('image/png');
    canvas.setAttribute('src', data);
    var xhr = getHttpRequest()
    var post = new FormData()
    post.append('img', data);
    xhr.open('POST', 'http://localhost:8080/camagru/layer.php', true);
    xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
        //console.log(xhr.responseText);  //contient le résultat de la page
      } else {
        console.log("Error Header !?");
      }
    }
  }
  xhr.send(post);
  location.reload();
}
else
  window.alert("Vous devez obligatoirement choisir une image !")
}

function witchOne()
{
  var check1 = document.getElementById('cbox1');
  var check2 = document.getElementById('cbox2');
  var check3 = document.getElementById('cbox3');
  var check4 = document.getElementById('cbox4');

  if (check1.checked)
  {
    var img = loadImage('img/img1.png');
  }
  if (check2.checked)
  {
    var img = loadImage('img/img2.png');
  }
  if (check3.checked)
  {
    var img = loadImage('img/img4.png');
  }
  if (check4.checked)
  {
    var img = loadImage('img/img3.png');
  }
  return img
}

startbutton.addEventListener('click', function(ev){
  takePicture();
  ev.preventDefault();
}, false);


})();