<?php
//
// search_invoices.inc.php
//

$ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
$error_msg = "";
$courseID = "";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  // Get data from form
  if ($_POST['search'] == "Search")
    $courseID = $_POST['courseID'];
  else
    $courseID = "_all";
}
