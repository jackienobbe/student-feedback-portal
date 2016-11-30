/* insert into UserType */
INSERT INTO UserType VALUES (0, 'Administrator');
INSERT INTO UserType VALUES (1, 'Student');

/* insert into System_User table*/
INSERT INTO System_User VALUES ( 00001,'admin','admin',' admin', 0);
INSERT INTO System_User VALUES ( 59609,'AUI','Imane','Charrafi', 1);
INSERT INTO System_User VALUES ( 71006,'AUI','Brandon','Crane', 1);
INSERT INTO System_User VALUES ( 71007,'AUI','Jacqueline','Nobbe', 1);
INSERT INTO System_User VALUES ( 64313,'AUI','Dounia','Marbouh', 1);
INSERT INTO System_User VALUES ( 63744,'AUI','Assia','Chadli', 1);

/* insert into Professor*/
# Delete from Professor WHERE professorLName = '';
# Computer Science Instructors (1 - 14)
INSERT INTO Professor (professorFName, professorLName) VALUES ('Fouad','Abbou');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Mohamed','Abid');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Nasser','Assem');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Violetta','Cavalli-Sforza');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Yousra','Chtouki');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Bouchaib','Falah');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Hamid','Harroud');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Omar','Houssaini');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Driss','Kettani');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Mhammed','Chraibi');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Asmaa','Mourhir');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Tajje-Eddine','Rachidi');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Kevin','Smith');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Hanaa','Talei');
# Others (13 - 16)
INSERT INTO Professor (professorFName, professorLName) VALUES ('Djallil','Lounnas');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Jamila','El Kilani');
INSERT INTO Professor (professorFName, professorLName) VALUES ('Rhizlane','Hammoud');


/* insert into Department*/
INSERT INTO Department VALUES ('CSC', 'Computer Science');
INSERT INTO Department VALUES ('EMS', 'Engineering & Management Science');
INSERT INTO Department VALUES ('GE', 'General Engineering');
INSERT INTO Department VALUES ('BA', 'Business Administration');
INSERT INTO Department VALUES ('IS', 'International Studies');
INSERT INTO Department VALUES ('CS', 'Communication Studies');
INSERT INTO Department VALUES ('HRD', 'Human Resources Development');
INSERT INTO Department VALUES ('LC', 'Language Center');


/* insert into ProfessorToDepartment */
INSERT INTO ProfessorToDepartment VALUES (1,'CSC');
INSERT INTO ProfessorToDepartment VALUES (2,'CSC');
INSERT INTO ProfessorToDepartment VALUES (3,'CSC');
INSERT INTO ProfessorToDepartment VALUES (4,'CSC');
INSERT INTO ProfessorToDepartment VALUES (5,'CSC');
INSERT INTO ProfessorToDepartment VALUES (6,'CSC');
INSERT INTO ProfessorToDepartment VALUES (7,'CSC');
INSERT INTO ProfessorToDepartment VALUES (8,'CSC');
INSERT INTO ProfessorToDepartment VALUES (9,'CSC');
INSERT INTO ProfessorToDepartment VALUES (10,'CSC');
INSERT INTO ProfessorToDepartment VALUES (12,'CSC');
INSERT INTO ProfessorToDepartment VALUES (13,'CSC');
INSERT INTO ProfessorToDepartment VALUES (14,'CSC');

/* insert into Student table*/
INSERT INTO Student VALUES ( 59609, 4, 'CSC');
INSERT INTO Student VALUES ( 71006, 3, 'CSC');
INSERT INTO Student VALUES ( 71007, 3, 'CSC');
INSERT INTO Student VALUES ( 63744, 3, 'EMS');
INSERT INTO Student VALUES ( 64313, 3, 'EMS');

/*insert into Course */
# Computer Science
INSERT INTO Course VALUES ('CSC 3326','Database Systems','CSC');
INSERT INTO Course VALUES ('CSC 3309','Artificial Intelligence', 'CSC');
INSERT INTO Course VALUES ('CSC 3351','Operating Systems','CSC');
INSERT INTO Course VALUES ('CSC 3323','Analysis of Algorithms', 'CSC');
INSERT INTO Course VALUES ('CSC 3325','Software Engineering 2','CSC');
INSERT INTO Course VALUES ('CSC 2302','Data Structures','CSC');
INSERT INTO Course VALUES ('CSC 2304','Computer Architecture','CSC');
# Others
INSERT INTO Course VALUES ('GBU 3303','Enterprises, Markets and the Moroccan Economy','BA');
INSERT INTO Course VALUES ('EGR 2402','Electric Circuits','GE');
INSERT INTO Course VALUES ('ACC 2301','Accounting Principles 1', 'BA');
INSERT INTO Course VALUES ('FRN 2310','French For Academic Purposes 2','LC');
INSERT INTO Course VALUES ('SSC 2302','Social Theory','IS');
INSERT INTO Course VALUES ('COM 3301','Public Relations Communication','CS');
INSERT INTO Course VALUES ('ARA 1311','Beginning Arabic 1','LC');
INSERT INTO Course VALUES ('HRD 4303','Leadership and Management Development','HRD');


# DELETE FROM Section WHERE courseID = 'CSC 3309';
/*insert into Section*/
# Our sections
INSERT INTO Section VALUES (01,'CSC 3326','Fall 2016',3);
INSERT INTO Section VALUES (01,'CSC 3309','Fall 2016',4);
INSERT INTO Section VALUES (01,'CSC 3351','Fall 2016',2);
INSERT INTO Section VALUES (01,'CSC 3325','Fall 2016',12);

INSERT INTO Section VALUES (01,'CSC 3326','Spring 2015',3);
INSERT INTO Section VALUES (01,'CSC 2302','Fall 2016',5);

INSERT INTO Section VALUES (01,'GBU 3303','Spring 2016',6);
INSERT INTO Section VALUES (02,'HRD 4303','Spring 2015',2);
INSERT INTO Section VALUES (02,'EGR 2402','Summer 2016',4);


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
INSERT INTO Question_Answer VALUES (1, 1);
INSERT INTO Question_Answer VALUES (1, 2);
INSERT INTO Question_Answer VALUES (1, 3);
INSERT INTO Question_Answer VALUES (1, 4);
INSERT INTO Question_Answer VALUES (1, 5);

INSERT INTO Question_Answer VALUES (2, 1);
INSERT INTO Question_Answer VALUES (2, 2);
INSERT INTO Question_Answer VALUES (2, 3);
INSERT INTO Question_Answer VALUES (2, 4);
INSERT INTO Question_Answer VALUES (2, 5);

INSERT INTO Question_Answer VALUES (3, 1);
INSERT INTO Question_Answer VALUES (3, 2);
INSERT INTO Question_Answer VALUES (3, 3);
INSERT INTO Question_Answer VALUES (3, 4);
INSERT INTO Question_Answer VALUES (3, 5);

INSERT INTO Question_Answer VALUES (4, 1);
INSERT INTO Question_Answer VALUES (4, 2);
INSERT INTO Question_Answer VALUES (4, 3);
INSERT INTO Question_Answer VALUES (4, 4);
INSERT INTO Question_Answer VALUES (4, 5);

INSERT INTO Question_Answer VALUES (5, 1);
INSERT INTO Question_Answer VALUES (5, 2);
INSERT INTO Question_Answer VALUES (5, 3);
INSERT INTO Question_Answer VALUES (5, 4);
INSERT INTO Question_Answer VALUES (5, 5);

INSERT INTO Question_Answer VALUES (6, 1);
INSERT INTO Question_Answer VALUES (6, 2);
INSERT INTO Question_Answer VALUES (6, 3);
INSERT INTO Question_Answer VALUES (6, 4);
INSERT INTO Question_Answer VALUES (6, 5);

INSERT INTO Question_Answer VALUES (7, 1);
INSERT INTO Question_Answer VALUES (7, 2);
INSERT INTO Question_Answer VALUES (7, 3);
INSERT INTO Question_Answer VALUES (7, 4);
INSERT INTO Question_Answer VALUES (7, 5);
# End of Agree/Disagree
INSERT INTO Question_Answer VALUES (8, 6);
INSERT INTO Question_Answer VALUES (8, 7);
INSERT INTO Question_Answer VALUES (8, 8);
INSERT INTO Question_Answer VALUES (8, 9);
INSERT INTO Question_Answer VALUES (8, 10);

INSERT INTO Question_Answer VALUES (9, 11);
INSERT INTO Question_Answer VALUES (9, 12);
INSERT INTO Question_Answer VALUES (9, 13);
INSERT INTO Question_Answer VALUES (9, 14);
INSERT INTO Question_Answer VALUES (9, 15);

INSERT INTO Question_Answer VALUES (10, 11);
INSERT INTO Question_Answer VALUES (10, 12);
INSERT INTO Question_Answer VALUES (10, 13);
INSERT INTO Question_Answer VALUES (10, 14);
INSERT INTO Question_Answer VALUES (10, 15);

INSERT INTO Question_Answer VALUES (11, 17);
INSERT INTO Question_Answer VALUES (11, 18);
INSERT INTO Question_Answer VALUES (11, 7);
INSERT INTO Question_Answer VALUES (11, 8);
INSERT INTO Question_Answer VALUES (11, 19);

INSERT INTO Question_Answer VALUES (12, 17);
INSERT INTO Question_Answer VALUES (12, 18);
INSERT INTO Question_Answer VALUES (12, 7);
INSERT INTO Question_Answer VALUES (12, 8);
INSERT INTO Question_Answer VALUES (12, 19);

INSERT INTO Question_Answer VALUES (13, 20);
INSERT INTO Question_Answer VALUES (13, 21);
INSERT INTO Question_Answer VALUES (13, 22);
INSERT INTO Question_Answer VALUES (13, 23);
INSERT INTO Question_Answer VALUES (13, 24);
INSERT INTO Question_Answer VALUES (13, 25);
INSERT INTO Question_Answer VALUES (13, 26);
INSERT INTO Question_Answer VALUES (13, 27);
INSERT INTO Question_Answer VALUES (13, 28);

INSERT INTO Question_Answer VALUES (14, 20);
INSERT INTO Question_Answer VALUES (14, 21);
INSERT INTO Question_Answer VALUES (14, 22);
INSERT INTO Question_Answer VALUES (14, 23);
INSERT INTO Question_Answer VALUES (14, 24);
INSERT INTO Question_Answer VALUES (14, 25);
INSERT INTO Question_Answer VALUES (14, 26);
INSERT INTO Question_Answer VALUES (14, 27);
INSERT INTO Question_Answer VALUES (14, 28);

/* insert into Enroll*/
# Brandon
INSERT INTO Enroll VALUES (71006,'CSC 3326','Fall 2016',01);
INSERT INTO Enroll VALUES (71006,'CSC 3351','Fall 2016',01);
INSERT INTO Enroll VALUES (71006,'CSC 3309','Fall 2016',01);
# Jackie
INSERT INTO Enroll VALUES (71007,'CSC 3326','Fall 2016',01);
INSERT INTO Enroll VALUES (71007,'CSC 3351','Fall 2016',01);
INSERT INTO Enroll VALUES (71007,'CSC 3309','Fall 2016',01);
# Imane
INSERT INTO Enroll VALUES (59609,'CSC 3325','Fall 2016',01);
INSERT INTO Enroll VALUES (59609,'CSC 3326','Fall 2016',01);


/* insert into Survey */
# Should be automatically created from Trigger on Enroll

# INSERT INTO Survey VALUES (64313,'GBU 3303','Spring 2016',1);
# INSERT INTO Survey VALUES (71006,'CSC 3326','Fall 2016',2);
# INSERT INTO Survey VALUES (59603,'CSC 2302','Fall 2016',3);
# INSERT INTO Survey VALUES (59609,'CSC 2302','Fall 2016',4);
# INSERT INTO Survey VALUES (71007,'CSC 3326','Fall 2016',5);
# DELETE FROM Survey WHERE surveyID = 2;


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


# DELETE FROM Answer_Choice WHERE offeredAnswerID = 1;
/* insert into Answer_Choice */
# Brandon, Artificial Intelligence
INSERT INTO Answer_Choice VALUES (3,1,1);
INSERT INTO Answer_Choice VALUES (3,2,1);
INSERT INTO Answer_Choice VALUES (3,3,1);
INSERT INTO Answer_Choice VALUES (3,4,1);
INSERT INTO Answer_Choice VALUES (3,5,1);
INSERT INTO Answer_Choice VALUES (3,6,1);
INSERT INTO Answer_Choice VALUES (3,7,1);

INSERT INTO Answer_Choice VALUES (3,8,6);
INSERT INTO Answer_Choice VALUES (3,9,11);
INSERT INTO Answer_Choice VALUES (3,10,11);
INSERT INTO Answer_Choice VALUES (3,11,17);
INSERT INTO Answer_Choice VALUES (3,12,17);
INSERT INTO Answer_Choice VALUES (3,13,20);
INSERT INTO Answer_Choice VALUES (3,14,20);
