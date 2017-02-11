<?php
class SecureAJAXController {


/**
 * Handle the verification attempt
 * @return [type] [description]
 */
	public function verifymobile() {

	    //Model:
		require_once('../MVC/models/Account.php');

		//view:
		require_once('views/secureAJAX/verifyNumber.php');


	}

	/**
	 * Allows the user to request a re-send of the verification message to there phone
	 * @return [type] [description]
	 */
	public function resendmobileverification(){

		 //Model:
		require_once('../MVC/models/Account.php');

		//view:
		require_once('views/secureAJAX/reSendVerification.php');


	}


	


}
