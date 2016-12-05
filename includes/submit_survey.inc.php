<?php
// submit_survey.inc.php
//
class ReviewModel
{
  protected $dbh;

  public function __construct(PDO $dbh)
  {
    $this->db = $dbh;
  }

  public function getAllQuestions() {
    return $this->db->query('SELECT questionID FROM Question ORDER BY questionID');
  }

  public function getChoiceQuestions() {
		return $this->db->query('SELECT questionID, questionText FROM Question WHERE answerTypeID = 2');
	}

	public function getTextQuestions() {
		return $this->db->query('SELECT questionID, questionText FROM Question WHERE answerTypeID = 1');
	}
}

include 'db_connect.php';
include 'db_functions.php';

$error_msg = "";

$choiceQuestionModel = new ReviewModel($dbh);
$choiceQuestionList = $choiceQuestionModel->getChoiceQuestions();

foreach($choiceQuestionList as $choiceQuestionRow)
{
  // echo $choiceQuestionRow['questionID'] . "\n";
  $surveyID = $_POST['surveyID'];
  $questionID = $choiceQuestionRow['questionID'];
  $offeredAnswerID = $_POST[$questionID] . '';

  $offeredAnswerID = rtrim( $offeredAnswerID, '/' );

  $rc = submit_survey_choice($surveyID, $questionID, $offeredAnswerID, $error_msg);
  if($rc != 0)
  {
    echo "not good";
  }
}

$textQuestionModel = new ReviewModel($dbh);
$textQuestionList = $textQuestionModel->getTextQuestions();

foreach($textQuestionList as $textQuestionRow)
{
  $surveyID = $_POST['surveyID'];
  $questionID = $textQuestionRow['questionID'];
  $offeredAnswerID = $_POST[$questionID];

  $rc = submit_survey_text($surveyID, $questionID, $offeredAnswerID, $error_msg);
  if($rc == 0)
  {
    header('Location: ../view_student.php');
  }
}
