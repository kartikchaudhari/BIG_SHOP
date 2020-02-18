-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2017 at 06:18 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smartdb`
--
CREATE DATABASE `smartdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `smartdb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(11) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `password` varchar(14) NOT NULL,
  PRIMARY KEY  (`adm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `email`, `password`) VALUES
(1, 'sarjil1432@gmail.com', 'bigpass');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `c_id` varchar(30) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`c_id`, `p_id`, `qty`) VALUES
('127.0.0.1', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL auto_increment,
  `main_cat` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `sub_cat` varchar(30) NOT NULL,
  PRIMARY KEY  (`cate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=256 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `main_cat`, `category`, `sub_cat`) VALUES
(1, 'electronics', 'mobile', 'Samsung'),
(2, 'electronics', 'mobile', 'Lenovo'),
(3, 'electronics', 'mobile', 'Motorola'),
(4, 'electronics', 'mobile', 'LeEco'),
(5, 'electronics', 'mobile', 'Apple'),
(6, 'electronics', 'mobile', 'Mi'),
(7, 'electronics', 'mobile accessories', 'Headphones and Headsets'),
(8, 'electronics', 'mobile accessories', 'Power Banks'),
(9, 'electronics', 'mobile accessories', 'Screenguards'),
(10, 'electronics', 'mobile accessories', 'Memory Cards'),
(11, 'electronics', 'mobile accessories', 'Cables'),
(12, 'electronics', 'mobile accessories', 'Charger'),
(13, 'electronics', 'mobile accessories', 'Selfie Sticks'),
(14, 'electronics', 'wearables', 'Smart Watches'),
(15, 'electronics', 'wearables', 'Smart Bands'),
(16, 'electronics', 'wearables', 'Smart Glasses (VC)'),
(17, 'electronics', 'laptops', 'Samsung'),
(18, 'electronics', 'laptops', 'Apple'),
(19, 'electronics', 'laptops', 'HP'),
(20, 'electronics', 'laptops', 'Lenovo'),
(21, 'electronics', 'laptops', 'Asus'),
(22, 'electronics', 'computer accessories', 'External Hard Disks'),
(23, 'electronics', 'computer accessories', 'Pendrives'),
(24, 'electronics', 'computer accessories', 'Laptop Bags'),
(25, 'electronics', 'computer accessories', 'Mouse'),
(26, 'electronics', 'computer accessories', 'Keyboards'),
(27, 'electronics', 'Computer Peripherals', 'Printers and Ink Cartridges'),
(28, 'electronics', 'Computer Peripherals', 'Monitors'),
(29, 'electronics', 'Network Components', 'Routers'),
(30, 'electronics', 'Network Components', 'Data Cards'),
(31, 'electronics', 'tv', 'Ultra HD'),
(32, 'electronics', 'camera', 'DSLR'),
(33, 'electronics', 'camera', 'Point and Shoot'),
(34, 'electronics', 'camera', 'Sports and Lifestyle Camera'),
(35, 'electronics', 'camera accessories', 'Lenses'),
(36, 'electronics', 'camera accessories', 'Memory Cards'),
(37, 'electronics', 'camera accessories', 'Camera Bags'),
(38, 'electronics', 'tv', 'HD Ready'),
(39, 'electronics', 'tv', 'Full HD'),
(40, 'appliances', 'Home Entertainment', 'Speaker'),
(41, 'appliances', 'Home Entertainment', 'iPods and MP3 Players'),
(42, 'appliances', 'Home Entertainment', 'Home Theatres'),
(43, 'appliances', 'ac', 'Split ACs'),
(44, 'appliances', 'ac', 'Window ACs'),
(45, 'appliances', 'refrigerators', 'Single door'),
(46, 'appliances', 'refrigerators', 'Double Door'),
(47, 'appliances', 'refrigerators', 'Triple Door'),
(48, 'appliances', 'Washing Machine', 'Fully Automatic Front load'),
(49, 'appliances', 'Washing Machine', 'Fully Automatic Top load'),
(50, 'appliances', 'Washing Machine', 'Semi Automatic Top load'),
(51, 'appliances', 'kitchen appliances', 'Microwave Ovens'),
(52, 'appliances', 'kitchen appliances', 'Mixer/Juicer/Grinder'),
(53, 'appliances', 'kitchen appliances', 'Induction Cooktops'),
(54, 'appliances', 'kitchen appliances', 'Air Fryers'),
(55, 'appliances', 'kitchen appliances', 'Water Purifiers'),
(56, 'appliances', 'kitchen appliances', 'Sandwich Makers'),
(57, 'appliances', 'kitchen appliances', 'Popup Toastes'),
(58, 'appliances', 'kitchen appliances', 'Cofee Makers'),
(59, 'appliances', 'kitchen appliances', 'Hand Blender'),
(60, 'appliances', 'kitchen appliances', 'Electric Kettle'),
(61, 'appliances', 'kitchen appliances', 'Dishwasher'),
(62, 'appliances', 'kitchen appliances', 'Chimneys'),
(63, 'appliances', 'small appliances', 'Fans'),
(64, 'appliances', 'small appliances', 'Air Coolers'),
(65, 'appliances', 'small appliances', 'Vacum Cleaners'),
(66, 'appliances', 'small appliances', 'Iron'),
(67, 'appliances', 'small appliances', 'Landline Phones'),
(68, 'appliances', 'small appliances', 'Air Purifiers'),
(69, 'men', 'footwear', 'Sport Shoes'),
(70, 'men', 'footwear', 'Casual Shoes'),
(71, 'men', 'footwear', 'Formal Shoes'),
(72, 'men', 'footwear', 'Sandals and Floaters'),
(73, 'men', 'footwear', 'Loafers'),
(74, 'men', 'footwear', 'Boots'),
(75, 'men', 'footwear', 'Running Shoes'),
(76, 'men', 'footwear', 'Sneakers'),
(77, 'men', 'clothing', 'T-Shirts'),
(78, 'men', 'clothing', 'Shirts'),
(79, 'men', 'clothing', 'Jeans'),
(80, 'men', 'clothing', 'Trousers'),
(81, 'men', 'clothing', 'Sports Wear'),
(82, 'men', 'clothing', 'Suits and Blazers'),
(83, 'men', 'clothing', 'Innerwear'),
(84, 'men', 'clothing', 'Ethnic Wear'),
(85, 'men', 'clothing', 'Shorts'),
(86, 'men', 'watches', 'Fastrack'),
(87, 'men', 'watches', 'Casio'),
(88, 'men', 'watches', 'Titan'),
(89, 'men', 'watches', 'Fossil'),
(90, 'men', 'watches', 'Sonata'),
(91, 'men', 'accessories', 'Backpacks'),
(92, 'men', 'accessories', 'Wallets'),
(93, 'men', 'accessories', 'Belts'),
(94, 'men', 'accessories', 'Sunglasses and Frames'),
(95, 'men', 'accessories', 'Luggage'),
(96, 'men', 'accessories', 'Jewellery'),
(97, 'men', 'care appliances', 'Trimmers'),
(98, 'men', 'care appliances', 'Shavers'),
(99, 'women', 'clothing', 'Sarees'),
(100, 'women', 'clothing', 'Kurtas and Kurtis'),
(101, 'women', 'clothing', 'Dress Materials'),
(102, 'women', 'clothing', 'Shirt, Tops and Tunics'),
(103, 'women', 'clothing', 'Dresses'),
(104, 'women', 'clothing', 'Jeans'),
(105, 'women', 'footwear', 'Flats'),
(106, 'women', 'footwear', 'Heels'),
(107, 'women', 'footwear', 'Sports Shoes'),
(108, 'women', 'footwear', 'Casual Shoes'),
(109, 'women', 'footwear', 'Wedges'),
(110, 'women', 'footwear', 'Ethnic Footwear'),
(111, 'women', 'footwear', 'Boots'),
(112, 'women', 'footwear', 'Ballerinas'),
(113, 'women', 'footwear', 'Slipper and Flip-Flop''s'),
(114, 'women', 'accessories', 'handbags'),
(115, 'women', 'accessories', 'Wallets and Bags'),
(116, 'women', 'accessories', 'Sunglasses and Frames'),
(117, 'women', 'accessories', 'travel accessories'),
(118, 'women', 'watches', 'Fastrack'),
(119, 'women', 'watches', 'Titan'),
(120, 'women', 'watches', 'Fossil'),
(121, 'women', 'watches', 'Giordano'),
(122, 'women', 'watches', 'Daniel Klien'),
(123, 'women', 'beauty and care', 'Make Up'),
(124, 'women', 'beauty and care', 'Skin Care'),
(125, 'women', 'beauty and care', 'Hair Care'),
(126, 'women', 'beauty and care', 'Deodorants and Perfumes'),
(127, 'women', 'jewellery', 'Precious Jewellery'),
(128, 'women', 'jewellery', ' Artificial Jewellery'),
(129, 'women', 'jewellery', 'Gold Coins'),
(130, 'women', 'care appliances', 'Hair Straighteners'),
(131, 'women', 'care appliances', 'Hair Dryers'),
(132, 'women', 'care appliances', 'Epilators'),
(133, 'kids', 'kids clothing', 'Girl''s Clothing'),
(134, 'kids', 'kids clothing', 'Boy''s Clothing'),
(135, 'kids', 'kids clothing', 'Baby Girl Clothing'),
(136, 'kids', 'kids clothing', 'Baby Boy Clothing'),
(137, 'kids', 'kids clothing', 'Tween Girl Clothing'),
(138, 'kids', 'kids clothing', 'Tween Boy Clothing'),
(139, 'kids', 'footwear', 'Girls''s Footwear'),
(140, 'kids', 'footwear', 'Boy''s Footwear'),
(141, 'kids', 'footwear', 'Baby Footwear'),
(142, 'kids', 'footwear', 'Character Shoes'),
(143, 'kids', 'school supplies', 'School Bags'),
(144, 'kids', 'school supplies', 'School Combo Sets'),
(145, 'kids', 'school supplies', 'Lunch Box'),
(146, 'kids', 'school supplies', 'KIds'' Watches'),
(147, 'kids', 'toys', 'Remote Control Toys'),
(148, 'kids', 'toys', 'Educational Toys'),
(149, 'kids', 'toys', 'Soft Toys'),
(150, 'kids', 'toys', 'Cars and Vehicles'),
(151, 'kids', 'toys', 'Outdoor Toys'),
(152, 'kids', 'toys', 'Action Figures'),
(153, 'kids', 'toys', 'Board Games'),
(154, 'kids', 'toys', 'Musical Toys'),
(155, 'kids', 'toys', 'Dolls and Doll Houses'),
(156, 'kids', 'toys', 'Puzzels'),
(157, 'kids', 'baby care', 'Diapers'),
(158, 'kids', 'baby care', 'Strollers'),
(159, 'kids', 'baby care', 'Baby Bedding'),
(160, 'kids', 'baby care', 'Feeding and Nursing'),
(161, 'kids', 'baby care', 'Baby Bath Skin Care'),
(162, 'kids', 'baby care', 'Baby Grooming'),
(163, 'kids', 'baby care', 'Baby Health and Safety'),
(164, 'kids', 'baby care', 'Baby Gifting Sets'),
(165, 'kids', 'baby care', 'Maternity Care'),
(166, 'kids', 'baby care', 'Furniture'),
(167, 'home and furniture', 'kitchen and dining', 'Pots and Pans'),
(168, 'home and furniture', 'kitchen and dining', 'Pressure Cookers'),
(169, 'home and furniture', 'kitchen and dining', 'Kitchen Tools'),
(170, 'home and furniture', 'kitchen and dining', 'Gas Stoves'),
(171, 'home and furniture', 'Dining and Serving', 'Coffee Mugs'),
(172, 'home and furniture', 'Dining and Serving', 'Dinnerware and Crockery'),
(173, 'home and furniture', 'Dining and Serving', 'Bar and Glassware'),
(174, 'home and furniture', 'Kitchen Storage', 'Lunch Box'),
(175, 'home and furniture', 'Kitchen Storage', 'Flasks and Casseroles'),
(176, 'home and furniture', 'Kitchen Storage', 'Containers and Bottles'),
(177, 'home and furniture', 'furniture', 'Beds'),
(178, 'home and furniture', 'furniture', 'Sofas'),
(179, 'home and furniture', 'furniture', 'Dining tables'),
(180, 'home and furniture', 'furniture', 'TV Cabinets'),
(181, 'home and furniture', 'furniture', 'Mattresses'),
(182, 'home and furniture', 'furniture', 'Coffee and Center Tables'),
(183, 'home and furniture', 'furniture', 'Office and Study Furniture'),
(184, 'home and furniture', 'furniture', 'Storage'),
(185, 'home and furniture', 'furniture', 'Bean Bags'),
(186, 'home and furniture', 'furniture', 'Collapsible Wardrobes'),
(187, 'home and furniture', 'furniture', 'Inflatable Sofas'),
(188, 'home and furniture', 'furnishing', 'Bedsheets'),
(189, 'home and furniture', 'furnishing', 'Curtains'),
(190, 'home and furniture', 'furnishing', 'Cushion and Pillow Covers'),
(191, 'home and furniture', 'furnishing', 'Blankets, Quilts and Dohars'),
(192, 'home and furniture', 'furnishing', 'Towels'),
(193, 'home and furniture', 'furnishing', 'Mats and Carpets'),
(194, 'home and furniture', 'furnishing', 'Kitchen and Table Linen'),
(195, 'home and furniture', 'home decor', 'Paintings'),
(196, 'home and furniture', 'home decor', 'Clocks'),
(197, 'home and furniture', 'home decor', 'Wall Shelves'),
(198, 'home and furniture', 'home decor', 'Wall Decals'),
(199, 'home and furniture', 'home decor', 'Showpieces'),
(200, 'home and furniture', 'lighting', 'LED and CFL'),
(201, 'home and furniture', 'lighting', 'Decorative Lighting and Lamps'),
(202, 'home and furniture', 'other', 'Pet Supplies'),
(203, 'home and furniture', 'other', 'Gourmet and Specialty Foods'),
(204, 'home and furniture', 'tools and hardware', 'hardware and Electricals'),
(205, 'home and furniture', 'tools and hardware', 'Hand Tools'),
(206, 'home and furniture', 'tools and hardware', 'Power Tools'),
(207, 'home and furniture', 'tools and hardware', 'Gardening Tools'),
(208, 'home and furniture', 'tools and hardware', 'Ladders and Drying Stands'),
(209, 'Books and More', 'Books', 'Academic'),
(210, 'Books and More', 'Books', 'Literature and Fiction'),
(211, 'Books and More', 'Books', 'History and Politics'),
(212, 'Books and More', 'Books', 'Bussiness'),
(213, 'Books and More', 'Books', 'Web Development'),
(214, 'Books and More', 'Books', 'Programming'),
(215, 'Books and More', 'Books', 'Web Design'),
(216, 'Books and More', 'Stationery', 'Pens'),
(217, 'Books and More', 'Stationery', 'Diaries'),
(218, 'Books and More', 'Stationery', 'Key Chains'),
(219, 'Books and More', 'Stationery', 'Desk Organiser'),
(220, 'Books and More', 'Stationery', 'Files and Folders'),
(221, 'Books and More', 'Gaming', 'PS3'),
(222, 'Books and More', 'Gaming', 'PS4'),
(223, 'Books and More', 'Gaming', 'Xbox One'),
(224, 'Books and More', 'Gaming', 'Xbox 360'),
(225, 'Books and More', 'Music', 'International Music'),
(226, 'Books and More', 'Music', 'Bollywood Music'),
(227, 'Books and More', 'Music', 'Vinyls'),
(228, 'Books and More', 'automobiles', 'Electric Bikes and Scooters'),
(229, 'Books and More', 'automobiles', 'Electric Scooter Borad'),
(230, 'Books and More', 'For Your Car', 'Car Body Covers'),
(231, 'Books and More', 'For Your Car', 'Car Interior and Exterior'),
(232, 'Books and More', 'For Your Car', 'Mobile Holders and Chargers'),
(233, 'Books and More', 'For Your Car', 'Car Audio and Video'),
(234, 'Books and More', 'For Your Car', 'Car Styling'),
(235, 'Books and More', 'For Your Bike', 'Helmets and Riding Gear'),
(236, 'Books and More', 'For Your Bike', 'Bike Covers'),
(237, 'Books and More', 'For Your Bike', 'Bike Tyres'),
(238, 'Books and More', 'For Your Bike', 'Biker Face Mask'),
(239, 'Books and More', 'Sports', 'Cricket'),
(240, 'Books and More', 'Sports', 'Badminton'),
(241, 'Books and More', 'Sports', 'Football'),
(242, 'Books and More', 'Sports', 'Cycling'),
(243, 'Books and More', 'Sports', 'Tennis'),
(244, 'Books and More', 'Sports', 'Camping and Hiking'),
(245, 'Books and More', 'Sports', 'Skating'),
(246, 'Books and More', 'Sports', 'Swimming'),
(247, 'Books and More', 'Sports', 'Table Tennis'),
(248, 'Books and More', 'Fitness Accessories', 'Gloves'),
(249, 'Books and More', 'Fitness Accessories', 'AB Exercisers'),
(250, 'Books and More', 'Fitness Accessories', 'Yoga Mats'),
(251, 'Books and More', 'Fitness Accessories', 'Dumbbels'),
(252, 'Books and More', 'Fitness Accessories', 'Cardio Equipment'),
(253, 'electronics', 'mobile accessories', 'boAt');

-- --------------------------------------------------------

--
-- Table structure for table `classifieds`
--

CREATE TABLE `classifieds` (
  `Ad_id` int(11) NOT NULL auto_increment,
  `c_id` int(11) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `desc` longtext NOT NULL,
  `brand` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `altmobile` varchar(13) NOT NULL,
  `altcity` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY  (`Ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `classifieds`
--

INSERT INTO `classifieds` (`Ad_id`, `c_id`, `p_name`, `category`, `desc`, `brand`, `email`, `altmobile`, `altcity`, `price`) VALUES
(13, 1, 'Ford Figo', 'Cars', '1 Year Used Ford Figo', 'Ford', 'sarjil1432@gmail.com', '8141674333', 'Valsad', 459999),
(15, 1, '4 seated dinning table in good condition', 'Furniture', '4 seated dining table 1 year used. Police can make it new', 'Vanil Udyog', 'sarrjil1432@gmail.com', '8141674333', 'Waghai', 8000),
(16, 2, 'iPhone 5s ( IN GOOD CONDITION )', 'mobile', '5 month used only 16GB inbuilt Memory.\r\nIOS 10.\r\nOne Hand Used', 'Apple', 'karan007@gmail.com', '8128747047', 'navsari', 15200),
(17, 2, '2009 Hero Honda CBZ 73000 Kms', 'Bikes', '2009 Hero Honda CBZ 73000 Kms one hand used in good condition', 'Honda', 'karan007@gmail.com', '8141674333', 'valsad', 32000),
(18, 2, 'Iphone 5s (Gray)', 'mobile', 'with original charger,  hands free, 3 months used, very good condittion ', 'Apple', 'karan007@gmail.com', '9712169979', 'Chickhli', 11000),
(19, 2, 'Maruti Suzuki Swift Dzire', 'Cars', ' CNG, 29000 Kms, Model - 2009, The Car is in full condition and female hand used.', 'Maruti Suzuki ', 'sarrjil1432@gmail.com', '8141674333', 'Valsad', 325000),
(20, 1, 'SAMSUNG S3 Neo', 'mobile', ' dual sim, 1.5GB RAM, 16GB ROM, bill, one hand used, only 6 month old', 'Samsung', 'sarjilshaikh02@gmial.com', '9712169979', 'chikhli', 5500),
(21, 1, 'Sankheda furniture one table with six chair', 'Furniture', 'Sankheda furniture one table with six chair in good condition , police can make it more newer ', 'vanil udyog', 'sarjilshaikh02@gmial.com', '9712169979', 'waghai', 10500),
(22, 1, 'Skoda Rapid (Diesel)', 'Cars', '59250 Kms, Model 2014, in cery good condition', 'Skoda', 'sarjilshaikh02@gmial.com', '9712169979', 'Valsad', 670000),
(23, 1, 'Sony Xperia', 'mobile', 'Sony Xperia 8 month old peice very good condition', 'Sony', 'sarjilshaikh02@gmial.com', '9712169979', 'Valsad', 9000),
(24, 1, 'Honda Dio', 'Bikes', ' 21750 Kms Model - 2011', 'Honda', 'sarjilshaikh02@gmial.com', '9712169979', 'Valsad', 24999);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL auto_increment,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `address` longtext NOT NULL,
  `photo` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `f_name`, `l_name`, `email`, `mobile`, `gender`, `city`, `pincode`, `address`, `photo`, `password`) VALUES
(1, 'Sarjil', 'Shaikh', 'sarjil1432@gmail.com', '9712169979', 'male', 'Vansda', '396580', 'Navafaliya Vansda', '749031FbPicsArt_02-20-07.14.04.jpg', '9712169979'),
(2, 'karan', 'Tandel', 'karan007@gmail.com', '8128747047', 'male', 'Navsaari', '396580', 'Navsari', '', 'karan007'),
(3, 'Salman', 'Ansari', 'ansarisalman38@yahoo.com', '7046328328', 'male', 'Vansda', '396580', 'KGN Society navafaliya vansda', '', 'salman');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `of_id` int(11) NOT NULL auto_increment,
  `s_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sub_title` varchar(70) NOT NULL,
  `desc` longtext NOT NULL,
  `start_date` varchar(15) NOT NULL,
  `end_date` varchar(15) NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`of_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`of_id`, `s_id`, `title`, `sub_title`, `desc`, `start_date`, `end_date`, `price`, `status`) VALUES
(5, 1, 'FLAT 50% OFF', 'Blacksmith Brown Plastic Wall Clock', 'Brand : Plaza\r\nColor : Brown\r\nInclusive of : 1\r\nDimensions (LXBXH) in cms of each piece: : 45 x 5 x 37 ', '05/02/2017', '05/02/2017', '899', 'approved'),
(6, 1, 'Combo Offer', 'Puma Wallet Free with Sennheiser HD 380 Over Ear Headphone', 'Overview--\r\n\r\nWith the Sennheiser HD 380 Over Ear Headphone now you can enjoy uncompromisingly clear and enhanced sound quality in a compact ear bud design that will leave you amazed beyond compare. The Sennheiser earphones deliver enhanced sound in a small package by combining top-quality materials with superior craftsmanship. From the Nano-precise, stainless-steel sound tunnel to the three-button multifunction remote with integrated microphone, this earphone from Sennheiser is designed with perfection and crafted with utmost detail and style. You can easily buy headphones from online from Snapdeal at highly affordable prices. Sennheiser scores high on customer satisfaction as it offers 2 Year Manufacturer Warranty.\r\n\r\nNoise Canceling--\r\n\r\nThe Sennheiser HD 380 Over Ear Headphone is detailed with reduced comb filter effects and distortion due to E.A.R. (Ergonomic Acoustic Refinement) and Duofol diaphragms. The headphones proficiently block out external noise as it is attributed with closed, circum-aural design for excellent passive attenuation of ambient noise (up to 32 dB).\r\n\r\nBass and Amplifier--\r\n\r\nFlaunting a Frequency Range of 10Hz to 25000Hz, The Sennheiser HD 380 Over Ear Headphone is engineered with impedance of 18 ohm that is attributed with decibel sensitivity to deliver impeccable bass quality sound. It also flaunts a 110 dB/mW Headphone Sensitivity at 1 kHz to offer you exceptional clarity of sound with powerful bass features.\r\nDesign\r\n\r\nExtremely light weight at just 454 grams and user friendly dimensions of 17.5 x 9.9 x 22.6 cm make this Sennheiser headphone stand apart from the rest. The outstanding design also extends to their fit that is attributed with 3.5mm angled jack diameter to provide you with effortless ease of usage.\r\nAudio Quality\r\n\r\nThe Sennheiser HD 380 Over Ear Headphone provides an extended frequency response with increased sound pressure level (up to 110 dB) for accurate sound reproduction in demanding applications. The world class brand of Sennheiser guarantees delivery of an impressive audio quality and impeccable sound experience like never before with these headphones.\r\n\r\nComfort of Use--\r\n\r\nThe Sennheiser HD 380 Over Ear Headphone is not only lightweight in nature but also the secure and rugged design strives to offer a very comfortable listening experience for long sessions.', '05/02/2017', '05/03/2017', '9800', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL auto_increment,
  `c_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `address` longtext NOT NULL,
  `payment_status` varchar(10) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  PRIMARY KEY  (`ord_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `c_id`, `amount`, `date`, `time`, `address`, `payment_status`, `order_status`) VALUES
(1, 1, 19397, '06-03-2017', '06:51:45pm', 'Navafaliya Vansda', 'Done', 'Offer Confirmed'),
(2, 1, 0, '10-03-2017', '09:45:08am', 'Navafaliya Vansda', 'Done', 'Confirmed'),
(3, 1, 36998, '13-03-2017', '11:32:14am', 'Navafaliya Vansda', 'COD', 'Placed');

-- --------------------------------------------------------

--
-- Table structure for table `p_list`
--

CREATE TABLE `p_list` (
  `ord_id` int(11) default NULL,
  `of_id` int(11) default NULL,
  `v_id` int(11) default NULL,
  `qty` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_list`
--

INSERT INTO `p_list` (`ord_id`, `of_id`, `v_id`, `qty`) VALUES
(1, 5, NULL, NULL),
(2, NULL, 12, 1),
(3, NULL, 14, 1),
(3, NULL, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `p_id` int(11) default NULL,
  `Ad_id` int(11) default NULL,
  `of_id` int(11) default NULL,
  `photo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`p_id`, `Ad_id`, `of_id`, `photo`) VALUES
(NULL, 13, NULL, '0ss1.jpg'),
(NULL, 13, NULL, '1ss3.jpg'),
(NULL, 13, NULL, '2ss4.jpg'),
(3, NULL, NULL, '0p4.jpg'),
(3, NULL, NULL, '1bag.jpg'),
(3, NULL, NULL, '2f4.jpg'),
(6, NULL, NULL, '0pr16.jpg'),
(6, NULL, NULL, '1pr17.jpg'),
(7, NULL, NULL, '0pr26.jpg'),
(7, NULL, NULL, '1pr27.jpg'),
(8, NULL, NULL, '0pr22.jpg'),
(8, NULL, NULL, '1pr23.jpg'),
(9, NULL, NULL, '0pr21.jpg'),
(9, NULL, NULL, '1pr20.jpg'),
(10, NULL, NULL, '0pr10.jpg'),
(10, NULL, NULL, '1pr11.jpg'),
(12, NULL, NULL, '0pr12.jpg'),
(12, NULL, NULL, '1pr13.jpg'),
(13, NULL, NULL, '0pr14.jpg'),
(13, NULL, NULL, '1pr15.jpg'),
(NULL, 15, NULL, '0277632613_1_1000x700_4-seated-dinning-table-good-condition-surat.jpg'),
(NULL, 15, NULL, '1277632613_2_1000x700_4-seated-dinning-table-good-condition-upload-photos.jpg'),
(NULL, 15, NULL, '2277632613_3_1000x700_4-seated-dinning-table-good-condition-sofa-dining.jpg'),
(NULL, 16, NULL, '0277544623_1_1000x700_95-condison-with-bill-6mnth-warnnty-full-kit-surat.jpg'),
(NULL, 16, NULL, '1277544623_2_1000x700_95-condison-with-bill-6mnth-warnnty-full-kit-upload-photos.jpg'),
(NULL, 16, NULL, '2277544623_3_1000x700_95-condison-with-bill-6mnth-warnnty-full-kit-iphone.jpg'),
(NULL, 16, NULL, '3277544623_4_1000x700_95-condison-with-bill-6mnth-warnnty-full-kit-mobiles.jpg'),
(NULL, 17, NULL, '0277632667_1_1000x700_2009-hero-honda-cbz-73000-kms-surat.jpg'),
(NULL, 17, NULL, '1277632667_2_1000x700_2009-hero-honda-cbz-73000-kms-upload-photos.jpg'),
(NULL, 17, NULL, '2277632667_3_1000x700_2009-hero-honda-cbz-73000-kms-hero-honda.jpg'),
(NULL, 18, NULL, '0277607303_1_1000x700_iphone-5s-with-original-charger-space-gray-no-surat.jpg'),
(NULL, 18, NULL, '1277607303_2_1000x700_iphone-5s-with-original-charger-space-gray-no-upload-photos.jpg'),
(NULL, 18, NULL, '2277607303_3_1000x700_iphone-5s-with-original-charger-space-gray-no-iphone.jpg'),
(NULL, 18, NULL, '3277607303_4_1000x700_iphone-5s-with-original-charger-space-gray-no-mobiles.jpg'),
(NULL, 19, NULL, '0277630223_2_1000x700_maruti-suzuki-swift-dzire-cng-29000-kms-2009-year-upload-photos.jpg'),
(NULL, 19, NULL, '1277630223_3_1000x700_maruti-suzuki-swift-dzire-cng-29000-kms-2009-year-maruti-suzuki.jpg'),
(NULL, 19, NULL, '2277630223_4_1000x700_maruti-suzuki-swift-dzire-cng-29000-kms-2009-year-cars.jpg'),
(NULL, 19, NULL, '3277630223_1_1000x700_maruti-suzuki-swift-dzire-cng-29000-kms-2009-year-surat.jpg'),
(NULL, 20, NULL, '0277631829_1_1000x700_samsung-s3-neo-dual-sim-15gb-ram-16gb-rom-bill-surat.jpg'),
(NULL, 20, NULL, '1277631829_2_1000x700_samsung-s3-neo-dual-sim-15gb-ram-16gb-rom-bill-upload-photos.jpg'),
(NULL, 21, NULL, '0277592629_2_1000x700_sankheda-furniture-one-table-six-chair-size-of-upload-photos.jpg'),
(NULL, 21, NULL, '1277592629_3_1000x700_sankheda-furniture-one-table-six-chair-size-of-sofa-dining.jpg'),
(NULL, 21, NULL, '2277592629_4_1000x700_sankheda-furniture-one-table-six-chair-size-of-furniture.jpg'),
(NULL, 21, NULL, '3277592629_1_1000x700_sankheda-furniture-one-table-six-chair-size-of-surat.jpg'),
(NULL, 22, NULL, '0274283587_1_1000x700_skoda-rapid-diesel-59250-kms-2014-year-surat.jpg'),
(NULL, 22, NULL, '1274283587_2_1000x700_skoda-rapid-diesel-59250-kms-2014-year-upload-photos.jpg'),
(NULL, 22, NULL, '2274283587_3_1000x700_skoda-rapid-diesel-59250-kms-2014-year-skoda.jpg'),
(NULL, 22, NULL, '3274283587_4_1000x700_skoda-rapid-diesel-59250-kms-2014-year-cars.jpg'),
(NULL, 23, NULL, '0277615099_1_1000x700_sony-xperia-surat.jpg'),
(NULL, 23, NULL, '1277615099_2_1000x700_sony-xperia-upload-photos.jpg'),
(NULL, 23, NULL, '2277615099_3_1000x700_sony-xperia-sony.jpg'),
(NULL, 23, NULL, '3277615099_4_1000x700_sony-xperia-mobiles.jpg'),
(NULL, 24, NULL, '0277618209_1_1000x700_2011-honda-dio-21750-kms-surat.jpg'),
(NULL, 24, NULL, '1277618209_2_1000x700_2011-honda-dio-21750-kms-upload-photos.jpg'),
(NULL, 24, NULL, '2277618209_3_1000x700_2011-honda-dio-21750-kms-honda.jpg'),
(NULL, 24, NULL, '3277618209_4_1000x700_2011-honda-dio-21750-kms-bikes.jpg'),
(14, NULL, NULL, '0iphone5ssilver-9dd62.jpg'),
(14, NULL, NULL, '1SDL221198048_5-e0738.jpg'),
(14, NULL, NULL, '2thy1-706fb.jpg'),
(14, NULL, NULL, '3Apple-iPhone-5S-16-GB-SDL221198048-2-356e4.jpg'),
(14, NULL, NULL, '4hy1-34c2a.jpg'),
(15, NULL, NULL, '0Asus-ZenFone-3-Max-ZC520TL-SDL990497203-5-81ec7.jpg'),
(15, NULL, NULL, '1Asus-ZenFone-3-Max-ZC520TL-SDL990497203-6-4af93.jpg'),
(15, NULL, NULL, '2Asus-ZenFone-3-Max-ZC520TL-SDL990497203-1-8132f.jpg'),
(15, NULL, NULL, '3Asus-ZenFone-3-Max-ZC520TL-SDL990497203-2-f910f.jpg'),
(15, NULL, NULL, '4Asus-ZenFone-3-Max-ZC520TL-SDL990497203-3-fd16c.jpg'),
(15, NULL, NULL, '5Asus-ZenFone-3-Max-ZC520TL-SDL990497203-4-4781a.jpg'),
(16, NULL, NULL, '0rsz_soundsport_wireless_003_hr-afb21.jpg'),
(16, NULL, NULL, '1rsz_soundsport_wireless_007_hr-2a589.jpg'),
(16, NULL, NULL, '2rsz_soundsport_wireless_009_hr-151f1.jpg'),
(16, NULL, NULL, '3rsz_soundsport_wireless_011_hr-081c9.jpg'),
(16, NULL, NULL, '4rsz_soundsport_wireless_001_hr-ed69b.jpg'),
(17, NULL, NULL, '0SDL738730553-8ab87.jpg'),
(17, NULL, NULL, '1boAt-BassHeads-200-In-Ear-SDL739240495-2-ab3f8.jpg'),
(17, NULL, NULL, '2boAt-BassHeads-200-In-Ear-SDL739240495-3-dc278.jpg'),
(17, NULL, NULL, '3boAt-BassHeads-200-In-Ear-SDL739240495-4-ba4da.jpg'),
(NULL, NULL, 5, '0Blacksmith-Brown-Plastic-Wall-Clock-SDL351599736-1-98c9f.jpg'),
(NULL, NULL, 5, '1Blacksmith-Brown-Plastic-Wall-Clock-SDL351599736-2-39a5a.jpg'),
(NULL, NULL, 5, '2Blacksmith-Brown-Plastic-Wall-Clock-SDL351599736-3-85e68.jpg'),
(NULL, NULL, 5, '3Blacksmith-Brown-Plastic-Wall-Clock-SDL351599736-4-e5d02.jpg'),
(NULL, NULL, 5, '4Blacksmith-Brown-Plastic-Wall-Clock-SDL351599736-5-10148.jpg'),
(NULL, NULL, 6, '0Puma-Black-Leather-Wallet-SDL136363943-1-70836.jpg'),
(NULL, NULL, 6, '1Puma-Black-Leather-Wallet-SDL136363943-2-16e04.jpg'),
(NULL, NULL, 6, '2sdl583409158_1.jpg'),
(NULL, NULL, 6, '3sdl583409158_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL auto_increment,
  `s_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `warranty` varchar(10) NOT NULL,
  `py_method` varchar(10) NOT NULL,
  `discount` int(11) NOT NULL,
  `desc` longtext NOT NULL,
  `price` varchar(20) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `s_id`, `cate_id`, `p_name`, `brand`, `warranty`, `py_method`, `discount`, `desc`, `price`, `stock`, `status`) VALUES
(3, 1, 114, 'fg Hand Bag', 'Fg', '0', 'both', 0, '0', '890', '100', 'approved'),
(6, 1, 102, 'jeans shirt', 'denim', '0', 'both', 0, 'no', '1200', '23', 'approved'),
(7, 1, 79, 'Denim Jeans', 'Denim', '1 year', 'both', 0, '0', '1500', '150', 'approved'),
(8, 1, 121, 'DL Watch', 'giordano', '1 year', 'both', 0, '0', '222', '150', 'approved'),
(9, 1, 70, 'Puma Casual Shoes', 'PUMA', '1 year', 'both', 0, '0', '1200', '135', 'approved'),
(10, 1, 69, 'OD Sport Shoes', 'Adidas', '1Year', 'both', 0, '0', '1230', '140', 'approved'),
(12, 1, 113, 'GK Flip flop ', 'GK', '1 year', 'both', 0, '0', '220', '36', 'approved'),
(13, 1, 121, 'quartz fL watch', 'quartz', '2 Years', 'both', 0, '0', '1630', '14', 'approved'),
(14, 1, 5, 'iPhone 5S (16GB, Silver)', 'Apple', '1 Year', 'both', 0, '**Overview**\r\n\r\niPhones have always been a statement of style, quality and luxury amongst smartphones. \r\nThe Apple iPhone 5s 16 GB is a step ahead over its predecessors and a unique gadget in itself. \r\nThe iPhone 5s features an iOS 7 operating system and is upgradable to iOS 9.3.2. \r\nIt features an impressive A7 64-bit chip, an M7 Motion co-processor and Apple’s ingenious touch ID fingerprint sensor. \r\nThis is amongst the best mobile phones available in the market today and Snapdeal has a collection of them up for sale.\r\n\r\n\r\n**Network and SIM Support**\r\n\r\nThe iPhone 5s supports various networking options like UMTS, HSPA+, DC-HSDPA, 3G, (850/900/1700/1900/2100 MHz), GSM, EDGE, (850/900/1800/1900 MHz) and WiFi. The diverse options in network add to the convenience factor of this Apple Mobile phone.\r\nThe Apple iPhone 5s 16 GB is highly suitable for people who travel as different countries have different network types.\r\n\r\n**LED-backlite LCD Display**\r\n\r\nThe phone hosts a high-clarity LED-backlit IPS LCD that is simply a delight to use. \r\nIt uses a capacitive multi-touch touchscreen and features 16M colours. The screen size is 10.16 cm and has a resolution of 640x1136 pixels.\r\nFor added protection, the display has an oleophobic coating that prevents finger smudges on the screen.\r\n\r\nDual-core 1.3 GHz Processor and 1 GB ddr3 RAM\r\n\r\nThese touch screen mobiles has a central processing unit is a strong and fast, dual-core 1.3 GHz processor. \r\nThis processor is lightning fast and highly reliable when it comes to multitasking. \r\nThe phone runs on a 1 GB RAM.\r\n\r\niOS 7 Operating System\r\n\r\nThe Apple iPhone 5s 16 GB runs on an iOS 7 operating system and can be upgraded to the iOS 9.3.2. It uses an A7 chipset.\r\n\r\n8 MP Camera\r\n\r\nThe Apple iPhone 5s 16 GB has a high-clarity 8-megapixel primary camera and a 1.2-megapixel secondary camera. This phone is equipped with a dual LED flash (true tone flash) and can record impressive videos. \r\nThe camera features touch focus, auto-focus, geo-tagging, Face/Smile detection and HDR modes.\r\n\r\n16 GB Storage Capacity\r\n\r\nThe phone has an internal storage capacity of 16 GB.  The internal storage capacity is plentiful in terms of storing music, videos and pictures. \r\nAll the extra apps the user needs besides the primary apps can be installed on the phone comfortably.\r\n\r\n1560 mAh Battery\r\n\r\nLike all other iPhones, the Apple iPhone 5s 16 GB also has a non-removable lithium-polymer battery. It has a capacity of 1560 mAh. This battery can provide an impressive standby time of 250 hours and talk-time of up to 10 hours. The specification available makes this a sought-after mobile phone in India.', '18499', '25', 'approved'),
(15, 1, 5, 'Asus ZenFone 3 Max ZC520TL (32GB)', 'Asus ', '1 Year', 'both', 0, ' Forget charging your smartphone again and again with Asus Zenfone 3 Max. With its powerful and long-lasting battery, you can now enjoy more with your device. It is not limited to act as a smartphone but is also a power bank with its creative reverse charging feature. Catch hold of this metallic finish smart phone and turn heads wherever you go with Asus!\r\n\r\nDual SIM\r\n\r\nZenFone 3 Max comes with dual SIM card slots. SIM 1 slot can hold a micro SIM and SIM 2 slot can hold a nano SIM. Both the slots are 4G enabled; thus, you can now use 2 SIM cards simultaneously in one phone without the need to carry 2 phones at a time.\r\n\r\n13.20 cm (5.2) Display\r\n\r\nThe ZC520TL smartphone has a big 13.20 cm (5.2) screen with 75% screen-to-body display. Watch crystal clear picture on its HD (1280 x 720) display with 2.5D contoured glass. It is bigger, better and brighter with Asus!\r\n\r\nOperating System\r\n\r\nStay updated with Asus ZenFone 3 Max as it offers Android™ 6.0 with ASUS ZenUI 3.0. The user interface of this phone is highly attractive and user-friendly. Very convenient to use, this phone is a boon for the games and apps lover.\r\n\r\n1.2 GHz Quad Core 64-Bit Processor and 3 GB RAM\r\n\r\nForget lags and blur! Asus ZenFone 3 Max is equipped with 1.2 GHz Quad Core 64-Bit Processor. Play graphic intensive games and never face any visual lags. Adding more to the bag, the phone has 3 GB RAM that ensures swift motions and transitions.\r\n\r\n13 MP Rear and 5 MP Front Camera with Flash\r\n\r\nTime to click pictures with your one and only Asus ZenFone 3 Max! It has a 13 MP rear and 5 MP front camera that clicks pictures like a pro. Forget bulky camera and capture every moment with your Asus smartphone PixelMaster camera. It has 0 shuuter lag with 5P Largen lens. The PixelMaster 3.0 rear ', '12999', '30', 'waiting'),
(16, 1, 7, 'Bose SoundSport Wireless Headphones Black', 'Bose', '1 Year', 'both', 0, 'Description\r\n\r\nWith no wires in the way, Bose® SoundSport® wireless headphones keep you moving with powerful audio and StayHear®+ tips designed for comfort and stability. \r\nA soft silicone material and unique shape provide a secure fit that stays put and feels good. \r\nConnect to your device easily with Bluetooth® and NFC pairing, and use the inline mic and remote to control volume, skip tracks and take calls. With the Bose Connect app, controlling and switching between multiple devices is easy. \r\nSoundSport wireless are sweat and weather resistant and have a lithium-ion battery that delivers up to 6 hours per charge. \r\nWith performance like this, the only challenge left is your workout. Available in Black or Aqua.\r\n\r\nSoundSport wireless headphones are in-ear headphones that use Bluetooth technology to deliver a high-quality audio experience for your workout. \r\nThe headphones are easy to pair with intuitive controls. And the StayHear®+ tips are comfortable and stable enough to stay in place throughout your toughest workout.', '1375', '40', 'approved'),
(17, 1, 253, 'boAt BassHeads 200 In Ear Wired With Mic Earphones Blue', 'boAt', '1 Year', 'both', 0, ' If you want to enrich and enhance your auditory experience, the boAt BassHeads 200 Polished Metal Earphones are surely something that you want to possess. Music lovers need a good pair of earphones to listen to their favourite songs even on-the-go. The boAt BassHeads 200 Wired Earphones With Mic Blue will meet all your requirements with its amazing features and efficiency. This pair of earphones come with a manufacturer guarantee of 1 year and is one-of-a-kind musical accessory.\r\n\r\nNoise Cancelling\r\n\r\nWith a passive noise cancellation feature, boAt BassHeads 200 Wired Earphones With Mic blue enables you to enjoy listening to your music even in a chaotic and noisy situation. The passive noise isolation feature is a boon for music lovers who want uninterrupted access to their music. This feature also enables you to receive those important calls while on-the-go.\r\nBass and Amplifier\r\n\r\nThe powerful 10 mm drivers provide for sonic clarity while the super extra bass makes the process of listening to music a fulfilling one. The extra bass makes you enjoy your favourite songs with greater clarity and gives an enthralling experience. With a total harmonic distortion of only 0.3 per cent, you are guaranteed a high-quality auditory experience. \r\n\r\nCompatibility\r\n\r\nThe boAt BassHeads 200 Wired Earphones With Mic Blue with both mobiles and laptops and thus enable you to use the earphones with a wide array of devices. These earphones are compatible with all 3.5 mm supported devices.\r\n\r\n Design\r\n\r\nAvailable in attractive colours, the boAt BassHeads 200 Wired Earphones With Mic Blue weighs 50 gm and thus is easily portable. The material used to manufacture these earphones is polished metal that ensures its longevity. The tangle-free cable ensures that you do not face any problems while using these earphones.  These earphones have gold-plated angled 3.5 mm plug that is sure to draw your attention.\r\n\r\nAudio Quality\r\n\r\nThe boAt BassHeads 200 Wired Earphones with Mic Blue boasts of HD quality sound that is sure to make you happy and fulfilled. The super extra bass provides a fulfilling experience and the earphones have a wide frequency range of 20 Hz to 20 KHz that minimises any distortion of sound quality. With a speaker resistance of 16 Ohm and sensitivity range of 98 db +/- 3db, you are definitely in for a fun-filled and memorable experience.\r\nComfort of Use\r\n\r\nThe tangle-free cables, the lightweight, the easy controls to play, pause or change songs and to answer or hang-up calls make these earphones extremely user-friendly. As the earphones are compatible with laptops, mobiles and all 3.5 mm supportive devices, you have a wide range of choices to choose from where to play their music.\r\nMicrophone\r\n\r\nThe noise-cancelling microphone enables trouble free receiving of calls or undeterred sessions of musical extravaganza. The microphone has a separate button to allow you easy functioning. ', '449', '14', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `r_id` int(11) NOT NULL auto_increment,
  `c_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `p_id` varchar(20) NOT NULL,
  `review` longtext NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY  (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`r_id`, `c_id`, `name`, `p_id`, `review`, `email`) VALUES
(1, 1, 'Sarjil Shaikh', 'ad2', 'd', 'sarjil1432@gmail.com'),
(2, 1, 'Sarjil Shaikh', 'ad2', '14000 ma apvano k', 'sarjil1432@gmail.com'),
(3, 0, 'aaasaswdr233', '8', 'sa', 'sarjil1432@gmail.com'),
(4, 1, 'Sarjil Shaikh', 'ad8', 'r', 'sarjil1432@gmail.com'),
(5, 1, 'Sarjil Shaikh', '15', 'Superb Configuration ', 'sarjil1432@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `s_id` int(11) NOT NULL auto_increment,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `photo` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY  (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`s_id`, `f_name`, `l_name`, `email`, `mobile`, `city`, `address`, `photo`, `password`) VALUES
(1, 'Sarjil', 'Shaikh', 'Sarjil1432@gmail.com', '9712169979', 'Vansda', 'Navafaliya Vansda', '', '9712169979');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `st_id` int(11) NOT NULL auto_increment,
  `s_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `city` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `validity` varchar(10) NOT NULL,
  PRIMARY KEY  (`st_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`st_id`, `s_id`, `Name`, `email`, `telephone`, `city`, `date`, `validity`) VALUES
(8, 1, 'Dream Shop', 'smartmobiles@bigshope.com', '9898989898', 'Vansda', '10-03-2018', '365');

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `c_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wish_list`
--

