-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 03:31 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `runningapk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `numperteam` int(11) NOT NULL,
  `numbest` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `typect_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`id`, `name`, `startdate`, `enddate`, `numperteam`, `numbest`, `distance`, `admin_id`, `typect_id`) VALUES
(11, 'J vs T', '2021-07-22', '2021-07-31', 4, 3, 8000, 2, 1),
(12, 'Ja vs Jo', '2021-07-12', '2021-07-24', 4, 1, 10000, 2, 2),
(13, 'Takmičenje osoba na T', '2021-07-27', '2021-07-31', 5, 1, 4000, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `factors`
--

CREATE TABLE `factors` (
  `id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `fagefactor` double NOT NULL,
  `magefactor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `factors`
--

INSERT INTO `factors` (`id`, `age`, `fagefactor`, `magefactor`) VALUES
(1, 5, 0.677619048, 0.605771429),
(2, 6, 0.711204762, 0.659771429),
(3, 7, 0.743004762, 0.709771429),
(4, 8, 0.772995238, 0.755771429),
(5, 9, 0.801195238, 0.797771429),
(6, 10, 0.827695238, 0.835771429),
(7, 11, 0.852290476, 0.869771429),
(8, 12, 0.875185714, 0.899771429),
(9, 13, 0.896290476, 0.925771429),
(10, 14, 0.915585714, 0.947771429),
(11, 15, 0.933095238, 0.965771429),
(12, 16, 0.94972381, 0.979771429),
(13, 17, 0.966352381, 0.99167619),
(14, 18, 0.980661905, 0.999266667),
(15, 19, 0.990338095, 1),
(16, 20, 0.996157143, 1),
(17, 21, 0.999128571, 1),
(18, 22, 1, 1),
(19, 23, 1, 1),
(20, 24, 1, 1),
(21, 25, 1, 1),
(22, 26, 1, 1),
(23, 27, 1, 1),
(24, 28, 0.999985714, 1),
(25, 29, 0.9999, 0.999995238),
(26, 30, 0.999619048, 0.999957143),
(27, 31, 0.999057143, 0.999685714),
(28, 32, 0.99812381, 0.998942857),
(29, 33, 0.996685714, 0.997357143),
(30, 34, 0.994719048, 0.995014286),
(31, 35, 0.99212381, 0.991809524),
(32, 36, 0.989, 0.98777619),
(33, 37, 0.9853, 0.983),
(34, 38, 0.98102381, 0.977442857),
(35, 39, 0.976171429, 0.971242857),
(36, 40, 0.970785714, 0.964452381),
(37, 41, 0.96482381, 0.957152381),
(38, 42, 0.9583, 0.94957619),
(39, 43, 0.951204762, 0.942),
(40, 44, 0.943552381, 0.93442381),
(41, 45, 0.935333333, 0.926861905),
(42, 46, 0.926519048, 0.91932381),
(43, 47, 0.917147619, 0.911757143),
(44, 48, 0.907242857, 0.90417619),
(45, 49, 0.8969, 0.896604762),
(46, 50, 0.886504762, 0.889033333),
(47, 51, 0.876090476, 0.881504762),
(48, 52, 0.865704762, 0.873933333),
(49, 53, 0.855266667, 0.866361905),
(50, 54, 0.844847619, 0.858785714),
(51, 55, 0.834452381, 0.851214286),
(52, 56, 0.824038095, 0.843680952),
(53, 57, 0.813642857, 0.836104762),
(54, 58, 0.803219048, 0.828538095),
(55, 59, 0.7928, 0.820966667),
(56, 60, 0.782409524, 0.813390476),
(57, 61, 0.771985714, 0.805857143),
(58, 62, 0.7616, 0.798280952),
(59, 63, 0.751166667, 0.790709524),
(60, 64, 0.740738095, 0.783138095),
(61, 65, 0.730352381, 0.775566667),
(62, 66, 0.719928571, 0.768038095),
(63, 67, 0.709533333, 0.760457143),
(64, 68, 0.699119048, 0.752866667),
(65, 69, 0.688695238, 0.745166667),
(66, 70, 0.678309524, 0.737333333),
(67, 71, 0.667890476, 0.729128571),
(68, 72, 0.657485714, 0.72022381),
(69, 73, 0.647066667, 0.710666667),
(70, 74, 0.636642857, 0.700414286),
(71, 75, 0.626114286, 0.689490476),
(72, 76, 0.615228571, 0.67792381),
(73, 77, 0.60382381, 0.665642857),
(74, 78, 0.59172381, 0.652752381),
(75, 79, 0.578890476, 0.639138095),
(76, 80, 0.56527619, 0.624852381),
(77, 81, 0.550814286, 0.609933333),
(78, 82, 0.535580952, 0.59432381),
(79, 83, 0.5195, 0.578052381),
(80, 84, 0.50257619, 0.5611),
(81, 85, 0.484895238, 0.543457143),
(82, 86, 0.466347619, 0.525195238),
(83, 87, 0.44702381, 0.506195238),
(84, 88, 0.426842857, 0.48657619),
(85, 89, 0.405842857, 0.466271429),
(86, 90, 0.384052381, 0.445261905),
(87, 91, 0.36142381, 0.423638095),
(88, 92, 0.33802381, 0.401314286),
(89, 93, 0.313747619, 0.378338095),
(90, 94, 0.288671429, 0.35467619),
(91, 95, 0.2628, 0.330328571),
(92, 96, 0.23607619, 0.305352381),
(93, 97, 0.20857619, 0.279647619),
(94, 98, 0.18022381, 0.25332381),
(95, 99, 0.151057143, 0.226295238),
(96, 100, 0.121109524, 0.198585714);

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id`, `competition_id`, `team_id`, `person_id`) VALUES
(86, 11, 59, NULL),
(87, 11, 60, NULL),
(88, 12, 61, NULL),
(89, 12, 62, NULL),
(90, 13, 60, 73),
(91, 13, 60, 74);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `dateofbirth` date NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `avatar_path` varchar(200) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `sex` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `firstname`, `lastname`, `dateofbirth`, `emailaddress`, `contactnumber`, `speciality_id`, `avatar_path`, `password`, `team_id`, `sex`) VALUES
(67, 'Jakob', 'Jakobic', '2021-07-09', 'jakob@gmail.com', '0648585858', 20, 'uploads/jakob@gmail.com.jfif', '85b2cb0c0b5ab8228f424816572b6849', 61, 'M'),
(68, 'James', 'Jamesosn', '1960-02-09', 'james@gmail.com', '0687474747', 19, 'uploads/james@gmail.com.jfif', '54a4f4714ea4d5b794a0fb1a450dfafe', NULL, 'M'),
(69, 'Jasmina', 'Jasminic', '1971-07-12', 'jasmina@gmail.com', '069252845', 18, 'uploads/jasmina@gmail.com.jfif', 'c8a139ac1d68683bc1a182ddb673bfb2', 61, 'F'),
(70, 'Jagoda', 'Jagodić', '1961-11-28', 'jagoda@gmail.com', '08549584', 21, 'uploads/jagoda@gmail.com.jfif', 'd1cc94691d7119bb35362393cbb98f03', 61, 'F'),
(71, 'Jorgovanka ', 'Jogiv', '1972-07-10', 'jorgovanka@gmail.com', '05285858', 21, NULL, 'd81ecd0983ad351cc11c0a5e07c262da', 62, 'F'),
(72, 'Jovka', 'Jovic', '1994-07-21', 'jovka@gmail.com', '85858585', 19, NULL, '7f79491570adad9b8be0f392f505877c', 62, 'F'),
(73, 'Toma', 'Tomic', '2010-07-15', 'toma@gmail.com', '08585855', 18, 'uploads/toma@gmail.com.jpeg', '45bbe16a744eb3004619e97477b079ef', 65, 'M'),
(74, 'Tomislav', 'Tomiic', '1995-07-06', 'tomislav@gmail.com', '085858555', 20, NULL, '770d6806d5cdb8dda72835530553f2ad', 65, 'M'),
(75, 'Tose', 'Tosic', '1994-07-03', 'tose@gmail.com', '585949485', 19, 'uploads/tose@gmail.com.jpg', '162d7099c1a63a1a55bad80f1c58f6c3', NULL, 'M'),
(76, 'Tamara', 'Tamric', '1985-07-04', 'tamara@gmail.com', '0459852854', 21, 'uploads/tamara@gmail.com.jpeg', 'f752af1d896bfd9caa200b381f01a429', 67, 'F'),
(77, 'Tara', 'Taric', '1966-07-06', 'tara@gmail.com', '087458458', 18, NULL, '359b4dc56257bae16496452a1bae3a2a', NULL, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `participation_id` int(11) NOT NULL,
  `score` double NOT NULL,
  `hour` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `sec` int(11) NOT NULL,
  `length` double NOT NULL,
  `nagib` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `person_id`, `participation_id`, `score`, `hour`, `min`, `sec`, `length`, `nagib`) VALUES
(22, 70, 88, 27.667331431358, 12, 16, 15, 87, 15),
(23, 70, 86, 48.967511436267, 4, 40, 12, 55, 12),
(28, 76, 87, 15.439114874922, 1, 46, 56, 20.509692581458, 196),
(32, 76, 87, 15.44, 1, 46, 56, 20.509692581458, 196),
(34, 76, 87, 24.1, 4, 18, 51, 42, 2),
(35, 76, 87, 13.36, 1, 52, 19, 20.263200981508, 164),
(36, 74, 91, 31.23, 37, 51, 22, 208, 5),
(37, 76, 87, 13.36, 1, 52, 19, 20.263200981508, 164);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `specialty_id` int(11) NOT NULL,
  `name_specialty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`specialty_id`, `name_specialty`) VALUES
(18, 'Beginner'),
(19, 'Amateur'),
(20, 'Serious amateur'),
(21, 'Pro');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `parentteam_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `name`, `parentteam_id`) VALUES
(59, 'Osobe na J', NULL),
(60, 'Osobe na T', NULL),
(61, 'Osobe na Ja', 59),
(62, 'Osobe na Jo', 59),
(63, 'Muski tim - Ja', 61),
(64, 'Zenski tim - Ja', 61),
(65, 'Osobe na To', 60),
(66, 'Osobe na Tom', 65),
(67, 'Osobe na Ta', 60);

-- --------------------------------------------------------

--
-- Table structure for table `typect`
--

CREATE TABLE `typect` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `typect`
--

INSERT INTO `typect` (`id`, `type_name`) VALUES
(1, 'Between teems'),
(2, 'Between subteam of one team'),
(3, 'Between members of the team/subteam');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(2, 'admin', '80a19f669b02edfbc208a5386ab5036b', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_competition_users` (`admin_id`),
  ADD KEY `fk_competitiontype` (`typect_id`);

--
-- Indexes for table `factors`
--
ALTER TABLE `factors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pt_competition` (`competition_id`),
  ADD KEY `fk_pt_team` (`team_id`),
  ADD KEY `fk_pt_person` (`person_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `fk_persons_specialties` (`speciality_id`),
  ADD KEY `fk_person_team` (`team_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_statistic_pt` (`participation_id`),
  ADD KEY `fk_statistic_person` (`person_id`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`specialty_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `fk_team_team` (`parentteam_id`);

--
-- Indexes for table `typect`
--
ALTER TABLE `typect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `factors`
--
ALTER TABLE `factors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `specialty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `typect`
--
ALTER TABLE `typect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `fk_competition_users` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_competitiontype` FOREIGN KEY (`typect_id`) REFERENCES `typect` (`id`);

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `fk_pt_competition` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`),
  ADD CONSTRAINT `fk_pt_person` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_pt_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`);

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `fk_person_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_persons_specialties` FOREIGN KEY (`speciality_id`) REFERENCES `specialties` (`specialty_id`) ON DELETE SET NULL;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `fk_statistic_person` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_statistic_pt` FOREIGN KEY (`participation_id`) REFERENCES `participation` (`id`);

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `fk_team_team` FOREIGN KEY (`parentteam_id`) REFERENCES `team` (`team_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
