<?php
//
// get_invoice_number.inc.php
//

$error_msg = "";
$userID = "";

if (isset($_GET["err"]))
{
  // Coming from view_invoice.php or upd_invoice.php or del_invoice.php with error message
  $error_msg = $_GET["err"];
  $userID = $_GET["userID"];
}
