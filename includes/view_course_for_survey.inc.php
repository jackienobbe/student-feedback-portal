<?php
// view_course_for_survey.inc.php

include 'db_connect.php';

$error_msg = "";
if (isset($_POST["surveyID"]))
{
  // Coming from search_prof or get_product_code
  $surveyID = $_POST["surveyID"];

  $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);

  // Read product from database given its code
  $rc = read_survey_details($surveyID, $courseID, $courseName, $error_msg);

  if ($rc != 0)
    // error
    header("Location:" . $ref . "?surveyID=" . $surveyID . "&err=" . $error_msg);
  // Product read successfully; proceed to display form fields

}
