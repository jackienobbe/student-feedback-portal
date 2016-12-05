<?php
//
// disp_course_sections_for_prof.inc.php
//
class ListItems extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return parent::current();
  }
  function beginChildren() {
    echo "<li> <button name='sectionNum' type='submit' formaction='view_course_section_reviews.php'
    value='" . parent::current() . "' formmethod='POST'>";
  }
  function endChildren() {
    echo "</button></li>\n";
  }
}

// Connect to database server
include 'db_connect.php';

try {

  $professorID = $_POST['professorID'];
  $courseID = $_POST['courseID'];

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // try a querry, not a procedure
  $sql = "SELECT courseID, sectionNum, courseName, semester
      FROM Section NATURAL JOIN Course
  	WHERE professorID = :professorID
    AND courseID = :courseID;";

  $sth = $dbh->prepare($sql);
  $sth->bindParam(':professorID', $professorID);
  $sth->bindParam(':courseID', $courseID);

  $sth->execute();
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);

  echo "<ul>\n";

  // set the resulting array to associative
  foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v . " ";
  }
  echo "</ul>\n";
  //}
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
