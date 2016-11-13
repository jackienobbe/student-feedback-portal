<?php
 ob_start();
 session_start();
 include_once 'dbconnect.php';

 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['userID'])!="" ) {
  header("Location: view_student.php");
  exit;
 }

 //taking stuff from the internet. Add it here.
