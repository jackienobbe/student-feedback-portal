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
          value='" . parent::current() . "' formmethod='POST'>";
  }
  function endChildren() {
    echo "</button></li>\n";
  }
}

// Connect to database server
include_once 'db_connect.php';

try {
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT P.professorID, professorFName, professorLName, departmentName
          FROM Professor P LEFT JOIN ProfessorToDepartment PD ON P.professorID = PD.professorID
          LEFT JOIN Department D ON D.departmentID = PD.departmentID; ";
  if ($professorLName != "_all")
  {
    $sql .= " WHERE professorLName = :professorLName";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':professorLName', $professorLName);
  }
  else
  { // all
    $sth = $dbh->prepare($sql);
  }
  $sth->execute();

  echo "<ul>\n";

  // set the resulting array to associative
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new ListItems(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v . " ";
  }
  echo "</ul>";
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}
