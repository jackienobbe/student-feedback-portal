<?php
//
// create_acct.inc.php
//
include 'db_connect.php';

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Get data from form
  $newUserID = $_POST["newUserID"];
  $userPassword = $_POST["userPassword"];
  $userFName = $_POST["userFName"];
  $userLName = $_POST["userLName"];
  $major = $_POST["major"];
  $currentYear =  $_POST["currentYear"];
  //echo "<script type='text/javascript'>alert('Made it here.');</script>";

  // run sql query
  $rc = create_account($newUserID, $userPassword, $userFName, $userLName, $major, $currentYear, $error_msg);
  //echo "<script type='text/javascript'>alert('Yer here.');</script>";

  if ($rc == 0)
  {
    // Product successfully created; reset fields
    $newUserID = $userPassword =  $userFName = $userLName = $major = $currentYear = "";
    header('Location: ../login.php');
  }
  else
  {
    $userPassword = "";
    //echo $rc; // "<script type='text/javascript'>alert('Account was not successfully created.');</script>";
  }
}
else
{
  // Set the following variables to initialize
  // the form fields (when the page is visited).
  $userPassword =  "";
}
