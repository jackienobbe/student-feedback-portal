/* insert into UserType */
INSERT INTO UserType VALUES (0, 'Administrator');
INSERT INTO UserType VALUES (1, 'Student');

/* insert into System_User table*/
INSERT INTO System_User VALUES ( 59609,'AUI','Imane','Charrafi', 1);
INSERT INTO System_User VALUES ( 64313,'AUI','Dounia','Marbouh', 1);
INSERT INTO System_User VALUES ( 71006,'AUI','Brandon','Crane', 1);
INSERT INTO System_User VALUES ( 71007,'AUI','Jacqueline','Nobbe', 1);
INSERT INTO System_User VALUES ( 63744,'AUI','Assia','Chadli', 1);
INSERT INTO System_User VALUES ( 59603,'AUI','Yousra',' Gaimes', 1);
INSERT INTO System_User VALUES ( 00001,'admin','admin',' admin', 0);

/* insert into Student table*/
INSERT INTO Student VALUES ( 59609, 4, 'Computer Science');
INSERT INTO Student VALUES ( 64313, 3, 'Engineering & Management Science');
INSERT INTO Student VALUES ( 71006, 3, 'Computer Science');
INSERT INTO Student VALUES ( 71007, 3, 'Computer Science');
INSERT INTO Student VALUES ( 63744, 3, 'Engineering & Management Science');
INSERT INTO Student VALUES ( 59603, 4, 'Computer Science');

/* insert into Professor*/
# Delete from Professor WHERE professorID = 8;
INSERT INTO Professor VALUES (1, 'Nasser','Assem');
INSERT INTO Professor VALUES (2, 'Djallil',' Lounnas');
INSERT INTO Professor VALUES (3, 'Jamila','El Kilani');
INSERT INTO Professor VALUES (4, 'Anas','Bentamy');
INSERT INTO Professor VALUES (5, 'Hanaa','Talei');
INSERT INTO Professor VALUES (6, 'Rhizlane','Hammoud');


/* insert into Department*/
INSERT INTO Department VALUES ('CSC', ' Computer Science');
INSERT INTO Department VALUES ('EMS','Engineering & Management Science');
INSERT INTO Department VALUES ('GE','General Engineering');
INSERT INTO Department VALUES ('BA','Business Administration');
INSERT INTO Department VALUES ('IS','International Studies');
INSERT INTO Department VALUES ('CS','Communication Studies');
INSERT INTO Department VALUES ('HRD','Human Resources Development');
INSERT INTO Department VALUES ('LC', ' Language Center');


/* insert into ProfessorToDepartment */
INSERT INTO ProfessorToDepartment VALUES (1,'CSC');
INSERT INTO ProfessorToDepartment VALUES (4,'GE');
INSERT INTO ProfessorToDepartment VALUES (2,'BA');
INSERT INTO ProfessorToDepartment VALUES (2,'CS');

/*insert into Course */
INSERT INTO Course VALUES ('CSC 3323','Analysis of Algorithms', 'CSC');
INSERT INTO Course VALUES ('CSC 3309','Artificial Intelligence', 'CSC');
INSERT INTO Course VALUES ('GBU 3303','Enterprises, Markets and the Moroccan Economy','BA');
INSERT INTO Course VALUES ('CSC 3325','Software Engineering 2','CSC');
INSERT INTO Course VALUES ('EGR 2402','Electric Circuits','GE');
INSERT INTO Course VALUES ('CSC 3351','Operating Systems','CSC');
INSERT INTO Course VALUES ('ACC 2301','Accounting Principles 1', 'BA');
INSERT INTO Course VALUES ('CSC 2302','Data Structures','CSC');
INSERT INTO Course VALUES ('CSC 2304','Computer Architecture','CSC');
INSERT INTO Course VALUES ('FRN 2310','French For Academic Purposes 2','LC');
INSERT INTO Course VALUES ('CSC 3326','Database Systems','CSC');
INSERT INTO Course VALUES ('SSC 2302','Social Theory','IS');
INSERT INTO Course VALUES ('COM 3301','Public Relations Communication','CS');
INSERT INTO Course VALUES ('ARA 1311','Beginning Arabic 1','LC');
INSERT INTO Course VALUES ('HRD 4303','Leadership and Management Development','HRD');


# DELETE FROM Section WHERE courseID = 'CSC 3309';
/*insert into Section*/
INSERT INTO Section VALUES (01,'GBU 3303','Spring 2016',6);
INSERT INTO Section VALUES (01,'CSC 3326','Fall 2016',1);
INSERT INTO Section VALUES (01,'CSC 3326','Spring 2015',1);
INSERT INTO Section VALUES (01,'CSC 2302','Fall 2016',5);
INSERT INTO Section VALUES (02,'HRD 4303','Spring 2015',2);
INSERT INTO Section VALUES (02,'EGR 2402','Summer 2016',4);
INSERT INTO Section VALUES (01,'CSC 3309','Fall 2016',1);


/* insert into Enroll*/
INSERT INTO Enroll VALUES (64313,'GBU 3303','Spring 2016',01);
INSERT INTO Enroll VALUES (71006,'CSC 3326','Fall 2016',01);
INSERT INTO Enroll VALUES (59603,'CSC 2302','Fall 2016',01);
INSERT INTO Enroll VALUES (59609,'CSC 2302','Fall 2016',01);
INSERT INTO Enroll VALUES (71007,'CSC 3326','Fall 2016',01);
INSERT INTO Enroll VALUES (71007,'CSC 3309','Fall 2016',01);


/* insert into Survey */
# INSERT INTO Survey VALUES (64313,'GBU 3303','Spring 2016',1);
# INSERT INTO Survey VALUES (71006,'CSC 3326','Fall 2016',2);
# INSERT INTO Survey VALUES (59603,'CSC 2302','Fall 2016',3);
# INSERT INTO Survey VALUES (59609,'CSC 2302','Fall 2016',4);
# INSERT INTO Survey VALUES (71007,'CSC 3326','Fall 2016',5);
# DELETE FROM Survey WHERE surveyID = 2;

/* insert into Answer_Type*/
INSERT INTO Answer_Type VALUES (1, 'Text');
INSERT INTO Answer_Type VALUES (2, 'Choice');

/* insert into Question */
INSERT INTO Question VALUES ( 1, 'The instructor was an effective communicator.', 2);
INSERT INTO Question VALUES ( 2, 'Lessons are well-prepared.', 2);
INSERT INTO Question VALUES ( 3, 'The instructor was approachable.', 2);
INSERT INTO Question VALUES ( 4, 'The instructor demonstrates knowledge of the subject.', 2);
INSERT INTO Question VALUES ( 5, 'Student participation is encouraged.', 2);
INSERT INTO Question VALUES ( 6, 'Grading was fair.', 2);
INSERT INTO Question VALUES ( 7, 'I learned a lot in this course.', 2);
INSERT INTO Question VALUES ( 8, 'On average, the number of hours I spent on coursework outside of class, per week:', 2);
INSERT INTO Question VALUES ( 9, 'The concepts in this class were predominantly presented in... (check up to two):', 2);
INSERT INTO Question VALUES ( 10, 'Most of the test material in this class came from... (check up to two)', 2);
INSERT INTO Question VALUES ( 11, 'How many group projects were assigned?', 2);
INSERT INTO Question VALUES ( 12, 'How many papers were assigned?', 2);
INSERT INTO Question VALUES ( 13, 'The main percentage of my overall grade was based on...', 2);
INSERT INTO Question VALUES ( 14, 'The secondary component of my grade was based on...', 2);
INSERT INTO Question VALUES ( 15, 'Comments about the professor: ', 1);
INSERT INTO Question VALUES ( 16, 'Comments about the course: ', 1);

/* insert into Answer_Text */
# INSERT INTO Answer_Text (surveyID, questionId, answer)
# 	VALUES (1, 2,'The material covered in class is not very relevant to the course!');
# INSERT INTO Answer_Text (surveyID, questionId, answer)
# 	VALUES (2, 2,' This class taught me how to apply theory to practice');
# INSERT INTO Answer_Text (surveyID, questionId, answer)
# 	VALUES (3, 2,'I think that the professor demonstrates good knowledge of the material');
# INSERT INTO Answer_Text (surveyID, questionId, answer)
# 	VALUES (4, 2,'Students participation is encouraged');
# INSERT INTO Answer_Text (surveyID, questionId, answer)
# 	VALUES (5, 2,'The professor gives a lot of assignments and pop quizzes');

/* insert into OfferedAnswer */
INSERT INTO OfferedAnswer (answerText) VALUES ('Strongly Agree');
INSERT INTO OfferedAnswer (answerText) VALUES ('Agree');
INSERT INTO OfferedAnswer (answerText) VALUES ('Neutral');
INSERT INTO OfferedAnswer (answerText) VALUES ('Disagree');
INSERT INTO OfferedAnswer (answerText) VALUES ('Strongly Disagree');

INSERT INTO OfferedAnswer (answerText) VALUES ('2 or less');
INSERT INTO OfferedAnswer (answerText) VALUES ('3-4');
INSERT INTO OfferedAnswer (answerText) VALUES ('5-6');
INSERT INTO OfferedAnswer (answerText) VALUES ('7-8');
INSERT INTO OfferedAnswer (answerText) VALUES ('9 or more');

INSERT INTO OfferedAnswer (answerText) VALUES ('Lecture');
INSERT INTO OfferedAnswer (answerText) VALUES ('External readings');
INSERT INTO OfferedAnswer (answerText) VALUES ('Laboratory assignments/activities');
INSERT INTO OfferedAnswer (answerText) VALUES ('Group Discussion');
INSERT INTO OfferedAnswer (answerText) VALUES ('Other');

INSERT INTO OfferedAnswer (answerText) VALUES ('There were no tests administered in this course');

INSERT INTO OfferedAnswer (answerText) VALUES ('0');
INSERT INTO OfferedAnswer (answerText) VALUES ('1-2');
INSERT INTO OfferedAnswer (answerText) VALUES ('7 or more');

INSERT INTO OfferedAnswer (answerText) VALUES ('Exams');
INSERT INTO OfferedAnswer (answerText) VALUES ('Quizzes');
INSERT INTO OfferedAnswer (answerText) VALUES ('Homework');
INSERT INTO OfferedAnswer (answerText) VALUES ('Presentations');
INSERT INTO OfferedAnswer (answerText) VALUES ('Individual projects');
INSERT INTO OfferedAnswer (answerText) VALUES ('Group Projects');
INSERT INTO OfferedAnswer (answerText) VALUES ('Papers (less than 10 pages)');
INSERT INTO OfferedAnswer (answerText) VALUES ('Papers (10 or more pages)');
INSERT INTO OfferedAnswer (answerText) VALUES ('No primary component');


/* insert into Question_Answer */
INSERT INTO Question_Answer VALUES (1, 6);
INSERT INTO Question_Answer VALUES (1, 7);
INSERT INTO Question_Answer VALUES (1, 8);
INSERT INTO Question_Answer VALUES (1, 9);
INSERT INTO Question_Answer VALUES (1, 10);
INSERT INTO Question_Answer VALUES (2, 6);
INSERT INTO Question_Answer VALUES (2, 7);
INSERT INTO Question_Answer VALUES (2, 8);
INSERT INTO Question_Answer VALUES (2, 9);
INSERT INTO Question_Answer VALUES (2, 10);
INSERT INTO Question_Answer VALUES (3, 6);
INSERT INTO Question_Answer VALUES (3, 7);
INSERT INTO Question_Answer VALUES (3, 8);
INSERT INTO Question_Answer VALUES (3, 9);
INSERT INTO Question_Answer VALUES (3, 10);
INSERT INTO Question_Answer VALUES (4, 6);
INSERT INTO Question_Answer VALUES (4, 7);
INSERT INTO Question_Answer VALUES (4, 8);
INSERT INTO Question_Answer VALUES (4, 9);
INSERT INTO Question_Answer VALUES (4, 10);
INSERT INTO Question_Answer VALUES (5, 6);
INSERT INTO Question_Answer VALUES (5, 7);
INSERT INTO Question_Answer VALUES (5, 8);
INSERT INTO Question_Answer VALUES (5, 9);
INSERT INTO Question_Answer VALUES (5, 10);
INSERT INTO Question_Answer VALUES (6, 6);
INSERT INTO Question_Answer VALUES (6, 7);
INSERT INTO Question_Answer VALUES (6, 8);
INSERT INTO Question_Answer VALUES (6, 9);
INSERT INTO Question_Answer VALUES (6, 10);
INSERT INTO Question_Answer VALUES (7, 6);
INSERT INTO Question_Answer VALUES (7, 7);
INSERT INTO Question_Answer VALUES (7, 8);
INSERT INTO Question_Answer VALUES (7, 9);
INSERT INTO Question_Answer VALUES (7, 10);
# End if Agree/Disagree
INSERT INTO Question_Answer VALUES (8, 11);
INSERT INTO Question_Answer VALUES (8, 12);
INSERT INTO Question_Answer VALUES (8, 13);
INSERT INTO Question_Answer VALUES (8, 14);
INSERT INTO Question_Answer VALUES (8, 15);
INSERT INTO Question_Answer VALUES (9, 16);
INSERT INTO Question_Answer VALUES (9, 17);
INSERT INTO Question_Answer VALUES (9, 18);
INSERT INTO Question_Answer VALUES (9, 19);
INSERT INTO Question_Answer VALUES (9, 20);
INSERT INTO Question_Answer VALUES (10, 16);
INSERT INTO Question_Answer VALUES (10, 17);
INSERT INTO Question_Answer VALUES (10, 18);
INSERT INTO Question_Answer VALUES (10, 19);
INSERT INTO Question_Answer VALUES (10, 20);
INSERT INTO Question_Answer VALUES (10, 21);
INSERT INTO Question_Answer VALUES (11, 22);
INSERT INTO Question_Answer VALUES (11, 23);
INSERT INTO Question_Answer VALUES (11, 12);
INSERT INTO Question_Answer VALUES (11, 13);
INSERT INTO Question_Answer VALUES (11, 24);
INSERT INTO Question_Answer VALUES (12, 22);
INSERT INTO Question_Answer VALUES (12, 23);
INSERT INTO Question_Answer VALUES (12, 12);
INSERT INTO Question_Answer VALUES (12, 13);
INSERT INTO Question_Answer VALUES (12, 24);
INSERT INTO Question_Answer VALUES (13, 25);
INSERT INTO Question_Answer VALUES (13, 26);
INSERT INTO Question_Answer VALUES (13, 27);
INSERT INTO Question_Answer VALUES (13, 28);
INSERT INTO Question_Answer VALUES (13, 29);
INSERT INTO Question_Answer VALUES (13, 30);
INSERT INTO Question_Answer VALUES (13, 31);
INSERT INTO Question_Answer VALUES (13, 32);
INSERT INTO Question_Answer VALUES (13, 33);
INSERT INTO Question_Answer VALUES (14, 25);
INSERT INTO Question_Answer VALUES (14, 26);
INSERT INTO Question_Answer VALUES (14, 27);
INSERT INTO Question_Answer VALUES (14, 28);
INSERT INTO Question_Answer VALUES (14, 29);
INSERT INTO Question_Answer VALUES (14, 30);
INSERT INTO Question_Answer VALUES (14, 31);
INSERT INTO Question_Answer VALUES (14, 32);
INSERT INTO Question_Answer VALUES (14, 33);


# DELETE FROM Answer_Choice WHERE surveyID = 2;
/* insert into Answer_Choice */
INSERT INTO Answer_Choice VALUES (1,1,6);
INSERT INTO Answer_Choice VALUES (1,3,6);
INSERT INTO Answer_Choice VALUES (2,1,7);
INSERT INTO Answer_Choice VALUES (2,3,7);
INSERT INTO Answer_Choice VALUES (3,1,8);
INSERT INTO Answer_Choice VALUES (3,3,8);
INSERT INTO Answer_Choice VALUES (4,1,6);
INSERT INTO Answer_Choice VALUES (4,3,6);
# Things should be 50/50 ^^
# 100% Here vv
INSERT INTO Answer_Choice VALUES (5,1,6);
INSERT INTO Answer_Choice VALUES (5,3,6);
# Same person, same section multiple answers
INSERT INTO Answer_Choice VALUES (2,1,7);
INSERT INTO Answer_Choice VALUES (2,1,8);
INSERT INTO Answer_Choice VALUES (2,1,9);

INSERT INTO Answer_Choice VALUES (2,3,8);
INSERT INTO Answer_Choice VALUES (2,3,6);


/* insert into Question_Answer_Statistics_By_Section */
-- Will be filled with data supplied by triggers.
-- INSERT INTO Question_Answer_Statistics_By_Section VALUES ();
# DELETE FROM Question_Answer_Statistics_By_Section WHERE courseID = 'CSC 3326';