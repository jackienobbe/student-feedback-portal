<!DOCTYPE html>
<!--
  error.php
-->
<html>
<head>
  <meta charset="UTF-8">
  <title>DB Error</title>
  <style>.error {color: #FF0000;}</style>
</head>
<body>
<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (! $error) {
    $error = 'Oops! An unknown error happened.';
}
?>
  <h2>There was a problem</h2>
  <p class="error"><?php echo $error; ?></p>  
</body>
</html>