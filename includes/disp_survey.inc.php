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

	public function getAllAnswers() {
		return $this->db->query('SELECT questionID, offeredAnswerID, answerText
			FROM OfferedAnswer NATURAL JOIN Question_Answer
			ORDER BY questionID ASC, offeredAnswerID ASC ');
		}
	}

	// Connect to database server
	include 'db_connect.php';

	$questionModel = new ReviewModel($dbh);
	$questionList = $questionModel->getAllQuestions();

	try {

		$courseID = $_POST['courseID'];
		$professorID = $_POST['professorID'];

		echo "<ul>\n";
		foreach( $questionList as $questionRow ) {

			echo "<li> " . $questionRow['questionText'] ." </li>\n";

			$reviewModel = new ReviewModel($dbh);
			$reviewList = $reviewModel->getAllAnswers();

			echo "<table>";
			foreach( $reviewList as $reviewRow ){
				if($reviewRow['questionID'] == $questionRow['questionID'])
				{
					echo "<tr><td><input type='radio' name=" . $reviewRow['questionID'] .
					" value=" . $reviewRow['offeredAnswerID'] . "/> </td><td> " .
					$reviewRow['answerText'] . " </td></tr> \n";
				}
				echo "</table>";
			}
		}
		echo "</ul>\n";
		echo "<input type='submit'>";

		$dbh = null;
	}
	catch(PDOException $e) {
		$dbh = null;
		header("Location: error.php?err=" . $e->getMessage());
	}
