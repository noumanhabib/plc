var a = document.getElementById('sf');
function show_hide(){	
	if(a.classList == 'hidden'){
		a.classList.remove('hidden');
		a.classList.add('show');
	}
	else{
		a.classList.remove('show');
		a.classList.add('hidden');
	}	
}

var x = document.getElementById('rf');
function toggleClass(){
	if(x.classList == 'hidden'){
		x.classList.remove('hidden');
		x.classList.add('show');
	}
	else{
		x.classList.remove('show');
		x.classList.add('hidden');
	}
}