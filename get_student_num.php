<!DOCTYPE html>
<!--
  get_invoice_number.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> sfp || get student num</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <form>
    <?php include_once 'includes/get_student_num.inc.php';?>

    <h2>Enter an StudentID:</h2>
    <p><span class="error"><?php echo $error_msg;?></span></p>
    Student ID: <input type="text" name="userID" value="<?php echo $userID;?>" />

    <button type="submit" formaction="view_student.php" formmethod="POST"
onclick="return checkform_userID(this.form, this.form.userID);">View</button>

    <input type="reset" />
  <p>Go back to <a href="index.html">main page</a>.</p>
  </form>
</body>
</html>
