<!DOCTYPE html>
<!--
  index.html
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || main page </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
<div class="container-fluid">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <h2> Welcome to the Student Feedback Portal!</h2>
    <ul>
	  <li><a href = "login.php"> Login </a></li>
	  <!-- <li><a href = "logout.php">Logout</a></li> -->
	  <!-- <li><a href = "view_course.php">View course</a></li> -->
	  <li><a href = "search_course.php">Search course</a></li>
    <li><a href = "search_prof.php">Search professors</a></li>
    <li><a href = "create_account.php">Create a New account</a></li>

    </ul>
  </form>
</div>
</body>
</html>
