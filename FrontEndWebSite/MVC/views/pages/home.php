<?php

echo '<body>';

include($_SERVER['DOCUMENT_ROOT'].'/../PHPIncludes/Views/Menus/StdMenuBar.php');

?>



  <!-- Title of site -->
<div class="jumbotron text-center bg-primary">
  <img src="truthbomblogo.png" alt="Truth Bomb's Logo">	 
    <a href="TruthBombSite.html"><h1><big><p class="text-white">Truth Bomb</p></big></h1></a>
</div>



 <div class="container">
    <!-- Description of site -->
  </br>
    <div class="row">
      <div class="col-sm-8">
	<!--heading for trusted sources section -->
	<h3>Truth Bomb's most trusted sources</h3>
      </div>
      <div class="col-sm-4">
	<!-- where forum will be, fills up the rest of the pages columns -->
	<a href="forumSubmitPage.html">
	  <button type="button" class="btn btn-primary">Submit a review</button>
	</a>
      </div>
    </div>
    <div class="row">
      <!-- Where slideshow will be for trusted sources, created in a new row -->
        <div class="col-sm-8">
	<!-- Carasel code starts here -->
        <!-- Carasel code ends here -->
        </div>
        <div class="col-sm-4">
	  </br>
      	  <a href="donationPage.html">
	    <button type="button" class="btn btn-primary">Donate!!!</button> 
	  </a>
	</div>	
     </div>
 </div>  
</body>

<<<<<<< HEAD
=======
echo 'THIS IS THE PAGE Pineapple';
>>>>>>> 15f3c9b2a805d701607a947026ca1ec552913015
