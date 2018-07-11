-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2014 at 01:48 AM
-- Server version: 5.5.36-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mysunles_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firstName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(30) NOT NULL,
  `workPhone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='The Sjolie App Users' AUTO_INCREMENT=56 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `password`, `dateCreated`, `firstName`, `lastName`, `email`, `company`, `address1`, `address2`, `city`, `state`, `zip`, `workPhone`) VALUES
(1, 'password', '2014-04-13 17:58:38', 'matt', 'newcomb', 'matt.newcomb@gmail.com', '', '', '', '', '', 0, ''),
(5, 'testing', '2014-05-04 23:15:58', 'test', 'tester', 'test@test.com', '', 'test', '', 'port', 'Idaho', 97219, '5419145555'),
(4, 'Mvp23!@#', '2014-05-04 04:36:16', 'matt', 'tet', 'mnewcomb@bobsredmill.com', 'fff', 'asss', '', 'portland', 'Oregon', 97219, '5419147658'),
(6, 'testing', '2014-05-04 23:50:30', 'ios', 'ios', 'ios@ios.com', '', '1234 sw th', '', 'portland', 'oregon', 97219, '5419147658'),
(7, 'password', '2014-05-05 00:00:00', 'ios2', 'ios2', 'ios2@ios.com', '333', '11', '', 'portland', '444', 444, '444'),
(8, 'nnnnn', '2014-05-05 00:05:44', '22', 'ff', 'ff@ff.com', '22', '22', '22', '22', '22', 22, '22'),
(9, 'mmmmm', '2014-05-05 03:10:44', 'mm', 'mm', 'mm@gmail.com', 'mm', 'mm', '', 'mm', 'mm', 0, 'mm'),
(10, '12345', '2014-05-05 03:18:22', 'matt', 'matt', 'mn@mn.com', 'ma', 'ma', 'ma', 'ma', 'ma', 0, 'ma'),
(11, 'OSUdu1834', '2014-05-06 03:25:50', 'Aaron', 'Deen', 'deen@devnd.com', 'origins lc', '524 state', '', 'Salem', 'OR', 97301, '9717772905'),
(12, 'kyle88', '2014-05-09 07:08:49', 'Stephanni', 'Jones', 'stephannijones@sbcglobal.net', 'Effortless Image', '5010 no name Ln', '', 'Loomis', 'ca', 95650, '916-803-1078'),
(13, 'Vangilder1', '2014-05-09 18:46:10', 'katie', 'chunn', 'katievg76@gmail.com', 'sacramento mobile tan', '8010 orange ave', '', 'fair oaks', 'ca', 95628, '9162169537'),
(14, 'flamingo', '2014-05-09 22:14:48', 'Mallory ', 'Megown ', 'appointments@embargotanningcom', 'Embargo Tanning Company ', '1717 Market St', '402', 'Tacoma', 'WA', 98402, '253-341-9930'),
(15, 'Mustang22', '2014-05-09 23:57:49', 'Genna ', 'Zehnder', 'gzehnder22@yahoo.com', 'sun kissed sunless tans by Gen', '5624 cypress point dr', '', 'Citrus Heights ', 'ca', 95610, '916 7091912'),
(16, 'marmaladeskyxxx', '2014-05-10 02:31:28', 'Alana', 'loach', 'alanakloach@hotmail.co.uk', 'Ray heights.', 'Indonesia, bali, seminyak, the', '', 'seminyak', 'Indonesia ', 80571, '9786645875456'),
(17, 'milichko', '2014-05-10 07:31:17', 'Iveta', 'Manolova', 'iveta.manolova@abv.bg', 'revolution', 'klokotnitza 3', 'klokotniza 3 bl.3', 'Varna', 'Bulgaria', 9000, '359883455616'),
(18, 'equity', '2014-05-10 16:26:07', 'Sandra', 'Morgan', 'sandrapmorgan@hotmail.com', 'bronzed beauty ', '10437 w Fullerton ave', '', 'melrose park', 'il', 60164, '846-293-1619'),
(19, 'cobra10', '2014-05-12 04:21:11', 'Sheree ', 'Tadlock', 'Paige.tadlock@yahoo.com', '', '1008', 'tannihill street', 'Wesson', 'Mississippi ', 39181, '7692329925'),
(20, 'italia', '2014-05-12 15:52:58', 'shelby', 'van', 'shelby321@gmail.com', '9164820961', '3321 cool dr', '', 'edh ', 'ca', 95762, '9164829175'),
(21, '081996k', '2014-05-12 19:18:58', 'krystal', 'avendano', 'krystalavendano96@hotmail.com', '', '3480 torremolinos ave', '', 'Doral', 'FL', 33178, '7864244446'),
(22, 'RDTis3', '2014-05-12 20:46:19', 'Allison', 'Taylor', 'ortanicairbrushing@yahoo.com', 'Ortanic Airbrushing ', '707 Cypresswood Lake Ct.', '', 'Spring ', 'Tx ', 77373, '8329678184'),
(23, 'jordanblair', '2014-05-13 01:58:46', 'jor', 'pear', 'jordanpearson98@gmail.com', 'idk', '558 n Plaquemine ', '', 'shrevport', 'la', 711106, '65859455'),
(24, 'pollo ', '2014-05-13 02:31:30', 'abc', 'defy', 'mmm@yahoo.com', 'you', '1 mmjfbi lane ', '', 'Myrtle ', 'uhhh', 90, '9998887687'),
(25, 'Yankees27', '2014-05-13 02:32:24', 'christina', 'good', 'cmghhi88@yahoo.com', 'you', '4 lane ', '', 'Myrtle beach', 'sc', 90310, '8459998787'),
(26, 'hawaii12', '2014-05-13 02:32:38', 'Bree', 'Duran', 'breannaduran@comcast.net', 'sunless secret', '404 Cantor', '', 'irvine', 'ca', 92620, '9498708884'),
(27, 'luiza12', '2014-05-13 05:10:41', 'Kate', 'lol', 'lol@aol.com', '5678787878', 'hill drive 67', '', 'Brooklyn ', 'ny ', 11235, '7890987879'),
(28, 'gotham1106', '2014-05-13 13:04:38', 'Michelle', 'Mclaren ', 'xoxmichellemaexox@hotmail.com', 'Skin Is In Skincare applicatio', '14936 Sunbury St', '', 'Livonia ', 'MI', 48154, '3133994408'),
(29, 'home1414', '2014-05-13 14:42:32', 'Sydney', 'Carey', 's.carey09@yahoo.com', 'radiance spray tans', '140 w San Jose ave apt 116', '', 'fresno', 'ca', 93704, '5595735454'),
(30, 'Bestill4610', '2014-05-13 17:46:38', 'Ashley', 'McElroy', 'ashleymcelroy@gmail.com', 'go and glow mobile tanning', '1714 west  Ave. H', '', 'Muleshoe', 'tx', 79347, '806-315-0005'),
(31, 'Bestill4610', '2014-05-13 17:49:25', 'Ashley', 'McElroy ', 'ashleytia@hotmail.com', 'go and glow', '1714 west ave h ', '', 'Muleshoe ', 'tx', 79347, '806-315-0005'),
(32, 'Selfmade', '2014-05-14 04:28:15', 'Maxine', 'Dunn', 'maximumbronze@gmail.com', 'Maximum Bronze', '30083 Westlake Dr', '', 'Menifee', 'CA', 92584, '9512078013'),
(33, 'usgshec1', '2014-05-14 13:29:24', 'Kelly ', 'Gonda ', 'kellymariegonda@yahoo.com', 'TANdemonium', '8618 Locust Ct', '', 'Louisville ', 'KY', 40242, '5029095010'),
(34, 'acidrain', '2014-05-14 18:28:57', 'Regina', 'Thomas', 'punklove777@aol.com', 'grinnys', '630 Lemon Street', '', 'Stowe', 'pa', 19464, '6104159226'),
(35, 'scubasteve', '2014-05-15 08:56:47', 'Sheri', 'Way', 'sunkissedbysheri@outlook.com', 'Sunkissed by Sheri', '59 Southcott Drive', '', 'Grand Falls - Windsor', 'Alabama', 1234, '7094861945'),
(36, 'ptarmign11', '2014-05-15 18:11:00', 'Gini', 'Pritchett', 'gini@contourtan.com', 'Contour Tan', '6125 Walla ave', '', 'Fort Worth', 'Texas', 76133, '8178076585'),
(37, 'kendalbabieloly', '2014-05-15 20:59:12', 'Kendal', 'Riley', 'kendalroseriley@outlook.com', '', '4 semmewater grove ', 'redcar', 'redcar', 'Cleveland', 0, '07850497338'),
(38, 'husky98', '2014-05-16 00:20:39', 'Alex', 'pa', 'alparedes98@gmail.com', 't mobile ', '56', '9th avenue', 'New York ', 'New York', 97652, '7320483726'),
(39, 'spencer2', '2014-05-16 02:36:08', 'Nikki', 'Paige', 'nikkipaige1973@yahoo.com', '', '', '', '', '', 0, ''),
(40, 'wallstreet23', '2014-05-16 15:32:01', 'Morenza', 'Benito', 'hotchocolateandmint@gmail.com', 'RSPI', 'Jakarta', '', 'Jakarta', 'Jakarta raya', 12310, '+6281317178923'),
(41, 'bayli01', '2014-05-16 16:16:10', 'Elizabeth', 'McDonald', 'elizabetha1426@yahoo.com', 'Tanquility', '10112 Baronne Circle', '', 'Dallas', 'Tx', 75218, '214-431-6625'),
(42, 'mere3181', '2014-05-17 18:30:37', 'Megan', 'REDER', 'meganreder@gmail.com', 'nothing', '701333 oak-manor drive', '', 'Lakewood', 'pa', 15044, '7245854545'),
(43, 'scubasteve', '2014-05-18 23:15:51', 'Sheri', 'Wsy', 'amplifiedimagesbodypiercing@ho', '', '59 Southcott Drive', '', 'Grand Falls-Windsor', 'Alabama', 12345, '7094861945'),
(44, 'scubasteve', '2014-05-18 23:52:03', 'Sheri', 'Way', 'sunkissedbysheri@google.com', '', '59 Southcott Drive', '', 'Grand Falls', 'Alabama', 12345, '7094861945'),
(45, 'oct221985', '2014-05-19 22:12:06', 'amber', 'wells', '1mommie092208@gmail.com', '', '681s. pk', '', 'Portland', 'Indiana', 47371, '2602516994'),
(46, 'rayaraya', '2014-05-19 23:29:17', 'raya', 'mirzapour', 'raya16emo@yahoo.com', '', 'Babol-shariati-shahed 8', 'qom-azadegan-alavi 11', 'Babol', 'mazandaran', 111, '+982536553650'),
(47, 'Skeeter23', '2014-05-19 23:55:18', 'Stephanie ', 'Novins ', 'Stephanie.novins@yahoo.com', 'Coco Bay Spray Tans ', '123 sprague loop ', '', 'Staten Island ', 'my ', 10312, '3477401958'),
(48, 'dixie', '2014-05-20 04:31:38', 'soph', 'buff', 'chachifanpage23@gmail.com', 'idk', 'jkkb', '', 'nkll', 'tn', 0, '3333333333'),
(49, 'Bestill4610', '2014-05-20 15:18:51', 'Ashley ', 'mcelroy ', 'ashleymcelroy2481@gmail.com', 'go and glow ', '1714 west ave h ', '', 'Muleshoe ', 'tx', 79347, '8063150005'),
(50, 'US3inlove', '2014-05-20 16:28:10', 'Jackie', 'Lopez ', 'loveyourspraytan@gmail.com', 'love your spray tan ', '15969 nw 64th ave ', 'apt# 207', 'Miami', 'FL', 33014, '7863956246'),
(51, 'daylin1212', '2014-05-20 18:53:07', 'Dayna', 'Ostler', 'epiquesoleiltanne@gmail.com', 'EpiquÃ© Soleil TannÃ© ', '809 Janet Dale Ln', '', 'Severn', 'MD', 21144, '4105338784'),
(52, 'Monroe', '2014-05-20 21:55:50', 'Alex', 'vickowskk', 'avickowski@yahoo.com', '2034525525', '4 wood acres lane', '', 'Monroe', 'ct ', 6468, '2034525525'),
(53, 'sssss', '2014-05-20 23:21:00', 'Jenna', 'paige', 'ljeffress@gmail.com', '', '3728 Abby drive ', '', 'MO', 'MO', 47630, '7123457789'),
(54, 'isis58', '2014-05-21 00:24:58', 'Elizabeth', 'rhoton', 'speedyracer17@gmail.com', '', '202 Pennsylvania Annex', '', 'Lebanon', 'Tennessee', 37087, '1-615-945-7063'),
(55, 'avasrose', '2014-05-21 01:57:29', 'Kimber ', 'Mcentee', 'kimberlynne@comcast.net', 'avasrose', '3865 Vincent drive', '', 'collegeville', 'pa', 19426, '4849254954');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
