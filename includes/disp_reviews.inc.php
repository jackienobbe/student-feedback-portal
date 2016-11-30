<?php
//
// disp_reviews.inc.php
//

// class ListItems extends RecursiveIteratorIterator {
//   function __construct($it) {
//     parent::__construct($it, self::LEAVES_ONLY);
//   }
//   function current() {
//     return "<td>" . parent::current() . "</td>";
//   }
//   function beginChildren() {
//     echo "<tr>\n";
//   }
//   function endChildren() {
//     echo "</tr>\n";
//   }
//
//
//
// }

class ReviewModel
{
    protected $dbh;

    public function __construct(PDO $dbh)
    {
        $this->db = $dbh;
    }

    public function getAllReviews() {
        return $this->db->query('SELECT questionID FROM Question_Answer_Statistics_By_Section');
    }
}


// Connect to database server
include 'db_connect.php';
$reviewModel = new ReviewModel($dbh);
$reviewList = $reviewModel->getAllReviews();

try {
  $courseID = $_POST['courseID'];
  $professorID = $_POST['professorID'];

  // $pdo = new PDO('mysql:host=example.com;dbname=database', 'user', 'password');

  $statement = $dbh->query("SELECT questionID FROM Question_Answer_Statistics_By_Section");

  // $statement->bindParam(':courseID', $courseID);
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  echo "<ul>";
  foreach ($reviewList as $row) {
    echo "<li>".$row['questionID']."</li>";
  }
  echo "</ul>";
  // echo htmlentities($row['questionID']);




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
