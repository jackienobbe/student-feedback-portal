<?php
//
// disp_reviews.inc.php
//

class ReviewModel
{
    protected $dbh;

    public function __construct(PDO $dbh)
    {
        $this->db = $dbh;
    }

    public function getAllReviews() {
        return $this->db->query('SELECT questionID, offeredAnswerID FROM Question_Answer_Statistics_By_Section');
    }
}

// Connect to database server
include 'db_connect.php';
$reviewModel = new ReviewModel($dbh);
$reviewList = $reviewModel->getAllReviews();

try {
  $courseID = $_POST['courseID'];
  $professorID = $_POST['professorID'];

  // $statement = $dbh->query("SELECT questionID FROM Question_Answer_Statistics_By_Section");
  // $statement->bindParam(':courseID', $courseID);
  // $row = $statement->fetch(PDO::FETCH_ASSOC);
  echo "test";
  echo "<ul>";
  foreach ($reviewList as $row) {
    echo "<li>".$row['questionID'].' - '.$row['offeredAnswerID']."</li>";
  }
  echo "</ul>";
  $dbh = null;
//
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
