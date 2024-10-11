-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2024 at 09:01 PM
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
  `lob_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `role_id`, `lob_id`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '8000000006', '$2y$12$G1n3scAJ9xHv6aAy7ZPsrO3MhpFiYy8p0GDRMzp6qyK89KxyoJUL.', 1, 0, 1, '', '2024-08-17 12:37:52', '2024-10-07 09:15:20');

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
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(14, '2024_10_06_152505_create_modules_table', 3);

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
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
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
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `course_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `status`, `updated_at`, `created_at`) VALUES
(1, 3, 'What is the capital of india', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-06 09:37:39', '2024-10-06 13:23:19'),
(2, 3, 'What is the capital of india', 'Karnal', 'Karnal', 'Chandigarh', 'Dubai', 'B', 1, '2024-10-06 09:38:01', '2024-10-06 13:23:19');

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
('2K9o4RLqOMeqhQxRh6sHOUZjAOyvAz3q1OF9VApb', NULL, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHg3UUQ0emw4eERSWUU3d2xValQ3cENyeEtnYTNFYVpRS0hlVEoycCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9sbXMvcHVibGljL2xvZ2luIjt9fQ==', 1728326585);

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
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
