-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Apr 2017 pada 08.26
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcsblog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent`, `description`, `created_at`, `updated_at`) VALUES
(1, 'none', 'none', 0, NULL, '2017-03-29 01:07:03', '2017-04-10 22:01:21'),
(40, 'php', 'php', 0, NULL, '2017-04-10 22:05:05', '2017-04-10 22:05:05'),
(41, 'laravel', 'laravel', 0, NULL, '2017-04-10 22:05:13', '2017-04-10 22:05:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `author` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','spam','bin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `ip_address`, `parent_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL, 'Ini adalah comment pertama saya', 'approved', '2017-04-03 05:20:00', '2017-04-11 21:32:35'),
(3, 2, 1, NULL, 1, 'reply comment pertama saya', 'approved', '2017-04-11 21:21:42', '2017-04-11 23:03:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `frontmenus`
--

CREATE TABLE `frontmenus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `href` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` enum('_blank','_self','_parent','_top') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `frontmenus`
--

INSERT INTO `frontmenus` (`id`, `menu_id`, `parent_id`, `page_id`, `name`, `href`, `target`, `title`, `icon`, `module`, `permission`, `sequence`, `created_at`, `updated_at`) VALUES
(21, 'frontmenu.pertama', NULL, NULL, 'Pertama', '#', '_self', 'Page Pertama', 'fa-address-book', 'Frontmenu', 'can_see_page_pertama', 1, '2017-04-07 01:45:33', '2017-04-07 01:45:55'),
(22, 'frontmenu.pertama.kedua', 'frontmenu.pertama', 4, 'Kedua', '/page-kedua', '_self', 'Page Kedua', 'fa-adn', 'Frontmenu', 'can_see_page_kedua', 1, '2017-04-07 01:45:55', '2017-04-07 01:45:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `media`
--

INSERT INTO `media` (`id`, `user_id`, `url`, `title`, `caption`, `alt`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/20170331073329-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-03-31 00:33:29', '2017-03-31 00:33:29'),
(2, 1, 'uploads/20170331073440-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-03-31 00:34:40', '2017-03-31 00:34:40'),
(3, 1, 'uploads/20170331074532-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-03-31 00:45:32', '2017-03-31 00:45:32'),
(4, 1, 'uploads/20170331074602-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-03-31 00:46:02', '2017-03-31 00:46:02'),
(5, 1, 'uploads/20170331074923-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-03-31 00:49:23', '2017-03-31 00:49:23'),
(6, 1, 'uploads/20170403024830-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-04-02 19:48:30', '2017-04-02 19:48:30'),
(7, 1, 'uploads/20170403024847-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-04-02 19:48:47', '2017-04-02 19:48:47'),
(8, 1, 'uploads/20170403025436-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-04-02 19:54:36', '2017-04-02 19:54:36'),
(9, 1, 'uploads/20170403025554-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-04-02 19:55:54', '2017-04-02 19:55:54'),
(10, 1, 'uploads/20170403030002-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-04-02 20:00:02', '2017-04-02 20:00:02'),
(11, 1, 'uploads/20170403030009-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-04-02 20:00:09', '2017-04-02 20:00:09'),
(12, 1, 'uploads/20170403030527-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-04-02 20:05:27', '2017-04-02 20:05:27'),
(13, 1, 'uploads/20170403030535-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-04-02 20:05:35', '2017-04-02 20:05:35'),
(14, 1, 'uploads/20170403030820-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-04-02 20:08:20', '2017-04-02 20:08:20'),
(15, 1, 'uploads/20170405073506-word-icon.png', 'word-icon', NULL, NULL, NULL, '2017-04-05 00:35:06', '2017-04-05 00:35:06'),
(16, 1, 'uploads/20170405075726-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-04-05 00:57:26', '2017-04-05 00:57:26'),
(17, 1, 'uploads/20170405082042-laravel-web-development.png', 'laravel-web-development', NULL, NULL, NULL, '2017-04-05 01:20:42', '2017-04-05 01:20:42'),
(18, 1, 'uploads/20170406022052-laravel-web-development.png', 'laravel-web-development', 'Laravel', 'Laravel', 'Image Laravel', '2017-04-05 19:20:52', '2017-04-05 19:34:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mediameta`
--

CREATE TABLE `mediameta` (
  `id` int(10) UNSIGNED NOT NULL,
  `media_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mediameta`
--

INSERT INTO `mediameta` (`id`, `media_id`, `name`, `type`, `size`, `dimension`, `created_at`, `updated_at`) VALUES
(1, 1, '20170331073329-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-03-31 00:33:30', '2017-03-31 00:33:30'),
(2, 2, '20170331073440-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-03-31 00:34:40', '2017-03-31 00:34:40'),
(3, 3, '20170331074532-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-03-31 00:45:32', '2017-03-31 00:45:32'),
(4, 4, '20170331074602-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-03-31 00:46:02', '2017-03-31 00:46:02'),
(5, 5, '20170331074923-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-03-31 00:49:23', '2017-03-31 00:49:23'),
(6, 6, '20170403024830-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-04-02 19:48:30', '2017-04-02 19:48:30'),
(7, 7, '20170403024847-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-04-02 19:48:47', '2017-04-02 19:48:47'),
(8, 8, '20170403025436-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-04-02 19:54:37', '2017-04-02 19:54:37'),
(9, 9, '20170403025554-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-04-02 19:55:55', '2017-04-02 19:55:55'),
(10, 10, '20170403030002-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-04-02 20:00:02', '2017-04-02 20:00:02'),
(11, 11, '20170403030009-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-04-02 20:00:09', '2017-04-02 20:00:09'),
(12, 12, '20170403030527-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-04-02 20:05:27', '2017-04-02 20:05:27'),
(13, 13, '20170403030535-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-04-02 20:05:35', '2017-04-02 20:05:35'),
(14, 14, '20170403030820-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-04-02 20:08:20', '2017-04-02 20:08:20'),
(15, 15, '20170405073506-word-icon.png', 'image/png', '3.738 KB', '256 x 256', '2017-04-05 00:35:06', '2017-04-05 00:35:06'),
(16, 16, '20170405075726-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-04-05 00:57:26', '2017-04-05 00:57:26'),
(17, 17, '20170405082042-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-04-05 01:20:42', '2017-04-05 01:20:42'),
(18, 18, '20170406022052-laravel-web-development.png', 'image/png', '33.367 KB', '750 x 346', '2017-04-05 19:20:52', '2017-04-05 19:20:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `href` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `parent_id`, `name`, `href`, `target`, `title`, `icon`, `module`, `permission`, `sequence`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.module', '', 'Module', '#', '', 'Module Management', 'fa fa-puzzle-piece', 'Module', 'can_see_module_menu', '99', '2017-03-26 20:41:03', '2017-04-12 23:25:03'),
(2, 'dashboard.module.index', 'dashboard.module', 'Module', 'dashboard/modules', '#', 'Module Management', 'fa fa-puzzle', 'Module', 'can_see_module_index', '1', '2017-03-26 20:41:03', '2017-04-12 23:25:04'),
(3, 'dashboard.setting.role', '', 'Role And Permission', '#', '', 'Role And Permission Management', 'fa fa-lock', 'Role', 'can_see_module_menu', '98', '2017-03-26 20:41:03', '2017-04-12 23:25:04'),
(4, 'dashboard.setting.role.index', 'dashboard.setting.role', 'Role', 'dashboard/settings/role', '#', 'Role Management', 'fa fa-puzzle', 'Role', 'can_see_module_index', '1', '2017-03-26 20:41:03', '2017-04-12 23:25:04'),
(5, 'dashboard.setting.permission.index', 'dashboard.setting.role', 'Permission', 'dashboard/settings/permission', '#', 'Permission Management', 'fa fa-puzzle', 'Role', 'can_see_module_index', '1', '2017-03-26 20:41:03', '2017-04-12 23:25:04'),
(6, 'dashboard.posts', '', 'Posts', '#', '', 'Posts Management', 'fa fa-thumb-tack', 'Posts', 'can_see_posts_menu', '90', '2017-03-27 03:59:15', '2017-04-12 23:25:04'),
(7, 'dashboard.posts.index', 'dashboard.posts', 'All Posts', 'dashboard/posts', '#', 'Posts Management', 'fa fa-puzzle', 'Posts', 'can_see_posts_index', '1', '2017-03-27 03:59:15', '2017-04-12 23:25:04'),
(8, 'dashboard.posts.add', 'dashboard.posts', 'Add New', 'dashboard/posts/add', '#', 'Posts Management', 'fa fa-puzzle', 'Posts', 'can_add_posts', '1', '2017-03-27 03:59:15', '2017-04-12 23:25:04'),
(9, 'dashboard.categories.index', 'dashboard.posts', 'Categories', 'dashboard/categories', '#', 'Posts Management', 'fa fa-puzzle', 'Posts', 'can_see_categories_index', '1', '2017-03-27 03:59:15', '2017-04-12 23:25:04'),
(10, 'dashboard.tags.index', 'dashboard.posts', 'Tags', 'dashboard/tags', '#', 'Posts Management', 'fa fa-puzzle', 'Posts', 'can_see_tags_index', '1', '2017-03-27 03:59:15', '2017-04-12 23:25:04'),
(17, 'dashboard.media', '', 'Media', '#', '', 'Media Management', 'fa fa-image', 'Media', 'can_see_media_menu', '91', '2017-03-30 20:46:43', '2017-04-12 23:25:03'),
(18, 'dashboard.media.index', 'dashboard.media', 'Library', 'dashboard/media', '#', 'Media Management', 'fa fa-puzzle', 'Media', 'can_see_media_index', '1', '2017-03-30 20:46:43', '2017-04-12 23:25:03'),
(19, 'dashboard.media.add', 'dashboard.media', 'Add New', 'dashboard/media/add', '#', 'Media Management', 'fa fa-puzzle', 'Media', 'can_add_media', '1', '2017-03-30 20:46:43', '2017-04-12 23:25:03'),
(20, 'dashboard.pages', '', 'Pages', '#', '', 'Pages Management', 'fa fa-thumb-tack', 'Pages', 'can_see_pages_menu', '92', '2017-04-02 20:32:21', '2017-04-12 23:25:04'),
(21, 'dashboard.pages.index', 'dashboard.pages', 'All Pages', 'dashboard/pages', '#', 'Pages Management', 'fa fa-puzzle', 'Pages', 'can_see_pages_index', '1', '2017-04-02 20:32:22', '2017-04-12 23:25:04'),
(22, 'dashboard.pages.add', 'dashboard.pages', 'Add New', 'dashboard/pages/add', '#', 'Pages Management', 'fa fa-puzzle', 'Pages', 'can_add_pages', '1', '2017-04-02 20:32:22', '2017-04-12 23:25:04'),
(23, 'dashboard.comments', '', 'Comments', 'dashboard/comments', '', 'Comments Management', 'fa fa-comment', 'Comments', 'can_see_comments_menu', '93', '2017-04-02 21:45:45', '2017-04-12 23:25:03'),
(24, 'dashboard.users', '', 'Users', '#', '', 'Users Management', 'fa fa-user-o', 'Users', 'can_see_users_menu', '95', '2017-04-03 01:06:01', '2017-04-12 23:25:04'),
(25, 'dashboard.users.index', 'dashboard.users', 'All Users', 'dashboard/users', '#', 'Users Management', 'fa fa-puzzle', 'Users', 'can_see_users_index', '1', '2017-04-03 01:06:01', '2017-04-12 23:25:04'),
(26, 'dashboard.users.add', 'dashboard.users', 'Add New', 'dashboard/users/add', '#', 'Users Management', 'fa fa-puzzle', 'Users', 'can_add_users', '1', '2017-04-03 01:06:01', '2017-04-12 23:25:04'),
(27, 'dashboard.users.profile', 'dashboard.users', 'Your Profile', 'dashboard/users/profile', '#', 'Users Management', 'fa fa-puzzle', 'Users', 'can_see_users', '1', '2017-04-03 01:06:01', '2017-04-12 23:25:04'),
(28, 'dashboard.appearance', '', 'Appearance', '#', '', 'Appearance Management', 'fa fa-paint-brush', 'Appearance', 'can_see_appearance_menu', '94', '2017-04-05 21:31:06', '2017-04-12 23:25:03'),
(29, 'dashboard.appearance.index', 'dashboard.appearance', 'Themes', 'dashboard/themes', '#', 'Appearance Management', 'fa fa-puzzle', 'Appearance', 'can_see_appearance_themes', '1', '2017-04-05 21:31:07', '2017-04-12 23:25:03'),
(30, 'dashboard.appearance.menus', 'dashboard.appearance', 'Menus', 'dashboard/menus', '#', 'Appearance Management', 'fa fa-puzzle', 'Appearance', 'can_see_appearance_menus', '1', '2017-04-05 21:31:07', '2017-04-12 23:25:03'),
(31, 'dashboard.settings', '', 'Settings', '#', '', 'Settings Management', 'fa fa-cog', 'Settings', 'can_see_settings_menu', '96', '2017-04-12 20:43:23', '2017-04-12 23:25:04'),
(32, 'dashboard.settings.index', 'dashboard.settings', 'General', 'dashboard/settings/general', '#', 'Users Management', 'fa fa-puzzle', 'Settings', 'can_see_settings_index', '1', '2017-04-12 20:43:23', '2017-04-12 23:25:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_24_023932_create_table_modules', 1),
(4, '2017_03_24_023941_create_table_menus', 1),
(5, '2017_03_24_023951_create_table_permissions', 1),
(6, '2017_03_24_084042_entrust_setup_tables', 2),
(8, '2017_03_28_061210_create_table_categories', 3),
(9, '2017_03_28_084639_create_table_tags', 4),
(10, '2017_03_28_091842_add_field_slug_and_parent_at_categories_table', 5),
(17, '2017_03_29_041143_add_field_slug_at_tags_table', 6),
(18, '2017_03_29_041937_create_table_posts', 6),
(19, '2017_03_29_092953_create_table_posts_has_categories', 7),
(20, '2017_03_29_094338_create_table_posts_has_tags', 8),
(22, '2017_03_30_033038_add_field_status_comment_at_posts_table', 9),
(28, '2017_03_31_025654_create_table_media', 10),
(29, '2017_03_31_030408_create_table_mediameta', 10),
(30, '2017_04_03_045005_create_table_comments', 11),
(33, '2017_04_04_032415_create_table_usermeta', 12),
(36, '2017_04_06_093907_create_table_frontmenus', 13),
(37, '2017_04_13_025318_add_field_api_key_at_table_user', 14),
(39, '2017_04_13_031943_create_table_settings', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repository` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`, `keyword`, `version`, `author`, `web`, `repository`, `sequence`, `license`, `module`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Module Management', 'Core module', '["module","system","core"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Module', 'active', '2017-03-26 20:41:03', '2017-03-26 20:41:03'),
(2, 'Role And Permission', 'Role And Permission module', '["Role And Permission"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Role', 'active', '2017-03-26 20:41:03', '2017-03-27 03:31:57'),
(3, 'Posts', 'Posts', '["Posts"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Posts', 'active', '2017-03-27 03:59:15', '2017-03-29 20:01:51'),
(5, 'Media', 'Media', '["Media"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Media', 'active', '2017-03-30 20:46:43', '2017-03-31 02:01:09'),
(6, 'Pages', 'Pages', '["Pages"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Pages', 'active', '2017-04-02 20:32:21', '2017-04-02 21:39:01'),
(7, 'Comments', 'Comments', '["Comments"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Comments', 'active', '2017-04-02 21:45:45', '2017-04-02 22:05:48'),
(8, 'Users', 'Users', '["Users"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Users', 'active', '2017-04-03 01:06:01', '2017-04-03 01:06:07'),
(9, 'Appearance', 'Appearance', '["Appearance"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Appearance', 'active', '2017-04-05 21:31:06', '2017-04-05 21:31:14'),
(10, 'Settings', 'Settings', '["Settings"]', '0.0.1', 'Fazri Maulana', 'facebook.com/fazri.maulana1', 'github.com', '1', 'MIT', 'Settings', 'active', '2017-04-12 20:43:23', '2017-04-12 23:18:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(9, 'can_install_module', 'can_install_module', 'can_install_module', '2017-03-26 20:41:03', '2017-03-26 20:41:03'),
(10, 'can_see_list_module', 'can_see_list_module', 'can_see_list_module', '2017-03-26 20:41:03', '2017-03-26 20:41:03'),
(11, 'can_uninstall_module', 'can_uninstall_module', 'can_uninstall_module', '2017-03-26 20:41:03', '2017-03-26 20:41:03'),
(12, 'can_see_detail_module', 'can_see_detail_module', 'can_see_detail_module', '2017-03-26 20:41:03', '2017-03-26 20:41:03'),
(13, 'can_see_role', 'can_see_role', 'can_see_role', '2017-03-26 20:58:49', '2017-03-26 20:58:49'),
(14, 'can_add_role', 'can_add_role', 'can_add_role', '2017-03-26 20:58:49', '2017-03-26 20:58:49'),
(15, 'can_edit_role', 'can_edit_role', 'can_edit_role', '2017-03-26 20:58:49', '2017-03-26 20:58:49'),
(16, 'can_delete_role', 'can_delete_role', 'can_delete_role', '2017-03-26 20:58:49', '2017-03-26 20:58:49'),
(17, 'can_see_permission', 'can_see_permission', 'can_see_permission', '2017-03-26 20:58:49', '2017-03-26 20:58:49'),
(18, 'can_add_permission', 'can_add_permission', 'can_add_permission', '2017-03-26 20:58:49', '2017-03-26 20:58:49'),
(19, 'can_edit_permission', 'can_edit_permission', 'can_edit_permission', '2017-03-26 20:58:49', '2017-03-26 20:58:49'),
(20, 'can_delete_permission', 'can_delete_permission', 'can_delete_permission', '2017-03-26 20:58:50', '2017-03-26 20:58:50'),
(21, 'can_add_role_users', 'can_add_role_users', 'can_add_role_users', '2017-03-27 01:58:55', '2017-03-27 01:58:55'),
(22, 'can_add_role_permissions', 'can_add_role_permissions', 'can_add_role_permissions', '2017-03-27 02:06:50', '2017-03-27 02:06:50'),
(23, 'can_see_categories', 'can_see_categories', 'can_see_categories', '2017-03-27 23:27:52', '2017-03-27 23:27:52'),
(24, 'can_add_categories', 'can_add_categories', 'can_add_categories', '2017-03-27 23:27:53', '2017-03-27 23:27:53'),
(25, 'can_edit_categories', 'can_edit_categories', 'can_edit_categories', '2017-03-27 23:33:11', '2017-03-27 23:33:11'),
(26, 'can_delete_categories', 'can_delete_categories', 'can_delete_categories', '2017-03-27 23:38:55', '2017-03-27 23:38:55'),
(27, 'can_see_tags', 'can_see_tags', 'can_see_tags', '2017-03-28 01:54:24', '2017-03-28 01:54:24'),
(28, 'can_add_tags', 'can_add_tags', 'can_add_tags', '2017-03-28 01:57:15', '2017-03-28 01:57:15'),
(29, 'can_edit_tags', 'can_edit_tags', 'can_edit_tags', '2017-03-28 02:00:57', '2017-03-28 02:00:57'),
(30, 'can_delete_tags', 'can_delete_tags', 'can_delete_tags', '2017-03-28 02:09:55', '2017-03-28 02:09:55'),
(31, 'can_see_posts', 'can_see_posts', 'can_see_posts', '2017-03-29 00:58:16', '2017-03-29 00:58:16'),
(32, 'can_add_posts', 'can_add_posts', 'can_add_posts', '2017-03-29 00:58:16', '2017-03-29 00:58:16'),
(33, 'can_edit_posts', 'can_edit_posts', 'can_edit_posts', '2017-03-29 19:23:42', '2017-03-29 19:23:42'),
(34, 'can_delete_posts', 'can_delete_posts', 'can_delete_posts', '2017-03-29 20:26:27', '2017-03-29 20:26:27'),
(35, 'can_see_media_index', 'can_see_media_index', 'can_see_media_index', '2017-03-30 20:51:24', '2017-03-30 20:51:24'),
(36, 'can_see_media_menu', 'can_see_media_menu', 'can_see_media_menu', '2017-03-30 20:51:24', '2017-03-30 20:51:24'),
(37, 'can_see_media', 'can_see_media', 'can_see_media', '2017-03-30 20:51:24', '2017-03-30 20:51:24'),
(38, 'can_add_media', 'can_add_media', 'can_add_media', '2017-03-30 20:51:24', '2017-03-30 20:51:24'),
(39, 'can_see_posts_menu', 'can_see_posts_menu', 'can_see_posts_menu', '2017-03-30 20:52:49', '2017-03-30 20:52:49'),
(40, 'can_see_posts_index', 'can_see_posts_index', 'can_see_posts_index', '2017-03-30 20:52:49', '2017-03-30 20:52:49'),
(41, 'can_see_module_menu', 'can_see_module_menu', 'can_see_module_menu', '2017-03-30 20:53:31', '2017-03-30 20:53:31'),
(42, 'can_see_module_index', 'can_see_module_index', 'can_see_module_index', '2017-03-30 20:53:31', '2017-03-30 20:53:31'),
(43, 'can_see_pages_menu', 'can_see_pages_menu', 'can_see_pages_menu', '2017-04-02 23:08:10', '2017-04-02 23:08:10'),
(44, 'can_see_pages_index', 'can_see_pages_index', 'can_see_pages_index', '2017-04-02 23:08:10', '2017-04-02 23:08:10'),
(45, 'can_see_pages', 'can_see_pages', 'can_see_pages', '2017-04-02 23:08:10', '2017-04-02 23:08:10'),
(46, 'can_add_pages', 'can_add_pages', 'can_add_pages', '2017-04-02 23:08:10', '2017-04-02 23:08:10'),
(47, 'can_edit_pages', 'can_edit_pages', 'can_edit_pages', '2017-04-02 23:08:11', '2017-04-02 23:08:11'),
(48, 'can_delete_pages', 'can_delete_pages', 'can_delete_pages', '2017-04-02 23:08:11', '2017-04-02 23:08:11'),
(49, 'can_see_users_menu', 'can_see_users_menu', 'can_see_users_menu', '2017-04-03 21:25:55', '2017-04-03 21:25:55'),
(50, 'can_see_users_index', 'can_see_users_index', 'can_see_users_index', '2017-04-03 21:25:55', '2017-04-03 21:25:55'),
(51, 'can_see_users', 'can_see_users', 'can_see_users', '2017-04-03 21:25:55', '2017-04-03 21:25:55'),
(52, 'can_add_users', 'can_add_users', 'can_add_users', '2017-04-03 21:25:55', '2017-04-03 21:25:55'),
(53, 'can_edit_users', 'can_edit_users', 'can_edit_users', '2017-04-03 22:01:53', '2017-04-03 22:01:53'),
(54, 'can_edit_users_password', 'can_edit_users_password', 'can_edit_users_password', '2017-04-04 00:27:13', '2017-04-04 00:27:13'),
(55, 'can_see_comments', 'can_see_comments', 'can_see_comments', '2017-04-11 21:21:29', '2017-04-11 21:21:29'),
(56, 'can_edit_comments', 'can_edit_comments', 'can_edit_comments', '2017-04-11 21:21:29', '2017-04-11 21:21:29'),
(57, 'can_reply_comments', 'can_reply_comments', 'can_reply_comments', '2017-04-11 21:21:29', '2017-04-11 21:21:29'),
(58, 'can_see_appearance_menus', 'can_see_appearance_menus', 'can_see_appearance_menus', '2017-04-12 22:55:52', '2017-04-12 22:55:52'),
(59, 'can_add_appearance_menus', 'can_add_appearance_menus', 'can_add_appearance_menus', '2017-04-12 22:55:52', '2017-04-12 22:55:52'),
(60, 'can_edit_appearance_menus', 'can_edit_appearance_menus', 'can_edit_appearance_menus', '2017-04-12 22:55:52', '2017-04-12 22:55:52'),
(61, 'can_delete_appearance_menus', 'can_delete_appearance_menus', 'can_delete_appearance_menus', '2017-04-12 22:55:52', '2017-04-12 22:55:52'),
(62, 'can_see_appearance_themes', 'can_see_appearance_themes', 'can_see_appearance_themes', '2017-04-12 22:56:19', '2017-04-12 22:56:19'),
(63, 'can_edit_media', 'can_edit_media', 'can_edit_media', '2017-04-12 22:57:47', '2017-04-12 22:57:47'),
(64, 'can_see_module', 'can_see_module', 'can_see_module', '2017-04-12 23:01:41', '2017-04-12 23:01:41'),
(65, 'can_active_module', 'can_active_module', 'can_active_module', '2017-04-12 23:01:41', '2017-04-12 23:01:41'),
(66, 'can_inactive_module', 'can_inactive_module', 'can_inactive_module', '2017-04-12 23:01:41', '2017-04-12 23:01:41'),
(67, 'can_see_appearance_menu', 'can_see_appearance_menu', 'can_see_appearance_menu', '2017-04-12 23:04:10', '2017-04-12 23:04:10'),
(68, 'can_see_comments_menu', 'can_see_comments_menu', 'can_see_comments_menu', '2017-04-12 23:08:32', '2017-04-12 23:08:32'),
(69, 'can_see_categories_index', 'can_see_categories_index', 'can_see_categories_index', '2017-04-12 23:08:33', '2017-04-12 23:08:33'),
(70, 'can_see_tags_index', 'can_see_tags_index', 'can_see_tags_index', '2017-04-12 23:08:33', '2017-04-12 23:08:33'),
(71, 'can_see_settings_menu', 'can_see_settings_menu', 'can_see_settings_menu', '2017-04-12 23:08:34', '2017-04-12 23:08:34'),
(72, 'can_see_settings_index', 'can_see_settings_index', 'can_see_settings_index', '2017-04-12 23:08:34', '2017-04-12 23:08:34'),
(73, 'can_see_settings', 'can_see_settings', 'can_see_settings', '2017-04-12 23:08:34', '2017-04-12 23:08:34'),
(74, 'can_delete_users', 'can_delete_users', 'can_delete_users', '2017-04-12 23:08:34', '2017-04-12 23:08:34'),
(75, 'can_edit_users_apikey', 'can_edit_users_apikey', 'can_edit_users_apikey', '2017-04-12 23:08:34', '2017-04-12 23:08:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(9, 9),
(10, 9),
(11, 9),
(12, 9),
(13, 9),
(14, 9),
(15, 9),
(16, 9),
(17, 9),
(18, 9),
(19, 9),
(20, 9),
(21, 9),
(22, 9),
(23, 8),
(23, 9),
(24, 8),
(24, 9),
(25, 8),
(25, 9),
(26, 8),
(26, 9),
(27, 8),
(27, 9),
(28, 8),
(28, 9),
(29, 8),
(29, 9),
(30, 8),
(30, 9),
(31, 5),
(31, 6),
(31, 7),
(31, 8),
(31, 9),
(32, 7),
(32, 8),
(32, 9),
(33, 6),
(33, 7),
(33, 8),
(33, 9),
(34, 6),
(34, 7),
(34, 8),
(34, 9),
(35, 7),
(35, 8),
(35, 9),
(36, 7),
(36, 8),
(36, 9),
(37, 7),
(37, 8),
(37, 9),
(38, 7),
(38, 8),
(38, 9),
(39, 5),
(39, 6),
(39, 7),
(39, 8),
(39, 9),
(40, 5),
(40, 6),
(40, 7),
(40, 8),
(40, 9),
(41, 9),
(42, 9),
(43, 8),
(43, 9),
(44, 8),
(44, 9),
(45, 8),
(45, 9),
(46, 8),
(46, 9),
(47, 8),
(47, 9),
(48, 8),
(48, 9),
(49, 9),
(50, 9),
(51, 9),
(52, 9),
(53, 9),
(54, 9),
(55, 8),
(55, 9),
(56, 8),
(56, 9),
(57, 8),
(57, 9),
(58, 8),
(58, 9),
(59, 8),
(59, 9),
(60, 8),
(60, 9),
(61, 8),
(61, 9),
(62, 8),
(62, 9),
(63, 7),
(63, 8),
(63, 9),
(64, 9),
(65, 9),
(66, 9),
(67, 8),
(67, 9),
(68, 8),
(68, 9),
(69, 8),
(69, 9),
(70, 8),
(70, 9),
(71, 9),
(72, 9),
(73, 9),
(74, 9),
(75, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime NOT NULL,
  `type` enum('post','page') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','draft','trash') COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_comment` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `author`, `title`, `slug`, `content`, `published_at`, `type`, `status`, `visible`, `status_comment`, `image`, `created_at`, `updated_at`) VALUES
(2, 17, 'Post Pertama', 'post-pertama', '<p>Ini adalah content dari post pertama saya</p>', '2017-03-30 03:28:17', 'post', 'published', 'public', 'open', 'uploads/20170330032853-laravel-web-development.png', '2017-03-29 20:28:53', '2017-04-12 23:21:20'),
(3, 1, 'Page Pertama', 'page-pertama', '<p>ini adalah content dari page pertama saya</p>', '2017-04-07 03:19:24', 'page', 'published', 'public', 'open', 'uploads/20170407031954-laravel-web-development.png', '2017-04-06 20:19:54', '2017-04-06 20:19:54'),
(4, 1, 'Page Kedua', 'page-kedua', '<p>ini adalah content dari page kedua saya</p>', '2017-04-07 03:50:15', 'page', 'published', 'private', 'close', 'uploads/20170407035042-word-icon.png', '2017-04-06 20:50:42', '2017-04-06 20:50:42'),
(7, 1, 'Page Ketiga', 'page-ketiga', '<p>ini adalah content dari page ketiga saya</p>', '2017-04-10 04:20:16', 'page', 'published', 'public', 'open', NULL, '2017-04-09 21:20:48', '2017-04-09 21:20:48'),
(8, 1, 'Post Kedua', 'post-kedua', '<p>Ini adalah content dari post kedua</p>', '2017-04-10 05:52:04', 'post', 'published', 'public', 'open', 'uploads/20170410055230-laravel-web-development.png', '2017-04-09 22:52:30', '2017-04-09 22:52:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts_has_categories`
--

CREATE TABLE `posts_has_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts_has_categories`
--

INSERT INTO `posts_has_categories` (`id`, `post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2017-04-06 20:19:54', '2017-04-06 20:19:54'),
(7, 4, 1, '2017-04-06 20:50:42', '2017-04-06 20:50:42'),
(14, 7, 1, '2017-04-09 23:28:33', '2017-04-09 23:28:33'),
(55, 8, 40, '2017-04-10 23:30:33', '2017-04-10 23:30:33'),
(56, 2, 41, '2017-04-10 23:30:46', '2017-04-10 23:30:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts_has_tags`
--

CREATE TABLE `posts_has_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts_has_tags`
--

INSERT INTO `posts_has_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2017-04-06 20:19:54', '2017-04-06 20:19:54'),
(7, 4, 1, '2017-04-06 20:50:42', '2017-04-06 20:50:42'),
(10, 7, 1, '2017-04-09 21:20:48', '2017-04-09 21:20:48'),
(24, 2, 1, '2017-04-10 23:21:47', '2017-04-10 23:21:47'),
(25, 8, 1, '2017-04-10 23:21:47', '2017-04-10 23:21:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'root', 'Root', 'Developer', NULL, '2017-03-27 00:15:24'),
(5, 'subscriber', 'Subscriber', NULL, '2017-03-27 00:13:25', '2017-03-27 00:13:25'),
(6, 'contributor', 'Contributor', NULL, '2017-03-27 00:13:42', '2017-03-27 00:13:42'),
(7, 'author', 'Author', NULL, '2017-03-27 00:13:55', '2017-03-27 00:13:55'),
(8, 'editor', 'Editor', NULL, '2017-03-27 00:14:11', '2017-03-27 00:14:11'),
(9, 'administrator', 'Administrator', NULL, '2017-03-27 00:14:33', '2017-03-27 00:14:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(14, 9),
(15, 7),
(16, 8),
(17, 6),
(18, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `setting_name`, `setting_value`) VALUES
(1, 'site_title', 'Maxindo Content Solution'),
(2, 'tagline', 'Moto situs Anda bisa diletakkan disini'),
(3, 'site_url', '/'),
(4, 'home_url', '/home'),
(5, 'email_address', 'fm.fazri.m@gmail.com'),
(6, 'membership', 'true'),
(7, 'default_role', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'none', 'none', NULL, '2017-03-29 01:08:19', '2017-04-10 22:01:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usermeta`
--

CREATE TABLE `usermeta` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `usermeta`
--

INSERT INTO `usermeta` (`id`, `user_id`, `display_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(5, 1, 'Fazri', NULL, NULL, NULL, '2017-04-04 21:05:50'),
(11, 14, 'Admin', NULL, 'uploads/20170413054902-laravel-web-development.png', '2017-04-12 22:49:02', '2017-04-12 22:49:02'),
(12, 15, 'Author', NULL, 'uploads/20170413054946-laravel-web-development.png', '2017-04-12 22:49:46', '2017-04-12 22:49:46'),
(13, 16, 'Editor', NULL, 'uploads/20170413055026-laravel-web-development.png', '2017-04-12 22:50:26', '2017-04-12 22:50:26'),
(14, 17, 'Contributor', NULL, 'uploads/20170413055110-laravel-web-development.png', '2017-04-12 22:51:10', '2017-04-12 22:51:10'),
(15, 18, 'Subscriber', NULL, 'uploads/20170413055146-laravel-web-development.png', '2017-04-12 22:51:46', '2017-04-12 22:51:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `api_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fazri Maulana', 'fm.fazri.m@gmail.com', '$2y$10$cOgHb1ml0hw.HLtjdHdZeuN4jI4ZO7tYU/0mUrYwg9N6blrsH1rTK', 'b72df741abddbb88f2c7ea7fc73f7790', 'Ul13W1bzc2zRzE73PZa6vZ4Ku9bo8A0M3YDt8BosjOJj9uVYAezC2pfuBacW', '2017-03-24 02:38:54', '2017-04-12 22:39:07'),
(14, 'Administrator', 'admin@gmail.com', '$2y$10$TjJnHtpjHBXTq9RpYbt8ZevPSn6mqVvZ9T0aRfHV5A0W8ogkwLFhO', '22aac6ad8e7f694dcfce30ed8703a539', 'BSRXxz1tVFVXSONlnSWcxQqV1PWEOHz2EEpOt368N3oNaVaT7eNgkqY756j9', '2017-04-12 22:49:02', '2017-04-12 22:49:02'),
(15, 'Author', 'author@gmail.com', '$2y$10$6WhSIGObNpiD6CGSzYp5dOmEMXlm8pNQ.4ys6pJ9ItFekofa7IIDy', '8694c9aff7dc56d0d16cb9ecdd114fce', 'a1H04AKBvqHxOBGctlh4rtvks1V4pNOCfpiZ8wf5JT0Is3C43Ru5XqGYZWNU', '2017-04-12 22:49:46', '2017-04-12 22:49:46'),
(16, 'Editor', 'editor@gmail.com', '$2y$10$6K7cdb3qKJ27ewFpp6K7n./Yzd9AwWIfJDc7cLyHoHTmh6YjTR6mS', 'd74ec6810de93dcd5a5a3e2af8ed963f', 'G5NpH9HuEn67fYBhhuKx0PFdRJ4yRY8miU09KpXibcClJsJNtJLP1Za7gd0a', '2017-04-12 22:50:26', '2017-04-12 22:50:26'),
(17, 'Contributor', 'contributor@gmail.com', '$2y$10$87HLCHchlBGPRdCsruLmeuIMpl1C9KQzVGk1KVKdoQK9UCYQuvf72', '7e385c90c0b993935dc28bfe551c5e14', 'esHz5fr09kRq4X2YEByn8a3CQd2G34B2CKcot45GwrGpGQ1GwshhVTHvx0Aw', '2017-04-12 22:51:10', '2017-04-12 22:51:10'),
(18, 'Subscriber', 'subscriber@gmail.com', '$2y$10$Jhpgw4TCLz7yg4llwYtzj.FxnoYEJ/PAMBk2lPtLa5HjYRlY8NWPS', '6fbb6143d95751cc5629fb3cf3876e14', 'XuzwAT7XATGhbjY1YyytjPyqSrl4awrWplOxjZkHbdaSPcoz7BkcaFNKWWlV', '2017-04-12 22:51:46', '2017-04-12 22:51:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_author_foreign` (`author`);

--
-- Indexes for table `frontmenus`
--
ALTER TABLE `frontmenus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frontmenus_menu_id_unique` (`menu_id`),
  ADD KEY `frontmenus_page_id_foreign` (`page_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

--
-- Indexes for table `mediameta`
--
ALTER TABLE `mediameta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mediameta_media_id_foreign` (`media_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_author_foreign` (`author`);

--
-- Indexes for table `posts_has_categories`
--
ALTER TABLE `posts_has_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_has_categories_post_id_foreign` (`post_id`),
  ADD KEY `posts_has_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `posts_has_tags`
--
ALTER TABLE `posts_has_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_has_tags_post_id_foreign` (`post_id`),
  ADD KEY `posts_has_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_setting_name_unique` (`setting_name`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usermeta`
--
ALTER TABLE `usermeta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usermeta_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `frontmenus`
--
ALTER TABLE `frontmenus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `mediameta`
--
ALTER TABLE `mediameta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `posts_has_categories`
--
ALTER TABLE `posts_has_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `posts_has_tags`
--
ALTER TABLE `posts_has_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usermeta`
--
ALTER TABLE `usermeta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `frontmenus`
--
ALTER TABLE `frontmenus`
  ADD CONSTRAINT `frontmenus_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mediameta`
--
ALTER TABLE `mediameta`
  ADD CONSTRAINT `mediameta_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts_has_categories`
--
ALTER TABLE `posts_has_categories`
  ADD CONSTRAINT `posts_has_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_has_categories_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts_has_tags`
--
ALTER TABLE `posts_has_tags`
  ADD CONSTRAINT `posts_has_tags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_has_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `usermeta`
--
ALTER TABLE `usermeta`
  ADD CONSTRAINT `usermeta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
