<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $userID = $_POST["userID"];
      $userPassword =$_POST["userPassword"];
      
      // Read invoice from database given its code
  $rc = read_prof($userID, $userFName, $userLName,$departmentID, $error_msg);

  if ($rc != 0)
    // error
    header("Location:" . $ref . "?userID=" . $userID . "&err=" . $error_msg);

  // invoice read successfully; proceed to display form fields
}
else  // type is GET
{
    $userID = $userFName = $userLName = $departmentID = "";
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
    header("Location:get_professor_num.php");
}
?>