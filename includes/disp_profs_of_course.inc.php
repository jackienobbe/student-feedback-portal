<?php
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
     echo "<li> <button name='professorID' type='submit' formaction='view_course_reviews.php'
          value='" . parent::current() . "' formmethod='POST'>";
  }
  function endChildren() {
    echo "</button></li>\n";
  }
}

function profName($professorID, $professorFName, $professorLName) {
    return $professorFName . " " . $professorLName;
}


// Connect to database server
include 'db_connect.php';

try {
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CALL sp_professors_for_a_course( :courseID );";

  $sth = $dbh->prepare($sql);
  $sth->bindParam(':courseID', $courseID);
  $sth->execute();



  echo "<ul>\n";

  // set the resulting array to associative
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v . " "; // ['professorFName'] . " " . $v['professorLName'];
  }
  $sql2 = "SELECT DISTINCT professorFName, professorLName
    FROM Course NATURAL JOIN Section NATURAL JOIN Professor
    WHERE courseID = :courseID;";

  $sth2 = $dbh->prepare($sql2);
  $sth2->bindParam(':courseID', $courseID);
  $sth2->execute();
  foreach(new ListItems(new RecursiveArrayIterator($sth2->fetchAll())) as $k=>$v) {
    echo $v . " ";
  }
  echo "</ul>";
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
