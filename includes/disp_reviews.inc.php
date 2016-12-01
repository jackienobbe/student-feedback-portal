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

  public function getAllReviews() {
    return $this->db->query('SELECT questionID, offeredAnswerID, answerText
      FROM OfferedAnswer NATURAL JOIN Question_Answer
      ORDER BY questionID ');
    }
  }


  // Connect to database server
  include 'db_connect.php';

  $questionModel = new ReviewModel($dbh);
  $questionList = $questionModel->getAllQuestions();

  $reviewModel = new ReviewModel($dbh);
  $reviewList = $reviewModel->getAllReviews();

  try {
    $courseID = $_POST['courseID'];
    $professorID = $_POST['professorID'];

    // $statement = $dbh->query("SELECT questionID FROM Question_Answer_Statistics_By_Section");
    // $statement->bindParam(':courseID', $courseID);
    // $row = $statement->fetch(PDO::FETCH_ASSOC);

    // foreach( $reviewList as $reviewRow ){
    //   if( $reviewRow['questionID'] == $questionRow['questionID'] ){
    //     echo "<li> " . $reviewRow['answerText'] . " " . $reviewRow['questionID'] . " </li> \n";
    //   }
    // }
    echo "<ul>\n";
    $reviewRowCount = $reviewList->rowCount();
    $questionID = '';
    // $reviewList as $reviewRow;

    foreach( $questionList as $questionRow ) {
      echo "<li> " . $questionRow['questionText']." </li>\n";
      echo "<ul>\n";

      //$questionID = $questionRow['questionID'];

      foreach( $reviewList as $reviewRow ){
        // for( $i = 0; $i < $reviewRowCount; $i++ ){
        //echo "yoho!";

        if( $reviewRow['questionID'] == $questionRow['questionID'] ){
          echo "<li> " . $reviewRow['answerText'] . " </li> \n";
        }
        else break;
      }
      // }
      echo "</ul>\n";
    }
    echo "</ul>\n";

    // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "SELECT question, courseName FROM Course WHERE courseID = :courseID;";
    // $sth = $dbh->prepare($sql);
    // $sth->bindParam(':courseID', $courseID);
    // $sth->execute();
    // $result = $sth->setFetchMode(PDO::FETCH_ASSOC);

    //   if(count($result) > 1)
    //   {
    //     echo "<table>\n";
    //
    //     // set the resulting array to associative
    //     foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    //       echo $v . " ";
    //     }
    //     echo "</table>\n";
    //   }
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
