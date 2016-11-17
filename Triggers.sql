DROP TABLE answer_choice_statistics;
DELIMITER $$
CREATE TRIGGER trig_QuestionAnswer AFTER INSERT ON question_answer 
FOR EACH ROW
BEGIN
INSERT  INTO answer_choice_statistics VALUES (NEW.questionID,NEW.offeredAnswerID);
END;$$
DELIMITER 
