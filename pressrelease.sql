-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2014 at 07:28 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pressrelease`
--

-- --------------------------------------------------------

--
-- Table structure for table `press_release`
--

CREATE TABLE IF NOT EXISTS `press_release` (
  `release_id` int(4) NOT NULL,
  `headline` varchar(50) NOT NULL,
  `summary` varchar(100) NOT NULL,
  `news_body` varchar(999) NOT NULL,
  `company_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `press_release`
--

INSERT INTO `press_release` (`release_id`, `headline`, `summary`, `news_body`, `company_name`, `email`, `release_date`, `image`) VALUES
(1, 'Airline Missing', 'On 10th March. Airline gets missing and civil avia', 'On 10th March. Airline gets missing and civil aviation authorities are unable to find.thats why police force are in action.', 'Malesiyan Airline', 'someemail@mail.com', '2014-03-10', 'http://icons.iconarchive.com/icons/itzikgur/my-seven/512/Travel-Airplane-icon.png'),
(2, 'The fireworks on display', 'The fireworks display the community put on for Sam', 'The city council voted unanimously March 18 to introduce an ordinance amending the citys existing smoking ban in parks and on city property to include the use of electronic smoking devices. Currently, the existing ordinance prohibits smoking in various locations, but does not specifically address the use of electronic smoking devices.', 'News Release Company', 'firework@email.comm', '2014-03-17', 'http://upload.wikimedia.org/wikipedia/commons/1/1f/Fireworks_2.png'),
(3, 'New insight into Big Bang', 'New observations capture evidence of unimaginably ', 'In a landmark achievement, scientists say they have seen ripples in the weave of the universe, which would provide the first direct evidence that the universe underwent a massive and incomprehensibly fast growth spurt in its earliest infancy.\r\n\r\nIf the new findings are confirmed, they could very well earn their discoverers the Nobel Prize, says astrophysicist Xavier Siemens of the University of Wisconsin, Milwaukee. Researchers have sought to detect these ripples, known as gravitational waves, for years, and more than a dozen telescopes have been looking for them. Though Einstein predicted gravitational waves, he thought they might not be detectable, and their existence was in some doubt.', 'USA Today', 'usamail@mail.com', '2014-03-05', 'http://upload.wikimedia.org/wikipedia/commons/f/fa/Blank_BitCoin_Logo_Graphic.png'),
(4, 'St. Patricks Day parades go on', 'St. Patricks Day parades go on but mayors take a pass', 'NEW YORK (AP) â€” New York Citys St. Patricks Day parade stepped off Monday without Mayor Bill de Blasio marching with the crowds of kilted Irish-Americans and bagpipers amid a dispute over whether participants could carry pro-gay signs.\r\n\r\nThe worlds largest parade celebrating Irish heritage set off down Fifth Avenue on a cold and gray morning, the culmination of a weekend of St. Patricks Day revelry.\r\n\r\nDe Blasio held the traditional St. Patricks Day breakfast at Gracie Mansion with the Irish prime minister, Enda Kenny, but was boycotting the parade, which doesnt allow expressions of gay identity. Bostons new mayor, Martin Walsh, also opted out of that citys parade Sunday after talks broke down that would have allowed a gay veterans group to march.', 'USA Pass', 'usapass@somemail.com', '2014-03-08', 'http://fc07.deviantart.net/fs70/i/2012/113/c/1/wow_logo__blank__by_mangrovenkrabbe-d4xa3b1.png'),
(5, 'Whats app sold to Facebook', 'In October of 2013, Facebook (FB) acknowledged, for the first time publicly', 'Suddenly, I began to experience that same feeling that I got when I bought a red AMC Pacer Wagon and suddenly it seemed like they were everywhere on the road. Were there really more of them, or was I just noticing it more because now I owned one?\r\n\r\n', 'The News Release Com', 'usapress@somemail.co', '2014-01-01', 'http://pnconnect.porternovelli.com/wp-content/uploads/2014/02/Whatsapp-Icon-Logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `user` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(15) NOT NULL,
  `country` varchar(15) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user`, `pass`, `city`, `state`, `country`, `admin`) VALUES
('Andrew', 'andrew', 'Santa Clara', 'CA', 'U.S.A', 0),
('Billy', 'billy', 'New Jersey', 'New York', 'U.S.A', 1),
('manisha', 'vyas', 'sunnyvale', 'CA', 'U.S.A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_conn_press`
--

CREATE TABLE IF NOT EXISTS `user_conn_press` (
  `user` varchar(15) DEFAULT NULL,
  `release_id` int(4) DEFAULT NULL,
  KEY `fk_conn_user` (`user`),
  KEY `fk_conn_press` (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_conn_press`
--

INSERT INTO `user_conn_press` (`user`, `release_id`) VALUES
('manisha', 2),
('Andrew', 3),
('Billy', 4),
('manisha', 5),
('manisha', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_conn_press`
--
ALTER TABLE `user_conn_press`
  ADD CONSTRAINT `fk_release_conn` FOREIGN KEY (`release_id`) REFERENCES `press_release` (`release_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_conn` FOREIGN KEY (`user`) REFERENCES `user_account` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
