-- --------------------------------------------------------
-- Host:                         34.208.253.55
-- Server version:               10.0.24-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             9.4.0.5169
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for HackingSim
CREATE DATABASE IF NOT EXISTS `HackingSim` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `HackingSim`;

-- Dumping structure for table HackingSim.attempts
CREATE TABLE IF NOT EXISTS `attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table HackingSim.attempts: ~3 rows (approximately)
/*!40000 ALTER TABLE `attempts` DISABLE KEYS */;
INSERT INTO `attempts` (`id`, `ip`, `expiredate`) VALUES
	(1, '172.58.41.219, 66.249.84.28', '2017-04-05 02:17:51'),
	(2, '172.58.46.167, 66.249.84.9', '2017-04-05 02:30:37'),
	(5, '172.58.40.9', '2017-04-05 03:31:06');
/*!40000 ALTER TABLE `attempts` ENABLE KEYS */;

-- Dumping structure for view HackingSim.computer
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `computer` (
	`ComputerID` INT(11) NOT NULL,
	`ComputerName` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`ComputerHostName` VARCHAR(256) NOT NULL COLLATE 'utf8_unicode_ci',
	`ComputerDomain` VARCHAR(256) NOT NULL COLLATE 'utf8_unicode_ci',
	`ComputerIP` VARCHAR(31) NULL COLLATE 'utf8mb4_general_ci',
	`Subnet` INT(11) NULL,
	`CIDR` VARCHAR(43) NULL COLLATE 'utf8mb4_general_ci',
	`NetworkName` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for table HackingSim.Computers
CREATE TABLE IF NOT EXISTS `Computers` (
  `ComputerID` int(11) NOT NULL AUTO_INCREMENT,
  `ComputerHostName` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ComputerDomain` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ComputerIP` int(11) unsigned NOT NULL,
  `ComputerNetwork` int(11) DEFAULT NULL,
  `ComputerActive` int(11) DEFAULT '1',
  PRIMARY KEY (`ComputerID`),
  UNIQUE KEY `ComputerIP` (`ComputerIP`),
  KEY `fkNetwork` (`ComputerNetwork`),
  CONSTRAINT `fkNetwork` FOREIGN KEY (`ComputerNetwork`) REFERENCES `Networks` (`NetworkID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table HackingSim.Computers: ~15 rows (approximately)
/*!40000 ALTER TABLE `Computers` DISABLE KEYS */;
INSERT INTO `Computers` (`ComputerID`, `ComputerHostName`, `ComputerDomain`, `ComputerIP`, `ComputerNetwork`, `ComputerActive`) VALUES
	(1, 'shopping', 'walmart.com', 55840155, 6, 1),
	(2, 'dns1', 'walfart.com', 406579333, 1, 1),
	(3, 'main', 'slayer1of1.players.net', 485356845, 3, 1),
	(11, 'www', 'nunetnetworks.net', 423729111, 4, 1),
	(12, 'db1', 'nunetnetworks.net', 423728927, 4, 1),
	(13, 'db2', 'nunetnetworks.net', 423729016, 4, 1),
	(14, 'ad1', 'nunetnetworks.net', 423729013, 4, 1),
	(15, 'ad2', 'nunetnetworks.net', 423729115, 4, 1),
	(16, 'gateway', 'nunetnetworks.net', 423728897, 4, 1),
	(26, 'honeypot1', 'bing.com', 3886089214, 7, 1),
	(27, 'student-accounts', 'uoftech.edu', 1325886735, 5, 1),
	(28, 'gateway', 'slayer1of1.players.net', 485356801, 3, 1),
	(29, 'gateway', 'csc.net', 55840001, 6, 1),
	(30, 'gateway', 'fbi.gov', 3886088961, 7, 1),
	(31, 'main', 'srainsdon.players.net', 485356875, 12, 1);
/*!40000 ALTER TABLE `Computers` ENABLE KEYS */;

-- Dumping structure for table HackingSim.config
CREATE TABLE IF NOT EXISTS `config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `setting` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.config: ~38 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`setting`, `value`) VALUES
	('attack_mitigation_time', '+30 minutes'),
	('attempts_before_ban', '30'),
	('attempts_before_verify', '5'),
	('bcrypt_cost', '10'),
	('cookie_domain', NULL),
	('cookie_forget', '+30 minutes'),
	('cookie_http', '0'),
	('cookie_name', 'authID'),
	('cookie_path', '/'),
	('cookie_remember', '+1 month'),
	('cookie_secure', '0'),
	('emailmessage_suppress_activation', '0'),
	('emailmessage_suppress_reset', '0'),
	('mail_charset', 'UTF-8'),
	('password_min_score', '3'),
	('request_key_expiration', '+10 minutes'),
	('site_activation_page', 'activate'),
	('site_email', 'no-reply@phpauth.cuonic.com'),
	('site_key', 'fghuior.)/!/jdUkd8s2!7HVHG7777ghg'),
	('site_name', 'Hacking Sim'),
	('site_password_reset_page', '/reset/'),
	('site_timezone', 'America/Los_Angeles'),
	('site_url', 'https://gamesim.herokuapp.com'),
	('smtp', '0'),
	('smtp_auth', '1'),
	('smtp_host', 'smtp.example.com'),
	('smtp_password', 'password'),
	('smtp_port', '25'),
	('smtp_security', NULL),
	('smtp_username', 'email@example.com'),
	('table_attempts', 'attempts'),
	('table_requests', 'requests'),
	('table_sessions', 'sessions'),
	('table_users', 'users'),
	('verify_email_max_length', '100'),
	('verify_email_min_length', '5'),
	('verify_email_use_banlist', '1'),
	('verify_password_min_length', '3');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Dumping structure for table HackingSim.FileSystems
CREATE TABLE IF NOT EXISTS `FileSystems` (
  `fsID` int(11) NOT NULL AUTO_INCREMENT,
  `Computer` int(11) NOT NULL DEFAULT '0',
  `fsName` varchar(256) NOT NULL DEFAULT '0',
  `fsType` enum('D','F','L') NOT NULL DEFAULT 'D',
  `fsLft` int(11) NOT NULL DEFAULT '0',
  `fsRgt` int(11) NOT NULL DEFAULT '0',
  `fsParent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fsID`),
  KEY `ComputerFS` (`Computer`),
  CONSTRAINT `ComputerFS` FOREIGN KEY (`Computer`) REFERENCES `Computers` (`ComputerID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.FileSystems: ~21 rows (approximately)
/*!40000 ALTER TABLE `FileSystems` DISABLE KEYS */;
INSERT INTO `FileSystems` (`fsID`, `Computer`, `fsName`, `fsType`, `fsLft`, `fsRgt`, `fsParent`) VALUES
	(1, 3, '/', 'D', 1, 16, 0),
	(3, 3, 'home', 'D', 2, 9, 1),
	(4, 3, 'etc', 'D', 6, 11, 1),
	(6, 3, 'www', 'D', 9, 14, 8),
	(7, 3, 'Documents', 'D', 3, 8, 3),
	(8, 3, 'var', 'D', 8, 15, 1),
	(9, 2, '/', 'D', 1, 6, 0),
	(10, 1, '/', 'D', 1, 14, 0),
	(11, 14, '/', 'D', 1, 2, 0),
	(12, 15, '/', 'D', 1, 2, 0),
	(13, 12, '/', 'D', 1, 2, 0),
	(14, 13, '/', 'D', 1, 2, 0),
	(15, 16, '/', 'D', 1, 2, 0),
	(16, 11, '/', 'D', 1, 2, 0),
	(18, 1, 'NewFolder', 'D', 2, 3, 10),
	(19, 1, 'etc', 'D', 4, 9, 10),
	(20, 1, 'bind6', 'D', 5, 6, 19),
	(21, 1, 'ssh', 'D', 7, 8, 19),
	(22, 1, 'log', 'D', 10, 11, 10),
	(23, 2, 'var', 'D', 2, 5, 9),
	(24, 2, 'log', 'D', 3, 4, 23);
/*!40000 ALTER TABLE `FileSystems` ENABLE KEYS */;

-- Dumping structure for table HackingSim.groupPermission
CREATE TABLE IF NOT EXISTS `groupPermission` (
  `gpID` int(11) NOT NULL AUTO_INCREMENT,
  `gpGroup` int(11) NOT NULL,
  `gpPermission` int(11) NOT NULL,
  PRIMARY KEY (`gpID`),
  KEY `gpfkGroup` (`gpGroup`),
  KEY `gpfkPermision` (`gpPermission`),
  CONSTRAINT `gpfkGroup` FOREIGN KEY (`gpGroup`) REFERENCES `groups` (`groupID`),
  CONSTRAINT `gpfkPermision` FOREIGN KEY (`gpPermission`) REFERENCES `permissions` (`permissionID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.groupPermission: ~9 rows (approximately)
/*!40000 ALTER TABLE `groupPermission` DISABLE KEYS */;
INSERT INTO `groupPermission` (`gpID`, `gpGroup`, `gpPermission`) VALUES
	(1, 5, 1),
	(2, 5, 2),
	(3, 5, 3),
	(4, 2, 3),
	(6, 5, 4),
	(7, 5, 5),
	(9, 4, 2),
	(10, 4, 2),
	(11, 4, 1);
/*!40000 ALTER TABLE `groupPermission` ENABLE KEYS */;

-- Dumping structure for table HackingSim.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `groupID` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(50) NOT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.groups: ~4 rows (approximately)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`groupID`, `groupName`) VALUES
	(1, 'Guest'),
	(2, 'Member'),
	(3, 'Moderator'),
	(4, 'Administrator'),
	(5, 'Owner');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table HackingSim.log4php_log
CREATE TABLE IF NOT EXISTS `log4php_log` (
  `timestamp` datetime DEFAULT NULL,
  `logger` varchar(256) DEFAULT NULL,
  `level` varchar(32) DEFAULT NULL,
  `message` varchar(4000) DEFAULT NULL,
  `thread` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `line` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.log4php_log: ~106 rows (approximately)
/*!40000 ALTER TABLE `log4php_log` DISABLE KEYS */;
INSERT INTO `log4php_log` (`timestamp`, `logger`, `level`, `message`, `thread`, `file`, `line`) VALUES
	('2017-04-07 02:37:12', 'Main', 'DEBUG', 'admin/logs/', 110, '/app/public/index.php', '14'),
	('2017-04-07 02:37:21', 'Main', 'DEBUG', 'login/', 111, '/app/public/index.php', '14'),
	('2017-04-07 02:37:31', 'Main', 'DEBUG', 'login/signin/', 112, '/app/public/index.php', '14'),
	('2017-04-07 02:37:42', 'Main', 'DEBUG', 'admin/log/', 113, '/app/public/index.php', '14'),
	('2017-04-07 02:41:43', 'Main', 'DEBUG', 'admin/log/', 110, '/app/public/index.php', '14'),
	('2017-04-07 02:41:51', 'Main', 'DEBUG', 'login/', 111, '/app/public/index.php', '14'),
	('2017-04-07 02:42:02', 'Main', 'DEBUG', 'login/signin/', 112, '/app/public/index.php', '14'),
	('2017-04-07 02:42:23', 'Main', 'DEBUG', 'admin/log/', 113, '/app/public/index.php', '14'),
	('2017-04-07 04:09:12', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-07 04:11:06', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-07 12:03:18', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-07 12:03:24', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-07 12:03:26', 'root', 'ERROR', 'Trying to get property of non-object', 112, '/app/classes/runtime.class.php', '26'),
	('2017-04-07 12:03:27', 'root', 'ERROR', 'Trying to get property of non-object', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-07 12:33:26', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 17:05:36', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 17:05:43', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 17:05:44', 'root', 'ERROR', 'Trying to get property of non-object', 112, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 17:05:45', 'root', 'ERROR', 'Trying to get property of non-object', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 17:05:54', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 19:03:07', 'root', 'ERROR', 'Undefined variable: bin', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 20:11:11', 'root', 'ERROR', 'Undefined offset: 1', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 21:16:06', 'root', 'ERROR', 'Allowed memory size of 134217728 bytes exhausted (tried to allocate 67108872 bytes)', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 21:19:55', 'root', 'ERROR', 'Allowed memory size of 134217728 bytes exhausted (tried to allocate 67108872 bytes)', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 21:22:24', 'root', 'ERROR', 'Allowed memory size of 134217728 bytes exhausted (tried to allocate 67108872 bytes)', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 21:23:48', 'root', 'ERROR', 'Allowed memory size of 134217728 bytes exhausted (tried to allocate 67108872 bytes)', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 21:26:10', 'root', 'ERROR', 'Allowed memory size of 134217728 bytes exhausted (tried to allocate 67108872 bytes)', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 21:28:05', 'root', 'ERROR', 'Allowed memory size of 134217728 bytes exhausted (tried to allocate 67108872 bytes)', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 21:31:06', 'root', 'ERROR', 'Uncaught Error: Call to undefined method ipv4::address() in /app/public/home.php:11\nStack trace:\n#0 /app/public/index.php(90): include_once()\n#1 {main}\n  thrown', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:20:51', 'root', 'ERROR', 'Uncaught Error: Call to undefined method ipv4::address() in /app/public/home.php:11\nStack trace:\n#0 /app/public/index.php(90): include_once()\n#1 {main}\n  thrown', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:27:34', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:27:48', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:28:01', 'root', 'ERROR', 'Trying to get property of non-object', 112, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:28:09', 'root', 'ERROR', 'Trying to get property of non-object', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:35:08', 'root', 'ERROR', 'Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:74\nStack trace:\n#0 /app/classes/userManager.class.php(74): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#2 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#3 {main}\n  thrown', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:35:18', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:35:24', 'root', 'ERROR', 'Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:74\nStack trace:\n#0 /app/classes/userManager.class.php(74): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#2 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#3 {main}\n  thrown', 112, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:35:33', 'root', 'ERROR', 'Trying to get property of non-object', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:36:06', 'root', 'ERROR', 'Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:74\nStack trace:\n#0 /app/classes/userManager.class.php(74): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#2 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#3 {main}\n  thrown', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:36:58', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:37:09', 'root', 'ERROR', 'Trying to get property of non-object', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:37:25', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:37:38', 'root', 'ERROR', 'Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:74\nStack trace:\n#0 /app/classes/userManager.class.php(74): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#2 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#3 {main}\n  thrown', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:43:17', 'root', 'ERROR', 'Uncaught Error: Call to a member function debug() on null in /app/classes/userManager.class.php:67\nStack trace:\n#0 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#1 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#2 {main}\n  thrown', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:45:53', 'root', 'ERROR', 'Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:83\nStack trace:\n#0 /app/classes/userManager.class.php(83): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#2 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#3 {main}\n  thrown', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:53:48', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 22:53:48', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 22:53:48', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 22:53:48', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 110\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 22:53:48', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:54:02', 'Main', 'DEBUG', 'cmd = /', 111, '/app/public/index.php', '12'),
	('2017-04-12 22:54:02', 'Main', 'DEBUG', 'login/', 111, '/app/public/index.php', '14'),
	('2017-04-12 22:54:02', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 111, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 22:54:02', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:54:14', 'Main', 'DEBUG', 'cmd = /', 112, '/app/public/index.php', '12'),
	('2017-04-12 22:54:14', 'Main', 'DEBUG', 'login/signin/', 112, '/app/public/index.php', '14'),
	('2017-04-12 22:54:16', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 112, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 22:54:16', 'root', 'ERROR', 'Trying to get property of non-object', 112, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 22:54:50', 'Main', 'DEBUG', 'cmd = /', 113, '/app/public/index.php', '12'),
	('2017-04-12 22:54:50', 'Main', 'DEBUG', 'admin/computer/', 113, '/app/public/index.php', '14'),
	('2017-04-12 22:54:50', 'Main', 'DEBUG', 'cmd = /admin/', 113, '/app/public/index.php', '19'),
	('2017-04-12 22:54:51', 'root', 'DEBUG', 'Array\n(\n    [type] => 1\n    [message] => Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:83\nStack trace:\n#0 /app/classes/userManager.class.php(83): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#2 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#3 {main}\n  thrown\n    [file] => /app/classes/userManager.class.php\n    [line] => 83\n)\n', 113, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 22:54:52', 'root', 'ERROR', 'Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:83\nStack trace:\n#0 /app/classes/userManager.class.php(83): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_DASHBOARD\')\n#2 /app/public/index.php(20): sns_Extras->checkACL(\'ADMIN_DASHBOARD\')\n#3 {main}\n  thrown', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:00:03', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:00:03', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:00:03', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:00:04', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:00:04', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:00:05', 'root', 'DEBUG', 'Array\n(\n    [type] => 1\n    [message] => Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:83\nStack trace:\n#0 /app/classes/userManager.class.php(83): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_COMPUTER\')\n#2 /app/public/admin/computer.php(9): sns_Extras->checkACL(\'ADMIN_COMPUTER\')\n#3 /app/public/index.php(26): include_once(\'/app/public/adm...\')\n#4 {main}\n  thrown\n    [file] => /app/classes/userManager.class.php\n    [line] => 83\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:00:05', 'root', 'ERROR', 'Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\' at line 1 in /app/classes/userManager.class.php:83\nStack trace:\n#0 /app/classes/userManager.class.php(83): PDO->query(\'SELECT permissi...\')\n#1 /app/classes/sns_Extras.class.php(28): userManager->isAuthorised(\'ADMIN_COMPUTER\')\n#2 /app/public/admin/computer.php(9): sns_Extras->checkACL(\'ADMIN_COMPUTER\')\n#3 /app/public/index.php(26): include_once(\'/app/public/adm...\')\n#4 {main}\n  thrown', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:01:50', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:01:50', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:01:50', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:01:50', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:01:50', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:01:50', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:01:51', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:15:33', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:15:33', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:15:33', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:15:33', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:15:33', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:15:34', 'sqlManager', 'DEBUG', 'addComputer sql query: INSERT INTO Computers (ComputerHostName,  ComputerDomain,  ComputerIP, ComputerNetwork) VALUES (\'main\', \'srainsdon.players.net\', INET_ATON(\'28.237.245.75\'), 12)', 110, '/app/classes/sqlManager.class.php', '85'),
	('2017-04-12 23:15:34', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:15:34', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:16:40', 'Main', 'DEBUG', 'cmd = /', 111, '/app/public/index.php', '12'),
	('2017-04-12 23:16:40', 'Main', 'DEBUG', 'admin/computer/', 111, '/app/public/index.php', '14'),
	('2017-04-12 23:16:40', 'Main', 'DEBUG', 'cmd = /admin/', 111, '/app/public/index.php', '19'),
	('2017-04-12 23:16:41', 'Main', 'DEBUG', 'cmd = /admin/computer/', 111, '/app/public/index.php', '24'),
	('2017-04-12 23:16:41', 'Main', 'ERROR', 'Starting Computer.php', 111, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:16:41', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 111, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:16:41', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:22:31', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:22:31', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:22:31', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:22:31', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:22:32', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:22:32', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Undefined index: ComputerName\n    [file] => /app/smarty/templates_c/15601c13229dabb5bbe138b9bf43ec50cb0ea5e0_0.file.list.tpl.php\n    [line] => 116\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:22:32', 'root', 'ERROR', 'Undefined index: ComputerName', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:26:44', 'Main', 'DEBUG', 'cmd = /', 111, '/app/public/index.php', '12'),
	('2017-04-12 23:26:44', 'Main', 'DEBUG', 'admin/computer/', 111, '/app/public/index.php', '14'),
	('2017-04-12 23:26:44', 'Main', 'DEBUG', 'cmd = /admin/', 111, '/app/public/index.php', '19'),
	('2017-04-12 23:26:44', 'Main', 'DEBUG', 'cmd = /admin/computer/', 111, '/app/public/index.php', '24'),
	('2017-04-12 23:26:44', 'Main', 'ERROR', 'Starting Computer.php', 111, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:26:45', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Undefined index: ComputerName\n    [file] => /app/smarty/templates_c/15601c13229dabb5bbe138b9bf43ec50cb0ea5e0_0.file.list.tpl.php\n    [line] => 116\n)\n', 111, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:26:45', 'root', 'ERROR', 'Undefined index: ComputerName', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:27:17', 'Main', 'DEBUG', 'cmd = /', 112, '/app/public/index.php', '12'),
	('2017-04-12 23:27:17', 'Main', 'DEBUG', 'admin/computer/', 112, '/app/public/index.php', '14'),
	('2017-04-12 23:27:17', 'Main', 'DEBUG', 'cmd = /admin/', 112, '/app/public/index.php', '19'),
	('2017-04-12 23:27:17', 'Main', 'DEBUG', 'cmd = /admin/computer/', 112, '/app/public/index.php', '24'),
	('2017-04-12 23:27:17', 'Main', 'ERROR', 'Starting Computer.php', 112, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:27:18', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 112, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:27:18', 'root', 'ERROR', 'Trying to get property of non-object', 112, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:32:55', 'Main', 'DEBUG', 'cmd = /', 113, '/app/public/index.php', '12'),
	('2017-04-12 23:32:55', 'Main', 'DEBUG', 'api/v1/json/computers/', 113, '/app/public/index.php', '14'),
	('2017-04-12 23:32:55', 'Main', 'DEBUG', 'cmd = /api/v1/', 113, '/app/public/api.php', '17'),
	('2017-04-12 23:32:55', 'root', 'DEBUG', '', 113, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:32:55', 'root', 'DEBUG', 'Script ended normally', 113, '/app/classes/runtime.class.php', '24'),
	('2017-04-12 23:32:59', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:32:59', 'Main', 'DEBUG', 'api/v1/json/computers/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:32:59', 'Main', 'DEBUG', 'cmd = /api/v1/', 110, '/app/public/api.php', '17'),
	('2017-04-12 23:32:59', 'root', 'DEBUG', '', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:32:59', 'root', 'DEBUG', 'Script ended normally', 110, '/app/classes/runtime.class.php', '24'),
	('2017-04-12 23:38:03', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:38:04', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:38:04', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:38:04', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:38:04', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:38:04', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:38:04', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:39:27', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:39:27', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:39:27', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:39:27', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:39:27', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:39:27', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:39:28', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:40:15', 'Main', 'DEBUG', 'cmd = /', 111, '/app/public/index.php', '12'),
	('2017-04-12 23:40:15', 'Main', 'DEBUG', 'admin/computer/', 111, '/app/public/index.php', '14'),
	('2017-04-12 23:40:15', 'Main', 'DEBUG', 'cmd = /admin/', 111, '/app/public/index.php', '19'),
	('2017-04-12 23:40:15', 'Main', 'DEBUG', 'cmd = /admin/computer/', 111, '/app/public/index.php', '24'),
	('2017-04-12 23:40:15', 'Main', 'ERROR', 'Starting Computer.php', 111, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:40:16', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 111, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:40:16', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:43:04', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:43:04', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:43:04', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:43:04', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:43:04', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:43:05', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:43:05', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:43:28', 'Main', 'DEBUG', 'cmd = /', 111, '/app/public/index.php', '12'),
	('2017-04-12 23:43:28', 'Main', 'DEBUG', 'admin/computer/', 111, '/app/public/index.php', '14'),
	('2017-04-12 23:43:29', 'Main', 'DEBUG', 'cmd = /admin/', 111, '/app/public/index.php', '19'),
	('2017-04-12 23:43:29', 'Main', 'DEBUG', 'cmd = /admin/computer/', 111, '/app/public/index.php', '24'),
	('2017-04-12 23:43:29', 'Main', 'ERROR', 'Starting Computer.php', 111, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:43:29', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 111, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:43:29', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:45:27', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:45:27', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:45:27', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:45:27', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:45:27', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:45:28', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:45:28', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:50:05', 'Main', 'DEBUG', 'cmd = /', 113, '/app/public/index.php', '12'),
	('2017-04-12 23:50:05', 'Main', 'DEBUG', 'api/v1/json/computers/', 113, '/app/public/index.php', '14'),
	('2017-04-12 23:50:05', 'Main', 'DEBUG', 'cmd = /api/v1/', 113, '/app/public/api.php', '17'),
	('2017-04-12 23:50:05', 'root', 'DEBUG', '', 113, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:50:05', 'root', 'DEBUG', 'Script ended normally', 113, '/app/classes/runtime.class.php', '24'),
	('2017-04-12 23:51:31', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:51:31', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:51:31', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:51:31', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:51:31', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:51:32', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:51:32', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:51:57', 'Main', 'DEBUG', 'cmd = /', 113, '/app/public/index.php', '12'),
	('2017-04-12 23:51:57', 'Main', 'DEBUG', 'admin/computer/', 113, '/app/public/index.php', '14'),
	('2017-04-12 23:51:57', 'Main', 'DEBUG', 'cmd = /admin/', 113, '/app/public/index.php', '19'),
	('2017-04-12 23:51:57', 'Main', 'DEBUG', 'cmd = /admin/computer/', 113, '/app/public/index.php', '24'),
	('2017-04-12 23:51:57', 'Main', 'ERROR', 'Starting Computer.php', 113, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:51:57', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 113, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:51:58', 'root', 'ERROR', 'Trying to get property of non-object', 113, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:55:41', 'Main', 'DEBUG', 'cmd = /', 110, '/app/public/index.php', '12'),
	('2017-04-12 23:55:41', 'Main', 'DEBUG', 'admin/computer/', 110, '/app/public/index.php', '14'),
	('2017-04-12 23:55:41', 'Main', 'DEBUG', 'cmd = /admin/', 110, '/app/public/index.php', '19'),
	('2017-04-12 23:55:42', 'Main', 'DEBUG', 'cmd = /admin/computer/', 110, '/app/public/index.php', '24'),
	('2017-04-12 23:55:42', 'Main', 'ERROR', 'Starting Computer.php', 110, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:55:42', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 110, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:55:42', 'root', 'ERROR', 'Trying to get property of non-object', 110, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:55:50', 'Main', 'DEBUG', 'cmd = /', 111, '/app/public/index.php', '12'),
	('2017-04-12 23:55:50', 'Main', 'DEBUG', 'api/v1/json/computers/', 111, '/app/public/index.php', '14'),
	('2017-04-12 23:55:50', 'Main', 'DEBUG', 'cmd = /api/v1/', 111, '/app/public/api.php', '17'),
	('2017-04-12 23:55:51', 'root', 'DEBUG', '', 111, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:55:51', 'root', 'DEBUG', 'Script ended normally', 111, '/app/classes/runtime.class.php', '24'),
	('2017-04-12 23:56:24', 'Main', 'DEBUG', 'cmd = /', 112, '/app/public/index.php', '12'),
	('2017-04-12 23:56:24', 'Main', 'DEBUG', 'api/v1/json/computers', 112, '/app/public/index.php', '14'),
	('2017-04-12 23:56:24', 'Main', 'DEBUG', 'cmd = /api/v1/', 112, '/app/public/api.php', '17'),
	('2017-04-12 23:56:24', 'root', 'DEBUG', '', 112, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:56:25', 'root', 'DEBUG', 'Script ended normally', 112, '/app/classes/runtime.class.php', '24'),
	('2017-04-12 23:58:31', 'Main', 'DEBUG', 'cmd = /', 111, '/app/public/index.php', '12'),
	('2017-04-12 23:58:31', 'Main', 'DEBUG', 'admin/computer/', 111, '/app/public/index.php', '14'),
	('2017-04-12 23:58:31', 'Main', 'DEBUG', 'cmd = /admin/', 111, '/app/public/index.php', '19'),
	('2017-04-12 23:58:31', 'Main', 'DEBUG', 'cmd = /admin/computer/', 111, '/app/public/index.php', '24'),
	('2017-04-12 23:58:31', 'Main', 'ERROR', 'Starting Computer.php', 111, '/app/public/admin/computer.php', '8'),
	('2017-04-12 23:58:32', 'root', 'DEBUG', 'Array\n(\n    [type] => 8\n    [message] => Trying to get property of non-object\n    [file] => /app/smarty/templates_c/424d0754a73d0dfbba1aa15b1631c43aaae7d541_0.file.main.tpl.php\n    [line] => 47\n)\n', 111, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:58:32', 'root', 'ERROR', 'Trying to get property of non-object', 111, '/app/classes/runtime.class.php', '26'),
	('2017-04-12 23:58:37', 'Main', 'DEBUG', 'cmd = /', 113, '/app/public/index.php', '12'),
	('2017-04-12 23:58:37', 'Main', 'DEBUG', 'api/v1/json/computers/', 113, '/app/public/index.php', '14'),
	('2017-04-12 23:58:38', 'Main', 'DEBUG', 'cmd = /api/v1/', 113, '/app/public/api.php', '17'),
	('2017-04-12 23:58:38', 'root', 'DEBUG', '', 113, '/app/classes/runtime.class.php', '22'),
	('2017-04-12 23:58:38', 'root', 'DEBUG', 'Script ended normally', 113, '/app/classes/runtime.class.php', '24');
/*!40000 ALTER TABLE `log4php_log` ENABLE KEYS */;

-- Dumping structure for table HackingSim.Networks
CREATE TABLE IF NOT EXISTS `Networks` (
  `NetworkID` int(11) NOT NULL AUTO_INCREMENT,
  `NetworkStart` int(10) unsigned DEFAULT '0',
  `NetworkEnd` int(10) unsigned DEFAULT '0',
  `NetworkName` varchar(255) DEFAULT '0',
  `Subnet` int(11) DEFAULT NULL,
  PRIMARY KEY (`NetworkID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.Networks: ~11 rows (approximately)
/*!40000 ALTER TABLE `Networks` DISABLE KEYS */;
INSERT INTO `Networks` (`NetworkID`, `NetworkStart`, `NetworkEnd`, `NetworkName`, `Subnet`) VALUES
	(1, 406579200, 406579454, 'WalFart Corporate', 24),
	(2, 752468992, 752469246, 'Lonovo Corporate', 24),
	(3, 485356800, 485357054, 'Player Slayer1of1', 26),
	(4, 423728896, 423729150, 'Nu-Net Networks Corporate', 24),
	(5, 1325886720, 1325886974, 'University of Technology', 24),
	(6, 55840000, 55840254, 'Cloud Service Corporate', 24),
	(7, 3886088960, 3886089214, 'FBI', 24),
	(8, 3236098816, 3236099070, 'Cell Phones R Us', 24),
	(9, 871569664, 871569918, 'Time Link Cable Corporate', 24),
	(10, 2918983680, 2918983934, 'Player ZeroCool', 24),
	(12, 485356864, 485357054, 'Player srainsdon', 26);
/*!40000 ALTER TABLE `Networks` ENABLE KEYS */;

-- Dumping structure for table HackingSim.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `permissionID` int(11) NOT NULL AUTO_INCREMENT,
  `permissionName` char(50) NOT NULL,
  PRIMARY KEY (`permissionID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.permissions: ~5 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`permissionID`, `permissionName`) VALUES
	(1, 'ADMIN_DASHBOARD'),
	(2, 'ADMIN_COMPUTER'),
	(3, 'USER_DATA'),
	(4, 'ADMIN_NETWORK'),
	(5, 'API_ACCESS');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table HackingSim.requests
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rkey` varchar(20) NOT NULL,
  `expire` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table HackingSim.requests: ~0 rows (approximately)
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;

-- Dumping structure for table HackingSim.Services
CREATE TABLE IF NOT EXISTS `Services` (
  `ServicePort` int(11) NOT NULL,
  `ServiceName` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `ServiceDis` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ServiceName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table HackingSim.Services: ~4 rows (approximately)
/*!40000 ALTER TABLE `Services` DISABLE KEYS */;
INSERT INTO `Services` (`ServicePort`, `ServiceName`, `ServiceDis`) VALUES
	(21, 'ftp', ''),
	(80, 'http', ''),
	(0, 'ping', ''),
	(22, 'ssh', '');
/*!40000 ALTER TABLE `Services` ENABLE KEYS */;

-- Dumping structure for table HackingSim.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- Dumping data for table HackingSim.sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `uid`, `hash`, `expiredate`, `ip`, `agent`, `cookie_crc`) VALUES
	(88, 1, '15a8ba61a7d0126ee3db9ed793f47be155103889', '2017-04-12 23:24:15', '204.14.96.246', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '0529aafa91e7f94e56fc547cbff55808217d19ee');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table HackingSim.userComputers
CREATE TABLE IF NOT EXISTS `userComputers` (
  `userComputerID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `computerID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userComputerID`),
  KEY `userComputerfkUserID` (`userID`),
  KEY `userComputerfkComputerID` (`computerID`),
  CONSTRAINT `userComputerfkComputerID` FOREIGN KEY (`ComputerID`) REFERENCES `Computers` (`ComputerID`),
  CONSTRAINT `userComputerfkUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.userComputers: ~1 rows (approximately)
/*!40000 ALTER TABLE `userComputers` DISABLE KEYS */;
INSERT INTO `userComputers` (`userComputerID`, `userID`, `computerID`) VALUES
	(1, 1, 3);
/*!40000 ALTER TABLE `userComputers` ENABLE KEYS */;

-- Dumping structure for table HackingSim.userGroup
CREATE TABLE IF NOT EXISTS `userGroup` (
  `userRoleID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  PRIMARY KEY (`userRoleID`),
  KEY `urUser` (`userID`),
  KEY `urGroup` (`groupID`),
  CONSTRAINT `urGroup` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`),
  CONSTRAINT `urUser` FOREIGN KEY (`userID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table HackingSim.userGroup: ~1 rows (approximately)
/*!40000 ALTER TABLE `userGroup` DISABLE KEYS */;
INSERT INTO `userGroup` (`userRoleID`, `userID`, `groupID`) VALUES
	(1, 1, 5),
	(3, 2, 2);
/*!40000 ALTER TABLE `userGroup` ENABLE KEYS */;

-- Dumping structure for table HackingSim.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `name` char(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table HackingSim.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `name`, `password`, `isactive`, `dt`) VALUES
	(1, 'srainsdon@nunetnetworks.net', 'slayer1of1', '$2y$10$QyHczgWa15Uu9EFTpmv2euylxu5qrjFh1HSNYj7UDUOu60ZIgaSWC', 1, '2017-04-04 23:21:18'),
	(2, 'seth.rainsdon@nunetnetworks.net', 'srainsdon', '$10$QyHczgWa15Uu9EFTpmv2euylxu5qrjFh1HSNYj7UDUOu60ZIgaSWC', 1, '2017-04-05 16:07:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for view HackingSim.computer
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `computer`;
CREATE ALGORITHM=UNDEFINED DEFINER=`srainsdon`@`%` SQL SECURITY DEFINER VIEW `computer` AS select `c`.`ComputerID` AS `ComputerID`,concat(`c`.`ComputerHostName`,'.',`c`.`ComputerDomain`) AS `ComputerName`,`c`.`ComputerHostName` AS `ComputerHostName`,`c`.`ComputerDomain` AS `ComputerDomain`,inet_ntoa(`c`.`ComputerIP`) AS `ComputerIP`,`n`.`Subnet` AS `Subnet`,concat(inet_ntoa(`c`.`ComputerIP`),'/',`n`.`Subnet`) AS `CIDR`,`n`.`NetworkName` AS `NetworkName` from (`Computers` `c` join `Networks` `n` on((`c`.`ComputerNetwork` = `n`.`NetworkID`)));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
