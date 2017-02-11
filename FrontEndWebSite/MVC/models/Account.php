<?php
// This model is responsible for handaling the user Account.
//
// @author Robert Curran robert@robertcurran.co.uk

class Account {

	public $fName;
	public $lName;
	public $password;
	public $emailAddress;
	public $mobileNumber;
	public $type;


	public function __construct($fName, $lName, $password, $emailAddress , $mobileNumber, $type) {
		
		//Set the instance variables
		$this->fName = $fName;
		$this->lName = $lName;
		$this->password = $password;
		$this->emailAddress = $emailAddress ;
		$this->mobileNumber = $mobileNumber;
		$this->type = $type;

		//Attempt to create account
		//$this->attemptCreateNew($fName, $lName, $password, $emailAddress , $mobileNumber, $type);



	}


	/**
	 * Attempt to create a new user account
	 * @param  [type] $UserName          [description]
	 * @param  [type] $Password          [description]
	 * @param  string $recaptchaResponse [description]
	 * @return [type]                    [description]
	 */
	public static function attemptCreateNew($fName, $lName, $password, $emailAddress , $mobileNumber, $type) {

		
		//Ensure each of the fields is not blank
		$argumenList = array($fName, $lName, $password, $emailAddress , $mobileNumber, $type);
		$anArgumentFailed = false;

		foreach ($argumenList as $argument) {
			
			if($argument == '' || $argument == null){
				//An argument is empty or null!
				$anArgumentFailed = true;
				error_log('Arg' . $argument);

			}

		}

		//If all of the arguments are complete then procced to create the account
		if(!$anArgumentFailed){


			//Format the mobile number corrrectly:
			if( substr($mobileNumber, 0, 2) == '07'){
				// switch this to 44
				$mobileNumber = '44' . substr($mobileNumber, 1);
				error_log("New mobile number: " . $mobileNumber);

			}else if( substr($mobileNumber, 0, 2) == '44' ){

				//Correct format allready

			}else{

				error_log("Mobile number in an odd format");

			}




			$db = Db::getInstance();

			$req = $db->prepare('Select * FROM Users WHERE Email = :email');
			$req->execute(array( ':email' => $emailAddress) );
			$User = $req->fetchAll();

			//Ensure that the account does not allready exist			
			if(count($User) >= 1){
				
				error_log("Tried creating an existing user! Aborted.");

				die();

			}else{

				//Account does not exist, create it
				$req = $db->prepare('INSERT INTO Users (UserTokenHashed , Email, FirstName, SecondName, MobileNum, AccessType) VALUES( SHA1(:password) , :emailAddress, :fName , :lName , :mobileNumber , :type  )');
				$req->execute(array( ':password' => $password, ':emailAddress' => $emailAddress, 'fName' => $fName, 'lName' => $lName, ':mobileNumber' => $mobileNumber, ':type' => $type) );
				
				//get the new account
				$newAccount = Account::getAccountFromEmail( $emailAddress );

				//return the new account
				return $newAccount;

			}




			
		}else{

			error_log("There was an error in an argument!");
			die();

		}

		


	}



		/**
		 * Get an Account object from supplied email address
		 * @param  [type] $emailAddress [description]
		 * @return [type]               [description]
		 */
		public static function getAccountFromEmail($emailAddress) {

			$db = Db::getInstance();

			$req = $db->prepare('Select * FROM Users WHERE Email = :email');
			$req->execute(array( ':email' => $emailAddress) );
			$User = $req->fetchAll();

			if(count($User) == 1){

				$User = $User[0];

				//Found account, return a new account object	
				$account = new Account($User['FirstName'] , $User['SecondName'] , 'null',  $User['Email'], $User['MobileNum'], $User['AccessType']);
				
				return $account;
			
			}else{

				//Account not found
				return null;

			}

		}



		/**
		 * Returns a boolean denoting wheather or not the mobile verification has been sent to nexmo at lease once.
		 * @return [type] [description]
		 */
		public function checkMobileVerificationSent() {

			$db = Db::getInstance();

			$req = $db->prepare('Select MobileVerificationSentRequest FROM Users WHERE Email = :email');
			$req->execute(array( ':email' => $this->emailAddress) );
			$User = $req->fetchAll();
			
			if(count($User) == 1){

				$User = $User[0]; 

				if( $User['MobileVerificationSentRequest'] == 1){
					//The number is verified
					return true;
			
				}else{

					//the number is not verified
					return false;
			
				}
				
				
				
			}else{

				//Account does not exist
				error_log("ERROR, found iregular number of mathing users!");
				return false;
				
			}
			

		}

		/**
		 * Returns a boolean denoting wheather or not the account creation succeded. 
		 * @return [type] [description]
		 */
		public function setMobileVerificationRequestSentState($newState) {

			//Make the appropiate database
			$db = Db::getInstance();

			$req = $db->prepare('UPDATE Users SET MobileVerificationSentRequest = :newState WHERE email = :email');
			$req->execute(array( ':email' => $this->emailAddress, ':newState' => $newState) );
			
			

		}	


		/**
		 * Allows for the setting of the mobile verification state for the users mobile number 
		 * @return [type] [description]
		 */
		public function setMobileVerificationState($newState) {

			//Make the appropiate database
			$db = Db::getInstance();

			$req = $db->prepare('UPDATE Users SET MobileVerificationState = :newState WHERE email = :email');
			$req->execute(array( ':email' => $this->emailAddress, ':newState' => $newState) );
			
			

		}	




		 
		
		/**
		 * Returns a boolean denoting wheather or not the account creation succeded. 
		 * @return [type] [description]
		 */
		public function checkMobileNumberVerified() {

			$db = Db::getInstance();

			$req = $db->prepare('Select MobileVerificationState FROM Users WHERE Email = :email');
			$req->execute(array( ':email' => $this->emailAddress) );
			$User = $req->fetchAll();
			
			if(count($User) == 1){

				$User = $User[0]; 

				if( $User['MobileVerificationState'] == 1){
					//The number is verified
					return true;
			
				}else{

					//the number is not verified
					return false;
			
				}
				
				
				
			}else{

				//Account does not exist
				error_log("ERROR, found iregular number of mathing users!");
				return false;
				
			}
			

		}


	/*
		Returns a boolean denoting wheather or not the account creation succeded. 
	 */
		public function checkAccountCreatedSuccesfuly() {

			$db = Db::getInstance();

			$req = $db->prepare('Select * FROM Users WHERE Email = :email');
			$req->execute(array( ':email' => $this->emailAddress) );
			$User = $req->fetchAll();
			
			if(count($User) >= 1){

				//Account exists
				return true;

			}else{

				//Account does not exist
				return false;

			}

		}




	}