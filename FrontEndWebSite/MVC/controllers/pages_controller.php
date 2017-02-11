<?php
/**
 * All of the pages on this site should be listed here, the page header and footer should be configuired with pageRequirements object and requested by each page.
 * 
 */
  class PagesController {

    public function home() {

      //Require the class for storing CSS and Script requirements:
      require_once($_SERVER['DOCUMENT_ROOT'] . '/../PHPIncludes/pageLinkScriptsCSS.php');

      //Make an object of the pageLinkScriptsCSS class for storing the CSS requirements for the header:
      $pageRequirements = new pageLinkScriptsCSS();
      
      $pageRequirements->add("css", ['MainStyles.css','animate.min.css']);

      $pageRequirements->add("title", 'Truth Bomb');

      $pageRequirements->add("js", ['assets/JS/js.js', 'assets/JS/DiscusScript.js']);

      callStructural('header','std',$pageRequirements);

      //Model:
      require_once('../MVC/models/ImageBank.php');

      //View:  
      require_once('views/pages/home.php');

      //Render the page footer:
      callStructural("footer", 'std', $pageRequirements); 


    }


    public function commentstest() {

      //Require the class for storing CSS and Script requirements:
      require_once($_SERVER['DOCUMENT_ROOT'] . '/../PHPIncludes/pageLinkScriptsCSS.php');

      //Make an object of the pageLinkScriptsCSS class for storing the CSS requirements for the header:
      $pageRequirements = new pageLinkScriptsCSS();
      
      $pageRequirements->add("css", ['MainStyles.css','animate.min.css']);

      $pageRequirements->add("title", 'Truth Bomb');

      $pageRequirements->add("js", ['assets/JS/js.js', 'assets/JS/DiscusScript.js']);



      callStructural('header','std',$pageRequirements);

      //Model:
      require_once('../MVC/models/ImageBank.php');


      require_once('views/pages/commentsTest.php');

      //Render the page footer:
      callStructural("footer", 'std', $pageRequirements); 


    }





    public function error() {

   //Require the class for storing CSS and Script requirements:
    require_once($_SERVER['DOCUMENT_ROOT'] . '../PHPIncludes/pageLinkScriptsCSS.php');

    $pageRequirements = new pageLinkScriptsCSS();

    $pageRequirements->add("css", ['error.css']);

    $pageRequirements->add("title", 'The Sky Is Falling');

    callStructural('header','std',$pageRequirements);

    require_once('views/pages/error.php');

      //Render the page footer:
    callStructural("footer", 'std', $pageRequirements); 

    }
  }
