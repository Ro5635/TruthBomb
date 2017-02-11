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
