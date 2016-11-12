<!DOCTYPE html>
<!--
 search_invoices.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> Charrafi : Invoices</title>
  <script type="text/JavaScript" src="js/popup.js"></script>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <h2>Invoices</h2>
    <?php include_once 'includes/search_invoices.inc.php';?>
    <p>Invoice Number: <input type="text" name="invnum" value="<?php if ($invnum=='_all') echo ""; else echo $invnum;?>" />
    <input type="submit" name="search" value="Search" onclick="return checkform2(this.form, this.form.invnum);" />
    <input type="submit" name="search" value="All" /></p>

    <?php include_once 'includes/disp_invoices.inc.php';?>
    <p>You can now go back to the <a href="index.html">main page</a>.</p>
  </form>
<!--
<iframe name="myIframe" height="300" width="300" scrolling="auto">
</iframe>
-->
</body>
</html>