CREATE DATABASE e_learning;

CREATE TABLE courses(
	id int AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	image VARCHAR(37) NOT NULL,
	description TEXT
);

CREATE TABLE students(
	id int AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(32) NOT NULL
);

CREATE TABLE courses_has_students(
	id int AUTO_INCREMENT PRIMARY KEY,
	course_id int NOT NULL,
	student_id int NOT NULL,
	FOREIGN KEY(course_id) REFERENCES courses(id),
	FOREIGN KEY(student_id) REFERENCES students(id)
);

CREATE TABLE modules(
	id int AUTO_INCREMENT PRIMARY KEY,
	course_id int NOT NULL,
	name VARCHAR(50) NOT NULL,
	FOREIGN KEY(course_id) REFERENCES courses(id)
);

CREATE TABLE lessons(
	id int AUTO_INCREMENT PRIMARY KEY,
	module_id int NOT NULL,
	course_id int NOT NULL,
	type VARCHAR(20) NOT NULL,
	lesson_order INT NOT NULL,
	FOREIGN KEY(module_id) REFERENCES modules(id),
	FOREIGN KEY(course_id) REFERENCES courses(id)
);

CREATE TABLE videos(
	id int AUTO_INCREMENT PRIMARY KEY,
	lesson_id int NOT NULL,
	name VARCHAR(50) NOT NULL,
	description TEXT,
	url VARCHAR(50),
	FOREIGN KEY(lesson_id) REFERENCES lessons(id)
);

CREATE TABLE questionnaires(
	id int AUTO_INCREMENT PRIMARY KEY,
	lesson_id int NOT NULL,
	question VARCHAR(150),
	option1 VARCHAR(150),
	option2 VARCHAR(150),
	option3 VARCHAR(150),
	option4 VARCHAR(150),
	answer TINYINT(1) NOT NULL,
	FOREIGN KEY(lesson_id) REFERENCES lessons(id)
);

CREATE TABLE historic(
	id int AUTO_INCREMENT PRIMARY KEY,
	date_view DATETIME NOT NULL,
	student_id int NOT NULL,
	lesson_id int NOT NULL,
	FOREIGN KEY(student_id) REFERENCES students(id),
	FOREIGN KEY(lesson_id) REFERENCES lessons(id)
);