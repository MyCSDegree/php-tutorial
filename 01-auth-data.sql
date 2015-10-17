CREATE DATABASE `auth_db`;
USE `auth_db`;
CREATE TABLE IF NOT EXISTS `auth_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` char(10) NOT NULL,
  `pass` char(40) NOT NULL,
  `name` char(30) NOT NULL,
  PRIMARY KEY (`regno`)
);
