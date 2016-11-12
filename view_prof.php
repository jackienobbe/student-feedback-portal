<!DOCTYPE html>
<!--
  view_student.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>spf || view Professor</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_prof.inc.php';?>
		  
    <h2>Professor Details</h2>
    <table>
      <tr><td>Professor Name: </td><td><?php echo $userFName + $userLName;?></td></tr>
      <tr><td>Department Id </td><td><?php echo $departmentID ;?></td></tr>
    </table>
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
  </form>
  <p> Back to <a href = "index.html">main page</a></p>
</body>
</html>