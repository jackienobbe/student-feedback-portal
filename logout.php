<!DOCTYPE html>
<!--
  login.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> Charrafi: View Invoice</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <div class="container-fluid">
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_invoice.inc.php';?>

    <h2>View an Invoice</h2>

  </form>
</div>
</body>
</html>
