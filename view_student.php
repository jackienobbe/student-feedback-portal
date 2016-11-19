<!DOCTYPE html>
<!--
  view_student.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>spf || view student</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_student.inc.php';
          include_once 'includes/view_student_curr_courses.inc.php';?>

    <h2>Student Details</h2>
    <table>
      <tr><td>Student Name: </td><td><?php echo $userFName . " " . $userLName;?></td></tr>
      <tr><td>Major: </td><td><?php echo $major;?></td></tr>
	    <tr><td>Student Id: </td><td><?php echo $userID;?></td></tr>
      <tr><td>Year: </td><td><?php echo $currentYear;?></td></tr>
    </table>

    <h2>Current Classes</h2>

    <?php $_POST["71007"]; ?>
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
  </form>
  <p> Back to <a href = "index.html">main page</a>.</p>
</body>
</html>
