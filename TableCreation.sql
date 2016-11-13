DROP TABLE IF EXISTS Answer_Text_Statistics;
DROP TABLE IF EXISTS Answer_Choice_Statistics;
DROP TABLE IF EXISTS Answer_Choice;
DROP TABLE IF EXISTS Question_Answer;
DROP TABLE IF EXISTS Answer_Text;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS Answer_Type;
DROP TABLE IF EXISTS Survey;
DROP TABLE IF EXISTS OfferedAnswer;
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
<<<<<<< HEAD
		ON UPDATE CASCADE ON DELETE CASCADE
=======
		ON UPDATE CASCADE ON DELETE NO ACTION
>>>>>>> master
);

CREATE TABLE Student (
	userID int PRIMARY KEY,
	currentYear int, 
	major	varchar(50) NOT NULL,
    FOREIGN KEY (userID) REFERENCES System_User (userID)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Professor (
	professorID int PRIMARY KEY,
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
<<<<<<< HEAD
		ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (sectionNum) REFERENCES Section (sectionNum)
		ON UPDATE CASCADE ON DELETE NO ACTION
=======
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (sectionNum, courseID, semester) REFERENCES Section (sectionNum, courseID, semester) 
		ON UPDATE CASCADE ON DELETE CASCADE
>>>>>>> master
);

CREATE TABLE OfferedAnswer (
	offeredAnswerID int PRIMARY KEY,
  answerText varchar (40) NOT NULL
);

CREATE TABLE Survey (
	surveyID int PRIMARY KEY,
    userID int,
    courseID varchar (10),
	semester varchar(20),
    FOREIGN KEY (userID, courseID, semester) REFERENCES Enroll(userID, courseID, semester)
		ON UPDATE CASCADE ON DELETE CASCADE
);

-- Text, Choice
CREATE TABLE Answer_Type(
	answerTypeID int PRIMARY KEY,
    description varchar(20) NOT NULL
);

CREATE TABLE Question (
	questionID	int,
    surveyID	int,
	questionText  varchar(128) NOT NULL,
	answerTypeID	varchar(20) NOT NULL,
    PRIMARY KEY (questionID, surveyID),
    FOREIGN KEY (surveyID) REFERENCES Survey (surveyID) 
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (answerTypeID) REFERENCES Answer_Type (answerTypeID)
		ON UPDATE CASCADE ON DELETE CASCADE
);
-- it doesnt like the answer type foreign key


CREATE TABLE Answer_Text (
<<<<<<< HEAD
	userID int,
=======
>>>>>>> master
	questionID int,
    surveyID	int,
    answerTypeID varchar(20) NOT NULL,
	answer varchar(500) NOT NULL,
<<<<<<< HEAD
	PRIMARY KEY (userID, questionID),
	FOREIGN KEY (questionID) REFERENCES Question (questionID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (userID) REFERENCES Student (userID)
=======
    voteCount int,
	PRIMARY KEY (questionID, surveyID),
	FOREIGN KEY (questionID, surveyID) REFERENCES Question (questionID, surveyID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (userID) REFERENCES Student (userID)
		ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (answerTypeID) REFERENCES Answer_Type (answerTypeID)
>>>>>>> master
		ON UPDATE CASCADE ON DELETE NO ACTION
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
<<<<<<< HEAD
	userID int,
=======
>>>>>>> master
	questionID int,
    surveyID	int,
	offeredAnswerID int NOT NULL,
<<<<<<< HEAD
	PRIMARY KEY (userID, questionID),
=======
	PRIMARY KEY (questionID, surveyID),
>>>>>>> master
    FOREIGN KEY (offeredAnswerID) REFERENCES OfferedAnswer (offeredAnswerID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (questionID, surveyID) REFERENCES Question (questionID, surveyID)
		ON UPDATE CASCADE ON DELETE CASCADE,
	 FOREIGN KEY (userID) REFERENCES Student (userID)
		 ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE Answer_Choice_Statistics(
	questionID int,
    offeredAnswerID int,
    percent decimal(3,2) NOT NULL,
    PRIMARY KEY (questionID, offeredAnswerID),
    FOREIGN KEY (questionID, offeredAnswerID) REFERENCES Question_Answer (questionID, offeredAnswerID)
		ON UPDATE CASCADE ON DELETE CASCADE
);

<<<<<<< HEAD
CREATE TABLE Answer_Text_Statistics(
	userID int,
	questionID int,
    voteCount int,
    PRIMARY KEY (userID, questionID),
    FOREIGN KEY (userID, questionID) REFERENCES Answer_Text (userID, questionID)
		ON UPDATE CASCADE ON DELETE CASCADE
);
=======
-- TODO: Just create another attribute in Answer Text?

-- CREATE TABLE Answer_Text_Statistics(
-- 	userID int,
--  	questionID int,
--     voteCount int,
-- 	PRIMARY KEY (userID, questionID),
--     FOREIGN KEY (userID, questionID) REFERENCES Answer_Text (userID, questionID)
-- 		ON UPDATE CASCADE ON DELETE CASCADE
-- );

>>>>>>> master
