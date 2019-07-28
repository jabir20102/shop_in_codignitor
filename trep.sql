-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2019 at 11:06 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trep`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image_url`, `date_added`) VALUES
(1, 'Jabir Khan', 'sheraz5006@gmail.com', 'abc123', 'uploads/backend/user_image/profile.jpg', '2019-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(7, 'Gents'),
(6, 'Mobiles');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `added_date` date NOT NULL,
  `isApproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `name`, `email`, `comment`, `added_date`, `isApproved`) VALUES
(6, 3, 'laravel', 'mjabir42@gmail.com', 'commentscommentscommentscomments', '2019-07-24', 1),
(9, 3, 'Hashir', 'aamir.shinka@yahoo.com', 'this is comment by hashir khan', '2019-07-24', 1),
(10, 3, 'khan', 'mjabir42@gmail.com', 'fables-commentsfables-commentsfables-commentsfables-comments', '2019-07-24', 1),
(11, 3, 'laravel', 'mjabir42@gmail.com', 'djkclkqswx', '2019-07-24', 1),
(12, 3, 'jabir', 'mjabir43@gmail.com', '\r\n  $this->db->order_by(\"id\", \"DESC\");', '2019-07-24', 1),
(13, 3, 'jabir', 'mjabir42@gmail.com', 'this is commeny', '2019-07-24', 1),
(14, 3, 'Jabir khan', 'mjabir42@gmail.com', 'Thus comment is posted from mobile phone', '2019-07-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(111) NOT NULL,
  `url` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `url`) VALUES
(2, 3, 'uploads/products/images/profile2.jpg'),
(3, 4, 'uploads/products/images/forms2.PNG'),
(4, 5, 'uploads/products/images/Capture.PNG'),
(5, 6, 'uploads/products/images/IMG_20180826_085423.jpg'),
(6, 7, 'uploads/products/images/IMG_20180629_131645.jpg'),
(7, 7, 'uploads/products/images/IMG_20180704_121443_886.jpg'),
(9, 9, 'uploads/products/images/IMG_20180825_184404_-_Copy.jpg'),
(10, 10, 'uploads/products/images/IMG_20180616_091517.jpg'),
(21, 10, 'uploads/products/images/IMG_20180704_121443_886.jpg'),
(24, 10, 'uploads/products/images/IMG_20190726_202146.jpg'),
(27, 9, 'uploads/products/images/profile_phot.jpg'),
(29, 11, 'uploads/products/images/IMG_20180704_121443_8861.jpg'),
(30, 11, 'uploads/products/images/slider1.jpg'),
(31, 11, 'uploads/products/images/slider2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `interactive_lessons`
--

CREATE TABLE `interactive_lessons` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `instructions` text NOT NULL,
  `section_id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `description` varchar(255) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(5) NOT NULL,
  `category` int(30) NOT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `visits` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `slug`, `description`, `details`, `price`, `category`, `sub_category`, `tags`, `visits`, `date_added`) VALUES
(3, 'Nayak full Hindi dubbed movie.. ramcharan super hero', 'nayak-full-hindi-dubbed-movie-ramcharan-super-hero', 'Dayavan (1988) Full Hindi Movie | Vinod Khanna, Madhuri Dixit, Feroz Khan, Aditya Pancholi\r\nDayavan (1988) Full Hindi Movie | Vinod Khanna, Madhuri Dixit, Feroz Khan, Aditya Pancholi', 'Dayavan (1988) Full Hindi Movie | Vinod Khanna, Madhuri Dixit, Feroz Khan, Aditya Pancholi\r\nDayavan (1988) Full Hindi Movie | Vinod Khanna, Madhuri Dixit, Feroz Khan, Aditya Pancholi\r\nDayavan (1988) Full Hindi Movie | Vinod Khanna, Madhuri Dixit, Feroz Khan, Aditya Pancholi', 1400, 6, 2, 'tag1 tag22', 10, '2019-07-24'),
(4, 'fvvf', 'fvvf', 'xfdghjklk', 'cgfhgjkl', 1200, 7, 4, 'tags', 4, '2019-07-24'),
(5, 'Aap Mujhe Achche Lagne Lage', 'aap-mujhe-achche-lagne-lage', 'Aap Mujhe Achche Lagne Lage (HD) | Full Movie | Hrithik Roshan | Amisha Patel| Bollywood Hit MoviesAap Mujhe Achche Lagne Lage (HD) | Full Movie | Hrithik Roshan | Amisha Patel| Bollywood Hit Movies', 'Aap Mujhe Achche Lagne Lage (HD) | Full Movie | Hrithik Roshan | Amisha Patel| Bollywood Hit MoviesAap Mujhe Achche Lagne Lage (HD) | Full Movie | Hrithik Roshan | Amisha Patel| Bollywood Hit MoviesAap Mujhe Achche Lagne Lage (HD) | Full Movie | Hrithik Roshan | Amisha Patel| Bollywood Hit Movies', 1100, 6, 2, 'tgas are here', 13, '2019-07-25'),
(6, 'Please Select Sub Category According to Parent Category', 'please-select-sub-category-according-to-parent-category', 'page-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fa', 'page-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-color', 1300, 7, 3, 'tag are her', 28, '2019-07-25'),
(7, 'DateTime', 'datetime', 'page-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fa', 'page-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-color', 1480, 6, 1, 'tags are here', 15, '2019-07-25'),
(9, 'this is best product to sale.', 'this-is-best-product-to-sale', 'page-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fa', 'page-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-colorpage-link rounded-circle fables-forth-text-color fables-page-link fables-second-hover-background-color', 890, 6, 1, 'tags are here', 25, '2019-07-25'),
(10, 'this is mobile phone sub_cat oppo', 'this-is-mobile-phone-sub_cat-oppo', 'if($sub_cat!=null){\r\n			$sub_cat_filter = implode(\"\',\'\", $sub_cat);\r\n			$query .= \"AND sub_category IN(\'\".$sub_cat_filter.\"\') \";\r\n		}', 'if($sub_cat!=null){\r\n			$sub_cat_filter = implode(\"\',\'\", $sub_cat);\r\n			$query .= \"AND sub_category IN(\'\".$sub_cat_filter.\"\') \";\r\n		}', 6700, 6, 2, 'tags are here', 9, '2019-07-26'),
(11, 'Create New Tutorial', 'create-new-tutorial', 'Create New TutorialCreate New TutorialCreate New TutorialCreate New Tutorial\r\nCreate New TutorialCreate New Tutorial', 'Create New TutorialCreate New Tutorial\r\n\r\nCreate New TutorialCreate New Tutorial\r\n\r\nCreate New TutorialCreate New Tutorial', 500, 7, 3, 'tag', 9, '2019-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text,
  `date_added` date NOT NULL,
  `last_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reported_tutorials`
--

CREATE TABLE `reported_tutorials` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  `report_reason` text NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `tutorial_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `product_id`, `category`, `date`) VALUES
(1, 10, 6, '2019-07-01'),
(2, 11, 6, '2019-07-23'),
(3, 5, 6, '2019-07-15'),
(4, 7, 6, '2019-07-21'),
(5, 9, 6, '2019-07-08'),
(6, 9, 6, '2019-07-24'),
(7, 3, 6, '2019-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `preferences` text,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `password`, `image_url`, `preferences`, `date_added`) VALUES
(1, 'Rosita Janka Student', 'sheraz5006@gmail.com', 'abc123', 'uploads/frontend/user_images/students/index-video.jpg', '{\r\n				\"categories\": [2,1],\r\n				\"skill_level\": \"all\"\r\n			}', '2019-03-23'),
(6, 'khan', 'mjabir42@gmail.com', 'khan1234', '', '', '2019-07-28'),
(7, 'Jabir Khan', 'mjabir421@gmail.com', 'khan1234', '', '', '2019-07-28'),
(8, 'khan', 'jabir20102@yahoo.com', 'jabirkhan12', '', '', '2019-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `sub_cat_name` varchar(100) NOT NULL,
  `parent_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `sub_cat_name`, `parent_cat_id`) VALUES
(1, 'Samsung', 6),
(2, 'Oppo', 6),
(4, 'shirts', 7);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `bio` varchar(10000) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `password`, `image_url`, `bio`, `date_added`) VALUES
(4, 'Rosita Janka Teacher', 'sheraz5006@gmail.com', 'abc123', '', '<p>Hello i am <b>Rosita Janka Teacher.</b> </p><p>Lorem <i>ipsum dolor</i> sit amet, consectetur adipisicing elit. Minima facilis sunt repellat magni eius necessitatibus. </p><p>Itaque <u>officiis illum</u>, a neque fugiat totam suscipit recusandae provident ullam ipsum dignissimos, harum nulla.</p>', '2019-03-28'),
(5, 'Rosita Janka Teacher 1', 'sheraz5006@gmail.com1', 'abc123', '', '<p>Hello i am <b>Rosita Janka Teacher 1.</b> </p><p>Lorem <i>ipsum dolor</i> sit amet, consectetur adipisicing elit. Minima facilis sunt repellat magni eius necessitatibus. </p><p>Itaque <u>officiis illum</u>, a neque fugiat totam suscipit recusandae provident ullam ipsum dignissimos, harum nulla.</p>', '2019-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `thumbnail_url` varchar(500) NOT NULL,
  `preview_url` varchar(500) NOT NULL,
  `tags` text NOT NULL,
  `count` bigint(20) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_lessons`
--

CREATE TABLE `video_lessons` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `duration` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `student_id`) VALUES
(1, 11, 1),
(3, 9, 1),
(5, 4, 7),
(6, 5, 1),
(7, 7, 1),
(8, 6, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique cat name` (`cat_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique combination of sid and tid` (`student_id`,`tutorial_id`) USING BTREE,
  ADD KEY `fk_etid_tid` (`tutorial_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `interactive_lessons`
--
ALTER TABLE `interactive_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_isid_sid` (`section_id`),
  ADD KEY `fk_itid_tid` (`tutorial_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ibfk_1` (`category`),
  ADD KEY `sub_category` (`sub_category`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique combination of sid and tid` (`student_id`,`tutorial_id`),
  ADD KEY `fk_rtid_tid` (`tutorial_id`);

--
-- Indexes for table `reported_tutorials`
--
ALTER TABLE `reported_tutorials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique combination of sid and tid` (`student_id`,`tutorial_id`) USING BTREE,
  ADD KEY `fk_retid_tid` (`tutorial_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stid_tid` (`tutorial_id`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique email` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique sub cat` (`sub_cat_name`),
  ADD KEY `fk_pcid_cid` (`parent_cat_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique email` (`email`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `sub_cat_id` (`sub_cat_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `video_lessons`
--
ALTER TABLE `video_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vsid_sid` (`section_id`),
  ADD KEY `fk_vtid_tid` (`tutorial_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `interactive_lessons`
--
ALTER TABLE `interactive_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reported_tutorials`
--
ALTER TABLE `reported_tutorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_lessons`
--
ALTER TABLE `video_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `fk_esid_sid` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_etid_tid` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interactive_lessons`
--
ALTER TABLE `interactive_lessons`
  ADD CONSTRAINT `fk_isid_sid` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_itid_tid` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_rsid_sid` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rtid_tid` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reported_tutorials`
--
ALTER TABLE `reported_tutorials`
  ADD CONSTRAINT `fk_resid_sid` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_retid_tid` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fk_stid_tid` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `fk_pcid_cid` FOREIGN KEY (`parent_cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD CONSTRAINT `tutorials_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorials_ibfk_2` FOREIGN KEY (`sub_cat_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorials_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video_lessons`
--
ALTER TABLE `video_lessons`
  ADD CONSTRAINT `fk_vsid_sid` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vtid_tid` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
