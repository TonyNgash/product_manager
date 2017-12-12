$(document).ready(function(){
	$(window).keydown(function(event){
		if(event.keyCode == 13){
			console.log('enter has been pressed');
			event.preventDefault();
			return false;
		}
	});
});