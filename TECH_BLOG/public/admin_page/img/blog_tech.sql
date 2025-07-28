-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 19, 2025 lúc 03:41 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `blog_tech`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_post` (`user_id`,`post_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
-- Đang đổ dữ liệu cho bảng `categories`
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
(10, 'Tin Tức', 'tin-tuc', 'Tin tức mới', '2025-06-30 08:05:58', '2025-07-19 10:26:13', 2, 1),
(11, 'Computer Vision', 'computer-vision', 'Thị giác máy tính', '2025-06-30 08:05:58', '2025-06-30 08:05:58', 2, 1),
(12, 'Natural Language Processing', 'natural-language-processing', 'Xử lý ngôn ngữ tự nhiên', '2025-06-30 08:05:58', '2025-06-30 08:05:58', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_comment_id` int DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_comment_post` (`post_id`),
  KEY `fk_comment_user` (`user_id`),
  KEY `fk_comment_parent` (`parent_comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `parent_comment_id`, `content`, `created_at`, `updated_at`) VALUES
(3, 25, 3, NULL, 'test', '2025-07-19 03:21:45', '2025-07-19 03:21:45'),
(4, 28, 3, NULL, 'test', '2025-07-19 03:26:42', '2025-07-19 03:26:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `fields`
--

INSERT INTO `fields` (`id`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Công nghệ thông tin', 'cong-nghe-thong-tin', 'Các bài viết về lập trình, phần mềm, phần cứng và công nghệ mới', 1, '2025-06-23 08:03:18', '2025-06-23 08:03:18'),
(2, 'Khoa học', 'khoa-hoc', 'Các bài viết về nghiên cứu khoa học, khám phá và phát minh', 1, '2025-06-23 08:03:18', '2025-06-23 08:03:18'),
(3, 'Xu Hướng', 'Xu-huong', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` enum('image','video','audio','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_by` int NOT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_media_uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `media`
--

INSERT INTO `media` (`id`, `file_url`, `file_type`, `uploaded_by`, `uploaded_at`, `updated_at`) VALUES
(1, 'uploads/cover_python.jpg', 'image', 2, '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(2, 'uploads/ai_presentation.mp4', 'video', 2, '2025-06-23 15:03:19', '2025-06-23 15:03:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'Chào mừng bạn đến với Tech Blog!', 0, '2025-06-23 15:03:19'),
(2, 2, 'Bài viết của bạn đã được duyệt.', 0, '2025-06-23 15:03:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_media_id` int DEFAULT NULL,
  `cover_image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_images` json DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `field_id` bigint UNSIGNED DEFAULT NULL,
  `author_id` int NOT NULL,
  `status` enum('draft','review','published','archived') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
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
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `summary`, `content`, `video_media_id`, `cover_image_url`, `content_images`, `category_id`, `field_id`, `author_id`, `status`, `published_at`, `created_at`, `updated_at`, `view_count`) VALUES
(25, 'Cách dùng ChatGPT để tạo Mind Map và Flowchart', 'cach-dung-chatgpt-tao-mind-map-flowchart', 'Tạo mind map (sơ đồ tư duy) và flowchart (lưu đồ) là phương pháp hiệu quả để tổ chức ý tưởng và trình bày thông tin phức tạp một cách trực quan. Tuy nhiên, việc thực hiện thủ công hoặc dùng các công cụ truyền thống thường gặp nhiều khó khăn, từ tốn thời gian đến giao diện thiếu thân thiện. Trong bài viết này, chúng ta sẽ khám phá cách sử dụng ChatGPT – chatbot AI được sử dụng nhiều nhất hiện tại – để tạo sơ đồ tư duy một cách nhanh chóng và dễ dàng, đồng thời tìm hiểu cách áp dụng tương tự cho flowchart.', 'Những trở ngại khi tạo mind map và flowchart theo cách thông thường\r\nViệc tạo các sơ đồ này theo phương pháp cũ thường đi kèm nhiều khó khăn:\r\n\r\nTốn thời gian: Vẽ tay hay sắp xếp các nhánh trên phần mềm cơ bản đều tốn nhiều công sức, nhất là khi cần chỉnh sửa hoặc thay đổi bố cục.\r\nGiới hạn ở phiên bản miễn phí: Một số công cụ giới hạn các tính năng quan trọng như chia sẻ hay xuất tệp ở bản miễn phí, gây nhiều bất tiện.\r\nKhó cộng tác và đồng bộ: Việc chia sẻ hoặc làm việc nhóm trên các công cụ cũ thường xuyên gặp trục trặc về đồng bộ dữ liệu.\r\nNhững rào cản này vô tình biến việc tạo sơ đồ thành một trải nghiệm mệt mỏi thay vì là một công cụ hỗ trợ tư duy hiệu quả.\r\n\r\nHướng dẫn tạo mind map bằng ChatGPT\r\nHãy cùng thực hiện các bước chi tiết sau để tạo một sơ đồ tư duy về “Nguyên nhân gây biến đổi khí hậu”, tập trung vào các hiện tượng thiên tai và thời tiết cực đoan gần đây.\r\n\r\nBước 1: Chuẩn bị nội dung với ChatGPT\r\n\r\nBạn có thể sử dụng ChatGPT hoặc bất kỳ Chatbot AI nào khác để tạo nhanh dàn ý. Hãy nhập một câu lệnh (prompt) cụ thể, ví dụ:\r\n\r\n“Tôi muốn tạo mind map về chủ đề “các nguyên nhân gây nên biến đổi khí hậu”, các ý lớn là các các thiên tai, thời tiết bất thường hoặc nguy hiểm trong thời gian gần đây, các nhánh nhỏ là các nguyên nhân, tác nhân tạo ra những thiên tai đó”\r\nChatGPT sẽ trả về một dàn ý có cấu trúc và chia theo các nhánh chính như: Nắng nóng kỷ lục, lũ lụt dữ dội,… Và các nhánh nhỏ để bổ trợ cho các ý chính: Hiệu ứng nhà kính, phá rừng đầu nguồn,…\r\n\r\nBước 2: Tạo sơ đồ tư duy bằng Whimsical Diagrams được tích hợp trong GPT \r\n\r\nWhimsical là một công cụ linh hoạt, hỗ trợ hiệu quả cho việc xây dựng sơ đồ tư duy, flowchart, wireframe và quản lý dự án. Nền tảng này sở hữu nhiều ưu điểm vượt trội như:\r\n\r\nGiao diện trực quan: Thiết kế thân thiện, giúp người dùng dễ dàng thao tác và làm quen.\r\nHỗ trợ cộng tác trực tuyến: Cho phép các thành viên trong nhóm hoặc lớp học cùng làm việc và tương tác trên cùng một không gian.\r\nTích hợp với ChatGPT: Tối ưu hóa trải nghiệm người dùng, giúp việc chuyển đổi ý tưởng từ văn bản sang sơ đồ trở nên nhanh chóng và thuận tiện hơn.\r\nĐể bắt đầu, hãy truy cập thư viện GPT ở thanh công cụ bên trái, tìm kiếm với từ khóa “Whimsical Diagrams” và chọn kết quả có biểu tượng màu tím. Sau đó, bạn chỉ cần dán nội dung hoặc dàn ý của mình vào, Whimsical sẽ tự động phân tích và chuyển hóa chúng thành một sơ đồ tư duy hoàn chỉnh.\r\nSau khi sơ đồ được tạo, bạn có thể dễ dàng tùy chỉnh nó. Whimsical sẽ cung cấp cho bạn đường dẫn để chuyển trực tiếp đến giao diện web chính thức, ở đây sẽ cho phép bạn thay đổi kiểu đường nối (cong hoặc thẳng), định dạng văn bản, thêm biểu tượng hoặc màu sắc cho từng nhánh để sơ đồ thêm sinh động. Khi đã hoàn tất, bạn có thể tạo liên kết chia sẻ để gửi cho đồng nghiệp, bạn bè cùng xem hoặc cộng tác chỉnh sửa trong thời gian thực. Bên cạnh sơ đồ tư duy, Whimsical còn cung cấp khả năng tương tự để tạo flowchart một cách trực quan và hiệu quả. \r\nWhimsical là một công cụ trực quan, ứng dụng sức mạnh của AI để biến việc tạo sơ đồ tư duy và lưu đồ từ một nhiệm vụ tường trừng khó khăn mà trở nên dễ dàng hơn bao giờ hết. Bằng cách loại bỏ những rào cản của phương pháp truyền thống, Whimsical cho phép mọi người dùng, dù là sinh viên hay chuyên gia có thêm thời gian để tập trung trọn vẹn vào việc phát triển ý tưởng mà không bị phân tâm bởi các thao tác kỹ thuật.', NULL, 'chatgpt-mindmapthumb.jpg', '[{\"alt\": \"ChatGPT tạo dàn ý mindmap\", \"url\": \"admin_page/img/chatgpt-tao-dan-y-mindmap.jpg\", \"caption\": \"Tạo dàn ý mindmap với ChatGPT\", \"position\": \"middle\"}, {\"alt\": \"Chọn diagram trong GPT\", \"url\": \"admin_page/img/chon-diagram-trong-gpt.jpg\", \"caption\": \"Chọn diagram trong GPT\", \"position\": \"middle\"}, {\"alt\": \"Whimsical tạo mindmap\", \"url\": \"admin_page/img/whimsical-tao-mindmap.jpg\", \"caption\": \"Tạo mindmap với Whimsical\", \"position\": \"middle\"}, {\"alt\": \"Whimsical chỉnh sửa mindmap\", \"url\": \"admin_page/img/whimsical-chinh-sua-mindmap.jpg\", \"caption\": \"Chỉnh sửa mindmap trong Whimsical\", \"position\": \"middle\"}]', 2, 2, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 03:21:40', 1279),
(26, 'Các hãng Android Trung Quốc đang thử nghiệm “Face ID” ẩn dưới màn hình', 'android-trung-quoc-thu-nghiem-face-id-an-duoi-man-hinh', 'Theo một báo cáo gần đây, nhiều nhà sản xuất smartphone Android Trung Quốc đang tiến gần hơn đến việc thương mại hóa công nghệ camera selfie ẩn dưới màn hình tích hợp khả năng nhận diện khuôn mặt 3D. Đây được xem là bước đột phá nhằm cạnh tranh trực tiếp với tính năng Face ID của Apple, hứa hẹn mang đến trải nghiệm màn hình tràn viền thực thụ mà không phải hy sinh bảo mật.', 'Thông tin này được tiết lộ bởi leaker Digital Chat Station trên Weibo. Theo đó, một số hãng điện thoại lớn tại Trung Quốc đang trong giai đoạn thử nghiệm nội bộ các thiết bị sở hữu camera selfie ẩn dưới màn hình có khả năng quét khuôn mặt 3D để xác thực sinh trắc học. Dù chưa có tên nhà sản xuất hay model cụ thể nào được nhắc đến, động thái này cho thấy thế hệ smartphone Android với công nghệ đột phá này có thể sẽ sớm ra mắt.\r\nHiện tại, nhận diện khuôn mặt 3D vẫn là một tính năng cao cấp và khá hiếm hoi trên thị trường Android. Apple vẫn là thương hiệu dẫn đầu với công nghệ Face ID được trang bị liên tục trên các dòng iPhone kể từ iPhone X. Về phía Android, HONOR là một trong số ít những cái tên theo đuổi công nghệ này, với ví dụ gần đây nhất là chiếc HONOR Magic7 Pro.\r\nTrong khi đó, công nghệ camera ẩn dưới màn hình (UD) cũng đã xuất hiện trên một vài sản phẩm, tiêu biểu là các thiết bị đến từ thương hiệu ZTE và nubia, như chiếc Z70S Ultra gần đây. Tuy nhiên, các mẫu máy này chỉ dừng lại ở việc ẩn camera để chụp ảnh, chưa tích hợp các cảm biến phức tạp cho việc quét 3D.\r\n\r\nĐiểm đáng chú ý nhất của báo cáo lần này chính là sự kết hợp của cả hai công nghệ trên. Một chiếc smartphone vừa có màn hình không khiếm khuyết, vừa đảm bảo bảo mật khuôn mặt 3D an toàn là điều mà thị trường chưa từng chứng kiến. Đây sẽ là một cuộc cạnh tranh thú vị để xem thương hiệu nào sẽ là người tiên phong ra mắt sản phẩm hoàn chỉnh đầu tiên, mang đến một giải pháp toàn diện cho người dùng.', NULL, 'Can-canh-nubia-Z70-Ultra-3.jpg', '[{\"alt\": \"Nubia Z70 Ultra 5G\", \"url\": \"Can-canh-nubia-Z70-Ultra-5.jpg\", \"caption\": \"Cận cảnh Nubia Z70 Ultra 5G\"}, {\"alt\": \"Nubia Z70 Ultra 5G\", \"url\": \"Can-canh-nubia-Z70-Ultra-5.jpg\", \"caption\": \"Thiết kế Nubia Z70 Ultra 5G\"}]', 9, 2, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 03:39:34', 893),
(27, 'Manus AI ra mắt ứng dụng cho người dùng hệ điều hành Windows', 'manus-ai-ra-mat-windows-app\r\n\r\n', 'Manus AI vừa chính thức ra mắt ứng dụng dành riêng cho hệ điều hành Windows trên Microsoft Store. Ứng dụng này mang đến một giải pháp toàn diện, giúp người dùng tối ưu hóa công việc, tự động hóa các tác vụ một cách thông minh và quản lý công việc hiệu quả. Không dừng lại ở đó, Manus AI đang ngày càng hoàn thiện với các tính năng mới được cập nhật liên tục, nổi bật là khả năng kết nối với hệ sinh thái Google và công nghệ tạo video từ Veo 3.', 'Các điểm nổi bật và cách cài đặt Manus AI\r\nĐược thiết kế để tích hợp sâu vào hệ điều hành, Manus AI là một công cụ đa năng giúp người dùng làm chủ công việc hàng ngày. Ứng dụng giúp tối ưu hóa và quản lý thời gian một cách liền mạch thông qua các công cụ tự động như lên lịch họp, đặt lời nhắc và sắp xếp thứ tự ưu tiên cho các nhiệm vụ quan trọng.\r\n\r\nĐiểm nổi bật của Manus AI chính là khả năng tự động hóa các tác vụ lặp đi lặp lại. Chẳng hạn, nếu bạn thường xuyên cần cập nhật tin tức mới, ứng dụng có thể tự động truy cập các trang báo và lấy thông tin về ở dạng văn bản, giúp tiết kiệm đáng kể thời gian. Hơn nữa, với giao diện trực quan, Manus AI cho phép người dùng kéo thả để sắp xếp công việc, phối hợp với đội nhóm theo thời gian thực và dễ dàng tích hợp với các phần mềm năng suất phổ biến khác, trở thành trợ thủ đắc lực cho những ai phải quản lý nhiều dự án cùng lúc.\r\nViệc tiếp cận ứng dụng vô cùng thuận tiện. Người dùng chỉ cần truy cập Microsoft Store, tìm kiếm “Manus AI” và tải về hoặc có thể truy cập theo đường dẫn sau. Nhờ được phát hành chính thức qua Microsoft Store, ứng dụng sẽ luôn được tự động cập nhật, đảm bảo hiệu suất tối ưu và bảo mật cao nhất.\r\nSự ra mắt ứng dụng cho hệ điều hành Windows của Manus AI đánh dấu một bước cải tiến mới trong việc đưa công nghệ AI đến gần hơn với người dùng phổ thông. Trong một thế giới mà thời gian là tài sản quý giá, các công cụ AI tự động hóa như thế này sẽ giúp giảm bớt áp lực và nâng cao hiệu quả công việc. Thay vì mất hàng giờ để sắp xếp lịch trình hay xử lý các tác vụ nhàm chán, giờ đây bạn có thể giao phó chúng cho Manus AI để tập trung vào những việc thực sự quan trọng.', NULL, 'manus-desktop-thumb.jpg', '[{\"alt\": \"Manus Desktop Interface\", \"url\": \"manus-desktop.jpg\", \"caption\": \"Giao diện Manus Desktop\"}]', 2, 1, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 02:08:55', 2102),
(28, 'Google ra mắt mô hình Gemini mới, cho phép robot hoạt động thông minh mà không cần Internet', 'google-ra-mat-gemini-robotics-on-device\r\n\r\n', 'Mới đây, Google DeepMind đã chính thức công bố một mô hình trí tuệ nhân tạo đột phá có tên Gemini Robotics On-Device. Công nghệ này cho phép robot thực hiện các tác vụ phức tạp một cách tự chủ, xử lý trực tiếp trên thiết bị mà không cần kết nối mạng.', 'Google ra mắt mô hình Gemini mới\r\nĐược xem là phiên bản nâng cấp từ mô hình Gemini Robotics ra mắt hồi tháng 3, Gemini Robotics On-Device tập trung vào việc điều khiển trực tiếp các chuyển động của robot. Điểm nổi bật là các nhà phát triển có thể sử dụng ngôn ngữ tự nhiên (các câu lệnh thông thường) để điều khiển và tinh chỉnh mô hình cho phù hợp với những nhu cầu cụ thể.\r\nVề hiệu năng, Google tuyên bố mô hình này đạt mức hiệu suất gần như tương đương với phiên bản Gemini Robotics đám mây và vượt trội hơn các mô hình trên thiết bị khác trên thị trường. Trong các buổi trình diễn, Google đã cho thấy robot được trang bị AI này có thể tự thực hiện các công việc khéo léo như kéo khóa túi hay gấp quần áo.\r\n\r\nGoogle nhấn mạnh về tính linh hoạt của mô hình. Mặc dù ban đầu được huấn luyện trên robot ALOHA, nó đã được điều chỉnh thành công để tương thích với robot hai tay Franka FR3 và cả robot hình người Apollo của Apptronik. Thậm chí, robot Franka FR3 còn chứng tỏ khả năng xử lý các tình huống và vật thể hoàn toàn mới, ví dụ như lắp ráp sản phẩm trên dây chuyền công nghiệp.\r\n\r\nĐể hỗ trợ cộng đồng, Google DeepMind cũng phát hành bộ công cụ phát triển phần mềm (SDK) cho Gemini Robotics. Với bộ công cụ này, các nhà phát triển có thể huấn luyện robot thực hiện các tác vụ mới chỉ với khoảng 50 đến 100 lần thao tác mẫu trong môi trường giả lập vật lý MuJoCo.\r\nĐộng thái của Google diễn ra trong bối cảnh cuộc đua phát triển AI cho robot đang ngày càng nóng lên. Không chỉ Google, nhiều thương hiệu công nghệ khác cũng đang tăng tốc trong lĩnh vực này. Theo TechCrunch, NVIDIA đang xây dựng nền tảng cho các mô hình nền tảng dành cho robot hình người, Hugging Face tích cực phát triển các mô hình và bộ dữ liệu mở, trong khi công ty khởi nghiệp RLWRLD của Hàn Quốc cũng đang tập trung tạo ra các mô hình nền tảng cho robot.\r\n\r\nTheo: TechCrunch', NULL, 'Google-ra-mat-mo-hinh-Gemini-moi-cho-phep-robot-hoat-dong-thong-minh-ma-khong-can-Internet.jpg', '[{\"alt\": \"Google Gemini AI Model\", \"url\": \"Google-ra-mat-mo-hinh-Gemini-moi-cho-phep-robot-hoat-dong-thong-minh-ma-khong-can-Internet.jpg\", \"caption\": \"Google ra mắt mô hình Gemini mới cho phép robot hoạt động thông minh mà không cần Internet\"}, {\"alt\": \"Download Gemini AI\", \"url\": \"tai-xuong-7.jpeg\", \"caption\": \"Tải xuống Gemini AI\"}, {\"alt\": \"Google Gemini Robot\", \"url\": \"Google-Gemini-RB.jpeg\", \"caption\": \"Google Gemini Robot\"}]', 2, 2, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 03:26:35', 1561),
(29, 'Sam Altman tiết lộ: Meta dụ nhân tài của OpenAI bằng 100 triệu USD, nhưng không ai rời đi', 'meta-dua-ra-100-trieu-usd-de-thu-hut-nguoi-openai', 'Trong một tập podcast gần đây, Sam Altman, Giám đốc điều hành của OpenAI, đã tiết lộ rằng Meta Platforms Inc. đã đưa ra các khoản tiền thưởng ký hợp đồng lên tới 100 triệu USD cùng với các mức lương hàng năm hấp dẫn nhằm lôi kéo một số nhân viên của OpenAI. Đây được xem là một phần trong cuộc chiến giành nhân tài khốc liệt trong ngành trí tuệ nhân tạo (AI). Tuy nhiên, Sam Altman cho biết không một nhân tài xuất sắc nào của OpenAI chấp nhận những lời mời này, thể hiện sự gắn bó của họ với sứ mệnh của công ty.', 'Meta đang đầu tư mạnh mẽ cho AI\r\nVài năm qua, ngành công nghiệp AI đang phát triển với tốc độ chóng mặt, do đó, các tập đoàn toàn ầu cũng đua nhau phát triển công nghệ tiên tiến và giành lấy lợi thế cạnh tranh. OpenAI luôn dẫn đầu cuộc đua này nhờ thu hút được những tài năng xuất sắc với sứ mệnh đảm bảo trí tuệ nhân tạo tổng quát (AGI) mang lại lợi ích cho toàn nhân loại. Trong khi đó, các gã khổng lồ công nghệ khác như Meta cũng đang đầu tư mạnh mẽ vào năng lực AI, dẫn đến một cuộc chiến nhân tài ngày càng gay gắt. Những nỗ lực gần đây của Meta, bao gồm khoản đầu tư hàng tỷ USD vào Scale AI và việc chiêu mộ CEO Alexandr Wang, cho thấy quyết tâm của họ trong việc củng cố đội ngũ AI.\r\n\r\nTrong tập podcast Uncapped with Jack Altman, phát sóng vào ngày 17 tháng 6 vừa qua, Sam Altman đã công khai chiến lược tuyển dụng của Meta. Ông tiết lộ rằng Meta đã đưa ra các khoản tiền thưởng ký hợp đồng lên tới 100 triệu USD cùng với mức lương hàng năm lớn nhằm xây dựng một đội ngũ AI hàng đầu, tập trung vào nhóm nghiên cứu “siêu trí tuệ”. Dù những ưu đãi tài chính này rất hấp dẫn, Sam Altman khẳng định: “Không một ai trong số những người giỏi nhất của chúng tôi quyết định gia nhập Meta”. Điều này cho thấy sự trung thành của đội ngũ OpenAI với sứ mệnh và văn hóa của công ty.\r\nLời phát biểu của Sam Altman cho thấy OpenAI có một chiến lược giữ chân nhân tài mạnh mẽ, khi các nhân viên đặt giá trị của sứ mệnh và di sản công ty lên trên lợi ích tài chính. Ông bày tỏ sự tự tin vào định hướng của OpenAI, nói rằng nhân viên “nhìn vào hai con đường và nhận ra OpenAI có cơ hội tốt hơn để phát triển siêu trí tuệ và có thể trở thành công ty giá trị hơn trong tương lai”. Điều này cho thấy đội ngũ OpenAI bị thúc đẩy bởi khát vọng đóng góp vào những bước tiến đột phá trong AI, thay vì chạy theo lợi ích ngắn hạn.\r\n\r\nSam Altman cũng chỉ trích cách tiếp cận của Meta, cho rằng việc tập trung vào các khoản tiền thưởng lớn có thể làm suy yếu văn hóa và khả năng sáng tạo của công ty. Quan điểm này được một số nhân vật khác trong ngành AI, như Aravind Srinivas từ Perplexity và Naveen Rao từ Databricks, ủng hộ. Họ nhấn mạnh rằng ngoài tiền bạc, các công ty cần cung cấp mục tiêu rõ ràng và môi trường sáng tạo để thu hút và giữ chân nhân tài.', NULL, 'sam-altman-thumb.jpg', '[]', 10, 3, 1, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 10:30:28', 981),
(30, 'Veo 3 đang gây sốt với video AI siêu thực đến khó tin \r\n', 'nhung-video-ai-sieu-thuc-den-kho-tin-cua-veo-3', 'Hãy tưởng tượng bạn đang xem một video chân thực đến mức không thể phân biệt được ...', 'Hãy tưởng tượng bạn đang xem một video chân thực đến mức không thể phân biệt được đó là sản phẩm của con người hay trí tuệ nhân tạo. Đó chính là tiềm năng mà Veo 3, công cụ tạo video AI tiên tiến từ Google DeepMind mang lại. Được công bố tại sự kiện Google I/O 2025, Veo 3 không chỉ tạo ra những thước phim chất lượng cao mà còn tích hợp âm thanh đồng bộ một cách ấn tượng, từ lời thoại, hiệu ứng âm thanh cho đến nhạc nền. Hiện đã người dùng tại Mỹ đã có thể đăng ký thông qua gói Google AI Ultra với chi phí 249,99 USD/tháng, Veo 3 hứa hẹn mở ra một kỷ nguyên mới cho ngành sáng tạo nội dung video.\r\n\r\nVeo 3 thể hiện sự vượt trội so với các mô hình AI tạo video trước đó như Sora của OpenAI, đặc biệt ở khả năng tích hợp âm thanh một cách liền mạch. Trong khi Sora chủ yếu tập trung vào hình ảnh, Veo 3 tiến một bước xa hơn bằng cách tạo ra trải nghiệm nghe nhìn toàn diện, khiến các sản phẩm gần như rất khó để phân biệt khi so với video do con người thực hiện. Đây là một bước tiến quan trọng, cho thấy AI không chỉ có khả năng tái tạo hình ảnh mà còn mô phỏng cả thế giới âm thanh, làm mờ đi ranh giới giữa thực tế và hư cấu.\r\nVeo 3 có khả năng tạo video với độ phân giải cao, mang lại hình ảnh sắc nét, chi tiết, đồng thời đảm bảo âm thanh khớp hoàn hảo với chuyển động môi của nhân vật, giúp các cảnh hội thoại trở nên tự nhiên và sống động hơn. Các chuyển động trong video do Veo 3 tạo ra đều rất thực tế, từ cách nhân vật di chuyển đến sự tương tác với môi trường xung quanh, tất cả đều tuân theo các quy luật vật lý tự nhiên. Đặc biệt, Veo 3 có khả năng diễn giải và thực hiện những yêu cầu (prompt) phức tạp, biến các mô tả chi tiết thành những thước phim sống động mà không gặp phải những lỗi nghiêm trọng thường thấy ở các mô hình khác.\r\nMặc dù sở hữu sức mạnh vượt trội, Veo 3 cũng làm dấy lên không ít tranh cãi. Tính chân thực đến kinh ngạc của các video do AI tạo ra gây lo ngại về khả năng phân biệt thật giả, tiềm ẩn nguy cơ lan truyền thông tin sai lệch nếu không được kiểm soát và dán nhãn rõ ràng. Nhiều ý kiến cho rằng cần phải có những quy định cụ thể để đảm bảo tính minh bạch trong việc sử dụng nội dung do AI tạo ra.\r\n\r\nDù vậy, để khai thác tối đa tiềm năng của Veo 3 mà không gây ra những hệ lụy tiêu cực, việc sử dụng công cụ này cần đi đôi với ý thức trách nhiệm cao. Với sự phát triển không ngừng của công nghệ, Veo 3 và các công cụ AI tương tự hứa hẹn sẽ định hình lại cách chúng ta nhìn nhận, tương tác và tiếp nhận nội dung truyền thông trong tương lai không xa.', NULL, 'thumb-veo-3.jpg', '[]', 2, 1, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 09:14:28', 1340),
(31, 'Flutter vs React Native: So sánh cross-platform development', 'flutter-vs-react-native-so-sanh-cross-platform-development', 'Phân tích chi tiết giữa Flutter và React Native...', 'test chức năng chỉnh sửa 1', NULL, 'posts/flutter-react-native.jpg', '[]', 4, 1, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 08:13:23', 1120),
(32, 'Machine Learning với Python: Hướng dẫn cơ bản', 'machine-learning-voi-python-huong-dan-co-ban', 'Hướng dẫn từng bước về machine learning...', 'Nội dung...', NULL, 'posts/ml-python-guide.jpg', '[]', 10, 1, 2, 'published', '2025-06-30 08:06:13', '2025-06-30 08:06:13', '2025-07-19 08:13:23', 1680);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_revisions`
--

DROP TABLE IF EXISTS `post_revisions`;
CREATE TABLE IF NOT EXISTS `post_revisions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `revision_number` int NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `edited_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int DEFAULT NULL,
  `is_pending` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`,`revision_number`),
  KEY `fk_revision_edited_by` (`edited_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_revisions`
--

INSERT INTO `post_revisions` (`id`, `post_id`, `revision_number`, `content`, `edited_at`, `edited_by`, `is_pending`, `is_approved`) VALUES
(3, 31, 1, 'test chức năng chỉnh sửa', '2025-07-07 01:20:11', 2, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `fk_posttag_tag` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(25, 1),
(27, 1),
(31, 1),
(28, 2),
(26, 3),
(29, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'AI', 'ai', '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(2, 'Machine Learning', 'machine-learning', '2025-06-23 15:03:19', '2025-06-23 15:03:19'),
(3, 'XuHuong', 'xuhuong', '2025-06-23 15:03:19', '2025-07-19 10:35:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','author','reader') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'reader',
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name`, `phone_number`, `password_hash`, `display_name`, `bio`, `avatar_url`, `role`, `website`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'adminuser', 'admin@techblog.com', 'Admin', '0123456789', '00c6ee2e21a7548de6260cf72c4f4b5b', 'Admin', 'Tôi là admin', NULL, 'admin', NULL, '2025-06-23 15:03:19', '2025-06-30 03:36:15', '2025-06-30 03:36:15'),
(2, 'johnsmith', 'john@example.com', 'John Smith', '0987654321', '58833651db311ba4bc11cb26b1900b0f', 'John Smith', NULL, NULL, 'author', NULL, '2025-06-23 15:03:19', '2025-07-07 01:21:17', '2025-07-07 01:21:17'),
(3, 'janedoe', 'jane@example.com', 'Jane Doe', '0111222333', '1a4ead8b39d17dfe89418452c9bba770', 'Jane Doe', NULL, NULL, 'reader', NULL, '2025-06-23 15:03:19', '2025-07-19 03:39:34', '2025-07-19 03:39:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_interactions`
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
-- Cấu trúc bảng cho bảng `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `view_count` int DEFAULT '0',
  `last_viewed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_views_post` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `views`
--

INSERT INTO `views` (`id`, `post_id`, `view_count`, `last_viewed_at`) VALUES
(3, 25, 0, NULL),
(4, 25, 0, NULL),
(5, 25, 0, NULL),
(6, 25, 0, NULL),
(7, 25, 0, NULL),
(8, 25, 0, NULL),
(9, 25, 0, NULL),
(10, 25, 0, NULL),
(11, 25, 0, NULL),
(12, 25, 0, NULL),
(13, 25, 0, NULL),
(14, 25, 0, NULL),
(15, 25, 0, NULL),
(16, 25, 0, NULL),
(17, 25, 0, NULL),
(18, 25, 0, NULL),
(19, 25, 0, NULL),
(20, 25, 0, NULL),
(21, 25, 0, NULL),
(22, 25, 0, NULL),
(23, 25, 0, NULL),
(24, 25, 0, NULL),
(25, 25, 0, NULL),
(26, 26, 0, NULL),
(27, 27, 0, NULL),
(28, 27, 0, NULL),
(29, 29, 0, NULL),
(30, 25, 0, NULL),
(31, 25, 0, NULL),
(32, 25, 0, NULL),
(33, 25, 0, NULL),
(34, 25, 0, NULL),
(35, 25, 0, NULL),
(36, 28, 0, NULL),
(37, 26, 0, NULL),
(38, 26, 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visits`
--

DROP TABLE IF EXISTS `visits`;
CREATE TABLE IF NOT EXISTS `visits` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `referer_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` enum('mobile','desktop','tablet') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_ip_address` (`ip_address`),
  KEY `idx_page_url` (`page_url`(250)),
  KEY `idx_created_at` (`created_at`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `visits`
--

INSERT INTO `visits` (`id`, `ip_address`, `user_agent`, `page_url`, `referer_url`, `country`, `city`, `device_type`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0', '/post/1', NULL, 'Vietnam', 'Hanoi', 'desktop', 'Chrome', 'Windows', '2025-06-23 08:03:19', '2025-06-23 08:03:19'),
(2, '192.168.1.1', 'Mozilla/5.0', '/post/2', NULL, 'Vietnam', 'HCM', 'mobile', 'Safari', 'iOS', '2025-06-23 08:03:19', '2025-06-23 08:03:19');

--
-- Bẫy `visits`
--
DROP TRIGGER IF EXISTS `visits_update_timestamp`;
DELIMITER $$
CREATE TRIGGER `visits_update_timestamp` BEFORE UPDATE ON `visits` FOR EACH ROW BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_parent` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_post_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_posts_video_media` FOREIGN KEY (`video_media_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `posts_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`);

--
-- Các ràng buộc cho bảng `post_revisions`
--
ALTER TABLE `post_revisions`
  ADD CONSTRAINT `fk_revision_edited_by` FOREIGN KEY (`edited_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_revision_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Các ràng buộc cho bảng `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `fk_posttag_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posttag_tag` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Các ràng buộc cho bảng `user_interactions`
--
ALTER TABLE `user_interactions`
  ADD CONSTRAINT `fk_ui_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_ui_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `fk_views_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
