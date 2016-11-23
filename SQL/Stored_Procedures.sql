
DELIMITER $$
CREATE PROCEDURE sp_surveys_about_professor(IN $professorID int)
BEGIN
	
	SELECT userID, courseID, semester, surveyID 
    FROM Section NATURAL JOIN Enroll
		NATURAL JOIN Survey
	WHERE professorID = $professorID;

END;
$$
DELIMITER ;
-- ------------------------------------------------------------------

DROP PROCEDURE IF EXISTS sp_courses_taught_by_professor;

DELIMITER $$
CREATE PROCEDURE sp_courses_taught_by_professor(IN $professorID int)
BEGIN
	
	SELECT DISTINCT courseID
    FROM Section NATURAL JOIN Course
	WHERE professorID = $professorID;

END;
$$
DELIMITER ;

CALL sp_courses_taught_by_professor(1);


-- ------------------------------------------------------------------
DROP PROCEDURE IF EXISTS sp_professors_for_a_course;

DELIMITER $$
CREATE PROCEDURE sp_professors_for_a_course(IN $courseID varchar(10))
BEGIN
	
	SELECT DISTINCT professorID
    FROM Course NATURAL JOIN Section
	WHERE courseID = $courseID;

END;
$$
DELIMITER ;

CALL sp_professors_for_a_course('CSC 3326');

-- ------------------------------------------------------------------
