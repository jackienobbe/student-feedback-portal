<?php
// view_student.inc.php

class ListItems extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    $courseID = parent::current();
    return parent::current();
  }
  function beginChildren() {
    echo "<li> <button name='surveyID' type='submit' formaction='view_survey.php'
    value='" . parent::current() . "' formmethod='POST'>\n";
    // echo "<li> ";

  }
  function endChildren() {
    echo "</button></li>\n";
  }
}

// Connect to database server
include 'db_connect.php';

try {
  $userID = $_SESSION['userID'];
  $currSemester = $_SESSION['currentSemester'];

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // needs surveyID shtuff (add it to the front of the query)
  $sql = "SELECT surveyID, courseID, courseName
  FROM Enroll NATURAL JOIN Course NATURAL JOIN Survey
  WHERE userID = :userID && semester = :currSemester;";

  $sth = $dbh->prepare($sql);
  $sth->bindParam(':userID', $userID);
  $sth->bindParam(':currSemester', $currSemester);

  $sth->execute();
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);

  $counter = 0;

  echo "<ul>\n";

  // set the resulting array to associative
  foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v . " ";
    $counter++;
  }
  echo "</ul>";
  $dbh = null;
  if($counter == 0) {
    echo "<p>Hmm... you don't appear to be in any courses this semester.</p>";
  }

  header("Location:" . $ref . "?userID=" . $userID . "&err=" . $error_msg);
  // Product read successfully; proceed to display form fields

}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
