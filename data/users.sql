
CREATE DATABASE slim;
CREATE USER 'slim'@'localhost' IDENTIFIED BY 'SlImPaSs';
GRANT ALL PRIVILEGES ON slim.* TO 'slim'@'localhost';
USE slim;


CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT,
    username CHAR(80) NOT NULL,
    password CHAR(80) NOT NULL,
--  email VARCHAR(100) NOT NULL,
    first VARCHAR(80) NOT NULL,
    last VARCHAR(80) NOT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    changed TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--  UNIQUE INDEX (email),
    PRIMARY KEY (user_id)
) ENGINE=INNODB;
 
INSERT INTO `users` (`user_id`, `username`, `password`, `first`, `last`) VALUES
(1, 'hamr', 'hamr1234!', 'Mike', 'Hammer'),
(2, 'saw', 'saw1234!', 'Buzz', 'Saw'),
(3, 'wrench', 'wren1234!', 'Wendy', 'Wrench'),
(4, 'pliers', 'plir1234!', 'Pete', 'Pliers'),
(5, 'clamp', 'clmp1234!', 'Ellie Mae', 'Clamp');


