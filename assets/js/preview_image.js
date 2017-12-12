function readURL(input){
	//console.log("2nd function has been called");
	if(input.files && input.files[0]){
		//console.log("if has passed");
		var reader = new FileReader();
		reader.onload = function(event){
			//console.log("3rd function has been called");
			$('#previewHolder').attr('src',event.target.result);
		}
		reader.readAsDataURL(input.files[0]);
		//var fileName = input.files[0].name;
		//console.log('the file name is: '+fileName);
	}
}
$('#file_name').change(function(){
	//console.log("1st function has been called");

	readURL(this);
});