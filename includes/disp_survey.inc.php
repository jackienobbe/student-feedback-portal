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

	try {
		$choiceQuestionModel = new ReviewModel($dbh);
		$choiceQuestionList = $choiceQuestionModel->getChoiceQuestions();

		$textQuestionModel = new ReviewModel($dbh);
		$textQuestionList = $textQuestionModel->getTextQuestions();

		echo "<div class='reviewList'>";
		echo "<ul>\n";
		foreach( $choiceQuestionList as $choiceQuestionRow ) {

			echo "<li> " . $choiceQuestionRow['questionText'] ." </li>\n";

			$reviewModel = new ReviewModel($dbh);
			$reviewList = $reviewModel->getPossibleAnswers();

			echo "<table class='survey'>";
			foreach( $reviewList as $reviewRow ){
				if($reviewRow['questionID'] == $choiceQuestionRow['questionID'])
				{
					echo "<tr><td><input type='radio' name=" . $reviewRow['questionID'] .
					" value='" . $reviewRow['offeredAnswerID'] . "'/> </td><td> " .
					$reviewRow['answerText'] . " </td></tr> \n";
				}
			}
			echo "</table>";
		}
		foreach( $textQuestionList as $textQuestionRow) {
echo "<br/>";
			echo "<li> " . $textQuestionRow['questionText'] . "</li>"
			. "<textarea name=" . $textQuestionRow['questionID'] . "> </textarea>";
		}
		echo "</ul>\n";
		echo "<input type='submit' formaction='includes/submit_survey.inc.php' formmethod='POST'>";
		echo "</div>";

		$dbh = null;
	}
	catch(PDOException $e) {
		$dbh = null;
		header("Location: error.php?err=" . $e->getMessage());
	}
