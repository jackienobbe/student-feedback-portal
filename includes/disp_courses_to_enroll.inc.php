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
        return $this->db->query("SELECT courseID, courseName, sectionNum
                FROM Course NATURAL JOIN Section
                WHERE semester = 'Fall 2016';");
    }
}

// Connect to database server
include 'db_connect.php';

echo "<h3>Enroll in More Classes </h3>";
$enrollModel = new EnrollModel($dbh);
$enrollList = $enrollModel->getCoursesToEnroll();

try {
  $courseID = $_POST['courseID'];
  $professorID = $_POST['professorID'];

  echo "<ul>";
  foreach ($enrollList as $enrollRow) {
    echo "<li>" . $enrollRow['courseID'] . " - " . $enrollRow['courseName'] .
    "<button type='submit'>Enroll</button>"."</li>";
  }
  echo "</ul>";
  $dbh = null;
//
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
