-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2016 at 01:24 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_commission`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentification`
--

CREATE TABLE `authentification` (
  `id_auth` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `wording` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id_commission` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `date_limit` date NOT NULL,
  `type_vote` enum('secret','public') NOT NULL DEFAULT 'public',
  `file` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission_student`
--

CREATE TABLE `commission_student` (
  `id_commission` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_decision_final` int(11) DEFAULT NULL,
  `description_situation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission_student_decision_choice`
--

CREATE TABLE `commission_student_decision_choice` (
  `id_commission` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_decision_proposed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission_teacher`
--

CREATE TABLE `commission_teacher` (
  `id_commission` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_decision_voted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `decision`
--

CREATE TABLE `decision` (
  `id_decision` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id_person` int(11) NOT NULL,
  `type` enum('student','teacher','admin') NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `id_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id_teacher` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentification`
--
ALTER TABLE `authentification`
  ADD PRIMARY KEY (`id_auth`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`),
  ADD UNIQUE KEY `wording` (`wording`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id_commission`);

--
-- Indexes for table `commission_student`
--
ALTER TABLE `commission_student`
  ADD PRIMARY KEY (`id_commission`,`id_student`),
  ADD KEY `id_decision_final` (`id_decision_final`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `commission_student_decision_choice`
--
ALTER TABLE `commission_student_decision_choice`
  ADD PRIMARY KEY (`id_commission`,`id_student`,`id_decision_proposed`),
  ADD KEY `id_decision_proposed` (`id_decision_proposed`),
  ADD KEY `id_etudiant` (`id_student`);

--
-- Indexes for table `commission_teacher`
--
ALTER TABLE `commission_teacher`
  ADD PRIMARY KEY (`id_commission`,`id_teacher`,`id_student`),
  ADD KEY `id_decision_voted` (`id_decision_voted`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `decision`
--
ALTER TABLE `decision`
  ADD PRIMARY KEY (`id_decision`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_person`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `id_class` (`id_class`),
  ADD KEY `id_class_2` (`id_class`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id_teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id_commission` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decision`
--
ALTER TABLE `decision`
  MODIFY `id_decision` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `authentification`
--
ALTER TABLE `authentification`
  ADD CONSTRAINT `authentification_ibfk_1` FOREIGN KEY (`id_auth`) REFERENCES `person` (`id_person`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commission_student`
--
ALTER TABLE `commission_student`
  ADD CONSTRAINT `commission_student_ibfk_1` FOREIGN KEY (`id_commission`) REFERENCES `commission` (`id_commission`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commission_student_ibfk_2` FOREIGN KEY (`id_decision_final`) REFERENCES `decision` (`id_decision`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commission_student_ibfk_3` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commission_student_decision_choice`
--
ALTER TABLE `commission_student_decision_choice`
  ADD CONSTRAINT `commission_student_decision_choice_ibfk_1` FOREIGN KEY (`id_commission`) REFERENCES `commission` (`id_commission`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commission_student_decision_choice_ibfk_2` FOREIGN KEY (`id_decision_proposed`) REFERENCES `decision` (`id_decision`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commission_student_decision_choice_ibfk_3` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commission_teacher`
--
ALTER TABLE `commission_teacher`
  ADD CONSTRAINT `commission_teacher_ibfk_1` FOREIGN KEY (`id_commission`) REFERENCES `commission` (`id_commission`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commission_teacher_ibfk_2` FOREIGN KEY (`id_decision_voted`) REFERENCES `decision` (`id_decision`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commission_teacher_ibfk_3` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`id_teacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commission_teacher_ibfk_4` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `person` (`id_person`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`id_class`) REFERENCES `class` (`id_class`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `person` (`id_person`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
