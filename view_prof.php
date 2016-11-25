<!DOCTYPE html>
<!--
  view_student.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>sfp || view professor</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <div class="container-fluid">
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_prof.inc.php';?>

    <h2><?php echo $professorFName . " " . $professorLName;?></h2>
    <label>Department</label>  <?php echo $departmentName ;?><br/>
    <input type="hidden" name="professorID" value="<?php echo $professorID;?>" />
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />

  </br>
    <label>Previous Courses</label>
    <?php include_once 'includes/disp_reviews.inc.php';?>

  </form>

</div>
</body>
</html>
