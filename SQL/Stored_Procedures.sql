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

	SELECT DISTINCT courseID, courseName
    FROM Section NATURAL JOIN Course
	WHERE professorID = $professorID;

END;
$$
DELIMITER ;

CALL sp_courses_taught_by_professor(1);


-- ------------------------------------------------------------------
-- TODO: add professor Name? join professor
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
-- FOR MAKING SURVEY
DROP PROCEDURE IF EXISTS sp_display_question_answer_choices;

DELIMITER $$
CREATE PROCEDURE sp_display_question_answer_choices(IN $questionID int)
BEGIN

    SELECT offeredAnswerID, answerText
    FROM Question_Answer NATURAL JOIN OfferedAnswer
    WHERE questionID = $questionID;

END;
$$
DELIMITER ;

CALL sp_display_question_answer_choices(1);

-- ------------------------------------------------------------------
-- FOR TAKING SURVEY
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
-- FOR TAKING SURVEY
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
-- FOR DISPLAYING SURVEY RESULTS
DROP PROCEDURE IF EXISTS sp_display_text_answers_for_question;

DELIMITER $$
CREATE PROCEDURE sp_display_text_answers_for_question(IN $questionID int)
BEGIN

    SELECT answer, voteCount
    FROM Question
		NATURAL JOIN Answer_Text
    WHERE questionID = $questionID;

END;
$$
DELIMITER ;

CALL sp_display_text_answers_for_question(1);

-- SELECT answer, voteCount
--     FROM Question
-- 		NATURAL JOIN Answer_Text
--     WHERE questionID = 2;

-- ------------------------------------------------------------------
-- FOR DISPLAYING SURVEY RESULTS
-- TODO: FIX FOR THE NEW TABLES
DROP PROCEDURE IF EXISTS sp_display_statistics_by_section;

DELIMITER $$
CREATE PROCEDURE sp_display_statistics_by_section(IN $questionID int)
BEGIN

    -- SELECT offeredAnswerID, answerText, percent
    -- FROM Question_Answer
	-- 	NATURAL JOIN OfferedAnswer
	-- 	NATURAL JOIN Question_Answer_Statistics
    -- WHERE questionID = $questionID;

  SELECT * FROM Question_Answer_Statistics_By_Section
    -- WHERE
    -- PK from section

END;
$$
DELIMITER ;

CALL sp_display_statistics_by_section(1);

-- ------------------------------------------------------------------

-- SELECT offeredAnswerID, answerText, percent
--     FROM Question_Answer
-- 		NATURAL JOIN OfferedAnswer
-- 		NATURAL JOIN Question_Answer_Statistics
--     WHERE questionID = 1;
