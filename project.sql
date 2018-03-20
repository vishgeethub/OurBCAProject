-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2018 at 07:41 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE IF NOT EXISTS `admin_table` (
  `adminid` int(10) NOT NULL AUTO_INCREMENT,
  `aname` varchar(15) NOT NULL,
  `loginid` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `emailID` varchar(20) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`adminid`, `aname`, `loginid`, `password`, `emailID`) VALUES
(2, 'Kalp Shah', 'kalpshah', 'kalp@123', 'shahkalp4567@gmail.c');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_table`
--

CREATE TABLE IF NOT EXISTS `advertisement_table` (
  `advertisementid` int(10) NOT NULL AUTO_INCREMENT,
  `photo` varchar(100) NOT NULL,
  `navigateURL` varchar(100) NOT NULL,
  `posteddate` date NOT NULL,
  `enddate` date NOT NULL,
  `advertiserid` int(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  PRIMARY KEY (`advertisementid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `advertisement_table`
--

INSERT INTO `advertisement_table` (`advertisementid`, `photo`, `navigateURL`, `posteddate`, `enddate`, `advertiserid`, `amount`) VALUES
(3, 'image/70_istock_000010018576large400__.jpg', 'www.watechrosystem.com/free_waterplants_8709900087', '2016-12-06', '2017-03-06', 6, '10000'),
(4, 'image/Hungry-for-Change-DVD1.jpeg', 'www.foodsforfree.com/welfare_67897789', '2017-01-05', '2017-02-05', 4, '4000'),
(6, 'image/group-shot-of-boxes.jpg', 'www.womenwork.com', '2017-01-16', '2017-03-16', 11, '5000'),
(7, 'image/dsc_6421-Bangladesh.jpg', 'www.sulekha.com/poor_area', '2016-08-11', '2017-01-11', 7, '1000'),
(8, 'image/Hungry-for-Change-DVD1.jpeg', 'www.hungryforchange.om', '2016-11-02', '2017-02-02', 5, '8000'),
(9, 'image/images.jpg', 'www.womenwelfare.org', '2016-12-14', '2017-03-14', 8, '9000'),
(10, 'image/main-qimg-853e6cdec6ee3c4762d77768a86a46bf-c.jpg', 'www.chileducation.org', '2017-01-05', '2017-03-05', 10, '3000'),
(11, 'image/street-children.jpg', 'www.educationworld.org', '2017-01-04', '2017-01-19', 13, '8500'),
(12, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(13, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(14, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(15, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(16, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(17, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(18, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(19, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(20, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(21, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(22, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(23, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(24, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(25, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(26, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(27, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(28, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(29, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(30, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(31, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(32, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(33, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(34, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(35, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(36, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(37, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(38, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(39, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(40, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(41, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(42, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(43, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(44, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(45, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(46, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(47, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(48, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(50, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(51, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(52, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(53, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(54, 'image/', '', '0000-00-00', '0000-00-00', 0, ''),
(56, 'image/10477615_801606569870025_1833109845_n.jpg', 'www.shiksha.com/parsedata.htm', '2016-08-10', '2017-02-09', 9, '5700');

-- --------------------------------------------------------

--
-- Table structure for table `advertiser_table`
--

CREATE TABLE IF NOT EXISTS `advertiser_table` (
  `advertiserid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `companyname` varchar(30) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `regdate` date NOT NULL,
  PRIMARY KEY (`advertiserid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `advertiser_table`
--

INSERT INTO `advertiser_table` (`advertiserid`, `name`, `companyname`, `contactno`, `emailid`, `regdate`) VALUES
(6, 'Ashok Shah', 'Watech RO System (I) Pvt. Ltd', '9856473214', 'info@watechrosystem.com', '2017-01-16'),
(7, 'Dharmendra Thakkar', 'Sulekha Educations', '7456823156', 'info@sulekha.com', '2017-01-16'),
(8, 'Alok Dhruv', 'Shraddha Institutes', '7854693214', 'info@shraddha.com', '2017-01-16'),
(9, 'Prince Jain', 'Shiksha Education World', '7456982315', 'info@shiksha.com', '2017-01-16'),
(10, 'Urmil Desai', 'Prathma Blood Center', '7458622356', 'info@prathma.com', '2017-01-16'),
(11, 'Rupal Shah', 'Redcross Blood Bank', '2365453215', 'info@redcross.com', '2017-01-16'),
(13, 'Kavan Patel', 'Eduworld classes', '7586941235', 'info@eduworld.com', '2017-01-16'),
(14, 'Paragh Shah', 'Pritam Steel Pvt LTD', '9856742315', 'paraghshah324@gmail.com', '2017-03-19'),
(15, 'Pulkesh bhai', 'Krishna Keshav Lbt.', '7856941236', 'info@krishnakeshav.com', '2017-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `album_table`
--

CREATE TABLE IF NOT EXISTS `album_table` (
  `album_id` int(10) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(30) NOT NULL,
  `coverpage` varchar(100) NOT NULL,
  `eventid` int(10) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `album_table`
--

INSERT INTO `album_table` (`album_id`, `album_name`, `coverpage`, `eventid`) VALUES
(24, 'Balghars Album 2016', 'image/b.jpg', 19),
(25, 'waste management', 'image/2007103011.jpg', 24);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `areaid` int(10) NOT NULL AUTO_INCREMENT,
  `areaname` varchar(30) NOT NULL,
  `pincode` varchar(15) NOT NULL,
  `cityid` int(10) NOT NULL,
  PRIMARY KEY (`areaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`areaid`, `areaname`, `pincode`, `cityid`) VALUES
(15, 'raykhad', '380001', 9),
(16, 'Baraipura', '464001', 24),
(18, 'Narasinghapur', '743294', 22),
(19, 'Masuriaaaaa', '504321', 21),
(20, 'Gurdev Nagar', '141001', 20),
(21, 'Pulimodu', '695001', 19),
(22, 'Amupur', '132001', 18),
(23, 'Paldi', '380015', 16),
(24, 'Kheralu', '385001', 15),
(25, 'Samdi Chakla', '234576', 17),
(26, 'Bardez', '403511', 14),
(27, 'Nangal Raya', '110046', 13),
(28, 'Kamrup', '781007', 12),
(29, 'Yinkikong', '791002', 11),
(30, 'Bandari Jayamma', '242001', 10),
(31, 'Vastrapur', '380015', 25),
(32, 'Kalupur', '380001', 25),
(33, 'Varachha Road', '395006', 27),
(35, 'Malad West', '400095', 29),
(36, 'Dharamtala', '700013', 22),
(37, 'Surya Vihar', '122001', 59),
(38, 'Kunnamkulam', '680503', 60),
(39, 'Green Park', '110016', 30),
(40, 'Bhilwara', '201301', 23),
(42, 'Kurnool', '518002', 24);

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE IF NOT EXISTS `category_table` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`cat_id`, `cat_name`) VALUES
(5, 'All'),
(6, 'Women Welfare'),
(7, 'Health'),
(8, 'Enviorment'),
(9, 'Children'),
(10, 'Disabled'),
(11, 'Elderly (For Old People)'),
(12, 'Rural Development'),
(14, 'Waste Management'),
(15, 'Rural Development'),
(16, 'Drinking Water'),
(17, 'Animal Welfare'),
(18, 'Education Awareness');

-- --------------------------------------------------------

--
-- Table structure for table `charity_table`
--

CREATE TABLE IF NOT EXISTS `charity_table` (
  `charityid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `NGOid` int(10) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `adhar_no` varchar(16) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `charitydate` date NOT NULL,
  PRIMARY KEY (`charityid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `charity_table`
--

INSERT INTO `charity_table` (`charityid`, `uid`, `NGOid`, `amount`, `adhar_no`, `purpose`, `charitydate`) VALUES
(1, 3, 20, '700', '8546-4569-7584', 'To help poor peoples!!', '2016-03-15'),
(2, 3, 22, '200', '8956-7458-9658', 'To helping for a better future!!', '2017-02-06'),
(3, 3, 22, '1000', '184265846845', 'New Year!!', '2017-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `cityid` int(10) NOT NULL AUTO_INCREMENT,
  `cityname` varchar(20) NOT NULL,
  `stateid` int(10) NOT NULL,
  PRIMARY KEY (`cityid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityid`, `cityname`, `stateid`) VALUES
(20, 'Ludhiana', 19),
(21, 'Jodhpur', 20),
(22, 'Kolkata', 25),
(23, 'Thane', 29),
(24, 'Bhopal', 30),
(25, 'Ahmedabad', 8),
(27, 'Surat', 8),
(28, 'Pune', 22),
(29, 'Mumbai', 22),
(30, 'New Delhi', 21),
(59, 'Gurgaon', 29),
(61, 'Noida', 23),
(62, 'Kurnool', 24),
(63, 'Chennai', 18),
(64, '', 0),
(65, 'Cochin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE IF NOT EXISTS `comment_table` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `eventid` int(10) NOT NULL,
  `commentdate` date NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comment_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `event_table`
--

CREATE TABLE IF NOT EXISTS `event_table` (
  `eventid` int(10) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(30) NOT NULL,
  `NGOid` int(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `eventdate` date NOT NULL,
  `eventtime` varchar(10) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `areaid` int(10) NOT NULL,
  `eventphoto` varchar(100) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `event_table`
--

INSERT INTO `event_table` (`eventid`, `eventname`, `NGOid`, `description`, `eventdate`, `eventtime`, `venue`, `areaid`, `eventphoto`, `contactno`, `cat_id`, `status`) VALUES
(14, 'Food For Change', 20, 'The main objective of this event was to introduce the concept \r\nof food with philanthropy in Ahmedabad, Gujarat and to bring various \r\ncauses at one platform.', '2017-01-27', '10:00 am', 'AEC  Ground', 31, 'image/aa.jpg', '26751023', 9, 0),
(15, 'DONATE BOOKS', 20, 'Donate used Educational books to help students in need. \r\n', '2017-01-20', '4:00 pm', 'N K Ground', 32, 'image/b.jpg', '26751023', 18, 0),
(16, 'Swavlambi', 24, 'The main  vision of this event is to create a community of self-reliant, \r\nself â€“ employed women who can live with dignity and security.\r\nWith trained intervention, ManavSeva Foundation will support these women\r\nby imparting them with vocational skills in embroidery, sewing and more.', '2017-02-03', '10:00 am', 'jagruti marg,jyotibaphule road,', 35, 'image/womenwelfare.jpg', '2147483647', 6, 0),
(17, 'Giving street children a futur', 21, 'Through these programmes, and the dedication of the teachers, \r\nstaff and volunteers, children gain confidence, \r\nsocial values and most importantly, \r\nskills which will carry them further in life.', '2017-02-04', '4:30 pm', 'Goddod road', 33, 'image/streetchildren.jpg', '23874567', 9, 0),
(18, 'Sujal', 26, 'Access to safe and clean drinking water for rural preschools children\r\n', '2017-01-02', '12:00 pm', 'Kanchana Vidhyalaya', 21, 'image/sujal.jpg', '23465723', 16, 0),
(19, 'Balghars', 27, 'Balghars are preschools for the underprivileged children providing them \r\na nurturing and educational environment to study ahead.', '2017-01-20', '11:00 am', '19, Dashaporvad Society', 31, 'image/balghard.jpg', '26561234', 18, 0),
(20, 'Housing and shelter', 26, 'To organize slum communities against unlawful and illegal evictions\r\nand resettlements or housing that are less adequate\r\n', '2017-01-19', '5:00 pm', 'Near St. lewis marg', 21, 'image/shelter.jpg', '56743555', 15, 0),
(21, 'Women at work', 24, 'Working towards breaking the stereotypes attached to gender roles and \r\ntraining women in courses\r\nwhich are considered non traditional for them', '2017-02-11', '9:00 am', 'Gurukul udhyog ', 35, 'image/swavlambi2.jpg', '76534255', 6, 0),
(23, 'SPARSH', 29, 'It is a vocational training unit for parents and families of disabled children.\r\nThey manufacture paper plates, phenoil, detergent, jewellary making and candle \r\nmaking with the help of parents and family members our special children.\r\nFamilies are engaged in vocational training. Our goal is \r\nto provide opportunity for them to earn an extra income using these vocations.', '2017-03-18', '11:00 am', 'Guruvayur Road', 38, 'image/banner_2.jpg', '914885222415', 10, 0),
(24, 'Waste Management', 30, 'This system will support proper collection & recycling of waste generated from our\r\nresidential societies, manufacturing units and offices. ', '2017-04-08', '5:00 pm', 'Registered Office\r\nCD-86C', 41, 'image/ragpickers.jpg', '919654815105', 9, 0),
(26, 'Clean Roads', 20, 'Clean streets with the help of volunteers and Government workers.', '2017-03-19', '11:00 am', 'AEC ground,Navrangpura', 31, 'image/street-children.jpg', '9898745621', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE IF NOT EXISTS `feedback_table` (
  `feedbackid` int(10) NOT NULL AUTO_INCREMENT,
  `feedback` varchar(200) NOT NULL,
  `feedbackdate` date NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`feedbackid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `feedback_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `inquiry_table`
--

CREATE TABLE IF NOT EXISTS `inquiry_table` (
  `inqid` int(11) NOT NULL AUTO_INCREMENT,
  `inqname` varchar(20) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `msg` varchar(200) NOT NULL,
  PRIMARY KEY (`inqid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inquiry_table`
--

INSERT INTO `inquiry_table` (`inqid`, `inqname`, `emailid`, `msg`) VALUES
(1, 'Janushi', 'janushi@gmail.com', 'jhdsfsdv kgbvfkjvb kbkvbkj');

-- --------------------------------------------------------

--
-- Table structure for table `news_table`
--

CREATE TABLE IF NOT EXISTS `news_table` (
  `newsid` int(10) NOT NULL AUTO_INCREMENT,
  `short_desc` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `NGOid` int(10) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `newsdate` date NOT NULL,
  PRIMARY KEY (`newsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `news_table`
--

INSERT INTO `news_table` (`newsid`, `short_desc`, `description`, `NGOid`, `photo`, `newsdate`) VALUES
(5, 'NGO launches website to help identify birds', 'THANE: Bringing cheer to thousands of budding environmental photographers and amateur bird watchers, the Bombay Natural History Society (BHNS) has recently launched a one-of-its-kind online platform that identifies Indian bird species using artificial intelligence.', 20, 'image/56551699.jpg', '2017-01-13'),
(7, 'Out-of-school kids’ stats: NGO, officials at loggerheads', 'NAGPURr: There are very few things that the NGOs and education department agree upon. Real statistics related to out-of-school kids is definitely at top of the list which makes them disagree about. The district education department insists there are just over 1000 such kids while the NGO Sangharsh Vahini claims the figure is much more, almost double than that.', 20, 'image/56533388.jpg', '2017-01-16'),
(13, 'Cops, NGO stop child marriage', 'INDORE: City police, with the help of Childline, on Friday managed to stop a child marriage where the bride was a minor.', 20, 'image/56153251.jpg', '2017-01-02'),
(14, 'NGO in Chennai to aid of Vardah-hit Pulicat fisherfolk', 'CHENNAI: After cyclone Vardah raged through the city on December 12, 2016, volunteers of Rapid Response, an NGO, were among the first to swing into action. A day later, they were out on the streets distributing food packets and relief kits. Almost a month later, they have started a crowdfunding campaign to raise money to restore the livelihood of about 150 fishermen in ', 20, 'image/56483808.jpg', '2017-01-14'),
(15, 'NGO, local police conducted raid at a slaughter house in Ahmednagar, ', 'MUMBAI: A major raid was recently conducted at an illegal slaughterhouse in Sangamner, Ahmednagar district, where the police and activists seized 46 calves and also booked three butchers involved in this extreme animal cruelty.', 20, 'image/56448464.jpg', '2017-03-26'),
(16, 'NGO to help 4 lakh women detect breast cancer', 'NAGPUR: With an aim to make the city free from breast cancer, NGO Deen Dayal Upadhyay Institute of Medical Science and Human Resource has introduced a modern technology, which it claims is even new to the nation.', 20, 'image/ca12f76f6ff63670d278a032d09e5947_1484020968165_0.jpg', '2017-01-05'),
(17, 'High court stays handover of Adarsh school to Ferozepur NGO', 'CHANDIGARH: The Punjab and Haryana high court on Thursday stayed the order of Punjab education development board appointing an NGO, with criminal antecedents, as a private partner to run Adarsh Senior Secondary School, Hardasa in Ferozepur district.', 20, 'image/56011213.jpg', '2017-01-16'),
(18, 'NGO moves to NGT, wants meat processing units closed', 'To bring an end to illegal slaughtering of animals, city NGO Sukrut Nirman Charitable Trust has once again moved to the National Green Tribunal (NGT). The NGO has demanded punitive action against the illegal meat processing units of the state.', 21, 'image/meatslaughtering.jpg', '2017-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_table`
--

CREATE TABLE IF NOT EXISTS `ngo_table` (
  `NGOid` int(10) NOT NULL AUTO_INCREMENT,
  `NGOname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `areaid` int(10) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `website` varchar(30) NOT NULL,
  `phone` int(15) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `loginid` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `rdate` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`NGOid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `ngo_table`
--

INSERT INTO `ngo_table` (`NGOid`, `NGOname`, `address`, `areaid`, `emailid`, `website`, `phone`, `logo`, `description`, `loginid`, `password`, `rdate`, `status`) VALUES
(20, 'Utthan', '36, Chitrakut Twins\r\nNehru Park,', 31, 'utthan.ahmedabad@gmail.com', 'www.utthangujarat.org', 26751023, 'image/logo.jpg', 'Utthan brings together a group of professional development workers, committed to working with communities towards an India free of inequalities and discrimination with equal opportunities, security and freedom for all.', 'utthan_ahd', '123456', '2017-01-16', 1),
(21, 'Invincible NGO', '308, 3rd Floor, Above Chocolate Room, University Plaza, Near Roads, University Area 380015,', 33, 'info.invincible@gmail.com', 'www.invinciblengo.com', 2147483647, 'image/invicible_original_white_border.png', 'Keeping the core values and the ethics in center, INVINCIBLE â€“ the NGO will be a benchmark in training the youth for a better situation.', 'invicible_ngo', '123456', '2017-01-16', 1),
(22, 'Jivandhara Old Age Home', 'Padmavati Nagar Society,', 20, 'info.jivandhara@gmail.com', 'www.jivandhara.org', 2147483647, 'image/logoyuva.png', 'Institutions For Aged', 'jivandhara', '123456', '2017-01-16', 1),
(23, 'Avbodh Knowledge Foundation', '30 subhash park,opp brts bus stop,nehrunagar', 33, 'info@avbodh.org', 'www.avbodh.org', 2147483647, 'image/Picture2.png', 'At present, Avbodh works towards rural empowerment in order to make the rural population self-reliant and self-sustainable by providing quality education', 'avbodh', '123456', '2017-01-16', 1),
(24, 'Samvedana Foundation', 'jagruti marg,jyotibaphule road,', 35, 'info@samvedana.com', 'www.samvedana.org', 2147483647, 'image/samvedana_logo.jpg', 'SAMVEDANA empowers young mind to live the poetâ€™s dream.', 'samvedana', '123456', '2017-01-16', 1),
(25, 'Visamo Kids', 'Nandanpark  Society', 18, 'visamokids@calorx.org', 'www.visamokids.org', 2147483647, 'image/Visamokids_Foundation_logo.png', 'Visamo Kids Foundation (VKF), an Ahmedabad based NGO, works towards providing free education to poor children coming from underprivileged families', 'visamokids', '123456', '2017-01-16', 1),
(26, 'Saath Charitable  Trust ', 'CONTACT USO/102 NandanvanV,\r\nNear Prerana Tirth Dehrasar', 21, 'mail@sath.org', 'www.sath.org', 2147483647, 'image/logo-sml.png', 'Saath (which in Hindi/Gujarati means â€˜together, co-operation, a collective or supportâ€™), founded in 1989, is an NGO in India registered as a Public Charitable Trust', 'sathorg', '123456', '2017-01-16', 1),
(27, 'Aasman Foundation', '19, Dashaporvad Society,\r\nBesides Navchetan School,', 31, 'contactus@aasmaanfoundation.or', 'www.aasmanfoundation.org', 2147483647, 'image/aasman.png', 'AASMAAN Foundation was started in the year 2009, as a group of people who wanted to give something back to the society in some or the other way. ', 'aasmanfnd', '123456', '2017-01-16', 1),
(28, 'Dream Girl Foundation', '99F, B-Block', 37, 'info@dreamgirlfoundation.ngo', 'dreamgirlngo@gmail.com', 2147483647, 'image/images.png', 'Dream Girl Foundation is a non-profit making organisation which has\r\n been working hard for the upliftment and betterment of the girls. \r\n We focus on improving the lives of girls by providing them education,\r\n shelter and clothing across the country. By transforming their lives now,\r\n we change the course of their future and ours.', 'dreamgirl', '123456', '2017-03-18', 1),
(29, ' Tropical Health foundation of', 'Guruvayur Road Kunnamkulam', 38, 'mail@thfi.in', 'tropicalhealthfoundation.org', 2147483647, 'image/', 'We Help Differently Abled Children, turn tears to smiles.\r\nTropical Health Foundation of India is a nonprofit \r\ncharitable voluntary organization functioning at Kunnamkulam \r\nMunicipality of Thrissur District. The Tropical Health Foundation \r\nof India was founded by Dr.K. Jacob Roy and late Maj. A.V. Thomas in 1986.', 'thfi', '123456', '2017-03-18', 1),
(30, 'Shuddhi Foundation', 'CD-86C, Pitampura', 41, 'info@shuddhi.org', 'www.shuddhi.org', 2147483647, 'image/logo.png', 'The main objective of SHUDDHI is to introduce fresh concept of Integrated Waste Management\r\nSystem in India.', 'shuddhi', '123456', '2017-03-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

CREATE TABLE IF NOT EXISTS `photo_gallery` (
  `galleryid` int(10) NOT NULL AUTO_INCREMENT,
  `photo` varchar(250) NOT NULL,
  `description` varchar(200) NOT NULL,
  `album_id` int(10) NOT NULL,
  PRIMARY KEY (`galleryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `photo_gallery`
--

INSERT INTO `photo_gallery` (`galleryid`, `photo`, `description`, `album_id`) VALUES
(5, 'image/main-qimg-853e6cdec6ee3c4762d77768a86a46bf-c.jpg', 'Education to rural children', 24),
(6, 'image/70_istock_000010018576large400__.jpg', 'Clean and safe Drinking Water', 24),
(8, 'image/hrds_attapadi3.JPG', 'Shelter for rural development', 24),
(9, 'image/INT0003Cambodian-children-leave-school-by-bikes-and-walking.jpg', 'Giving street children a future', 24),
(10, 'image/street-children.jpg', 'THE LIFE OF THOSE, WHO HAVE NO HOPE!', 24),
(11, 'image/group-shot-of-boxes.jpg', 'Eat healthy Food', 24),
(12, 'image/moladi_Brickless-construction.jpg', 'Shelter for needy people', 24),
(13, 'image/10477615_801606569870025_1833109845_n.jpg', 'Donating books', 24),
(14, 'image/10477615_801606569870025_1833109845_n.jpg', 'Donating books for better future', 24);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `stateid` int(10) NOT NULL AUTO_INCREMENT,
  `statename` varchar(20) NOT NULL,
  PRIMARY KEY (`stateid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateid`, `statename`) VALUES
(8, 'Gujarat'),
(18, 'Tamilnadu'),
(19, 'Punjab'),
(20, 'Rajasthan'),
(21, 'Delhi'),
(22, 'Maharashtra'),
(23, 'Uttar Pradesh'),
(24, 'Andhra Pradesh'),
(25, 'West Bengal'),
(26, 'Aasam'),
(27, 'Mizoram'),
(28, 'Kerala'),
(29, 'Haryana'),
(34, 'Madhya Pradesh');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `areaid` int(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `dob` date NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `loginid` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profilepic` varchar(100) NOT NULL,
  `rdate` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`uid`, `uname`, `address`, `areaid`, `phone`, `gender`, `dob`, `emailid`, `loginid`, `password`, `profilepic`, `rdate`, `status`) VALUES
(1, 'Jainil Mehta', 'Shyaml', 31, '9635269874', 'M', '1997-04-28', 'mehtajainil@gmail.com', '123', '123456', 'image/1484598572146_profile.jpg', '2017-01-16', 1),
(2, 'Vishal Shah', 'A-23. Priyadarshni Apr., Nr.Shahibaug Hotel, Girdharnagar road,', 32, '9658693242', 'M', '1997-05-09', 'vishal234@gmail.com', 'vishal9759', 'qwerty', 'image/1484679656753_profile.jpg', '2017-01-17', 1),
(3, 'Kamlesh Tolani', 'T-4, Kaveri Flats, Nr.Railway Station,', 32, '9200300303', 'M', '2003-06-12', 'tolani_kamlesh126@outlook.com', 'kamlesh_tolani', '12345678', 'image/1489947836118_profile.jpg', '2017-03-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_table`
--

CREATE TABLE IF NOT EXISTS `volunteer_table` (
  `volunteerid` int(10) NOT NULL AUTO_INCREMENT,
  `eventid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `rdate` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`volunteerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `volunteer_table`
--

INSERT INTO `volunteer_table` (`volunteerid`, `eventid`, `uid`, `rdate`, `status`) VALUES
(1, 19, 3, '0000-00-00', 1);
