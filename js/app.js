var home = document.getElementById('btn');

home.addEventListener('mouseover',function(){
	console.log("over here");
	home.style.width="45%";
});

home.addEventListener('mouseout',function(){
	console.log("here");
	home.style.width="30%";
});

