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
function create_account($newUserID, $userPassword, $userFName, $userLName, $major, $currentYear, &$error_msg)
{
  // Connect to database server
  include 'db_connect.php';

  try
  {
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Insert the new product into the the system and  table
    $sql = "INSERT INTO System_User (userID, userPassword, userFName, userLName, userTypeID)
            VALUES (:newUserID, :userPassword, :userFName, :userLName, 1);

            INSERT INTO Student (userID, currentYear, major)
            VALUES (:newUserID, :currentYear, :major);";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':newUserID', $newUserID);
    $sth->bindParam(':userPassword', $userPassword);
    $sth->bindParam(':userFName', $userFName);
    $sth->bindParam(':userLName', $userLName);
    $sth->bindParam(':currentYear', $currentYear);
    $sth->bindParam(':major', $major);

    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  //student successfully created
    else
      return -1;  //student not created; this case may not be possible
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1062)
      $error_msg = "A student with this id already exists in the database.";
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
  include 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT userID, userFName, userLName, currentYear, major
            FROM System_User NATURAL JOIN Student
            WHERE userID = :userID;";

    $sth = $dbh->prepare($sql);//, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
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
  include 'db_connect.php';

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
  include 'db_connect.php';

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
  include 'db_connect.php';

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
function read_prof($professorID, &$professorFName, &$professorLName, &$departmentName, &$error_msg)
{
  // Connect to database server
  include 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT P.professorID, professorFName, professorLName, departmentName
            FROM Professor P LEFT JOIN ProfessorToDepartment PD ON P.professorID = PD.professorID
            LEFT JOIN Department D ON D.departmentID = PD.departmentID
            WHERE P.professorID = :professorID;" ;

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
      $professorID = $record['professorID'];
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
  include 'db_connect.php';

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
  include 'db_connect.php';

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
  include 'db_connect.php';

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
      $courseID = $record['courseID'];
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
  include 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT userID FROM System_User
            WHERE userID = :userID && userPassword = :userPassword;";

    $sth = $dbh->prepare($sql); //, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':userID', $userID);
    $sth->bindParam(':userPassword', $userPassword);

    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);

    $dbh = null;

    //Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "User ID and password do not match. ";
      return -1;
    }
    else
    {
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

function read_course_prof_info($professorID, $courseID, &$professorFName, &$professorLName, &$courseName, &$error_msg)
{
  // Connect to database server
   include 'db_connect.php';

   try
   {
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $sql = "SELECT professorFName, professorLName, courseName
             FROM Professor NATURAL JOIN Section NATURAL JOIN Course
             WHERE professorID = :professorID && courseID = :courseID;";

     $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
     $sth->bindParam(':professorID', $professorID);
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
       $professorFName =  $record['professorFName'];
       $professorLName =  $record['professorLName'];
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

function read_course_section_prof_info($professorID, $courseID, $sectionNum, $semester, &$professorFName, &$professorLName, &$courseName, &$error_msg)
{
  // Connect to database server
   include 'db_connect.php';

   try
   {
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $sql = "SELECT professorFName, professorLName, courseName, semester
             FROM Professor NATURAL JOIN Section NATURAL JOIN Course
             WHERE professorID = :professorID AND courseID = :courseID
             AND sectionNum = :sectionNum AND semester = :semester;";

     $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
     $sth->bindParam(':professorID', $professorID);
     $sth->bindParam(':courseID', $courseID);
     $sth->bindParam(':sectionNum', $sectionNum);
     $sth->bindParam(':semester', $semester);

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
       $semester = $record['semester'];
       $courseName = $record['courseName'];
       $professorFName =  $record['professorFName'];
       $professorLName =  $record['professorLName'];
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

function submit_servey($surveyID, $questionID, $offeredAnswerID, &$error_msg)
{
  // Connect to database server
  include 'db_connect.php';

  try
  {
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Insert the new product into the the system and  table
    $sql = "INSERT INTO Answer_Choice (surveyID, questionID, offeredAnswerID)
            VALUES (:surveyID, :questionID, :offeredAnswerID);";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':surveyID', $surveyID);
    $sth->bindParam(':questionID', $questionID);
    $sth->bindParam(':offeredAnswerID', $offeredAnswerID);

    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  //student successfully created
    else
      return -1;  //student not created; this case may not be possible
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1062)
      $error_msg = "You already took this survey... stay tuned to be able to resubmit your answers!";
    else
    {
      header("Location: error.php?err=" . $e->getMessage());
      exit();
    }
    return $e->errorInfo[1];
  }
}

function survey_for_enrollment($userID, $courseID, $semester)
{
  try {
    $sql = "SELECT surveyID
            FROM Enroll NATURAL JOIN Survey
            WHERE userID = :userID AND courseID = :courseID
            AND semester = :semester;";

    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':userID', $userID);
    $sth->bindParam(':courseID', $courseID);
    $sth->bindParam(':semester', $semester);

    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;

    // Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "This enrollment does not have a survey yet";
      return -1;
    }
    else
    {
      $record = $array[0];
      $surveyID = $record['surveyID'];
      return 0;
    }

  } catch (PDOException $e) {
    $dbh = null;
    header("Location: error.php?err=" . $e->getMessage());
    exit();
  }
}
