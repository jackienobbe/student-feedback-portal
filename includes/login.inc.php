<?php
 ob_start();
 session_start();
 include_once 'dbconnect.php';

 // it will never let you open index(login) page if session is set
 // if ( isset($_SESSION["userID"])!="" ) {
 //  header("Location: view_student.php");
 //  exit;
 // }

 $error_msg = "";
 if($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_SESSION["userID"]))
  {
    // username and password sent from form
    $userID = $_POST['userID'];
    $userPassword = $_POST['userPassword'];

    $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    echo "Here";
    $rc = login2($userID, $userPassword, $error_msg);
    echo $rc;
    if ($rc != 0)
    {
       // error
       header("Location:" . $ref . "?userID=" . $userID . "&err=" . $error_msg);
    }
    else {
      $_SESSION['userID'] = $userID;
      echo $_SESSION['userID'];
      header("location: welcome.php");
    }
    //session_register("userID");

  }

 //take stuff from the internet. Add it here.
}
