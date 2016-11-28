<?php
//
// disp_courses_to_enroll.inc.php
//

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return //"<td>" .
    parent::current() . " "
    //. "</td>"
    ;
  }
  function beginChildren() {
    //echo "<tr>\n";
  }
  function endChildren() {
    echo "<br/>";
    // echo "<td><button name='enroll' formaction='enroll_student.inc.php'>Enroll</button> </td>" .
    // //<button name='ccode' type='submit' formaction='enroll_student.inc.php'
    // //value='" . parent::current() . "' formmethod='POST'>Enroll</button></td>
    // "</tr>\n";
  }
}

// Connect to database server
include 'db_connect.php';

try {
  $userID = $_SESSION['userID'];
  $currSemester = $_SESSION['currentSemester'];

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT courseID, courseName, professorFName, professorLName, Course.departmentID
          FROM Course NATURAL JOIN Section NATURAL JOIN Professor
          WHERE semester = :currSemester && courseID
          NOT IN (SELECT courseID FROM Enroll WHERE (userID = :userID && semester = :currSemester))
          ORDER BY Course.departmentID, Course.courseID;";

  $sth = $dbh->prepare($sql);
  $sth->bindParam(':userID', $userID);
  $sth->bindParam(':currSemester', $currSemester);

  $sth->execute();

  //echo "<table>\n";
  //echo "<tr><th>Course ID</th><th>Course Name</th><th>Professor</th><th></th><th>Department</th><th></th></tr>\n";


  // set the resulting array to associative
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);
  $result->array();
  $curId = '';       // track working id
  $firstDiv = true;  // track if inside first div

  // open first div
  echo '<div>';
  echo "HIII " . $result->$courseID . "</br>";
  // foreach $row
  foreach(new TableRows(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v)
  {
    // when id changes, transition to new div, except when in first div
    if ($result->$departmentID != $curId) {
      if ($firstDiv) {
        $firstDiv = false;
      } else {
        echo 'hey';
        // start new div
        echo '</div>';
        echo '<div>';
      }
      $curId = $result->$departmentID;  // track new current id
    }

    // display contents of current row
    echo $v;
  }
  // close last div
  echo '</div>';

  //echo "</table>";
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
