// JS Script, handles the login
$(document).ready(function(){



	$('#signInBtn').click(function(){

		var emailAdd = $('#emailAddress').val();

		var password = $('#password').val();

		var dataToTransmit = 'emailAddress=' + emailAdd + '&Password=' + password;

		$.ajax({
			url: "/ajax/login",
			type: "POST",
			data: dataToTransmit,
			cache: false,
			success: function(reternedData) {

				var recivedJSON = JSON.parse(reternedData);

				if( recivedJSON.loggedIn == '1' ){
					window.location.href = recivedJSON.redirectTo;

				}

			}

		});



	});


	$('#createAccountBtn').click(function(){

		//Remove the login form
		$('#loginForm').removeClass('animated');
		$('#loginForm').removeClass('bounceOut');
		$('#loginForm').removeClass('bounceIn');
		$('#loginForm').addClass('animated');
		$('#loginForm').addClass('bounceOut');


		setTimeout(function() {

			//Add the create account form
			$('#accountForm').removeClass('animated');
			$('#accountForm').removeClass('bounceIn');
			$('#accountForm').removeClass('bounceOut');
			$('#accountForm').prependTo('#formsContent');
			$('#accountForm').removeClass('hidden-xs-up');
			$('#accountForm').addClass('animated');
			$('#accountForm').addClass('bounceIn');

		}, 850);

		


	});

	$('#rtnSignInBtn').click(function(){

		//Remove the login form
		$('#accountForm').removeClass('animated');
		$('#accountForm').removeClass('bounceOut');
		$('#accountForm').addClass('animated');
		$('#accountForm').addClass('bounceOut');

		setTimeout(function() {

			//Add the login form back
			$('#loginForm').prependTo('#formsContent');
			$('#loginForm').removeClass('animated');
			$('#loginForm').removeClass('bounceIn');
			$('#loginForm').removeClass('bounceOut');
			$('#loginForm').addClass('animated');
			$('#loginForm').addClass('bounceIn');


		}, 850);

	});


	$('#createAccountFormBTN').click(function(){

		var allFeildsFilledIn = true;					//TO_DO

		var validEmail = validateEmail( $('#emailAddressAc').val() );
		var validMobNum = validateMobNum( $('#mobNumAc').val() );

		if(validMobNum && validEmail && allFeildsFilledIn){

			$('#generalFormFeebackAc').html('');

			var emailAdd = $('#emailAddressAc').val();

			var password = $('#passwordAc').val();

			var fName = $('#fNameAc').val();

			var lName = $('#lNameAc').val();

			var mobNum = $('#mobNumAc').val();

			var dataToTransmit = 'emailAddress=' + emailAdd + '&Password=' + password + '&fname=' + fName + '&lname=' + lName + '&mobNo=' + mobNum;

			$.ajax({
				url: "/ajax/createaccount",
				type: "POST",
				data: dataToTransmit,
				cache: false,
				success: function(reternedData) {

					var recivedJSON = JSON.parse(reternedData);

					if( recivedJSON.AccountCreated == '1' ){
						confirm('Account Created succesfuly');
						window.location.href = recivedJSON.redirectTo;

					}

				}

			});


		}else{

			//Something is not compleated correctly
			$('#generalFormFeebackAc').html('Please ensure that all errors in the form are fixed!');

		}

	});



	$('#emailAddressAc, #emailAddress').blur(function(){
		var validEmail = validateEmail($(this).val());
		
		if(validEmail){

			$('#emailValidationRespAc').html('');	

		}else{

			$('#emailValidationRespAc').html('Somethings odd with your email address!');		

		}

	});


	$('#mobNumAc').blur(function(){

		var validMobNum = validateMobNum($(this).val());

		if(validMobNum){

			$('#mobNumValidationRespAc').html('');

		}else{

			$('#mobNumValidationRespAc').html('Please check your mobile number, it must start with 07');

		}

	});



	//Validate email address
	//From: http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
	function validateEmail(email) {

		var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		return regEx.test(email);

	}

	//Validate (lossley) mobile number
	function validateMobNum(num) {

		var regEx = /^\d*(?:\.\d{1,2})?$/;
		
		if( num.substring(0, 2) != '07'){
		
			return false;
		
		}


		return regEx.test(num);

	}



});