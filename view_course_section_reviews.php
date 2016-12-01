<!DOCTYPE html>
<!--
  view_student.php
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>sfp || view course reviews</title>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("header.php"); ?>
  <div class="container-fluid">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <?php include_once 'includes/db_functions.php';
          include_once 'includes/view_course_section_reviews.inc.php';?>

    <h2><?php echo $courseID . " // " . $courseName; ?></h2>
    <label>Taught by</label>  <?php echo $professorFName . " " . $professorLName;?><br/>
    <label>Semester of</label>  <?php echo $semester; ?><br/>

    <input type="hidden" name="courseID" value="<?php echo $courseID;?>" />
    <input type="hidden" name="professorID" value="<?php echo $professorID;?>" />
    <input type="hidden" name="sectionNum" value="<?php echo $sectionNum;?>" />

    <input type="hidden" name="ref" value="<?php echo $ref;?>" />

    <h3>Section Reviews</h3>
    <?php include 'includes/disp_course_section_reviews.inc.php'; ?>

    <h3>View Reviews of Other Sections for this Course and Professor</h3>
    <?php include 'includes/disp_course_sections_for_prof.inc.php'; ?>
    
    <h3>Other Courses by this Professor</h3>
    <?php include 'includes/disp_courses_of_prof.inc.php'; ?>
  </form>

</div>
</body>
</html>
