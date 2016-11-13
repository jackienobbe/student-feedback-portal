<!DOCTYPE html>
<!--
  index.html
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || welcome </title>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <h2> You are logged in!</h2>
    <ul>
      <li><a href = "index.html">Go the index.</a></li>
      <li><a href = "view_student.php">View my profile.</a></li>
      <li><?php echo $_SESSION["userID"]; ?></li>

        <?php include_once 'includes/db_functions.php';
              include_once 'includes/view_student.inc.php';?>
        <input type="hidden" name="userID" value="<?php echo $userID;?>" />
        <input type="hidden" name="ref" value="<?php echo $ref;?>" />
      </form>
    </ul>
  </form>
</body>
</html>
