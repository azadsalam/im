CREATE DATABASE im;

--DROP TABLE IF EXISTS sub_types;
DROP TABLE IF EXISTS loc_per;
DROP TABLE  IF EXISTS item;
DROP TABLE  IF EXISTS types;
DROP TABLE  IF EXISTS location;
DROP TABLE  IF EXISTS person;

CREATE TABLE types
(
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
	 description VARCHAR(255),
	 pid INT,
     PRIMARY KEY (id),
	 FOREIGN KEY (pid)
		REFERENCES types(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);


CREATE TABLE location
(
	name CHAR(50) NOT NULL,
	room_no INT,
	description VARCHAR(255),
	PRIMARY KEY(name)
);

CREATE TABLE item
(
	id INT NOT NULL AUTO_INCREMENT,
	type_id INT,
	name CHAR(50),
	make CHAR(50),
	description VARCHAR(255),
	purchase_date DATE,
	lname CHAR(50),
	PRIMARY KEY(id),
	FOREIGN KEY (type_id)
		REFERENCES types(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
			
	FOREIGN KEY (lname)
		REFERENCES location(name)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE location_assignment
(
	iid INT,
	old_location CHAR(50),
	new_location CHAR(50),
	status CHAR(50),
	
	FOREIGN KEY(iid)
		REFERENCES item(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
			
	FOREIGN KEY(old_location)
		REFERENCES location(name)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
			
	FOREIGN KEY(new_location)
		REFERENCES location(name)
			ON DELETE CASCADE
			ON UPDATE CASCADE
	
);

CREATE TABLE person
(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(50),
	role CHAR(30),
	PRIMARY KEY(id)
);


CREATE TABLE loc_per
(
	lname CHAR(50),
	pid INT,
	role CHAR(50),
	PRIMARY KEY(role),
	FOREIGN KEY (lname)
		REFERENCES location(name)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY (pid)
		REFERENCES person(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);


/*
CREATE TABLE sub_types
(
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(50) NOT NULL,
	 description VARCHAR(255),
	 type_id INT NOT NULL,
     PRIMARY KEY (id),
	 FOREIGN KEY (type_id)
		REFERENCES types(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);
*/
