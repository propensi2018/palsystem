-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2018 at 12:05 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pal3`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_types`
--

CREATE TABLE `activity_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_types`
--

INSERT INTO `activity_types` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Presentation', '', '2018-05-18 03:44:39', '2018-05-18 03:44:39'),
(2, 'Fix', '', '2018-05-18 03:44:39', '2018-05-18 03:44:39'),
(3, 'Commit', '', '2018-05-18 03:44:39', '2018-05-18 03:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prospect_customer_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `postal_code`, `province`, `street`, `city`, `kelurahan`, `district`, `created_at`, `updated_at`, `prospect_customer_id`) VALUES
(1, 'AU5Y9', 'MoV7hjlkzsZrpU6', '6zetrdAUY9ETkQE', '7AYdC1ToHitmpcE', 'pvUy8AqKzzKkwou', 'IXhWqKx9Cb1yCqc', NULL, NULL, NULL),
(2, 'nPBIz', 'IS5QyrASIhubRjK', 'qnSNPX1wQb4PClV', '3w9wX8Rv9aKdtbL', 'IMkTJPajTvEcnMb', 'xfLGFwASgjzPly0', NULL, NULL, NULL),
(3, 'yyEW3', 'tKtlaGpZ8ot1wPY', '4xrWhdWwKy5Pnjs', 'gc5pRfmcOEDPW26', '8w1LBnoq50PMmpC', 'E6pVUkqUYmVnZ1z', NULL, NULL, NULL),
(4, 'xgr26', '7oJlSToy2zC5VTX', 'QY9vPXKkUSP5D54', 'x2PF0pJPF4bn9fZ', 'KBQ7YWI50iIa6eI', 'UcNjDt3vaHHQiV4', NULL, NULL, NULL),
(5, '71xSe', 'XSU5Kvvb2IYZ1e9', 'FpIEmoqFkGPVgpp', '9dOMNOkDNgACIKC', 'xCTr9a9R0VH6gJN', '0TXsiyLaoj8WDwa', NULL, NULL, NULL),
(6, '1234', 'wqer', 'wqer', 'ewr', 'qwer', 'qwer', '2018-05-18 07:16:59', '2018-05-18 07:16:59', 14),
(7, '12342321', 'qwerwerqwer', 'qwerqwer', 'qwerweqr', 'qwerw', 'qwerwqer', '2018-05-18 07:24:00', '2018-05-18 07:24:00', 1),
(8, '13213', 'ytiy', 'klwnbfklef', 'iuti', 'tut', 'ututu', '2018-05-18 07:54:08', '2018-05-18 07:54:08', 26);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_a_deal` tinyint(1) DEFAULT NULL,
  `id_act_type` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `is_a_deal`, `id_act_type`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '2018-05-18 07:16:41', '2018-05-18 07:16:41'),
(2, 0, 2, '2018-05-18 07:20:17', '2018-05-18 07:20:17'),
(3, 0, 3, '2018-05-18 07:20:28', '2018-05-18 07:20:28'),
(4, 0, 1, '2018-05-18 07:23:43', '2018-05-18 07:23:43'),
(5, 0, 2, '2018-05-18 07:26:47', '2018-05-18 07:26:47'),
(6, 0, 3, '2018-05-18 07:27:21', '2018-05-18 07:27:21'),
(7, 0, 1, '2018-05-18 07:53:56', '2018-05-18 07:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `level_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `mgr_user_id` int(10) UNSIGNED NOT NULL,
  `region_level_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`level_id`, `branch_id`, `mgr_user_id`, `region_level_id`, `address_id`, `created_at`, `updated_at`) VALUES
(4, 1, 4, 2, 4, '2018-05-18 03:44:33', '2018-05-18 03:44:33'),
(5, 2, 5, 3, 5, '2018-05-18 03:44:33', '2018-05-18 03:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_user_commenter` int(10) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id_sender` int(10) UNSIGNED NOT NULL,
  `statistic_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_status_condition` int(10) UNSIGNED DEFAULT NULL,
  `is_act` tinyint(1) NOT NULL,
  `pic_sp_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `id_status_condition`, `is_act`, `pic_sp_id`, `created_at`, `updated_at`) VALUES
(1, 'Zebedee O', NULL, 1, 6, '2018-05-18 03:44:36', '2018-05-18 07:24:00'),
(2, 'Mendie Smallwood', NULL, 0, 7, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(3, 'Ottilie Grundwater', NULL, 0, 8, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(4, 'Cristionna Sweatland', NULL, 0, 8, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(5, 'Shawn Crumpton', NULL, 0, 9, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(6, 'Rafaello Loweth', NULL, 0, 10, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(7, 'Bili Grimshaw', NULL, 0, 11, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(8, 'Patsy Aneley', NULL, 0, 12, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(9, 'Nikos Stenyng', NULL, 0, 13, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(10, 'Davy Merrien', NULL, 0, 14, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(11, 'Erwin Mahy', NULL, 0, 15, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(12, 'Robbie Fick', NULL, 0, 16, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(13, 'Barclay Pitkethly', NULL, 0, 16, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(14, 'Wylma Baszniak', NULL, 1, 6, '2018-05-18 03:44:37', '2018-05-18 07:16:59'),
(15, 'Prue Moultrie', NULL, 0, 7, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(16, 'Eileen Puttergill', NULL, 0, 8, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(17, 'Kassie Sinfield', NULL, 0, 9, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(18, 'Farra Morales', NULL, 0, 10, '2018-05-18 03:44:37', '2018-05-18 03:44:37'),
(19, 'Orville Davidoff', NULL, 0, 11, '2018-05-18 03:44:38', '2018-05-18 03:44:38'),
(20, 'Zebedee O', NULL, 0, 12, '2018-05-18 03:44:38', '2018-05-18 03:44:38'),
(21, 'Editha Di Ruggero', NULL, 0, 13, '2018-05-18 03:44:38', '2018-05-18 03:44:38'),
(22, 'Hester Strudwick', NULL, 0, 14, '2018-05-18 03:44:38', '2018-05-18 03:44:38'),
(23, 'Agnesse Glazyer', NULL, 0, 15, '2018-05-18 03:44:38', '2018-05-18 03:44:38'),
(24, 'Nissy McGenis', NULL, 0, 19, '2018-05-18 03:44:38', '2018-05-18 03:44:38'),
(25, 'Amory Reith', NULL, 0, 20, '2018-05-18 03:44:39', '2018-05-18 03:44:39'),
(26, 'JAN', NULL, 1, 6, '2018-05-18 07:53:33', '2018-05-18 07:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Warm', '', '2018-05-18 03:44:40', '2018-05-18 03:44:40'),
(2, 'Hot', '', '2018-05-18 03:44:40', '2018-05-18 03:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Nagarakembang', '2018-05-18 03:44:32', '2018-05-18 03:44:32'),
(2, 'Moss', '2018-05-18 03:44:32', '2018-05-18 03:44:32'),
(3, 'Adelaide', '2018-05-18 03:44:32', '2018-05-18 03:44:32'),
(4, 'Alderetes', '2018-05-18 03:44:32', '2018-05-18 03:44:32'),
(5, 'Jiguan', '2018-05-18 03:44:32', '2018-05-18 03:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `id_mgr` int(11) NOT NULL,
  `is_gh` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`user_id`, `id_mgr`, `is_gh`, `created_at`, `updated_at`) VALUES
(1, 31, 1, NULL, NULL),
(2, 32, 0, NULL, NULL),
(3, 33, 1, NULL, NULL),
(4, 34, 0, NULL, NULL),
(5, 35, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `user_id_sender` int(10) UNSIGNED NOT NULL,
  `id_msg` int(10) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`user_id_sender`, `id_msg`, `time`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-01-01 13:27:26', 'Training event', 'In sagittis dui vel nisl. Duis ac nibh.s', 1, '2018-05-18 03:44:41', '2018-05-18 03:44:41'),
(2, 2, '2017-01-02 13:27:26', 'Himbauan Untuk Salesperson', 'Maecenas pulvinar lobortis est. Phasellus', 0, '2018-05-18 03:44:41', '2018-05-18 03:44:41'),
(2, 3, '2017-01-02 13:27:26', 'Pengumuman Penting', 'Nunc rhoncus dui vel sem. Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus. Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam', 1, '2018-05-18 03:44:41', '2018-05-18 03:44:41'),
(3, 4, '2017-01-03 13:27:26', 'Ketentuan meeting', 'Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat. Nulla nisl. Nunc nisl. Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum. In hac habitasse', 0, '2018-05-18 03:44:41', '2018-05-18 03:44:41'),
(3, 5, '2017-01-04 13:27:26', 'Update SOP pengajuan dana', 'Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem. Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit. Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque. Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus. In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus. Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.', 1, '2018-05-18 03:44:42', '2018-05-18 03:44:42'),
(4, 6, '2017-01-05 13:27:26', 'Informasi pelanggan', 'Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem. Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus. Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.', 0, '2018-05-18 03:44:42', '2018-05-18 03:44:42'),
(4, 7, '2017-01-06 13:27:26', 'Laporan kondisi keuangan pelanggan', 'Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus. Phasellus in felis. Donec semper sapien a libero. Nam dui. Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius. Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi. Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus. Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.', 1, '2018-05-18 03:44:42', '2018-05-18 03:44:42'),
(5, 8, '2017-01-07 13:27:26', 'Jadwal meeting', 'Nunc rhoncus dui vel sem. Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus. Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem. Praesent id massa id nisl venenatis lacinia.', 0, '2018-05-18 03:44:42', '2018-05-18 03:44:42'),
(5, 9, '2017-01-08 13:27:26', 'Laporan pelanggan', 'Aenean sit amet justo. Morbi ut odio. Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis.', 1, '2018-05-18 03:44:42', '2018-05-18 03:44:42'),
(6, 10, '2017-01-09 13:27:26', 'Laporan rahasia', 'Morbi ut odio. Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est. Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.', 0, '2018-05-18 03:44:42', '2018-05-18 03:44:42'),
(6, 11, '2017-01-10 13:27:26', 'Ketentuan pengajuan reksadana', 'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem. Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio. Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', 1, '2018-05-18 03:44:43', '2018-05-18 03:44:43'),
(7, 12, '2017-01-11 13:27:26', 'Pembelian reksadana', 'Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem. Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit. Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque. Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus. In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus. Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst. Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat. Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.', 0, '2018-05-18 03:44:43', '2018-05-18 03:44:43'),
(7, 13, '2017-01-12 13:27:26', 'Himbauuan kepada pelanggan x', 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat. Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat. Nulla nisl. Nunc nisl. Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum. In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo. Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis. Sed ante. Vivamus tortor.', 1, '2018-05-18 03:44:43', '2018-05-18 03:44:43'),
(8, 14, '2017-01-13 13:27:26', 'Permohonan izin training', 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio. Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis.', 0, '2018-05-18 03:44:43', '2018-05-18 03:44:43'),
(8, 15, '2017-01-14 13:27:26', 'Laporan statistik bulanan', 'Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem. Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio. Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est. Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem. Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy.', 1, '2018-05-18 03:44:43', '2018-05-18 03:44:43'),
(9, 16, '2017-01-15 13:27:26', 'Pengajuan pengunduran diri', 'rra eget, congue eget, semper rutrum, nulla. Nunc purus. Phasellus in felis. Donec semper sapien a libero. Nam dui. Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius. Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi. Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus. Curabitur at ipsum ac tellus semper interdu', 0, '2018-05-18 03:44:43', '2018-05-18 03:44:43'),
(9, 17, '2017-01-16 13:27:26', 'Pengajuan konseling', 'imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipisci', 1, '2018-05-18 03:44:44', '2018-05-18 03:44:44'),
(10, 18, '2017-01-17 13:27:26', 'Permintaan training CRM', 'at, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus. Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, na', 0, '2018-05-18 03:44:44', '2018-05-18 03:44:44'),
(10, 19, '2017-01-18 13:27:26', 'Feedback Training', 'Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem. Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit. Donec', 1, '2018-05-18 03:44:44', '2018-05-18 03:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `message_receiveds`
--

CREATE TABLE `message_receiveds` (
  `id_receive_association` int(10) UNSIGNED NOT NULL,
  `user_id_receiver` int(10) UNSIGNED NOT NULL,
  `id_msg` int(10) UNSIGNED NOT NULL,
  `sender_id_receiver` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_receiveds`
--

INSERT INTO `message_receiveds` (`id_receive_association`, `user_id_receiver`, `id_msg`, `sender_id_receiver`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2018-05-18 03:44:44', '2018-05-18 03:44:44'),
(2, 4, 2, 2, '2018-05-18 03:44:45', '2018-05-18 03:44:45'),
(3, 4, 3, 2, '2018-05-18 03:44:45', '2018-05-18 03:44:45'),
(4, 5, 4, 3, '2018-05-18 03:44:45', '2018-05-18 03:44:45'),
(5, 5, 5, 3, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(6, 6, 6, 4, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(7, 7, 7, 4, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(8, 13, 8, 5, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(9, 14, 9, 5, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(10, 7, 10, 6, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(11, 7, 11, 6, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(12, 6, 12, 7, '2018-05-18 03:44:46', '2018-05-18 03:44:46'),
(13, 6, 13, 7, '2018-05-18 03:44:47', '2018-05-18 03:44:47'),
(14, 10, 14, 8, '2018-05-18 03:44:47', '2018-05-18 03:44:47'),
(15, 9, 15, 8, '2018-05-18 03:44:47', '2018-05-18 03:44:47'),
(16, 10, 16, 9, '2018-05-18 03:44:47', '2018-05-18 03:44:47'),
(17, 8, 17, 9, '2018-05-18 03:44:47', '2018-05-18 03:44:47'),
(18, 8, 18, 10, '2018-05-18 03:44:47', '2018-05-18 03:44:47'),
(19, 9, 19, 10, '2018-05-18 03:44:47', '2018-05-18 03:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_22_091227_create_salespersons_table', 1),
(4, '2018_04_22_091709_create_managers_table', 1),
(5, '2018_04_22_091726_create_addresses_table', 1),
(6, '2018_04_22_091741_create_product_classes_table', 1),
(7, '2018_04_22_091754_create_levels_table', 1),
(8, '2018_04_22_091806_create_regions_table', 1),
(9, '2018_04_22_091819_create_statuses_table', 1),
(10, '2018_04_22_091831_create_status_conditions_table', 1),
(11, '2018_04_22_091843_create_customers_table', 1),
(12, '2018_04_22_091903_create_prospect_willingnesses_table', 1),
(13, '2018_04_22_091920_create_customer_types_table', 1),
(14, '2018_04_22_091936_create_prospects_table', 1),
(15, '2018_04_22_091954_create_ratings_table', 1),
(16, '2018_04_22_092009_create_product_types_table', 1),
(17, '2018_04_22_092101_create_branches_table', 1),
(18, '2018_04_22_092254_create_messages_table', 1),
(19, '2018_04_22_092311_create_message_receiveds_table', 1),
(20, '2018_04_22_092326_create_statistic_types_table', 1),
(21, '2018_04_22_092338_create_statistics_table', 1),
(22, '2018_04_22_092350_create_comments_table', 1),
(23, '2018_04_22_092402_create_activity_types_table', 1),
(24, '2018_04_22_092414_create_appointments_table', 1),
(25, '2018_04_22_092427_create_schedule_types_table', 1),
(26, '2018_04_22_092444_create_schedules_table', 1),
(27, '2018_04_22_092501_create_product_lists_table', 1),
(28, '2018_04_22_092518_create_product_list_assocs_table', 1),
(29, '2018_04_22_092536_create_transactions_table', 1),
(30, '2018_04_22_094325_update_fk', 1),
(31, '2018_04_23_134211_create_telephones_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_classes`
--

CREATE TABLE `product_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_classes`
--

INSERT INTO `product_classes` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Aggresive', 'Aggresive', '2018-05-18 03:44:48', '2018-05-18 03:44:48'),
(2, 'Moderate', 'Moderate', '2018-05-18 03:44:48', '2018-05-18 03:44:48'),
(3, 'Conservative', 'Conservative', '2018-05-18 03:44:48', '2018-05-18 03:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_lists`
--

CREATE TABLE `product_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_lists`
--

INSERT INTO `product_lists` (`id`, `schedule_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-05-18 07:20:18', '2018-05-18 07:20:18'),
(2, 3, '2018-05-18 07:26:47', '2018-05-18 07:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_list_assocs`
--

CREATE TABLE `product_list_assocs` (
  `assoc_id` int(10) UNSIGNED NOT NULL,
  `product_list_id` int(10) UNSIGNED NOT NULL,
  `id_ptype` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_list_assocs`
--

INSERT INTO `product_list_assocs` (`assoc_id`, `product_list_id`, `id_ptype`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1000, '2017-05-18 07:20:18', '2018-05-18 07:20:18'),
(2, 1, 2, 2000, '2017-05-18 07:20:18', '2018-05-18 07:20:18'),
(3, 1, 3, 3000, '2017-05-18 07:20:19', '2018-05-18 07:20:19'),
(4, 1, 4, 4000, '2017-05-18 07:20:19', '2018-05-18 07:20:19'),
(5, 2, 6, 1000, '2017-05-18 07:26:47', '2018-05-18 07:26:47'),
(6, 2, 5, 2000, '2017-05-18 07:26:47', '2018-05-18 07:26:47'),
(7, 2, 4, 3000, '2017-05-18 07:26:48', '2018-05-18 07:26:48'),
(8, 2, 3, 4000, '2017-05-18 07:26:48', '2018-05-18 07:26:48'),
(9, 2, 1, 5000, '2017-05-18 07:26:48', '2018-05-18 07:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `id_class` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `desc`, `is_deleted`, `id_class`, `created_at`, `updated_at`) VALUES
(1, 'Reksadana I', 0, 1, '2018-05-18 03:44:48', '2018-05-18 03:44:48'),
(2, 'Reksadana II', 0, 2, '2018-05-18 03:44:49', '2018-05-18 03:44:49'),
(3, 'Brokerage I', 0, 3, '2018-05-18 03:44:49', '2018-05-18 03:44:49'),
(4, 'Brokerage II', 0, 1, '2018-05-18 03:44:49', '2018-05-18 03:44:49'),
(5, 'Debt Capital I', 0, 2, '2018-05-18 03:44:49', '2018-05-18 03:44:49'),
(6, 'Debt Capital II', 0, 3, '2018-05-18 03:44:50', '2018-05-18 03:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `prospects`
--

CREATE TABLE `prospects` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_type_id` int(10) UNSIGNED NOT NULL,
  `prospect_willingness_id` int(10) UNSIGNED NOT NULL,
  `cycle` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prospects`
--

INSERT INTO `prospects` (`customer_id`, `notes`, `email`, `customer_type_id`, `prospect_willingness_id`, `cycle`, `created_at`, `updated_at`) VALUES
(1, 'wqq', 'wqerqwerqwer', 2, 3, 1, '2018-05-18 07:24:00', '2018-05-18 07:27:22'),
(14, 'qwerr', 'qwerqewr', 2, 3, 1, '2018-05-18 07:16:59', '2018-05-18 07:20:28'),
(26, 'OKBRO', '234324', 1, 3, 1, '2018-05-18 07:54:08', '2018-05-18 07:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `prospect_willingnesses`
--

CREATE TABLE `prospect_willingnesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prospect_willingnesses`
--

INSERT INTO `prospect_willingnesses` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Aggresive', 'Aggresive', '2018-05-18 03:44:39', '2018-05-18 03:44:39'),
(2, 'Moderate', 'Moderate', '2018-05-18 03:44:40', '2018-05-18 03:44:40'),
(3, 'Conservative', 'Conservative', '2018-05-18 03:44:40', '2018-05-18 03:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `sales_user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_types_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `sales_user_id`, `date`, `product_types_id`, `created_at`, `updated_at`) VALUES
(5, 6, '2016', NULL, '2018-05-18 03:52:17', '2018-05-18 03:52:17'),
(6, NULL, '2016', 4, '2018-05-18 03:52:17', '2018-05-18 03:52:17'),
(7, NULL, '2016', 5, '2018-05-18 03:52:17', '2018-05-18 03:52:17'),
(8, NULL, '2016', 6, '2018-05-18 03:52:18', '2018-05-18 03:52:18'),
(33, NULL, '2017', 4, '2018-05-18 07:36:30', '2018-05-18 07:36:30'),
(34, NULL, '2017', 5, '2018-05-18 07:36:30', '2018-05-18 07:36:30'),
(35, NULL, '2017', 3, '2018-05-18 07:36:30', '2018-05-18 07:36:30'),
(36, 6, '2017', NULL, '2018-05-18 07:36:30', '2018-05-18 07:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `level_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `mgr_user_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`level_id`, `region_id`, `mgr_user_id`, `address_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 2, '2018-05-18 03:44:32', '2018-05-18 03:44:32'),
(3, 2, 3, 3, '2018-05-18 03:44:33', '2018-05-18 03:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `salespeople`
--

CREATE TABLE `salespeople` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `id_sp` int(11) NOT NULL,
  `branch_level_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salespeople`
--

INSERT INTO `salespeople` (`user_id`, `id_sp`, `branch_level_id`, `created_at`, `updated_at`) VALUES
(6, 1, 4, '2018-05-18 03:44:34', '2018-05-18 03:44:34'),
(7, 2, 4, '2018-05-18 03:44:34', '2018-05-18 03:44:34'),
(8, 3, 4, '2018-05-18 03:44:34', '2018-05-18 03:44:34'),
(9, 4, 4, '2018-05-18 03:44:34', '2018-05-18 03:44:34'),
(10, 5, 4, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(11, 6, 4, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(12, 7, 4, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(13, 8, 5, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(14, 9, 5, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(15, 10, 5, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(16, 11, 5, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(17, 12, 5, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(18, 13, 5, '2018-05-18 03:44:35', '2018-05-18 03:44:35'),
(19, 14, 5, '2018-05-18 03:44:36', '2018-05-18 03:44:36'),
(20, 15, 5, '2018-05-18 03:44:36', '2018-05-18 03:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `response` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cycle` int(11) NOT NULL,
  `schedule_type_id` int(10) UNSIGNED DEFAULT NULL,
  `id_customer` int(10) UNSIGNED DEFAULT NULL,
  `id_user_sp` int(10) UNSIGNED DEFAULT NULL,
  `next_schedule_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `is_done`, `time`, `response`, `notes`, `cycle`, `schedule_type_id`, `id_customer`, `id_user_sp`, `next_schedule_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-05-18 07:20:18', 'Prospect', 'qwerr', 1, 1, 14, 6, 2, '2018-05-18 07:16:41', '2018-05-18 07:20:18'),
(2, 1, '2018-05-18 07:20:28', NULL, 'qwerqwer', 1, 2, 14, 6, NULL, '2018-05-18 07:20:17', '2018-05-18 07:20:28'),
(3, 1, '2018-05-18 07:26:47', 'Prospect', 'wqq', 1, 3, 1, 6, 4, '2018-05-18 07:23:44', '2018-05-18 07:26:47'),
(4, 1, '2018-05-18 07:27:22', NULL, '12343', 1, 4, 1, 6, NULL, '2018-05-18 07:26:47', '2018-05-18 07:27:22'),
(5, 0, '2018-12-31 07:32:00', 'Prospect', 'OKBRO', 1, 5, 26, 6, NULL, '2018-05-18 07:53:56', '2018-05-18 07:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_types`
--

CREATE TABLE `schedule_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `appointment_id` int(10) UNSIGNED DEFAULT NULL,
  `telp_flag` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_types`
--

INSERT INTO `schedule_types` (`id`, `appointment_id`, `telp_flag`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2018-05-18 07:16:41', '2018-05-18 07:20:17'),
(2, 3, 1, '2018-05-18 07:20:17', '2018-05-18 07:20:28'),
(3, 5, 1, '2018-05-18 07:23:44', '2018-05-18 07:26:47'),
(4, 6, 1, '2018-05-18 07:26:46', '2018-05-18 07:27:22'),
(5, 7, 1, '2018-05-18 07:53:56', '2018-05-18 07:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(10) UNSIGNED NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` int(11) NOT NULL,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_types` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistic_types`
--

CREATE TABLE `statistic_types` (
  `id_types` int(10) UNSIGNED NOT NULL,
  `target` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `id_user_sp` int(10) UNSIGNED DEFAULT NULL,
  `id_level` int(10) UNSIGNED DEFAULT NULL,
  `id_product` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_conditions`
--

CREATE TABLE `status_conditions` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telephones`
--

CREATE TABLE `telephones` (
  `id` int(10) UNSIGNED NOT NULL,
  `telp_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `descr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `telephones`
--

INSERT INTO `telephones` (`id`, `telp_no`, `customer_id`, `descr`, `created_at`, `updated_at`) VALUES
(1, 'GUrSzeJs20', 1, '8FnumJHBEb1QK3c', NULL, NULL),
(2, 'NL75OOIY5D', 2, '9mKuVfNIeIfpx7U', NULL, NULL),
(3, 'vYH4PbuqF8', 3, 'SxwBPTN1q0XfTJD', NULL, NULL),
(4, 'VPN5ZnHw5p', 4, 'kEwVYKvKXZC7iqT', NULL, NULL),
(5, '8GLeQZ258L', 5, 'LtpeOh41cq4pUTb', NULL, NULL),
(6, 'qISkJJA6d9', 6, 'hrMz7tCYsyunyry', NULL, NULL),
(7, 'gCN79VGpfB', 7, 'zoPKLHFWbpPMTLm', NULL, NULL),
(8, 'Ypbuc45Zcw', 8, 'pM7ZWyWASuV3BEl', NULL, NULL),
(9, 'XSSgAfSa0h', 9, 'YsHsKF8XjmjIrNP', NULL, NULL),
(10, 'rOrxWDH27V', 10, 'B1VrsSMpMdf3Guv', NULL, NULL),
(11, 'YmtJPNTt1J', 11, 'DkkG6gVrZuCRMGN', NULL, NULL),
(12, 'KDZUA1KhO3', 12, 'MNmTEOcgMHHwlNm', NULL, NULL),
(13, 'tLfAv8yLHV', 13, 'ekaTDFI3nbQCeFY', NULL, NULL),
(14, '6P22yCYExW', 14, 'EkGq4MnIrnWgnUe', NULL, NULL),
(15, 'ltnpd4K8Ya', 15, 'ndhEuqiiObdngVs', NULL, NULL),
(16, 'wG453Q9Lrp', 16, 'p9CTKRxvQNggh0q', NULL, NULL),
(17, 'qpNmiCjZWp', 17, 'pMQAGW1UoXw5edK', NULL, NULL),
(18, 'CCm4Av7zLA', 18, 'Ae15L8SPCo8tg2E', NULL, NULL),
(19, 'zgEGKvMf28', 19, 'y5H8ID7d8Acd8sU', NULL, NULL),
(20, 'TzcJVCX4NI', 20, 'DWPliEVgUfo0jMo', NULL, NULL),
(21, 'AZir42aZjO', 21, '7Sfb0ojwfsiSHmi', NULL, NULL),
(22, '4ZKzkePjYY', 22, 'jcTYgYDOiGzN9f0', NULL, NULL),
(23, 'QcrblLfDgt', 23, 'CKvSUAK92OCCm4p', NULL, NULL),
(24, 'L7Ax6CSeiA', 24, '3g8AeJYGlVF2q72', NULL, NULL),
(25, '7Lg2Q9xXIx', 25, 'UHO4c6NSrWC8chi', NULL, NULL),
(26, '081380062303', 26, NULL, '2018-05-18 07:53:33', '2018-05-18 07:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `id_pl` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `code`, `is_valid`, `id_pl`, `created_at`, `updated_at`) VALUES
(1, 'RAT861', 0, 1, '2018-05-18 07:20:29', '2018-05-18 07:20:29'),
(2, 'AGO447', 0, 2, '2018-05-18 07:27:23', '2018-05-18 07:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_sp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `is_sp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eyde La Croce', 'ela0', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '0', NULL, '2018-05-18 03:44:28', '2018-05-18 03:44:28'),
(2, 'Lyda Symington', 'lsymington1', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '0', NULL, '2018-05-18 03:44:28', '2018-05-18 03:44:28'),
(3, 'Kylynn Danter', 'kdanter2', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '0', NULL, '2018-05-18 03:44:29', '2018-05-18 03:44:29'),
(4, 'Korrie Jodrelle', 'kjodrelle3', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '0', NULL, '2018-05-18 03:44:29', '2018-05-18 03:44:29'),
(5, 'Lambert Rayner', 'lrayner4', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '0', NULL, '2018-05-18 03:44:29', '2018-05-18 03:44:29'),
(6, 'Cornell MacGinley', 'cmacginley5', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', 'Q62jBnbE8FtuAp7gsq84xh40oFkEADcwk9sdwqoq0SXm9FB5GhrRwirnmTlL', '2018-05-18 03:44:29', '2018-05-18 03:44:29'),
(7, 'Valentijn Mauchline', 'vmauchline6', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:29', '2018-05-18 03:44:29'),
(8, 'Rubie Schaben', 'rschaben7', 'U30wq5yHD9', '1', NULL, '2018-05-18 03:44:30', '2018-05-18 03:44:30'),
(9, 'Jock Kewzick', 'jkewzick8', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:30', '2018-05-18 03:44:30'),
(10, 'Thia Brewer', 'tbrewer9', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:30', '2018-05-18 03:44:30'),
(11, 'Giuseppe Gehricke', 'ggehrickea', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:30', '2018-05-18 03:44:30'),
(12, 'Ronny Restorick', 'rrestorickb', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:30', '2018-05-18 03:44:30'),
(13, 'Phebe Smalles', 'psmallesc', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:30', '2018-05-18 03:44:30'),
(14, 'Laetitia Otridge', 'lotridged', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:31', '2018-05-18 03:44:31'),
(15, 'Robbin Simonsson', 'rsimonssone', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:31', '2018-05-18 03:44:31'),
(16, 'Drucy Jowling', 'djowlingf', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:31', '2018-05-18 03:44:31'),
(17, 'Eulalie Heaffey', 'eheaffeyg', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:31', '2018-05-18 03:44:31'),
(18, 'Franchot Scoyles', 'fscoylesh', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:31', '2018-05-18 03:44:31'),
(19, 'Blair Umpleby', 'bumplebyi', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:31', '2018-05-18 03:44:31'),
(20, 'Merola Overton', 'movertonj', '$2y$10$JEeKtJokD6b70.rVtRiqteBWpzArve2XtYAG77YECj8NkpUZxObsS', '1', NULL, '2018-05-18 03:44:32', '2018-05-18 03:44:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_prospect_customer_id_foreign` (`prospect_customer_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_id_act_type_foreign` (`id_act_type`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `branches_level_id_unique` (`level_id`),
  ADD KEY `branches_mgr_user_id_foreign` (`mgr_user_id`),
  ADD KEY `branches_region_level_id_foreign` (`region_level_id`),
  ADD KEY `branches_address_id_foreign` (`address_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_user_commenter`),
  ADD KEY `comments_user_id_sender_foreign` (`user_id_sender`),
  ADD KEY `comments_statistic_id_foreign` (`statistic_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_id_status_condition_foreign` (`id_status_condition`),
  ADD KEY `customers_pic_sp_id_foreign` (`pic_sp_id`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `managers_user_id_unique` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_msg`),
  ADD KEY `messages_user_id_sender_foreign` (`user_id_sender`);

--
-- Indexes for table `message_receiveds`
--
ALTER TABLE `message_receiveds`
  ADD PRIMARY KEY (`id_receive_association`),
  ADD KEY `message_receiveds_user_id_receiver_foreign` (`user_id_receiver`),
  ADD KEY `message_receiveds_id_msg_foreign` (`id_msg`),
  ADD KEY `message_receiveds_sender_id_receiver_foreign` (`sender_id_receiver`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `product_classes`
--
ALTER TABLE `product_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_lists`
--
ALTER TABLE `product_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_lists_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `product_list_assocs`
--
ALTER TABLE `product_list_assocs`
  ADD PRIMARY KEY (`assoc_id`),
  ADD KEY `product_list_assocs_product_list_id_foreign` (`product_list_id`),
  ADD KEY `product_list_assocs_id_ptype_foreign` (`id_ptype`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_types_id_class_foreign` (`id_class`);

--
-- Indexes for table `prospects`
--
ALTER TABLE `prospects`
  ADD UNIQUE KEY `prospects_customer_id_unique` (`customer_id`),
  ADD KEY `prospects_prospect_willingness_id_foreign` (`prospect_willingness_id`),
  ADD KEY `prospects_customer_type_id_foreign` (`customer_type_id`);

--
-- Indexes for table `prospect_willingnesses`
--
ALTER TABLE `prospect_willingnesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_sales_user_id_foreign` (`sales_user_id`),
  ADD KEY `ratings_product_types_id_foreign` (`product_types_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `regions_level_id_unique` (`level_id`),
  ADD KEY `regions_mgr_user_id_foreign` (`mgr_user_id`),
  ADD KEY `regions_address_id_foreign` (`address_id`);

--
-- Indexes for table `salespeople`
--
ALTER TABLE `salespeople`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `salespersons_user_id_unique` (`user_id`),
  ADD KEY `salespersons_branch_level_id_foreign` (`branch_level_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_schedule_type_id_foreign` (`schedule_type_id`),
  ADD KEY `schedules_id_customer_foreign` (`id_customer`),
  ADD KEY `schedules_next_schedule_id_foreign` (`next_schedule_id`),
  ADD KEY `schedules_id_user_sp_foreign` (`id_user_sp`);

--
-- Indexes for table `schedule_types`
--
ALTER TABLE `schedule_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_types_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statistics_id_types_foreign` (`id_types`);

--
-- Indexes for table `statistic_types`
--
ALTER TABLE `statistic_types`
  ADD PRIMARY KEY (`id_types`),
  ADD KEY `statistic_types_id_user_sp_foreign` (`id_user_sp`),
  ADD KEY `statistic_types_id_level_foreign` (`id_level`),
  ADD KEY `statistic_types_id_product_foreign` (`id_product`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_conditions`
--
ALTER TABLE `status_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_conditions_status_id_foreign` (`status_id`);

--
-- Indexes for table `telephones`
--
ALTER TABLE `telephones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telephones_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_id_pl_foreign` (`id_pl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_user_commenter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_msg` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `message_receiveds`
--
ALTER TABLE `message_receiveds`
  MODIFY `id_receive_association` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_classes`
--
ALTER TABLE `product_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_lists`
--
ALTER TABLE `product_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_list_assocs`
--
ALTER TABLE `product_list_assocs`
  MODIFY `assoc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prospect_willingnesses`
--
ALTER TABLE `prospect_willingnesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_types`
--
ALTER TABLE `schedule_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statistic_types`
--
ALTER TABLE `statistic_types`
  MODIFY `id_types` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_conditions`
--
ALTER TABLE `status_conditions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telephones`
--
ALTER TABLE `telephones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_prospect_customer_id_foreign` FOREIGN KEY (`prospect_customer_id`) REFERENCES `prospects` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_id_act_type_foreign` FOREIGN KEY (`id_act_type`) REFERENCES `activity_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `branches_mgr_user_id_foreign` FOREIGN KEY (`mgr_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branches_region_level_id_foreign` FOREIGN KEY (`region_level_id`) REFERENCES `regions` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_statistic_id_foreign` FOREIGN KEY (`statistic_id`) REFERENCES `statistics` (`id`),
  ADD CONSTRAINT `comments_user_id_sender_foreign` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_id_status_condition_foreign` FOREIGN KEY (`id_status_condition`) REFERENCES `status_conditions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_pic_sp_id_foreign` FOREIGN KEY (`pic_sp_id`) REFERENCES `salespeople` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_sender_foreign` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message_receiveds`
--
ALTER TABLE `message_receiveds`
  ADD CONSTRAINT `message_receiveds_id_msg_foreign` FOREIGN KEY (`id_msg`) REFERENCES `messages` (`id_msg`),
  ADD CONSTRAINT `message_receiveds_sender_id_receiver_foreign` FOREIGN KEY (`sender_id_receiver`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_receiveds_user_id_receiver_foreign` FOREIGN KEY (`user_id_receiver`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_lists`
--
ALTER TABLE `product_lists`
  ADD CONSTRAINT `product_lists_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_list_assocs`
--
ALTER TABLE `product_list_assocs`
  ADD CONSTRAINT `product_list_assocs_id_ptype_foreign` FOREIGN KEY (`id_ptype`) REFERENCES `product_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_list_assocs_product_list_id_foreign` FOREIGN KEY (`product_list_id`) REFERENCES `product_lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_types`
--
ALTER TABLE `product_types`
  ADD CONSTRAINT `product_types_id_class_foreign` FOREIGN KEY (`id_class`) REFERENCES `product_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prospects`
--
ALTER TABLE `prospects`
  ADD CONSTRAINT `prospects_customer_type_id_foreign` FOREIGN KEY (`customer_type_id`) REFERENCES `customer_types` (`id`),
  ADD CONSTRAINT `prospects_prospect_willingness_id_foreign` FOREIGN KEY (`prospect_willingness_id`) REFERENCES `prospect_willingnesses` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_product_types_id_foreign` FOREIGN KEY (`product_types_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_sales_user_id_foreign` FOREIGN KEY (`sales_user_id`) REFERENCES `salespeople` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `regions_mgr_user_id_foreign` FOREIGN KEY (`mgr_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salespeople`
--
ALTER TABLE `salespeople`
  ADD CONSTRAINT `salespersons_branch_level_id_foreign` FOREIGN KEY (`branch_level_id`) REFERENCES `branches` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salespersons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_id_user_sp_foreign` FOREIGN KEY (`id_user_sp`) REFERENCES `salespeople` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_next_schedule_id_foreign` FOREIGN KEY (`next_schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_schedule_type_id_foreign` FOREIGN KEY (`schedule_type_id`) REFERENCES `schedule_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_types`
--
ALTER TABLE `schedule_types`
  ADD CONSTRAINT `schedule_types_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_id_types_foreign` FOREIGN KEY (`id_types`) REFERENCES `statistic_types` (`id_types`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `statistic_types`
--
ALTER TABLE `statistic_types`
  ADD CONSTRAINT `statistic_types_id_level_foreign` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `statistic_types_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product_types` (`id`),
  ADD CONSTRAINT `statistic_types_id_user_sp_foreign` FOREIGN KEY (`id_user_sp`) REFERENCES `salespeople` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_conditions`
--
ALTER TABLE `status_conditions`
  ADD CONSTRAINT `status_conditions_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telephones`
--
ALTER TABLE `telephones`
  ADD CONSTRAINT `telephones_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_id_pl_foreign` FOREIGN KEY (`id_pl`) REFERENCES `product_lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
