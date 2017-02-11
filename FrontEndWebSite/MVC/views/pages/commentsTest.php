<?php

echo '<body>';


echo 'Testing Image Thing:';


$bankID = 76903139;

//$bankID['BankID']
// ImageBank::attemptCreateAppendNew("http://lorempixel.com/300/445/", "Apple sauce", $bankID );
// ImageBank::attemptCreateAppendNew("http://lorempixel.com/450/445/", "Merry Christmas", $bankID);
// ImageBank::attemptCreateAppendNew("http://lorempixel.com/450/445/", "Merry Bob", $bankID);
// ImageBank::attemptCreateAppendNew("http://lorempixel.com/500/445/", "Hi", $bankID);
// ImageBank::attemptCreateAppendNew("http://lorempixel.com/233/445/", "Mcdonalds", $bankID);


$images = ImageBank::getBankID($bankID);


echo '<pre>';
var_dump($images);

echo '</pre>';



foreach ($images as $image) {

	
		echo '<div class="row"><img src="' . $image['Imagesrc'] . '" class="img-fluid" ' . $image['alt'] . '"></div>';



}


 
    
  






echo '<div class="row">';


    echo '<div class="col-sm-2"></div>';
      
   	echo '<div class="col-sm-8">';
  


		//Include the comments block
		require_once($_SERVER['DOCUMENT_ROOT'] . '/../PHPIncludes/discusComments.php');


    echo '</div>';

	echo '<div class="col-sm-2"></div>';

echo '</div>';
//End Row



