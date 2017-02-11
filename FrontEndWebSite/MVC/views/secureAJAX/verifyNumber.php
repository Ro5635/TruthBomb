<?php
/**
 *  Handles the verification of the mobile number, is called from the mobile number verification form to request
 *  verification from nexmo as to teh correctness of the given key from the user.
 */

if(($_SERVER['REQUEST_METHOD'] == "POST")){

//Get an account object:
$accountObj = Account::getAccountFromEmail(  $_SESSION["UserEmail"] );

	//Get the pin attempt from the post request
	$pinAttempt = filter_var($_POST['pinAttempt'] , FILTER_SANITIZE_STRING);

	if($pinAttempt == null || $pinAttempt == ''){
		//Invalid data
		echo '';
		die();

	}else{

		//Query the nexmo API
		
		$url = 'https://api.nexmo.com/verify/check/json?' . http_build_query([
			'api_key' => Db::getnexmoAPIKey() ,
			'api_secret' => Db::getnexmoSecretKey() ,
			'request_id' => $_SESSION['NexmoVerificationID'],
			'code' => $pinAttempt
			]);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode( curl_exec($ch) );
		
		$pinValid = 0;

		if($response->{'status'} == 0){
			
			//The given pin resulted in a "pin valid" response
			$pinValid = 1;

			//Update the account to reflect the succesful verification
			 $accountObj->setMobileVerificationState(1);

			
		
		}else{

			//The pin supplied did not get a valid response
			$pinValid = 0;
		
		}

		//$errorText = $response->{'error_text'};

		$jsonArray = array( 'verified' => $pinValid , 'errorText' => $errorText , 'redirectTo' => '/list/it' );

		echo json_encode($jsonArray);

	}






}else{

//This only accepts post requests

header("HTTP/1.1 418 I'm a teapot");

echo '<html><h1>418 I\'m a teapot</h1><br><p>The Server is a teapot. The responding entity MAY be short and stout.</p></html>';

die();

}