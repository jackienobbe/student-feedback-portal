<!DOCTYPE html>
<!--
index.html
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || welcome </title>
  <link rel="stylesheet" type="text/css" href="includes/css.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <div class="container-fluid">

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
      <h2> You are logged in!</h2>
      <ul>
        <li><a href = "index.html">Go the index.</a></li>
        <li><a href = "view_student.php">View my profile.</a></li>
        <!-- <li><? echo $_SESSION['userID']; ?></li> -->
        <li><a href = "includes/logout.inc.php">Logout</a></li>

        <?php include 'includes/db_functions.php'; ?>
        <!-- //include_once 'includes/view_student.inc.php';?> -->
        <!-- <input type="hidden" name="userID" value="<?php echo $_SESSION['userID'];?>" /> -->
        <input type="hidden" name="ref" value="<?php echo $ref;?>" />
      </form>
    </ul>
  </form>
</div>
</body>
</html>
