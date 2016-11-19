Show Triggers;

DROP TRIGGER IF EXISTS trig_QuestionAnswer;

/* Trigger that makes sure there is a statistic for every question answer */
DELIMITER $$ 
CREATE TRIGGER trig_Add_to_Statistics AFTER INSERT ON Question_Answer  
FOR EACH ROW 
BEGIN 
	INSERT INTO Question_Answer_Statistics (questionID, offeredAnswerID)
    VALUES (NEW.questionID, NEW.offeredAnswerID); 
END;
$$ 
DELIMITER ;  

Show Triggers;
DROP TRIGGER IF EXISTS trig_Update_Stats_After_Insert;
/* Trigger on table answer_choice that updates Question_Answer statstics  */ 

-- SEE IF YOU CAN DO MORE THAN ONE ACTION PER TRIGGER
DELIMITER $$ 
CREATE TRIGGER trig_Update_Stats_After_Insert AFTER INSERT ON Answer_Choice 
FOR EACH ROW  
BEGIN 

	DECLARE $TotalChoiceCount int; 
	DECLARE $SelectedChoiceCount int; 
    
    SET $TotalChoiceCount = (select count(questionID) 
						from Answer_Choice 
						where questionID = NEW.questionID);
    -- DELCARE CURSOR?
    -- While each Answer choice, in the NEW.questionID
		-- 
    
		SET $SelectedChoiceCount = (select count(offeredAnswerID) 
						from Answer_Choice 
						where offeredAnswerID = NEW.offeredAnswerID);
		
		UPDATE Question_Answer_Statistics 
		SET percent = (($SelectedChoiceCount/$TotalChoiceCount) * 100.0 )
		WHERE Question_Answer_Statistics.questionID = NEW.questionID
		AND Question_Answer_Statistics.offeredAnswerID = NEW.offeredAnswerID; 
	-- END LOOP
END; 
$$ 
DELIMITER ;

Show Triggers;
DROP TRIGGER IF EXISTS trig_Auto_Create_Survey;

DELIMITER $$
CREATE TRIGGER trig_Auto_Create_Survey AFTER INSERT ON Enroll
FOR EACH ROW
BEGIN
	
    DECLARE $SurveyIDMax int;
    SELECT MAX(surveyID) INTO $SurveyIDMax 
    FROM Survey;
    
	INSERT INTO Survey VALUES (NEW.userID, NEW.courseID, NEW.semester, ($SurveyIDMax + 1));
    
END;
$$
DELIMITER ;



Show Triggers;
DROP TRIGGER IF EXISTS trig_Validate_Course_ID;

DELIMITER $$
CREATE TRIGGER trig_Validate_Course_ID BEFORE INSERT ON Course
FOR EACH ROW
BEGIN
	
	IF( NEW.courseID NOT LIKE NEW.departmentID +'%' )
    THEN
		-- signal SQL State
        -- SEE LINK BELOW
	END IF;
	
END;
$$
DELIMITER ;

-- Maybe?
-- SIGNAL SQLSTATE '45000' 
-- SET MESSAGE_TEXT = "your error text";
-- LINK
-- http://stackoverflow.com/questions/2981930/mysql-trigger-to-prevent-insert-under-certain-conditions