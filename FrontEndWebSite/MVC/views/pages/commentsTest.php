<?php

echo '<body>';


echo 'Testing Image Thing:';


ImageBank::attemptCreateNew("http://lorempixel.com/400/445/", "This is an image alt");
ImageBank::attemptCreateNew("http://lorempixel.com/300/445/", "Apple sauce");
$bankID = ImageBank::attemptCreateNew("http://lorempixel.com/450/445/", "Merry Christmas");


$images = ImageBank::getBankID($bankID['BankID']);

var_dump($images);

foreach ($images as $image) {
	
	echo '<div class="row"><img src="' . $image['Imagesrc'] . '"" class="img-fluid" alt="' . $image['alt'] . '"></div>';

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



