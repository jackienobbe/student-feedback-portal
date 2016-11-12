<!DOCTYPE html>
<!--
  view_student.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>spf || view student</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_student.inc.php';?>

    <h2>Student Details</h2>
    <table>
      <tr><td>Student Name: </td><td><?php echo $userFName + $userLName;?></td></tr>
      <tr><td>Major: </td><td><?php echo $major;?></td></tr>
      <tr><td>Year: </td><td><?php echo $currentYear;?></td></tr>
    </table>

    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
  </form>
  <p> Back to <a href = "index.html">main page</a>.</p>
</body>
</html>
