/* Trigger on table questionanswer */

DROP TABLE answer_choice_statistics;
DELIMITER $$
CREATE TRIGGER trig_QuestionAnswer AFTER INSERT ON question_answer 
FOR EACH ROW
BEGIN
INSERT  INTO answer_choice_statistics VALUES (NEW.questionID,NEW.offeredAnswerID);
END;$$
DELIMITER 

/* Trigger on table answer_choice */

DELIMITER $$
CREATE TRIGGER trig_Answer_Choice AFTER INSERT ON answer_choice
FOR EACH ROW 
BEGIN
DECLARE TotalCount int;
Declare PartialCount int;
SET TotalCount = (select count (questionID) from answer_choice where questionID= NEW.questionID),
PartialCount = (select count(offeredAnswerID) from answer_choice where offeredAnswerID=NEW.offeredAnswerID);
UPDATE answer_choice_statistics
SET percent= (PartialCount/TotalCount)*100
WHERE answer_choice_statistics.questionID=answer_choice.questionID and answer_choice_statistics.surveyID=answer_choice.surveyID );
END;
$$
DELIMITER ;
