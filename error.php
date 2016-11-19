<!DOCTYPE html>
<!--
  error.php
-->
<html>
<head>
  <meta charset="UTF-8">
  <title>DB Error</title>
  <style>.error {color: #FF0000;}</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
<div class="container-fluid">
  <?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (! $error) {
    $error = 'Oops! An unknown error happened.';
}
?>
  <h2>There was a problem</h2>
  <p class="error"><?php echo $error; ?></p>

</div>
</body>
</html>
