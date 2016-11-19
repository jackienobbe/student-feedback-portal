<?php
// // view_student.inc.php
// $error_msg = "";
// if (isset($_POST["userID"]))
// {
//   // Coming from search_prof or get_product_code
//   $userID = $_POST["userID"];
//   $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
//
//   // Read product from database given its code
//   $rc = get_curr_student_courses($userID, $courseID, $sectionNum, $semester, $courseName, $error_msg);
//   if ($rc != 0)
//     // error
//     header("Location:" . $ref . "?userID=" . $userID . "&err=" . $error_msg);
//   // Product read successfully; proceed to display form fields
// }
// else  // type is GET
// {
//   $userID = $courseID = $sectionNum = $semester = $courseName = "";
//   if (isset($_GET["err"]))
//   {
//     // We are here because there was an error in either update or delete
//     $error_msg = $_GET["err"];
//     $userID = $_GET["userID"];
//   }
//   else if (isset($_GET["userID"]))
//     $userID = $_GET["userID"];
// else
//     // Coming from outside url with product code not provided
//     header("Location:get_student_num.php");
// }

//
// disp_profs.inc.php
//

class ListItems extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return parent::current();
  }
  function beginChildren() {
    //echo "<li> <button name='courseID' type='submit' formaction='view_course.php'
    //      value='" . parent::current() . "' formmethod='POST'>" . parent::current() . "</button>\n";
    echo "<li>" . parent::current();

  }
  function endChildren() {
    echo "</li>\n";
  }
}

// Connect to database server
include_once 'db_connect.php';

try {
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT courseID, sectionNum, semester, courseName
          FROM Enroll NATURAL JOIN Course
          WHERE userID = :userID && semester = :currSemester";

  $sth = $dbh->prepare($sql);
  $sth->bindParam(':userID', $userID);
  $sth->bindParam(':semester', $semester);

  $sth->execute();

  echo "<ul>\n";

  // set the resulting array to associative
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v;
  }
  echo "</ul>";
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
