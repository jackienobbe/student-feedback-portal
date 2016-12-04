<!DOCTYPE html>
<!--
 search_courses.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || search courses</title>
  <script type="text/JavaScript" src="js/popup.js"></script>
  <link rel="stylesheet" type="text/css" href="includes/css.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <div class="container-fluid">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <h2>Search Courses</h2>
    <?php include_once 'includes/search_course.inc.php';?>
    <label>Course Id</label>  <input type="text" name="courseID" value="<?php if ($courseID=='_all') echo ""; else echo $courseID;?>" />
    <input type="submit" name="search" value="Search" />
    <input type="submit" name="search" value="All" />

    <?php include_once 'includes/disp_courses.inc.php';?>

  </form>
</div>

</body>
</html>
