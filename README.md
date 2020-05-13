# FSC-Web-Forum
Repo for FSC Senior Project

FSC EVENTS is a project created to help Farmingdale State college students create and share campus events with their peers, interact with faculty and event coordinators and gain feedback on past events. The goal of this project is to bring attention to new and upcoming
activites and improve future ones using the student feedback.

This Application uses the following technologies
- PHP 
- Javascript
- jQuery
- AJAX

Screenshots

Login Screen
![image](https://user-images.githubusercontent.com/61335429/81853347-4eb6f680-952a-11ea-8e92-132f1479b86f.png)

Register Page
![image](https://user-images.githubusercontent.com/61335429/81853953-2d0a3f00-952b-11ea-8c25-bbb1575eee34.png)

Dashboard
![image](https://user-images.githubusercontent.com/61335429/81852788-9426f400-9529-11ea-994e-5a8a8df79a09.png)

My Account Page
![image](https://user-images.githubusercontent.com/61335429/81853518-84f47600-952a-11ea-83c6-0c1f541b22fd.png)

Create Events Page
![image](https://user-images.githubusercontent.com/61335429/81853647-b1a88d80-952a-11ea-83e1-5dcbcb9d9bc1.png)

In order to run this project you will need the following database tables or alternatively, you can download a backup of the database 
using the file fsc_events_data.sql

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
