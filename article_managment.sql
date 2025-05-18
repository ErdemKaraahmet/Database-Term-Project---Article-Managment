-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 02:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `article_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` varchar(10) NOT NULL,
  `volname` varchar(100) DEFAULT NULL,
  `volid` varchar(20) DEFAULT NULL,
  `title` varchar(500) NOT NULL,
  `bodyText` text NOT NULL,
  `correspAut` varchar(200) DEFAULT NULL,
  `submissionDate` date DEFAULT NULL,
  `result` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `volname`, `volid`, `title`, `bodyText`, `correspAut`, `submissionDate`, `result`) VALUES
('A10', 'Sustainability', 'March2024', 'Circular Economy Models', 'Investigating circular economy models for sustainable development...', 'thor.odinson@gmail.com', '2023-06-18', 'revision'),
('A11', 'Cloud Computing Jornal', 'January2022', 'Cloudy day for computing', 'a', NULL, NULL, NULL),
('A3', 'Journal Of Artificial Intelligence', 'April2024', 'Advancements in Neural Networks', 'This article covers the latest advancements in neural networks...', 'charles.xavier@gmail.com', '2023-09-10', 'accepted'),
('A4', 'Software Engineering Journal', 'June2023', 'Agile Development Practices', 'An in-depth look into Agile development practices and their benefits...', 'monica.geller@gmail.com', '2022-11-20', 'accepted'),
('A5', 'Sustainability', 'December2023', 'Sustainable Energy Solutions', 'Exploring innovative sustainable energy solutions for the future...', 'clark.kent@gmail.com', '2023-01-05', 'revision'),
('A6', 'Cloud Computing Jornal', 'July2023', 'Serverless Architectures', 'Analyzing the impact of serverless architectures on cloud computing...', 'tony.stark@gmail.com', '2022-10-15', 'rejected'),
('A7', 'Expert Systems Journal', 'September2023', 'Fuzzy Logic Applications', 'Applications of fuzzy logic in various industries...', 'steve.rogers@gmail.com', '2022-12-25', 'accepted'),
('A8', 'Journal Of Artificial Intelligence', 'October2023', 'Deep Learning for Natural Language Processing', 'This article examines deep learning techniques for NLP...', 'peter.parker@gmail.com', '2023-05-14', 'accepted'),
('A9', 'Software Engineering Journal', 'December2023', 'DevOps Best Practices', 'An overview of best practices in DevOps...', 'natasha.romanoff@gmail.com', '2022-08-30', 'revision');

-- --------------------------------------------------------

--
-- Table structure for table `articlekeywords`
--

CREATE TABLE `articlekeywords` (
  `aid` varchar(10) NOT NULL,
  `keywid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articlekeywords`
--

INSERT INTO `articlekeywords` (`aid`, `keywid`) VALUES
('A10', 88),
('A10', 94),
('A3', 43),
('A3', 44),
('A4', 60),
('A4', 62),
('A5', 80),
('A5', 90),
('A6', 19),
('A6', 20),
('A7', 35),
('A7', 36),
('A8', 43),
('A8', 45),
('A9', 69),
('A9', 72);

-- --------------------------------------------------------

--
-- Table structure for table `articlereviews`
--

CREATE TABLE `articlereviews` (
  `id` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `scoreOfTheReviewer` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articlereviews`
--

INSERT INTO `articlereviews` (`id`, `email`, `scoreOfTheReviewer`) VALUES
('A10', 'janice.hosenstein@gmail.com', 0.5),
('A3', 'rachel.green@gmail.com', 1),
('A4', 'monica.geller@gmail.com', 0.5),
('A5', 'phoebe.buffay@gmail.com', 0),
('A6', 'ross.geller@gmail.com', 0.5),
('A7', 'joey.tribbiani@gmail.com', 1),
('A8', 'chandler.bing@gmail.com', 1),
('A9', 'mike.hannigan@gmail.com', 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `name` varchar(100) NOT NULL,
  `frequency` enum('monthly','bi-monthly','quarterly','semi-annual','annual') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`name`, `frequency`) VALUES
('Cloud Computing Jornal', 'annual'),
('Expert Systems Journal', 'bi-monthly'),
('Journal Of Artificial Intelligence', 'monthly'),
('Software Engineering Journal', 'quarterly'),
('Sustainability', 'semi-annual');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `keywid` int(5) NOT NULL,
  `keyword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`keywid`, `keyword`) VALUES
(1, 'Cloud service providers (CSPs)'),
(2, 'Virtualization'),
(5, 'Scalability'),
(6, 'Elasticity'),
(7, 'Infrastructure as a Service (IaaS)'),
(8, 'Platform as a Service (PaaS)'),
(9, 'Software as a Service (SaaS)'),
(10, 'Public cloud'),
(11, 'Private cloud'),
(12, 'Hybrid  cloud'),
(13, 'Multi-cloud'),
(14, 'Cloud migration'),
(15, 'Cloud security'),
(16, 'Data storage'),
(17, 'Cloud-native'),
(18, 'Containerization'),
(19, 'Microservices'),
(20, 'Serverless computing'),
(21, 'DevOps'),
(22, 'Automation'),
(23, 'Knowledge Base'),
(24, 'Inference Engine'),
(25, 'Rule-based System'),
(26, 'Knowledge Representation'),
(27, 'Decision Support'),
(28, 'Domain Expertise'),
(29, 'Knowledge Acquisition'),
(30, 'Expert System Shell'),
(31, 'Knowledge Engineering'),
(32, 'Forward Chaining'),
(33, 'Backward Chaining'),
(34, 'Expert System Development Tools'),
(35, 'Heuristic Reasoning'),
(36, 'Fuzzy Logic'),
(37, 'Case-based Reasoning'),
(38, 'Uncertainty Handling'),
(39, 'Explanation Facility'),
(40, 'Diagnostic Reasoning'),
(41, 'Knowledge-based Systems'),
(42, 'Machine Learning'),
(43, 'Deep Learning'),
(44, 'Neural Networks'),
(45, 'Natural Language Processing (NLP)'),
(46, 'Computer Vision'),
(47, 'Robotics'),
(48, 'Reinforcement Learning'),
(49, 'Data Mining'),
(50, 'Cognitive Computing'),
(51, 'Pattern Recognition'),
(52, 'Predictive Analytics'),
(53, 'Genetic Algorithms'),
(54, 'Swarm Intelligence'),
(55, 'Sentiment Analysis'),
(56, 'Speech Recognition'),
(57, 'Virtual Assistants'),
(58, 'Autonomous Vehicles'),
(59, 'Ethics in AI'),
(60, 'Agile Development'),
(61, 'Waterfall Model'),
(62, 'Scrum'),
(63, 'Kanban'),
(64, 'Software Development Life Cycle (SDLC)'),
(65, 'Requirements Engineering'),
(66, 'Design Patterns'),
(67, 'Object-Oriented Programming (OOP)'),
(68, 'Test-Driven Development (TDD)'),
(69, 'Continuous Integration (CI)'),
(70, 'Continuous Deployment (CD)'),
(71, 'Version Control'),
(72, 'DevOps'),
(73, 'Quality Assurance (QA)'),
(74, 'Software Architecture'),
(75, 'Refactoring'),
(76, 'Code Review'),
(77, 'Software Maintenance'),
(78, 'Software Documentation'),
(79, 'Software Project Management'),
(80, 'Renewable energy'),
(81, 'Carbon footprint'),
(82, 'Climate change'),
(83, 'Eco-friendly'),
(84, 'Biodiversity'),
(85, 'Conservation'),
(86, 'Green technology'),
(87, 'Sustainable development'),
(88, 'Circular economy'),
(89, 'Waste management'),
(90, 'Energy efficiency'),
(91, 'Natural resources'),
(92, 'Water conservation'),
(93, 'Organic farming'),
(94, 'Corporate social responsibility'),
(95, 'Environmental stewardship'),
(96, 'Greenhouse gases'),
(97, 'Fair trade'),
(98, 'Pollution prevention'),
(99, 'Sustainable transportation');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `email` varchar(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `vname` varchar(100) NOT NULL,
  `vid` varchar(20) NOT NULL,
  `isAuthor` tinyint(1) DEFAULT NULL,
  `isEditor` tinyint(1) DEFAULT NULL,
  `isReviewer` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`email`, `name`, `vname`, `vid`, `isAuthor`, `isEditor`, `isReviewer`) VALUES
('bruce.wayne@gmail.com', 'Bruce Wayne', 'Cloud Computing Jornal', 'January2025', 1, 1, 0),
('chandler.bing@gmail.com', 'Chandler Bing', 'Journal Of Artificial Intelligence', 'October2023', 0, 0, 1),
('charles.xavier@gmail.com', 'Charles Xavier', 'Journal Of Artificial Intelligence', 'April2024', 0, 1, 0),
('clark.kent@gmail.com', 'Clark Kent', 'Cloud Computing Jornal', 'January2024', 1, 0, 0),
('danny.rand@gmail.com', 'Danny Rand', 'Cloud Computing Jornal', 'January2023', 1, 1, 0),
('janice.hosenstein@gmail.com', 'Janice Hosenstein', 'Sustainability', 'March2024', 0, 0, 1),
('joey.tribbiani@gmail.com', 'Joey Tribbiani', 'Expert Systems Journal', 'September2023', 0, 0, 1),
('john.cena@gmail.com', 'John Cena', 'Cloud Computing Jornal', 'January2022', 0, 0, 0),
('mike.hannigan@gmail.com', 'Mike Hannigan', 'Software Engineering Journal', 'December2023', 0, 0, 1),
('monica.geller@gmail.com', 'Monica Geller', 'Software Engineering Journal', 'June2023', 0, 0, 1),
('natasha.romanoff@gmail.com', 'Natasha Romanoff', 'Expert Systems Journal', 'September2023', 1, 0, 0),
('oliver.queen@gmail.com', 'Oliver Queen', 'Cloud Computing Jornal', 'January2022', 1, 0, 0),
('peter.parker@gmail.com', 'Peter Parker', 'Expert Systems Journal', 'September2023', 1, 0, 0),
('phoebe.buffay@gmail.com', 'Phoebe Buffay', 'Sustainability', 'December2023', 0, 0, 1),
('rachel.green@gmail.com', 'Rachel Green', 'Journal Of Artificial Intelligence', 'April2024', 0, 0, 1),
('ross.geller@gmail.com', 'Ross Geller', 'Cloud Computing Jornal', 'July2023', 0, 0, 1),
('steve.rogers@gmail.com', 'Steve Rogers', 'Expert Systems Journal', 'September2023', 1, 1, 0),
('thor.odinson@gmail.com', 'Thor Odinson', 'Expert Systems Journal', 'September2023', 1, 0, 0),
('tony.stark@gmail.com', 'Tony Stark', 'Expert Systems Journal', 'September2023', 1, 1, 0),
('wanda.maximoff@gmail.com', 'Wanda Maximoff', 'Expert Systems Journal', 'September2023', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personinterest`
--

CREATE TABLE `personinterest` (
  `email` varchar(200) NOT NULL,
  `keywid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personinterest`
--

INSERT INTO `personinterest` (`email`, `keywid`) VALUES
('bruce.wayne@gmail.com', 9),
('bruce.wayne@gmail.com', 43),
('bruce.wayne@gmail.com', 60),
('chandler.bing@gmail.com', 45),
('chandler.bing@gmail.com', 57),
('chandler.bing@gmail.com', 71),
('charles.xavier@gmail.com', 42),
('charles.xavier@gmail.com', 44),
('charles.xavier@gmail.com', 48),
('clark.kent@gmail.com', 6),
('clark.kent@gmail.com', 21),
('clark.kent@gmail.com', 42),
('danny.rand@gmail.com', 5),
('danny.rand@gmail.com', 18),
('danny.rand@gmail.com', 22),
('janice.hosenstein@gmail.com', 88),
('janice.hosenstein@gmail.com', 97),
('janice.hosenstein@gmail.com', 99),
('joey.tribbiani@gmail.com', 66),
('joey.tribbiani@gmail.com', 91),
('joey.tribbiani@gmail.com', 98),
('mike.hannigan@gmail.com', 64),
('mike.hannigan@gmail.com', 68),
('mike.hannigan@gmail.com', 78),
('monica.geller@gmail.com', 61),
('monica.geller@gmail.com', 65),
('monica.geller@gmail.com', 75),
('natasha.romanoff@gmail.com', 17),
('natasha.romanoff@gmail.com', 25),
('natasha.romanoff@gmail.com', 83),
('oliver.queen@gmail.com', 1),
('oliver.queen@gmail.com', 10),
('oliver.queen@gmail.com', 15),
('peter.parker@gmail.com', 46),
('peter.parker@gmail.com', 72),
('peter.parker@gmail.com', 80),
('phoebe.buffay@gmail.com', 49),
('phoebe.buffay@gmail.com', 86),
('phoebe.buffay@gmail.com', 94),
('rachel.green@gmail.com', 28),
('rachel.green@gmail.com', 53),
('rachel.green@gmail.com', 82),
('ross.geller@gmail.com', 63),
('ross.geller@gmail.com', 77),
('ross.geller@gmail.com', 95),
('steve.rogers@gmail.com', 74),
('steve.rogers@gmail.com', 85),
('steve.rogers@gmail.com', 90),
('thor.odinson@gmail.com', 50),
('thor.odinson@gmail.com', 69),
('thor.odinson@gmail.com', 99),
('tony.stark@gmail.com', 20),
('tony.stark@gmail.com', 50),
('tony.stark@gmail.com', 64),
('wanda.maximoff@gmail.com', 19),
('wanda.maximoff@gmail.com', 36),
('wanda.maximoff@gmail.com', 87);

-- --------------------------------------------------------

--
-- Table structure for table `volume`
--

CREATE TABLE `volume` (
  `name` varchar(100) NOT NULL,
  `id` varchar(20) NOT NULL,
  `publicationDate` date DEFAULT NULL,
  `firstSubOpen` date DEFAULT NULL,
  `firstSubDeadline` date DEFAULT NULL,
  `reviewStarts` date DEFAULT NULL,
  `reviewDeadline` date DEFAULT NULL,
  `resultsAnnouncement` date DEFAULT NULL,
  `secondSubOpen` date DEFAULT NULL,
  `secondSubDeadline` date DEFAULT NULL,
  `cameraReadyDeadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volume`
--

INSERT INTO `volume` (`name`, `id`, `publicationDate`, `firstSubOpen`, `firstSubDeadline`, `reviewStarts`, `reviewDeadline`, `resultsAnnouncement`, `secondSubOpen`, `secondSubDeadline`, `cameraReadyDeadline`) VALUES
('Cloud Computing Jornal', 'January2022', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Cloud Computing Jornal', 'January2023', '2022-01-03', '2022-04-01', '2022-05-15', '2022-05-16', '2022-05-31', '2022-06-21', '2022-06-30', '2022-07-31', NULL),
('Cloud Computing Jornal', 'January2024', '2023-01-03', '2023-04-01', '2023-05-15', '2023-05-16', '2023-05-31', '2023-06-21', '2023-06-30', '2023-07-31', NULL),
('Cloud Computing Jornal', 'January2025', '2024-01-03', '2024-04-01', '2024-05-15', '2024-05-16', '2024-05-31', '2024-06-21', '2024-06-30', '2024-07-31', NULL),
('Cloud Computing Jornal', 'July2023', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Expert Systems Journal', 'September2023', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Journal Of Artificial Intelligence', 'April2024', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Journal Of Artificial Intelligence', 'October2023', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Software Engineering Journal', 'December2023', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Software Engineering Journal', 'June2023', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Sustainability', 'December2023', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL),
('Sustainability', 'March2024', '2022-01-03', '2021-04-01', '2021-05-15', '2021-05-16', '2021-05-31', '2021-06-21', '2021-06-30', '2021-07-31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volumetheme`
--

CREATE TABLE `volumetheme` (
  `name` varchar(100) NOT NULL,
  `id` varchar(20) NOT NULL,
  `keywid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volumetheme`
--

INSERT INTO `volumetheme` (`name`, `id`, `keywid`) VALUES
('Cloud Computing Jornal', 'January2022', 1),
('Cloud Computing Jornal', 'January2022', 10),
('Cloud Computing Jornal', 'January2023', 7),
('Cloud Computing Jornal', 'January2023', 13),
('Cloud Computing Jornal', 'January2024', 6),
('Cloud Computing Jornal', 'January2024', 18),
('Cloud Computing Jornal', 'January2025', 8),
('Cloud Computing Jornal', 'January2025', 20),
('Cloud Computing Jornal', 'July2023', 45),
('Cloud Computing Jornal', 'July2023', 67),
('Expert Systems Journal', 'September2023', 35),
('Journal Of Artificial Intelligence', 'April2024', 55),
('Journal Of Artificial Intelligence', 'April2024', 90),
('Journal Of Artificial Intelligence', 'October2023', 71),
('Journal Of Artificial Intelligence', 'October2023', 79),
('Software Engineering Journal', 'December2023', 64),
('Software Engineering Journal', 'December2023', 92),
('Software Engineering Journal', 'June2023', 30),
('Software Engineering Journal', 'June2023', 31),
('Sustainability', 'December2023', 13),
('Sustainability', 'December2023', 19),
('Sustainability', 'March2024', 19),
('Sustainability', 'March2024', 32);

-- --------------------------------------------------------

--
-- Table structure for table `writtenby`
--

CREATE TABLE `writtenby` (
  `id` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writtenby`
--

INSERT INTO `writtenby` (`id`, `email`) VALUES
('A10', 'janice.hosenstein@gmail.com'),
('A10', 'phoebe.buffay@gmail.com'),
('A10', 'thor.odinson@gmail.com'),
('A3', 'chandler.bing@gmail.com'),
('A3', 'charles.xavier@gmail.com'),
('A3', 'rachel.green@gmail.com'),
('A4', 'mike.hannigan@gmail.com'),
('A4', 'monica.geller@gmail.com'),
('A5', 'clark.kent@gmail.com'),
('A5', 'janice.hosenstein@gmail.com'),
('A5', 'phoebe.buffay@gmail.com'),
('A6', 'joey.tribbiani@gmail.com'),
('A6', 'ross.geller@gmail.com'),
('A6', 'tony.stark@gmail.com'),
('A7', 'steve.rogers@gmail.com'),
('A7', 'tony.stark@gmail.com'),
('A8', 'charles.xavier@gmail.com'),
('A8', 'peter.parker@gmail.com'),
('A8', 'wanda.maximoff@gmail.com'),
('A9', 'monica.geller@gmail.com'),
('A9', 'natasha.romanoff@gmail.com'),
('A9', 'rachel.green@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volname` (`volname`,`volid`),
  ADD KEY `correspAut` (`correspAut`);

--
-- Indexes for table `articlekeywords`
--
ALTER TABLE `articlekeywords`
  ADD PRIMARY KEY (`aid`,`keywid`),
  ADD KEY `aid` (`aid`),
  ADD KEY `articlekeywords_ibfk_1` (`keywid`);

--
-- Indexes for table `articlereviews`
--
ALTER TABLE `articlereviews`
  ADD PRIMARY KEY (`id`,`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`keywid`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`email`,`vname`,`vid`),
  ADD KEY `vname` (`vname`,`vid`);

--
-- Indexes for table `personinterest`
--
ALTER TABLE `personinterest`
  ADD PRIMARY KEY (`email`,`keywid`),
  ADD KEY `keywid` (`keywid`);

--
-- Indexes for table `volume`
--
ALTER TABLE `volume`
  ADD PRIMARY KEY (`name`,`id`);

--
-- Indexes for table `volumetheme`
--
ALTER TABLE `volumetheme`
  ADD PRIMARY KEY (`name`,`id`,`keywid`),
  ADD KEY `keywid` (`keywid`);

--
-- Indexes for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD PRIMARY KEY (`id`,`email`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `keywid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`volname`,`volid`) REFERENCES `volume` (`name`, `id`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`correspAut`) REFERENCES `person` (`email`);

--
-- Constraints for table `articlekeywords`
--
ALTER TABLE `articlekeywords`
  ADD CONSTRAINT `articlekeywords_ibfk_1` FOREIGN KEY (`keywid`) REFERENCES `keywords` (`keywid`),
  ADD CONSTRAINT `articlekeywords_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `article` (`id`);

--
-- Constraints for table `articlereviews`
--
ALTER TABLE `articlereviews`
  ADD CONSTRAINT `articlereviews_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`),
  ADD CONSTRAINT `articlereviews_ibfk_2` FOREIGN KEY (`id`) REFERENCES `article` (`id`);

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`vname`,`vid`) REFERENCES `volume` (`name`, `id`);

--
-- Constraints for table `personinterest`
--
ALTER TABLE `personinterest`
  ADD CONSTRAINT `personinterest_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`),
  ADD CONSTRAINT `personinterest_ibfk_2` FOREIGN KEY (`keywid`) REFERENCES `keywords` (`keywid`);

--
-- Constraints for table `volume`
--
ALTER TABLE `volume`
  ADD CONSTRAINT `volume_ibfk_1` FOREIGN KEY (`name`) REFERENCES `journal` (`name`);

--
-- Constraints for table `volumetheme`
--
ALTER TABLE `volumetheme`
  ADD CONSTRAINT `volumetheme_ibfk_1` FOREIGN KEY (`name`,`id`) REFERENCES `volume` (`name`, `id`),
  ADD CONSTRAINT `volumetheme_ibfk_2` FOREIGN KEY (`keywid`) REFERENCES `keywords` (`keywid`);

--
-- Constraints for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD CONSTRAINT `writtenby_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`),
  ADD CONSTRAINT `writtenby_ibfk_2` FOREIGN KEY (`id`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
