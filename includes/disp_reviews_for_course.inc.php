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

  // public function getPossibleAnswers($courseID, $professorID) {
  //   $sth = $this->db->prepare('SELECT questionID, offeredAnswerID, answerText, percent
  //          FROM Question_Answer
  // 	       NATURAL JOIN OfferedAnswer NATURAL JOIN  Question_Answer_Statistics_By_Course_And_Professor
  //            WHERE courseID = :courseID
  //            AND professorID = :professorID
  //            GROUP BY questionID ASC, offeredAnswerID ASC');
  //
  //   $sth->bindParam(':courseID', $courseID);
  //   $sth->bindParam(':professorID', $professorID);
  //
  //   return $sth->execute();
  //
  // }

  public function getAllReviews() {
    $sth = $this->db->query('SELECT questionID, offeredAnswerID, answerText, percent
           FROM Question_Answer
  	       NATURAL JOIN OfferedAnswer NATURAL JOIN  Question_Answer_Statistics_By_Course_And_Professor
             GROUP BY questionID ASC, offeredAnswerID ASC');

    return $sth;

    }

  // public function getPossibleAnswers() {
  //   $stmt = $dbh->prepare("SELECT questionID, offeredAnswerID, answerText, percent
  //       FROM Question_Answer
	//       NATURAL JOIN OfferedAnswer NATURAL JOIN  Question_Answer_Statistics_By_Course_And_Professor
  //         WHERE courseID = ?
  //         GROUP BY questionID ASC, offeredAnswerID ASC");
  //
  //     if ($stmt->execute(array($_POST['courseID']))) {
  //       while ($row = $stmt->fetch()) {
  //         print_r($row);
  //       }
  //     }
  //   }

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

    echo "<ul class='reviewList' >\n";
    //$reviewRowCount = $reviewList->rowCount();
    //$questionID = '';
    // $reviewList as $reviewRow;

    foreach( $choiceQuestionList as $choiceQuestionRow ) {

      echo "<li class='reviewList'> " . $choiceQuestionRow['questionText'] ." </li>\n";
      // echo "<ul>\n";

      $answerModel = new ReviewModel($dbh);
      $answerList = $answerModel->getAllReviews();

      // TODO: TEST FOR COURSE AND PROFESSOR TOO
      echo "<table>";
      foreach( $answerList as $answerRow ){
        if($answerRow['questionID'] == $choiceQuestionRow['questionID'])
        {
          echo "<tr> <td>" . $answerRow['answerText'] . " </td><td> " .
          $answerRow['percent'] . "</td></tr> \n";
        }
      }
      echo "</table>";
      echo "</br>";
    }
    foreach( $textQuestionList as $textQuestionRow) {
      echo "<li> " . $textQuestionRow['questionText'] . "</li>";

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
