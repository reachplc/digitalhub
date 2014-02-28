<?php
session_start();




function do_login ($username, $password){

    $_salt = "NUj6eU%9EExnMe";
    $_hash = sha1($_salt . $password);

    $_username = "regionaluser";
    $_password = "a85d0ce26c4985ddef3d7f149d41f75248dfb637";

  //take the username and prevent SQL injections

  if ($username != $_username || $_hash != $_password ) {
      echo "Incorrect username and password, please try again.";
  } else {

    $_SESSION['username'] = $username;
    $_SESSION['isLoggedIn'] = true;
    //$_SESSION['userid'] = $users['userid'];
    header('Location: index.php?');
  }
} // do_Login()


$method = $_SERVER['QUERY_STRING'];

###
#
#  Method Switch
#
###

switch ($method) {

  case 'login':
    do_login($_POST['username'], $_POST['password']);
  break;

  case 'logout':
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
  }
  session_destroy();
  echo "Logged Out";
  break;

  default:
  if($_SESSION['isLoggedIn']) {
    include 'request-form.php';
  } else {
    include 'login.html';
  }
}


?>