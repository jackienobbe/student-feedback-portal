UPDATE Answer_Choice
SET offeredAnswerID = 2
WHERE questionID = 1 
	AND surveyID = 1;
    
    
DELETE FROM Answer_Choice
WHERE questionID = 1
	AND surveyID = 1;
    
    
SELECT * FROM Section;


SELECT surveyID FROM Answer_Choice;

SELECT * FROM
	Survey NATURAL JOIN Section
WHERE userID = 71006;