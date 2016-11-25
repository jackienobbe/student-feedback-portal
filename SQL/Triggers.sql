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
DROP TRIGGER IF EXISTS trig_Update_Stats_After_INSERT;


/* Trigger on table answer_choice that updates Question_Answer_Statstics  */ 
DELIMITER $$ 
CREATE TRIGGER trig_Update_Stats_After_INSERT AFTER INSERT ON Answer_Choice 
FOR EACH ROW  
BEGIN 

	DECLARE $TotalAnswerCount int; 
    DECLARE $OfferedAnswer int; 
	DECLARE $OfferedAnswerCount int; 
    DECLARE $Finished int DEFAULT 0;
    
    DECLARE answer_choice_cursor CURSOR FOR
    SELECT offeredAnswerID, count(offeredAnswerID)
	FROM Answer_Choice
    WHERE questionID = NEW.questionID
	GROUP BY offeredAnswerID;
    
    DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET $Finished = 1;
    
    SET $TotalAnswerCount = (select count(questionID) 
						from Answer_Choice 
						where questionID = NEW.questionID);
    
    OPEN answer_choice_cursor;
    
    AnswerStat: LOOP
    
    FETCH answer_choice_cursor INTO $OfferedAnswer, $OfferedAnswerCount;
    
	IF $Finished = 1 THEN 
		LEAVE AnswerStat;
	END IF;

		UPDATE Question_Answer_Statistics 
		SET percent = (($OfferedAnswerCount/$TotalAnswerCount) * 100.0 )
		WHERE Question_Answer_Statistics.questionID = NEW.questionID
		AND Question_Answer_Statistics.offeredAnswerID = $OfferedAnswer; 
        
	END LOOP AnswerStat;
    
    CLOSE answer_choice_cursor;
    
END; 
$$ 
DELIMITER ;

Show Triggers;
DROP TRIGGER IF EXISTS trig_Update_Stats_After_DELETE;

/* Trigger on table answer_choice that updates Question_Answer_Statstics */
DELIMITER $$ 
CREATE TRIGGER trig_Update_Stats_After_DELETE AFTER DELETE ON Answer_Choice 
FOR EACH ROW  
BEGIN 
	
	DECLARE $TotalAnswerCount int; 
    DECLARE $OfferedAnswer int; 
	DECLARE $OfferedAnswerCount int; 
    DECLARE $Finished int DEFAULT 0;
    
    DECLARE answer_choice_cursor CURSOR FOR
    SELECT offeredAnswerID, count(offeredAnswerID)
	FROM Answer_Choice
    WHERE questionID = OLD.questionID
	GROUP BY offeredAnswerID;
    
    DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET $Finished = 1;

    
    SET $TotalAnswerCount = (select count(questionID) 
						from Answer_Choice 
						where questionID = OLD.questionID);
    
    -- Debugging
    SET @TotalAnswerCount = $TotalAnswerCount;
    
    OPEN answer_choice_cursor;
    
    AnswerStat: LOOP
    
    FETCH answer_choice_cursor INTO $OfferedAnswer, $OfferedAnswerCount;
    
    -- Debugging
    SET @OfferedAnswer = $OfferedAnswer;
    SET @OfferedAnswerCount = $OfferedAnswerCount;
    
	IF $Finished = 1 THEN 
		LEAVE AnswerStat;
	END IF;

		UPDATE Question_Answer_Statistics 
		SET percent = (($OfferedAnswerCount/$TotalAnswerCount) * 100.0 )
		WHERE Question_Answer_Statistics.questionID = OLD.questionID
		AND Question_Answer_Statistics.offeredAnswerID = $OfferedAnswer; 
        
	END LOOP AnswerStat;
    
    CLOSE answer_choice_cursor;
    
    
END; 
$$ 
DELIMITER ;

-- DEBUGGING

SELECT @TotalAnswerCount;
SELECT @OfferedAnswer;
SELECT @OfferedAnswerCount;


-- END DEBUGGING



DELIMITER $$ 
CREATE TRIGGER trig_Update_Stats_After_UPDATE AFTER UPDATE ON Answer_Choice 
FOR EACH ROW  
BEGIN 

	DECLARE $NewTotalAnswerCount int; 
    DECLARE $OldTotalAnswerCount int; 
    DECLARE $OfferedAnswer int; 
	DECLARE $OfferedAnswerCount int; 
    DECLARE $NewFinished int DEFAULT 0;
    DECLARE $OldFinished int DEFAULT 0;
    
    DECLARE new_answer_choice_cursor CURSOR FOR
    SELECT offeredAnswerID, count(offeredAnswerID)
	FROM Answer_Choice
    WHERE questionID = NEW.questionID
	GROUP BY offeredAnswerID;
    
    DECLARE old_answer_choice_cursor CURSOR FOR
    SELECT offeredAnswerID, count(offeredAnswerID)
	FROM Answer_Choice
    WHERE questionID = OLD.questionID
	GROUP BY offeredAnswerID;
    
    DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET $NewFinished = 1;
        
	DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET $OldFinished = 1;
    
    SET $NewTotalAnswerCount = (select count(questionID) 
						from Answer_Choice 
						where questionID = NEW.questionID);
                        
	SET $OldTotalAnswerCount = (select count(questionID) 
						from Answer_Choice 
						where questionID = OLD.questionID);
    
    -- Update Stats for New value -----------------------------------------
    OPEN new_answer_choice_cursor;
    
    NewAnswerStat: LOOP
    
    FETCH new_answer_choice_cursor INTO $OfferedAnswer, $OfferedAnswerCount;
    
	IF $finished = 1 THEN 
		LEAVE NewAnswerStat;
	END IF;

		UPDATE Question_Answer_Statistics 
		SET percent = (($OfferedAnswerCount/$NewTotalAnswerCount) * 100.0 )
		WHERE Question_Answer_Statistics.questionID = OLD.questionID
		AND Question_Answer_Statistics.offeredAnswerID = $OfferedAnswer; 
        
	END LOOP NewAnswerStat;
    
    CLOSE new_answer_choice_cursor;
    
    -- Update Stats for old value -----------------------------------------
    OPEN old_answer_choice_cursor;
    
    OldAnswerStat: LOOP
    
    FETCH old_answer_choice_cursor INTO $OfferedAnswer, $OfferedAnswerCount;
    
	IF $finished = 1 THEN 
		LEAVE OldAnswerStat;
	END IF;

		UPDATE Question_Answer_Statistics 
		SET percent = (($OfferedAnswerCount/$OldTotalAnswerCount) * 100.0 )
		WHERE Question_Answer_Statistics.questionID = NEW.questionID
		AND Question_Answer_Statistics.offeredAnswerID = $OfferedAnswer; 
        
	END LOOP OldAnswerStat;
    
    CLOSE old_answer_choice_cursor;
    
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
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = "Course ID must contain the Department ID associated with the course.";
	END IF;
	
END;
$$
DELIMITER ;



