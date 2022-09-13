-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 06:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sssmile`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_logs`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_administration`
--

CREATE TABLE `ci_administration` (
  `administration_id` int(11) NOT NULL,
  `administration_name` varchar(100) NOT NULL,
  `image_path` varchar(50) NOT NULL,
  `designation` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_administration`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_banner`
--

CREATE TABLE `ci_banner` (
  `banner_id` int(11) NOT NULL,
  `banner_name` varchar(50) NOT NULL,
  `banner_caption` varchar(255) NOT NULL,
  `banner_description` text NOT NULL,
  `banner_photo` varchar(50) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_banner`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_contact_messages`
--

CREATE TABLE `ci_contact_messages` (
  `message_id` int(11) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `email_address` varchar(30) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `feedback` text NOT NULL,
  `visitor_ip` varchar(20) NOT NULL,
  `visited_platform` varchar(75) NOT NULL,
  `visited_agent` varchar(75) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_contact_messages`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_departments`
--

--
-- Dumping data for table `ci_departments`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_designations`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_gallery_categories`
--

CREATE TABLE `ci_gallery_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_gallery_categories`
--

INSERT INTO `ci_gallery_categories` (`category_id`, `category_name`, `sort_order`, `created_at`, `updated_at`, `added_by`, `status`) VALUES
(1, 'category one', 1, '2022-07-22 20:05:56', '2022-07-22 20:06:40', 1, 1),
(2, 'category two', 2, '2022-07-22 20:06:54', '2022-07-22 20:06:54', 1, 1),
(3, 'adsada', 123, '2022-07-27 06:58:42', '2022-07-27 06:58:42', 3, 1),
(4, 'asdasd', 21, '2022-07-27 06:59:30', '2022-07-27 06:59:30', 0, 1),
(5, 'sdjfhgdsj@jhsdagfjdsaf.com', 1, '2022-07-27 07:08:56', '2022-07-27 07:08:56', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_gender`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_image_gallery`
--

CREATE TABLE `ci_image_gallery` (
  `gallery_id` int(11) NOT NULL,
  `image_path` varchar(50) NOT NULL,
  `image_title` varchar(75) NOT NULL,
  `gallery_category` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_image_gallery`
--

INSERT INTO `ci_image_gallery` (`gallery_id`, `image_path`, `image_title`, `gallery_category`, `sort_order`, `created_at`, `updated_at`, `added_by`, `status`) VALUES
(1, '1658851294.jpeg', 'Illo quia iusto volu', 2, 1, '2022-07-22 20:20:02', '2022-07-26 04:01:34', 0, 1),
(2, '1658851331.jpeg', 'Veritatis perferendi', 1, 2, '2022-07-22 20:25:08', '2022-07-26 04:02:11', 0, 1),
(3, '1658851338.jpeg', 'Non quis aspernatur', 1, 1, '2022-07-22 20:28:16', '2022-07-26 04:02:18', 0, 1),
(4, '1658565989.jpeg', 'Non quis aspernatur', 1, 1, '2022-07-22 20:29:00', '2022-07-22 20:46:30', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ci_main_menu`
--

CREATE TABLE `ci_main_menu` (
  `mm_id` int(11) NOT NULL,
  `top_menu` int(11) NOT NULL,
  `main_menu_name` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `content_page` int(11) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_main_menu`
--

INSERT INTO `ci_main_menu` (`mm_id`, `top_menu`, `main_menu_name`, `description`, `content_page`, `content`, `link`, `sort_order`, `added_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'Sub menu of demos', '                                                                                                                                                                                                                        desc                                                                                                                        ', 0, 'aaa', '', 1, 1, '2022-07-22 19:19:19', '2022-07-24 00:48:42', 1),
(2, 2, 'Walker Boyer', 'Nobis voluptas labor', 1, 'Illo autem libero vi', NULL, 1, 1, '2022-07-24 00:29:57', '2022-07-24 00:29:57', 2),
(3, 2, 'Walker Boyer', 'Nobis voluptas labor', 1, 'Illo autem libero vi', 'Officia sed voluptat', 1, 1, '2022-07-24 00:30:19', '2022-07-24 00:30:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ci_news`
--

CREATE TABLE `ci_news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `image_path` varchar(50) NOT NULL,
  `news_content` text NOT NULL,
  `news_date` date NOT NULL,
  `category` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `news_document` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_news`
--

INSERT INTO `ci_news` (`news_id`, `news_title`, `image_path`, `news_content`, `news_date`, `category`, `sort_order`, `news_document`, `created_at`, `updated_at`, `added_by`, `status`) VALUES
(1, 'Sint ullam consequun', '1658641497.jpeg', 'Et laboriosam ex cu', '2004-10-04', 2, 3, '91b39c9dd047af24ff9be7799ed0e4f3.pdf', '2022-07-24 05:44:57', '2022-07-24 07:17:49', 1, 1),
(2, 'Non aliquam nisi ut', '1658643269.jpeg', 'Voluptatem Et quia', '2014-12-25', 1, 2, '0f1be5b2f678933dec9cf0f7c2cdb349.pdf', '2022-07-24 06:11:28', '2022-07-24 06:14:39', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ci_news_category`
--

CREATE TABLE `ci_news_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_news_category`
--

INSERT INTO `ci_news_category` (`category_id`, `category_name`, `added_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'category one', 1, '2022-07-23 00:37:24', '2022-07-23 00:37:24', 1),
(2, 'category two', 1, '2022-07-24 07:17:26', '2022-07-24 07:17:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_orders`
--

--
-- Table structure for table `ci_quick_links`
--

CREATE TABLE `ci_quick_links` (
  `link_id` int(11) NOT NULL,
  `link_title` varchar(100) NOT NULL,
  `link_url` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_quick_links`
--

INSERT INTO `ci_quick_links` (`link_id`, `link_title`, `link_url`, `sort_order`, `created_at`, `updated_at`, `added_by`, `status`) VALUES
(1, 'qlik', 'dshjsf', 1, '2022-07-24 05:37:31', '2022-07-24 05:37:31', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_reports`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_social_media`
--

CREATE TABLE `ci_social_media` (
  `link_id` int(11) NOT NULL,
  `link_title` varchar(100) NOT NULL,
  `link_icon` varchar(100) NOT NULL,
  `link_url` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_top_menu`
--

CREATE TABLE `ci_top_menu` (
  `tm_id` int(11) NOT NULL,
  `top_menu_name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `content_page` int(11) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_top_menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_video_gallery`
--

CREATE TABLE `ci_video_gallery` (
  `gallery_id` int(11) NOT NULL,
  `video_title` varchar(50) NOT NULL,
  `video_link` varchar(100) NOT NULL,
  `video_description` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_video_gallery`
--
-- --------------------------------------------------------

--
-- Table structure for table `ci_years`
--

CREATE TABLE `ci_years` (
  `year_id` int(11) NOT NULL,
  `year_title` varchar(20) NOT NULL,
  `from_year` int(11) NOT NULL,
  `to_year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `parent_module` int(11) NOT NULL DEFAULT 0,
  `module_name` varchar(100) NOT NULL,
  `module_url` varchar(100) NOT NULL,
  `module_label` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `parent_module`, `module_name`, `module_url`, `module_label`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(2, 3, 'Modules', 'admin/modules', '', '2021-09-20 23:09:28', '2022-07-24 03:20:10', 1, 1),
(3, 3, 'Permissions', 'admin/permissions', '', '2021-09-20 23:09:10', '2021-09-20 23:09:10', 1, 1),
(5, 3, 'Export', 'export', '', '2021-09-20 23:09:05', '2021-09-20 23:09:05', 1, 1),
(6, 1, 'Users', 'admin/users', '', '2021-09-20 23:09:44', '2021-09-20 23:09:44', 1, 1),
(7, 1, 'User types', 'admin/users/user_types', '', '2021-09-20 23:09:53', '2021-11-24 14:11:27', 1, 1),
(45, 4, 'Messages', 'admin/messages', '', '2021-11-09 12:11:22', '2022-04-20 05:54:04', 1, 3),
(46, 4, 'Message types', 'admin/messages/messages_types', '', '2021-11-14 16:11:32', '2022-04-20 05:53:59', 1, 3),
(47, 2, 'Keyboard Shortcuts', 'admin/keyboard', '', '2021-11-20 13:11:15', '2022-04-20 05:53:55', 1, 3),
(48, 8, 'Contact messages', 'admin/contact_messages', '', '2021-11-21 12:11:56', '2021-11-21 12:11:56', 1, 1),
(49, 2, 'Profile', 'profile', '', '2021-11-24 15:11:15', '2021-11-24 15:11:41', 1, 1),
(50, 2, 'Message List', 'admin/home/messages', '', '2021-11-27 14:11:11', '2022-04-20 05:54:08', 1, 3),
(52, 2, 'Site settings', 'admin/site_settings', '', '2021-11-27 17:11:40', '2021-11-27 17:11:40', 1, 1),
(55, 5, 'Blogs', 'admin/blogs', '', '2021-12-06 10:12:08', '2022-04-20 05:54:11', 1, 3),
(56, 5, 'Image gallery', 'admin/image_gallery', '', '2021-12-09 09:12:37', '2022-04-20 05:54:16', 1, 3),
(58, 2, 'Visitors traffic', 'admin/home/visitors_list', '', '2021-12-12 22:42:22', '2021-12-12 22:42:22', 1, 1),
(59, 3, 'Permission Allocation', 'admin/permissions/user_type_list', '', '2021-12-14 01:42:24', '2021-12-14 01:42:24', 1, 1),
(60, 0, 'Menus', 'admin/menus', '', '2021-12-14 02:42:39', '2021-12-14 02:42:27', 1, 2),
(62, 8, 'Social medias', 'admin/social_media', '', '2021-12-17 19:42:09', '2021-12-17 19:42:09', 1, 1),
(64, 3, 'Failed attempts', 'list_failed_logs', '', '2021-12-17 19:42:16', '2021-12-17 19:42:16', 1, 1),
(65, 2, 'Activities', 'admin/activity', '', '2021-12-21 04:42:36', '2021-12-21 04:42:36', 1, 1),
(66, 5, 'Gallery category', 'admin/image_gallery/gallery_categories', '', '2022-01-08 05:05:26', '2022-04-20 05:54:19', 1, 3),
(70, 8, 'About us', 'admin/about_us', 'icon material-icons md-comment', '2022-02-18 23:22:06', '2022-07-28 02:25:43', 1, 1),
(71, 0, 'Clients', 'admin/clients', '', '2022-02-21 00:47:17', '2022-04-20 05:54:23', 1, 3),
(72, 0, 'Video gallery', 'admin/video_gallery', '', '2022-02-21 01:06:22', '2022-04-20 05:54:27', 1, 3),
(73, 9, 'Image Gallery', 'admin/image_gallery', '', '2022-04-21 02:32:26', '2022-07-22 19:56:12', 1, 1),
(74, 9, 'Gallery Types', 'admin/image_gallery/gallery_categories', '', '2022-04-21 02:32:48', '2022-07-22 19:56:56', 1, 1),
(75, 9, 'Video gallery', 'admin/video_gallery', '', '2022-04-21 02:35:16', '2022-07-22 20:48:14', 1, 1),
(76, 8, 'Banner', 'admin/banner', '', '2022-04-21 02:35:40', '2022-07-22 22:12:31', 1, 1),
(77, 10, 'News', 'admin/news', '', '2022-04-21 03:37:32', '2022-07-23 00:29:32', 1, 1),
(78, 10, 'News categories', 'admin/news/categories', '', '2022-04-22 05:26:53', '2022-07-23 00:30:00', 1, 1),
(79, 11, 'Administration designations', 'admin/administration/designations', '', '2022-04-22 05:49:27', '2022-07-23 00:44:24', 1, 1),
(80, 11, 'Administration years', 'admin/administration/years', '', '2022-04-26 01:57:08', '2022-07-23 00:44:21', 1, 1),
(81, 11, 'Administrations', 'admin/administration', '', '2022-07-04 11:21:44', '2022-07-23 00:44:35', 1, 1),
(82, 8, 'Quick links', 'admin/quick_links', '', '2022-07-23 00:57:30', '2022-07-23 00:57:30', 1, 1),
(83, 12, 'Top Menus', 'admin/menus/top_menus', '', '2022-07-24 00:20:25', '2022-07-24 00:20:25', 1, 1),
(84, 12, 'SubMenus', 'admin/menus/sub_menus', '', '2022-07-24 00:20:33', '2022-07-24 00:20:33', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules_group`
--

CREATE TABLE `modules_group` (
  `mg_id` int(11) NOT NULL,
  `main_module_name` varchar(100) NOT NULL,
  `module_group_label` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules_group`
--

INSERT INTO `modules_group` (`mg_id`, `main_module_name`, `module_group_label`, `sort_order`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(1, 'Users', 'md-group', 0, '2021-09-20 12:09:49', '2022-07-28 08:44:01', 1, 1),
(2, 'Settings', 'md-settings', 0, '2021-09-20 12:09:51', '2022-07-28 08:44:29', 1, 1),
(3, 'Admin', 'md-admin_panel_settings', 3, '2021-09-21 13:09:35', '2022-07-28 08:45:44', 1, 1),
(4, 'Messages', 'md-chat', 4, '2021-09-21 13:09:15', '2022-07-28 09:01:13', 1, 1),
(5, 'Medias', 'icon material-icons md-shopping_bag', 7, '2021-10-07 12:10:11', '2022-01-08 05:05:43', 1, 1),
(6, 'Homepage items', 'icon material-icons md-shopping_bag', 5, '2021-10-07 17:10:34', '2021-11-14 16:11:55', 1, 1),
(8, 'CMS contents', 'md-history_edu', 7, '2021-12-22 06:59:28', '2022-07-28 03:37:45', 1, 1),
(9, 'Gallery', 'md-photo_library', 7, '2022-07-22 20:47:17', '2022-07-28 08:48:36', 1, 1),
(10, 'News', 'md-dvr', 8, '2022-07-23 00:54:53', '2022-07-28 08:51:38', 1, 1),
(11, 'Administration', 'md-contacts', 9, '2022-07-23 00:55:02', '2022-07-28 08:57:13', 1, 1),
(12, 'Front Menus', 'md-list_alt', 6, '2022-07-24 00:43:50', '2022-07-28 09:00:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_access`
--

CREATE TABLE `module_access` (
  `ma_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module_access`
--

INSERT INTO `module_access` (`ma_id`, `module_id`, `user_id`, `created_at`, `updated_at`, `added_by`, `status`) VALUES
(1, 49, 7, '2022-02-18 17:18:41', '2022-02-18 17:18:41', 0, 1),
(2, 62, 7, '2022-02-18 17:18:43', '2022-02-18 17:18:43', 0, 1),
(3, 50, 7, '2022-02-18 17:31:02', '2022-02-18 17:31:02', 0, 1),
(4, 45, 7, '2022-02-18 17:31:04', '2022-02-18 17:31:04', 0, 1),
(5, 46, 7, '2022-02-18 17:31:06', '2022-02-18 17:31:06', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_user_types`
--

CREATE TABLE `module_user_types` (
  `mut_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL DEFAULT 0,
  `module_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module_user_types`
--

INSERT INTO `module_user_types` (`mut_id`, `user_type_id`, `module_id`, `created_at`, `updated_at`, `added_by`, `status`) VALUES
(1, 2, 49, '2022-02-18 17:18:29', '2022-02-18 17:18:29', 0, 1),
(2, 2, 62, '2022-02-18 17:18:33', '2022-02-18 17:18:33', 0, 1),
(3, 2, 50, '2022-02-18 17:30:25', '2022-02-18 17:30:25', 0, 1),
(4, 2, 45, '2022-02-18 17:30:29', '2022-02-18 17:30:29', 0, 1),
(5, 2, 46, '2022-02-18 17:30:31', '2022-02-18 17:30:31', 0, 1),
(6, 2, 70, '2022-04-20 17:45:01', '2022-04-20 17:45:01', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(120) NOT NULL,
  `contact_numbers` varchar(120) NOT NULL,
  `email_address` varchar(120) NOT NULL,
  `address` varchar(220) NOT NULL,
  `map_location` text NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`site_id`, `site_name`, `contact_numbers`, `email_address`, `address`, `map_location`, `added_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'SSS Mile', '9495583656', 'abc@sssmile.com', 'SSS Mile', '', 1, '2021-10-07 18:10:34', '2022-02-19 06:35:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status`, `created_at`, `updated_at`, `added_by`) VALUES
(1, 'Active', '2021-09-21 03:24:36', '2021-09-21 03:24:36', 0),
(2, 'Inactive', '2021-09-21 03:24:36', '2021-09-21 03:24:36', 0),
(3, 'Deleted', '2021-09-21 03:24:41', '2021-09-21 03:24:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_mobile` varchar(150) NOT NULL,
  `user_token` varchar(150) NOT NULL,
  `user_photo` varchar(150) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `user_name`, `user_password`, `user_email`, `user_mobile`, `user_token`, `user_photo`, `user_type`, `created_at`, `updated_at`, `user_status`) VALUES
(1, 'Super admin', 'admin', '83878c91171338902e0fe0fb97a8c47a', 'superadmin@gmail.com', '123456789', '', '1645209099.png', 1, '2021-09-21 03:17:38', '2021-09-21 03:17:38', 1),
(8, 'Test', 'test', '434990c8a25d2be94863561ae98bd682', 'eldhossaji13.8@gmail.com', '123456789', '14d6e0296bbd8886813e9fd7a8656ee4', 'avatar.png', 3, '2021-12-10 01:42:28', '2022-07-24 19:49:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `login_ip` varchar(100) NOT NULL,
  `login_device` varchar(100) NOT NULL,
  `login_os` varchar(100) NOT NULL,
  `login_browser` varchar(100) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_logs`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_logs_failed`
--

CREATE TABLE `user_logs_failed` (
  `log_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `entered_password` varchar(50) NOT NULL,
  `login_ip` varchar(100) NOT NULL,
  `login_device` varchar(100) NOT NULL,
  `login_os` varchar(100) NOT NULL,
  `login_browser` varchar(100) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_logs_failed`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `ut_id` int(11) NOT NULL,
  `user_type` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`ut_id`, `user_type`, `created_at`, `updated_at`, `added_by`, `status`) VALUES
(1, 'Superadmin', '2021-09-21 03:22:02', NULL, 1, 1),
(2, 'Users', '2021-09-21 03:22:02', '2022-07-24 03:18:45', 1, 1),
(3, 'Tester', '2021-11-09 12:11:08', '2022-04-20 05:04:28', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `visitor_ip` varchar(20) NOT NULL,
  `visited_platform` varchar(20) NOT NULL,
  `visited_agent` varchar(20) NOT NULL,
  `visited_date` date NOT NULL,
  `visited_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ci_about_us`
--
ALTER TABLE `ci_about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `ci_administration`
--
ALTER TABLE `ci_administration`
  ADD PRIMARY KEY (`administration_id`);

--
-- Indexes for table `ci_banner`
--
ALTER TABLE `ci_banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `ci_contact_messages`
--
ALTER TABLE `ci_contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `ci_departments`
--
--
-- Indexes for table `ci_gallery_categories`
--
ALTER TABLE `ci_gallery_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `ci_image_gallery`
--
ALTER TABLE `ci_image_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `ci_main_menu`
--
ALTER TABLE `ci_main_menu`
  ADD PRIMARY KEY (`mm_id`);

--
-- Indexes for table `ci_news`
--
ALTER TABLE `ci_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `ci_news_category`
--
ALTER TABLE `ci_news_category`
  ADD PRIMARY KEY (`category_id`);

--

-- Indexes for table `ci_quick_links`
--
ALTER TABLE `ci_quick_links`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `ci_reports`
--
--
--
-- Indexes for table `ci_social_media`
--
ALTER TABLE `ci_social_media`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `ci_top_menu`
--
ALTER TABLE `ci_top_menu`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `ci_video_gallery`
--
ALTER TABLE `ci_video_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `ci_years`
--
ALTER TABLE `ci_years`
  ADD PRIMARY KEY (`year_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`),
  ADD KEY `module_id` (`module_id`,`parent_module`,`created_by`,`status`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `modules_group`
--
ALTER TABLE `modules_group`
  ADD PRIMARY KEY (`mg_id`),
  ADD KEY `mg_id` (`mg_id`,`created_by`,`status`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `module_access`
--
ALTER TABLE `module_access`
  ADD PRIMARY KEY (`ma_id`),
  ADD KEY `ma_id` (`ma_id`,`module_id`,`user_id`,`added_by`,`status`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `module_user_types`
--
ALTER TABLE `module_user_types`
  ADD PRIMARY KEY (`mut_id`),
  ADD KEY `mut_id` (`mut_id`,`user_type_id`,`module_id`,`added_by`,`status`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`site_id`),
  ADD KEY `site_id` (`site_id`,`added_by`,`status`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_status` (`user_status`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`,`log_id`);

--
-- Indexes for table `user_logs_failed`
--
ALTER TABLE `user_logs_failed`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `log_id` (`log_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`ut_id`),
  ADD KEY `ut_id` (`ut_id`,`added_by`,`status`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

--
-- AUTO_INCREMENT for table `ci_about_us`
--
ALTER TABLE `ci_about_us`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_administration`
--
ALTER TABLE `ci_administration`
  MODIFY `administration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_banner`
--
ALTER TABLE `ci_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_contact_messages`
--
ALTER TABLE `ci_contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_gallery_categories`
--
ALTER TABLE `ci_gallery_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_image_gallery`
--
ALTER TABLE `ci_image_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_main_menu`
--
ALTER TABLE `ci_main_menu`
  MODIFY `mm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_news`
--
ALTER TABLE `ci_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_news_category`
--
ALTER TABLE `ci_news_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- AUTO_INCREMENT for table `ci_quick_links`
--
ALTER TABLE `ci_quick_links`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_social_media`
--
ALTER TABLE `ci_social_media`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_top_menu`
--
ALTER TABLE `ci_top_menu`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_video_gallery`
--
ALTER TABLE `ci_video_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_years`
--
ALTER TABLE `ci_years`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `modules_group`
--
ALTER TABLE `modules_group`
  MODIFY `mg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `module_access`
--
ALTER TABLE `module_access`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_user_types`
--
ALTER TABLE `module_user_types`
  MODIFY `mut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `user_logs_failed`
--
ALTER TABLE `user_logs_failed`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `ut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `modules_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `modules_group`
--
ALTER TABLE `modules_group`
  ADD CONSTRAINT `modules_group_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `modules_group_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_status`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`ut_id`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_types`
--
ALTER TABLE `user_types`
  ADD CONSTRAINT `user_types_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_types_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
