<?php
class ajaxController {


/**
 * Handle the login attempt
 * @return [type] [description]
 */
	public function login() {

	    //Model:
		require_once('../MVC/models/Login.php');
		require_once('../MVC/models/Account.php');

		//view:
		require_once('views/ajax/loginHandle.php');


	}



	/**
	 * Handle the login attempt
 	* @return [type] [description]
	 */
	public function registervote() {

		error_log("Got to message");
	    //Model:
		require_once('../MVC/models/Site.php');

		//view:
		require_once('views/ajax/registerVote.php');


	}


		/**
	 * Handle the login attempt
 	* @return [type] [description]
	 */
	public function getresults() {

		error_log("Got to message");
	    //Model:
		require_once('../MVC/models/Site.php');

		//view:
		require_once('views/ajax/getResults.php');


	}



	/**
	 * Handdle the attemt to create an account
	 * @return [type] [description]
	 */
	public function createaccount() {

	    //Model:
		require_once('../MVC/models/Account.php');

		//view:
		require_once('views/ajax/CreateAccount.php');


	}
	


}
