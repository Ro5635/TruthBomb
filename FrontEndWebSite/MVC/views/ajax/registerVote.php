<?php
//Handle the vote ajax

if(($_SERVER['REQUEST_METHOD'] == "POST")){
	//This is the register vote

	//Get the clean post data

	$urlSite = filter_var($_POST['siteurl'] , FILTER_SANITIZE_STRING);
	$rating = filter_var($_POST['rating'] , FILTER_SANITIZE_STRING);

	Site::registerVote( $urlSite , $rating );


	$jsonArray = array( 'VoteSaved' => 1 , 'CurrentRating' => '2.5' );

	echo json_encode($jsonArray);


}else{
	
	//Not a post request. Unexpected
	echo 'Must Buy Dog Biscuits';
	die();

}

