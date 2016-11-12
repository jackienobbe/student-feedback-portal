<!DOCTYPE html>
<!--
  view_invoice.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> Charrafi: View Invoice</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
  <form>
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_invoice.inc.php';?>

    <h2>View an invoice</h2>
    <p><span class="error"><?php echo $error_msg;?></span></p>
    <table>
      <tr><td>Invoice number: </td><td><?php echo $invnum;?></td></tr>
      <tr><td>Customer code: </td><td><?php echo $cuscode;?></td></tr>
      <tr><td>Date: </td><td><?php echo $date;?></td></tr>
      <tr><td><button type="submit" formaction="upd_invoice.php" formmethod="POST" >Update</button>
              <button type="submit" formaction="del_invoice.php" formmethod="POST" >Delete</button></td><td></td></tr>
    </table>
    <input type="hidden" name="invnum" value="<?php echo $invnum;?>" />
    <input type="hidden" name="ref" value="<?php echo $ref;?>" />
    <p>You can now go back to the <a href="index.html">main page</a>.</p>
  </form>
</body>
</html>