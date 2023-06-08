-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 01:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(48, 'PHP'),
(61, 'Laravel'),
(62, 'VisualBasic'),
(63, 'python '),
(64, 'Bootstrap');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(15, 169, 'Tony', 'perez391@gmail.com', 'This is so nice and great', 'Approved', '2023-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(143, 48, 'React', 'Odolo      ', '', '2023-05-12', 'react.jpg', '<p><i><strong>React is an awesome JavaScriprt framework</strong></i></p>', 'React native,', 0, 'published', 1),
(145, 48, 'Php', 'Tony', '', '2023-05-13', '', '<p>bjnu &nbsp; &nbsp; bn</p>', ' i ki7nbybn', 0, 'published', 0),
(146, 63, 'Python', 'Tony', '', '2023-05-13', '', '<p>Wonderful</p>', 'Tony', 0, 'published', 2),
(147, 64, 'Bootstrap', 'Tony', '', '2023-05-13', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(148, 48, 'React', 'Odolo      ', '', '2023-05-13', 'react.jpg', '<p><i><strong>React is an awesome JavaScriprt framework</strong></i></p>', 'React native,', 0, 'published', 0),
(149, 48, 'Php', 'Tony', '', '2023-05-13', '', '<p>bjnu &nbsp; &nbsp; bn</p>', ' i ki7nbybn', 0, 'published', 0),
(150, 63, 'Python', 'Tony', '', '2023-05-13', '', '<p>Wonderful</p>', 'Tony', 0, 'published', 0),
(151, 64, 'Bootstrap', 'Tony', '', '2023-05-13', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(152, 48, 'React', 'Odolo      ', '', '2023-05-13', 'react.jpg', '<p><i><strong>React is an awesome JavaScriprt framework</strong></i></p>', 'React native,', 0, 'published', 0),
(153, 48, 'Php', 'Tony', '', '2023-05-13', '', '<p>bjnu &nbsp; &nbsp; bn</p>', ' i ki7nbybn', 0, 'published', 0),
(154, 63, 'Python', 'Tony', '', '2023-05-13', '', '<p>Wonderful</p>', 'Tony', 0, 'published', 0),
(155, 64, 'Bootstrap', 'Tony', '', '2023-05-13', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(156, 64, 'Bootstrap', 'Tony', '', '2023-05-13', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(157, 64, 'Bootstrap', 'Tony', '', '2023-05-14', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(158, 64, 'Bootstrap', 'Tony', '', '2023-05-14', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(159, 63, 'Python', 'Tony', '', '2023-05-14', '', '<p>Wonderful</p>', 'Tony', 0, 'published', 0),
(160, 48, 'Php', 'Tony', '', '2023-05-14', '', '<p>bjnu &nbsp; &nbsp; bn</p>', ' i ki7nbybn', 0, 'published', 0),
(161, 48, 'React', 'Odolo      ', '', '2023-05-14', 'react.jpg', '<p><i><strong>React is an awesome JavaScriprt framework</strong></i></p>', 'React native,', 0, 'published', 0),
(162, 64, 'Bootstrap', 'Tony', '', '2023-05-14', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(163, 63, 'Python', 'Tony', '', '2023-05-14', '', '<p>Wonderful</p>', 'Tony', 0, 'published', 0),
(164, 48, 'Php', 'Tony', '', '2023-05-14', '', '<p>bjnu &nbsp; &nbsp; bn</p>', ' i ki7nbybn', 0, 'published', 0),
(165, 48, 'React', 'Odolo      ', '', '2023-05-14', 'react.jpg', '<p><i><strong>React is an awesome JavaScriprt framework</strong></i></p>', 'React native,', 0, 'published', 0),
(166, 64, 'Bootstrap', 'Tony', '', '2023-05-14', '', '<p>Thank You</p>', 'Tony', 0, 'draft', 0),
(167, 63, 'Python', 'Tony', '', '2023-05-14', '', '<p>Wonderful</p>', 'Tony', 0, 'published', 0),
(168, 48, 'Php', 'Tony', '', '2023-05-14', '', '<p>bjnu &nbsp; &nbsp; bn</p>', ' i ki7nbybn', 0, 'published', 0),
(169, 48, 'React', 'Odolo      ', '', '2023-05-14', 'react.jpg', '<p><i><strong>React is an awesome JavaScriprt framework</strong></i></p>', 'React native,', 3, 'published', 10),
(173, 62, 'test1', '', '13', '2023-05-17', '', '<p>dgbjbbkm</p>', 'erthgtr', 0, 'draft', 0),
(174, 48, '', '', '6', '2023-05-17', '', '', '', 0, 'draft', 0),
(175, 61, 'Angular', '', 'John ', '2023-05-18', '', '<p>hey there</p>', 'js', 0, 'published', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `token`) VALUES
(6, 'Tony', 'selflove', 'Tony', 'Odolo ', 'Tonymusanya391@gmail.com', '', 'Admin', ''),
(9, 'Rony', 'otieno', 'Rony', 'Odolo', 'otirony@gmail.com', '', 'Admin', ''),
(10, 'Iyton', 'Agalo', 'Iyton', 'Agalo', 'agalo@gmail.com', '', 'Subscriber', ''),
(13, 'Bob', '1234', 'Kelly', 'Bob', 'kellybob@gmail.com', '', 'Subscriber', ''),
(14, 'John ', '4321', 'Khaiser', 'John', 'john@gmail.com', '', 'Admin', ''),
(36, 'Peter', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'Peter', 'Blessings ', 'Blessings@gmail.com', '', 'Admin', ''),
(42, 'Ian', '$2y$10$3l1qfU2VGLe4XrSdY1tYXOJm5c8l.1pW4BcGa4K1UyLnFi4QP9RJm', '', '', 'Ian@gmail.com', '', 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(84, '46cvc3ecmthu6v6ltibsgjdr24', 1684254186),
(85, 'tke53a8roht87afm2t8afcm1lc', 1684151065),
(86, 'ufe6i1uj10n6n397huqfg5co5e', 1684154337),
(87, 'k7uegidrjbd384ri9vbdl01ukm', 1684398026);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
