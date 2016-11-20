
DELIMITER $$
CREATE PROCEDURE sp_surveys_about_professor(IN $professorID)
BEGIN
	
	SELECT userID, courseID, semester, surveyID 
    FROM Section NATURAL JOIN Enroll
		NATURAL JOIN Survey
	WHERE professorID = $professorID;

END;
$$
DELIMITER ;