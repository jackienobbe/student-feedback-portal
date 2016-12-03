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
    return $this->db->query('SELECT questionID, questionText FROM Question WHERE answerTypeID = 2');
  }

  public function getReviewForQuestion( int $inQuestionID ) {
    // $qID = $inQuestionID;
    // return $this->db->query('SELECT questionID, offeredAnswerID, answerText
    //  FROM OfferedAnswer NATURAL JOIN Question_Answer WHERE questionID = $qID
    //  ORDER BY questionID ASC, offeredAnswerID ASC '); // ->bindParam(':inQuestionID', $qID);
    // $sql = ('SELECT questionID, offeredAnswerID, answerText
    //   FROM OfferedAnswer NATURAL JOIN Question_Answer WHERE questionID = :qID
    //   ORDER BY questionID ASC, offeredAnswerID ASC');
    //
    //   $sth = $this->db->prepare($sql);
    //   $sth->bindParam(':qID', $qID);
      return $sth->execute();

    }

    public function getAllReviews() {
      return $this->db->query('SELECT questionID, offeredAnswerID, answerText
        FROM OfferedAnswer NATURAL JOIN Question_Answer
       ORDER BY questionID ASC, offeredAnswerID ASC ');
      }
    }
    // Connect to database server
    include 'db_connect.php';

    $questionModel = new ReviewModel($dbh);
    $questionList = $questionModel->getAllQuestions();

    // $reviewModel = new ReviewModel($dbh);
    // $reviewList = $reviewModel->getAllReviews();

    try {

      $courseID = $_POST['courseID'];
      $professorID = $_POST['professorID'];

      echo "<ul>\n";
      //$reviewRowCount = $reviewList->rowCount();
      //$questionID = '';
      // $reviewList as $reviewRow;

      foreach( $questionList as $questionRow ) {

        echo "<li> " . $questionRow['questionText'] ." </li>\n";
        echo "<ul>\n";

        $reviewModel = new ReviewModel($dbh);
        $reviewList = $reviewModel->getAllReviews();

        foreach( $reviewList as $reviewRow ){
          // echo "<li> " . $reviewRow['answerText'] . " </li> \n";
          if($reviewRow['questionID'] == $questionRow['questionID'])
          {
            echo "<li> " . $reviewRow['answerText'] . " </li> \n";
          }
        }
        echo "</ul>\n";
        unset($reviewModel);
        unset($reviewRow);
      }
      echo "</ul>\n";

      //   else {
      //     echo "<p>There aren't any reviews for this course by this professor yet...</p>\n";
      //     if(isset($_SESSION['userID']))
      //     {
      //       echo "<p>Taking this course this semester? <a href='#'> Enroll and add a review!</a></p>\n";
      //     }
      //   }
      $dbh = null;
      //
    }
    catch(PDOException $e) {
      $dbh = null;
      header("Location: error.php?err=" . $e->getMessage());
    }
