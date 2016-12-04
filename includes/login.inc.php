<?php
ob_start();
session_start();
include 'db_connect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION["userID"]) != "" ) {
  header("Location: logout.inc.php");
  //header("Location: ../view_student.php");
  exit;
}

$error_msg = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_SESSION["userID"]))
  {
    // username and password sent from form
    $userID = $_POST['userID'];
    $userPassword = $_POST['userPassword'];
    $currSemester = "Fall 2016";
    //$ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);

    try {
      $userID = $_POST["userID"];
      $userPassword = $_POST["userPassword"];

      // run sql query
      $rc = login($userID, $userPassword, $error_msg);

      if ($rc == 0)
      {
        // Product successfully created; reset fields
        $_SESSION['userID'] = $userID;
        $_SESSION['currentSemester'] = $currSemester;
        header("Location: error.php");
      }
      else
      {
        $userPassword = "";
      }
    }
    catch(PDOException $e)
    {
      $dbh = null;
      header("Location: error.php?err=" . $e->getMessage());
    }
  }
}
