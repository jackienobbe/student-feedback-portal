<!DOCTYPE html>
<!--
 search_invoices.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || create student account</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <!-- <script type="text/JavaScript" src="js/popup.js"></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
<div class="container-fluid">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <h2>Create an Account</h2>
    <?php include_once 'includes/create_acct.inc.php';
          include_once 'includes/db_function2.php';?>

    <label>Student ID</label>  <input type="text" name="userID" value="<?php echo $userID;?>" /><br/>
    <label>Password</label>  <input type="password" name="userPassword" value="<?php echo $userPassword;?>" /><br/>
    <label>First Name</label>  <input type="text" name="userFName" value="<?php echo $userFName;?>" /><br/>
    <label>Last Name</label>  <input type="text" name="userLName" value="<?php echo $userLName;?>" /><br/>
    <label>Major</label>  <input type="text" name="major" value="<?php echo $major;?>" /><br/>
    <label>Current Year</label>  <select name="currentYear">
        <option value="freshman">Freshman</option>
        <option value="sophomore">Sophomore</option>
        <option value="junior">Junior</option>
        <option value="senior">Senior</option>
        <option value="superSenior">Super Senior</option>
      </select><br/>

    <input type="submit" value="Create Account" />
    <!-- onclick="return
        checkform_new_student(this.form, this.form.userID, this.form.userPassword,
        this.form.userFName, this.form.userLName, this.form.major, this.form.currentYear);" / -->
  </form>
</div>
</body>
</html>
