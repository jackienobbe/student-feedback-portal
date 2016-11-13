<!DOCTYPE html>
<!--
  login.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || login</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/login.inc.php'; ?>

    <h2>Login</h2>
    <p><span class="error"><?php echo $error_msg;?></span></p>
    <p>Student Id: <input type="text" name="userID" value="<?php echo $userID;?>" /></p>
    <p>Password:   <input type="password" name="userPassword" value="<?php echo $userPassword;?>" /></p>
    <button type="submit" formaction="view_student.php" formmethod="POST"
      onclick="return checkform_login(this.form, this.form.userID, this.form.userPassword);">Login</button>

    <input type="reset" />
  <p>Go back to <a href="index.html">main page</a>.</p>
  </form>
</body>
</html>
