<!DOCTYPE html>
<!--
  login.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || login</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <?php include("header.php"); ?>

<div class="container-fluid">
  <form action="includes/login.inc.php" method="POST">
    <?php include_once 'includes/db_functions.php';
          //include_once 'includes/login.inc.php'; ?>

    <h2>Login</h2>
    <p><span class="error"><?php echo $error_msg;?></span></p>
    <label>Student Id </label>  <input type="text" name="userID" value="<?php echo $userID;?>" /></br>
    <label>Password </label>  <input type="password" name="userPassword" value="<?php echo $userPassword;?>" /></br>
    <button type="submit">Login</button>
  </form>
</div>
</body>
</html>
