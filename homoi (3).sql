-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 18, 2018 lúc 12:38 PM
-- Phiên bản máy phục vụ: 10.1.31-MariaDB
-- Phiên bản PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `homoi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `estimate`
--

CREATE TABLE `estimate` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_project` int(13) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soluong` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donvi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sotiensv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sotienkhac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `estimate`
--

INSERT INTO `estimate` (`id`, `id_project`, `name`, `soluong`, `donvi`, `sotiensv`, `sotienkhac`, `created_at`, `updated_at`) VALUES
(2, 1, 'Trả lương nhân viên2', '2', '2', '500000', '700000', '2018-05-11 00:43:12', '2018-05-14 19:00:22'),
(4, 1, 'xe máy', '5', 'cái', '600000', '800000', '2018-05-11 01:50:19', '2018-05-11 02:02:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `follow`
--

CREATE TABLE `follow` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_toproject` int(11) DEFAULT NULL,
  `id_touser` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `follow`
--

INSERT INTO `follow` (`id`, `id_user`, `id_toproject`, `id_touser`, `code`, `created_at`, `updated_at`) VALUES
(24, 11, NULL, 10, 'mem', '2018-05-17 00:02:14', '2018-05-17 00:02:14'),
(25, 6, NULL, 10, 'mem', '2018-05-17 00:03:28', '2018-05-17 00:03:28'),
(28, 12, NULL, 10, 'mem', '2018-05-17 00:04:02', '2018-05-17 00:04:02'),
(52, 10, 2, NULL, 'pro', '2018-05-17 01:23:59', '2018-05-17 01:23:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gatekeeper`
--

CREATE TABLE `gatekeeper` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `date_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invest`
--

CREATE TABLE `invest` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `code` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invest`
--

INSERT INTO `invest` (`id`, `id_user`, `id_project`, `code`, `money`, `status`, `created_at`, `updated_at`) VALUES
(26, 13, 2, NULL, 1000000, '2', '2018-05-14 19:53:26', '2018-05-14 19:53:29'),
(27, 13, 1, NULL, 0, '0', '2018-05-14 20:18:38', '2018-05-14 20:18:38'),
(28, 6, 1, NULL, 0, '0', '2018-05-17 00:50:22', '2018-05-17 00:50:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(43, '2014_10_12_000000_create_users_table', 1),
(44, '2018_04_10_032801_reviews', 1),
(45, '2018_04_10_041834_position', 1),
(46, '2018_04_10_042643_report', 1),
(47, '2018_04_11_023143_project', 1),
(48, '2018_04_11_023901_gatekeeper', 1),
(49, '2018_04_11_024101_invest', 1),
(51, '2018_04_11_024603_progress', 1),
(52, '2018_04_11_031247_modul', 1),
(53, '2018_04_11_083332_rule', 2),
(55, '2018_04_20_031533_note', 3),
(56, '2018_04_20_072747_team', 4),
(58, '2018_04_27_033213_question', 5),
(59, '2018_05_03_070838_status', 6),
(60, '2018_05_11_045150_estimate', 7),
(62, '2018_05_17_041706_follow', 8),
(63, '2018_05_18_044105_very', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modul`
--

CREATE TABLE `modul` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vitri` int(13) NOT NULL,
  `id_project` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `modul`
--

INSERT INTO `modul` (`id`, `name`, `vitri`, `id_project`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Thông tin cơ bản', 2, 1, '<p>\r\n\r\n- Hoàn thành website kêu gọi đi bộ <br>- Đã thỏa thuận với 20 phụ xế xe bú đóng dấu dự án trên vé xe bus <br>- Đơn tham gia đăng ký của 400 bạn sinh viên học viện<br></p>', '2018-04-15 21:26:17', '2018-05-06 21:28:03'),
(5, 'fgdfgdfgdfgfhgfhjhg', 1, 1, '<p>342342334x xa</p>', '2018-05-03 00:40:55', '2018-05-06 21:28:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `note`
--

CREATE TABLE `note` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_pick` int(11) DEFAULT NULL,
  `hidden` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `note`
--

INSERT INTO `note` (`id`, `code`, `id_user`, `id_project`, `id_pick`, `hidden`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'moigt', 10, 1, 11, 0, '', '1', '2018-05-10 21:30:31', '2018-05-17 00:25:36'),
(2, 'chuadt', 13, 2, NULL, 0, NULL, '1', '2018-05-14 19:53:29', '2018-05-16 02:17:46'),
(4, 'moisv', 14, 1, 11, 0, '', '1', '2018-05-14 20:00:09', '2018-05-16 02:16:46'),
(6, 'moisv', 14, 2, 11, 0, '', '1', '2018-05-14 23:53:37', '2018-05-16 02:16:46'),
(7, 'moigt', 10, 2, 11, 0, '', '1', '2018-05-14 23:53:48', '2018-05-17 00:25:36'),
(8, 'flmem', 11, 8, 10, 0, 'gatekep1', '1', '2018-05-17 00:25:03', '2018-05-17 20:58:18'),
(9, 'flmem', 6, 8, 10, 0, 'gatekep1', '1', '2018-05-17 00:25:03', '2018-05-17 00:48:22'),
(10, 'flmem', 12, 8, 10, 0, 'gatekep1', '0', '2018-05-17 00:25:03', '2018-05-17 00:25:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `position`
--

CREATE TABLE `position` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(13) NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hidden` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `position`
--

INSERT INTO `position` (`id`, `id_user`, `code`, `name`, `company`, `hidden`, `created_at`, `updated_at`) VALUES
(9, 11, 'cv', 'Quản lý', 'Sen Group', 0, '2018-04-17 03:11:22', '2018-04-17 03:11:22'),
(10, 11, 'th', 'Đại học ABC', '1996-11-11', 0, '2018-05-08 00:57:55', '2018-05-08 00:57:55'),
(12, 11, 'kn', 'chuyên', '', 0, '2018-05-17 02:25:05', '2018-05-17 02:25:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `progress`
--

CREATE TABLE `progress` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_project` int(11) NOT NULL,
  `date` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `progress`
--

INSERT INTO `progress` (`id`, `id_project`, `date`, `content`, `created_at`, `updated_at`) VALUES
(7, 2, '2019-11-11', 'OK1', '2018-05-10 21:19:34', '2018-05-10 21:19:34'),
(8, 2, '2020-12-12', '223', '2018-05-10 21:19:47', '2018-05-10 21:20:12'),
(9, 2, '2018-05-11', '23', '2018-05-10 21:20:33', '2018-05-14 02:29:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project`
--

CREATE TABLE `project` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(510) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_slide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaybatdau` date DEFAULT NULL,
  `ngayketthuc` date DEFAULT NULL,
  `hidden` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `min_money` int(11) DEFAULT NULL,
  `minmoneyplay` int(13) DEFAULT NULL,
  `tag` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thamgia` int(13) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `project`
--

INSERT INTO `project` (`id`, `id_user`, `name`, `avatar`, `banner`, `short_description`, `place`, `video_slide`, `ngaybatdau`, `ngayketthuc`, `hidden`, `money`, `min_money`, `minmoneyplay`, `tag`, `status`, `thamgia`, `created_at`, `updated_at`) VALUES
(1, 11, 'Đạp xe đi ăn cỗ nhà người yêu cũ', '1525233331_koalajpg.jpg', '1525233353_penguinsjpg.jpg', 'Sử dụng xe đạp tự có của sinh viên để thực hiện hoạt động là đi chơi, củ thể là đi ăn cỗ!', 'Hà Nội và các thành phố lân cận.', 'eyFP5s403jY', '0000-01-01', NULL, 0, 9000000, NULL, 2000000, 'đạp xe đạp, vợ người ta, ăn cỗ', '1', 0, '2018-04-15 21:16:17', '2018-05-14 18:58:38'),
(2, 11, 'du an 2', '1524539402_header-doorsjpg.jpg', '1525227804_desertjpg.jpg', 'dự án 2du an 2', '62 chian theang', '', '2018-05-14', '2018-06-16', 0, 2111000, 1000000, NULL, NULL, '2', 0, '2018-04-23 20:10:04', '2018-05-14 02:29:58'),
(5, 10, 'Dự án nào đó', 'logo.png', 'banner.png', '2132', 'Hà nội', '', NULL, NULL, 0, 98000000, NULL, NULL, NULL, '1', NULL, '2018-05-16 23:47:36', '2018-05-16 23:47:36'),
(8, 10, '212', 'logo.png', 'banner.png', '121', '21', '', NULL, NULL, 0, 1, NULL, NULL, NULL, '1', NULL, '2018-05-17 00:25:03', '2018-05-17 00:25:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question`
--

CREATE TABLE `question` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_project` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stt` int(11) DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `question`
--

INSERT INTO `question` (`id`, `id_project`, `code`, `stt`, `answer`, `question`, `created_at`, `updated_at`) VALUES
(2, 1, 'cauhoi', 1, NULL, 'Bạn tên gì?', '2018-05-02 00:32:48', '2018-05-07 23:37:08'),
(3, 1, 'cauhoi', 2, NULL, 'Tên người thân?', '2018-05-02 21:17:26', '2018-05-07 23:37:08'),
(4, 1, 'cauhoi', 3, NULL, 'Số tiền muốn vay?', '2018-05-02 21:17:26', '2018-05-07 23:37:08'),
(5, 1, 'cauhoi', 4, NULL, 'Bạn là sinh viên năm mây?', '2018-05-02 21:17:26', '2018-05-07 23:37:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `report`
--

CREATE TABLE `report` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hidden` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_gatepro` int(13) DEFAULT NULL,
  `skill` int(13) DEFAULT NULL,
  `knowledge` int(13) DEFAULT NULL,
  `attitude` int(13) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leve` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `rate`, `id_user`, `id_project`, `id_gatepro`, `skill`, `knowledge`, `attitude`, `comment`, `leve`, `created_at`, `updated_at`) VALUES
(4, NULL, 12, 2, 11, 3, 2, 5, 'totototoetoeoteot', 'sv', '2018-05-16 03:11:36', '2018-05-16 03:11:36'),
(10, 3, 12, 2, 11, NULL, NULL, NULL, '1212121212121212', 'gate', '2018-05-16 19:07:29', '2018-05-16 19:07:29'),
(11, NULL, 13, 2, 11, NULL, NULL, NULL, '9999', 'ndt', '2018-05-16 19:21:18', '2018-05-16 19:21:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rule`
--

CREATE TABLE `rule` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rule`
--

INSERT INTO `rule` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Editor', NULL, NULL),
(3, 'Censor', NULL, NULL),
(4, 'Analyst', NULL, NULL),
(5, 'Advertisers', NULL, NULL),
(6, 'Doanh nghiệp', NULL, NULL),
(7, 'Gatekeeper', NULL, NULL),
(8, 'Sinh viên', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `status`
--

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Riêng tư', NULL, NULL),
(2, 'Công khai', NULL, NULL),
(3, 'Đang thực hiện', NULL, NULL),
(4, 'Hoàn thành', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `team`
--

CREATE TABLE `team` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_project` int(11) NOT NULL,
  `hidden` int(11) NOT NULL,
  `agree` int(11) DEFAULT NULL,
  `rule` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `team`
--

INSERT INTO `team` (`id`, `id_user`, `id_project`, `hidden`, `agree`, `rule`, `avatar`, `name`, `position`, `created_at`, `updated_at`) VALUES
(43, 10, 1, 0, 1, 'gt', NULL, NULL, NULL, '2018-05-10 21:30:31', '2018-05-10 21:30:31'),
(45, 14, 1, 0, 1, 'sv', NULL, NULL, NULL, '2018-05-14 20:00:09', '2018-05-14 20:04:53'),
(48, 10, 2, 0, 1, 'gt', NULL, NULL, NULL, '2018-05-14 23:53:48', '2018-05-16 23:55:33'),
(49, 12, 2, 0, 1, 'sv', NULL, NULL, NULL, '2018-05-16 23:50:18', '2018-05-16 23:50:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `rule` int(11) NOT NULL,
  `hidden` int(11) NOT NULL,
  `very` int(11) NOT NULL,
  `verymail` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkprofile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cmt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `rule`, `hidden`, `very`, `verymail`, `name`, `avatar`, `linkprofile`, `email`, `password`, `birthday`, `phone`, `address`, `cmt`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 1, 0, 1, 1, 'admin', '1525861979_31957569-447135359070337-8862263019241996288-njpg.jpg', '2321a2sd', 'admin@gmail.com', '$2y$10$x/Akh2Sm5AhvhYJ88VC.BOi5zie4YtcuNT.1mQ6lYO2N42VjZupqC', NULL, '0961354795', 'Hà nội', NULL, '2', 'C9fp7e3YquhTBNw9UeRkD3OIgN8w81UZZDQifYQ4ORevEJ15MekzESrOiD3F', NULL, '2018-05-18 02:54:20'),
(10, 7, 0, 0, NULL, 'gatekep1', 'logo.png', '1523516724', 'shop1@gmail.com', '$2y$10$jEfQeKaR6N0BFizIgHVWmuEmI3Yr6lYx4iL9D8gxlWQloDfhiEQ4a', NULL, '0961354795', 'Hà nội', NULL, '1', 'Z58qgkTup0aU18zLTaGtvlgk99rL5nmrgCZwb5PnAbbZ4nWxYcbNWl7QKYkV', '2018-04-12 00:05:25', '2018-04-12 00:05:25'),
(11, 8, 0, 0, 1, 'sv1', '1526528237_31895391-1722486167787970-6036947271810023424-njpg.jpg', '1523525568', 'minhsiunhonm@gmail.com', '$2y$10$XKH1HSVtw8FnYQrdBZ/z5uXWrjRgLBMFxGOHX8UUYXeUJTMCTU.sW', '1996-11-11', '0961354795', '1', '0595956623', '2', 'lmKm4gwHK9JEqgrXTZgoelthiBKG3ConBjmG1hAMOU1Ng52tUcUtDrFPGns7', '2018-04-12 02:32:49', '2018-05-18 03:34:26'),
(12, 8, 0, 0, NULL, 'sv2', 'logo.png', '1523525639', 'anhntphuyen2@meup68.vn', '$2y$10$SJeCfkM6OLPa2iCbFcexxuELX9HR0yIlE.UU3KEW428/1TMeyBq5.', NULL, '0961354795', 'Hà nội', NULL, '1', '2EkT30ND8jzViCKoAvTrRExFAao5SCznwbziQ0MoOuW6oGtsrTnhz3Yny6hw', '2018-04-12 02:33:59', '2018-04-12 02:33:59'),
(13, 6, 0, 0, NULL, 'doanh nghiep2', 'logo.png', '15235256390', 'anhntphuyen@meup68.vn', '$2y$10$SJeCfkM6OLPa2iCbFcexxuELX9HR0yIlE.UU3KEW428/1TMeyBq5.', NULL, '0961354795', 'Hà nội', NULL, '1', 'f0FZCnRg1zkeMOTOMR2nSlTjwwnBETad72KrJYA4qW5rT3qtWG6xqK09p2uA', '2018-04-12 02:33:59', '2018-04-12 02:33:59'),
(14, 8, 0, 0, NULL, 'sv3', 'logo.png', '1523525565', 'minhminh@gmail.com', '$2y$10$SJeCfkM6OLPa2iCbFcexxuELX9HR0yIlE.UU3KEW428/1TMeyBq5.', '1996-11-11', '0961354795', 'Hà nội', '0595956623', '2', 'j23lioJu3EMZzu30u5dN3cPHJwh8sHSuANw4DbGBtcWisLFziD9X8phKT0Ic', '2018-04-12 02:32:49', '2018-04-26 00:35:37'),
(15, 8, 0, 0, NULL, 'Khang sv', 'logo.png', '1526550319', 'khang@gmail.com', '$2y$10$1YD2BzeV6fpHoYsf.s2.ou5IGTSWi8CDuwtdYaSshcf01rNNxR2WK', NULL, NULL, NULL, NULL, '1', '27JFYr1fYamQKnwS9gM6Vt8M8Ij98xkfozlDOQbAS8N8Zgmn7T9sMuWAkko1', '2018-05-17 02:45:19', '2018-05-17 02:45:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `very`
--

CREATE TABLE `very` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thesv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hdld` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mattruoccmt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matsaucmt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `masothue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `giayphepdkkd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `estimate`
--
ALTER TABLE `estimate`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gatekeeper`
--
ALTER TABLE `gatekeeper`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invest`
--
ALTER TABLE `invest`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `very`
--
ALTER TABLE `very`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `estimate`
--
ALTER TABLE `estimate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `gatekeeper`
--
ALTER TABLE `gatekeeper`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invest`
--
ALTER TABLE `invest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `note`
--
ALTER TABLE `note`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `position`
--
ALTER TABLE `position`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `report`
--
ALTER TABLE `report`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `rule`
--
ALTER TABLE `rule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `team`
--
ALTER TABLE `team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `very`
--
ALTER TABLE `very`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
