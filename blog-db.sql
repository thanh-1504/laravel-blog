-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2025 at 03:18 AM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'MẶT TỐI NGÀNH IT', 'mat-toi-nganh-it', 1, '2025-12-23 22:20:26', '2025-12-23 22:20:26'),
(2, 'DeepSeek', 'deepseek', 2, '2025-12-23 22:49:55', '2025-12-23 22:50:43'),
(3, 'ĐỜI SỐNG', 'doi-song', 3, '2025-12-23 22:59:56', '2025-12-23 22:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_11_143132_create_parent_categories_table', 1),
(6, '2025_12_11_143154_create_categories_table', 1),
(7, '2025_12_17_043222_create_posts_table', 1),
(8, '2025_12_24_062025_add_foreign_keys_to_blog_tables', 2),
(9, '2025_12_24_121630_fix_parent_column_in_categories', 3);

-- --------------------------------------------------------

--
-- Table structure for table `parent_categories`
--

CREATE TABLE `parent_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_categories`
--

INSERT INTO `parent_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'CHUYỆN NGHỀ NGHIỆP', 'chuyen-nghe-nghiep', '2025-12-23 22:19:01', '2025-12-23 22:19:01'),
(2, 'AI HIỆN NAY', 'ai-hien-nay', '2025-12-23 22:49:04', '2025-12-23 22:50:25'),
(3, 'CHUYỆN LINH TINH', 'chuyen-linh-tinh', '2025-12-23 22:59:34', '2025-12-23 22:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `category` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category`, `title`, `slug`, `content`, `featured_image`, `tags`, `visibility`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Tương lai nào cho ngành lập trình 2025?', 'tuong-lai-nao-cho-nganh-lap-trinh-2025', '<p>Thiệt t&igrave;nh th&igrave; dạo n&agrave;y m&igrave;nh đang cảm thấy hơi&nbsp;<strong>bi quan v&agrave; mất niềm tin</strong>&nbsp;v&agrave;o tương lai của c&aacute;i ng&agrave;nh lập tr&igrave;nh m&agrave; anh em m&igrave;nh đang theo đuổi. M&igrave;nh đi l&agrave;m cũng hơn chục năm c&oacute; lẻ rồi, thường th&igrave; m&igrave;nh hay ch&eacute;m gi&oacute; mấy chủ đề lạc quan, vui vẻ, kh&iacute;ch lệ anh em l&agrave; ch&iacute;nh.</p>\r\n\r\n<p>Cũng hong muốn l&agrave;m anh em hoang mang, nhưng m&agrave; đ&ocirc;i khi m&igrave;nh cũng phải&nbsp;<strong>s&aacute;ng mắt ra một ch&uacute;t</strong>, nh&igrave;n thẳng v&agrave;o thực tế phũ ph&agrave;ng của thị trường. N&ecirc;n h&ocirc;m nay, m&igrave;nh xin ph&eacute;p chia sẻ một g&oacute;c nh&igrave;n hơi &ldquo;u &aacute;m&rdquo; một tẹo về ng&agrave;nh m&igrave;nh, l&yacute; do m&igrave;nh thấy lo lo, v&agrave; liệu c&ograve;n ch&uacute;t &aacute;nh s&aacute;ng cuối đường hầm n&agrave;o cho anh em m&igrave;nh kh&ocirc;ng nh&eacute;.</p>\r\n\r\n<p>Đ&acirc;y l&agrave; g&oacute;c nh&igrave;n c&aacute; nh&acirc;n của m&igrave;nh th&ocirc;i nha, dựa tr&ecirc;n những g&igrave; m&igrave;nh quan s&aacute;t v&agrave; trải nghiệm. Anh em c&oacute; thể đồng t&igrave;nh hoặc phản đối, thoải m&aacute;i ha!</p>\r\n\r\n<h2><strong>Mấy nỗi lo kh&ocirc;ng của ri&ecirc;ng ai</strong></h2>\r\n\r\n<h3><strong>1. Thị trường lao động đang hơi &ldquo;ảm đạm&rdquo;</strong></h3>\r\n\r\n<p>C&aacute;i điểm đầu ti&ecirc;n khiến m&igrave;nh thấy hơi r&eacute;n, đ&oacute; l&agrave; thị trường lao động ng&agrave;nh m&igrave;nh dạo n&agrave;y n&oacute;&nbsp;<strong>kh&ocirc;ng c&ograve;n m&agrave;u hồng</strong>&nbsp;như mấy năm trước nữa.</p>\r\n\r\n<ul>\r\n	<li><strong>L&agrave;n s&oacute;ng layoff:</strong>&nbsp;Nghe tin mấy &ocirc;ng lớn như Facebook, Microsoft, Amazon layoff cả mấy ng&agrave;n người v&igrave; &ldquo;performance dưới đ&aacute;y&rdquo; l&agrave; thấy hơi lạnh g&aacute;y rồi. Ngay cả Google, Microsoft, mấy c&aacute;i chỗ xưa nay được coi l&agrave; &ldquo;viện dưỡng l&atilde;o&rdquo; an to&agrave;n, kh&oacute; bị đuổi trừ khi l&agrave;m g&igrave; động trời, giờ cũng siết performance, layoff thường xuy&ecirc;n hơn.</li>\r\n	<li><strong>Cung vượt cầu?:</strong>&nbsp;Lượng developer ra thị trường ng&agrave;y c&agrave;ng đ&ocirc;ng, trong khi nhu cầu tuyển dụng c&oacute; vẻ đang chững lại hoặc giảm đi. Điều n&agrave;y dẫn đến việc&nbsp;<strong>cạnh tranh khốc liệt hơn</strong>, lương lậu cũng kh&ocirc;ng c&ograve;n &ldquo;tr&ecirc;n trời&rdquo; như trước.</li>\r\n	<li><strong>Junior kh&oacute; t&igrave;m việc:</strong>&nbsp;Mấy bạn mới ra trường, fresher giờ&nbsp;<strong>t&igrave;m việc kh&oacute; khăn hơn hẳn</strong>. Cạnh tranh th&igrave; đ&ocirc;ng, c&oacute; khi cả chục người tranh một suất fresher, thậm ch&iacute; phải chấp nhận thực tập kh&ocirc;ng lương.</li>\r\n</ul>\r\n\r\n<p>N&oacute;i chung l&agrave; c&aacute;i thời ho&agrave;ng kim &ldquo;ngồi chơi xơi nước&rdquo; lương ngh&igrave;n đ&ocirc; c&oacute; vẻ đang dần qua rồi anh em ạ.</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost:8000/ufiles/images.jpeg\" style=\"height:225px; width:225px\" /></p>\r\n\r\n<h3><strong>2. AI đang &ldquo;lăm le&rdquo; ch&eacute;n cơm của anh em?</strong></h3>\r\n\r\n<p>C&aacute;i thứ hai c&ograve;n đ&aacute;ng lo hơn, đ&oacute; l&agrave; sự ph&aacute;t triển&nbsp;<strong>nhanh như điện xẹt</strong>&nbsp;của AI, đặc biệt l&agrave; Generative AI (ChatGPT, Copilot, Stable Diffusion&hellip;).</p>\r\n\r\n<h3><strong>3. Thế hệ Junior biết đi đ&acirc;u về đ&acirc;u?</strong></h3>\r\n\r\n<p>Đ&acirc;y ch&iacute;nh l&agrave; c&aacute;i m&igrave;nh lo lắng nhất cho tương lai ng&agrave;nh n&agrave;y.</p>\r\n\r\n<ul>\r\n	<li><strong>AI l&agrave;m tốt hơn Junior?:</strong>&nbsp;Nhiều task đơn giản, AI l&agrave;m c&ograve;n&nbsp;<strong>ngon hơn cả junior</strong>&nbsp;mới v&agrave;o nghề (&iacute;t lỗi hơn, code c&oacute; khi c&ograve;n chuẩn hơn). Vậy c&ocirc;ng ty việc g&igrave; phải tuyển junior về đ&agrave;o tạo cho tốn c&ocirc;ng?</li>\r\n	<li><strong>Cơ hội học hỏi &iacute;t đi:</strong>&nbsp;Khi c&ocirc;ng ty ưu ti&ecirc;n senior + AI, c&aacute;c bạn junior sẽ&nbsp;<strong>&iacute;t c&oacute; cơ hội cọ x&aacute;t</strong>, l&agrave;m việc thực tế, học hỏi kinh nghiệm để m&agrave; leo l&ecirc;n senior được.</li>\r\n	<li><strong>Nguy cơ &ldquo;nghiện&rdquo; AI:</strong>&nbsp;Giống như ng&agrave;y xưa anh em m&igrave;nh qu&aacute; phụ thuộc Google, Stack Overflow, giờ c&aacute;c bạn trẻ c&oacute; nguy cơ&nbsp;<strong>qu&aacute; lệ thuộc v&agrave;o AI</strong>. Cứ prompt cho AI viết code m&agrave; kh&ocirc;ng hiểu bản chất, kh&ocirc;ng tự debug được. Tới l&uacute;c AI &ldquo;ng&aacute;o&rdquo; hoặc gặp b&agrave;i to&aacute;n kh&oacute; AI b&oacute; tay l&agrave; c&aacute;c bạn cũng&hellip; b&oacute; lu&ocirc;n!</li>\r\n</ul>\r\n\r\n<h2><strong>Nhưng khoan! Đừng vội vứt b&agrave;n ph&iacute;m!</strong></h2>\r\n\r\n<p>Nghe m&igrave;nh than thở n&atilde;y giờ chắc anh em tụt mood lắm rồi. Nhưng m&agrave; th&ocirc;i, b&igrave;nh tĩnh, c&aacute;i g&igrave; cũng c&oacute; hai mặt. B&ecirc;n cạnh mấy c&aacute;i đ&aacute;ng lo th&igrave; cũng c&ograve;n v&agrave;i&nbsp;<strong>điểm s&aacute;ng v&agrave; hi vọng</strong>&nbsp;le l&oacute;i:</p>\r\n\r\n<h3><strong>1. AI vẫn c&ograve;n &ldquo;ng&aacute;o&rdquo; v&agrave; cần người &ldquo;dắt&rdquo;</strong></h3>\r\n\r\n<p>C&ocirc;ng nhận AI giờ kh&ocirc;n thật, nhưng n&oacute; vẫn chưa ho&agrave;n hảo 100%.</p>\r\n\r\n<ul>\r\n	<li><strong>Hay &ldquo;tự chế&rdquo; th&ocirc;ng tin:</strong>&nbsp;AI, đặc biệt l&agrave; LLM, vẫn c&ograve;n t&igrave;nh trạng &ldquo;hallucinate&rdquo; &ndash; bịa th&ocirc;ng tin như thật. Code n&oacute; viết ra&nbsp;<strong>vẫn cần người kiểm tra, sửa lỗi, đảm bảo chạy đ&uacute;ng</strong>.</li>\r\n	<li><strong>Thiếu s&oacute;t nhiều kỹ năng:</strong>&nbsp;AI chưa thể thay thế con người ở c&aacute;c mảng cần tư duy phức tạp, s&aacute;ng tạo, v&agrave; đặc biệt l&agrave;&nbsp;<strong>kỹ năng mềm</strong>: giao tiếp với kh&aacute;ch h&agrave;ng, l&agrave;m việc nh&oacute;m, thiết kế hệ thống, giải quyết vấn đề phức tạp&hellip;</li>\r\n	<li><strong>N&oacute; chỉ l&agrave; c&ocirc;ng cụ:</strong>&nbsp;&Iacute;t nhất l&agrave; trong v&agrave;i năm tới, AI vẫn đ&oacute;ng vai tr&ograve; l&agrave;&nbsp;<strong>trợ thủ đắc lực</strong>&nbsp;gi&uacute;p tăng năng suất, chứ chưa thay thế ho&agrave;n to&agrave;n được developer đ&acirc;u</li>\r\n</ul>\r\n\r\n<h2><strong>T&uacute;m c&aacute;i v&aacute;y lại, anh em dev n&ecirc;n l&agrave;m g&igrave;?</strong></h2>\r\n\r\n<p>Ch&eacute;m gi&oacute; n&atilde;y giờ cũng d&agrave;i rồi, t&oacute;m lại l&agrave; tương lai ng&agrave;nh m&igrave;nh đ&uacute;ng l&agrave;&nbsp;<strong>c&oacute; nhiều th&aacute;ch thức</strong>, nhưng kh&ocirc;ng phải l&agrave; hết đường.</p>\r\n\r\n<p>Theo m&igrave;nh th&igrave; anh em dev n&ecirc;n:</p>\r\n\r\n<ol>\r\n	<li><strong>Đừng qu&aacute; hoang mang (&iacute;t nhất l&agrave; trong 5 năm tới):</strong>&nbsp;C&ocirc;ng việc chắc vẫn ổn, nhưng đừng chủ quan.</li>\r\n	<li><strong>Học c&aacute;ch d&ugrave;ng AI hiệu quả:</strong>&nbsp;Coi n&oacute; như một&nbsp;<strong>c&ocirc;ng cụ bắt buộc phải biết</strong>, giống như biết d&ugrave;ng Google hay Git vậy. N&oacute; sẽ gi&uacute;p bạn tăng năng suất v&agrave; kh&ocirc;ng bị tụt hậu.</li>\r\n	<li><strong>N&acirc;ng cấp bản th&acirc;n li&ecirc;n tục:</strong>&nbsp;Tập trung v&agrave;o những kỹ năng m&agrave; AI&nbsp;<strong>kh&oacute; thay thế</strong>:\r\n	<ul>\r\n		<li><em>Tư duy hệ thống, thiết kế architecture.</em></li>\r\n		<li><em>Kỹ năng giải quyết vấn đề phức tạp, debug s&acirc;u.</em></li>\r\n		<li><em>Kỹ năng mềm: giao tiếp, l&agrave;m việc nh&oacute;m, tr&igrave;nh b&agrave;y.</em></li>\r\n		<li><em>Kiến thức chuy&ecirc;n s&acirc;u về một lĩnh vực (domain knowledge).</em></li>\r\n	</ul>\r\n	</li>\r\n	<li><strong>Đừng lệ thuộc ho&agrave;n to&agrave;n v&agrave;o AI:</strong>&nbsp;Lu&ocirc;n&nbsp;<strong>hiểu r&otilde; code AI viết ra</strong>, giữ vững kiến thức nền tảng v&agrave; khả năng tự code, tự debug.</li>\r\n	<li><strong>Mở rộng tư duy:</strong>&nbsp;C&oacute; thể nghĩ đến những hướng đi kh&aacute;c ngo&agrave;i việc chỉ code thuần t&uacute;y, v&iacute; dụ như l&agrave;m BA, PM, hoặc c&aacute;c c&ocirc;ng việc tận dụng AI theo c&aacute;ch s&aacute;ng tạo hơn.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Quảng c&aacute;o nhẹ: Anh em n&agrave;o muốn học b&agrave;i bản về Generative AI th&igrave; ngh&iacute;a qua kh&oacute;a học&nbsp;<a href=\"http://hoccodeai.com/\" rel=\"noreferrer noopener\" target=\"_blank\">hoccodeai.com</a>&nbsp;của m&igrave;nh nha, dạy từ cơ bản tới ứng dụng thực tế, c&oacute; dự &aacute;n để l&agrave;m, c&ograve;n đang giảm gi&aacute; đ&oacute;!</p>', '1766553889_demo.jpg', 'IT', 1, '2025-12-23 22:24:49', '2025-12-24 02:45:28'),
(2, 1, 1, 'Người ta không đánh giá bạn qua kĩ năng, mà đánh giá theo thành tựu', 'nguoi-ta-khong-danh-gia-ban-qua-ki-nang-ma-danh-gia-theo-thanh-tuu', '<p>C&aacute;c anh em mỗi người n&oacute;i 1 kiểu:</p>\r\n\r\n<ul>\r\n	<li>Lương cao, title khủng (Manager, Director) l&agrave; dev th&agrave;nh c&ocirc;ng</li>\r\n	<li>V&agrave;o được c&aacute;c c&ocirc;ng ty lớn, đầu v&agrave;o kh&oacute; (như Google, Netflix, Facebook..) l&agrave; dev giỏi</li>\r\n	<li>X&acirc;y dựng được 1 hệ thống lớn, 1 product xịn &hellip; l&agrave; dev giỏi</li>\r\n	<li>C&oacute; tiếng n&oacute;i, được nhiều anh em trong ng&agrave;nh biết v&agrave; nể&hellip; l&agrave; dev th&agrave;nh c&ocirc;ng</li>\r\n</ul>\r\n\r\n<p>Hmm, nghĩ lại th&igrave; cũng thấy c&oacute; phần đ&uacute;ng. M&agrave; lạ nhỉ, kh&ocirc;ng &ocirc;ng n&agrave;o bảo dev giỏi l&agrave;&nbsp;<a href=\"https://toidicodedao.com/2016/11/24/fight-with-code-the-hien-trinh-do/\">phải code giỏi</a>, phải&nbsp;<strong>giỏi to&aacute;n</strong>, phải&nbsp;<a href=\"https://toidicodedao.com/2016/10/06/hoc-thuat-toan-de-lam-gi/\">thuật to&aacute;n giỏi</a>&nbsp;cả&hellip;</p>\r\n\r\n<p>Nghe n&oacute;i mấy c&aacute;i đấy quan trọng lắm cơ m&agrave;! Tại sao&nbsp;<strong>lạ vậy nhỉ?</strong>&nbsp;C&aacute;c bạn đọc b&agrave;i n&agrave;y sẽ r&otilde; nh&eacute;.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Trường học hay trường đời, cũng đều nh&igrave;n điểm m&agrave; đ&aacute;nh gi&aacute;</strong></h3>\r\n\r\n<p>Thời c&ograve;n học trong trường, c&aacute;c thầy sẽ đ&aacute;nh gi&aacute; khả năng của học sinh&nbsp;<strong>dựa tr&ecirc;n b&agrave;i tập, dựa tr&ecirc;n điểm số</strong>. Khi đi l&agrave;m, kh&ocirc;ng c&ograve;n chấm điểm, người ta sẽ đ&aacute;nh gi&aacute; bạn dựa theo&nbsp;<strong>những g&igrave; m&agrave; bạn show ra</strong>.</p>\r\n\r\n<p>Ngẫm lại, bạn sẽ thấy, những thứ như: Code nhanh, code giỏi, giỏi to&aacute;n, giỏi thuật to&aacute;n, &hellip; tất cả đều l&agrave; khả năng của ch&iacute;nh bạn.</p>\r\n\r\n<p>C&ograve;n những thứ như:&nbsp;<a href=\"https://toidicodedao.com/2017/06/22/tro-thanh-lap-trinh-vien-luong-cao-co-gia/\">lương cao</a>, title khủng, l&agrave;m dev c&ocirc;ng ty lớn,&nbsp;<a href=\"https://toidicodedao.com/2017/08/01/thiet-ke-he-thong-trieu-nguoi-dung-high-scalability/\">x&acirc;y dựng hệ thống bự</a>,&hellip; l&agrave;&nbsp;<strong>th&agrave;nh tựu m&agrave; bạn đạt được</strong>, dựa tr&ecirc;n kĩ năng sẵn c&oacute; của m&igrave;nh.</p>\r\n\r\n<p>Kĩ năng của bạn giỏi hay dở tới đ&acirc;u, chỉ c&oacute; m&igrave;nh bạn biết. Nhưng th&agrave;nh tựu bạn đạt được th&igrave; người ngo&agrave;i ai cũng nh&igrave;n thấy! Do vậy, người ta chỉ đ&aacute;nh gi&aacute; bạn giỏi hay kh&ocirc;ng, bạn th&agrave;nh c&ocirc;ng hay kh&ocirc;ng, dựa tr&ecirc;n&nbsp;<strong>những th&agrave;nh tựu bạn l&agrave;m ra</strong>.</p>\r\n\r\n<h3><strong>Tự tạo ra th&agrave;nh tựu cho m&igrave;nh</strong></h3>\r\n\r\n<p>V&igrave; l&yacute; do đ&oacute;, m&igrave;nh thường hay khuy&ecirc;n c&aacute;c bạn&nbsp;<a href=\"https://toidicodedao.com/2015/07/16/muon-neo-duong-tim-viec-phan-1-viet-cv-ro-rang-va-chuyen-nghiep/\">kh&ocirc;ng n&ecirc;n viết v&agrave;o CV</a>&nbsp;những c&acirc;u như: Th&agrave;nh thạo C, C++; hoặc master ng&ocirc;n ngữ/framework A, B, C&hellip;.</p>\r\n\r\n<p>Những điều n&agrave;y thực sự &hellip;&nbsp;<strong>rất kh&oacute; chứng minh</strong>. Chẳng phải bạn n&oacute;i m&igrave;nh&nbsp;<a href=\"https://toidicodedao.com/tag/javascript-sida/\">th&agrave;nh thạo JavaScript</a>&nbsp;th&igrave; người tuyển dụng sẽ tin ngay được, m&agrave; họ sẽ bắt bạn l&agrave;m test, phỏng vấn&hellip; để chứng minh điều đ&oacute;.</p>\r\n\r\n<p>Thay v&agrave;o đ&oacute;, h&atilde;y&nbsp;<strong>show ra những th&agrave;nh tựu m&agrave; bạn đạt được</strong>, l&agrave;m được dựa tr&ecirc;n những kĩ năng m&igrave;nh c&oacute;. Những thứ n&agrave;y dễ show hơn v&agrave; cũng dễ x&aacute;c nhận hơn:</p>\r\n\r\n<ul>\r\n	<li>Đạt chứng chỉ YYY cho ng&ocirc;n ngữ/ c&ocirc;ng nghệ n&agrave;o đ&oacute;</li>\r\n	<li>Build những&nbsp;<strong>module n&agrave;o quan trọng</strong>&nbsp;trong hệ thống, bằng ng&ocirc;n ngữ XXX</li>\r\n	<li>Thuật to&aacute;n tr&acirc;u n&ecirc;n&nbsp;<strong>account đạt top 1000</strong>&nbsp;tr&ecirc;n hacker*nk hay topcod*r hay g&igrave; đấy</li>\r\n</ul>\r\n\r\n<p>L&uacute;c cần&nbsp;<a href=\"https://toidicodedao.com/2017/06/22/tro-thanh-lap-trinh-vien-luong-cao-co-gia/\">performance review, đ&ograve;i tăng lương</a>&nbsp;cũng vậy. Thay v&igrave; n&oacute;i em giỏi, em c&oacute; khả năng l&agrave;m c&aacute;i n&agrave;y c&aacute;i nọ; h&atilde;y cho sếp/manager thấy&nbsp;<strong>những th&agrave;nh tựu c&aacute;c bạn đ&atilde; đạt được</strong>&nbsp;trong thời gian qua:</p>\r\n\r\n<ul>\r\n	<li>Build được module X, Y, Z mang lại XX% lợi nhuận cho c&ocirc;ng ty</li>\r\n	<li>Review code, tạo CI/CD Pipeline gi&uacute;p tiết kiệm XX% thời gian của c&aacute;c &ocirc;ng dev</li>\r\n	<li>Phỏng vấn, onboarding, mentoring 2,3 bạn, gi&uacute;p mở rộng team v&hellip;v</li>\r\n</ul>\r\n\r\n<p>Nhớ nh&eacute;! Thay v&igrave; n&oacute;i những c&aacute;i chung chung như khả năng, h&atilde;y tập trung v&agrave;o th&agrave;nh tựu, những thứ dễ nh&igrave;n, dễ thấy, dễ kiểm chứng.</p>\r\n\r\n<h3><strong>Đừng buồn hay bực v&igrave; m&igrave;nh &hellip; c&oacute; t&agrave;i m&agrave; kh&ocirc;ng gặp thời</strong></h3>\r\n\r\n<p>M&igrave;nh cũng từng gặp nhiều bạn nghĩ rằng m&igrave;nh&hellip; c&oacute; t&agrave;i m&agrave; kh&ocirc;ng gặp thời:</p>\r\n\r\n<ul>\r\n	<li>Em&nbsp;<strong>giỏi thuật to&aacute;n</strong>&nbsp;hơn thằng H, thằng K, nhưng tụi n&oacute; mới ra trường&nbsp;<a href=\"https://toidicodedao.com/2017/12/14/cam-xuc-tieu-cuc-sinh-vien-lap-trinh-vien/\">lại c&oacute; lương cao hơn em</a></li>\r\n	<li>Em&nbsp;<strong>code nhanh code giỏi</strong>&nbsp;hơn thằng B, thằng M, nhưng sếp lại&nbsp;<a href=\"https://toidicodedao.com/2015/11/19/mat-toi-cua-nganh-cong-nghiep-it-phan-2/\">th&iacute;ch tụi n&oacute; hơn, tụi n&oacute; mau l&ecirc;n chức</a>&nbsp;hơn</li>\r\n	<li>Anh code v&agrave; thiết kế hệ thống rất tr&acirc;u, nhưng sau 4, 5 năm anh vẫn l&agrave;m dev, c&ograve;n bọn bạn anh&nbsp;<a href=\"https://toidicodedao.com/2015/06/18/con-duong-phat-trien-su-nghiep-career-path-cho-developer/\">đ&atilde; l&ecirc;n Manager, l&ecirc;n Director</a>.</li>\r\n</ul>\r\n\r\n<p>Như m&igrave;nh đ&atilde; n&oacute;i, th&agrave;nh tựu thường đi c&ugrave;ng với khả năng. Phải c&oacute; khả năng cao th&igrave; mới c&oacute; th&agrave;nh tựu xuất sắc được.</p>\r\n\r\n<p>Tuy nhi&ecirc;n, điều n&agrave;y&nbsp;<strong>kh&ocirc;ng hẳn l&uacute;c n&agrave;o cũng đ&uacute;ng!</strong>&nbsp;C&aacute;c cụ c&oacute; c&acirc;u l&agrave; &ldquo;Qu&acirc;n tử thất thời, tiểu nh&acirc;n đắc ch&iacute;&rdquo;. Người giỏi cũng c&oacute; l&uacute;c&nbsp;<a href=\"https://toidicodedao.com/2020/11/03/du-an-cong-nghe-thanh-cong-nho-ki-thuat/\">gặp xui n&ecirc;n thất bại</a>, kẻ bất t&agrave;i đ&ocirc;i khi&nbsp;<a href=\"https://toidicodedao.com/2016/07/06/that-bai-va-thanh-cong/\">nhờ may mắn n&ecirc;n th&agrave;nh c&ocirc;ng</a>.</p>\r\n\r\n<h3><strong>Tạm kết</strong></h3>\r\n\r\n<p>Đấy, đến đ&acirc;y th&igrave; b&agrave;i viết cũng d&agrave;i rồi. T&uacute;m c&aacute;i v&aacute;y lại, người đời sẽ kh&ocirc;ng đ&aacute;nh gi&aacute; bạn qua khả năng, m&agrave; chỉ&nbsp;<strong>đ&aacute;nh gi&aacute; bạn qua th&agrave;nh tựu</strong>, qua những điều bạn đ&atilde; đạt được.</p>\r\n\r\n<p>Do vậy, đừng đi gato hay so đo tr&igrave;nh độ với đồng nghiệp:&nbsp; Tao code giỏi hơn, tao học nhanh hơn, trym tao d&agrave;i hơn&hellip; m&agrave; h&atilde;y tạo ra th&agrave;nh tựu, tạo ra sản phẩm cho tụi n&oacute; nể nh&eacute;!</p>', '1766554486_thanhtuu9thang-700x440-1.jpg', 'IT', 1, '2025-12-23 22:34:46', '2025-12-23 22:34:46'),
(3, 1, 1, 'Thành công của một dự án công nghệ đôi khi lại … méo phải nhờ kĩ thuật', 'thanh-cong-cua-mot-du-an-cong-nghe-doi-khi-lai-meo-phai-nho-ki-thuat', '<p>Truyện kể rằng, ng&agrave;y xửa ng&agrave;y xưa, c&oacute; 2 cậu developer rất th&acirc;n t&ecirc;n T&ugrave;ng v&agrave; Sơn. D&ograve;ng đời đưa đẩy, khi ra trường, cả 2 đều đầu qu&acirc;n v&agrave;o&nbsp;<a href=\"https://toidicodedao.com/2019/11/12/toi-di-code-dao-codeaholicguy-lam-bot-con-chimp-startup/\">l&agrave;m cho 2 c&ocirc;ng ty startup</a>.</p>\r\n\r\n<ul>\r\n	<li>Sơn v&agrave;o l&agrave;m cho&nbsp;<strong>TiKu</strong>, một startup nhỏ chuy&ecirc;n b&aacute;n s&aacute;ch, b&aacute;n gi&agrave;y, b&aacute;n quần t&agrave; lỏn. C&ocirc;ng ty nhỏ, cả team chỉ c&oacute; 1 &ocirc;ng senior với v&agrave;i bạn trẻ code. Cả dự &aacute;n l&agrave;&nbsp;<strong>nguy&ecirc;n một cục PHP + MySQL</strong>.</li>\r\n	<li>T&ugrave;ng v&agrave;o l&agrave;m cho&nbsp;<strong>WeFack</strong>, một startup chuy&ecirc;n kết nối ph&ograve;ng chịch với người muốn chịch. C&ocirc;ng ty đ&atilde; gọi vốn được kha kh&aacute;, team to&agrave;n&nbsp;<a href=\"https://toidicodedao.com/2018/08/14/khac-biet-giua-junior-va-senior-developer/\">mấy &ocirc;ng senior hầm hố</a>, d&ugrave;ng đủ c&ocirc;ng nghệ xịn x&ograve; như&nbsp;<a href=\"https://toidicodedao.com/2018/08/28/series-luoc-su-lap-trinh-web-phan-4-2-front-end-web-hien-dai-co-gi-hot/\">React</a>, NodeJS, Kafka, theo kiến tr&uacute;c&nbsp;<a href=\"https://toidicodedao.com/2019/10/08/message-queue-la-gi-ung-dung-microservice/\">microservice</a>.</li>\r\n</ul>\r\n\r\n<p>Những tưởng, với c&ocirc;ng nghệ hiện đại, đội ngũ developer hầm hố, WeFack sẽ ng&agrave;y c&agrave;ng ph&aacute;t triển, c&ograve;n Taka th&igrave; sớm chết yểu.</p>\r\n\r\n<p>Trớ tr&ecirc;u thay, mọi chuyện lại xảy ra ngược lại. 2 năm sau, WeFack phải giải thể, anh em dev phải ra đường Fack dạo, c&ograve;n Tiku th&igrave; gọi được vốn trăm tỷ, c&agrave;ng ng&agrave;y c&agrave;ng lớn mạnh!</p>\r\n\r\n<p>Ủa, sao lạ vậy?? C&aacute;c bạn đọc hết b&agrave;i sẽ r&otilde;.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Trong 1 dự &aacute;n, c&ocirc;ng nghệ c&oacute; quan trọng kh&ocirc;ng?</strong></h3>\r\n\r\n<p>L&agrave; developer, những người trực tiếp x&acirc;y dựng 1 sản phẩm/1 dự &aacute;n, vai tr&ograve; của c&ocirc;ng nghệ, của team developer l&agrave;&nbsp;<strong>cực k&igrave; quan trọng</strong>. Nếu team&nbsp;<strong>dev thiếu tr&igrave;nh độ</strong>, chọn c&ocirc;ng nghệ sai, dự &aacute;n rất kh&oacute; th&agrave;nh c&ocirc;ng:</p>\r\n\r\n<ul>\r\n	<li>Nếu team developer c&ugrave;i bắp, l&agrave;m kh&ocirc;ng được việc =&gt; Sản phẩm sẽ bị bug nhiều, l&acirc;u ra mắt t&iacute;nh năng mới hơn đối thủ</li>\r\n	<li>Nếu chọn c&ocirc;ng nghệ cũ, c&ocirc;ng nghệ lỗi thời =&gt; Kh&oacute; t&igrave;m được developer, kh&oacute; ph&aacute;t triển th&ecirc;m sản phẩm</li>\r\n	<li>Chọn c&ocirc;ng nghệ kh&ocirc;ng scale được, khi lượng người d&ugrave;ng nhiều l&ecirc;n, hệ thống kh&ocirc;ng đ&aacute;p ứng được, sập l&ecirc;n sập xuống =&gt; Người d&ugrave;ng bỏ đi hết</li>\r\n</ul>\r\n\r\n<p>Thế nhưng, ngay cả khi c&oacute; 1 team&nbsp;<a href=\"https://toidicodedao.com/2016/09/29/coder-sieu-nhan/\">dev xịn to&agrave;n si&ecirc;u nh&acirc;n</a>, chọn những c&ocirc;ng nghệ mới nhất, build ra 1 sản phẩm cực k&igrave; ho&agrave;n hảo; th&igrave; sản phẩm đ&oacute; cũng &hellip; chưa chắc đ&atilde; th&agrave;nh c&ocirc;ng!</p>\r\n\r\n<p>Ủa, tại sao vậy? Team dev dỏm th&igrave; sản phẩm bị fail, m&agrave; team dev xịn, c&ocirc;ng nghệ xịn m&agrave; vẫn fail l&agrave; sao??</p>\r\n\r\n<p>V&igrave; 1 l&yacute; do đơn giản? Th&agrave;nh c&ocirc;ng của một dự &aacute;n c&ocirc;ng nghệ đ&ocirc;i khi lại &hellip;&nbsp;<strong>m&eacute;o phải nhờ kĩ thuật</strong>.</p>\r\n\r\n<h3>Chuyện của Sơn &ndash; T&ugrave;ng, TiKu v&agrave; WeFack</h3>\r\n\r\n<p>Ta h&atilde;y quay lại c&acirc;u chuyện của Sơn v&agrave; T&ugrave;ng, của TiKu v&agrave; WeFuck, lộn WeFack.</p>\r\n\r\n<ul>\r\n	<li>Team TiKu tuy nhỏ, hệ thống code t&agrave;n t&agrave;n, nhưng l&agrave;m rất tốt c&aacute;c kh&acirc;u chuyển h&agrave;ng, giao h&agrave;ng, gi&aacute; cả phải chăng. Tuy l&acirc;u l&acirc;u web bị chập chập nhưng người d&ugrave;ng vẫn thường v&agrave;o mua cho rẻ.</li>\r\n	<li>Một thời gian sau, người d&ugrave;ng nhiều, Taka gọi được vốn khủng,&nbsp;<strong>thu&ecirc; mấy &ocirc;ng dev xịn</strong>&nbsp;về cải tiến lại hệ thống</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Team WeFack x&acirc;y dựng hệ thống rất mượt m&agrave;, chạy từ Web đến Mobile đều&nbsp;<strong>kh&ocirc;ng c&oacute; bug</strong>. Xui thay, do d&acirc;n t&igrave;nh t&igrave;m được ph&ograve;ng chịch v&agrave; người chịch xong th&igrave; &hellip; lưu số để lần sau chịch lại,&nbsp;<strong>kh&ocirc;ng th&ocirc;ng qua WeFack</strong>&nbsp;nữa.</li>\r\n	<li>Một thời gian sau, do kh&ocirc;ng quản l&yacute; được d&ograve;ng tiền, kh&ocirc;ng c&oacute; tiền trả cho người chịch v&agrave; ph&ograve;ng chịch, lại gặp dịch n&ecirc;n&nbsp;<strong>d&acirc;n t&igrave;nh to&agrave;n tự chịch</strong>&nbsp;tại nh&agrave;. Thế l&agrave; WeFack đ&agrave;nh nộp đơn ph&aacute; sản.</li>\r\n</ul>\r\n\r\n<h3><strong>Th&agrave;nh c&ocirc;ng của một dự &aacute;n c&ocirc;ng nghệ đ&ocirc;i khi lại &hellip; m&eacute;o phải nhờ kĩ thuật</strong></h3>\r\n\r\n<p>C&aacute;c bạn thấy đấy, sự th&agrave;nh c&ocirc;ng, thất bại của 1 sản phẩm/1 dự &aacute;n đ&ocirc;i khi kh&ocirc;ng phải nhờ v&agrave;o kĩ thuật, m&agrave; nhờ v&agrave;o những&nbsp;<strong>yếu tố ngoại lai</strong>&nbsp;kh&aacute;c như:</p>\r\n\r\n<ul>\r\n	<li>Sản phẩm c&oacute; thu h&uacute;t được nhiều người d&ugrave;ng hay kh&ocirc;ng, c&oacute; giải quyết nhu cầu của họ kh&ocirc;ng</li>\r\n	<li>M&ocirc; h&igrave;nh sản phẩm, việc vận h&agrave;nh c&oacute; mang lại lợi nhuận hay kh&ocirc;ng (hay l&agrave; đốt tiền lỗ sặc m&aacute;u)</li>\r\n	<li>Trải nghiệm người d&ugrave;ng c&oacute; tốt hay kh&ocirc;ng</li>\r\n	<li>Thi&ecirc;n thời địa lợi nh&acirc;n ho&agrave;, sản phẩm g&igrave; cũng tốt nhưng&nbsp;<strong>kh&ocirc;ng gặp thời</strong>&nbsp;cũng chịu.</li>\r\n</ul>\r\n\r\n<p>N&oacute;i kh&ocirc;ng xa, v&iacute; dụ hệ thống của TiKu c&oacute; mượt m&agrave; ổn định thế n&agrave;o, nếu gi&aacute; s&aacute;ch gi&aacute; quần cao, giao h&agrave;ng chậm chạp, kh&aacute;ch h&agrave;ng sẽ ph&agrave;n n&agrave;n rồi bỏ đi hết.</p>\r\n\r\n<p>Hoặc hệ thống của WeFack c&oacute; thuật to&aacute;n xịn s&ograve;&nbsp;<strong>matching giữa người chịch v&agrave; ph&ograve;ng chịch</strong>&nbsp;ra sao, nếu&nbsp;<strong>gặp dịch kh&ocirc;ng ai đi chịch</strong>&nbsp;th&igrave; hệ thống cũng &hellip; nằm im chờ chết (v&igrave; đốt tiền do kh&ocirc;ng c&oacute; lợi nhuận).</p>\r\n\r\n<h3><strong>Những con người thầm lặng, gi&uacute;p dự &aacute;n th&agrave;nh c&ocirc;ng</strong></h3>\r\n\r\n<p>L&agrave; 1 developer, đ&ocirc;i khi ch&uacute;ng ta thường&nbsp;<strong>đ&aacute;nh gi&aacute; qu&aacute; cao vai tr&ograve; của c&ocirc;ng nghệ</strong>. Ch&uacute;ng ta thường nghĩ&nbsp;<strong>team engineer của m&igrave;nh l&agrave; quan trọng nhất</strong>, quyết định sự sống c&ograve;n của dự &aacute;n.</p>\r\n\r\n<p>Thật ra, th&agrave;nh c&ocirc;ng của 1 sản phẩm c&oacute; sự tham gia của&nbsp;<strong>rất nhiều ph&ograve;ng ban</strong>&nbsp;kh&aacute;c:</p>\r\n\r\n<ul>\r\n	<li>Mấy bạn sales hay đi ch&eacute;m gi&oacute;, l&agrave; những người đem lại kh&aacute;ch h&agrave;ng,&nbsp;<strong>đem lại lợi nhuận về cho c&ocirc;ng ty</strong></li>\r\n	<li>Mấy bạn operation hay cằn nhằn, đ&ograve;i t&iacute;nh năng, l&agrave; những người&nbsp;<strong>giữ hệ thống hoạt động ổn định</strong>, nhiều khi phải thức đ&ecirc;m thức h&ocirc;m</li>\r\n	<li>Mấy bạn customer support n&oacute;i nhiều, l&agrave; những người ki&ecirc;n nhẫn&nbsp;<strong>hỗ trợ kh&aacute;ch h&agrave;ng</strong>, giữ ch&acirc;n kh&aacute;ch h&agrave;ng quay lại hệ thống</li>\r\n	<li>Mấy &ocirc;ng CEO hắc &aacute;m hay đ&ograve;i hỏi, l&agrave; những người ki&ecirc;n nhẫn gọi vốn&nbsp;<strong>giữ cho c&ocirc;ng ty sống s&oacute;t v&agrave; ph&aacute;t triển</strong>.</li>\r\n</ul>\r\n\r\n<h3><strong>Kết</strong></h3>\r\n\r\n<p>Hai năm sau, khi WeFack ph&aacute; sản, anh em dev (trong đ&oacute; c&oacute; T&ugrave;ng) phải ra đường chịch dạo. Sơn th&igrave; đ&atilde; l&ecirc;n Engineer Manager ở TiKu, nhờ &ldquo;tay to&rdquo; n&ecirc;n k&eacute;o T&ugrave;ng v&agrave;o l&agrave;m chung. Từ đấy về sau, họ trở th&agrave;nh&nbsp;<em>cặp đ&ocirc;i Sơn T&ugrave;ng MTP</em>&nbsp;vang dang thi&ecirc;n hạ.</p>\r\n\r\n<p>B&agrave;i học r&uacute;t ra sau c&acirc;u chuyện n&agrave;y l&agrave; g&igrave;? C&ocirc;ng ty to hay nhỏ, c&ocirc;ng nghệ xịn hay kh&ocirc;ng th&igrave; cũng c&oacute; khả năng bị sập. Do vậy,&nbsp;<strong>nhớ kiếm mấy thằng bạn &ldquo;tay to&rdquo;</strong>, lỡ thất nghiệp l&agrave; c&oacute; job ngay, khỏi phải đi xin nh&eacute;!</p>\r\n\r\n<p>Đ&ugrave;a th&ocirc;i, b&agrave;i học nằm ở đoạn tr&ecirc;n rồi, n&ecirc;n phần kết m&igrave;nh kh&ocirc;ng nhắc lại nữa nha!</p>', '1766555233_screenshot-2020-10-21-at-6.25.30-pm.jpg', 'IT', 1, '2025-12-23 22:47:13', '2025-12-23 22:47:13'),
(5, 4, 3, '3 cuốn sách hay nhất mình đã đọc trong năm 2025', '3-cuon-sach-hay-nhat-minh-da-doc-trong-nam-2025', '<p>Năm nay m&igrave;nh đọc kh&ocirc;ng nhiều lắm, mỗi th&aacute;ng chỉ tầm 2-4 cuốn s&aacute;ch. Do đ&oacute;, m&igrave;nh sẽ kh&ocirc;ng review s&aacute;ch hay nhất theo th&aacute;ng, m&agrave;&nbsp;<strong>chọn 8 cuốn m&igrave;nh thấy hay nhất để review</strong>&nbsp;nh&eacute;.</p>\r\n\r\n<h3><strong>1. The Secret of Consulting</strong></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Cuốn n&agrave;y m&igrave;nh t&igrave;m thấy kh&aacute; l&agrave; t&igrave;nh cờ, t&igrave;m đọc thử sau n&agrave;y c&oacute; ch&aacute;n đi l&agrave;m dev, đổi nghề qua l&agrave;m consultant kiếm th&ecirc;m cũng biết đường m&agrave; l&agrave;m.</p>\r\n\r\n<p>T&aacute;c giả s&aacute;ch l&agrave;&nbsp;<a href=\"https://en.wikipedia.org/wiki/Gerald_Weinberg\">Gerald Weinberd</a>, cũng l&agrave; d&acirc;n kĩ thuật (l&agrave; computer scientist v&agrave; l&agrave;m phần mềm), n&ecirc;n c&aacute;ch viết của s&aacute;ch&nbsp;<strong>kh&ocirc;ng d&agrave;i d&ograve;ng l&ecirc; th&ecirc;</strong>&nbsp;ch&eacute;m gi&oacute; kiểu mấy cha sales, m&agrave; đi thẳng v&agrave;o vấn đề lu&ocirc;n.</p>\r\n\r\n<p>Nhờ kinh nghiệm l&agrave;m việc ở nhiều c&ocirc;ng ty lớn, l&agrave;m consultant v&agrave;i chục năm, &ocirc;ng đưa ra&nbsp;<strong>rất nhiều lời khuy&ecirc;n hữu &iacute;ch</strong>: những chi&ecirc;u tr&ograve; l&agrave;m m&agrave;u, đặt gi&aacute;; l&agrave;m sao để kh&aacute;ch h&agrave;ng tin tưởng m&igrave;nh, &hellip;</p>\r\n\r\n<p>Những lời khuy&ecirc;n n&agrave;y kh&ocirc;ng chỉ trong việc consulting m&agrave; c&ograve;n c&oacute; thể&nbsp;<strong>&aacute;p dụng được v&agrave;o cuộc sống</strong>. S&aacute;ch đọc kh&ocirc;ng hề ch&aacute;n, v&igrave; &ocirc;ng cũng k&egrave;m th&ecirc;m v&agrave;i c&acirc;u chuyện th&uacute; vị nhưng rất thật tế.</p>\r\n\r\n<h3><strong>2. Web Scalability for Startup Engineers</strong></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>L&acirc;u l&acirc;u vẫn phải đọc s&aacute;ch kĩ thuật để&nbsp;<strong>kh&ocirc;ng bị lụt nghề</strong>! Cuốn n&agrave;y kh&aacute; th&iacute;ch hợp cho c&aacute;c bạn đang l&agrave;m startup/l&agrave;m sản phẩm v&agrave; muốn giải quyết vấn đề scalability &ndash; L&agrave;m sao để thiết kế để hệ thống c&oacute; thể&nbsp;<a href=\"https://toidicodedao.com/2017/08/01/thiet-ke-he-thong-trieu-nguoi-dung-high-scalability/\">phục vụ h&agrave;ng ngh&igrave;n h&agrave;ng triệu người d&ugrave;ng</a>.</p>\r\n\r\n<p>Nội dung của s&aacute;ch kh&ocirc;ng qu&aacute; h&agrave;n l&acirc;m, kh&ocirc;ng tập trung cụ thể v&agrave;o 1 ng&ocirc;n ngữ/c&ocirc;ng nghệ n&agrave;o đ&oacute; m&agrave;&nbsp;<strong>hướng tới system design</strong>&nbsp;l&agrave; ch&iacute;nh. S&aacute;ch sẽ giới thiệu với bạn những kh&aacute;i niệm m&agrave; ai cũng cần biết nếu muốn&nbsp;<strong>design 1 hệ thống high scalability</strong>: load balancer, sharding,&nbsp;<a href=\"https://toidicodedao.com/2018/12/18/caching-la-gi-caching-tang-toc-do-tai/\">caching</a>,&nbsp;<a href=\"https://toidicodedao.com/2019/10/08/message-queue-la-gi-ung-dung-microservice/\">message queue</a>, &hellip;</p>\r\n\r\n<p>Nội dung kĩ thuật của s&aacute;ch kh&ocirc;ng qu&aacute; kh&oacute;, anh em dev tầm 1-2 năm kinh nghiệm trở l&ecirc;n c&oacute; thể đọc hiểu được. Nếu muốn t&igrave;m hiểu chuy&ecirc;n s&acirc;u hơn, bạn c&oacute; thể t&igrave;m đọc cuốn&nbsp;<strong>Designing Data-Intensive Applications</strong>&nbsp;nh&eacute;.</p>\r\n\r\n<p>3.&nbsp;<strong>Upstream &ndash; The Quest to Solve Problem before they Happens</strong></p>\r\n\r\n<p>S&aacute;ch n&agrave;y do bạn b&egrave; review n&ecirc;n m&igrave;nh t&igrave;m đọc theo lu&ocirc;n. Nội dung s&aacute;ch kh&aacute; hay: L&agrave;m sao để t&igrave;m v&agrave; giải quyết vấn đề &hellip;&nbsp;<strong>trước khi n&oacute; xảy ra</strong>?</p>\r\n\r\n<p>&Ocirc;ng b&agrave; c&oacute; c&acirc;u l&agrave; &ldquo;ph&ograve;ng bệnh hơn chữa bệnh&rdquo;, việc ngăn chặn vấn đề từ trứng nước sẽ&nbsp;<strong>nhanh gọn, &iacute;t tốn k&eacute;m</strong>&nbsp;hơn. Tuy nhi&ecirc;n, x&atilde; hội lại chỉ coi trong những người &hellip; giải quyết tốt vấn đề hơn người giỏi ngăn chặn.</p>\r\n\r\n<p>V&iacute; dụ như, bạn tạo ra thuốc chữa Covid th&igrave; nhiều người sẽ tung h&ocirc; bạn. C&ograve;n nếu bạn ngăn chặn Covid l&acirc;y lan, mọi người sẽ&nbsp;<strong>chả quan t&acirc;m</strong>&nbsp;v&igrave; họ c&oacute; biết Covid l&agrave; g&igrave;, Covid nguy hại ra sao đ&acirc;u!</p>\r\n\r\n<p>Đọc s&aacute;ch, bạn sẽ biết c&aacute;ch nh&igrave;n nhận những vấn đề như vậy, c&aacute;ch để giải quyết ch&uacute;ng từ trong trứng nước nh&eacute;!</p>', '1766556158_collage-e1609494856546.jpg', NULL, 1, '2025-12-23 23:02:38', '2025-12-23 23:02:38'),
(10, 1, 2, 'dsadas', 'dsadas', '<p><img alt=\"\" src=\"http://localhost:8000/ufiles/iphone-16-xanh-luu-ly-9-638639088336103140-750x500-removebg-preview.png\" style=\"height:408px; width:612px\" /></p>', '1766571985_iphone-16-pro-max-titan-sa-mac-5-638638962363556047-750x500-removebg-preview.png', NULL, 1, '2025-12-24 03:26:25', '2025-12-24 03:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `picture`, `bio`, `type`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'root', 'root@gmail.com', 'root', '2025-12-23 22:08:01', '$2y$12$FLJ6rpLqEWpwe1jQ1jtWoO88fRwZkl/z1lTvi.xr6Z54aLvDs2x/C', NULL, NULL, 'superAdmin', 'active', 'NbfCzvP74F', '2025-12-23 22:08:02', '2025-12-23 22:08:02', NULL),
(3, 'test', 'test@gmail.com', 'test', NULL, '$2y$12$/F143YIPxHKzT3Vu1MAnIuGTIfSYKfcQseQnIu.EWdMGHpfgGvZC6', NULL, NULL, 'user', 'active', NULL, '2025-12-23 22:55:07', '2025-12-23 22:55:07', NULL),
(4, 'admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$LhtWf9RvgP86zAQBcpvp8eQFxhY221Jt3TyiCA1uh1ddwv1Zk52vm', NULL, NULL, 'admin', 'active', NULL, '2025-12-23 22:57:51', '2025-12-23 22:57:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_foreign` (`parent`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_categories`
--
ALTER TABLE `parent_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parent_categories_slug_unique` (`slug`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_category_foreign` (`category`),
  ADD KEY `posts_author_id_foreign` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `parent_categories`
--
ALTER TABLE `parent_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `parent_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_category_foreign` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
