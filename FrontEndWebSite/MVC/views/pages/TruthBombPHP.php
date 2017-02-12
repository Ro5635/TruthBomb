<?php
// script intended to dynamically render slideshow using image delivering API
// author: Lewis Blackburn blackbul@aston.ac.uk
//for each array print data-target="<id>" data-slide-to="x", increase x by one each time, define in function
//bbc, reuters, economist images (for now)
//slide label, data src, description
echo("This is Bob");
// obtains the database of images
$items = ImageBank::getBankID(4727744);
echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
echo '<div class="carousel-inner" role="listbox">';
$count = 0;
foreach ($items as $item){
  if ($count == 0){
    echo '<div class="carousel-item>';
  }
  else{
    echo '<div class="carousel-item-active>';
  }
  echo '<img class="d-block img-fluid" src="' . $item['Imagesrc'] . '" alt="' . $item['alt'] . '">';
  echo '</div>';
  $count++;
}
echo '</div>';
echo '</div>';
?>
