CREATE DATABASE test;

use test;

CREATE TABLE users (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	sendername VARCHAR(30) NOT NULL,
	recievername VARCHAR(30) NOT NULL,
	destination VARCHAR(50) NOT NULL,
	expecteddate INT(3),
	location VARCHAR(50),
	date TIMESTAMP
);