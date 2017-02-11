<?php
//Handles the creation of an account from the recipt of an ajax post request

if(($_SERVER['REQUEST_METHOD'] == "POST")){

	//Get the clean post data
	$emailAddress = filter_var($_POST['emailAddress'] , FILTER_SANITIZE_EMAIL);
	$password = filter_var($_POST['Password'] , FILTER_SANITIZE_STRING);
	$fName = filter_var($_POST['fname'] , FILTER_SANITIZE_STRING);
	$lName = filter_var($_POST['lname'] , FILTER_SANITIZE_STRING);
	$mobileNumber = filter_var($_POST['mobNo'] , FILTER_SANITIZE_STRING);

	//Create a new account:
	$Account =  Account::attemptCreateNew($fName, $lName, $password, $emailAddress , $mobileNumber, 1);

	//Make doubably sure
	$succefullCreation = $Account->checkAccountCreatedSuccesfuly();

	if($succefullCreation){
		
		$accountCreated= 1;
	
	}else{

		$accountCreated = 0;
	
	}
	
	$jsonArray = array( 'AccountCreated' => $accountCreated , 'redirectTo' => '/login/form' );

	echo json_encode($jsonArray);

	//Finished
	die();

}else{
	
	//Not a post request.. Unexpected
	echo 'Must Buy Dog Biscuits';
	die();

}

