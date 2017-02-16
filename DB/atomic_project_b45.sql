SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trainer_atomic_project_b45`
--
CREATE DATABASE IF NOT EXISTS `trainer_atomic_project_b45` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trainer_atomic_project_b45`;

-- --------------------------------------------------------

--
-- Table structure for table `book_title`
--

CREATE TABLE IF NOT EXISTS `book_title` (
`id` int(11) NOT NULL,
  `book_name` varchar(111) NOT NULL,
  `author_name` varchar(111) NOT NULL,
  `soft_deleted` varchar(11) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_title`
--

INSERT INTO `book_title` (`id`, `book_name`, `author_name`, `soft_deleted`) VALUES
(1, 'Himu1', 'Humayun Ahmed1', 'No'),
(5, 'Himu2', 'Humayun Ahmed2', 'No'),
(6, 'dsfdgdg', 'fdgdg', 'Yes'),
(11, 'dfssf', 'sfd sf', 'Yes'),
(16, 'Himu3', 'Humayun Ahmed3', 'No'),
(17, 'Himu4', 'Humayun Ahmed4', 'No'),
(18, 'Himu5', 'Humayun Ahmed5', 'No'),
(19, 'Himu6', 'Humayun Ahmed6', 'No'),
(20, 'sdfsfdsfsfsfds fdsfsdf', 'dsdg', 'No'),
(21, 'dsgt', 'erytetr', 'No'),
(22, 'gfdhdsy', 'dsyeyr', 'No'),
(23, 'ftjhdsd', 'dgtsdtrtet', 'No'),
(24, 'fdghshysy', 'fdhhehye', 'No'),
(25, 'hytrsuytes', 'dssyeyre', 'No'),
(26, 'fsjuhhsed', 'ygfdhgdsdr', 'No'),
(27, 'fjhgsdrygtd', 'drtaert', 'No'),
(28, 'fjgssruesuy', 'sdrhyserye', 'No'),
(29, 'iujytedusey', 'ydrsuyrsy', 'No'),
(30, 'fujdrsuru', 'xfdhfdxjhfryf', 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_title`
--
ALTER TABLE `book_title`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_title`
--
ALTER TABLE `book_title`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
