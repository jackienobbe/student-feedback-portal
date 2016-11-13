<!DOCTYPE html>
<!--
  view_student.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>spf || view professor</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <h2>Professor Details</h2>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_prof.inc.php';?>
    <table>
      <tr><td>Professor Name: </td><td><?php echo $professorFName . " " . $professorLName;?></td></tr>
      <tr><td>Department: </td><td><?php echo $departmentName ;?></td></tr>
    </table>
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
  </form>
  <p> Back to <a href = "index.html">main page</a></p>
</body>
</html>
