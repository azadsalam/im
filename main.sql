CREATE DATABASE IF NOT EXISTS im;


DROP TABLE IF EXISTS loc_per;
DROP TABLE IF EXISTS location_assignment_request;
DROP TABLE  IF EXISTS person;
DROP TABLE  IF EXISTS item;
DROP TABLE  IF EXISTS types;
DROP TABLE  IF EXISTS location;


CREATE TABLE types
(
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
	 code CHAR(4) NOT NULL UNIQUE,
	 count INT NOT NULL DEFAULT '0',
	 description VARCHAR(255),
	 pid INT,
     PRIMARY KEY (id),
	 FOREIGN KEY (pid)
		REFERENCES types(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

--ALTER TABLE types ADD count INT NOT NULL DEFAULT '0' AFTER code;
--ALTER TABLE item ADD UNIQUE(name);

CREATE TABLE location
(
    id INT NOT NULL AUTO_INCREMENT,
	name CHAR(50) NOT NULL UNIQUE,
	room_no INT,
	description VARCHAR(255),
	PRIMARY KEY(id)
);

CREATE TABLE item
(
	id INT NOT NULL AUTO_INCREMENT,
	type_id INT,
	name CHAR(50),
	make CHAR(50),
	description VARCHAR(255),
	purchase_date DATE,
	lid INT,
	PRIMARY KEY(id),
	FOREIGN KEY (type_id)
		REFERENCES types(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,			
	FOREIGN KEY (lid)
		REFERENCES location(id)
			ON DELETE SET NULL
			ON UPDATE SET NULL
);

CREATE TABLE person
(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(50) UNIQUE NOT NULL ,
	role CHAR(30),
	PRIMARY KEY(id)
);
ALTER TABLE `person` ADD `full_name` VARCHAR( 50 ) NOT NULL AFTER `name`;

CREATE TABLE location_assignment_request
(
	id INT AUTO_INCREMENT,
	item_id INT NOT NULL,
    pid INT NOT NULL,
	old_location INT,
	new_location INT,
	status CHAR(50) NOT NULL DEFAULT 'PENDING',	
	
    PRIMARY KEY(id),

	FOREIGN KEY(item_id)
		REFERENCES item(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,

	FOREIGN KEY(pid)
		REFERENCES person(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
    
	FOREIGN KEY(old_location)
		REFERENCES location(id)
			ON DELETE SET NULL
			ON UPDATE SET NULL,
			
	FOREIGN KEY(new_location)
		REFERENCES location(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
	
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

INSERT INTO person (name,role) VALUES ('headcse', 'superadmin');
INSERT INTO `im`.`person` (`id`, `name`, `role`) VALUES (NULL, 'testadmin', 'admin'), (NULL, 'testuser', 'user');

--INSERT INTO item(type_id,name,make, description) VALUES(1,'PC-1', 'HP', 'DEMO');
--INSERT INTO `im`.`item` (`id`, `type_id`, `name`, `make`, `description`, `purchase_date`, `lname`) VALUES (NULL, '1', 'PC-2', 'HP', 'DEMO', '2014-12-11', NULL);