//Account Verification Page JS Script
$(document).ready(function(){

	
	setTimeout(function() {
		
		$('#reSendCodeBtn').removeClass('disabled');
		$('#reSendCodeBtn').removeClass('animated');
		$('#reSendCodeBtn').removeClass('jello');
		$('#reSendCodeBtn').addClass('animated');
		$('#reSendCodeBtn').addClass('jello');
	
	}, 7000);

	$('#reSendCodeBtn').click(function(){


		$.ajax({
			url: "/secureajax/resendmobileverification",
			type: "POST",
			data: '',
			cache: false,
			success: function(reternedData) {

				var recivedJSON = JSON.parse(reternedData);

				if( recivedJSON.reSent == '1' ){
					
					
					$('#generalFormFeeback').html('Verification Re-sent, you should have recived the message on your phone');
					

				}

			}

		});


		$('#reSendCodeBtn').removeClass('animated');
		$('#reSendCodeBtn').removeClass('jello');
		$('#reSendCodeBtn').addClass('disabled');

		setTimeout(function() {
		
			$('#reSendCodeBtn').removeClass('disabled');
			$('#reSendCodeBtn').removeClass('animated');
			$('#reSendCodeBtn').removeClass('jello');
			$('#reSendCodeBtn').addClass('animated');
			$('#reSendCodeBtn').addClass('jello');
		
		}, 10000);

	});


	$('#submitBtn').click(function(){

		var pin = $('#verificationCode').val();

		var dataToTransmit = 'pinAttempt=' + pin;

		$.ajax({
			url: "/secureajax/verifymobile",
			type: "POST",
			data: dataToTransmit,
			cache: false,
			success: function(reternedData) {

				var recivedJSON = JSON.parse(reternedData);

				if( recivedJSON.verified == '1' ){
					
					window.location.href = recivedJSON.redirectTo;
					$('#generalFormFeeback').html('');
					

				}else{

					$('#generalFormFeeback').html('Pin Not Valid');

				}

			}

		});



	});





});
