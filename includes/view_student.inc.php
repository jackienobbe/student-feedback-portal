<?php
// view_student.inc.php
$error_msg = "";
if (isset($_SESSION["userID"]))
{
  // Coming from search_prof or get_product_code
  $userID = $_POST["userID"];
  $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
  // Read product from database given its code
  $rc = read_student($userID, $userFName, $userLName, $currentYear, $major, $error_msg);
  if ($rc != 0)
    // error
    header("Location:" . $ref . "?userID=" . $userID . "&err=" . $error_msg);
  // Product read successfully; proceed to display form fields
}
else  // type is GET
{
  $userID = $userFName = $userLName = $currentYear = $major = "";
  if (isset($_GET["err"]))
  {
    // We are here because there was an error in either update or delete
    $error_msg = $_GET["err"];
    $userID = $_GET["userID"];
  }
  else if (isset($_GET["userID"]))
    $userID = $_GET["userID"];
else
    // Coming from outside url with product code not provided
    header("Location:get_student_num.php");
}
