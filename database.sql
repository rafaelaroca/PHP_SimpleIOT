
CREATE TABLE `sensors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sensor` int(11) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IP` varchar(50) DEFAULT NULL,
  `s1` float DEFAULT NULL,
  `s2` float DEFAULT NULL,
  `s3` float DEFAULT NULL,
  `s4` float DEFAULT NULL,
  `s5` float DEFAULT NULL,
  `s6` float DEFAULT NULL,
  `s7` float DEFAULT NULL,
  `s8` float DEFAULT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE USER 'iot'@'localhost' IDENTIFIED BY 'your_db_password';
GRANT ALL PRIVILEGES ON iot.* TO 'iot'@'localhost';
FLUSH PRIVILEGES;

