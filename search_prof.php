<!DOCTYPE html>
<!--
 search_courses.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || search professors</title>
  <script type="text/JavaScript" src="js/popup.js"></script>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <h2>Professors</h2>
    <?php include_once 'includes/search_prof.inc.php';?>
    <p>Professor Last Name: <input type="text" name="professorLName" value="<?php if ($professorLName == '_all') echo ""; else echo $professorLName;?>" />
    <input type="submit" name="search" value="Search" />
    <input type="submit" name="search" value="All" /></p>

    <?php include_once 'includes/disp_profs.inc.php';?>
    <p>You can now go back to the <a href="index.html">main page</a>.</p>
  </form>


</body>
</html>
