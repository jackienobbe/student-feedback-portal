<?php
//
// create_acct.inc.php
//
include_once 'db_connect.php';
include_once 'db_functions.php';

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Get data from form
  $userID = $_POST["userID"];
  $userPassword = $_POST["userPassword"];
  $userFName = $_POST["userFName"];
  $userLName = $_POST["userLName"];
  $major = $_POST["major"];
  $currentYear =  $_POST["currentYear"];
  //echo "<script type='text/javascript'>alert('Made it here.');</script>";

  // run sql query
  $rc = create_account($userID, $userPassword, $userFName, $userFName, $major, $currentYear, $error_msg);
  //echo "<script type='text/javascript'>alert('Yer here.');</script>";

  if ($rc == 0)
  {
    // Product successfully created; reset fields
    echo "<script type='text/javascript'>alert('Account successfully created!');</script>";
    $userID = $userPassword =  $userFName = $userFName = $major = $currentYear = "";
  }
  else
  {
    echo "<script type='text/javascript'>alert('Account was not successfully created.');</script>";
  }
}
else
{
  // Set the following variables to initialize
  // the form fields (when the page is visited).
  $userID = $userPassword =  $userFName = $userFName = $major = "";
}
