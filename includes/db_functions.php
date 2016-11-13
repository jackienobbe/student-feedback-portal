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
function create_account($userID, $userPassword, $major, $currentYear, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Insert the new product into the the Product table
    $sql = "INSERT INTO Student
              (userID, userPassword, currentYear, major)
            VALUES
              (:userID, :userPassword, :currentYear, :major);";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':userID', $userID);
    $sth->bindParam(':userPassword', $userPassword);
    //$sth->bindParam(':userFName', $userFName);
    //$sth->bindParam(':userLName', $userLName);
    $sth->bindParam(':currentYear', $currentYear);
    $sth->bindParam(':major', $major);

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
function read_student($userID, &$userFName, &$userLName, &$currentYear, &$major, &$error_msg)
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

/* READ STUDENT'S COURSES
 *
 */
function get_curr_student_courses($userID, &$courseID, &$sectionNum, &$semester, &$courseName, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT courseID, sectionNum, semester, courseName
            FROM Enroll NATURAL JOIN Course
            WHERE userID = :userID && semester = :currSemester";

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
      $error_msg = "You are not enrolled in any classes.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $courseID = $record['courseID'];
      $sectionNum = $record['sectionNum'];
      $semester =  $record['semester'];
      $courseName = $record['courseName'];
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

/* READ STUDENT'S COURSES
 *
 */
function get_prev_student_courses($userID, &$courseID, &$sectionNum, &$semester, &$courseName, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT courseID, sectionNum, semester, courseName
            FROM Enroll NATURAL JOIN Course
            WHERE userID = :userID && semester != :currSemester";

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
      $error_msg = "You have not previously enrolled in any classes.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $courseID = $record['courseID'];
      $sectionNum = $record['sectionNum'];
      $semester =  $record['semester'];
      $courseName = $record['courseName'];
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

/* ENROLL STUDENT
 *
 */
function enroll_student($userID, $courseID, $sectionNum, $semester, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Insert the new product into the the Product table
    $sql = "INSERT INTO Enroll
              (userID, courseID, sectionNum, semester)
            VALUES
              (:userID, :courseID, :sectionNum, :semester);";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':userID', $userID);
    $sth->bindParam(':courseID', $courseID);
    $sth->bindParam(':sectionNum', $sectionNum);
    $sth->bindParam(':semester', $semester);

    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  // student successfully enrolled
    else
      return -1;  // student not enrolled; this case may not be possible
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1062)
      $error_msg = "A student is already enrolled in this course and section.";
    else
    {
      header("Location: error.php?err=" . $e->getMessage());
      exit();
    }
    return $e->errorInfo[1];
  }
}

/* READ PROFESSOR
 * read_prof(): reads a professor profile from professor table
 * returns 0 if product successfully deleted
 *         -1 if product does not exist
 *         error code if other db/sql error
 */
function read_prof($professorID, &$profFName, &$profLName, &$departmentName, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT professorID, professorFName, professorLName, departmentName
            FROM Professor NATURAL JOIN ProfessorToDepartment NATURAL JOIN Department
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
      $departmentName =  $record['departmentName'];
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

/* READ PROF'S COURSES
 *
 */
function get_prof_courses($userID, &$courseID, &$sectionNum, &$semester, &$courseName, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT courseID, sectionNum, semester, courseName
            FROM Section NATURAL JOIN Course
            WHERE professorID = :professorID; ";

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
      $error_msg = "This professor has not taught any classes.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $courseID = $record['courseID'];
      $sectionNum = $record['sectionNum'];
      $semester =  $record['semester'];
      $courseName = $record['courseName'];
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

/* READ ALL COURSE'S PROFESSORS
*/
function get_course_profs($courseID, &$professorFName, &$professorLName, &$semester, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT professorFName, professorLName, semester
            FROM Section NATURAL JOIN Professor
            WHERE courseID = :courseID; ";

    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':courseID', $courseID);
    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;

    // Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "This class has not been taught by a professor in our database.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $professorFName = $record['professorFName'];
      $professorLName = $record['professorLName'];
      $semester =  $record['semester'];
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

/* READ COURSE
 * read_course(): reads a course profile from course table
 * returns 0 if product successfully deleted
 *         -1 if product does not exist
 *         error code if other db/sql error
 */
function read_course($courseID, &$courseName, &$departmentName, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT courseID, courseName, departmentName
            FROM Course NATURAL JOIN Department
            WHERE courseID = :courseID;";

    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':courseID', $courseID);
    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;

    // Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "This course doesn't exist.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $courseName = $record['courseName'];
      $departmentName =  $record['departmentName'];
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

function login($userID, $userPassword, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT userID, userPassword
            FROM System_User
            WHERE userID = :userID && userPassword = :userPassword; ";

    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':userID', $userId);
    $sth->bindParam(':userPassword', $userPassword);
    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    // Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "Student ID and password do not match. Please try again.";
      return -1;
    }
    else
    {
      echo count($array);
      $record = $array[0];
      $userID = $record['userID'];
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
