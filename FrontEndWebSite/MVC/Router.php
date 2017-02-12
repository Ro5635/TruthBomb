<?php
<<<<<<< HEAD
  //All of the controllers and there associated actions:
$controllers = array('pages' => ['home', 'commentstest', 'about' , 'donate' ,'error'], 'secureajax' => ['verifymobile', 'resendmobileverification'] ,'ajax' => ['login', 'registervote' ,'createaccount','getresults'] , 'header' => ['std', 'error'] , 'footer' => ['std', 'error'] , 'login' => ['form'] , 'account' => ['verify']);
=======
  //All of the controllers and their associated actions:
$controllers = array('pages' => ['home', 'commentstest', 'error', 'phptest'], 'secureajax' => ['verifymobile', 'resendmobileverification'] ,'ajax' => ['login', 'createaccount'] , 'header' => ['std', 'error'] , 'footer' => ['std', 'error'] , 'login' => ['form'] , 'account' => ['verify']);
>>>>>>> 15f3c9b2a805d701607a947026ca1ec552913015

if (array_key_exists($controller, $controllers)) {

  if (in_array($action, $controllers[$controller])) {

    call($controller, $action);
  } else {

    call('pages', 'error');
  }

} else {
  call('pages', 'error');
}


function call($controller, $action) {

  require_once('controllers/' . $controller . '_controller.php');

  switch($controller) {
    case 'pages':

    $controller = new PagesController();
    break;

    case 'ajax':

    $controller = new ajaxController();
    break;

    case 'secureajax':
    $controller = new SecureAJAXController();
    break;

    break;
    case 'header':

    $controller = new headerController();
    break;
    case 'footer':

    $controller = new FooterController();
    break;

    case 'login':
    $controller = new LoginController();
    break;

    case 'account':
    $controller = new AccountController();
    break;

  }

  $controller->{ $action }();

}

  /**
   * Called by pages to render headers and footers with the neccasary linked scripts.
   * @param  [type] $controller       [description]
   * @param  [type] $action           [description]
   * @param  [type] $pageRequirements [description]
   * @return [type]                   [description]
   */
  function callStructural($controller, $action, $pageRequirements){

   require_once('controllers/' . $controller . '_controller.php');
   switch($controller) {
    case 'header':

    $controller = new headerController();
    break;
    case 'footer':

    $controller = new FooterController();
    break;
  }

  $controller->{ $action }($pageRequirements);

}
