<?php

echo '<body>';

//include($_SERVER['DOCUMENT_ROOT'].'../PHPIncludes/Views/Menus/StdMenuBar.php');

?>





<div class="container">


  <div id="loginpageSpacer"></div>

  <div class="row">

    <div class="col-xs-1  col-sm-2 col-md-3"></div>

    <div id="formsContent">

      <div id="loginForm" class="loginFormStyle col-xs-10 col-sm-8 col-md-6 col-lg-6 col-xl-6 contentText animated bounceIn">

        <p class=" headingText text-xs-center">Please Sign In</p>

        <p class="text-xs-center ">To continue you need to either sign in or create a new account</p>

        
        <form>
          <div class="form-group">
            <label for="formGroupExampleInput">Email Address</label>
            <input type="text" class="form-control" placeholder="Email" id="emailAddress">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>



          <div class="buttonBar"><button type="button" class="btn btn-primary btnSpacer" id="signInBtn">Sign In</button><button type="button" class="btn btn-secondary btnSpacer" id="createAccountBtn">Create Account</button></div>
        </form>

        <br>

      </div>







      <div id="accountForm" class="loginFormStyle hidden-xs-up col-xs-10 col-sm-8 col-md-6 col-lg-6 col-xl-6 contentText">

        <p class=" headingText text-xs-center">Create A New Account</p>

        <p class="text-xs-center ">Compleate the bellow form to create a new account</p>
        <p id="generalFormFeebackAc" class="text-warning"></p>
        <form id="newAccountForm">

          <div class="form-group">
            <label for="formGroupExampleInput">First Name</label>
            <input type="text" class="form-control" id="fNameAc" placeholder="First Name">
          </div>

          <div class="form-group">
            <label for="formGroupExampleInput">Last Name</label>
            <input type="text" class="form-control" id="lNameAc" placeholder="Last Name">
          </div>

          <div class="form-group">
            <label for="formGroupExampleInput2">Password</label>
            <input type="password" class="form-control" id="passwordAc" placeholder="Password">
          </div>


          <div class="form-group">
            <label for="formGroupExampleInput">Email Address</label>
            <input type="text" class="form-control" placeholder="Email" id="emailAddressAc">
            <p id="emailValidationRespAc" class="text-warning"></p>
          </div>


          <div class="form-group">
            <label for="formGroupExampleInput">Mobile Number</label>
            <input type="text" class="form-control" placeholder="07555 555" id="mobNumAc">
            <p id="mobNumValidationRespAc" class="text-warning"></p>
          </div>


          <div class="buttonBar"><button type="button" class="btn btn-primary btnSpacer" id="createAccountFormBTN">Create Account</button><button type="button" id="rtnSignInBtn" class="btn btn-secondary btnSpacer">Return To Sign In</button></div>
        </form>

        <br>

      </div>






    </div>


    <div class="col-xs-1  col-sm-2 col-md-3 "></div>

  </div><!-- end Row -->









  <div class="hidden-md-up" id="loginpageSpacer"></div>



  <div class="row">

    <div class="hidden-sm-down col-md-4"></div>

    <div id="loginPageLogo" class="hidden-sm-down col-md-4">

      <a href="/">
        <img src="/assets/media/LisItLogo.jpeg" class="img-fluid" alt="LisIt Logo">
      </a>

    </div>

    <div class="hidden-sm-down col-md-4"></div>

  </div><!-- end Row -->

</div><!-- Close Container -->
