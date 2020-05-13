# FSC-Web-Forum
Repo for FSC Senior Project

Tables necessary to run this project

CREATE TABLE `fsc_Users` (
 `user_Id` int(11) NOT NULL AUTO_INCREMENT,
 `first_Name` varchar(255) NOT NULL,
 `last_Name` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `user_Type` varchar(255) NOT NULL,
 PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4

CREATE TABLE `admin` (
 `user_Id` int(11) NOT NULL,
 `admin_Id` int(11) NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`admin_Id`),
 KEY `user_Id` (`user_Id`),
 CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_Users` (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4
 
CREATE TABLE `faculty` (
 `user_Id` int(11) NOT NULL,
 `faculty_Id` int(11) NOT NULL AUTO_INCREMENT,
 `RAM_ID` varchar(9) DEFAULT NULL,
 `department` varchar(255) DEFAULT NULL,
 `occupation` varchar(255) DEFAULT NULL,
 PRIMARY KEY (`faculty_Id`),
 KEY `user_Id` (`user_Id`),
 CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_Users` (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4

CREATE TABLE `students` (
 `user_Id` int(11) NOT NULL,
 `student_Id` int(11) NOT NULL AUTO_INCREMENT,
 `RAM_ID` varchar(9) DEFAULT NULL,
 `major` varchar(255) DEFAULT NULL,
 `college_Level` varchar(255) DEFAULT NULL,
 PRIMARY KEY (`student_Id`),
 KEY `user_Id` (`user_Id`),
 CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_Users` (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4

CREATE TABLE `events` (
 `admin_Id` int(11) NOT NULL,
 `event_Id` int(11) NOT NULL AUTO_INCREMENT,
 `event_Title` varchar(255) NOT NULL,
 `description` text NOT NULL,
 `event_Type` varchar(255) NOT NULL,
 `location` varchar(255) NOT NULL,
 `capacity` int(11) DEFAULT NULL,
 `date` date NOT NULL,
 `time` time NOT NULL,
 PRIMARY KEY (`event_Id`),
 KEY `admin_Id` (`admin_Id`),
 CONSTRAINT `events_ibfk_1` FOREIGN KEY (`admin_Id`) REFERENCES `admin` (`admin_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4

CREATE TABLE `events_List` (
 `list_Id` int(11) NOT NULL AUTO_INCREMENT,
 `event_Id` int(11) NOT NULL,
 PRIMARY KEY (`list_Id`),
 KEY `event_Id` (`event_Id`),
 CONSTRAINT `events_list_ibfk_1` FOREIGN KEY (`event_Id`) REFERENCES `events` (`event_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4

CREATE TABLE `attendees` (
 `attendee_Id` int(11) NOT NULL AUTO_INCREMENT,
 `user_Id` int(11) NOT NULL,
 `list_Id` int(11) NOT NULL,
 PRIMARY KEY (`attendee_Id`),
 KEY `user_Id` (`user_Id`),
 KEY `list_Id` (`list_Id`),
 CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_Users` (`user_Id`),
 CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`list_Id`) REFERENCES `events_List` (`list_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4

CREATE TABLE `feedback` (
 `feedback_Id` int(11) NOT NULL AUTO_INCREMENT,
 `event_Id` int(11) NOT NULL,
 `user_Id` int(11) NOT NULL,
 `ratingNumber` int(11) NOT NULL,
 `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `usercomment` text COLLATE utf8_unicode_ci NOT NULL,
 `date` datetime NOT NULL,
 PRIMARY KEY (`feedback_Id`),
 KEY `event_Id` (`event_Id`),
 KEY `user_Id` (`user_Id`),
 CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`event_Id`) REFERENCES `events` (`event_Id`),
 CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`user_Id`) REFERENCES `fsc_Users` (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
