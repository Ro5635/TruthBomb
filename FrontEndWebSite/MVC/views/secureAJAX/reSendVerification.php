<?php
//Handle the request from the user to re-send there verification message
//
//Get an account object:
$accountObj = Account::getAccountFromEmail(  $_SESSION["UserEmail"] );

// STOP ABUSE OF THE SYSTEM BY LIMITING THE NUMBER OF RE-REQUESTS TO 4
//ONLY HELD IN THE SESSION VARIABLE FOR NOW, CLEARLY FLAWED BUT SUITABLE FOR NOW.

if(!isset($_SESSION['NexmoAPICallsLogVerificationCount'])){

  $_SESSION['NexmoAPICallsLogVerificationCount'] = 0;

}else{
  $_SESSION['NexmoAPICallsLogVerificationCount'] = $_SESSION['NexmoAPICallsLogVerificationCount'] + 1;

}

if($_SESSION['NexmoAPICallsLogVerificationCount'] < 5){
  //Request verification text message to be sent
  $url = 'https://api.nexmo.com/verify/json?' . http_build_query([
    'api_key' => Db::getnexmoAPIKey() ,
    'api_secret' => Db::getnexmoSecretKey() ,
    'number' => $accountObj->mobileNumber ,
    'brand' => 'LisIt'
    ]);

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response =  curl_exec($ch);
  error_log("THIS IS THE RESPONSE: .. :" . $response);
  $response = json_decode( $response );

  error_log("Captured req id: " . $response->{'request_id'} );

  //Set a tempary session variable for accesssing the API for the variafication
  $_SESSION['NexmoVerificationID'] = $response->{'request_id'};
  
  //Record transmission of the API request
  $accountObj->setMobileVerificationRequestSentState(1);

}else{

  error_log('The request of a mobile number verification was cancled, to many requests in this session');

}


