$(document).ready(function() {

	console.log("update_asynchrounously is running");
	$("#update").click(function(e){
		console.log("update button has been pressed");
		e.preventDefault();
		var prod_name = $('#prod_name').val();
		var prod_price = $('#prod_price').val();
		var prod_desc = $('#prod_desc').val();
		$('#showloading').append("<div class='loading'>Loading&#8230;</div>");

		$.ajax({
			type:"POST",
			url: "Update",
			data: {prod_name: prod_name,prod_price: prod_price,prod_desc: prod_desc},
			success: function(response){
				console.log("async send was successfull");
				var res = response.result;
				console.log(res);
				$('#showloading').empty();
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log(xhr.responseText);
				console.log(textStatus);
				console.log(errorThrown);
				$('#showloading').empty();
			}
		});
	});

});