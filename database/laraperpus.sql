-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 06:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laraperpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(127) NOT NULL,
  `author` varchar(64) NOT NULL,
  `publisher` varchar(64) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `year` year(4) NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `book_cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `slug`, `title`, `author`, `publisher`, `isbn`, `year`, `rack_id`, `category_id`, `book_cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'minus-nihil21580', 'Minus nihil.', 'Chelsea Hana Hastuti', 'Yayasan Sihotang Tbk', '9797796956253', 2021, 5, 1, 'book-3.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(2, 'error-minus99971', 'Error minus.', 'Puspa Astuti S.E.', 'PT Mardhiyah Zulkarnain', '9789001372507', 1975, 8, 5, 'book-2.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(3, 'dolor-sit-necessitatibus-aut-dolores-pariatur43166', 'Dolor sit necessitatibus aut dolores pariatur.', 'Emin Sihotang', 'CV Putra', '9798173519337', 1996, 9, 1, 'book-9.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(4, 'dolor-sit-quia-qui-beatae25568', 'Dolor sit quia qui beatae.', 'Maimunah Padmi Sudiati', 'CV Laksita Haryanti', '9791816300828', 1992, 8, 5, 'book-3.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(5, 'aliquid-earum-quisquam47376', 'Aliquid earum quisquam.', 'Ulya Rahayu S.H.', 'Fa Sinaga Tbk', '9783573808440', 1974, 5, 2, 'book-5.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(6, 'in-commodi-sit77624', 'In commodi sit.', 'Maria Ratna Safitri S.Kom', 'Perum Usada Suwarno (Persero) Tbk', '9787344450364', 2017, 6, 5, 'book-7.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(7, 'ea-est-minima15346', 'Ea est minima.', 'Dipa Limar Budiyanto', 'CV Budiyanto', '9786742693014', 1972, 6, 2, 'book-1.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(8, 'itaque-eos-ullam16475', 'Itaque eos ullam.', 'Diana Lestari', 'CV Sitorus Pangestu', '9795129894111', 2005, 9, 4, 'book-7.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(9, 'expedita-eum-iure14856', 'Expedita eum iure.', 'Parman Widodo', 'Yayasan Maulana Siregar', '9793432228609', 2016, 6, 4, 'book-3.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(10, 'voluptatem-fugit-sed-harum12009', 'Voluptatem fugit sed harum.', 'Tania Ghaliyati Yuniar S.Psi', 'PD Irawan', '9793614759648', 2019, 3, 2, 'book-2.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(11, 'non-quam-molestias-eaque18520', 'Non quam molestias eaque.', 'Karna Pranowo', 'Perum Ramadan (Persero) Tbk', '9788610676396', 1982, 2, 3, 'book-5.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(12, 'aut-est-impedit60684', 'Aut est impedit.', 'Hilda Yolanda', 'PT Gunarto Laksmiwati', '9799397567371', 1990, 6, 4, 'book-7.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(13, 'dolores-totam78036', 'Dolores totam.', 'Nyana Adriansyah', 'Fa Wacana', '9786574375997', 1994, 2, 5, 'book-3.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(14, 'velit-beatae19430', 'Velit beatae.', 'Ganep Tampubolon S.Ked', 'PJ Waluyo', '9797446690803', 1973, 10, 3, 'book-4.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(15, 'aut-totam-ea-vero17792', 'Aut totam ea vero.', 'Cakrawala Hidayanto S.H.', 'UD Aryani', '9798925607107', 1979, 4, 4, 'book-10.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(16, 'qui-et-sunt52012', 'Qui et sunt.', 'Zalindra Kayla Nasyidah M.M.', 'CV Laksmiwati', '9784624485542', 2005, 1, 1, 'book-7.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(17, 'possimus-nostrum-laborum99594', 'Possimus nostrum laborum.', 'Kiandra Restu Yuliarti S.Ked', 'PT Marbun Tbk', '9781662717598', 1996, 8, 1, 'book-9.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(18, 'autem-doloremque-aut89018', 'Autem doloremque aut.', 'Janet Tami Usamah', 'Fa Nugroho (Persero) Tbk', '9789709591729', 1984, 1, 5, 'book-1.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(19, 'sunt-necessitatibus-facilis27495', 'Sunt necessitatibus facilis.', 'Eja Hutasoit', 'PT Lestari Laksita Tbk', '9798319067548', 1991, 2, 4, 'book-9.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(20, 'ipsa-incidunt-molestias21839', 'Ipsa incidunt molestias.', 'Puji Paris Usamah', 'PD Budiyanto', '9794848301450', 1992, 2, 3, 'book-8.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(21, 'ut-quia-voluptatem53862', 'Ut quia voluptatem.', 'Jumari Jailani M.Farm', 'Perum Utama Anggraini', '9782482037767', 2013, 4, 4, 'book-7.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(22, 'iure-cumque-nobis-ratione-possimus57301', 'Iure cumque nobis ratione possimus.', 'Halim Maulana S.Gz', 'UD Prastuti Rahimah', '9790220046940', 1982, 8, 1, 'book-9.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(23, 'sunt-nisi34131', 'Sunt nisi.', 'Baktianto Kardi Mangunsong', 'Fa Hassanah', '9790756448713', 1987, 5, 2, 'book-8.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(24, 'est-maiores30878', 'Est maiores.', 'Uchita Hariyah', 'Yayasan Namaga Kuswoyo Tbk', '9790102196473', 2021, 10, 1, 'book-3.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(25, 'porro-rerum-ab92336', 'Porro rerum ab.', 'Elisa Hafshah Mayasari M.Ak', 'PT Kusmawati Tbk', '9788312733076', 1970, 5, 2, 'book-4.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(26, 'sapiente-doloribus-doloribus33733', 'Sapiente doloribus doloribus.', 'Shania Uyainah S.Ked', 'UD Sitompul', '9781218615651', 1978, 6, 1, 'book-4.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(27, 'voluptate-autem-iste-ea62777', 'Voluptate autem iste ea.', 'Vanya Astuti', 'UD Yulianti', '9780084873998', 2013, 5, 3, 'book-3.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(28, 'soluta-perspiciatis-aut-quae84585', 'Soluta perspiciatis aut quae.', 'Bahuwirya Haryanto', 'CV Nuraini (Persero) Tbk', '9791323261308', 2009, 6, 5, 'book-10.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(29, 'commodi-excepturi-vitae-quo89369', 'Commodi excepturi vitae quo.', 'Julia Jessica Fujiati S.E.I', 'CV Lailasari Yulianti', '9781046194984', 1982, 2, 1, 'book-1.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(30, 'est-nihil-consequatur65716', 'Est nihil consequatur.', 'Gasti Yolanda', 'PT Wijayanti Tbk', '9789773005429', 2017, 6, 3, 'book-4.jpg', '2024-01-10 17:47:06', '2024-01-10 17:47:06', NULL),
(31, 'ut-labore-beatae-corrupti-sed-accusamus82003', 'Ut labore beatae corrupti sed accusamus.', 'Cici Hastuti', 'PT Narpati Lailasari (Persero) Tbk', '9785128888839', 1981, 7, 4, 'book-8.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(32, 'architecto-exercitationem-quidem66846', 'Architecto exercitationem quidem.', 'Cager Wibowo', 'UD Setiawan', '9791348344307', 1989, 2, 4, 'book-10.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(33, 'quia-voluptas49501', 'Quia voluptas.', 'Darimin Mahendra', 'PT Manullang (Persero) Tbk', '9796309020559', 1996, 4, 5, 'book-7.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(34, 'sapiente-animi70033', 'Sapiente animi.', 'Mustofa Setiawan', 'PT Hartati Tbk', '9796861144670', 1992, 3, 2, 'book-9.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(35, 'est-dolore-voluptatem-id70683', 'Est dolore voluptatem id.', 'Gantar Ivan Waskita', 'CV Wahyudin', '9794903278246', 2001, 6, 4, 'book-9.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(36, 'aut-eveniet-quidem-expedita33157', 'Aut eveniet quidem expedita.', 'Edward Jailani S.Gz', 'Perum Tampubolon', '9784197963218', 2000, 4, 2, 'book-2.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(37, 'sed-aliquam-quo-eos-placeat20966', 'Sed aliquam quo eos placeat.', 'Makara Hendra Anggriawan', 'Yayasan Uwais Hardiansyah Tbk', '9797385536767', 1981, 9, 2, 'book-4.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(38, 'nemo-architecto-saepe-corporis35695', 'Nemo architecto saepe corporis.', 'Banawi Kusumo', 'Perum Suwarno Tbk', '9783601388845', 2002, 1, 4, 'book-9.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(39, 'dignissimos-illo-animi-et-soluta12964', 'Dignissimos illo animi et soluta.', 'Rini Yuliarti', 'PD Nashiruddin Nasyiah', '9780205603862', 2003, 5, 3, 'book-6.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(40, 'dolor-autem-molestiae26872', 'Dolor autem molestiae.', 'Cakrawala Lazuardi S.Kom', 'Yayasan Rahayu', '9793995522039', 2001, 8, 2, 'book-8.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(41, 'perspiciatis-ratione-maxime-in78156', 'Perspiciatis ratione maxime in.', 'Muni Ajimin Kuswoyo S.H.', 'PJ Prakasa (Persero) Tbk', '9794986182829', 2009, 10, 4, 'book-6.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(42, 'dolorem-tempore-sequi-cumque-molestiae51775', 'Dolorem tempore sequi cumque molestiae.', 'Candrakanta Tomi Pradipta', 'Perum Nugroho', '9784377792102', 1975, 6, 3, 'book-10.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(43, 'ex-vitae10987', 'Ex vitae.', 'Kamaria Talia Nasyidah', 'Fa Farida Budiyanto (Persero) Tbk', '9798808209756', 2018, 2, 1, 'book-3.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(44, 'ut-harum-qui-sequi46778', 'Ut harum qui sequi.', 'Maria Susanti', 'PT Novitasari (Persero) Tbk', '9790934962482', 2008, 6, 4, 'book-4.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(45, 'atque-suscipit90810', 'Atque suscipit.', 'Eman Habibi S.I.Kom', 'PD Rajata Santoso', '9781712042687', 2010, 2, 1, 'book-5.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(46, 'omnis-iusto-quae89142', 'Omnis iusto quae.', 'Elisa Winarsih', 'PD Nashiruddin Tbk', '9780316755740', 2006, 4, 3, 'book-4.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(47, 'voluptatem-nobis-aut-rerum-consequatur-qui90330', 'Voluptatem nobis aut rerum consequatur qui.', 'Makara Saptono', 'PT Winarno', '9791360856178', 1980, 1, 1, 'book-8.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(48, 'aspernatur-sint-aperiam21530', 'Aspernatur sint aperiam.', 'Tantri Anggraini', 'PJ Gunarto (Persero) Tbk', '9795453264833', 1974, 1, 3, 'book-6.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(49, 'quod-mollitia-est-in62011', 'Quod mollitia est in.', 'Panji Rafi Wahyudin S.E.', 'PJ Hakim (Persero) Tbk', '9785615566905', 1977, 3, 4, 'book-8.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(50, 'sunt-dolore-dolor-a25716', 'Sunt dolore dolor a.', 'Michelle Yolanda', 'PJ Hasanah', '9793582442092', 1976, 2, 5, 'book-10.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(51, 'aut-aut83260', 'Aut aut.', 'Jagapati Kuswoyo', 'UD Prabowo Widodo', '9785370002571', 1986, 6, 1, 'book-9.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(52, 'omnis-perferendis-autem-voluptatibus-officiis67827', 'Omnis perferendis autem voluptatibus officiis.', 'Indra Hutagalung', 'Perum Prayoga Susanti', '9798077425642', 1985, 4, 4, 'book-1.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(53, 'ut-sequi-temporibus92594', 'Ut sequi temporibus.', 'Dadap Permadi', 'Perum Maryati Oktaviani', '9783836989428', 1999, 3, 3, 'book-9.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(54, 'rerum-qui-accusantium-aut31034', 'Rerum qui accusantium aut.', 'Gara Nugroho S.I.Kom', 'PJ Laksmiwati Tbk', '9798680108901', 2005, 10, 4, 'book-8.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(55, 'debitis-reprehenderit-dolorem-iusto47501', 'Debitis reprehenderit dolorem iusto.', 'Galur Iswahyudi', 'CV Kusmawati Kusumo (Persero) Tbk', '9797578534099', 1978, 9, 3, 'book-10.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(56, 'ratione-sed-et-qui87149', 'Ratione sed et qui.', 'Jamalia Winarsih', 'Perum Mahendra Kuswandari (Persero) Tbk', '9783920796123', 2011, 2, 4, 'book-5.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(57, 'quos-sunt29853', 'Quos sunt.', 'Widya Kuswandari', 'Perum Susanti Mustofa (Persero) Tbk', '9788651739388', 1997, 4, 1, 'book-6.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(58, 'ipsam-excepturi-qui77390', 'Ipsam excepturi qui.', 'Pangestu Latupono', 'PJ Mayasari Tbk', '9794316057476', 1978, 5, 2, 'book-8.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(59, 'pariatur-a-aut-quasi93725', 'Pariatur a aut quasi.', 'Najwa Elisa Namaga', 'Perum Pudjiastuti', '9797165547662', 1984, 9, 1, 'book-8.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(60, 'ullam-voluptas-rerum-occaecati52051', 'Ullam voluptas rerum occaecati.', 'Melinda Hasanah', 'Perum Wacana Rahmawati', '9798502288286', 2003, 4, 4, 'book-5.jpg', '2024-01-10 17:47:13', '2024-01-10 17:47:13', NULL),
(61, 'sejarah-banjar-623', 'Sejarah Banjar', 'Suriansyah Ideham dkk.', 'Gramedia', '1230401284', 2012, 20, 3, '1706063277_1f3815f5a0afec139e23.jpg', '2024-01-24 01:27:57', '2024-01-24 01:27:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_stocks`
--

CREATE TABLE `book_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_stocks`
--

INSERT INTO `book_stocks` (`id`, `book_id`, `quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 33, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(2, 2, 64, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(3, 3, 53, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(4, 4, 59, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(5, 5, 22, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(6, 6, 39, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(7, 7, 9, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(8, 8, 66, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(9, 9, 99, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(10, 10, 38, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(11, 11, 11, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(12, 12, 41, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(13, 13, 70, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(14, 14, 8, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(15, 15, 25, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(16, 16, 91, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(17, 17, 71, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(18, 18, 16, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(19, 19, 18, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(20, 20, 66, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(21, 21, 54, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(22, 22, 78, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(23, 23, 89, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(24, 24, 48, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(25, 25, 33, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(26, 26, 28, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(27, 27, 44, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(28, 28, 17, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(29, 29, 83, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(30, 30, 81, NULL, '2024-01-10 18:47:06', '2024-01-10 18:47:06'),
(31, 1, 56, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(32, 2, 10, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(33, 3, 79, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(34, 4, 38, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(35, 5, 16, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(36, 6, 76, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(37, 7, 43, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(38, 8, 55, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(39, 9, 20, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(40, 10, 76, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(41, 11, 28, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(42, 12, 23, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(43, 13, 26, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(44, 14, 40, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(45, 15, 22, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(46, 16, 29, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(47, 17, 26, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(48, 18, 7, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(49, 19, 77, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(50, 20, 75, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(51, 21, 88, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(52, 22, 87, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(53, 23, 80, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(54, 24, 33, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(55, 25, 60, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(56, 26, 94, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(57, 27, 27, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(58, 28, 99, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(59, 29, 38, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(60, 30, 93, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(61, 31, 41, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(62, 32, 58, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(63, 33, 24, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(64, 34, 21, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(65, 35, 96, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(66, 36, 32, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(67, 37, 18, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(68, 38, 96, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(69, 39, 92, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(70, 40, 87, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(71, 41, 74, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(72, 42, 12, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(73, 43, 27, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(74, 44, 72, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(75, 45, 37, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(76, 46, 56, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(77, 47, 62, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(78, 48, 33, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(79, 49, 62, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(80, 50, 18, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(81, 51, 24, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(82, 52, 40, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(83, 53, 13, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(84, 54, 56, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(85, 55, 82, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(86, 56, 42, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(87, 57, 94, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(88, 58, 82, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(89, 59, 34, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(90, 60, 46, NULL, '2024-01-10 18:47:13', '2024-01-10 18:47:13'),
(91, 61, 100, NULL, '2024-01-24 01:27:57', '2024-01-24 01:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'fiksi', NULL);

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
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `member_id` int(10) UNSIGNED NOT NULL,
  `loan_date` datetime NOT NULL,
  `due_date` date NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `book_id`, `quantity`, `member_id`, `loan_date`, `due_date`, `return_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 15, '2024-07-24 13:24:27', '2024-07-31', NULL, '2024-07-24 13:24:27', '2024-07-24 13:24:27', NULL),
(2, 2, 2, 15, '2024-07-24 13:24:27', '2024-08-07', NULL, '2024-07-24 13:24:27', '2024-07-24 13:24:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `uuid`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `date_of_birth`, `gender`, `qr_code`, `created_at`, `updated_at`) VALUES
(1, '23bbbe40-4ef5-45e1-bf50-26ec1350a2fb', 15, 'tes', 'ja ni', 'tes@gmail.com', '(+62) 8954141411', 'jl.alalskd', '2024-07-16', 'Male', NULL, '2024-07-23 06:14:00', '2024-07-23 06:14:00');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_15_134834_create_members_table', 1),
(6, '2024_07_15_144900_create_categories_table', 1),
(7, '2024_07_15_145234_create_raks_table', 1),
(8, '2024_07_21_064808_create_book_stocks_table', 1),
(9, '2024_07_22_125916_create_books_table', 1),
(10, '2024_07_22_135038_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 9),
(1, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `print_requests`
--

CREATE TABLE `print_requests` (
  `id` int(11) NOT NULL,
  `request_by` int(11) NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `page` varchar(100) NOT NULL,
  `is_approved` timestamp NULL DEFAULT NULL,
  `is_printed` enum('T','Y') NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `print_requests`
--

INSERT INTO `print_requests` (`id`, `request_by`, `approved_by`, `page`, `is_approved`, `is_printed`, `date`) VALUES
(1, 10, 9, 'peminjaman', '2024-07-24 15:06:46', 'T', '2024-07-24 14:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `raks`
--

CREATE TABLE `raks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(8) NOT NULL,
  `floor` varchar(16) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raks`
--

INSERT INTO `raks` (`id`, `name`, `floor`, `created_at`) VALUES
(1, '1A', '1', NULL),
(2, '2B', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2024-07-22 05:53:47', '2024-07-22 05:53:47'),
(2, 'admin', 'web', '2024-07-22 05:53:47', '2024-07-22 05:53:47'),
(3, 'pengguna', 'web', '2024-07-22 05:53:47', '2024-07-22 05:53:47'),
(4, 'kepala', 'web', '2024-07-22 05:53:47', '2024-07-22 05:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ald', 'aldi@gmail.com', NULL, '$2y$10$Yn/1Wk0XTtrp5yiWi2ljpeexz5MI95JVJA8JkUUma.WT1ty9yv9ci', NULL, '2024-07-22 05:53:02', '2024-07-22 05:53:02'),
(9, 'superadmin', 'superadmin@gmail.com', '2024-07-22 06:11:37', '$2y$10$gm3IM30arFDpM7iGe0/pPel6Efqb89y09zCMrCTOfgKQscOAR4qD.', 'MM4vKHWjpjrIBRybPV57pTRuOfO69hWQak8NFtDcEKyKK5s7cvszg7Ivclws', '2024-07-22 06:11:37', '2024-07-22 06:11:37'),
(10, 'admin', 'admin@gmail.com', '2024-07-22 06:11:37', '$2y$10$kYhlXHuwRFIOeTGt8JWpDuWJYxAAjV363WkESEqAzg4T8n4tEGNXm', 'ByvcYQBhzRRTX7dDVecFo20wFxOANYf8tPtki2q7YirREFGRnORw4OygwelR', '2024-07-22 06:11:37', '2024-07-22 06:11:37'),
(11, 'pengguna', 'pengguna@gmail.com', '2024-07-22 06:11:38', '$2y$10$nglQh3Cf944MqFre7dlYPO.wd7PIZ58lQlt5oFIv0P.m6JtOUtEHS', 'zaA78QMgFSS6pCwp2Y2mSVytUoXRnxW9SBvaRfAgQi0vazRpXyFyQYH8CKuT', '2024-07-22 06:11:38', '2024-07-22 06:11:38'),
(12, 'kepala', 'kepala@gmail.com', '2024-07-22 06:11:38', '$2y$10$vg0Obz/B6rvF3E.bPm44KuoYsgMFMnKVW8/IVHrJ8WoQXq/MgEjTC', 'pmkYau0Tm4bCl4z6r3jXPtKxQRagasaPn3lB46zqZr9iosy41T3d7BOrYwez', '2024-07-22 06:11:38', '2024-07-22 06:11:38'),
(13, 'jeni', 'jeni@gmail.com', NULL, '$2y$10$5.3s/mAXeSCO35nNYTtvy.OFqIb3KBJ5HJVUDvS.0WLa/7oB3ZwB.', NULL, '2024-07-22 07:06:37', '2024-07-22 07:45:56'),
(15, 'tes tes tes', 'tes@gmail.com', NULL, '$2y$10$jQW9FPFcTmb33UGHobdm.Od7BikVJdL7Ck0QxaCOtg4g/CWKgcZ6G', NULL, '2024-07-23 06:14:00', '2024-07-23 06:14:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_slug_unique` (`slug`);

--
-- Indexes for table `book_stocks`
--
ALTER TABLE `book_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_book_id_foreign` (`book_id`),
  ADD KEY `loans_member_id_foreign` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `print_requests`
--
ALTER TABLE `print_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raks`
--
ALTER TABLE `raks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `book_stocks`
--
ALTER TABLE `book_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `print_requests`
--
ALTER TABLE `print_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raks`
--
ALTER TABLE `raks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
