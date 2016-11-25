<?php
//
// disp_profs.inc.php
//

// Connect to database server
include 'db_connect.php';

$error_msg = "";

if (isset($_POST['professorID']) && isset($_POST['courseID']))
{

  $professorID = $_POST['professorID'];
  $courseID = $_POST['courseID'];

  // Read product from database given its code
  $rc = read_course_prof_info($professorID, $courseID, $professorFName, $professorLName, $courseName, $error_msg);

  if ($rc != 0)
    // error
    header("Location:" . $ref . "?courseID=" . $courseID . "&err=" . $error_msg);
}
