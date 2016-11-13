<?php
// view_course.inc.php
$error_msg = "";
if (isset($_POST["courseID"]))
{
  // Coming from search_prof or get_product_code
  $courseID = $_POST["courseID"];
  $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
  // Read product from database given its code
  $rc = read_course($courseID, $courseName, $departmentName, $error_msg);
  if ($rc != 0)
    // error
    header("Location:" . $ref . "?courseID=" . $courseID . "&err=" . $error_msg);
  // Product read successfully; proceed to display form fields

}
else  // type is GET
{
  $courseID = $courseName = $departmentName = "";
  if (isset($_GET["err"]))
  {
    // We are here because there was an error in either update or delete
    $error_msg = $_GET["err"];
    $courseID = $_GET["courseID"];
  }
  else if (isset($_GET["courseID"]))
    $courseID = $_GET["courseID"];
  else
    // Coming from outside url with product code not provided
    header("Location:get_course_num.php");
}
