
-- accounts table set up

CREATE TABLE IF NOT EXISTS `accounts` (
	`id` int NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
  	`email` varchar(100) NOT NULL,
    `activation_code` varchar(50) DEFAULT '',   
    PRIMARY KEY (`id`, `username`, `email`)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- userdetails
 CREATE TABLE IF NOT EXISTS `userdetails` (
	 `user_id` int NOT NULL,
     `given_name` varchar(50) DEFAULT '',
     `surname` varchar(50) DEFAULT '',
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

INSERT INTO  userdetails ( `user_id` ,  `given_name` , `surname` ) 
VALUES (1,'john' ,  'smith' );

INSERT INTO  addresses  (`user_id`, `street` ,`house` , `city` , `postcode` )
VALUES (1, 'Leszczynska' ,'6/30' , 'Leszno' , '64-100' );


-- courses

CREATE TABLE IF NOT EXISTS `courses` (
    `course_id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(50) NOT NULL,
    `description` varchar NOT NULL,
    `course_cat` ENUM('kpp', 'pp' , 'driving' ) NOT NULL ,
    `course_type` ENUM('normal', 'refresher') DEFAULT 'normal', 
    `start_date` varchar(10) NOT NULL,
    `end_date` varchar(10) NOT NULL,
    `spaces` int NOT NULL,
    `status` ENUM( 'active' , 'cancelled' , 'full' , 'finished' ),  
    PRIMARY KEY (`course_id`) 
     ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


