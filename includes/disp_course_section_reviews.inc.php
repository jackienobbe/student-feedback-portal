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

    public function getAllQuestions() {
        return $this->db->query('SELECT questionID, questionText FROM Question');
    }

    public function getAllReviews() {
        return $this->db->query('SELECT questionID, offeredAnswerID FROM Question_Answer_Statistics_By_Section');
    }
}

// Connect to database server
include 'db_connect.php';
$questionModel = new ReviewModel($dbh);
$questionList = $reviewModel->getAllQuestions();

$questionModel = new ReviewModel($dbh);
$reviewList = $reviewModel->getAllReviews();

try {
  $courseID = $_POST['courseID'];
  $professorID = $_POST['professorID'];

  // $statement = $dbh->query("SELECT questionID FROM Question_Answer_Statistics_By_Section");
  // $statement->bindParam(':courseID', $courseID);
  // $row = $statement->fetch(PDO::FETCH_ASSOC);

  echo "<ul>";
  $questionID = '';
  foreach ($questionList as $row) {
    echo "<li> " . $row['questionText']." </li>\n";
    // echo "<ul>";
    // while($row['questionID'] == $questionID){
    //   foreach($reviewList as $reviewRow){
    //     echo "<li> " . $reviewRow['answerText'] . " </li> \n";
    //   }
    // }
    // echo "</ul>";
    // $questionID += 1;
  }
  echo "</ul>";

  $dbh = null;
//
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
