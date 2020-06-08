-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2019 at 07:56 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev-templete-local`
--

-- --------------------------------------------------------

--
-- Table structure for table `temp_ci_session`
--

CREATE TABLE `temp_ci_session` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_ci_session`
--

INSERT INTO `temp_ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('8e4c7a7ccacd1f3e7174bac0e8d675fa31bbbd9c', '127.0.0.1', 1571118951, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537313131383636383b5549447c733a313a2231223b5550447c733a393a226d706c757340313233223b554e414d457c733a31313a2253757065722041646d696e223b554d41494c7c733a32353a226d706c7573736f6674657374696e6740676d61696c2e636f6d223b55545950457c733a31303a22737570657241646d696e223b),
('a3fae60eb21b162a98e3718191fcb1aa5572d18f', '127.0.0.1', 1571118668, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537313131383636383b5549447c733a313a2231223b5550447c733a393a226d706c757340313233223b554e414d457c733a31313a2253757065722041646d696e223b554d41494c7c733a32353a226d706c7573736f6674657374696e6740676d61696c2e636f6d223b55545950457c733a31303a22737570657241646d696e223b),
('bb7dc5ba7a0a855cbc33503ce1a95503974e4a4d', '127.0.0.1', 1571118334, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537313131383333343b5549447c733a313a2231223b5550447c733a393a226d706c757340313233223b554e414d457c733a31313a2253757065722041646d696e223b554d41494c7c733a32353a226d706c7573736f6674657374696e6740676d61696c2e636f6d223b55545950457c733a31303a22737570657241646d696e223b);

-- --------------------------------------------------------

--
-- Table structure for table `temp_static_cms`
--

CREATE TABLE `temp_static_cms` (
  `cms_pkey` int(20) NOT NULL,
  `cms_unique_key_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cms unique key name',
  `cms_title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cms_text` text CHARACTER SET latin1 NOT NULL,
  `cms_meta_title` varchar(150) CHARACTER SET latin1 NOT NULL,
  `cms_meta_desc` text CHARACTER SET latin1 NOT NULL,
  `cms_meta_keyword` varchar(250) CHARACTER SET latin1 NOT NULL,
  `cms_crtDate` datetime NOT NULL,
  `cms_upDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `cms_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `temp_static_cms`
--

INSERT INTO `temp_static_cms` (`cms_pkey`, `cms_unique_key_name`, `cms_title`, `cms_text`, `cms_meta_title`, `cms_meta_desc`, `cms_meta_keyword`, `cms_crtDate`, `cms_upDate`, `cms_status`) VALUES
(1, 'about-us', 'About Us', '<p><strong><img alt=\"\" src=\"http://uni-access.m-staging.in/AdminMedia/editor/upload_images/consulting.jpg\" style=\"width: 550px; height: 370px;\" />Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'about title', 'about desc', 'about key', '2017-08-29 19:06:33', '2018-12-29 10:41:56', 1),
(2, 'contact-us', 'Contact Us', '<p><img alt=\"\" src=\"http://localhost/sachin/dev-templete/AdminMedia/editor/upload_images/Cycling-Adventure.jpg\" style=\"width: 1860px; height: 1140px;\" />contactdfrtgdfgdgd</p>', 'contact title', 'contact desc', 'contact key', '2017-10-30 19:21:53', '2018-12-29 07:25:45', 1),
(3, 'privacy-policy', 'Privacy Policy', '<p>privicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicyprivicy privicy</p>', 'privicy title', 'privicy desc', 'privicy key', '2017-10-31 12:48:22', '2019-01-15 10:24:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_static_email_format`
--

CREATE TABLE `temp_static_email_format` (
  `email_id` int(11) NOT NULL,
  `email_title` varchar(50) DEFAULT NULL,
  `email_subject` varchar(150) DEFAULT NULL,
  `email_content` text DEFAULT NULL,
  `email_added_date` datetime DEFAULT current_timestamp(),
  `email_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_static_email_format`
--

INSERT INTO `temp_static_email_format` (`email_id`, `email_title`, `email_subject`, `email_content`, `email_added_date`, `email_updated_date`) VALUES
(1, 'registration', ' Registration', '<html><body>                <div style=\"padding: 15px; border: 2px solid #813979;width: 100%;max-width: 600px;height:auto;margin: 0px auto;box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.61);\">                <div style = \"border-bottom: 1px dashed #323232;height: 47px;margin: -10px;\">                <h1 style = \"color:rgb(113, 112, 112);font-size:26px;float:left;margin: 0px;padding-top: 4px;\">||SITE_TITLE||</h1>                </div><div style = \"clear:both\"></div>                <h1 style = \"font-size: 14px;margin-top: 23px;color:#222\">Hello ||USER_NAME|| !!<span> </span></h1>                <p style = \"font-size: 14px;margin-top: 30px;margin-bottom:15px;color:#222\"> Your registration with ||SITE_TITLE|| is done successfully. Login details are as below,</p>                <p style = \"margin-bottom: 5px;font-size: 13px;margin-top:5px;color:#222\"><b>Email:</b> ||EMAIL_ID||</p>                <p style = \"margin-bottom: 5px;font-size: 13px;margin-top:5px;color:#222\"><b>Password:</b> ||PASSWORD||</p>                <h1 style = \"font-weight: 600;font-size: 14px;margin:0px;width:100%;margin-bottom: 5px;color:#222\">Thank You, </h1>                <p style = \"font-size: 13px;margin:0px;color:#222\">||SITE_TITLE||</p>                <div style = \"clear:both\"></div>                <div style = \"height: 40px;background-color: #F5F5F5;text-align: center;margin: -15px;margin-top: 15px;padding:10px;\">                <h1 style = \"font-size: 15px;margin-bottom: 6px;margin-top: 0px;color:#878787;\">||SITE_TITLE||</h1>                <p style = \"margin: 0px;font-size: 12px;color:#878787\"> © ||YEAR|| All Rights Reserved. </p>                </div>                <div style = \"clear:both\"></div>                <h1 style = \"margin: 0px;font-size:14px;margin: 21px 0px 0px;font-size: 12px;color: #5A5858;\"><span>Note:</span>This is an automated mail, please don\'t reply.</h1>                </div></body></html>', '2018-10-08 00:00:00', '2018-10-29 12:57:03'),
(2, 'forgot_password', 'Forgot Password', '<html><body>\r\n                <div style=\"padding: 15px; border: 2px solid #813979;width: 100%;max-width: 600px;height:auto;margin: 0px auto;box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.61);\">\r\n                <div style = \"border-bottom: 1px dashed #323232;height: 47px;margin: -10px;\">\r\n                <h1 style = \"color:rgb(113, 112, 112);font-size:26px;float:left;margin: 0px;padding-top: 4px;\">||SITE_TITLE||</h1>\r\n                </div><div style = \"clear:both\"></div>\r\n                <h1 style = \"font-size: 14px;margin-top: 23px;color:#222\">Hello ||USER_NAME|| !!<span> </span></h1>\r\n                <p style = \"font-size: 14px;margin-top: 30px;margin-bottom:15px;color:#222\"> Your password with ||SITE_TITLE|| is changed successfully. Login details with new password are as below,</p>\r\n                <p style = \"margin-bottom: 5px;font-size: 13px;margin-top:5px;color:#222\"><b>Email:</b> ||EMAIL_ID||</p>\r\n                <p style = \"margin-bottom: 5px;font-size: 13px;margin-top:5px;color:#222\"><b>Password:</b> ||PASSWORD||</p>\r\n                <h1 style = \"font-weight: 600;font-size: 14px;margin:0px;width:100%;margin-bottom: 5px;color:#222\">Thank You, </h1>\r\n                <p style = \"font-size: 13px;margin:0px;color:#222\">||SITE_TITLE||</p>\r\n                <div style = \"clear:both\"></div>\r\n                <div style = \"height: 40px;background-color: #F5F5F5;text-align: center;margin: -15px;margin-top: 15px;padding:10px;\">\r\n                <h1 style = \"font-size: 15px;margin-bottom: 6px;margin-top: 0px;color:#878787;\">||SITE_TITLE||</h1>\r\n                <p style = \"margin: 0px;font-size: 12px;color:#878787\"> © ||YEAR|| All Rights Reserved. </p>\r\n                </div>\r\n                <div style = \"clear:both\"></div>\r\n                <h1 style = \"margin: 0px;font-size:14px;margin: 21px 0px 0px;font-size: 12px;color: #5A5858;\"><span>Note:</span>This is an automated mail, please don\'t reply.</h1>\r\n                </div></body></html>', '2018-10-08 00:00:00', '2018-10-29 12:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `temp_static_organizationmaster`
--

CREATE TABLE `temp_static_organizationmaster` (
  `om_pkey` int(11) NOT NULL,
  `om_CmpName` varchar(255) DEFAULT NULL,
  `om_CmpType` varchar(250) DEFAULT NULL,
  `om_CmpAddress` text DEFAULT NULL,
  `om_CmpCity` varchar(255) DEFAULT NULL,
  `om_CmpState` varchar(256) DEFAULT NULL,
  `om_CmpEmail` varchar(255) DEFAULT NULL,
  `om_supportEmail` varchar(500) DEFAULT NULL,
  `om_CmpMobile` varchar(255) DEFAULT NULL,
  `om_CmpPhone` varchar(255) DEFAULT NULL,
  `om_CmpWebsite` varchar(1000) DEFAULT NULL,
  `om_CmpFaxNo` varchar(255) DEFAULT NULL,
  `om_CmpFBLink` varchar(1000) DEFAULT NULL,
  `om_CmpTwitterLink` varchar(1000) DEFAULT NULL,
  `om_CmpLinkedInLink` varchar(1000) DEFAULT NULL,
  `om_CmpGoogleLink` varchar(1000) DEFAULT NULL,
  `om_LogoImage` varchar(255) DEFAULT NULL,
  `om_mapUrl` text DEFAULT NULL,
  `om_created_by_id` int(11) DEFAULT NULL,
  `om_clientIP` varchar(200) DEFAULT NULL,
  `om_updated_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `om_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_static_organizationmaster`
--

INSERT INTO `temp_static_organizationmaster` (`om_pkey`, `om_CmpName`, `om_CmpType`, `om_CmpAddress`, `om_CmpCity`, `om_CmpState`, `om_CmpEmail`, `om_supportEmail`, `om_CmpMobile`, `om_CmpPhone`, `om_CmpWebsite`, `om_CmpFaxNo`, `om_CmpFBLink`, `om_CmpTwitterLink`, `om_CmpLinkedInLink`, `om_CmpGoogleLink`, `om_LogoImage`, `om_mapUrl`, `om_created_by_id`, `om_clientIP`, `om_updated_date`, `om_status`) VALUES
(1, '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '103.84.81.122', '2018-10-30 10:04:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `temp_static_useradmin`
--

CREATE TABLE `temp_static_useradmin` (
  `UA_pkey` int(11) NOT NULL,
  `UA_userType` enum('superAdmin','subAdmin','userAdmin') NOT NULL,
  `userName` varchar(200) DEFAULT NULL,
  `UA_Name` varchar(200) DEFAULT NULL,
  `UA_Address` varchar(256) DEFAULT NULL,
  `UA_City` varchar(256) DEFAULT NULL,
  `UA_email` varchar(100) DEFAULT NULL,
  `UA_password` varchar(100) DEFAULT NULL,
  `UA_mobile` varchar(20) DEFAULT NULL,
  `UA_branch` varchar(256) DEFAULT NULL,
  `UA_Image` varchar(256) DEFAULT NULL,
  `UA_ip_address` varchar(100) DEFAULT NULL,
  `UA_priviliges` text DEFAULT NULL,
  `UA_createdBy` varchar(256) DEFAULT NULL,
  `UA_createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UA_updatedBy` varchar(256) DEFAULT NULL,
  `UA_updatedDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UA_status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '''2''-inactive,''1''-active,''2''-deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_static_useradmin`
--

INSERT INTO `temp_static_useradmin` (`UA_pkey`, `UA_userType`, `userName`, `UA_Name`, `UA_Address`, `UA_City`, `UA_email`, `UA_password`, `UA_mobile`, `UA_branch`, `UA_Image`, `UA_ip_address`, `UA_priviliges`, `UA_createdBy`, `UA_createdDate`, `UA_updatedBy`, `UA_updatedDate`, `UA_status`) VALUES
(1, 'superAdmin', NULL, 'Super Admin', NULL, NULL, 'mplussoftesting@gmail.com', 'bXBsdXNAMTIz', NULL, NULL, NULL, NULL, NULL, 'superAdmin', '2017-10-06 14:58:55', NULL, '2019-10-15 11:18:31', '1'),
(2, 'subAdmin', NULL, 'sachin', 'addresss', 'pune delhi', 'mplussoftesting122@gmail.com', 'MjM0MjM0Mg==', '7878787854', NULL, 'hd-nature-wallpapersdsfsdfsf.jpg', NULL, 'CMS', '1', '2018-10-26 16:05:40', '1', '2019-10-15 11:06:47', '1'),
(3, 'subAdmin', NULL, 'sachin', 'd', 'pune', 'sachin.t@mplussoft.com', 'TE5TMTYyMDMw', '9657857801', NULL, 'hd-nature-wallpapersdsfsdfsf.jpg', NULL, 'CMS', '1', '2018-10-29 12:09:35', '1', '2019-01-15 15:12:25', '1'),
(4, 'subAdmin', NULL, 'te', '575', '5757', 'sahcin.t@mplussoft.com', 'Njc1NzU2NzU2NzU3NTc1NzU=', '4757575757', NULL, NULL, NULL, 'CMS', '1', '2019-10-15 11:21:28', NULL, '2019-10-15 11:21:28', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `temp_ci_session`
--
ALTER TABLE `temp_ci_session`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `temp_static_cms`
--
ALTER TABLE `temp_static_cms`
  ADD PRIMARY KEY (`cms_pkey`);

--
-- Indexes for table `temp_static_email_format`
--
ALTER TABLE `temp_static_email_format`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `temp_static_organizationmaster`
--
ALTER TABLE `temp_static_organizationmaster`
  ADD PRIMARY KEY (`om_pkey`);

--
-- Indexes for table `temp_static_useradmin`
--
ALTER TABLE `temp_static_useradmin`
  ADD PRIMARY KEY (`UA_pkey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temp_static_cms`
--
ALTER TABLE `temp_static_cms`
  MODIFY `cms_pkey` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp_static_email_format`
--
ALTER TABLE `temp_static_email_format`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_static_organizationmaster`
--
ALTER TABLE `temp_static_organizationmaster`
  MODIFY `om_pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_static_useradmin`
--
ALTER TABLE `temp_static_useradmin`
  MODIFY `UA_pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
