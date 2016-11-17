<!DOCTYPE html>
<!--
  view_invoice.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || view course</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_course.inc.php';?>

    <h2>Course Information</h2>
    <p><span class="error"><?php echo $error_msg;?></span></p>

    Course Id: <?php echo $courseID;?> <br/>
    Course Name: <?php echo $courseName;?><br/>
    Department: <?php echo $departmentName;?><br/>
    <input type="hidden" name="courseID" value="<?php echo $courseID;?>" />
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
    <p>Or, go back to the <a href="index.html">main page</a>.</p>
  </form>
</body>
</html>
