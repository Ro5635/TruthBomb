<?php
// script intended to dynamically render slideshow using image delivering API
// author: Lewis Blackburn blackbul@aston.ac.uk
//for each array print data-target="<id>" data-slide-to="x", increase x by one each time, define in function
//bbc, reuters, economist images (for now)
//slide label, data src, description
// obtains the database of images
$items = ImageBank::getBankID(4727744);
echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
echo '<div class="carousel-inner" role="listbox">';
$count = 0;
foreach ($items as $item){
  if ($count == 0){
    echo '<div class="carousel-item active">';
  }
  else{
    echo '<div class="carousel-item">';
  }
  echo '<img src="' . $item['Imagesrc'] . '" alt="' . $item['alt'] . ' . width="128" height="128"">';
  echo '</div>';
  $count++;
}
//style="max-height:100px"
echo '</div>';
echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
echo '<span class="carousel-control-prev-icon" aria-hidden="true">';
echo '</span>';
echo '<span class="sr-only">Previous</span>';
echo '</a>';
echo '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
echo '<span class="carousel-control-next-icon" aria-hidden="true">';
echo '</span>';
echo '<span class="sr-only">Next</span>';
echo '</a>';
echo '</div>';
?>
