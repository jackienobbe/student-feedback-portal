<?php
//
// create_acct.inc.php
//
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Get data from form
  $userID = $_POST["userID"];
  $userPassword = $_POST["userPassword"];
  $major = $_POST["major"];
  $currentYear =  $_POST["currentYear"];

  function create_account($userID, $userPassword, $major, $currentYear, $error_msg)
  if ($rc == 0)
  {
    // Product successfully created; reset fields
    echo "<script type='text/javascript'>alert('Account successfully created!');</script>";
    $userID = $userPassword = $major = $currentYear = "";
  }
  else
  {
    echo "<script type='text/javascript'>alert('Account was not successfully created.');</script>";
  }
}
else
{
  // Set the following variables to initialize the form fields.
  $userID = $userPassword = $major = $currentYear = "";
}
