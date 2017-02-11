<?php

echo '<body>';

//include($_SERVER['DOCUMENT_ROOT'].'../PHPIncludes/Views/Menus/StdMenuBar.php');


//Get an account object:
$accountObj = Account::getAccountFromEmail(  $_SESSION["UserEmail"] );

//Has an API request to nexmo al ready been made? (Don't allow the spaming of expensive API requests!)
$mobileVerificationRequestSent = $accountObj->checkMobileVerificationSent();
error_log("TRYING WITH THIS NUM: " . $accountObj->mobileNumber);
if(!$mobileVerificationRequestSent){

  //Request verification text message to be sent
  $url = 'https://api.nexmo.com/verify/json?' . http_build_query([
    'api_key' => Db::getnexmoAPIKey() ,
    'api_secret' => Db::getnexmoSecretKey() ,
    'number' => $accountObj->mobileNumber ,
    'brand' => 'LisIt'
    ]);

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = json_decode( curl_exec($ch) );
  error_log("Captured req id: " . $response->{'request_id'} );

  //Set a tempary session variable for accesssing the API for the variafication
  $_SESSION['NexmoVerificationID'] = $response->{'request_id'};
  
  //Record transmission of the API request
  $accountObj->setMobileVerificationRequestSentState(1);

}else{

  error_log('The request of a mobile number verification was cancled');

}


?>





<div class="container">


  <div id="loginpageSpacer"></div>

  <div class="row">

    <div class="col-xs-1  col-sm-2 col-md-3"></div>

    <div id="formsContent">

      <div id="loginForm" class="loginFormStyle col-xs-10 col-sm-8 col-md-6 col-lg-6 col-xl-6 contentText animated bounceIn">

        <p class=" headingText text-xs-center">Verify Mobile Number</p>

        <p class="text-xs-center ">Please verify your mobile number for use with Lisit.</p>
        <p id="generalFormFeeback" class="text-warning"></p>
        
        <form>
          <div class="form-group">
            <label for="formGroupExampleInput">Verification Code</label>
            <input type="text" class="form-control" placeholder="" id="verificationCode">
          </div>


          <div class="buttonBar"><button type="button" class="btn btn-primary btnSpacer" id="submitBtn">Submit</button><button type="button" class="btn btn-secondary btnSpacer disabled" id="reSendCodeBtn">Re-Send Code</button></div>
        </form>

        <br>

      </div>


    </div>


    <div class="col-xs-1  col-sm-2 col-md-3 "></div>

  </div><!-- end Row -->









  <div class="hidden-md-up" id="loginpageSpacer"></div>



  <div class="row">

    <div class="hidden-sm-down col-md-4"></div>

    <div id="loginPageLogo" class="hidden-sm-down col-md-4">

      <a href="/">
        <img src="/assets/media/LisItLogo.jpeg" class="img-fluid" alt="LisIt Logo">
      </a>

    </div>

    <div class="hidden-sm-down col-md-4"></div>

  </div><!-- end Row -->

</div><!-- Close Container -->
