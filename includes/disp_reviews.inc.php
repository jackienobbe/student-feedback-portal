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
  $sql = "SELECT courseID, courseName FROM Course WHERE courseID = :courseID;";
  $sth = $dbh->prepare($sql);
  $sth->bindParam(':courseID', $courseID);
  $sth->execute();
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);

  if(count($result) > 1)
  {
    echo "<table>\n";

    // set the resulting array to associative
    foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
      echo $v . " ";
    }
    echo "</table>\n";
  }
  else {
    echo "<p>There aren't any reviews for this course by this professor yet...</p>\n";
    if(isset($_SESSION['userID']))
    {
      echo "<p>Taking this course this semester? <a href='#'> Enroll and add a review!</a></p>\n";
    }
  }
  $dbh = null;
  
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
