<?php
//
// disp_reviews.inc.php
//

class EnrollModel
{
    protected $dbh;

    public function __construct(PDO $dbh){
        $this->db = $dbh;
    }

    public function getCoursesToEnroll() {
        return $this->db->query("SELECT courseID, courseName, sectionNum, professorFName, professorLName
                FROM Course NATURAL JOIN Section NATURAL JOIN Professor
                WHERE semester = 'Fall 2016';");
    }
}

// Connect to database server
include 'db_connect.php';

echo "<h3>Enroll in More Classes </h3>";
$enrollModel = new EnrollModel($dbh);
$enrollList = $enrollModel->getCoursesToEnroll();

try {

  echo "<ul>";
  foreach ($enrollList as $enrollRow) {
    echo "<li>" . $enrollRow['courseID'] . "   " . $enrollRow['courseName'] .
    " with " . $enrollRow['professorFName'] . "  " . $enrollRow['professorLName'] .
    " <button type='submit' name='courseID' value='" . $enrollRow['courseID'] .
    "' formaction='includes/enroll.inc.php' formmethod='POST'> Enroll </button></li>";


      // $courseID = $enrollRow['courseID'];
      // $_POST['section'.$courseID] = $enrollRow['sectionNum'];
      // echo $_POST['section'.$courseID];
    }
  echo "</ul>";
  $dbh = null;
//
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
