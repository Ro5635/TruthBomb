//Form JS

$(document).ready(function(){


	$('#subReviewButt').click(function(){

		var siteURL = $('#formWebsite').val();

		var userRating = $('#alignment').val();

		var dataToTransmit = 'siteurl=' + siteURL + '&rating=' + userRating;

		$.ajax({
			url: "/ajax/registervote",
			type: "POST",
			data: dataToTransmit,
			cache: false,
			success: function(reternedData) {

				var recivedJSON = JSON.parse(reternedData);

				
				window.location.href = recivedJSON.redirectTo;
				alert('Current Rating for URL: ' + recivedJSON.CurrentRating );
				window.location.replace("/pages/home");


			}

		});


	});


	$(".alignment .btn").click(function() {
    // whenever a button is clicked, set the hidden helper
    $("#alignment").val($(this).text());
}); 

});