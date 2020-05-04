
--
-- Database: `api_login_ig`
--

-- --------------------------------------------------------

--
-- Table structure for table `username`
--

DROP TABLE IF EXISTS `username`;
CREATE TABLE IF NOT EXISTS `username` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `cookie` text DEFAULT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;
