<?php
// This model is responsible for handaling the image bank.
//
// @author Robert Curran robert@robertcurran.co.uk

class ImageBank {

	public $imageSrc;
	public $imageAlt;
	public $imageID;
	public $bankID;
	


	public function __construct($imageSrc, $imageAlt, $imageID, $bankID) {
		
		//Set the instance variables
		$this->imageSrc = $imageSrc;
		$this->imageAlt = $imageAlt;
		$this->imageID = $imageID;
		$this->bankID = $bankID ;

	}



	 /**
	  * Atempt to create a new Image, appends to a new image bank.
	  * @param  [type] $imageSrc [description]
	  * @param  [type] $imageAlt [description]
	  * @param  [type] $imageID  [description]
	  * @param  [type] $bankID   [description]
	  * @return [type]           [description]
	  */
	 public static function attemptCreateAppendNew($imageSrc, $imageAlt, $bankID) {


		//Ensure each of the fields is not blank
	 	$argumenList = array($imageSrc, $imageAlt);
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


	 		$db = Db::getInstance();

	 		$attemps  = 0;

	 		do {

	 			if($attemps > 5){
					//More than five atetmpts to get an unused ID, something is BADLY wrong.
	 				error_log("FATAL ERROR, Unable to find a unique Id for the new run");
	 				die();
	 			}

    			//Generate a psudo random number for use as the id, no need for crytographic randomness, not thsi does pose a limuit on the number of custoemrs! :)
	 			$randomNumber = rand(1000000, 99999999);

				//Check to see that the index is not in use:

	 			$req = $db->prepare('SELECT * FROM ImageBank WHERE ImageID = :ID limit 5');
	 			$req->execute(array(':ID' => $randomNumber));
	 			$Usersfound = $req->fetchAll();

	 			$attemps++;

	 		} while (count($Usersfound)  > 0);


			//Found new unused RunID
	 		$FoundImageID = $randomNumber;


			//Account does not exist, create it
	 		$req = $db->prepare('INSERT INTO ImageBank( ImageID, BankID, Imagesrc, alt ) VALUES( :ImageID , :BankID , :Imagesrc , :alt )');
	 		$req->execute(array( ':ImageID' => $FoundImageID, ':BankID' => $bankID, 'Imagesrc' => $imageSrc, 'alt' => $imageAlt ));



	 		return array('ImageID' => $FoundImageID, 'BankID' => $bankID );


	 	}else{

	 		error_log("There was an error in an argument!");
	 		die();

	 	}




	 }





	 /**
	  * Atempt to create a new Image, appends to a new image bank.
	  * @param  [type] $imageSrc [description]
	  * @param  [type] $imageAlt [description]
	  * @param  [type] $imageID  [description]
	  * @param  [type] $bankID   [description]
	  * @return [type]           [description]
	  */
	 public static function attemptCreateNew($imageSrc, $imageAlt) {


		//Ensure each of the fields is not blank
	 	$argumenList = array($imageSrc, $imageAlt);
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


	 		$db = Db::getInstance();

	 		$attemps = 0;

	 		do {

	 			if($attemps > 5){
					//More than five atetmpts to get an unused ID, something is BADLY wrong.
	 				error_log("FATAL ERROR, Unable to find a unique Id for the new run");
	 				die();
	 			}

    			//Generate a psudo random number for use as the id, no need for crytographic randomness, not thsi does pose a limuit on the number of custoemrs! :)
	 			$randomNumber = rand(1000000, 99999999);

				//Check to see that the index is not in use:

	 			$req = $db->prepare('SELECT * FROM ImageBank WHERE BankID = :ID limit 5');
	 			$req->execute(array(':ID' => $randomNumber));
	 			$Usersfound = $req->fetchAll();

	 			$attemps++;

	 		} while (count($Usersfound)  > 0);

	 		//Found new unused RunID
	 		$FoundBankID = $randomNumber;


	 		//Call the create image
	 		return ImageBank::attemptCreateAppendNew($imageSrc, $imageAlt, $FoundBankID);


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
		public static function getBankID($bankID) {

			$db = Db::getInstance();

			$req = $db->prepare('SELECT * FROM ImageBank WHERE BankID = :bankID');

			$req->execute(array( ':bankID' => $bankID) );
			$images = $req->fetchAll();

			if(count($images) > 0 ){
				
				return $images;

			}else{

				//Account not found
				return null;

			}

		}



		/**
		 * Get an Account object from supplied email address
		 * @param  [type] $emailAddress [description]
		 * @return [type]               [description]
		 */
		public static function getImageID($imageID) {

			$db = Db::getInstance();

			$req = $db->prepare('SELECT * FROM ImageBank WHERE ImageID = :ImageID');

			$req->execute(array( ':ImageID' => $imageID) );
			$images = $req->fetchAll();

			if(count($images) > 0){

				$images = $images[0];
				
				return $images;

			}else{

				//Account not found
				return null;

			}

		}





	}