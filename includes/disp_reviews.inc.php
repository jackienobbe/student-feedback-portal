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

  public function getChoiceQuestions() {
    return $this->db->query('SELECT questionID, questionText FROM Question WHERE answerTypeID = 2');
  }

  public function getTextQuestions() {
    return $this->db->query('SELECT questionID, questionText FROM Question WHERE answerTypeID = 1');
  }

  public function getPossibleAnswers() {
    return $this->db->query('SELECT questionID, offeredAnswerID, answerText
      FROM OfferedAnswer NATURAL JOIN Question_Answer 
      ORDER BY questionID ASC, offeredAnswerID ASC ');
    }
  }
  // Connect to database server
  include 'db_connect.php';

  $choiceQuestionModel = new ReviewModel($dbh);
  $choiceQuestionList = $choiceQuestionModel->getChoiceQuestions();

  $textQuestionModel = new ReviewModel($dbh);
  $textQuestionList = $textQuestionModel->getTextQuestions();

  // $reviewModel = new ReviewModel($dbh);
  // $reviewList = $reviewModel->getAllReviews();

  try {

    $courseID = $_POST['courseID'];
    $professorID = $_POST['professorID'];

    echo "<ul>\n";
    //$reviewRowCount = $reviewList->rowCount();
    //$questionID = '';
    // $reviewList as $reviewRow;

    foreach( $choiceQuestionList as $choiceQuestionRow ) {

      echo "<li> " . $choiceQuestionRow['questionText'] ." </li>\n";
      // echo "<ul>\n";

      $answerModel = new ReviewModel($dbh);
      $answerList = $answerModel->getPossibleAnswers();

      echo "<table>";
      foreach( $answerList as $answerRow ){
        if($answerRow['questionID'] == $choiceQuestionRow['questionID'])
        {
          echo "<tr> <td>" . $answerRow['answerText'] . " </td><td> " .
          $answerRow['statistics'] . "</td></tr> \n";
        }
      }
      echo "</table>";
    }
    foreach( $textQuestionList as $textQuestionRow) {
      echo "<li> " . $textQuestionRow['questionText'] . "</li>"
        . "<textarea name=" . $textQuestionRow['questionID'] . " style='height=65 width=450'> </textarea>";
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
