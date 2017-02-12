<?php
//Handle the vote ajax

if(($_SERVER['REQUEST_METHOD'] == "POST")){
	//This is the register vote

	//Get the clean post data

	$urlSite = filter_var($_POST['siteurl'] , FILTER_SANITIZE_STRING);

	$rating = Site::getRating( $urlSite );


	$jsonArray = array( 'CurrentRating' =>  $rating );

	echo json_encode($jsonArray);


}else{
	
	//Not a post request. Unexpected
	echo 'Must Buy Dog Biscuits';
	die();

}
