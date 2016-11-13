<!DOCTYPE html>
<!--
 search_invoices.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || create student account</title>
  <script type="text/JavaScript" src="js/popup.js"></script>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <h2>Create an Account</h2>
    //doesn't make it past this statement
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/create_acct.inc.php';?>

    <p>Student ID: <input type="text" name="userID" value="<?php echo $userID;?>" /></p>
    <p>Password: <input type="text" name="userPassword" value="<?php echo $userPassword;?>" /></p>
    <p>Major: <input type="text" name="major" value="<?php echo $major;?>" /></p>
    <p>Current Year: <select name="currentYear">
        <option value="freshman">Freshman</option>
        <option value="sophomore">Sophomore</option>
        <option value="junior">Junior</option>
        <option value="senior">Senior</option>
        <option value="superSenior">Super Senior</option>
      </select></p>

    <input type="submit" name="submit" value="Create Account" onclick="return
        checkform_new_student(this.form, this.form.userID, this.form.userPassword,
        this.form.major, this.form.currentYear);" />
  </form>
  <p>You can go back to the <a href="index.html">main page</a>.</p>

</body>
</html>
