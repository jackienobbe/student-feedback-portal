DROP PROCEDURE IF EXISTS sp_surveys_about_professor;

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

DROP PROCEDURE IF EXISTS sp_answer_question_choice;

DELIMITER $$
CREATE PROCEDURE sp_answer_question_choice(IN $surveyID int, IN $questionID int, IN $offeredAnswerID int)
BEGIN
    
    INSERT INTO Answer_Choice VALUES ($surveyID, $questionID, $offeredAnswerID);

END;
$$
DELIMITER ;

CALL sp_answer_question_choice();

-- ------------------------------------------------------------------

DROP PROCEDURE IF EXISTS sp_answer_question_text;

DELIMITER $$
CREATE PROCEDURE sp_answer_question_text(IN $surveyID int, IN $questionID int, IN $textAnswer varchar(500))
BEGIN
    
    INSERT INTO Answer_Text (surveyID, questionId, answer) 
    VALUES ($surveyID, $questionID, $textAnswer);

END;
$$
DELIMITER ;

CALL sp_answer_question_text();

-- ------------------------------------------------------------------

DROP PROCEDURE IF EXISTS sp_answer_question_text;

DELIMITER $$
CREATE PROCEDURE sp_display_question_with_choices(IN $surveyID int, IN $questionID int, IN $textAnswer varchar(500))
BEGIN
    
    INSERT INTO Answer_Text (surveyID, questionId, answer) 
    VALUES ($surveyID, $questionID, $textAnswer);

END;
$$
DELIMITER ;

CALL sp_answer_question_text();

-- ------------------------------------------------------------------

