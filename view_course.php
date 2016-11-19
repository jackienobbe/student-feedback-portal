<!DOCTYPE html>
<!--
  view_invoice.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || view course</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_course.inc.php';?>
<?php include("header.php"); ?>
<div class="container-fluid">
  <h2>Course Information</h2>
  <p><span class="error"><?php echo $error_msg;?></span></p>
  <form>
    <label>Course ID</label>  <?php echo $courseID;?> <br/>
    <label>Course Name</label>  <?php echo $courseName;?><br/>
    <label>Department</label>  <?php echo $departmentName;?><br/>
    <input type="hidden" name="courseID" value="<?php echo $courseID;?>" />
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
  </form>
</div>
</body>
</html>
