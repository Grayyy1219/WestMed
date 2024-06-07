-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 11:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mfinals2`
--
CREATE DATABASE IF NOT EXISTS `mfinals2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mfinals2`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `ItemID`, `product_name`, `quantity`, `timestamp`) VALUES
(102, 48, 7, '', 19, '2024-05-26 02:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `ItemCategory` varchar(200) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `ItemCategory`, `img`) VALUES
(4, 'Beauty and Personal Care', 'upload/items/baby-wipes.jpg'),
(3, 'Home Remedies', 'upload/items/de-macho.jpg'),
(8, 'Medicene', ''),
(1, 'Prescription Medicines', 'upload/items/amlodipine.jpg'),
(2, 'Vitamins and Supplements', 'upload/items/maxicap-multivitamins-lysine-supplement-capsule-10s.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `currentuser`
--

CREATE TABLE `currentuser` (
  `UserId` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currentuser`
--

INSERT INTO `currentuser` (`UserId`, `FName`, `LName`, `username`, `email`, `address`, `phone`, `profile`) VALUES
(1, 'Lance Grayson Musngi', '', 'Emz', 'lance.musngi@gmail.com', '400 sampaguita st.', '09222537473', 'upload/users/ttn-image-2023-09-30-191330979.png');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(200) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `ItemImage` varchar(200) NOT NULL,
  `Price` decimal(11,2) NOT NULL,
  `Solds` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `ItemName`, `description`, `Category`, `ItemImage`, `Price`, `Solds`, `Quantity`) VALUES
(1, 'FISTERIDE Finasteride 5mg Film-coated Tablet', 'Finasteride is used to treat men with an enlarged prostate benign prostate enlargement. It can help ease your symptoms if: it\'s difficult to start peeing. you need to pee urgently or frequently more often.', 'Prescription Medicines', 'upload/items/fisteride-finasteride-5mg-film-coated-tablet.jpg', 25.00, 11, 67),
(2, 'CARDIOVASC Amlodipine 5mg Tablet', 'amlodipine for high blood pressure use this medicine even if you start feeling better. ', 'Prescription Medicines', 'upload/items/amlodipine.jpg', 4.00, 9, 20),
(3, 'CLOPIDOGREL BISULFATE 75mg Tablet', 'It prevents platelets a type of blood cell from sticking together and forming a dangerous blood clot. Taking clopidogrel helps prevent blood clots if you have an increased risk of having them. Your risk is higher if you have or have had a heart attack.', 'Prescription Medicines', 'upload/items/bisulfate.jpg', 10.00, 2, 10),
(4, 'DIAMET Metformin HCI 500mg Tablet', 'It is used in the treatment of type 2 diabetes mellitus.', 'Prescription Medicines', 'upload/items/diamet-metformin-hci-500mg-tablet.jpg', 1.00, 3, 8),
(5, 'HYPERTAN Losartan 50mg Tablet', '', 'Prescription Medicines', 'upload/items/hypertan-losartan-50mg-tablet.jpg', 4.00, 2, 111),
(6, 'HYPERTAN Losartan 100mg Tablet', 'Losartan is contra-indicated in pregnancy and breast feeding. It should be used with caution in patients with renal artery stenosis. ', 'Prescription Medicines', 'upload/items/hypertan-losartan-100mg-tablet.jpg', 8.00, 0, 300),
(7, 'MAXICAP Multivitamins Lysine Supplement Capsule 10s', 'Lysine has been used as a form of alternative medicine to treat cold sores that are brought about by herpes simplex.', 'Vitamins and Supplements', 'upload/items/maxicap-multivitamins-lysine-supplement-capsule-10s.jpg', 50.00, 18, 407),
(8, 'FERRO B Ferrous Fumarate Vitamin B Complex Capsule 10s', 'Ferro B Ferrous Fumarate Vitamin B Complex 500mg 230mcg 2mg 3mcg Capsule 10 Pcs Per Pack For Energy Brain Function And Cell Metabolism FERRO B capsule is recommended to be taken once daily or as directed by your physician. It is best to be taken in the morning 1 hour before meals or 2 hours after meals.', 'Vitamins and Supplements', 'upload/items/ferro-b-ferrous-fumarate-vitamin-b-complex-capsule-10s.jpg', 40.00, 4, 14),
(9, 'VIT EYE Lutein Softgel Capsule 10s', 'VIT EYE TGP Lutein 4.0mg Capsule 10 pcs per pack Softgel for eye health VIT EYE capsules are available in softgel capsule form. They should be taken at mealtime because lutein is absorbed better when ingested with a small amount of fat such as olive oil.', 'Vitamins and Supplements', 'upload/items/vit-eye-lutein-softgel-capsule-10s.jpg', 115.00, 7, 12),
(10, 'O3MEGA Fish Oil EPA DHA Vitamin E 60mg Capsule 10s', 'Omega Fish Oil 60mg Softgel Capsule 10 Pcs Per Pack For Brain Health Eye Development Heart Disease Prevention O3MEGA capsules are availabl in soft gel capsule form. It is recommended to be consumed with a meal preferably at dinner time for best absorption and should be taken once daily or as directed by your physician.', 'Vitamins and Supplements', 'upload/items/o3mega-fish-oil-epa-dha-vitamin-e-60mg-capsule-10s.jpg', 85.00, 9, 12),
(11, 'NATURE E Vitamin E 400iu Softgel Capsule 100s', 'Vitamin E is an antioxidant found in many foods such as nuts seeds and many types of leafy green vegetables. Vitamin E is essential in fighting free radicals which are molecules produced when our body breaks down food or is exposed to tobacco smoke and radiation from the sun X-rays or other sources. ', 'Vitamins and Supplements', 'upload/items/nature-e-vitamin-e-400iu-softgel-capsule-100s.jpg', 900.00, 8, 321),
(12, 'MORINGA 500 Malunggay 500mg Capsule 10s', 'The moringa capsules can be used to treat the following Food supplement for breastfeeding mothers Enhances milk letdown lactation and increases milk production and volume Asthma Diabetes Malnutrition Symptoms of menopause Anemia', 'Vitamins and Supplements', 'upload/items/moringa-500-malunggay-500mg-capsule-10s.jpg', 47.00, 7, 121),
(13, 'Kids Care Essentials', 'Christmas Gift Pack Kids Kit Essentials  a bundle of joy and practicality wrapped up with love this holiday season.', 'Beauty and Personal Care', 'upload/items/care-essentials.jpg', 183.00, 20, 247),
(14, 'CEBO DE MACHO 10g Scented', 'Helps to lighten new scars and helps moisturize skin. ', 'Beauty and Personal Care', 'upload/items/cebo-de-macho-10g-scented.jpg', 23.00, 5, 27),
(15, 'TGP Cebo de Macho 7g Ointment', 'Used to prevent scars from forming from light wounds. It helps lighten the appearance of scars.', 'Home Remedies', 'upload/items/de-macho.jpg', 22.00, 7, 32),
(16, 'Efficascent Oil 100ml', 'Efficascent Oil relieves back pain muscular pains joint pains stiff neck headache cramps and even mild sprains and strains', 'Home Remedies', 'upload/items/efficascent-oil-100ml.jpg', 115.00, 5, 121),
(26, 'BEYONDCARE Toothbrush Charcoal Deep Clean 1s', 'Infused with activated charcoal to help whiten teeth by removing surface stains improve bad breath kill bacteria in gums and help remove plaque. ', 'Beauty and Personal Care', 'upload/items/toothbrush-charcoa.jpg', 65.00, 9, 11),
(27, 'POLIDENT Denture Adhesive Cream 40g', 'Designed to help maintain denture performance for everyday life.  ', 'Beauty and Personal Care', 'upload/items/polident-denture-adhesive-cream-40g.jpg', 249.00, 0, 10),
(28, 'POLIDENT Denture Adhesive 3D Hold Flavor Free Cream 20g', 'formulated to give you 3D hold and has no added flavours so that it wont get in the way of you enjoying your foods. ', 'Beauty and Personal Care', 'upload/items/polident-denture-adhesive-3d-hold-flavor-free-cream-20g.jpg', 137.00, 0, 30),
(29, 'BEYONDCARE Toothbrush Kids 3 and 5yo 1s', 'Gentle Brushing for Kids.  Kiddie 3 and 5 toothbrushes are made of 0.01mm PBT Bristles. These type of bristles are considered as the modern movers of toothbrush bristles and is increasingly endorsed by dental professionals.', 'Beauty and Personal Care', 'upload/items/beyondcare-toothbrush-kids-3-5yo-1s.jpg', 39.00, 0, 50),
(30, 'BEYONDCARE Toothbrush Kids 6 and 12yo 1s', 'Durability Beyondacre Kiddie 6 and 12 are proven and tested to be durable and to last at least three or more months.  ', 'Beauty and Personal Care', 'upload/items/beyondcare-toothbrush-kids-6-12yo-1s.jpg', 49.00, 0, 40),
(31, 'BEYONDCARE Toothbrush Soft Classic 1s', 'Ideal for sensitive teeth and gums Beyondcare Soft Classic Toothbrush has multi level bristles that effectively sweeps away plaque and residue reaching all areas of the mouth.', 'Beauty and Personal Care', 'upload/items/beyondcare-toothbrush-soft-classic-1s.jpg', 19.00, 0, 12),
(32, 'BEYONDCARE Toothbrush UltraSoft Pr1s', 'With 10000 ultra-soft bristles to effectively clean the teeth without damaging the enamel. The ultrasoft premium toothbrush is made from premium PBT bristles making them more durable and less water absorbent', 'Beauty and Personal Care', 'upload/items/beyondcare-toothbrush-ultrasoft-pr1s.jpg', 59.00, 0, 6),
(33, 'BEYONDCARE Baby Wipes Assorted 30s by 3s', 'Moisturising Safe and gentle on baby skin ', 'Beauty and Personal Care', 'upload/items/baby-wipes.jpg', 142.00, 7, 15),
(34, 'Efficascent Relaxing 6ml Oil', ' It helps relieve headache travel and motion sickness stomach and abdominal pain dizziness stiff neck, stuffy nose, itchiness, and insect bites.', 'Home Remedies', 'upload/items/efficascent-relaxing-6ml-oil.jpg', 79.00, 4, 56),
(35, 'Efficascent Oil Extreme 25ml', 'Specially formulated for fast and effective relief of rheumatism joint pains lumbago cramps and other common body and muscular pains.', 'Home Remedies', 'upload/items/efficascent-oil-extreme-25ml.jpg', 39.00, 4, 21),
(36, 'Omega Pain Killer 60ml Liniment', 'Omega Pain Killer Liniment is proven effective against headaches and other forms of neuralgia.', 'Home Remedies', 'upload/items/omega-pain-killer-60ml-liniment.jpg', 63.00, 0, 45),
(37, 'TGP Eucalyptus Oil 7.5ml Solution', ' Used to silence a cough and as an inhaler for immediate relief of coughs Used to clear your nose to breathe properly Can be used as an insect repellant Can be used to disinfect wounds Can be used to soothe cold sores Can be used to freshen breath', 'Home Remedies', 'upload/items/tgp-eucalyptus-oil-75ml-solution.jpg', 46.00, 0, 24),
(38, 'TGP Pure Petroleum Jelly 20g', 'Moisturizes dry skin overnight. Soothes chapped skin and lips. Removes eye make-up.', 'Home Remedies', 'upload/items/tgp-pure-petroleum-jelly-20g.jpg', 34.00, 0, 56),
(39, 'TGP Salicylic Acid  Solution 60ml', 'Salicylic acid is a topical medication used to treat common skin disorders and foot plantar warts.', 'Home Remedies', 'upload/items/tgp-salicylic-acid-5-solution-60ml.jpg', 36.00, 0, 12),
(40, 'salbutamol sulfate 25mg 25ml solution nebule', 'salbutamol nebulizer solution contains salbutamol sulfate which is a medication used to treat symptoms of chronic obstructive pulmonary disease and asthma.', 'Prescription Medicines', 'upload/items/salbutamol.jpg', 10.00, 0, 67),
(41, 'cardiotaz trimetazidine 35mg tablet', 'Trimetazidine is a metabolic agent a specific and selective inhibitor of enzymes of the fatty acids. ', 'Prescription Medicines', 'upload/items/trimetazidine.jpg', 10.00, 2, 76),
(42, 'irbesartan 150mg film coated tablet', 'rbesartan belongs to a group of medicines known as angiotensin II receptor antagonists. Angiotensin II is a substance produced in the body which binds to receptors in blood vessels causing them to tighten.    ', 'Prescription Medicines', 'upload/items/irbesartan-150mg-film-coated-tablet.jpg', 11.00, 0, 89),
(43, 'cefuroxime axetil 500mg tablet', 'Cefuroxime is used to treat bacterial infections in many different parts of the body. It belongs to the class of medicines known as cephalosporin antibiotics.', 'Prescription Medicines', 'upload/items/xyfrox-cefuroxime-axetil-500mg-tablet.jpg', 35.00, 1, 89),
(47, 'sunflower oil', 'White Flower Oil is a combination of essential oils derived from lavender, eucalyptus, and peppermint, popularly used in the Far East as a natural herbal pain reliever.', 'Medicene', 'upload/items/white-flower-oil-5ml.jpg', 120.00, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `order_date`, `order_quantity`, `total_amount`, `status`) VALUES
(47, 47, '13', '2024-05-23 18:30:40', 1, 183.00, 0),
(48, 48, '16', '2024-05-19 00:40:38', 1, 115.00, 0),
(49, 48, '34', '2024-05-24 00:40:57', 3, 237.00, 0),
(50, 48, '12', '2024-05-24 00:41:08', 2, 94.00, 0),
(51, 47, '45', '2024-05-24 00:48:36', 1, 1111.00, 0),
(52, 1, '35', '2024-05-24 00:54:57', 1, 39.00, 0),
(53, 1, '', '2024-05-24 00:55:00', 0, 0.00, 0),
(54, 1, '7', '2024-05-24 02:48:17', 1, 50.00, 0),
(55, 1, '', '2024-05-24 02:48:23', 0, 0.00, 0),
(56, 49, '33,16', '2024-05-24 05:14:54', 3, 541.00, 0),
(57, 49, '33', '2024-05-24 05:16:46', 1, 142.00, 0),
(58, 49, '', '2024-05-24 05:16:51', 0, 0.00, 0),
(59, 49, '', '2024-05-24 05:16:51', 0, 0.00, 0),
(60, 48, '7,33', '2024-05-24 06:20:23', 7, 492.00, 0),
(61, 1, '34', '2024-05-25 04:43:48', 1, 79.00, 0),
(62, 48, '35', '2024-05-25 04:44:55', 1, 39.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `ItemID` int(11) NOT NULL,
  `Itemname` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`ItemID`, `Itemname`, `value`) VALUES
(1, 'Logo', 'upload/page/logo.png'),
(2, 'Company Name', 'WestMed'),
(4, 'Background Color', '#f2f2f2'),
(5, 'Text Color', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_mode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `customer_id`, `payment_date`, `amount_paid`, `payment_mode`) VALUES
(435417, 48, 48, '2024-05-24 00:40:38', 115.00, 'Cash on Delivery'),
(435418, 49, 48, '2024-05-24 00:40:57', 237.00, 'Cash on Delivery'),
(435419, 50, 48, '2024-05-24 00:41:08', 94.00, 'Credit Card'),
(435421, 52, 1, '2024-05-24 00:54:57', 39.00, 'ako'),
(435422, 53, 1, '2024-05-24 00:55:00', 0.00, 'ako'),
(435423, 54, 1, '2024-05-24 02:48:17', 50.00, 'Gcash'),
(435424, 55, 1, '2024-05-24 02:48:23', 0.00, 'Gcash'),
(435425, 56, 49, '2024-05-24 05:14:54', 541.00, 'Gcash'),
(435426, 57, 49, '2024-05-24 05:16:46', 142.00, 'COD'),
(435427, 58, 49, '2024-05-24 05:16:51', 0.00, 'COD'),
(435428, 59, 49, '2024-05-24 05:16:51', 0.00, 'COD'),
(435429, 60, 48, '2024-05-24 06:20:23', 492.00, 'Cash on Delivery'),
(435430, 61, 1, '2024-05-25 04:43:48', 79.00, 'Mama ko'),
(435431, 62, 48, '2024-05-25 04:44:55', 39.00, 'Mama ko');

-- --------------------------------------------------------

--
-- Table structure for table `paymethod`
--

CREATE TABLE `paymethod` (
  `method_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymethod`
--

INSERT INTO `paymethod` (`method_name`) VALUES
('Cash on Delivery'),
('COD'),
('Credit Card'),
('Debit Card'),
('Gcash'),
('Mama ko');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `SlideID` int(11) NOT NULL,
  `imagename` varchar(50) NOT NULL,
  `imagelocation` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`SlideID`, `imagename`, `imagelocation`) VALUES
(1, 'slide1', 'upload/slideshow/S1.jpg'),
(2, 'slide2', 'upload/slideshow/S2.jpg'),
(3, 'slide3', 'upload/slideshow/S3.jpg'),
(4, 'slide4', 'upload/slideshow/8.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `block` int(11) NOT NULL,
  `admin` int(1) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `verification` varchar(10) NOT NULL,
  `verification_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FName`, `LName`, `username`, `password`, `email`, `phone`, `address`, `block`, `admin`, `profile`, `verification`, `verification_code`) VALUES
(1, 'WestMed', '', 'admin', 'admin', 'westmed.shopnoreply@gmail.com', '', '', 0, 1, 'upload/users/logo.png', '1', ''),
(48, 'Lance Grayson Musngi', '', 'Emz', '$2y$10$EK7M2dFaWlDEjqK1wCv3E.ZRuKHh4hK3MFa//VaksgBx/dJzmDKpW', 'lance.musngi@gmail.com', '09222537473', '400 sampaguita st.', 0, 0, 'upload/users/ttn-image-2023-09-30-191330979.png', '1', '87604'),
(49, 'mae reyes', '', 'maemae', '$2y$10$6nwWxmdl5JUiieWfnTXNmeYzkAOK4DAZSJyJ3NrKCMS5VLJCKtkR6', 'reyesleoneilmae@gmail.com', '', '', 1, 0, 'upload/users/ttn-image-2023-09-30-191330979.png', '1', '73498');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`ItemID`),
  ADD KEY `cart_ibfk_1` (`customer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ItemCategory`),
  ADD UNIQUE KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `currentuser`
--
ALTER TABLE `currentuser`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `paymethod`
--
ALTER TABLE `paymethod`
  ADD PRIMARY KEY (`method_name`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`SlideID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `currentuser`
--
ALTER TABLE `currentuser`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435432;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `SlideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
