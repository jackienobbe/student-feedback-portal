<!DOCTYPE html>
<!--
view_student.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>sfp || view professor</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <link rel="stylesheet" type="text/css" href="includes/css.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <div class="container-fluid">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <?php include 'includes/db_functions.php';
      include 'includes/view_prof.inc.php';?>

      <h2><?php echo $professorFName . " " . $professorLName;?></h2>
      <label>Department</label>  <?php echo $departmentName ;?><br/>
      <input type="hidden" name="professorID" value="<?php echo $professorID;?>" />
      <input type="hidden" name="ref" value="<?php echo $ref;?>" />

      <h3>Previous Courses</h3>
      <?php include 'includes/disp_courses_of_prof.inc.php';?>

    </form>

  </div>
</body>
</html>
