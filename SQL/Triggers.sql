Show Triggers;
DROP TRIGGER IF EXISTS trig_Auto_Create_Survey;

DELIMITER $$
CREATE TRIGGER trig_Auto_Create_Survey AFTER INSERT ON Enroll
FOR EACH ROW
BEGIN

  DECLARE $SurveyIDMax int;
    SELECT MAX(surveyID) INTO $SurveyIDMax
    FROM Survey;
  # If statement to see if there are any surveys
  # If there aren't, insert with surveyID = 1
	IF(NOT EXISTS(SELECT surveyID FROM Survey))
  THEN
    INSERT INTO Survey VALUES (NEW.userID, NEW.courseID, NEW.semester, 1);

  ELSE
    INSERT INTO Survey VALUES (NEW.userID, NEW.courseID, NEW.semester, ($SurveyIDMax + 1));

  END IF;

END;
$$
DELIMITER ;






Show Triggers;
DROP TRIGGER IF EXISTS trig_Create_Stats;

DELIMITER $$
CREATE TRIGGER trig_Create_Stats AFTER INSERT ON Survey
FOR EACH ROW
BEGIN

  # Used for the Statistics by section
	DECLARE $sectionNum1 int;
	DECLARE $courseID1 varchar(10);
	DECLARE $semester1 varchar(20);
	DECLARE $currentQuestionID1 int;
	DECLARE $currentOfferedAnswerID1 int;
	DECLARE $Finished int DEFAULT 0;
  # Used for the Statistics by Course and Professor
  DECLARE $professorID2 int;
	DECLARE $courseID2 varchar(10);
	DECLARE $currentQuestionID2 int;
	DECLARE $currentOfferedAnswerID2 int;
  # Cursor for each question answer. It will be used twice
  DECLARE question_answer_cursor CURSOR FOR
    SELECT questionID, offeredAnswerID FROM Question_Answer
    ORDER BY questionID;

  DECLARE CONTINUE HANDLER
  FOR NOT FOUND SET $Finished = 1;

  # Section ----------------------------------------------------------------------
	# Store data about what section the survey is about
  SELECT sectionNum, courseID, semester
		INTO $sectionNum1, $courseID1, $semester1
    FROM Survey	NATURAL JOIN Enroll
      NATURAL JOIN Section
	WHERE surveyID = NEW.surveyID;

	#  If there are no stats for that section,
	#  then insert every combination of question and answer
	#  into stats table for that section
	IF(NOT exists(SELECT * FROM Question_Answer_Statistics_By_Section
		WHERE sectionNum = $sectionNum1
		AND courseID = $courseID1
		AND semester = $semester1))
	THEN

		# Add an entry in the stats table for every question answer.
		OPEN question_answer_cursor;

		AnswerStat: LOOP

			FETCH question_answer_cursor INTO $currentQuestionID1, $currentOfferedAnswerID1;

			IF $Finished = 1 THEN
				LEAVE AnswerStat;
			END IF;

			# The percent will default to 0.00
			INSERT INTO Question_Answer_Statistics_By_Section
			(sectionNum, courseID, semester, questionID, offeredAnswerID )
			VALUES ($sectionNum1, $courseID1, $semester1, $currentQuestionID1, $currentOfferedAnswerID1);

		END LOOP AnswerStat;

		CLOSE question_answer_cursor;

	END IF;
  # END Section ----------------------------------------------------------------------

  # Course and Professor -----------------------------------------------------
	# Store data about course and professor the survey is about
  SELECT courseID, professorID
  INTO $courseID2, $professorID2
    FROM Survey	NATURAL JOIN Enroll
      NATURAL JOIN Section
	WHERE surveyID = NEW.surveyID;

	#  If there are no stats for that professor and course,
	#  then insert every combination of question and answer
	#  into stats table for that combination
	IF(NOT exists(SELECT * FROM Question_Answer_Statistics_By_Course_And_Professor
		WHERE courseID = $courseID2
		AND professorID = $professorID2))
	THEN

		# Add an entry in the stats table for every question answer.
		OPEN question_answer_cursor;

		AnswerStat: LOOP

			FETCH question_answer_cursor INTO $currentQuestionID2, $currentOfferedAnswerID2;

			IF $Finished = 1 THEN
				LEAVE AnswerStat;
			END IF;

			# The percent will default to 0.00
			INSERT INTO Question_Answer_Statistics_By_Course_And_Professor
			(courseID, professorID, questionID, offeredAnswerID )
			VALUES ($courseID2, $professorID2, $currentQuestionID2, $currentOfferedAnswerID2);

		END LOOP AnswerStat;

		CLOSE question_answer_cursor;

	END IF;
  # END Course and Professor -----------------------------------------------------


END;
$$
DELIMITER ;




SHOW TRIGGERS;
DROP TRIGGER IF EXISTS trig_Update_Stats_After_INSERT;

DELIMITER $$
CREATE TRIGGER trig_Update_Stats_After_INSERT AFTER INSERT ON Answer_Choice
FOR EACH ROW
BEGIN


  # For Section
  BLOCK1: BEGIN

    DECLARE $totalAnswerCount1 int;
    DECLARE $currentOfferedAnswerCount1 int;
    DECLARE $currentOfferedAnswer1 int;
    DECLARE $offeredAnswerID1 int;
    DECLARE $questionID1 int;
    DECLARE $sectionNum1 int;
    DECLARE $courseID1 varchar(10);
    DECLARE $semester1 varchar(20);
    DECLARE $Finished1 int DEFAULT 0;

    # Cursor will be used to calculate the percentages for the answered question.
    # This means only considering the surveys about that section.
    DECLARE answer_choice_cursor1 CURSOR FOR
      SELECT offeredAnswerID, count(offeredAnswerID)
      FROM Answer_Choice
      WHERE questionID = NEW.questionID
            AND surveyID IN (SELECT surveyID FROM Section
        NATURAL JOIN Enroll NATURAL JOIN Survey NATURAL JOIN Answer_Choice
      WHERE sectionNum = $sectionNum1
            AND courseID = $courseID1
            AND semester = $semester1)
      GROUP BY offeredAnswerID;

    DECLARE CONTINUE HANDLER
    FOR NOT FOUND SET $Finished1 = 1;

    # Store data about what section the answer is about, and the answer given
    SELECT DISTINCT sectionNum, courseID, semester, questionID, offeredAnswerID
    INTO $sectionNum1, $courseID1, $semester1, $questionID1, $offeredAnswerID1
    FROM Answer_Choice NATURAL JOIN Survey
      NATURAL JOIN Enroll
      NATURAL JOIN Section
    WHERE surveyID = NEW.surveyID
          AND questionID = NEW.questionID
          AND offeredAnswerID = NEW.offeredAnswerID;


    # Calculate the number of answers for the question about the section
    SET $totalAnswerCount1 =
    (SELECT count(questionID)
     FROM Answer_Choice
     WHERE questionID = NEW.questionID
           AND surveyID IN (SELECT surveyID FROM Section
       NATURAL JOIN Enroll NATURAL JOIN Survey NATURAL JOIN Answer_Choice
     WHERE sectionNum = $sectionNum1
           AND courseID = $courseID1
           AND semester = $semester1));

    OPEN answer_choice_cursor1;
    AnswerStat: LOOP

      FETCH answer_choice_cursor1 INTO $currentOfferedAnswer1, $currentOfferedAnswerCount1;

      IF $Finished1 = 1 THEN
        LEAVE AnswerStat;
      END IF;

      UPDATE Question_Answer_Statistics_By_Section
      SET percent = (($currentOfferedAnswerCount1/$totalAnswerCount1) * 100.0)
      WHERE sectionNum = $sectionNum1
            AND courseID = $courseID1
            AND semester = $semester1
            AND questionID = $questionID1
            AND offeredAnswerID = $currentOfferedAnswer1;

    END LOOP AnswerStat;
    CLOSE answer_choice_cursor1;

  END BLOCK1;

  # For Class and Professor
  BLOCK2: BEGIN


	DECLARE $totalAnswerCount int;
	DECLARE $currentOfferedAnswerCount int;
	DECLARE $currentOfferedAnswer int;
	DECLARE $offeredAnswerID int;
	DECLARE $questionID int;
	DECLARE $courseID varchar(10);
  DECLARE $professorID int;
	DECLARE $Finished int DEFAULT 0;


  # Cursor will be used to calculate the percentages for the answered question.
	# This means only considering the surveys about that professor and course.
	DECLARE answer_choice_cursor CURSOR FOR
		SELECT offeredAnswerID, count(offeredAnswerID)
		FROM Answer_Choice
		WHERE questionID = NEW.questionID
					AND surveyID IN (SELECT surveyID FROM Section
			NATURAL JOIN Enroll NATURAL JOIN Survey NATURAL JOIN Answer_Choice
		WHERE courseID = $courseID
					AND professorID = $professorID)
		GROUP BY offeredAnswerID;


	DECLARE CONTINUE HANDLER
	FOR NOT FOUND SET $Finished = 1;

	# Store data about what course and professor the answer is about, and the answer data
  SELECT DISTINCT courseID, professorID, questionID, offeredAnswerID
  INTO $courseID, $professorID, $questionID, $offeredAnswerID
  FROM Answer_Choice NATURAL JOIN Survey
    NATURAL JOIN Enroll
    NATURAL JOIN Section
  WHERE surveyID = NEW.surveyID
        AND questionID = NEW.questionID
        AND offeredAnswerID = NEW.offeredAnswerID;


	# Calculate the number of answers for the question about the course and professor
	SET $totalAnswerCount =
  (SELECT count(questionID)
   FROM Answer_Choice
   WHERE questionID = NEW.questionID
         AND surveyID IN (SELECT DISTINCT surveyID FROM Section
     NATURAL JOIN Enroll NATURAL JOIN Survey NATURAL JOIN Answer_Choice
   WHERE professorID = $professorID
         AND courseID = $courseID ));

	OPEN answer_choice_cursor;

	AnswerStat: LOOP

		FETCH answer_choice_cursor INTO $currentOfferedAnswer, $currentOfferedAnswerCount;

		IF $Finished = 1 THEN
			LEAVE AnswerStat;
		END IF;

      UPDATE Question_Answer_Statistics_By_Course_And_Professor
			SET percent = (($currentOfferedAnswerCount/$totalAnswerCount) * 100.0)
			WHERE courseID = $courseID
				AND professorID = $professorID
				AND questionID = $questionID
				AND offeredAnswerID = $currentOfferedAnswer;

		END LOOP AnswerStat;
		CLOSE answer_choice_cursor;

  END BLOCK2;

END;
$$
DELIMITER ;


SHOW TRIGGERS;

# Show Triggers;
# DROP TRIGGER IF EXISTS trig_Validate_Course_ID;
#
# DELIMITER $$
# CREATE TRIGGER trig_Validate_Course_ID BEFORE INSERT ON Course
# FOR EACH ROW
# BEGIN
#
#   DECLARE msg VARCHAR(128);
#
# 	IF( NEW.courseID NOT LIKE concat(NEW.departmentID, '%'))
#     THEN
#       SET msg = concat('Course ID must contain the Department ID associated with the course. Incorrect Course ID:  ', cast(new.courseID as char));
#         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
# 	END IF;
#
# END;
# $$
# DELIMITER ;