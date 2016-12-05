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

  public function getAllChoiceReviews() {
    return $this->db->query('SELECT  courseID, professorID, questionID, offeredAnswerID, answerText, percent
           FROM Question_Answer
  	       NATURAL JOIN OfferedAnswer NATURAL JOIN  Question_Answer_Statistics_By_Course_And_Professor
              ORDER BY courseID, professorID, questionID, offeredAnswerID;');
  }

  public function getAllTextReviews(){
    return $this->db->query('SELECT courseID, professorID, questionID, answer
          FROM Section NATURAL JOIN Enroll NATURAL JOIN Survey NATURAL JOIN Answer_Text
          ORDER BY courseID, professorID, questionID;');
  }

  public function testChoiceReviews(){
    return $this->db->query('SELECT  courseID, professorID
           FROM Question_Answer_Statistics_By_Course_And_Professor
              ORDER BY courseID, professorID, questionID, offeredAnswerID;');
  }

}

  // Connect to database server
  include 'db_connect.php';

  $choiceQuestionModel = new ReviewModel($dbh);
  $choiceQuestionList = $choiceQuestionModel->getChoiceQuestions();

  $textQuestionModel = new ReviewModel($dbh);
  $textQuestionList = $textQuestionModel->getTextQuestions();

  echo "<p class='disclaimer'> DISCLAIMER: Results for instructor ratings refer to past implementations
        of the course. Teachers, methods, and policies may evolve and change for a
        particular course from semester to semester.</p>";
        
  try {
    $courseID = $_POST['courseID'];
    $professorID = $_POST['professorID'];
    echo "<div class='reviewList'>";
    echo "<ul>\n";


    $newReviewModel = new ReviewModel($dbh);
    $testIfReviews = $newReviewModel->testChoiceReviews();

    foreach($testIfReviews as $testRow)
    {
      if($testRow['courseID'] == $courseID &&
        $testRow['professorID'] == $professorID)
        {
          $thereAreReviews = TRUE;
        }
    }

    if($thereAreReviews == TRUE){

      foreach( $choiceQuestionList as $choiceQuestionRow ) {

        echo "<li> " . $choiceQuestionRow['questionText'] ." </li>\n";

        $answerModel = new ReviewModel($dbh);
        $choiceAnswerList = $answerModel->getAllChoiceReviews();


        echo "<table>";
        foreach( $choiceAnswerList as $choiceAnswerRow ){
          if($choiceAnswerRow['courseID'] == $courseID &&
            $choiceAnswerRow['professorID'] == $professorID &&
            $choiceAnswerRow['questionID'] == $choiceQuestionRow['questionID'])
          {
            echo "<tr> <td>" . $choiceAnswerRow['answerText'] . " </td><td> " .
            $choiceAnswerRow['percent'] . "</td></tr> \n";
          }
        }
        echo "</table>";
        echo "</br>";

      }


      foreach( $textQuestionList as $textQuestionRow) {
        $answerModel = new ReviewModel($dbh);
        $textAnswerList = $answerModel->getAllTextReviews();

        echo "<li> " . $textQuestionRow['questionText'] . "<ul style='list-style-type: square' >";

        foreach($textAnswerList as $textAnswerRow){
            if($textAnswerRow['courseID'] == $courseID &&
              $textAnswerRow['professorID'] == $professorID &&
              $textAnswerRow['questionID'] == $textQuestionRow['questionID']){
                echo "<li> \"" . $textAnswerRow['answer'] . "\"</li>";
          }
        }
        echo "</ul></li>";
        echo "</br>";
      }

      echo "</div>";
      $dbh = null;
    }
    else{
      echo "There are no reviews for this course yet.";
    }
    echo "</ul>\n";
  }
  catch(PDOException $e) {
    $dbh = null;
    header("Location: error.php?err=" . $e->getMessage());
  }
