function resizeText () {
	// All news texts
	var texts = document.getElementsByClassName('news-text');
	
	for (var i = 0; i < texts.length; i++) {
	
		var w = window.innerWidth;
		var size = 17;
		
		if (w < 600) size = 12;
		else if (w < 700) size = 13;
		else if (w < 800) size = 14;
		else if (w < 900) size = 16;
		else size = 17;
		
		texts[i].style.fontSize = size + "px";
		
		
		// max count chars is 788 !!!
	}
}

window.onload = resizeText;
window.onresize = resizeText;