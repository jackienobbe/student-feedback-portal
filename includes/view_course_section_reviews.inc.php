<?php
//
// disp_profs.inc.php
//

// Connect to database server
include 'db_connect.php';

$error_msg = "";

if (isset($_POST['professorID']) && isset($_POST['courseID']) && isset($_POST['sectionNum']))
{

  $professorID = $_POST['professorID'];
  $courseID = $_POST['courseID'];
  $sectionNum = $_POST['sectionNum'];

  $rc = read_course_section_prof_info($professorID, $courseID, $sectionNum, $semester, $professorFName, $professorLName, $courseName, $error_msg);

  if ($rc != 0)
    // error
    header("Location:" . $ref . "?courseID=" . $courseID . "&err=" . $error_msg);
}
