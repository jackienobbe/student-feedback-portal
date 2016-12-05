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
    return $this->db->query('SELECT questionID FROM Question');
  }
}

include 'db_connect.php';

$error_msg = ' ';

$questionModel = new ReviewModel($dbh);
$questionList = $questionModel->getAllQuestions();

foreach($questionList as $questionRow)
{
  echo $questionRow['questionID'];

  $surveyID = $_POST['surveyID'];
  $questionID = $_POST['questionID'];
  $offeredAnswerID = $_POST['offeredAnswerID'];

  echo "before rc";
  $rc = submit_survey($surveyID, $questionID, $offeredAnswerID, $error_msg);
  echo "after rc";
  if($rc == 0)
  {
    echo "good werk";

  }
  else echo "oops";
}
