-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql5025.site4now.net
-- Generation Time: May 13, 2020 at 11:51 AM
-- Server version: 5.6.47-log
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_a498b3_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_Id` int(11) NOT NULL,
  `admin_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_Id`, `admin_Id`) VALUES
(120, 107),
(121, 108),
(122, 109),
(124, 110),
(129, 113),
(130, 114),
(131, 117),
(133, 115),
(134, 116),
(135, 118);

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `attendee_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `list_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`attendee_Id`, `user_Id`, `list_Id`) VALUES
(54, 129, 53),
(55, 129, 53),
(56, 120, 53),
(57, 129, 53),
(58, 123, 53),
(59, 131, 53),
(60, 130, 53),
(61, 120, 54),
(63, 120, 58),
(64, 120, 50),
(65, 120, 57),
(66, 120, 61),
(67, 120, 60),
(68, 120, 55),
(69, 120, 59),
(70, 133, 58),
(71, 133, 56),
(72, 133, 50),
(75, 121, 59),
(76, 121, 62),
(77, 122, 62),
(78, 122, 53),
(79, 122, 67),
(80, 125, 56),
(81, 131, 60),
(82, 132, 55),
(83, 130, 61),
(84, 124, 58),
(85, 131, 62),
(86, 133, 63),
(87, 120, 66),
(88, 120, 56),
(89, 120, 74),
(91, 120, 62),
(92, 120, 83),
(93, 120, 75),
(96, 133, 83),
(97, 136, 63),
(98, 136, 70),
(99, 124, 70),
(100, 120, 79),
(101, 121, 66),
(102, 121, 64);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `admin_Id` int(11) NOT NULL,
  `event_Id` int(11) NOT NULL,
  `event_Title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_Type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`admin_Id`, `event_Id`, `event_Title`, `description`, `event_Type`, `location`, `capacity`, `date`, `time`) VALUES
(107, 100, 'Last Day to Withdraw', 'The last day to withdraw from Spring/Summer courses for the 2020 semester.', 'Academics', 'Online', NULL, '2020-04-02', '00:00:00'),
(107, 101, 'Math Emerging Scholar Program', 'The Emerging Scholars Program at Farmingdale, now in its fifteenth year, is modeled loosely after the highly successful program created by Uri Treisman at University of California at Berkley and University of Texas at Austin.  Students enrolled in MTH 129 Precalculus, MTH 130 Applied Calculus, and MTH 150 University Calculus I are all invited to participate in this optional program.', 'Club', 'Gleason L100', 25, '2020-05-11', '10:50:00'),
(107, 102, 'Campus Recreation/Yoga Class', 'Fitness and Group Exercise classes are 100% FREE to join and include Yoga, Zumba, Pilates, Abs & Core workouts, cardio workouts, upper body strength workouts and flexibility workouts taught by a wide variety of certified instructors.', 'Athletics', 'Roosevelt Loft Lounge', 40, '2020-04-27', '15:30:00'),
(107, 103, 'Campus Intramural Soccer', 'Roosevelt Great Lawn and Multi-Purpose Room as a rain location (MPR NOT available on 9/5/19, 10/17/19 and 11/21/19)', 'Athletics', 'Roosevelt Hall', NULL, '2020-04-10', '15:45:00'),
(113, 104, 'Overcoming Anxiety to Ace Your Exams', 'The AAIC offers various workshops to all FSC students throughout the fall and spring semesters. Focusing on a variety of topics, these workshops aim to enhance the advisor-advisee relationship outside of the AAIC.', 'Academics', 'Greenley Library Tutoring Center', 50, '2020-04-17', '11:00:00'),
(113, 105, 'Nexus Center Technology Job Fair', 'Meet with employers offering full-time, part-time and internship opportunities in the IT and Engineering fields. Job seekers are not required to register in advance. Bring several copies of your resume and dress professionally. Open to the public.\r\nVOLUNTEERS ARE NEEDED to assist with this event. Lunch will be provided, along with a certificate of participation which can be added to your resume! Email the Nexus Center, if interested.', 'FSC', 'Campus Center Ballroom and Campus Center Meeting Rooms A and B', NULL, '2020-04-07', '11:00:00'),
(107, 106, 'Smart Scholars Program', 'The cornerstone of the Smart Scholars ECHS program involves students earning free, college credits while enrolled in high school. Students earn these credits through a combination of dual enrollment classes embedded within their high school schedule and courses taken on-campus at Farmingdale State College (FSC) through our Saturday pre-college program. The Saturday program affords students the unique opportunity to complete over half of their SS ECHS college credits at the FSC campus.', 'Academics', 'Gleeson Hall – Room 104', 15, '2020-04-21', '10:30:00'),
(107, 107, 'Nursing Faculty Meetings', 'Conklin Hall Room 100', 'Academics', 'Conklin Hall Room 100', NULL, '2020-03-28', '13:00:00'),
(107, 108, 'Sport Management Club Meeting', 'The Sports Management club prepares individuals for a career in the business-related aspects in the dynamic world of sports. This highly sought-after career field provides opportunities for business-minded sports enthusiasts.', 'Academics', 'Thompson Hall 117', 20, '2020-05-19', '15:30:00'),
(107, 109, 'FEC Virtual Meeting', 'https://meet.google.com/nct-vrab-phh Or dial: +​1​ ​4​1​4​-​8​8​2​-​6​6​0​5 PIN: 9​0​7​ ​9​0​3​ ​2​2​7​#', 'FSC', 'Online', NULL, '2020-05-15', '09:30:00'),
(107, 110, 'International Energy Conference', 'Roosevelt Hall – Little Theatre/Lobby, Multi-Purpose Room, Loft Lounge, Lupton Hall T101', 'FSC', 'Campus Center Ballroom', NULL, '2020-06-24', '06:00:00'),
(107, 111, 'Criminal Justice Career Event', 'Members of the the Suffolk County Police Department, New York City Police Department, New York City Department of Correction, and United States Pretrial Services Agency will be at FSC to host information sessions and recruit for their respective agencies. The event is sponsored by the Criminal Justice Department. The Nexus Center will have counselors at the session.', 'Academics', 'Sinclair Hall Pit', NULL, '2020-06-10', '12:30:00'),
(107, 112, 'Computer Tech Club Meetings', 'Develop a better understanding of the nature and functions of the current and future technologies, study the computer hardware equipment related to Computer Engineering, computer software and languages including and not limited to Java/JavaScript, C#/C++, HTML/ XML, Data Base (Access, Visio, SQL server), Networking, Security.', 'Club', 'Whitman Hall 209', NULL, '2020-04-13', '11:00:00'),
(107, 113, 'Virtual Admissions', 'Admissions Staff is working diligently at home processing applications and answering questions. We look forward to hearing from you during this challenging time and want to help you navigate the Admissions process.', 'Admissions', 'Online', NULL, '2020-06-12', '15:00:00'),
(107, 114, 'Virtual Nursing Information', 'Virtual Nursing Information Sessions will be held on Monday&#39;s at 3:00 p.m.  An Admissions Advisor will review the admissions requirements for acceptance into FSC&#39;s Bachelor of Science Nursing degree programs. Register now!', 'Admissions', 'Online', 30, '2020-06-02', '15:00:00'),
(107, 115, 'Aviation Center Tours', 'An Aviation Center staff member will conduct a facility tour. Topics covered during this tour include flight scheduling, aviation flight fees, curriculum and prerequisite requirements, and any questions you may have about how to achieve your career goals to become a professional pilot. Information Sessions are open to any student interested in Flight Training.', 'Admissions', 'Aviation Center', NULL, '2020-07-17', '13:00:00'),
(107, 116, 'Saturday Campus Tour', 'On the tour, you will have the opportunity to explore some of our favorite places, including: Greenley Hall Library, Hale Hall, Conklin Hall, The Campus Center,  Dining Facility and Campus Bookstore\r\nResidence Halls.', 'Admissions', 'Roosevelt Hall, Tour Room', 10, '2020-04-15', '15:00:00'),
(107, 117, 'Biology Tutoring Session', 'Covers Biology (BIO) 120, 130, 131, 210, & 348.', 'Tutoring', 'Tutoring Center', 20, '2020-06-17', '12:00:00'),
(107, 118, 'Economics Tutoring Session', 'Covers Economics (ECO) 156 & 157.', 'Tutoring', 'Tutoring Center', 15, '2020-06-15', '12:00:00'),
(107, 119, 'Physics Tutoring Session', 'Physics (PHY) 121, 135, 136, & 144', 'Tutoring', 'Online Session', 20, '2020-05-20', '10:00:00'),
(107, 120, 'EOP Summer Program/FRX 101', 'The Educational Opportunity Program (EOP) at Farmingdale State College is designed to provide the opportunity of a college education to capable students who are historically disadvantaged due to limited financial resources and inadequate academic preparation. Throughout their years at Farmingdale State College, EOP students are provided ongoing support services and resources to help insure their collegiate success.', 'FSC', 'Gleeson 129 & 131', 40, '2020-06-14', '14:00:00'),
(109, 121, 'Spring 2020 Classes Begin', 'Classes are in session.', 'Academics', 'Campus', NULL, '2020-01-20', '08:00:00'),
(107, 122, 'Women&#39;s Basketball', 'Old Westbury @ Farmingdale State.', 'Athletics', 'Farmingdale Campus', NULL, '2020-05-21', '15:00:00'),
(109, 123, 'Last Day for C.C.', 'Today is the last day to make schedule changes. ', 'Academics', 'Campus', NULL, '2020-03-11', '08:00:00'),
(107, 124, 'Indoor Track & Field', 'Fastrack National Invitational', 'Athletics', 'Ocean Breeze Park', NULL, '2020-03-26', '13:00:00'),
(107, 125, 'Men\'s Lacrosse', 'Sage at Farmingdale State.', 'Athletics', 'Farmingdale Campus', NULL, '2020-05-27', '11:00:00'),
(109, 126, 'Blackboard Basics', 'FREE workshop for FSC students on how to use Blackboard Learn. Taking place in Greenley Library, Tutoring Center (Room 301).', 'FSC', 'Greenley Library', NULL, '2020-05-29', '15:00:00'),
(107, 127, 'Aviation Award Ceremony', 'Based upon a long history of accomplishments and continued success of the Aviation Program, the Farmingdale State College &#34;Aviation Hall of Fame&#34; was established in August 2012 to honor members.', 'FSC', 'Campus Center', 1, '2020-05-27', '10:30:00'),
(107, 128, 'Residence Life Session', 'The Residence Life Staff recognizes that to gain the full college experience, living on campus is a great asset. Residing on campus is fun and educational. Recent research showed that students who liv', 'FSC', 'School of Business', 24, '2020-05-29', '15:05:00'),
(109, 129, 'Start Acc. Sat. Classes', 'Accelerated Saturday classes begin.', 'Academics', 'Campus', NULL, '2020-06-02', '08:00:00'),
(109, 130, 'Sports Management Club Meeting', 'Come talk with us about sports management.', 'Club', 'Thomspon Hall 177', 14, '2020-05-11', '11:00:00'),
(109, 131, 'Study Abroad Fair', 'Look into taking classes outside of the country.', 'Academics', 'Bookstore', NULL, '2020-06-13', '10:00:00'),
(108, 132, 'Math Workshop #1', 'If you are currently in Math 129, 130 or 390 then consider joining our math workshop!', 'Tutoring', 'Gleeson Hall L100', 40, '2020-05-04', '12:00:00'),
(108, 133, 'Math Workshop #2', 'If you are currently in Math 129, 130 or 390 then consider joining our math workshop!', 'Tutoring', 'Gleeson Hall L100', 40, '2020-05-12', '12:00:00'),
(115, 134, 'Coffee & Conversations', 'Join the Office of Student Activities every Monday morning from 9:30am-10:30am on Google Hang Outs for some Coffee & Conversations! Another informal spot to chat about anything on your mind.', 'Admissions', 'Online', NULL, '2020-04-16', '09:30:00'),
(108, 135, 'Open BCS Study Session', 'If you are a BCS student, we are holding an open study session for students who are interested in helping each other study.', 'Tutoring', 'Conklin', NULL, '2020-06-09', '12:15:00'),
(108, 136, 'Agriculture Club Lecture', 'The Agriculture club is having a gardening lecture with a special surprise guest! You don&#39;t want to miss it! Free flower pots for the first fifteen students!', 'Club', 'Greenhouse', 40, '2020-05-16', '11:00:00'),
(115, 137, 'Women&#39;s Lacross', 'StonyBrook VS Farmingdale', 'Athletics', 'Campus Stadium', NULL, '2020-05-20', '17:00:00'),
(108, 138, 'Drama Club Tryouts', 'We are having tryouts for the Fall 2020 semester! Please come with a monologue ready.', 'Club', 'Roosevelt Hall Theatre', NULL, '2020-08-29', '11:00:00'),
(108, 139, 'Design Club Meeting #12', 'The Design Club promotes the interest and enjoyment of the graphic arts through the student design community at Farmingdale State College.', 'Club', 'Hale Hall room 201', 25, '2020-05-19', '17:30:00'),
(115, 140, 'Become An Entrepreneur', 'Come and join us and become an entrepreneur', 'Club', 'Hale Hall', NULL, '2020-05-28', '14:30:00'),
(109, 141, 'Greek Council Programming Meet', 'Meet with the Greek Council', 'Club', 'Conklin Hall Room 109', NULL, '2020-06-18', '11:00:00'),
(115, 142, 'Farmingdale Esports', 'The main purpose of Farmingdale Esports is to promote opportunities to play games competitive within and outside of Farmingdale. A secondary purpose we have is to teach people how to play competitively and develop the skills to compete in tournaments', 'Athletics', 'Campus Center', 50, '2020-04-09', '12:00:00'),
(108, 143, 'Ski & Snowboard Club Meet #9', 'The Ski & Snowboard Club provides fun and friendship building exercises for students to draw on for the rest of their lives through both ski and snowboarding activities.', 'Club', 'Roosevelt Hall Room 111', 25, '2020-05-13', '17:00:00'),
(115, 144, 'Ice Hockey', 'The Farmingdale State College Hockey team is a high-caliber and competitive club organization. The team plays in the Collegiate Hockey Federation and is consistently in a bid for a national title', 'Athletics', 'Nold Athletic Complex', 50, '2020-06-17', '17:30:00'),
(115, 145, 'Men&#39;s Tennis', 'FDU vs. Farmingdale State College.', 'Athletics', 'Nold Athletic Complex', NULL, '2020-05-12', '18:00:00'),
(115, 146, 'sports club', 'The Farmingdale State College Volleyball Club Team is an organized competitive club.There will be competitions against other clubs and university teams. Our mission is to teach or enhance the skills of our members.', 'Club', 'Nold Athletic Complex', NULL, '2020-06-30', '15:00:00'),
(108, 147, 'Short Film Club', 'We screen and create short films of all genres.', 'Club', 'Gleeson Hall Room 123', 2, '2020-05-14', '18:30:00'),
(115, 148, 'Cheerleading Club', 'Welcome to Cheerleading! We will be cheering at basketball games and other school event, along with competing at UCA Nationals.', 'Club', 'Campus Center', 1, '2020-05-28', '12:00:00'),
(115, 149, 'Virtual Dental Hygiene Session', 'Join us to know more!', 'Admissions', 'Online', NULL, '2020-04-02', '15:00:00'),
(108, 150, 'Semester Ends Spring 2020', 'Final day of the Spring semester.', 'Academics', 'Online', NULL, '2020-05-25', '23:59:00'),
(109, 151, 'Last Day to Submit Late Grades', 'Today is the last day to submit a grade OR Grade extension for incompletes (for the Fall semester or intersession).', 'Academics', 'Campus', NULL, '2020-07-10', '08:00:00'),
(115, 152, 'Transfer Student Session #1', 'Join us on Transfer Virtual Information Session to know more about the requirements', 'Admissions', 'Online', 100, '2020-05-13', '19:00:00'),
(108, 153, 'Summer Session A begins', 'Summer Session A classes begin', 'Academics', 'Online', 3, '2020-05-26', '00:00:00'),
(109, 154, 'Spring Open House', 'Come into the open college.', 'Academics', 'Campus', NULL, '2020-08-19', '08:00:00'),
(115, 155, 'Transfer Student Session #2', 'Virtual Admissions and Transfer Services Information Session', 'Admissions', 'Online', 93, '2020-05-15', '15:00:00'),
(109, 156, 'Last Day of Classes', 'Today is the last day of classes.', 'Academics', 'Campus', NULL, '2020-09-06', '08:00:00'),
(109, 157, 'Semester Ends', 'It is the end of the Spring 2020 semester.', 'Academics', 'Campus', NULL, '2020-05-22', '08:00:00'),
(115, 158, 'BCS 120 Review Session', 'Open for all BCS students. Lunch will be served.', 'Tutoring', 'Whitman hall 209', 16, '2020-04-10', '12:00:00'),
(115, 159, 'BCS 320 Review Session', 'Open to all!', 'Tutoring', 'Whitman Hall 209', 21, '2020-06-09', '12:00:00'),
(115, 160, 'Review BCS 260', 'Join us for review.', 'Tutoring', 'Whitman Hall 208', 3, '2020-09-09', '12:00:00'),
(115, 161, 'Technical Writing', 'Fundamentals of writing technical reports and other technical communications.', 'Tutoring', 'Online', 50, '2020-05-23', '12:00:00'),
(115, 162, 'Advanced Grammar Session', 'Students will master a study of descriptive and prescriptive English grammar and will become familiar with concepts of linguistics and semiology', 'Tutoring', 'Gleeson 122', 50, '2020-08-26', '12:00:00'),
(115, 163, 'Creative Writing', 'An introduction to a wide spectrum of written formats, especially those employed by writers of fiction and poetry.', 'Tutoring', 'Greenly library', 20, '2020-08-31', '12:00:00'),
(115, 164, 'College Writing', 'Students learn to view writing as a process that involves generating ideas, formulating and developing a thesis, structuring paragraphs and essays, as well as revising and editing drafts', 'Tutoring', 'Greenly library', 50, '2020-03-12', '12:00:00'),
(115, 165, 'Review MTH 150 Calculus I', 'Come join us to review MTH 150 Calculus I! All are welcome.', 'Tutoring', 'Gleeson 201', NULL, '2020-03-11', '12:00:00'),
(115, 166, 'Review MTH 151 Calculus II', 'come and join us to review MTH 151 Calculus II', 'Tutoring', 'Gleeson 122', 30, '2020-03-19', '13:00:00'),
(115, 167, 'Review MTH 116 College Algebra', 'Come and join us to review MTH 116 College Algebra.', 'Tutoring', 'Gleeson 123', 11, '2020-04-01', '12:00:00'),
(115, 168, 'Review MTH 129 Precalculus', 'Open to all students.', 'Tutoring', 'Gleeson 123', 14, '2020-07-14', '12:00:00'),
(115, 169, 'Accounting I Review Session', 'The Session will cover The Fundamental Accounting Concepts and Principles', 'Tutoring', 'Business School 104', 13, '2020-07-16', '12:00:00'),
(115, 170, 'Virtual Writing Assistance', 'open for all student from all majors', 'Tutoring', 'Greenly library', NULL, '2020-03-06', '12:00:00'),
(115, 171, 'Biology Session', 'We are going to cover the following Biology classes 120, 130, 131, 210, & 348', 'Tutoring', 'Hale Hall', NULL, '2020-08-28', '12:00:00'),
(115, 172, 'Business session', 'We are going to cover the following Business classes: 101, 102, 201, 240, 272, 273, & 404.', 'Tutoring', 'Business School 101', NULL, '2020-09-23', '12:00:00'),
(115, 173, 'Nexus Center: Tech/Engineering', 'Join the Nexus Center for their Fall 2020 Tech/Engineering Job Fair.', 'Admissions', 'Campus Center Ballroom', NULL, '2020-10-15', '12:00:00'),
(115, 174, 'Men&#39;s Baseball', 'Nonconference tournament.', 'Athletics', 'Nold Athletic Complex', 30, '2020-09-15', '12:00:00'),
(115, 175, 'Women&#39;s Tennis', 'Tournament. ', 'Athletics', 'Nold Athletic Complex', 30, '2020-09-10', '10:00:00'),
(115, 176, 'Outdoor Track', 'Join us', 'Athletics', 'campus', 30, '2020-09-16', '17:00:00'),
(115, 177, 'Golf', 'Tournament starts 3/05.', 'Athletics', 'Farmingdale Campus', 13, '2020-09-05', '12:00:00'),
(115, 178, 'Women&#39;s Volleyball', 'come and Join us', 'Athletics', 'Nold Athletic Complex', 40, '2020-09-09', '12:00:00'),
(115, 179, 'Men&#39;s Basketball', 'come and Join us', 'Athletics', 'Nold Athletic Complex', 50, '2020-09-16', '12:00:00'),
(115, 180, 'Campus Tour', 'join us', 'Admissions', 'campus', NULL, '2020-09-09', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events_list`
--

CREATE TABLE `events_list` (
  `list_Id` int(11) NOT NULL,
  `event_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_list`
--

INSERT INTO `events_list` (`list_Id`, `event_Id`) VALUES
(50, 101),
(51, 102),
(52, 106),
(53, 108),
(54, 114),
(55, 116),
(56, 117),
(57, 118),
(58, 119),
(59, 120),
(60, 127),
(61, 128),
(67, 130),
(68, 130),
(62, 132),
(63, 133),
(64, 136),
(66, 139),
(69, 142),
(70, 143),
(71, 144),
(72, 147),
(73, 148),
(74, 149),
(75, 152),
(76, 153),
(79, 155),
(80, 155),
(77, 158),
(78, 159),
(81, 160),
(82, 161),
(83, 162),
(84, 163),
(85, 164),
(86, 165),
(87, 166),
(88, 167),
(89, 168),
(90, 169),
(91, 174),
(92, 175),
(93, 176),
(94, 177),
(95, 178),
(96, 179);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `user_Id` int(11) NOT NULL,
  `faculty_Id` int(11) NOT NULL,
  `RAM_ID` varchar(9) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`user_Id`, `faculty_Id`, `RAM_ID`, `department`, `occupation`) VALUES
(127, 22, NULL, NULL, NULL),
(128, 23, NULL, NULL, NULL),
(134, 24, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_Id` int(11) NOT NULL,
  `event_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `ratingNumber` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usercomment` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_Id`, `event_Id`, `user_Id`, `ratingNumber`, `title`, `usercomment`, `date`) VALUES
(1, 101, 127, 4, 'Lots of fun!', 'Learned a lot through this program!', '2020-03-15 00:00:00'),
(2, 102, 128, 5, 'Great experience', 'Tried something new and I enjoyed it! ', '2020-04-22 00:00:00'),
(3, 101, 130, 2, 'Not a math person', '', '2020-05-18 00:00:00'),
(4, 104, 120, 4, 'Very helpful', 'Lots of important information here!', '2020-04-23 00:00:00'),
(5, 104, 129, 2, 'Went on a little long', 'Took longer than they said it would', '2020-05-01 00:00:00'),
(7, 101, 133, 5, 'Great', 'it was great. thank you', '2020-05-11 11:33:02'),
(9, 116, 132, 4, 'Went well', 'Great first impression!', '2020-04-16 00:00:00'),
(10, 116, 129, 5, 'Great experience', '', '2020-04-20 00:00:00'),
(11, 164, 131, 3, 'Helpful ', 'Lots of nice tips here ', '2020-05-13 00:00:00'),
(12, 167, 127, 4, 'Nice event', 'these review sessions have been very helpful!', '2020-04-15 00:00:00'),
(13, 104, 129, 5, 'Helpful', 'very helpful', '2020-04-25 00:00:00'),
(14, 158, 130, 5, 'Nice review', 'C# is my favorite!', '2020-04-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fsc_users`
--

CREATE TABLE `fsc_users` (
  `user_Id` int(11) NOT NULL,
  `first_Name` varchar(255) NOT NULL,
  `last_Name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fsc_users`
--

INSERT INTO `fsc_users` (`user_Id`, `first_Name`, `last_Name`, `email`, `password`, `user_Type`) VALUES
(120, 'Peter', 'Ciccone', 'ciccpa@farmingdale.edu', 'f7177163c833dff4b38fc8d2872f1ec6', 'Student'),
(121, 'Jonathan', 'Garcia', 'garcj10@farmingdale.edu', '202cb962ac59075b964b07152d234b70', 'Student'),
(122, 'Joseph', 'Valentino', 'valej8@farmingdale.edu', '202cb962ac59075b964b07152d234b70', 'Student'),
(123, 'Alex', 'Kavanagh', 'kavaa@farmingdale.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Student'),
(124, 'Keroles', 'Keroles', 'keroles@farmingdale.edu', '727d82521efc24c983b27885ee331715', 'Student'),
(125, 'Jupraj', 'Singh', 'jupraj@farmingdale.edu', 'e80b5017098950fc58aad83c8c14978e', 'Student'),
(127, 'Jane', 'Smith', 'js@farmingdale.edu', '25d55ad283aa400af464c76d713c07ad', 'Faculty'),
(128, 'Bill', 'Rose', 'billjrose@farmingdale.edu', '25d55ad283aa400af464c76d713c07ad', 'Faculty'),
(129, 'Jim', 'Brown', 'jb@farmingdale.edu', '25d55ad283aa400af464c76d713c07ad', 'Student'),
(130, 'Michael', 'David', 'mdavid@farmingdale.edu', '25d55ad283aa400af464c76d713c07ad', 'Student'),
(131, 'Eric', 'Jones', 'ericj@farmingdale.edu', '25d55ad283aa400af464c76d713c07ad', 'Student'),
(132, 'David', 'Lee', 'leedavid@farmingdale.edu', '25d55ad283aa400af464c76d713c07ad', 'Student'),
(133, 'keroles', 'keroles', 'awadkn@farmingdale.edu', '25f9e794323b453885f5181f1b624d0b', 'Student'),
(134, 'Professor', 'Villani', 'mvillani@farmingdale.edu', '66d4aaa5ea177ac32c69946de3731ec0', 'Faculty'),
(135, 'Jake', 'Sokol', 'sokojw@farmingdale.edu', '0b4180accf32ae9af74ca17a8e4c2742', 'Student'),
(136, 'test', 'test', 'test@farmingdale.edu', '25d55ad283aa400af464c76d713c07ad', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `user_Id` int(11) NOT NULL,
  `student_Id` int(11) NOT NULL,
  `RAM_ID` varchar(9) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `college_Level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_Id`, `student_Id`, `RAM_ID`, `major`, `college_Level`) VALUES
(120, 107, 'R01908584', 'ART', 'Sophomore'),
(121, 108, 'R01910156', 'BCS', 'Senior'),
(122, 109, NULL, NULL, NULL),
(123, 110, NULL, NULL, NULL),
(129, 114, NULL, NULL, NULL),
(130, 115, NULL, NULL, NULL),
(131, 116, NULL, NULL, NULL),
(132, 117, NULL, NULL, NULL),
(133, 118, 'R01822222', 'BCS', 'Senior'),
(135, 119, NULL, NULL, NULL),
(136, 120, 'R08538642', 'GEO', 'Junior');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_Id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`attendee_Id`),
  ADD KEY `user_Id` (`user_Id`),
  ADD KEY `list_Id` (`list_Id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_Id`),
  ADD KEY `admin_Id` (`admin_Id`);

--
-- Indexes for table `events_list`
--
ALTER TABLE `events_list`
  ADD PRIMARY KEY (`list_Id`),
  ADD KEY `event_Id` (`event_Id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_Id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_Id`),
  ADD KEY `event_Id` (`event_Id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Indexes for table `fsc_users`
--
ALTER TABLE `fsc_users`
  ADD PRIMARY KEY (`user_Id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_Id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `attendee_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `events_list`
--
ALTER TABLE `events_list`
  MODIFY `list_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `fsc_users`
--
ALTER TABLE `fsc_users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_users` (`user_Id`);

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_users` (`user_Id`),
  ADD CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`list_Id`) REFERENCES `events_list` (`list_Id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`admin_Id`) REFERENCES `admin` (`admin_Id`);

--
-- Constraints for table `events_list`
--
ALTER TABLE `events_list`
  ADD CONSTRAINT `events_list_ibfk_1` FOREIGN KEY (`event_Id`) REFERENCES `events` (`event_Id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_users` (`user_Id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`event_Id`) REFERENCES `events` (`event_Id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`user_Id`) REFERENCES `fsc_users` (`user_Id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `fsc_users` (`user_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
