<?php
//
// search_prof.inc.php
//

$ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
$error_msg = "";
$professorLName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Get data from form
  if ($_POST["search"] == "Search")
    $professorLName = $_POST["professorLName"];
  else
    $professorLName = "_all";
}
