-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql1.woofwarrior.com
-- Generation Time: Aug 02, 2016 at 11:24 AM
-- Server version: 5.6.25-log
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `woofwarr_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(100) NOT NULL,
  `post_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `comment_date`) VALUES
(2, 16, 28, 'Test comment', 1451115563),
(3, 19, 45, 'Hello?', 1469424454),
(4, 21, 47, 'Where is USername?', 1469896304);

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `post_id` int(50) NOT NULL,
  `post_text` text NOT NULL,
  `post_create_time` int(10) NOT NULL,
  `post_owner` varchar(50) NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`post_id`, `post_text`, `post_create_time`, `post_owner`, `post_title`, `post_image`) VALUES
(6, 'Lima, and coffee hybrid', 1446956338, '3', 'Joe.waldoing Discussion on beans', 'no_img.png'),
(7, 'Discussion', 1447283379, '3', 'Discussion by joe.waldo', 'no_img.png'),
(8, 'In recent response to a survey Woof Warrior put together on dog toys here, we are super thrilled to have decided on our newest toy called Pett Bed. Have you been keeping up with Woof Warrior during its Indie Go Go campaign, which got hundreds of views. This time we are ready to demo the product for our viewers.\r\n\r\nWhat Pett Mat does is allow dog owners to communicate with their dog during their busy schedule throughout the day. Our Kickstarter is actually being reviewed, and we would like to hear about it.\r\n\r\nWe would be thrilled to get just $4,500 for our first round of crowdfunding! Crowdfunding allows users to put a small, usually $35 or so dollars, to support our project.\r\n\r\nRecently, we have been hearing about the recent stories about how others have adopted their pets. We are so excited to share our Supaw Hero of the week’s tale:\r\n\r\n \r\n\r\n”  Sometimes the owner has already taken the step of rescuing the dog from the Shelter. Someone recently adopted a young puppy who was not in a kennel at a shelter, although she saw an ad online. What she found was the dog was in the back of the shelter without any hope. She saw the puppy and it walked up to her and sat down. Years later the dog is a trained service dog.”\r\n\r\nThere is a lot of kind hearted people that know the benefit of adopting pets rather than breeding. That’s why we donate for people that help with the Woof Warrior project to local shelters and adoption sponsors. Do you have a story to share in the comments about how you adopted your dog?', 1447425371, '1', 'Kickstarter for Pett and Pooches', 'coollogo_com-346310450.png'),
(9, 'Hello Woof Warrior Family/ Squad,\r\n\r\nWow! We have received good feedback for the people that have said encouraging words. There is a small update we received from Kickstarter.\r\n\r\n\r\n"Backers need a realistic sense of where the project stands –– including what’s been accomplished so far, and what work remains to be done."\r\n\r\n\r\nYou can check out our Facebook Fanpage ( https://www.facebook.com/woofWarrior/?ref=hl ) and be PREPARED for OUR LAUNCHING BEFORE CHRISTMAS.\r\n\r\nLet your inner active dog owner come out. \r\n\r\nThanks for the support, and we’re looking forward to another amazing try on Kickstarter with you.\r\n\r\nfrom:\r\nWoof Warrior Team', 1447616055, 'Woof Warrior', 'Active Dog Owners Unite', 'newsletter3.jpg'),
(10, 'My friend, who works as a dog trainer, used to live on a farm and went to college study zoology. At college, she realized her passion for birds. She picked up a senior project of finding and documenting about a rare and endangered type of bird. It wasn’t easy research, but she came across a friend who could help. That dog was exceptional at finding birds, and was of the breed English Setter, a hunting dog. Shortly thereafter she switched her college degree program to helping dogs, and has been training them ever since.\r\n\r\nYou can view her videos here: https://www.youtube.com/watch?v=bwLUk_NLDGc\r\n', 1448380361, 'Woof Warrior', 'Woof Warrior\'s Tail of the Week', 'Hunting-Eng._Setter.png'),
(11, 'Admin Post', 1451023179, '2', 'New Post Christmas', 'Guard-Komondor.png'),
(12, 'Admin Post2', 1451023290, '2', 'New Post Christmas2', 'Guard-Standard_Schnauzer.png'),
(13, 'Admin Post3', 1451023412, '2', 'New Post Christmas3', 'Guard-Old_Eng._Mastiff.png'),
(14, 'Username Woof Warrior', 1451024046, '4', 'New Post from Admin', 'Guard-Giant_Schnauzer.png'),
(15, 'Success Admin', 1451024974, 'Woof Warrior', 'User FB 1659259714318336', 'Guard-Braz._Mastiff.png'),
(16, 'Post 12/26', 1451111980, 'Woof Warrior', 'Pst 12/26', 'Guard-Boxer.png'),
(17, 'Top 10 tips for being an active dog Owner you can implement today\r\n\r\n1.	Go to a dog park\r\n2.	Go to dog-friendly restaurant or café\r\n3.	Join a meetup group on active dog shelters such as http://www.meetup.com/Rochester-Active-Shelter-Group/\r\n4.	Give your dog a vacation away from the cat at DogVayCay.\r\n5.	New monthly toys, by subscription such as Bark Box.\r\n6.	A bigger crate when you go to work or keep the TV on.\r\n7.	Try a new brand of organic food such as Soul Stew, by Michael J Food\r\n8.	Join the discussions at WoofWarrior.com/woof\r\n9.	Take a tour of a local shelter and be reminded how lucky your dog is :) They are usually held on the weekend.\r\n10.	Watch a movie with your dog, such as Bolt or Tennis.', 1451347208, 'Woof Warrior', '10 Cool Tips to become an active dog friend today!', '12235126_940199052722264_7795673716402237619_n.jpg'),
(18, '<iframe width="342" height="280" frameborder="0" marginwidth="0" marginheight="0" scrolling="0" src="http://searchtools.adoptapet.com/public/searchtools/display/342x280_dog_no_logo"></iframe><div style="height: 29px; width: 342px; text-align:right;"><a href="http://www.adoptapet.com" title="Pet adoption and rescue powered by Adopt-a-Pet.com" style="color: #444444; text-decoration:none;"><img src="https://dq25e8j0im0tm.cloudfront.net/images/st-logo.gif" alt="Pet adoption and rescue powered by Adopt-a-Pet.com" width="121" height="29" border="0" align="right" /><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color: #444444;">Pet adoption and<br />\r\nrescue powered by</span></a></div>', 1452473813, 'Woof Warrior', 'Sunday Spotlight: Shelter Pets', 'Jake-Gyllenhaal-shepherd.png'),
(19, '123', 1469423713, '45', 'Test', 'IMG_4634.JPG'),
(20, 'Have you signed up? Get Points today! Create your own custom report on your dog daily.', 1469424248, '45', 'RooBo', 'roobo.jpg'),
(21, 'New post', 1469896085, '47', 'Hello, search for new users', 'no_img.png'),
(22, 'I am a new user', 1469896164, '47', 'Hello, search for new users', 'no_img.png');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `topic_id` int(100) NOT NULL,
  `topic_title` varchar(100) NOT NULL,
  `topic_create_time` int(10) NOT NULL,
  `topic_owner` varchar(50) NOT NULL,
  `topic_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`topic_id`, `topic_title`, `topic_create_time`, `topic_owner`, `topic_image`) VALUES
(1, 'The best of the fruits', 1446653660, '', 'Companion-Australian_Silky_Terrier.png');

-- --------------------------------------------------------

--
-- Table structure for table `last_activity`
--

CREATE TABLE `last_activity` (
  `activID` int(50) NOT NULL,
  `userID` int(50) NOT NULL,
  `last_active` int(10) NOT NULL,
  `first_active` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `last_activity`
--

INSERT INTO `last_activity` (`activID`, `userID`, `last_active`, `first_active`) VALUES
(0, 34, 1469995102, 1469994922);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `topic_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
