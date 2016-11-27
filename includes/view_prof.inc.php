<?php
// view_prof.inc.php

$error_msg = "";
if (isset($_POST["professorID"]))
{
  // Coming from search_prof or get_product_code
  $professorID = $_POST["professorID"];

  $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
  // Read product from database given its code
  $rc = read_prof($professorID, $professorFName, $professorLName, $departmentName, $error_msg);

  if ($rc != 0)
    // error
    header("Location:" . $ref . "?professorID=" . $professorID . "&err=" . $error_msg);
  // Product read successfully; proceed to display form fields
}
else  // type is GET
{
    // Coming from outside url with product code not provided
    header("Location:search_prof.php");
}
