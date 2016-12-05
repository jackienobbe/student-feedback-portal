<?php
// submit_survey.inc.php
//


include 'db_connect.php';

$error_msg = ' ';
foreach($questionList as $questionRow)
{
  $surveyID = $_POST['surveyID'];
  $questionID = $_POST['questionID'];
  $offeredAnswerID = $_POST['offeredAnswerID'];

  $rc = submit_survey($surveyID, $questionID, $offeredAnswerID, $error_msg);
  if($rc == 0)
  {
    echo "good werk";
  }
  else echo "oops";
}
