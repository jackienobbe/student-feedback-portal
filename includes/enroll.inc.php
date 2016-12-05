<?php
//
// create_acct.inc.php
//
session_start();
include 'db_connect.php';
include 'db_functions.php';

$error_msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  // Get data from form
  $userID = $_SESSION['userID'];
  $courseID = $_POST['courseID'];
  $sectionNum = 1;
  $semester = $_SESSION['currentSemester'];

  // run sql query
  $rc = enroll_student($userID, $courseID, $sectionNum, $semester, $error_msg);
  echo "after rc";
  if ($rc == 0)
  {
    // Product successfully created; reset fields
    header('Location: ../view_student.php');
  }
}
else
{
  // Set the following variables to initialize
  header('Location: ../view_student.php');
}
