-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2025 at 01:42 AM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `parent_id` int DEFAULT NULL,
  `field_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `Fkey_category_field_id` (`field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `parent_id`, `field_id`) VALUES
(1, 'Lập trình', 'lap-trinh', 'Tất cả về lập trình', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(2, 'Trí tuệ nhân tạo', 'tri-tue-nhan-tao', 'Các bài viết về AI', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(3, 'Web Development', 'web-development', 'Phát triển web và frontend technologies', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(4, 'Mobile Development', 'mobile-development', 'Phát triển ứng dụng di động', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(5, 'Database', 'database', 'Cơ sở dữ liệu và quản lý dữ liệu', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(6, 'DevOps', 'devops', 'DevOps và deployment practices', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(7, 'Bảo mật', 'bao-mat', 'Bảo mật thông tin và an ninh mạng', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(8, 'Đánh giá', 'danh-gia', 'Đánh giá sản phẩm công nghệ', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(9, 'Xu hướng', 'xu-huong', 'Xu hướng công nghệ mới nhất', '2025-06-30 08:05:58', '2025-06-30 08:05:58', NULL, 1),
(10, 'Machine Learning', 'machine-learning', 'Học máy và deep learning', '2025-06-30 08:05:58', '2025-06-30 08:05:58', 2, 1),
(11, 'Computer Vision', 'computer-vision', 'Thị giác máy tính', '2025-06-30 08:05:58', '2025-06-30 08:05:58', 2, 1),
(12, 'Natural Language Processing', 'natural-language-processing', 'Xử lý ngôn ngữ tự nhiên', '2025-06-30 08:05:58', '2025-06-30 08:05:58', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_comment_id` int DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_comment_post` (`post_id`),
  KEY `fk_comment_user` (`user_id`),
  KEY `fk_comment_parent` (`parent_comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Công nghệ thông tin', 'cong-nghe-thong-tin', 'Các bài viết về lập trình, phần mềm, phần cứng và công nghệ mới', 1, '2025-06-23 08:03:18', '2025-06-23 08:03:18'),
(2, 'Khoa học', 'khoa-hoc', 'Các bài viết về nghiên cứu khoa học, khám phá và phát minh', 1, '2025-06-23 08:03:18', '2025-06-23 08:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` enum('image','video','audio','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_by` int NOT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_media_uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_url`, `file_type`, `uploaded_by`, `uploaded_at`, `updated_at`) VALUES
(1, 'uploads/cover_python.jpg', 'image', 2, '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(2, 'uploads/ai_presentation.mp4', 'video', 2, '2025-06-23 15:03:19', '2025-06-23 15:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'Chào mừng bạn đến với Tech Blog!', 0, '2025-06-23 15:03:19'),
(2, 2, 'Bài viết của bạn đã được duyệt.', 0, '2025-06-23 15:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_media_id` int DEFAULT NULL,
  `cover_image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `field_id` bigint UNSIGNED DEFAULT NULL,
  `author_id` int NOT NULL,
  `status` enum('draft','review','published','archived') COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `view_count` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `fk_post_author` (`author_id`),
  KEY `fk_post_category` (`category_id`),
  KEY `posts_field_id_foreign` (`field_id`),
  KEY `fk_posts_video_media` (`video_media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `summary`, `content`, `video_media_id`, `cover_image_url`, `category_id`, `field_id`, `author_id`, `status`, `published_at`, `created_at`, `updated_at`, `view_count`) VALUES
(25, 'Laravel 11: Những tính năng mới đáng chú ý', 'laravel-11-nhung-tinh-nang-moi-dang-chu-y', 'Khám phá những tính năng mới trong Laravel 11...', 'Nội dung...', NULL, 'posts/laravel-11.jpg', 1, 1, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-06-30 08:06:13', 1250),
(26, 'React vs Vue: Framework nào phù hợp với dự án của bạn?', 'react-vs-vue-framework-nao-phu-hop-voi-du-an-cua-ban', 'So sánh chi tiết giữa React và Vue.js...', 'Nội dung...', NULL, 'posts/react-vue-comparison.jpg', 3, 1, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-06-30 08:06:13', 890),
(27, 'Top 10 công nghệ AI đáng chú ý năm 2024', 'top-10-cong-nghe-ai-dang-chu-y-nam-2024', 'Tổng hợp những công nghệ AI mới nhất...', 'Nội dung...', NULL, 'posts/ai-trends-2024.jpg', 2, 1, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-06-30 08:06:13', 2100),
(28, 'Hướng dẫn bảo mật website với HTTPS và SSL', 'huong-dan-bao-mat-website-voi-https-va-ssl', 'Cách bảo vệ website của bạn...', 'Nội dung...', NULL, 'posts/https-ssl-guide.jpg', 7, 1, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-06-30 08:06:13', 1560),
(29, 'Docker cho người mới bắt đầu', 'docker-cho-nguoi-moi-bat-dau', 'Hướng dẫn cơ bản về Docker...', 'Nội dung...', NULL, 'posts/docker-basics.jpg', 6, 1, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-06-30 08:06:13', 980),
(30, 'MySQL vs PostgreSQL: So sánh hai hệ quản trị cơ sở dữ liệu phổ biến', 'mysql-vs-postgresql-so-sanh-hai-he-quan-tri-co-so-du-lieu-pho-bien', 'Phân tích chi tiết ưu nhược điểm...', 'Nội dung...', NULL, 'posts/mysql-postgresql.jpg', 5, 1, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-06-30 08:06:13', 1340),
(31, 'Flutter vs React Native: So sánh cross-platform development', 'flutter-vs-react-native-so-sanh-cross-platform-development', 'Phân tích chi tiết giữa Flutter và React Native...', 'test chức năng chỉnh sửa 1', NULL, 'posts/flutter-react-native.jpg', 4, 1, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-07 01:20:11', 1120),
(32, 'Machine Learning với Python: Hướng dẫn cơ bản', 'machine-learning-voi-python-huong-dan-co-ban', 'Hướng dẫn từng bước về machine learning...', 'Nội dung...', NULL, 'posts/ml-python-guide.jpg', 10, 1, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-07 07:45:28', 1680);

-- --------------------------------------------------------

--
-- Table structure for table `post_languages`
--

DROP TABLE IF EXISTS `post_languages`;
CREATE TABLE IF NOT EXISTS `post_languages` (
  `post_id` int NOT NULL,
  `language_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`language_id`),
  KEY `fk_postlang_language` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_revisions`
--

DROP TABLE IF EXISTS `post_revisions`;
CREATE TABLE IF NOT EXISTS `post_revisions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `revision_number` int NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `edited_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int DEFAULT NULL,
  `is_pending` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`,`revision_number`),
  KEY `fk_revision_edited_by` (`edited_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_revisions`
--

INSERT INTO `post_revisions` (`id`, `post_id`, `revision_number`, `content`, `edited_at`, `edited_by`, `is_pending`, `is_approved`) VALUES
(3, 31, 1, 'test chức năng chỉnh sửa', '2025-07-07 01:20:11', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `fk_posttag_tag` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `programming_languages`
--

DROP TABLE IF EXISTS `programming_languages`;
CREATE TABLE IF NOT EXISTS `programming_languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programming_languages`
--

INSERT INTO `programming_languages` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Python', 'python', 'Ngôn ngữ lập trình phổ biến cho AI và phát triển web', '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(2, 'JavaScript', 'javascript', 'Ngôn ngữ lập trình phổ biến cho web frontend và backend', '2025-06-23 15:03:19', '2025-06-23 15:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Tech Blog', '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(2, 'posts_per_page', '10', '2025-06-23 15:03:19', '2025-06-23 15:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'AI', 'ai', '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(2, 'Machine Learning', 'machine-learning', '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(3, 'JavaScript', 'javascript', '2025-06-23 15:03:19', '2025-06-23 15:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','author','reader') COLLATE utf8mb4_unicode_ci DEFAULT 'reader',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name`, `phone_number`, `password_hash`, `display_name`, `bio`, `avatar_url`, `role`, `website`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'adminuser', 'admin@techblog.com', 'Admin', '0123456789', '00c6ee2e21a7548de6260cf72c4f4b5b', 'Admin', 'Tôi là admin', NULL, 'admin', NULL, '2025-06-23 15:03:19', '2025-06-30 03:36:15', '2025-06-30 03:36:15'),
(2, 'johnsmith', 'john@example.com', 'John Smith', '0987654321', '58833651db311ba4bc11cb26b1900b0f', 'John Smith', NULL, NULL, 'author', NULL, '2025-06-23 15:03:19', '2025-07-07 01:21:17', '2025-07-07 01:21:17'),
(3, 'janedoe', 'jane@example.com', 'Jane Doe', '0111222333', '1a4ead8b39d17dfe89418452c9bba770', 'Jane Doe', NULL, NULL, 'reader', NULL, '2025-06-23 15:03:19', '2025-06-30 03:31:19', '2025-06-30 03:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_interactions`
--

DROP TABLE IF EXISTS `user_interactions`;
CREATE TABLE IF NOT EXISTS `user_interactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `liked` tinyint(1) DEFAULT '0',
  `bookmarked` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_ui_user` (`user_id`),
  KEY `fk_ui_post` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `view_count` int DEFAULT '0',
  `last_viewed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_views_post` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
CREATE TABLE IF NOT EXISTS `visits` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referer_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` enum('mobile','desktop','tablet') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_ip_address` (`ip_address`),
  KEY `idx_page_url` (`page_url`),
  KEY `idx_created_at` (`created_at`)
) ;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `ip_address`, `user_agent`, `page_url`, `referer_url`, `country`, `city`, `device_type`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0', '/post/1', NULL, 'Vietnam', 'Hanoi', 'desktop', 'Chrome', 'Windows', '2025-06-23 08:03:19', '2025-06-23 08:03:19'),
(2, '192.168.1.1', 'Mozilla/5.0', '/post/2', NULL, 'Vietnam', 'HCM', 'mobile', 'Safari', 'iOS', '2025-06-23 08:03:19', '2025-06-23 08:03:19');

--
-- Triggers `visits`
--
DROP TRIGGER IF EXISTS `visits_update_timestamp`;
DELIMITER $$
CREATE TRIGGER `visits_update_timestamp` BEFORE UPDATE ON `visits` FOR EACH ROW BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_parent` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_post_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_posts_video_media` FOREIGN KEY (`video_media_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `posts_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`);

--
-- Constraints for table `post_languages`
--
ALTER TABLE `post_languages`
  ADD CONSTRAINT `fk_postlang_language` FOREIGN KEY (`language_id`) REFERENCES `programming_languages` (`id`),
  ADD CONSTRAINT `fk_postlang_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `post_revisions`
--
ALTER TABLE `post_revisions`
  ADD CONSTRAINT `fk_revision_edited_by` FOREIGN KEY (`edited_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_revision_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `fk_posttag_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posttag_tag` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `user_interactions`
--
ALTER TABLE `user_interactions`
  ADD CONSTRAINT `fk_ui_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_ui_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `fk_views_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
