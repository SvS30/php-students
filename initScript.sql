DROP TABLE IF EXISTS users;
CREATE TABLE users (
	    id INT AUTO_INCREMENT PRIMARY KEY,
	    username VARCHAR(255) NOT NULL UNIQUE,
	    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', '$2y$10$fDhrGMRMAwjNplH4XQr4h.CH52yXQ7tCZSKksSkz4l1PpQ/j2Mtza');


DROP TABLE IF EXISTS students;
CREATE TABLE students (
	    id INT AUTO_INCREMENT PRIMARY KEY,
	    name VARCHAR(255) NOT NULL,
	    first_last_name VARCHAR(255) NOT NULL,
	    second_last_name VARCHAR(255) NOT NULL,
	    grade VARCHAR(255) NOT NULL,
	    serial VARCHAR(255) NOT NULL,
	    UNIQUE(serial)
);


INSERT INTO students (name, first_last_name, second_last_name, grade, serial) VALUES
	('Arleth Vanessa', 'Burguete', 'Santos', '5J', 'A210738'),
		('Yenifer Jazmin', 'Clemente', 'Toala', '5J', 'A221711'),
			('Andres', 'Cruz', 'Alvares', '5J', 'A210776'),
				('Celia', 'Cruz', 'Cruz', '5J', 'A210545'),
					('Carlos Mario', 'Dominguez', 'Vazquez', '5J', 'A210540');
