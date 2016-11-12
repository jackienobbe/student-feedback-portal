<!DOCTYPE html>
<!--
  view_product.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>spf || view professor</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_prof.inc.php';?>

    <h2>Professor Details</h2>
    <table>
      <tr><td>Invoice Number: </td><td><?php echo $inv_num;?></td></tr>
      <tr><td>Customer Code: </td><td><?php echo $ccode;?></td></tr>
      <tr><td>Date: </td><td><?php echo $date;?></td></tr>
      <tr><td>Amount: </td><td><?php echo $amount;?></td></tr>
    </table>
    <input type="hidden" name="inv_num" value="<?php echo $inv_num;?>" />
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
  </form>
  <p> Back to <a href = "index.html">main page</a>.</p>
</body>
</html>
