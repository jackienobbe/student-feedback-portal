<?php
// view_student.inc.php
$error_msg = "";

if (isset($_SESSION['userID']))
{
  $userID = $_SESSION['userID'];
  $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
  // Read product from database given its code
  $rc = read_student($userID, $userFName, $userLName, $currentYear, $major, $error_msg);

  if ($rc != 0)
    // error
    header("Location:" . $ref . "?userID=" . $userID . "&err=" . $error_msg);
}
else {
  header("Location: login.php");
}
