<?php
// view_student.inc.php

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
    echo "<li>";

  }
  function endChildren() {
    echo "</li>\n";
  }
}

// Connect to database server
include 'db_connect.php';

try {
  $userID = $_SESSION['userID'];
  $currSemester = $_SESSION['currentSemester'];

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // needs surveyID shtuff (add it to the front of the query)
  $sql = "SELECT courseID, sectionNum, semester, courseName
	        FROM Enroll NATURAL JOIN Course NATURAL JOIN System_User
	        WHERE userID = :userID && semester != :currSemester";

  $sth = $dbh->prepare($sql);
  $sth->bindParam(':userID', $userID);
  $sth->bindParam(':currSemester', $currSemester);

  $sth->execute();

  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);

  if(count($result) != 0)
  {
    echo "<h3>Previous Courses</h3>";
    echo "<ul>\n";

    // set the resulting array to associative
    foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
      echo $v . " ";
    }
    echo "</ul>";
    $dbh = null;
  }
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
