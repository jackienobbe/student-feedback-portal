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
    <?php include 'includes/db_functions.php';
          include 'includes/view_student.inc.php'; ?>

    <h2><?php echo $userFName . " " . $userLName ?></h2>
      <label> Major </label><?php echo $major;?>
	    <label>Student Id </label><?php echo $userID;?>
      <label>Year </label><?php echo $currentYear;?>
    </table>

    <h3>Current Classes</h3>
    <?include_once 'includes/view_student_curr_courses.inc.php';?>

    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
  </form>
</body>
</html>
