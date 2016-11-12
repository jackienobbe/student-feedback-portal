<?php
//
// db_functions.php
//
// NB. Using prepared statements "helps to prevent SQL injection attacks by eliminating the need to
// manually quote the parameters."
//
/* CREATE STUDENT
 * create_student(): inserts a new student into student table
 * returns 0 if product successfully created
 *         1062 if student already exists
 *         error code if other db/sql error
 */
function create_student($studID, $studPassword, $studFName, $studLName, $currentYear, $major, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';
  try
  {
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Insert the new product into the the Product table
    $sql = "INSERT INTO Student
              (studentID, studentPassword, studentFName, studentLName, currentYear, major)
            VALUES
              (:studID, :studPassword, :studFName, :studLName, :currentYear, :major);";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':studID', $studentID);
    $sth->bindParam(':studPassword', $descript);
    $sth->bindParam(':studFName', $studFName);
    $sth->bindParam(':studLName', $studLName);
    $sth->bindParam(':currentYear', $currentYear);
    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  // student successfully created
    else
      return -1;  // student not created; this case may not be possible
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1062)
      $error_msg = "A student with this code already exists.";
    else
    {
      header("Location: error.php?err=" . $e->getMessage());
      exit();
    }
    return $e->errorInfo[1];
  }
}
/* READ STUDENT
 * read_student(): reads a dtudent profile from student and user tables
 * returns 0 if product successfully deleted
 *         -1 if product does not exist
 *         error code if other db/sql error
 */
function read_student($userId, &$userFName, &$userLName, &$currentYear, &$major, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';
  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT userID, userFName, userLName, currentYear,
                   major
            FROM User NATURAL JOIN Student
            WHERE userID = :userID;";
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':userID', $userID);
    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    // Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "You don't exist.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $userFName = $record['userFName'];
      $userLName = $record['userLName'];
      $currentYear =  $record['currentYear'];
      $major =  $record['major'];
      return 0;
    }
  }
  catch(PDOException $e)
  {
    $dbh = null;
    header("Location: error.php?err=" . $e->getMessage());
    exit();
  }
}
/* READ STUDENT
 * read_student(): reads a dtudent profile from student and user tables
 * returns 0 if product successfully deleted
 *         -1 if product does not exist
 *         error code if other db/sql error
 */
function read_prof($profID, &$profFName, &$profLName,&$departmentID,&$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';
  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT professorID, professorFName, professorLName,departmentID
            FROM Professor NATURAL JOIN ProfessorToDepartment Natural JOIN Department
            WHERE professorID = :professorID;";
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':professorID', $professorID);
    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    // Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "This professor doesn't exist.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $professorFName = $record['professorFName'];
      $professorLName = $record['professorLName'];
      $departmentID =  $record['departmentID'];
      return 0;
    }
  }
  catch(PDOException $e)
  {
    $dbh = null;
    header("Location: error.php?err=" . $e->getMessage());
    exit();
  }
}
/* DELETE PRODUCT
 * del_product(): deletes a product from product table
 * returns 0 if product successfully deleted
 *          -1 if product does not exist
 *         error code if other db/sql error
 */
/*function del_product($pcode, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';
  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM Product
            WHERE ProductCode = :pcode;";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':pcode', $pcode);
    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  // product successfully deleted
    else
    {
      $error_msg = "A product with this code does not exist.";
      return -1;
    }
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1451)
      $error_msg = "A product with this code is linked to some database item; cannot be deleted.";
    else
    {
      header("Location: error.php?err=" . $e->getMessage());
      exit();
    }
    return $e->errorInfo[1];
  }
}*/