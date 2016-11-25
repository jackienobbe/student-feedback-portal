<!DOCTYPE html>
<!--
 search_prof.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || search professors</title>
  <script type="text/JavaScript" src="js/popup.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <div class="container-fluid">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <h2>Search Professors</h2>
    <?php include_once 'includes/search_prof.inc.php';?>
    <label>Professor Last Name</label>  <input type="text" name="professorLName" value="<?php if ($professorLName == '_all') echo ""; else echo $professorLName;?>" />
    <input type="submit" name="search" value="Search" />
    <input type="submit" name="search" value="All" />

    <?php include_once 'includes/disp_profs.inc.php';?>

  </form>
</div>

</body>
</html>
