DROP TABLE IF EXISTS Question_Answer_Statistics;
DROP TABLE IF EXISTS Answer_Choice;
DROP TABLE IF EXISTS Question_Answer;
DROP TABLE IF EXISTS OfferedAnswer;
DROP TABLE IF EXISTS Answer_Text;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS Answer_Type;
DROP TABLE IF EXISTS Survey;
DROP TABLE IF EXISTS Enroll;
DROP TABLE IF EXISTS Section;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS ProfessorToDepartment;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Professor;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS System_User;
DROP TABLE IF EXISTS UserType;


-- Student, Admistator
CREATE TABLE UserType(
	userTypeID int PRIMARY KEY,
    description varchar(20) NOT NULL
);

CREATE TABLE System_User (
	userID int PRIMARY KEY,
    userPassword varchar(30) NOT NULL,
    userFName varchar(25) NOT NULL,
    userLName varchar(25) NOT NULL,
    userTypeID int,
    FOREIGN KEY (userTypeID) REFERENCES UserType (userTypeID)
		ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE Student (
	userID int PRIMARY KEY,
	currentYear int,
	major	varchar(50) NOT NULL,
    FOREIGN KEY (userID) REFERENCES System_User (userID)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Professor (
	professorID int AUTO_INCREMENT PRIMARY KEY,
	professorFName varchar(25) NOT NULL,
    professorLName varchar(25) NOT NULL
);

CREATE TABLE Department (
	departmentID varchar (5) PRIMARY KEY,
	departmentName varchar (50) NOT NULL
);

CREATE TABLE ProfessorToDepartment(
	professorID int,
    departmentID varchar(5),
    PRIMARY KEY (professorID, departmentID),
    FOREIGN KEY (professorID) REFERENCES Professor (professorID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (departmentID) REFERENCES Department (departmentID)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Course (
	courseID varchar (10) PRIMARY KEY,
    courseName varchar (60) NOT NULL,
	departmentID varchar (5) NOT NULL,
	FOREIGN KEY (departmentID) REFERENCES Department (departmentID)
		ON UPDATE CASCADE ON DELETE NO ACTION
);


CREATE TABLE Section (
	sectionNum int,
	courseID varchar (10) NOT NULL,
	semester varchar (20),
    professorID int NOT NULL,
	PRIMARY KEY (sectionNum, courseID, semester),
	FOREIGN KEY (courseID) REFERENCES Course (courseID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (professorID) REFERENCES Professor (professorID)
		ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE Enroll (
	userID int,
    courseID varchar (10),
	semester varchar(20),
	sectionNum int NOT NULL,
	PRIMARY KEY (userID, courseID, semester),
	FOREIGN KEY (userID) REFERENCES Student (userID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (sectionNum, courseID, semester) REFERENCES Section (sectionNum, courseID, semester)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Survey (
    userID int,
    courseID varchar (10),
	semester varchar(20),
    surveyID int UNIQUE,
    PRIMARY KEY (userID, courseID, semester),
    FOREIGN KEY (userID, courseID, semester) REFERENCES Enroll (userID, courseID, semester)
		ON UPDATE CASCADE ON DELETE CASCADE
);

-- Text, Choice
CREATE TABLE Answer_Type(
	answerTypeID int PRIMARY KEY,
    description varchar(20) NOT NULL
);

CREATE TABLE Question (
	questionID	int,
	questionText  varchar(128) NOT NULL,
	answerTypeID	int NOT NULL,
    PRIMARY KEY (questionID),
	FOREIGN KEY (answerTypeID) REFERENCES Answer_Type (answerTypeID)
		ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE Answer_Text (
	surveyID	int,
    questionID int,
	answer varchar(500) NOT NULL,
    voteCount int,
	PRIMARY KEY (surveyID, questionID),
    FOREIGN KEY (surveyID) REFERENCES Survey (surveyID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (questionID) REFERENCES Question (questionID)
		ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE OfferedAnswer (
	offeredAnswerID int AUTO_INCREMENT PRIMARY KEY,
    answerText varchar (40) NOT NULL
);


CREATE TABLE Question_Answer (
	questionID int,
    offeredAnswerID int,
    PRIMARY KEY (questionID, offeredAnswerID),
    FOREIGN KEY (questionID) REFERENCES Question (questionID)
		ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (offeredAnswerID) REFERENCES OfferedAnswer (offeredAnswerID)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Answer_Choice (
	surveyID	int,
    questionID 	int,
	offeredAnswerID int NOT NULL,
	PRIMARY KEY (surveyID, questionID, offeredAnswerID),
    FOREIGN KEY (surveyID) REFERENCES Survey (surveyID)
		ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (questionID, offeredAnswerID) REFERENCES Question_Answer (questionID, offeredAnswerID)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Question_Answer_Statistics(
	questionID int,
    offeredAnswerID int,
    percent decimal(5,2) NOT NULL DEFAULT 0.00,
    PRIMARY KEY (questionID, offeredAnswerID),
    FOREIGN KEY (questionID, offeredAnswerID) REFERENCES Question_Answer (questionID, offeredAnswerID)
		ON UPDATE CASCADE ON DELETE CASCADE
);

/*** TRIGGERS ***/




/** POPULATE DATABASE **/
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
-- Delete from Professor WHERE professorID = 8;
INSERT INTO Professor VALUES (1, 'Nasser','Assem');
INSERT INTO Professor VALUES (2, 'Djallil','Lounnas');
INSERT INTO Professor VALUES (3, 'Jamila','El Kilani');
INSERT INTO Professor VALUES (4, 'Anas','Bentamy');
INSERT INTO Professor VALUES (5, 'Hanaa','Talei');
INSERT INTO Professor VALUES (6, 'Rhizlane','Hammoud');


/* insert into Department*/
INSERT INTO Department VALUES ('CSC','Computer Science');
INSERT INTO Department VALUES ('EMS','Engineering & Management Science');
INSERT INTO Department VALUES ('GE','General Engineering');
INSERT INTO Department VALUES ('BA','Business Administration');
INSERT INTO Department VALUES ('IS','International Studies');
INSERT INTO Department VALUES ('CS','Communication Studies');
INSERT INTO Department VALUES ('HRD','Human Resources Development');
INSERT INTO Department VALUES ('LC','Language Center');


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


DELETE FROM Section WHERE courseID = 'CSC 3309';
/*insert into Section*/
INSERT INTO Section VALUES (01,'GBU 3303','Spring 2016',6);
INSERT INTO Section VALUES (02,'CSC 3326','Fall 2016',1);
INSERT INTO Section VALUES (01,'CSC 2302','Fall 2016',5);
INSERT INTO Section VALUES (02,'HRD 4303','Spring 2015',2);
INSERT INTO Section VALUES (02,'EGR 2402','Summer 2016',4);
INSERT INTO Section VALUES (01,'CSC 3309','Fall 2016',1);


/* insert into Enroll*/
INSERT INTO Enroll VALUES (64313,'GBU 3303','Spring 2016',01);
INSERT INTO Enroll VALUES (71006,'CSC 3326','Fall 2016',02);
INSERT INTO Enroll VALUES (59603,'CSC 2302','Fall 2016',01);
INSERT INTO Enroll VALUES (59609,'CSC 2302','Fall 2016',01);
INSERT INTO Enroll VALUES (71007,'CSC 3326','Fall 2016',02);
INSERT INTO Enroll VALUES (71007,'CSC 3309','Fall 2016',01);


/* insert into Survey */
INSERT INTO Survey VALUES (64313,'GBU 3303','Spring 2016',1);
INSERT INTO Survey VALUES (71006,'CSC 3326','Fall 2016',2);
INSERT INTO Survey VALUES (59603,'CSC 2302','Fall 2016',3);
INSERT INTO Survey VALUES (59609,'CSC 2302','Fall 2016',4);
INSERT INTO Survey VALUES (71007,'CSC 3326','Fall 2016',5);

/* insert into Answer_Type*/
INSERT INTO Answer_Type VALUES (1, 'Text');
INSERT INTO Answer_Type VALUES (2, 'Choice');

/* insert into Question */
INSERT INTO Question VALUES ( 1, 'How many hours do you spend on the homework?', 2);
INSERT INTO Question VALUES ( 2, 'Is the material covered in class relevant to the course?', 1);
INSERT INTO Question VALUES ( 3, 'How many classes sessions did you miss?', 2);
INSERT INTO Question VALUES ( 4, 'Does the professor demonstrate good knowledge of the class material?', 1);
INSERT INTO Question VALUES ( 5, 'Please identify what you consider to be the weaknesses and the strengths of this class', 1);


/* insert into Answer_Text */
INSERT INTO Answer_Text VALUES (1, 2,'The material covered in class is not very relevant to the course!', 0);
INSERT INTO Answer_Text VALUES (2, 2,'This class taught me how to apply theory to practice', 0);
INSERT INTO Answer_Text VALUES (3, 2,'I think that the professor demonstrates good knowledge of the material', 0);
INSERT INTO Answer_Text VALUES (4, 2,'Students participation is encouraged', 0);
INSERT INTO Answer_Text VALUES (5, 2,'The professor gives a lot of assignments and pop quizzes', 0);

/* insert into OfferedAnswer */
INSERT INTO OfferedAnswer VALUES (1,'1-2');
INSERT INTO OfferedAnswer VALUES (2,'2-4');
INSERT INTO OfferedAnswer VALUES (3,'4-6');
INSERT INTO OfferedAnswer VALUES (4,'6-8');
INSERT INTO OfferedAnswer VALUES (5,'8-10');

/* insert into Question_Answer */
INSERT INTO Question_Answer VALUES (1, 1);
INSERT INTO Question_Answer VALUES (1, 2);
INSERT INTO Question_Answer VALUES (1, 3);
INSERT INTO Question_Answer VALUES (1, 4);
INSERT INTO Question_Answer VALUES (1, 5);
INSERT INTO Question_Answer VALUES (3, 1);
INSERT INTO Question_Answer VALUES (3, 2);
INSERT INTO Question_Answer VALUES (3, 3);
INSERT INTO Question_Answer VALUES (3, 4);
INSERT INTO Question_Answer VALUES (3, 5);


DELETE FROM Answer_Choice WHERE questionID = 1;
/* insert into Answer_Choice */
INSERT INTO Answer_Choice VALUES (1,1,1);
INSERT INTO Answer_Choice VALUES (1,3,1);
INSERT INTO Answer_Choice VALUES (2,1,2);
INSERT INTO Answer_Choice VALUES (2,3,2);
INSERT INTO Answer_Choice VALUES (3,1,3);
INSERT INTO Answer_Choice VALUES (3,3,3);
INSERT INTO Answer_Choice VALUES (4,1,1);
INSERT INTO Answer_Choice VALUES (4,3,1);
INSERT INTO Answer_Choice VALUES (5,1,2);
INSERT INTO Answer_Choice VALUES (5,3,2);

/* insert into Question_Answer_Statistics
INSERT INTO Question_Answer_Statistics VALUES ();*/
