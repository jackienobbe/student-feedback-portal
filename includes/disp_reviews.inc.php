<?php
//
// disp_profs.inc.php
//

class ListItems extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return parent::current();
  }
  function beginChildren() {
    echo "<li> <button name='professorID' type='submit' formaction='view_prof.php'
          value='" . parent::current() . "' formmethod='POST'>" . parent::current() . "</button>\n";
  }
  function endChildren() {
    echo "</li>\n";
  }
}

// Connect to database server
include_once 'db_connect.php';

try {

  $professorID = $_POST['professorID'];
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT questionText, answerText, percent
	         FROM Question Q NATURAL JOIN OfferedAnswer
           LEFT JOIN Question_Answer_Statistics QAS ON Q.questionID = QAS.questionID
           WHERE professorID = :professorID;
           ORDER BY QuestionText, answerText; ";

  $sth = $dbh->prepare($sql);
  $sth->bindParam(':professorID', $professorID);
  $sth->execute();

  echo "<ul>\n";

  // set the resulting array to associative
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v;
  }
  echo "</ul>";
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
