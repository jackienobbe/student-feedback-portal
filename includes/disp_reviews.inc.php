<?php
//
// disp_reviews.inc.php
//

class ListItems extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return "<td>" . parent::current() . "</td>";
  }
  function beginChildren() {
    echo "<tr>\n";
  }
  function endChildren() {
    echo "</tr>\n";
  }
}

// Connect to database server
include 'db_connect.php';

try {
  $courseID = $_POST['courseID'];
  $professorID = $_POST['professorID'];

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT professorFName, professorLName, courseName
          FROM Professor NATURAL JOIN Section NATURAL JOIN Course
          WHERE professorID = :professorID && courseID = :courseID;";

  $sql .= ";";
  $sth->execute();

  echo "<table>\n";

  // set the resulting array to associative
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v . " ";
  }
  echo "</table>";
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
