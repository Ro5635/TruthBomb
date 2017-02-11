<?php

//Function to clear out all session data and the local cookie
function clearAndStartSession(){

	session_unset();   // Remove the $_SESSION variable information.
	session_destroy(); // Remove the server-side session information.

	// Unset the cookie on the client-side.
	setcookie("PHPSESSID", "", 1); // Expire the PHP sessID cookie.

	setcookie("UserSessionID", "", time()); //Expire additional sessionID cookie

	// Start a new session
	session_start();

	// Generate a new session ID
	session_regenerate_id(true);

	// You have a completely empty, new session.

}

/**
 * Redirects the user to the appropiate location
 * @param  [type] $loginObject [description]
 * @return [type]              [description]
 */
function directUserOn($loginObject, $redirectTo){									//This will need to be refactored to clean up at a later point

	//Get an account object:
	$accountObj = Account::getAccountFromEmail(  $loginObject->emailAddress );

	$isMobileVerified = $accountObj->checkMobileNumberVerified();

	if(!$isMobileVerified){
		//re-direct user to mobile verification
		$redirectTo = '/account/verify';		

	}


	$loggedIn = array( 'loggedIn' =>'1' , 'redirectTo' => $redirectTo );

	echo json_encode($loggedIn);
	error_log(json_encode($loggedIn));
	die();

}

if(($_SERVER['REQUEST_METHOD'] == "POST")){

	//Handle the redirect location now, it will outherwise be cleared out in the login
	$redirectTo = '/';	//Default home

	//If there is a page defined to be sent back to respond accordinly
	if(isset($_SESSION['bouncedToLoginFrom'])){
		if($_SESSION['bouncedToLoginFrom'] != ''){
			$redirectTo = $_SESSION['bouncedToLoginFrom'];
			unset($_SESSION['bouncedToLoginFrom']);
		}
	}


	if( $_POST['Password'] != '' && $_POST['emailAddress'] != '') {

		//Use the correct signature for the avalible data
		if(!isset($_POST['g-recaptcha-response'])){
			//Not Set
			$LoginAttempt = new Login($_POST['emailAddress'] , $_POST['Password']);

		}else{
			$LoginAttempt = new Login($_POST['emailAddress'] , $_POST['Password'], $_POST['g-recaptcha-response']);
		}

		
		if($LoginAttempt->authenticated == true){

			//Combat session fixation
			clearAndStartSession();

			//Generate a secure ID $PsudoRandID
			$psudoRandID = openssl_random_pseudo_bytes(50, $cstrong);

			//session_start();
			$_SESSION["UserName"] = $LoginAttempt->firstName;
			$_SESSION["UserType"] = $LoginAttempt->Type;
			$_SESSION["UserEmail"] = $LoginAttempt->emailAddress;
			$_SESSION["UserSessionID"] = $psudoRandID;
			$_SESSION['UserID'] = $LoginAttempt->userID;

			//The UserSessionID is used as an addditionaly unique session tracker, paranoia really.
			setcookie("UserSessionID", $_SESSION["UserSessionID"], time()+7200, '/'); //Expire in two hours.

			//Save a hash of the useragent:
			$_SESSION['HashedUsrAgent'] = md5($_SERVER['HTTP_USER_AGENT']);

			//direct teh user onwards as needed:
			directUserOn($LoginAttempt, $redirectTo);

			///FALL BACK:

			header( 'Location: //' . $_SERVER['HTTP_HOST'] . '/'   ) ;
			die();

		}

	}

		//If the user has not been redirected then login failed
		//Clear out the session
	clearAndStartSession();

	//Set the redirect location once more
	$_SESSION['bouncedToLoginFrom'] = $redirectTo;

	//Set the error message:

	if(!isset($_POST['Password']) || $_POST['Password'] == ''){
		$errorMessage[] = "Please provide a password!"; 
	}

	if(!isset($_POST['emailAddress']) || $_POST['emailAddress'] == ''){
		$errorMessage[] = "Please provide a Email Address";
	}


		//Will need to implement a new way for this nofification...
		// if(!isset($_POST['g-recaptcha-response']) || $_POST['g-recaptcha-response'] == ''){
		// 	$errorMessage[] = "Please compleate the google recaptcha!";
		// }

		//If there is no error message set one:
	if(!isset($errorMessage)){
		//Set the error message:
		$errorMessage[] = "Login Failure, try again";	
	}

		//Return teh error messages
	echo json_encode($errorMessage);

}else{

	//Not a post request
	echo 'Pototos';
	die();

}





	//Some legacy junk saved fora  few mins more:

	// echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
	// echo '<body>';
	// echo '<section id="FeaturedContentSection">';
	// echo '<div class="Spacer"></div>';
	// echo '<article>';
	// echo '<div id="loginBox"><span id="LoginFormTitle">Login:</span>';

	// if(isset($errorMessage)){
	// 	echo '<ul class="errorText animated shake">';

	// 	foreach($errorMessage as $message){
	// 		echo '<li>' . $message . '</li>';
	// 	}

	// 	echo '</ul>';
	// }







	//Find out wheather the google recapcha should be shown
	// if( Login::requireFurtherAuth()  ){
	// 	echo  '<div class="g-recaptcha" data-sitekey="6LdEUCkTAAAAABmlOs5EVlD39jgeqrvo13ExGTQk"></div>';
	// }


