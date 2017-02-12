<?php
// This model is responsible for handaling the Sites within the system.
//

class Site {

	public $SiteID;
	public $SiteURL;
	public $Rating;
	

	public function __construct($SiteID, $SiteURL, $Rating) {
		
		//Set the instance variables
		$this->SiteID = $SiteID;
		$this->SiteURL = $SiteURL;
		$this->Rating = $Rating;

	}


	public static function RegisterVote($SiteURL, $Rating) {


		//Ensure each of the fields is not blank
		$argumenList = array($SiteURL, $Rating);
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


	 		//See if the url is alreay existing
			// select * FROM Sites WHERE SiteURL = "Hello"	 		

			$req = $db->prepare('SELECT * FROM Sites WHERE SiteURL = :siteURL');
			$req->execute(array(':siteURL' => $SiteURL));
			$SitesFound = $req->fetchAll();

			if(	count($SitesFound)  == 1 ){
				//Site has allready been created, increment the votes

				$siteID = $SitesFound[0]['SiteID'];


				
			}else{//Create the site in the site table first

				
				//Get a SiteID				
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

					$req = $db->prepare('SELECT SiteID FROM Sites WHERE SiteID = :ID');
					$req->execute(array(':ID' => $randomNumber));
					$SitesFound = $req->fetchAll();

					$attemps++;

				} while (count($SitesFound)  > 0);

				//Found new unused RunID
				$FoundSiteID = $randomNumber;

				//Account does not exist, create it
				$req = $db->prepare('INSERT INTO Sites( SiteID, SiteURL ) VALUES( :SiteID , :SiteURL )');
				$req->execute(array( ':SiteID' => $FoundSiteID, ':SiteURL' => $SiteURL ));

				//Site now created in the site table, now create a listing for it in siteRatings.
				$req = $db->prepare(' INSERT INTO SiteRatings( SiteID, Rating) VALUES(  :SiteID, :Rating )');
				$req->execute(array( ':SiteID' => $FoundSiteID, ':Rating' => $Rating ));



			}





			return $FoundSiteID;


		}




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