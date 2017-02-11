<?php
//Check the Login Details, the md5 hash of the user agent and the additional 'UserSessionID' are checked, this is ontop of
//the built in php session tracking.

//Robert Curran

if( isset($_SESSION["UserSessionID"]) && isset($_COOKIE['UserSessionID']) ){

	if($_SESSION['UserSessionID'] == $_COOKIE['UserSessionID'] && md5($_SERVER['HTTP_USER_AGENT']) == $_SESSION['HashedUsrAgent']){
		$_SESSION['loggedIn'] = true;


	}else{
				//The user is not logged in.
	header( 'Location: //' .$_SERVER['HTTP_HOST'] . '/login/form'   ) ;
	die;
	}
}else{
		//The user is not logged in.
	header( 'Location: //' . $_SERVER['HTTP_HOST'] . '/login/form'   ) ;
	die;
}