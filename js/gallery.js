var heart = document.getElementById('heart');
heart.addEventListener('click', function(){
	var val = heart.classList.contains('fa-heart-o');
	if (val)
	{
		heart.classList.remove('fa-heart-o');
		heart.classList.add('fa-heart');
		heart.style.color='red';
	}
	else {
		heart.classList.add('fa-heart-o');
		heart.style.color='black';
	}
});