<?php

echo '<body>';


echo 'Testing Image Thing:';


$bankID = 76903139;
//$bankID['BankID']
ImageBank::attemptCreateAppendNew("http://lorempixel.com/300/445/", "Apple sauce", $bankID );
ImageBank::attemptCreateAppendNew("http://lorempixel.com/450/445/", "Merry Christmas", $bankID);
ImageBank::attemptCreateAppendNew("http://lorempixel.com/450/445/", "Merry Bob", $bankID);
ImageBank::attemptCreateAppendNew("http://lorempixel.com/500/445/", "Hi", $bankID);
ImageBank::attemptCreateAppendNew("http://lorempixel.com/233/445/", "Mcdonalds", $bankID);


$images = ImageBank::getBankID($bankID['BankID']);


echo '<pre>';
var_dump($images);

echo '</pre>';


echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
	echo '<div class="carousel-inner" role="listbox">';
foreach ($images as $image) {
	echo '<div class="carousel-item carousel-item-next carousel-item-left">';
	
		echo '<img src="' . $image['Imagesrc'] . '"" class="img-fluid d-block" data-holder-rendered="true" ' . $image['alt'] . '">';
	echo '</div>';

}

echo '</div>';

echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
echo '<span class="sr-only">Previous</span>';
echo ' </a>';
echo ' <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
echo '<span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span>';
echo '</a></div>';
 
 
    
  






echo '<div class="row">';


    echo '<div class="col-sm-2"></div>';
      
   	echo '<div class="col-sm-8">';
  


		//Include the comments block
		require_once($_SERVER['DOCUMENT_ROOT'] . '/../PHPIncludes/discusComments.php');


    echo '</div>';

	echo '<div class="col-sm-2"></div>';

echo '</div>';
//End Row



