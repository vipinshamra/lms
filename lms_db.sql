-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 06:04 AM
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
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `lob_id` int(11) NOT NULL COMMENT '1 admin 2 sme 3 TA',
  `status` int(11) NOT NULL DEFAULT 1,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `role_id`, `lob_id`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '8000000006', '$2y$12$G1n3scAJ9xHv6aAy7ZPsrO3MhpFiYy8p0GDRMzp6qyK89KxyoJUL.', 1, 0, 1, '', '2024-08-17 12:37:52', '2024-10-07 09:15:20'),
(8, 'Alyssa Burks', 'suhuzol@gmail.com', '8700000000', '$2y$12$qM/XL6yCqrKOMLEWnP6jruXzz9vErq9PQ2Oimr8Eua0a24cgqPAjy', 2, 1, 1, 'b871ff290ba19a8ed7c3e4f465b35fcdfc66564bdabfd8a19da3318fff26ebea', '2024-10-10 10:46:40', '2024-10-13 14:44:24'),
(9, 'Porter Dean', 'pidywiwyp@mailinator.com', '8500000000', '$2y$12$o5VgwR/TekGuft5sTEPzyu3EoksWj2ZIdPLQL/90AcxDsGkRj13bG', 2, 2, 1, '0f6df73ab90dee38b0ff1097aa76198c6442aeaca2cdccd77b34019c1903517e', '2024-10-10 10:47:31', '2024-10-10 10:47:31'),
(10, 'test name', 'ta@gmail.com', '8788888888', '$2y$12$Jh4yBopxR44jmCsmPg.87.HafDF1PCBEonRB1lTfGuBg3.voE6DOy', 3, 13, 1, 'd9cac4c6fff5ef53dc0681c8f4af15ed68de60f645d6fea451a80f894262d744', '2024-10-17 22:33:03', '2024-10-17 22:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coursemaps`
--

CREATE TABLE `coursemaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lob_id` int(11) NOT NULL,
  `quiz_status` int(11) NOT NULL DEFAULT 0,
  `quiz_score` int(11) NOT NULL DEFAULT 0,
  `assignment_status` int(11) NOT NULL DEFAULT 0,
  `assignment_file` varchar(255) NOT NULL,
  `assignment_remark` text NOT NULL,
  `assignment_download_status` int(11) NOT NULL DEFAULT 0,
  `assignment_assign` varchar(255) DEFAULT NULL COMMENT 'sme id',
  `assignment_sme_file` varchar(250) DEFAULT NULL,
  `is_read_video` text DEFAULT NULL,
  `is_read_docs` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coursemaps`
--

INSERT INTO `coursemaps` (`id`, `user_id`, `course_id`, `lob_id`, `quiz_status`, `quiz_score`, `assignment_status`, `assignment_file`, `assignment_remark`, `assignment_download_status`, `assignment_assign`, `assignment_sme_file`, `is_read_video`, `is_read_docs`, `created_at`, `updated_at`) VALUES
(6, 2, 1, 1, 1, 6, 3, '1728849065.pdf', 'dasbjdhbs scasdfdsf', 1, '9', '1729176751.pdf', '3', '1,2', '2024-10-13 08:50:01', '2024-10-17 13:23:55'),
(8, 2, 2, 1, 0, 0, 0, '', '', 0, NULL, NULL, NULL, NULL, '2024-10-17 13:26:20', '2024-10-17 13:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `assignment` varchar(250) DEFAULT NULL,
  `sme_id` varchar(250) NOT NULL,
  `lob_id` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `uploader` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_id`, `course_name`, `description`, `image`, `assignment`, `sme_id`, `lob_id`, `author`, `uploader`, `status`, `updated_at`, `created_at`) VALUES
(1, 9396, 'Mercedes Hogan', 'Debitis possimus in', '1728577424.jpg', '1728577424.pdf', '8,9', '1,2', '', 0, 1, '2024-10-13 08:36:21', '2024-10-10 10:53:44'),
(2, 9107, 'Nasim Hanson', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem,', '1728578493.jpg', '1728578911.pdf', '8,9', '1,2', 'Author name', 1, 1, '2024-10-17 10:34:27', '2024-10-10 11:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lobs`
--

CREATE TABLE `lobs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lobs`
--

INSERT INTO `lobs` (`id`, `name`, `description`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Sint incidunt hic doloribus.', 'Non ea nisi eveniet nemo corporis aliquid fugit quidem. Quis commodi dolor itaque consequatur sunt.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(2, 'Quo deserunt asperiores culpa in quos quasi.', 'Earum temporibus cum aut sit nobis. Sapiente non reprehenderit ut quo. Aut laudantium optio ipsum.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(3, 'Dolorem ut velit et porro non ea eius ipsa.ss', 'Ut impedit facere ut aut illo nostrum. Totam nihil fugiat est tempora.', 1, '2024-10-05 10:22:30', '2024-09-29 06:01:45'),
(4, 'Et corrupti unde veniam totam provident.', 'Occaecati molestiae consequatur repellat repellat. Et deleniti porro architecto iste natus quae.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(5, 'Et at sit facilis enim tempora voluptas omnis.', 'Quo unde id eos non sunt culpa. Iste et dolorem est voluptatem nihil aut.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(6, 'Molestiae et aut saepe inventore similique aut.', 'Expedita iure debitis officia dolore ut molestias. Commodi est atque occaecati et. Est et ut sunt.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(7, 'Rem vitae ea ipsum numquam.', 'Aperiam qui sunt sint saepe ut neque. Ipsam qui soluta consequuntur maxime.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(8, 'Illo tempora nobis distinctio aut.', 'Eius fuga reiciendis dignissimos. Quos dignissimos nihil asperiores. Dolorum ipsa et placeat.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(9, 'Dolores dolores ipsum laudantium modi velit.', 'Ipsum et minima minima aliquid quia est omnis enim. Veritatis enim animi saepe reprehenderit ea.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(10, 'Quidem laborum nobis quia est.', 'Magni dolore id aut labore. Ut aut blanditiis repellat dolorem. Et consequatur praesentium maxime.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(11, 'Eos nemo soluta sint quia dolores enim.', 'Quam iste unde placeat deserunt id et. Repellendus atque quo sed mollitia est ducimus libero.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(12, 'Sint ab vero eaque omnis vel quod et et.', 'Molestiae veritatis explicabo ut quas animi in. Id et aut quod est.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(13, 'Perspiciatis molestiae et tempore ad in aliquid.', 'Sint magnam ut esse. Harum voluptatem sunt fugit natus.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(14, 'Autem voluptas vitae aut est nulla.', 'Et voluptates corporis quidem qui qui occaecati. Sit cupiditate nesciunt nobis in delectus.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(15, 'Deleniti et sequi odit voluptatum.', 'Labore sed non et ut. Ut aut quia minima omnis. Qui vero laborum sequi.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(16, 'Velit mollitia nihil aspernatur maxime sint.', 'Voluptas ad quasi et recusandae nemo molestiae. Culpa et quo doloremque esse.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(17, 'Pariatur ad voluptas sed enim perferendis ad.', 'Sint libero itaque perferendis sequi autem. Et nihil ut blanditiis et.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(18, 'Repudiandae quia suscipit sit.', 'Nisi reprehenderit aut facilis. Minus quas et corrupti sunt aut. Odio rerum non veniam.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(19, 'Ullam quia nihil culpa beatae quaerat.', 'Dicta atque numquam quis sit eum libero molestias. Ut odio deserunt sit expedita qui.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(20, 'Illum et voluptas laudantium officia voluptatem.', 'Nihil a non aut unde occaecati. Aut quae repellat deserunt aliquam.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(21, 'Harum labore et quae et hic.', 'Ut qui nihil repudiandae hic alias ducimus laborum et. Labore placeat accusamus beatae eaque.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(22, 'Ad velit repudiandae modi blanditiis.', 'Facere ratione aliquid accusantium odit quasi nostrum dolores. Quia ex natus aliquid veniam.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(23, 'Soluta et provident facere in.', 'Iusto similique quam ut dolorem aut non. Voluptas sit quos accusamus quia quidem alias omnis non.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(24, 'Voluptate molestiae quia eum iste.', 'Ducimus est qui sequi molestiae et numquam. Iusto fugiat qui quos quae possimus.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(25, 'Iure veritatis qui voluptas.', 'Vel assumenda optio sunt voluptatem. Eveniet odio fuga alias magnam. Odit nemo ut ab veritatis.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(26, 'Odio nesciunt atque quae voluptatem laudantium.', 'Qui alias ut repellat quod. Cupiditate qui voluptatem temporibus at.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(27, 'Velit amet dolorem dolorem.', 'Molestiae dolorum sed fuga eos omnis. Aspernatur nostrum similique aut asperiores laborum.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(28, 'Quia repellendus dolores nemo similique aut.', 'Tenetur consequatur sint ea harum. Est quos accusantium debitis. Suscipit dolore distinctio id.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(29, 'Magni consequatur voluptates id odit voluptatem.', 'Qui doloribus exercitationem at ipsum. Est ea in est sint. Ut perspiciatis quod ut incidunt.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(30, 'Consequatur dolores veniam velit.', 'Et necessitatibus amet quis qui cupiditate. Et non laborum inventore architecto laborum.', 1, '2024-09-29 06:01:45', '2024-09-29 06:01:45'),
(31, 'cnkcvcsjdbcksdb', 'cn sdj csd vhsd bvifd vi dfi', 0, '2024-10-03 13:52:10', '2024-09-29 07:40:41'),
(32, 'scknsd', 'nsdvskjfbvd', 0, '2024-09-29 08:14:29', '2024-09-29 07:42:26'),
(33, 'scnksdnfc', 'cnksdnvcs', 0, '2024-10-05 10:22:13', '2024-09-29 07:54:57');

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
(9, '0001_01_01_000000_create_users_table', 1),
(10, '0001_01_01_000001_create_cache_table', 1),
(11, '0001_01_01_000002_create_jobs_table', 1),
(12, '2024_08_16_061428_create_admins_table', 1),
(13, '2024_10_06_123138_create_quizes_table', 2),
(14, '2024_10_06_152505_create_modules_table', 3),
(15, '2024_10_10_171202_create_coursemap_table', 4),
(16, '2024_10_13_161041_create_user_quiz_answer_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `video` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `module_name`, `description`, `duration`, `video`, `document`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Concept Of Wealth Management', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet consectetur adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?”', 10, '1728577674.mp4', '1728577674.pdf', 1, '2024-10-10 10:57:54', '2024-10-10 10:57:54'),
(2, 1, 'Concept Of Wealth Management 1', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet consectetur adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?”', 20, '1728577707.mp4', '1728577707.pdf', 1, '2024-10-10 10:58:27', '2024-10-10 10:58:27'),
(3, 1, 'Concept Of Wealth Management 2', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet consectetur adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?”', 12, '1728577742.mp4', '1728577742.pdf', 1, '2024-10-10 10:59:02', '2024-10-10 10:59:02'),
(4, 2, 'This is for test lesson', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem,', 12, '1728578992.mp4', '', 1, '2024-10-10 11:19:52', '2024-10-10 11:19:52'),
(5, 2, 'Sed ut perspiciatis', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem,', 28, '', '1728579013.pdf', 1, '2024-10-10 11:20:13', '2024-10-10 11:20:13'),
(6, 2, 'unde omnis iste natus error', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem,', 13, '1728579049.mp4', '1728579049.pdf', 1, '2024-10-10 11:20:49', '2024-10-10 11:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(200) NOT NULL,
  `option_b` varchar(200) NOT NULL,
  `option_c` varchar(200) NOT NULL,
  `option_d` text NOT NULL,
  `correct_answer` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `course_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `status`, `updated_at`, `created_at`) VALUES
(1, 3, 'What is the capital of india', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-06 09:37:39', '2024-10-06 13:23:19'),
(2, 3, 'What is the capital of india', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'B', 1, '2024-10-06 09:38:01', '2024-10-06 13:23:19'),
(3, 1, 'What is the capital of india 1', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:25:44', '2024-10-10 16:25:44'),
(4, 1, 'What is the capital of india 2', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:25:44', '2024-10-10 16:25:44'),
(5, 1, 'What is the capital of india 3', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:25:44', '2024-10-10 16:25:44'),
(6, 1, 'What is the capital of india 4', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:25:44', '2024-10-10 16:25:44'),
(7, 1, 'What is the capital of india 5', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:25:44', '2024-10-10 16:25:44'),
(8, 1, 'What is the capital of india 6', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:25:44', '2024-10-10 16:25:44'),
(9, 2, 'What is the capital of india 1', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:49:07', '2024-10-10 16:49:07'),
(10, 2, 'What is the capital of india 2', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:49:07', '2024-10-10 16:49:07'),
(11, 2, 'What is the capital of india 3', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:49:07', '2024-10-10 16:49:07'),
(12, 2, 'What is the capital of india 4', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:49:07', '2024-10-10 16:49:07'),
(13, 2, 'What is the capital of india 5', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-10 16:49:07', '2024-10-10 16:49:07'),
(14, 2, 'What is the capital of india 6', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'B', 1, '2024-10-13 09:07:11', '2024-10-10 16:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('L6AjA7yOInjDeR51bOF0mB2ym2FEMagBlPULbrzf', 2, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid1htbGNvRVoxTGliV0dlQXJoN1N2VkpGaWxNOXV1R1dWS0tvMzdCYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9sbXMvcHVibGljL2NvdXJzZS9kZXRhaWxzLzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1729193015),
('VEfwgei5ewyfKylS8N7AGIAZ3AGpS1TclBknXSIJ', NULL, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidm1FTWF3VGNxZ2FMMElnTE9ZRmlaa0ZDSjhXUEFiUjdadFNVTk0xQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9sbXMvcHVibGljL2FkbWluL3RhLzEwL2NoYW5nZXBhc3N3b3JkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1729224255);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `lob_id` int(11) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department` varchar(250) NOT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `employment_type` varchar(255) DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `expectance_date` date DEFAULT NULL,
  `recruiter` varchar(200) NOT NULL,
  `offer_revoke` varchar(200) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=pending, 1 active, 2 suspended',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `candidate_id`, `name`, `email`, `phone`, `password`, `lob_id`, `designation`, `department`, `grade`, `employment_type`, `actual_date`, `expectance_date`, `recruiter`, `offer_revoke`, `token`, `status`, `created_at`, `updated_at`) VALUES
(2, 768454, 'user', 'user@gmail.com', 8765798316, '$2y$12$B3nmCvdhK2b6PuMj7YDhUOu1a6cM7hcf10kHmGAElvzb/p7zST6Se', 1, 'IT', 'IT', 'A', 'Soft', '2024-10-10', '2024-10-02', 'test', '', '19ac93c7bc74f1c5e19e203c05339e4ebf92dfae41039543a715baa8278ec786', 1, '2024-10-09 12:34:44', '2024-10-09 12:34:44'),
(18, 142323, 'Nita Barrera1', 'fazusa1@mailinator.com', 2222222423, '$2y$12$jGKrT8Azx8aqGlsbKsw9COtWQwb/se.ol5QlM7lIl0a9.bM.ea5z2', 1, 'Laboriosam dolores', 'Sint id laborum Atq', 'Iure exercitation vi', 'Enim qui natus Nam e', '1977-02-17', '1989-05-14', 'Doloremque velit iru', '', 'c83446e5451c1e25877857ba7abd5ea4e37183939ee5b15f18dc8011e4348c36', 1, NULL, NULL),
(19, 748454, 'user11', 'user11@gmail.com', 8765798323, '$2y$12$8A4bKC4VYmiexrlL1lwoZumpbrfD..3AHllkbSCBmkfTvD.3La5.i', 1, 'IT', 'IT', 'A', 'Soft', '2024-10-10', '2024-10-02', 'test', '', 'd57c1cbd7af1f0edece5402eddce76673141261fd675894c1129766a7a8da33e', 1, NULL, NULL),
(20, 112115, 'vipin1', 'lacyreh1@mailinator.com', 8765798234, '$2y$12$NdTEed4MZtRayQKXKL3DQuA1EcZEBMC/DzBa7Fy04ES/kiKv6ZMfC', 1, 'Excepteur corporis e', 'Culpa asperiores nes', 'Quis iste debitis ip', 'Atque possimus omni', '2010-04-09', '2020-10-30', 'Occaecat molestiae v', '', 'd57c1cbd7af1f0edece5402eddce76673141261fd675894c1129766a7a8da33e', 1, NULL, NULL),
(21, 763454, 'vipin112', 'nugyqapo1@mailinator.com', 9465798123, '$2y$12$R4jQL3Iv3eFp1ZIcZigyBO2KQatYAIXdTDTJJK7dSwMfARo9rl7Py', 2, 'Quia totam sunt ut e', 'Beatae tempore pers', 'Ea qui provident an', 'Ratione rem voluptat', '2020-12-06', '2002-03-22', 'Consequatur non id', '', '5577a303bac670324cbf727abde0e0fe303b0bb26f2cfda4290bd8a925b003ce', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_answers`
--

CREATE TABLE `user_quiz_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_quiz_answers`
--

INSERT INTO `user_quiz_answers` (`id`, `course_id`, `user_id`, `question_id`, `answer`, `updated_at`, `created_at`) VALUES
(50, 1, 2, 3, 'A', '2024-10-17 13:23:35', '2024-10-17 13:23:35'),
(51, 1, 2, 4, 'A', '2024-10-17 13:23:37', '2024-10-17 13:23:37'),
(52, 1, 2, 5, 'A', '2024-10-17 13:23:46', '2024-10-17 13:23:46'),
(53, 1, 2, 6, 'A', '2024-10-17 13:23:50', '2024-10-17 13:23:50'),
(54, 1, 2, 7, 'A', '2024-10-17 13:23:52', '2024-10-17 13:23:52'),
(55, 1, 2, 8, 'A', '2024-10-17 13:23:55', '2024-10-17 13:23:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `coursemaps`
--
ALTER TABLE `coursemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lobs`
--
ALTER TABLE `lobs`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coursemaps`
--
ALTER TABLE `coursemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lobs`
--
ALTER TABLE `lobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
