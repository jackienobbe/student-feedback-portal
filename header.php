<?php session_start(); ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">student feedback portal </a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="search_prof.php">Search Professors</a></li>
      <li><a href="search_course.php">Search Courses</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if(!isset($_SESSION['userID'])): ?>
        <li><a href="create_account.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
      <?php else: ?>
        <li><a href="view_student.php">Hey, Brother. (Student #<?php echo $_SESSION['userID']; ?>)</a></li>
        <li><a href='includes/logout.inc.php'><span <span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
