UPDATE Answer_Choice
SET offeredAnswerID = 2
WHERE questionID = 1 
	AND surveyID = 1;
    
    
DELETE FROM Answer_Choice
WHERE questionID = 1
	AND surveyID = 1;
    
    
