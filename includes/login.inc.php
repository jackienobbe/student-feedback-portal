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

    //echo $userID . "\n";
    //echo $userPassword . "\n";

    //$rc = login($userID, $userPassword, $error_msg);
    try {
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT userID FROM System_User
      WHERE userID = :userID && userPassword = :userPassword;";

      $sth = $dbh->prepare($sql); //, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

      $sth->bindParam(':userID', $userID);
      $sth->bindParam(':userPassword', $userPassword);

      // Execute the prepared query.
      $sth->execute();
      //$array =
      $sth->fetchAll(PDO::FETCH_ASSOC);

      if (count($sth) != 1)
      {
        // error
        header("Location:" . $ref . "?userID=" . $userID . "&err=" . $error_msg);
      }
      else {
        $_SESSION['userID'] = $userID;
        $_SESSION['currentSemester'] = $currSemester;
        echo $_SESSION['userID'];
        header("Location: ../welcome.php");
      }
    }
    catch(PDOException $e)
    {
      $dbh = null;
      header("Location: error.php?err=" . $e->getMessage());
    }
  }
}
