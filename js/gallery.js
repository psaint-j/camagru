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

function likeImg(id){
	var heart = document.getElementById(id);
	var val = heart.classList.contains('fa-heart-o');
  
	if (val) //like
	{
		var xhr = getHttpRequest();
    var post = new FormData();
		post.append('like', 'true');
    post.append('image_id', id);
		xhr.open('POST', 'http://localhost:8080/camagru/like.php', true);
    	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
    	xhr.onreadystatechange = function () {
      	if (xhr.readyState === 4) 
      	{
        	if (xhr.status === 200) 
        	{
        		console.log(xhr.responseText); // contient le résultat de la page
      		} 
      		else 
      		{
        		window.alert("wrong link");
      		}
    	}
  	}
  		xhr.send(post);
		heart.classList.remove('fa-heart-o');
		heart.classList.add('fa-heart');
		heart.style.color='red';
	}
	else { //dislike
     var xhr = getHttpRequest();
     var posty = new FormData();
    posty.append('like', 'false');
    posty.append('image_id', id);
    xhr.open('POST', 'http://localhost:8080/camagru/like.php', true);
      xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) 
        {
          if (xhr.status === 200) 
          {
            console.log(xhr.responseText); // contient le résultat de la page
          } 
          else 
          {
            window.alert("wrong link");
          }
      }
    }
      xhr.send(posty);
		heart.classList.add('fa-heart-o');
		heart.style.color='#9b9b9b';
	}
}