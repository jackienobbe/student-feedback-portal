<!DOCTYPE html>
<!--
 search_courses.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || search courses</title>
  <script type="text/JavaScript" src="js/popup.js"></script>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <h2>Search Courses</h2>
    <?php include_once 'includes/search_course.inc.php';?>
    <p>Course Id: <input type="text" name="courseID" value="<?php if ($courseID=='_all') echo ""; else echo $courseID;?>" />
    <input type="submit" name="search" value="Search" />
    <input type="submit" name="search" value="All" /></p>

    <?php include_once 'includes/disp_courses.inc.php';?>
    <p>You can go back to the <a href="index.html">main page</a>.</p>
  </form>


</body>
</html>
