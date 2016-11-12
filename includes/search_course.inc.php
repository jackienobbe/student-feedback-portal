<?php
//
// search_invoices.inc.php
//

$ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
$error_msg = "";
$invnum = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Get data from form
  if ($_POST["search"] == "Search")
    $invnum = $_POST["invnum"];
  else
    $invnum = "_all";
}
else if ($ref == "/MyStore/upd_invoice.php")
    echo "<script type='text/javascript'>alert('invoice successfully updated!');</script>";
else if ($ref == "/MyStore/del_invoice.php")
    echo "<script type='text/javascript'>alert('invoice successfully deleted!');</script>";
