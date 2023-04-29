DROP TABLE IF EXISTS registration;
CREATE TABLE IF NOT EXISTS registration(
  roll_no varchar(10) NOT NULL,
  course_code varchar(10) NOT NULL,
  UNIQUE KEY roll_no (roll_no,course_code),
  KEY course_code (course_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO registration (roll_no, course_code) VALUES
('P19-6015', 'CL203'),
('P19-6005', 'CL205'),
('P19-6015', 'CL304'),
('P19-6005', 'CS304'),
('P19-6015', 'CS205'),
('P19-6015', 'CS208');

ALTER TABLE registration
CONSTRAINT registration_ibfk_1 FOREIGN KEY (roll_no) REFERENCES student (roll_no),
CONSTRAINT registration_ibfk_2 FOREIGN KEY (course_code) REFERENCES courses (course_code);
COMMIT; 