DROP TABLE IF EXISTS courses;
CREATE TABLE IF NOT EXISTS courses (
  course_code varchar(10) NOT NULL,
  course_name varchar(30) NOT NULL,
  credit_hours int(10) NOT NULL,
  PRIMARY KEY (course_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO courses (course_code, course_name, credit_hours) VALUES
('CL203', 'Database Systems Lab', 1),
('CL205', 'Operating Systems Lab', 1),
('CS203', 'Database Systems', 3),
('CS205', 'Operating Systems', 3),
('CS208', 'Numerical Computing', 3),
('CS304', 'Software Design and Analysis', 3),
('CS305', 'Theory of Automata', 3);