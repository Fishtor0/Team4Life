
-- accounts table set up

CREATE TABLE IF NOT EXISTS `accounts` (
	`id` int NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL UNIQUE,
  	`password` varchar(255) NOT NULL,
  	`email` varchar(100) NOT NULL UNIQUE,
    `activation_code` varchar(50) DEFAULT '',   
    PRIMARY KEY (`id`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- userdetails
 CREATE TABLE IF NOT EXISTS `userdetails` (
	 `user_id` int NOT NULL,
     `given_name` varchar(50) NOT NULL,
     `surname` varchar(50) NOT NULL,
     `dob` varchar(10) NOT NULL,
     `mobile` varchar(20) DEFAULT '',
    PRIMARY KEY (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `accounts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB CHARSET=utf8;   

-- addresses
CREATE TABLE IF NOT EXISTS `addresses` (
     `user_id` int NOT NULL,
     `street` varchar(50) DEFAULT '' ,
     `house` varchar(20) DEFAULT '',
     `city` varchar(20) DEFAULT '',
     `postcode` varchar(6) DEFAULT '',
    PRIMARY KEY (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `accounts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB CHARSET=utf8;


-- test account

INSERT INTO  accounts  ( `id`, `username`,  `password` ,  `email` ,  `activation_code` ) 
VALUES (1,'test' ,  '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa' ,  'test@test.com' ,  'activated' );

INSERT INTO  userdetails ( `user_id` ,  `given_name` , `surname`,  `dob` ) 
VALUES (1,'john' ,  'smith', '10/02/1980' );

INSERT INTO  addresses  (`user_id`, `street` ,`house` , `city` , `postcode` )
VALUES (1, 'Leszczynska' ,'6/30' , 'Leszno' , '64-100' );


-- courses

CREATE TABLE IF NOT EXISTS `courses` (
    `course_id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(50) NOT NULL,
    `description` text NOT NULL,
    `course_cat` ENUM('kpp', 'pp') NOT NULL,
    `course_type` ENUM('normal', 'refresher') NOT NULL, 
    `start_date` varchar(10) NOT NULL,
    `end_date` varchar(10) NOT NULL,
    `spaces` int NOT NULL,
    `status` ENUM( 'active' , 'cancelled' , 'full' , 'finished' ) NOT NULL, 
    `price` int NOT NULL,
    `deposit` int NOT NULL, 
    PRIMARY KEY (`course_id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userCourses`(
     -- `booking_id` int(11) NOT NULL AUTO_INCREMENT,
     `course_id` int(11) NOT NULL,
     `user_id` int NOT NULL,
     `paymentStatus` ENUM( 'booked','full', 'deposit', 'cancelled', 'refunded' ) NOT NULL,
     `payed_ammount` int (10) Default 0,
     `booking_date` varchar(10) NOT NULL,
     PRIMARY KEY (`course_id`, `user_id`), 
     FOREIGN KEY (`user_id`) REFERENCES `accounts`(`id`),
     FOREIGN KEY (`course_id`) REFERENCES `courses`(`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- test courses
INSERT INTO courses (`course_id`,`title`,`description`,`course_cat`, `start_date`, `end_date`, `spaces`, `status`, `price`, `deposit`)
VALUES (1, 'KPP - Kwalifikowana pierwsza pomoc',
 "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac ipsum eleifend, pretium quam quis, imperdiet justo. Morbi semper, leo",
 'kpp',
 '13/01/2021',
 '12/01/2021',
 20,
 'active',
 100,
 10
 );

INSERT INTO courses (`title`,`description`,`course_cat`, `start_date`, `end_date`, `spaces`, `status`, `price`, `deposit`)
VALUES ('PP - pierwsza pomoc',
 "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta, orci et dapibus iaculis, arcu dui ultricies eros, vel interdum",
 'pp',
 '1/12/2021',
 '12/12/2021',
 40,
 'cancelled',
 200,
 20
 );

-- assign user to course
INSERT INTO userCourses(`course_id`, `user_id`,`booking_date`)
VALUES ( 1, 1, '13/01/2021');

INSERT INTO userCourses(`course_id`, `user_id`,`booking_date`)
VALUES ( 2, 1, '13/01/2021');
