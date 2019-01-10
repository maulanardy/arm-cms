-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2018 at 06:02 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anakbangsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `ar_admin`
--

CREATE TABLE `ar_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `initial` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_admin`
--

INSERT INTO `ar_admin` (`id`, `name`, `initial`, `password`, `full_name`, `email`, `category_id`, `last_login`, `status`) VALUES
(1, 'admin', 'ADM', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@email.com', 1, '2018-05-07 09:40:13', 1),
(14, 'ardy', 'ARM', '912ec803b2ce49e4a541068d495ab570', 'Ardy Maulana', 'arbomb.serv@gmail.com', 2, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_admin_category`
--

CREATE TABLE `ar_admin_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_admin_category`
--

INSERT INTO `ar_admin_category` (`id`, `name`, `status`) VALUES
(1, 'Administrator', 1),
(2, 'Editor', 1),
(3, 'Reporter', 1),
(5, 'Kontributor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_language`
--

CREATE TABLE `ar_language` (
  `id` int(11) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_language`
--

INSERT INTO `ar_language` (`id`, `kode`, `nama`, `status`) VALUES
(1, 'id', 'Bahasa', 1),
(2, 'en', 'English', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ar_media`
--

CREATE TABLE `ar_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `content` varchar(500) NOT NULL,
  `url` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `date_publish` date NOT NULL,
  `date_unpublish` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_media`
--

INSERT INTO `ar_media` (`id`, `title`, `category_id`, `content`, `url`, `file`, `date_created`, `date_updated`, `date_publish`, `date_unpublish`, `status`) VALUES
(59, 'Sport 1', 20, '<p>Sport 1 Deskripsi</p>', '#', 'content/7bb1c877-476c-4b21-be7d-befab603df84_169.jpg', '2017-01-16 12:09:48', '0000-00-00 00:00:00', '1970-01-01', '0000-00-00', 1),
(60, 'Sport 2', 20, '<p>Sport 2 Deskripsi</p>', '#', 'content/d3c16968-beb5-4a36-9118-a3e5698a3fb1_169.jpg', '2017-01-16 12:10:21', '2017-04-24 11:51:03', '1970-01-01', '0000-00-00', 1),
(61, 'Photo 1', 22, '', '#', 'gallery/gallery-1/1.jpg', '2017-07-28 02:54:09', '0000-00-00 00:00:00', '1970-01-01', '0000-00-00', 1),
(62, 'Photo 2', 22, '', '#', 'gallery/gallery-1/2.jpg', '2017-07-28 02:54:26', '0000-00-00 00:00:00', '1970-01-01', '0000-00-00', 1),
(63, 'Photo 1', 23, '', '#', 'gallery/gallery-2/1.jpg', '2017-07-28 02:54:43', '0000-00-00 00:00:00', '1970-01-01', '0000-00-00', 1),
(64, 'Photo 2', 23, '', '#', 'gallery/gallery-2/2.jpg', '2017-07-28 02:54:58', '0000-00-00 00:00:00', '1970-01-01', '0000-00-00', 1),
(65, 'Slider 1', 24, '', '#', 'banner/main/image_03.jpg', '2017-07-31 02:31:31', '0000-00-00 00:00:00', '1970-01-01', '0000-00-00', 1),
(66, 'Slider 2', 24, '', '#', 'banner/main/image_02.jpg', '2017-07-31 02:31:53', '0000-00-00 00:00:00', '1970-01-01', '0000-00-00', 1),
(67, 'Slider 3', 24, '', '#', 'banner/main/image_01.jpg', '2017-07-31 02:32:11', '2017-07-31 02:36:13', '1970-01-01', '0000-00-00', 1),
(68, 'LSP K3 MANDIRI (BNSP)', 25, '', 'http://bnsp.sertifikasimandiri.com/', 'banner/external/bnsp.jpg', '2017-07-31 02:43:26', '2017-07-31 02:46:47', '1970-01-01', '0000-00-00', 1),
(69, 'PJK3 MANDIRI (KEMENAKER)', 25, '', 'http://kemenaker.sertifikasimandiri.com/', 'banner/external/kemenaker.jpg', '2017-07-31 02:44:08', '2017-07-31 02:47:01', '1970-01-01', '0000-00-00', 1),
(70, 'LSK MANDIRI (ESDM)', 25, '', 'http://esdm.sertifikasimandiri.com/', 'banner/external/esdm.jpg', '2017-07-31 02:44:33', '2017-07-31 02:47:15', '1970-01-01', '0000-00-00', 1),
(71, 'image_01', 26, '', '#', '/main_banner/image_01.jpg', '2017-09-02 03:30:17', '0000-00-00 00:00:00', '2017-09-02', '0000-00-00', 1),
(72, 'image_02', 26, '', '#', '/main_banner/image_02.jpg', '2017-09-02 03:30:17', '0000-00-00 00:00:00', '2017-09-02', '0000-00-00', 1),
(73, 'image_011', 26, '', '#', '/main_banner/image_01.jpg', '2017-09-02 04:30:49', '0000-00-00 00:00:00', '2017-09-02', '0000-00-00', 1),
(74, 'image_021', 26, '', '#', '/main_banner/image_02.jpg', '2017-09-02 04:30:49', '0000-00-00 00:00:00', '2017-09-02', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_media_category`
--

CREATE TABLE `ar_media_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_media_category`
--

INSERT INTO `ar_media_category` (`id`, `title`, `parent`, `slug`, `description`, `status`) VALUES
(26, 'Main Banner', 0, 'main-banner', '', 1),
(27, 'Video', 0, 'video', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_menu`
--

CREATE TABLE `ar_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `class` varchar(10) NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `link_to` varchar(255) NOT NULL,
  `link_value` varchar(255) NOT NULL,
  `pages_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `child_option` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_menu`
--

INSERT INTO `ar_menu` (`id`, `title`, `slug`, `class`, `parent`, `sort`, `link_to`, `link_value`, `pages_id`, `category_id`, `media_id`, `child_option`, `status`) VALUES
(1, '', 'top-menu', '', 0, 1, 'direct', '', 0, 0, 0, '', 1),
(2, '', 'beranda', '', 1, 1, 'direct', 'home', 0, 16, 0, 'category', 1),
(46, '', 'video', '', 42, 4, 'direct', 'video', 0, 0, 0, '', 1),
(17, '', 'tentang-kami', '', 1, 2, 'page', '#', 2, 5, 0, 'no_child', 1),
(49, '', 'agenda', '', 1, 6, 'page', '#', 3, 0, 0, '', 1),
(22, '', 'program', '', 1, 3, 'category', '#', 0, 17, 0, 'category', 1),
(25, '', 'video', '', 1, 4, 'direct', 'video', 0, 0, 0, '', 1),
(47, '', 'artikel', '', 42, 5, 'category', '', 0, 16, 0, 'no_child', 1),
(44, '', 'tentang-kami', '', 42, 2, 'page', '', 2, 0, 0, '', 1),
(45, '', 'program', '', 42, 3, 'category', '', 0, 17, 0, 'no_child', 1),
(42, '', 'bottom-menu', '', 0, 1, 'direct', '', 0, 0, 0, '', 1),
(36, '', 'artikel', '', 1, 5, 'category', 'kontak', 0, 16, 0, 'category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_menu_detail`
--

CREATE TABLE `ar_menu_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ar_menu_detail`
--

INSERT INTO `ar_menu_detail` (`id`, `menu_id`, `language_id`, `title`) VALUES
(1, 1, 1, 'Top Menu'),
(2, 2, 1, 'Beranda'),
(73, 44, 1, 'Tentang Kami'),
(46, 17, 1, 'Tentang Kami'),
(51, 22, 1, 'Program'),
(54, 25, 1, 'Video'),
(74, 45, 1, 'Program'),
(71, 42, 1, 'Bottom Menu'),
(65, 36, 1, 'Artikel'),
(75, 46, 1, 'Video'),
(76, 47, 1, 'Artikel'),
(78, 49, 1, 'Agenda');

-- --------------------------------------------------------

--
-- Table structure for table `ar_pages`
--

CREATE TABLE `ar_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `excerpt` varchar(250) NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `featured_image` varchar(250) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_pages`
--

INSERT INTO `ar_pages` (`id`, `title`, `slug`, `content`, `excerpt`, `admin_id`, `featured_image`, `date_created`, `date_updated`, `status`) VALUES
(1, '', 'sejarah', '', '', 1, 'content/logo.png', '2017-09-02 05:00:50', '0000-00-00 00:00:00', 1),
(2, '', 'tentang-kami', '', '', 1, '', '2017-09-02 05:01:32', '2018-04-22 09:30:41', 1),
(3, '', 'agenda', '', '', 1, '', '2018-05-07 10:46:59', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_pages_detail`
--

CREATE TABLE `ar_pages_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `excerpt` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ar_pages_detail`
--

INSERT INTO `ar_pages_detail` (`id`, `menu_id`, `language_id`, `title`, `content`, `excerpt`) VALUES
(1, 1, 1, 'Sejarah', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <em>Hic ambiguo ludimur.</em> Nam quibus rebus efficiuntur voluptates, eae non sunt in potestate sapientis. <strong>Sit sane ista voluptas.</strong> Duo Reges: constructio interrete. Quem si tenueris, non modo meum Ciceronem, sed etiam me ipsum abducas licebit.</p>\r\n<p>Ne amores quidem sanctos a sapiente alienos esse arbitrantur. <em>Quid adiuvas?</em> <mark>Nonne igitur tibi videntur, inquit, mala?</mark> Ne amores quidem sanctos a sapiente alienos esse arbitrantur. Te ipsum, dignissimum maioribus tuis, voluptasne induxit, ut adolescentulus eriperes P. Invidiosum nomen est, infame, suspectum.</p>\r\n<p><a href="http://loripsum.net/" target="_blank">Quo igitur, inquit, modo?</a> <a href="http://loripsum.net/" target="_blank">Proclivi currit oratio.</a> <em>Fortemne possumus dicere eundem illum Torquatum?</em>Quam ob rem tandem, inquit, non satisfacit? <mark>Id est enim, de quo quaerimus.</mark> <mark>Hic nihil fuit, quod quaereremus.</mark></p>\r\n<p>Pisone in eo gymnasio, quod Ptolomaeum vocatur, unaque nobiscum Q. <a href="http://loripsum.net/" target="_blank">Quid ergo hoc loco intellegit honestum?</a> <strong>Utilitatis causa amicitia est quaesita.</strong> At, illa, ut vobis placet, partem quandam tuetur, reliquam deserit. <mark>Nihil illinc huc pervenit.</mark></p>\r\n<p>Est enim tanti philosophi tamque nobilis audacter sua decreta defendere. Quid censes in Latino fore? <a href="http://loripsum.net/" target="_blank">Quid sequatur, quid repugnet, vident.</a> Non modo carum sibi quemque, verum etiam vehementer carum esse?</p>\r\n<ul>\r\n<li>Duae sunt enim res quoque, ne tu verba solum putes.</li>\r\n<li>Cum ageremus, inquit, vitae beatum et eundem supremum diem, scribebamus haec.</li>\r\n<li>Rhetorice igitur, inquam, nos mavis quam dialectice disputare?</li>\r\n</ul>', ''),
(2, 2, 1, 'Tentang Kami', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/anakbangsa/media//upload/logo/logo.png" alt="" width="330" height="194" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hosne igitur laudas et hanc eorum, inquam, sententiam sequi nos censes oportere? Effluit igitur voluptas corporis et prima quaeque avolat saepiusque relinquit causam paenitendi quam recordandi. Sed tamen enitar et, si minus multa mihi occurrent, non fugiam ista popularia. Sed quid minus probandum quam esse aliquem beatum nec satis beatum? Nam his libris eum malo quam reliquo ornatu villae delectari. Ita credo. Quare obscurentur etiam haec, quae secundum naturam esse dicimus, in vita beata; Duo Reges: constructio interrete. De illis, cum volemus. <mark>Mihi enim satis est, ipsis non satis.</mark> Contineo me ab exemplis. Ergo hoc quidem apparet, nos ad agendum esse natos. Dolor ergo, id est summum malum, metuetur semper, etiamsi non aderit;</p>\r\n<p>Quis istud, quaeso, nesciebat? His enim rebus detractis negat se reperire in asotorum vita quod reprehendat. Mene ergo et Triarium dignos existimas, apud quos turpiter loquare? <em>Praeclarae mortes sunt imperatoriae;</em> Gerendus est mos, modo recte sentiat. Egone non intellego, quid sit don Graece, Latine voluptas? Quae cum ita sint, effectum est nihil esse malum, quod turpe non sit.</p>\r\n<p>Nihilo beatiorem esse Metellum quam Regulum. <strong>Sed haec omittamus;</strong> Quarum ambarum rerum cum medicinam pollicetur, luxuriae licentiam pollicetur. Sed quid sentiat, non videtis. Quod ea non occurrentia fingunt, vincunt Aristonem; <em>Scisse enim te quis coarguere possit?</em> Quae duo sunt, unum facit. An potest, inquit ille, quicquam esse suavius quam nihil dolere?</p>', ''),
(3, 3, 1, 'Agenda', '<p><iframe style="border-width: 0;" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23cccccc&amp;src=in.indonesian%23holiday%40group.v.calendar.google.com&amp;color=%2329527A&amp;ctz=Asia%2FJakarta" width="800" height="600" frameborder="0" scrolling="no"></iframe></p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `ar_polling`
--

CREATE TABLE `ar_polling` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_publish` date NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_polling`
--

INSERT INTO `ar_polling` (`id`, `title`, `question`, `date_created`, `date_publish`, `is_active`, `is_featured`) VALUES
(1, 'Performa Jokowi', 'Bagaimana performa Jokowi menurut Anda?', '2018-04-28 14:20:28', '2018-04-28', 1, 0),
(2, 'Kondisi Ekonomi Negara', 'Bagaimana kondisi ekonomi negara saat ini menurut Anda?', '2018-04-28 14:20:28', '2018-04-28', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_polling_answer`
--

CREATE TABLE `ar_polling_answer` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `polling_id` int(11) NOT NULL,
  `polling_option_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_polling_answer`
--

INSERT INTO `ar_polling_answer` (`id`, `ip_address`, `polling_id`, `polling_option_id`, `date_created`) VALUES
(1, '::1', 2, 4, '2018-04-29 05:09:02'),
(2, '::1', 1, 1, '2018-04-29 05:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `ar_polling_option`
--

CREATE TABLE `ar_polling_option` (
  `id` int(11) NOT NULL,
  `polling_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_polling_option`
--

INSERT INTO `ar_polling_option` (`id`, `polling_id`, `value`) VALUES
(1, 1, 'Sangat Memuaskan'),
(2, 1, 'Biasa Saja'),
(3, 1, 'Mengecewakan'),
(4, 2, 'Mulai Membaik'),
(5, 2, 'Masih tetap sama'),
(6, 2, 'Memburuk');

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts`
--

CREATE TABLE `ar_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `sub_judul` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` varchar(250) NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `hashtag` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `template` varchar(20) NOT NULL,
  `featured_image` varchar(250) NOT NULL,
  `video` varchar(250) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `youtube` varchar(200) NOT NULL,
  `media_caption` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `date_publish` date NOT NULL,
  `date_unpublish` date NOT NULL,
  `featured` int(11) NOT NULL,
  `highlight` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_posts`
--

INSERT INTO `ar_posts` (`id`, `title`, `slug`, `category_id`, `sub_judul`, `content`, `excerpt`, `admin_id`, `author_id`, `hashtag`, `tags`, `template`, `featured_image`, `video`, `gallery_id`, `youtube`, `media_caption`, `date_created`, `date_updated`, `date_publish`, `date_unpublish`, `featured`, `highlight`, `status`) VALUES
(38, '', 'targetkan-tol-ciawi-cigombong-ditargetkan-beroperasi-juli-2018', 23, '', '', '', 1, 1, '', '', 'default', 'artikel/Bo15-696x491.jpg', '', 0, '', '', '2018-04-23 09:31:55', '2018-04-23 10:10:56', '2018-04-23', '0000-00-00', 0, 0, 1),
(39, '', 'pesan-untuk-anak-penyintas-kanker-miliki-cita-cita-yang-besar-untuk-membangun-semangat', 18, '', '', '', 1, 1, '', '', 'default', 'artikel/ka89-1024x682.jpg', '', 0, '', '', '2018-04-23 09:38:56', '2018-04-23 10:12:25', '2018-04-23', '0000-00-00', 0, 0, 1),
(40, '', 'buka-lapangan-kerja-lewat-ekspor-komponen-otomotif', 19, '', '', '', 1, 1, '', '', 'default', 'artikel/iims-3.jpg', '', 0, '', '', '2018-04-23 09:56:47', '2018-04-23 10:12:16', '2018-04-23', '0000-00-00', 0, 0, 1),
(41, '', 'ajak-budayawan-jadi-teladan-bagi-masyarakat', 20, '', '', '', 1, 1, '', '', 'default', 'artikel/bu21-696x396.jpg', '', 0, '', '', '2018-04-23 09:59:32', '2018-04-23 10:12:01', '2018-04-23', '0000-00-00', 0, 0, 1),
(42, '', 'perguruan-tinggi-lakukan-terobosan-besar-di-bidang-pendidikan', 22, '', '', '', 1, 1, '', '', 'default', 'artikel/FR7-696x462.jpg', '', 0, '', '', '2018-04-23 10:05:05', '2018-04-23 10:11:25', '2018-04-23', '0000-00-00', 0, 0, 1),
(43, '', 'presiden-jokowi-membangun-kekuatan-tni-harus-direncanakan-dengan-matang', 21, '', '', '', 1, 1, '', '', 'default', 'artikel/IMG_4134-768x452.jpg', '', 0, '', 'Foto: Rusman_Biro Pers, Media, dan Informasi, Sekretariat Presiden', '2018-04-23 10:06:42', '2018-04-23 10:10:13', '2018-04-23', '0000-00-00', 0, 0, 1),
(44, '', 'sukses-pariwisata-indonesia-di-forum-dunia', 24, '', '', '', 1, 1, '', '', 'default', 'artikel/WhatsApp-Image-2017-04-26-at-09.08.05-696x522.jpg', '', 0, '', 'sumber : presidenri.go.id', '2018-04-23 10:08:54', '2018-04-28 10:46:18', '2018-04-23', '0000-00-00', 0, 0, 1),
(45, '', 'semua-pemeriksaan-tanpa-keluar-uang', 25, '', '', '', 1, 1, '', '', 'default', 'program/generasi-baru-2-696x403.jpg', '', 0, '', '', '2018-04-28 09:27:52', '2018-04-28 09:28:36', '2018-04-28', '0000-00-00', 0, 0, 1),
(46, '', 'reformasi-perpajakan-untuk-kesejahteraan-rakyat', 27, '', '', '', 1, 1, '', '', 'default', 'program/Submit-SPT-768x432.jpg', '', 0, '', '', '2018-04-28 09:31:30', '2018-04-28 09:32:03', '2018-04-28', '0000-00-00', 0, 0, 1),
(47, '', '3-tahun-jokowi', 29, '', '', '', 1, 1, '', '', 'youtube', '', '', 0, 'Hn_iIiXLiqE', '', '2018-04-28 11:29:27', '2018-04-28 12:45:47', '2018-04-28', '0000-00-00', 1, 0, 1),
(48, '', 'perubahan-sektor-di-era-jokowi', 29, '', '', '', 1, 1, '', '', 'youtube', '', '', 0, '88KdQZFOLQo', '', '2018-04-28 11:31:01', '2018-04-28 12:39:03', '2018-04-28', '0000-00-00', 1, 0, 1),
(49, '', 'saham-freeport-untuk-papua', 29, '', '', '', 1, 1, '', '', 'youtube', '', '', 0, 'awgaM2m1KBE', '', '2018-04-28 12:32:56', '2018-04-28 12:38:36', '2018-04-28', '0000-00-00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_category`
--

CREATE TABLE `ar_posts_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `featured` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_posts_category`
--

INSERT INTO `ar_posts_category` (`id`, `title`, `slug`, `parent`, `description`, `picture`, `featured`, `status`) VALUES
(16, '', 'artikel', 0, '', '', 0, 1),
(17, '', 'program', 0, '', '', 0, 1),
(18, '', 'kesehatan-masyarakat', 16, '', '', 0, 1),
(19, '', 'mikro-ekonomi', 16, '', '', 0, 1),
(20, '', 'seni-dan-budaya', 16, '', '', 0, 1),
(21, '', 'militer', 16, '', '', 0, 1),
(22, '', 'pendidikan', 16, '', '', 0, 1),
(23, '', 'pembangunan', 16, '', '', 0, 1),
(24, '', 'pariwisata', 16, '', '', 0, 1),
(25, '', 'pembangunan-manusia', 17, '', '', 0, 1),
(26, '', 'pembangunan-infrastruktur', 17, '', '', 0, 1),
(27, '', 'terobosan-kebijakan', 17, '', '', 0, 1),
(29, '', 'video', 0, '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_category_detail`
--

CREATE TABLE `ar_posts_category_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ar_posts_category_detail`
--

INSERT INTO `ar_posts_category_detail` (`id`, `category_id`, `language_id`, `title`, `description`) VALUES
(16, 16, 1, 'Artikel', 'Artikel'),
(17, 17, 1, 'Program', ''),
(18, 18, 1, 'Kesehatan Masyarakat', ''),
(19, 19, 1, 'Mikro Ekonomi', ''),
(20, 20, 1, 'Seni dan Budaya', ''),
(21, 21, 1, 'Militer', ''),
(22, 22, 1, 'Pendidikan', ''),
(23, 23, 1, 'Pembangunan', ''),
(24, 24, 1, 'Pariwisata', ''),
(25, 25, 1, 'Pembangunan Manusia', ''),
(26, 26, 1, 'Pembangunan Infrastruktur', ''),
(27, 27, 1, 'Terobosan Kebijakan', ''),
(29, 29, 1, 'Video', '');

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_detail`
--

CREATE TABLE `ar_posts_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `excerpt` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ar_posts_detail`
--

INSERT INTO `ar_posts_detail` (`id`, `menu_id`, `language_id`, `title`, `content`, `excerpt`) VALUES
(1, 38, 1, 'Targetkan Tol Ciawi-Cigombong Ditargetkan Beroperasi Juli 2018', '<p>Presiden Joko Widodo berharap proyek jalan tol Bogor-Ciawi-Sukabumi (Bocimi) untuk ruas Jalan Tol Ciawi &ndash; Sukabumi Seksi 1 dengan ruas Ciawi &ndash; Cigombong sepanjang 15,35 kilometer dapat beroperasi pada Juli tahun ini. Hal tersebut diungkapkan Presiden ketika meninjau langsung proyek tol Bocimi, Minggu, 8 April 2018.</p>\r\n<p>&ldquo;Kita harapkan nanti bulan Juli ini dari Ciawi sampai Cigombong kita buka. Kemudian sampai ke Cibadak kira-kira 2019 akan selesai. Sampai Sukabumi Timur 2020 selesai,&rdquo; ujar Presiden.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/Bo14.jpeg"><img class="alignnone size-large wp-image-20834" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/Bo14-1024x828.jpeg" alt="" width="640" height="518" /></a></p>\r\n<p>Peninjauan tol Bocimi oleh Presiden ini dilakukan dalam perjalanan kembali ke Bogor dari Stasiun Cibadak, Kabupaten Sukabumi pada pukul 16.05 WIB, setelah melakukan kunjungan kerja ke Sukabumi. Presiden meninjau lokasi proyek yang terletak antara Stasiun Cicurug dan Stasiun Cigombong.</p>\r\n<p>Presiden mengatakan titik utama kemacetan berada di sekitar Cibadak. Oleh karena itu, jika tol Bocimi ini sudah rampung, maka akan bisa mengurai kemacetan dengan cukup signifikan.</p>\r\n<p>&ldquo;Kalau dari Ciawi ke Cigombong itu sudah buka itu akan mengurai kemacetan yang lumayan besar. Apalagi kalau sudah sampai Cibadak karena sekarang ini paling ruwetnya ada di Cibadak. Jadi kalau sudah sampai ke sana 2019 akan mengurai kemacetan yang sangat banyak,&rdquo; lanjutnya.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/Bo10.jpeg"><img class="alignnone size-large wp-image-20833" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/Bo10-1024x682.jpeg" alt="" width="640" height="426" /></a></p>\r\n<p>&nbsp;</p>\r\n<p>Sementara itu terkait masalah pembebasan lahan, Presiden mengatakan bahwa dirinya tidak menerima laporan mengenai hal itu. Pembangunan tol Bocimi secara keseluruhan menurutnya sudah berjalan dengan baik.</p>\r\n<p>&ldquo;Tidak ada masalah, progresnya baik. Biasanya dalam pembebasan ada satu atau dua (masalah). Ini tidak ada laporan ke saya dari PU maupun dari BUMN yang mengerjakan. Semuanya progresnya baik tinggal nunggu nanti bulan Juli insyaallah sudah bisa kita operasikan yang Ciawi-Cigombong,&rdquo; katanya.</p>\r\n<p>Turut hadir mendampingi Presiden dalam peninjauan ini, Menteri PU dan Perumahan Rakyat Basuki Hadimuljono, Menteri Perhubungan Budi Karya Sumadi dan Kepala Staf Kepresidenan Moeldoko.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/Bo12.jpeg"><img class="alignnone size-large wp-image-20831" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/Bo12-1024x1008.jpeg" alt="" width="640" height="630" /></a></p>\r\n<p>Setelah meninjau proyek tol Bocimi, Kereta Api Luar Biasa RI-1 melanjutkan perjalanan dan di Stasiun Maseng, Kabupaten Bogor saat kereta berhenti, Presiden sempat menyapa masyarakat dan membagi-bagikan kaos serta buku tulis.</p>\r\n<p>Dari Stasiun Maseng, Kereta Api Luar Biasa RI-1 melanjutkan perjalanan dan tiba di Stasiun Bogor pada pukul 17.45 WIB.</p>\r\n<p>sumber : http://presidenri.go.id</p>', 'Presiden Joko Widodo berharap proyek jalan tol Bogor-Ciawi-Sukabumi (Bocimi) untuk ruas Jalan Tol Ciawi – Sukabumi Seksi 1 dengan ruas Ciawi – Cigombong sepanjang 15,35 kilometer dapat beroperasi pada Juli tahun ini.'),
(2, 39, 1, 'Pesan untuk Anak Penyintas Kanker: Miliki Cita-Cita yang Besar untuk Membangun Semangat', '<p>Ekspresi wajah ceria tampak dari puluhan anak yang duduk dan berkumpul di halaman belakang Istana Kepresidenan Bogor, Jawa Barat. Di hadapan mereka, Presiden Joko Widodo dan Ibu Negara Iriana Joko Widodo tampak berlesehan membaur dengan keceriaan anak-anak itu.</p>\r\n<p>Jumat pagi, 6 April 2018, puluhan anak yang bernaung di bawah Yayasan Kanker Anak Indonesia bertemu dengan Presiden Joko Widodo. Pertemuan berlangsung dengan santai diselingi dengan tanya jawab antara Presiden dengan anak-anak, aktivitas menyanyi, dan sedikit atraksi sulap.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/ka89.jpeg"><img class="alignnone size-large wp-image-20751" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/ka89-1024x682.jpeg" alt="" width="640" height="426" /></a></p>\r\n<p>Presiden Joko Widodo kemudian menyampaikan pesannya kepada anak-anak penyintas kanker tersebut. Ia berharap, anak-anak tersebut tetap menjalani aktivitasnya dan memiliki cita-cita karena cita-citalah yang membangunkan semangat.</p>\r\n<p>&ldquo;Anak-anak harus punya cita-cita dan harus bersemangat,&rdquo; ucap Presiden.</p>\r\n<p>Dalam kesempatan tersebut, Kepala Negara turut menyampaikan apresiasinya untuk orang tua, Yayasan Kanker Anak Indonesia dan pendamping yang selama ini telah memberikan dukungan dan dorongan bagi anak-anak penyintas kanker.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/ka42.jpeg"><img class="alignnone size-large wp-image-20749" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/ka42-822x1024.jpeg" alt="" width="640" height="797" /></a></p>\r\n<p>&ldquo;Semoga dorongan dan bantuan yang diberikan memberikan semangat anak-anak kita untuk tetap memiliki cita-cita yang besar ke depannya,&rdquo; ujarnya.</p>\r\n<p>Selama pertemuan tersebut, Presiden juga berdialog dengan para orang tua dan pengurus Yayasan. Ia mendengarkan masukan-masukan yang diberikan oleh pengurus terkait dengan perawatan bagi anak-anak penyintas kanker dan berjanji akan menindaklanjutinya.</p>\r\n<p>&ldquo;Tadi masukan-masukan yang diberikan misalnya yang berkaitan dengan regulasi untuk bea masuk yang berkaitan dengan obat-obatan akan saya tindak lanjuti. Karena ini juga menyangkut hal yang sangat penting bagi anak-anak kita ke depan,&rdquo; tuturnya kepada para jurnalis.</p>\r\n<p>Selain itu, ia menyampaikan harapannya terkait peluang kesembuhan bagi anak-anak itu. Presiden tentu berharap agar anak-anak penyintas kanker mampu meraih masa depannya.</p>\r\n<p>&ldquo;Tadi disampaikan dari Yayasan Kanker Anak Indonesia bahwa 70 persen lebih anak-anak ini masih bisa sembuh kalau kanker itu ditemukan sejak dini. Kita harapkan anak-anak semuanya, bukan hanya 70 persen tapi 100 persen, bisa disembuhkan karena mereka memiliki sebuah masa depan,&rdquo; ujarnya.</p>\r\n<p>Turut mendampingi Presiden dan Ibu Iriana dalam acara tersebut, Menteri Kesehatan Nila Moeloek dan Menteri Pemberdayaan Perempuan dan Perlindungan Anak Indonesia Yohana Yembise.</p>\r\n<p>sumber : http://presidenri.go.id</p>', 'Ekspresi wajah ceria tampak dari puluhan anak yang duduk dan berkumpul di halaman belakang Istana Kepresidenan Bogor, Jawa Barat.'),
(3, 40, 1, 'Buka Lapangan Kerja Lewat Ekspor Komponen Otomotif', '<p><strong>Presiden Joko Widodo memberikan apresiasi atas peningkatan angka ekspor komponen industri otomotif nasional. Hal itu diutarakannya usai membuka ajang Indonesia International Motor Show (IIMS) 2018, di Jakarta, Kamis (19/4/2018).</strong></p>\r\n<p>&ldquo;Kita melihat industri otomotif di negara kita itu berkembang begitu sangat cepatnya dan yang pertama saya senang karena ekspornya meningkat,&rdquo; ujar Presiden.</p>\r\n<p>Ekspor komponen terurai tersebut meningkat sebanyak 13 kali lipat dibanding dengan angka ekspor yang berhasil dibukukan tahun lalu. Hal ini juga diharapkan akan berbanding lurus dengan peningkatan lapangan kerja di sektor otomotif.</p>\r\n<blockquote>\r\n<p>&ldquo;INI JUGA AKAN MEMBUKA LAPANGAN PEKERJAAN YANG BESAR SEKALI TERUTAMA BAGI INDUSTRI INDUSTRI MENENGAH DAN KECIL YANG MEMPRODUKSI KOMPONEN-KOMPONEN BAIK KOMPONEN-KOMPONEN UTAMA MAUPUN PEMBANTU,&rdquo; TUTURNYA.</p>\r\n</blockquote>\r\n<p>Saat ini, ekspor komponen yang dilakukan memang masih terbatas ke negara-negara terdekat. Namun, Kepala Negara meyakini, dengan harga yang kompetitif, bukan tidak mungkin ekspor berikutnya dapat menembus keluar ASEAN.</p>\r\n<p>&ldquo;Kita melihat nanti kalau harganya kompetitif saya kira akan bisa keluar dari ASEAN ekspornya,&rdquo; ucapnya.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/iims-3.jpeg"><img class="alignnone size-full wp-image-21045" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/iims-3.jpeg" alt="" width="1268" height="830" /></a></p>\r\n<p>Selain itu, Presiden juga mengapresiasi perkembangan rancang bangun otomotif nasional, terutama dari sisi interior, yang disebutnya berkembang dengan sangat baik. Ia pun mendorong agar para pelaku industri untuk lebih berani membuat kreasinya sendiri maupun memodifikasi desain yang ada seperti halnya motor-motor modifikasi yang dipamerkan di sana.</p>\r\n<p>&ldquo;Saya kira ini memiliki peluang yang besar juga untuk kita ekspor meskipun pasar di dalam negeri juga besar. Ini juga bisa menjanjikan untuk dikembangkan pada masa mendatang,&rdquo; ujarnya.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/iims-4.jpeg"><img class="alignnone size-full wp-image-21046" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/iims-4.jpeg" alt="" width="1060" height="859" /></a></p>\r\n<p>Pemerintah sendiri akan terus memberikan dukungan dan dorongan agar industri otomotif Tanah Air dapat berkembang lebih pesat. Sejumlah upaya penyederhanaan regulasi dan sejumlah insentif serta penyiapan infrastruktur akan terus diusahakan.</p>\r\n<p>&ldquo;Regulasi-regulasi yang ada kita sederhanakan, urusan-urusan yang berkaitan dengan uji kelayakan dan uji emisi memang harus dibuka dan dipercepat. Kemudian yang terakhir Pelabuhan Patimban ini akan kita percepat dalam rangka ekspor untuk otomotif. Nantinya kita memiliki sebuah pelabuhan yang mengefisienkan biaya-biaya yang ada sehingga bisa bersaing dan berkompetisi dengan negara-negara lain,&rdquo; tandasnya.</p>\r\n<p>sumber : http://presidenri.go.id</p>', 'Presiden Joko Widodo memberikan apresiasi atas peningkatan angka ekspor komponen industri otomotif nasional. Hal itu diutarakannya usai membuka ajang Indonesia International Motor Show (IIMS) 2018, di Jakarta, Kamis (19/4/2018)'),
(4, 41, 1, 'Ajak Budayawan Jadi Teladan Bagi Masyarakat', '<p>Presiden Joko Widodo bersilaturahmi dengan sejumlah budayawan di beranda Istana Merdeka, Jakarta, pada Jumat sore, 6 April 2018.</p>\r\n<p>Tampak di antara para budayawan tersebut ialah Radhar Panca Dahana, Butet Kertaradjasa, Toety Herati N. Rooseno, Mohammad Sobary dan pelukis Nasirun.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/bu6.jpeg"><img class="alignnone size-large wp-image-20755" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/bu6-1024x833.jpeg" alt="" width="640" height="521" /></a></p>\r\n<p>Di beranda itu, Presiden sempat menuliskan &ldquo;Indonesia Maju&rdquo; pada sebuah kanvas yang disediakan di sana. Tulisan Presiden itu selanjutnya diselesaikan Nasirun dan juga Wayan Kun Adnyana hingga tampak apik.</p>\r\n<p>Ramah tamah antara Presiden dengan para budayawan dilanjutkan di taman yang berada di halaman tengah Kompleks Istana Kepresidenan. Dalam kesempatan tersebut, Presiden menyampaikan pentingnya upaya pelestarian seni budaya Tanah Air sebagai investasi sumber daya manusia di masa mendatang.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/bu18.jpeg"><img class="alignnone size-large wp-image-20757" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/bu18-1024x708.jpeg" alt="" width="640" height="443" /></a>Menurut Presiden, kebudayaan menjadi fondasi sebuah bangsa yang ikut menentukan daya saing dan kompetisi yang dimiliki sebuah negara. Hal tersebut sejalan dengan pemikiran yang disampaikan oleh salah satu budayawan Indonesia, Radhar Panca Dahana.</p>\r\n<p>&ldquo;Artinya nilai-nilai yang kita miliki ini akan menentukan bangsa ini bisa berkompetisi, bisa bersaing dengan negara lain atau tidak,&rdquo; ujar Presiden.</p>\r\n<p>Presiden juga menyampaikan pemikirannya terkait revolusi mental. Sejalan dengan budayawan Putu Wijaya, Presiden mengajak para budayawan untuk memberikan contoh yang baik kepada masyarakat terkait nilai-nilai budaya bangsa Indonesia.</p>\r\n<p>&ldquo;Revolusi mental itu bukan jargon yang saya kira kayak masa-masa lalu yang perlu diteriak-teriakan terus atau perlu diiklan-iklankan terus, saya kira bukan itu. Saya kira contoh lebih baik dari pada kita berteriak. Memberikan contoh adalah lebih baik daripada kita berteriak,&rdquo; ucap Presiden.</p>\r\n<p><strong>Hadiah Puisi dari Aceh</strong></p>\r\n<p>Sore itu Presiden juga mendapat hadiah berupa pembacaan puisi dari seorang budayawan Aceh, Lesik Keti Ara. Puisi ini berisi tentang ucapan terima kasih karena Jokowi telah membangun Bandara Rembele di Kabupaten Bener Meriah, Aceh.</p>\r\n<p>&ldquo;Sebagai ucapan terima kasih kami orang Gayo, terhadap peluncuran (bandara) Rembele, saya akan bacakan puisi pendek,&rdquo; kata Lesik Keti Ara.</p>\r\n<p>Bandara Rembele untuk Jokowi</p>\r\n<p>Kepakkan sayapmu lalu terbanglah, katanya<br />Orang-orang memandang ke tubuhnya yang dibalut kopo ulen-ulen, kain adat Gayo<br />Orang-orang juga memandang senyumnya yang tulus<br />Hari ini ku resmikan Bandara Rembele, katanya</p>\r\n<p>Itulah tanda cinta pada kampung kedua<br />Orang-orang rindu pada ucapan itu karena telah lama terasa dipinggirkan, bahkan diabaikan<br />Buka mata dan layangkan pandang ke tempat paling jauh ke wilayah tak tersentuh<br />Di sana kita bertemu, memadu cinta untuk negeri tercinta</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2018/04/bu18.jpeg"><img class="alignnone size-large wp-image-20757" src="http://www.presidenri.go.id/wp-content/uploads/2018/04/bu18-1024x708.jpeg" alt="" width="640" height="443" /></a>Turut mendampingi Presiden dalam acara tersebut adalah Menteri Sekretaris Negara Pratikno, Menteri Pendidikan dan Kebudayaan Muhadjir Effendy dan Kepala Badan Ekonomi Kreatif Triawan Munaf.</p>\r\n<p>sumber : http://presidenri.go.id</p>', 'Presiden Joko Widodo bersilaturahmi dengan sejumlah budayawan di beranda Istana Merdeka, Jakarta, pada Jumat sore, 6 April 2018'),
(5, 42, 1, 'Perguruan Tinggi, Lakukan Terobosan Besar di Bidang Pendidikan!', '<p>Pengembangan SDM selalu menjadi prioritas dalam kebijakan pemerintah, seperti akses masyarakat terhadap layanan kesehatan antara lain melalui Program Kartu Indonesia Sehat (KIS), akses masyarakat terhadap layanan pendidikan dilakukan melalui Program Kartu Indonesia Pintar (KIP), dan adanya beasiswa pendidikan vokasional dan training vokasional terus ditingkatkan.</p>\r\n<p>&ldquo;Namun mulai tahun ini, terutama tahun depan terobosan-terobosan besar harus kita lakukan di bidang pendidikan dan lebih spesifik lagi dalam pendidikan tinggi,&rdquo; ucap Presiden Joko Widodo ketika berbicara pada Peresmian Pembukaan Konvensi Kampus XIV dan Temu Tahunan XX Forum Rektor Indonesia Tahun 2018 yang dilaksanakan di Gedung Baruga Andi Pangeran Pettarani, Universitas Hasanuddin, Kota Makassar, Kamis 15 Februari 2018.</p>\r\n<p>Terobosan di bidang pendidikan harus lebih signifikan dibanding dengan terobosan pembangunan infrastruktur dalam tiga tahun terakhir ini. Presiden meyakini para rektor sudah mengetahui bahwa dalam tiga tahun ini pemerintah melakukan terobosan dengan membangun infrastruktur di berbagai daerah pinggiran dengan membangun jalan dan jembatan, bandara pelabuhan, waduk, pembangkit listrik di daerah yang selama ini tidak tersentuh.</p>\r\n<p>Presiden memberikan contoh mengapa pentingnya pembangunanan infrastruktur dengan menjelaskan tentang buruknya infrastruktur sehingga mengganggu mobilitas orang dan barang. Dalam tayangan yang dipaparkan, terlihat jelas buruknya jalan di Papua, dimana jarak 100 kilometer ditempuh dalam waktu dua sampai tiga hari. &ldquo;Tidak mungkin kita bisa bersaing dengan negara lain kalau biaya logistik dan transportasi masih dengan jalan seperti ini (buruk),&rdquo; tutur Presiden.</p>\r\n<p>Oleh karenanya, terobosan besar dalam pengembangan SDM, terobosan besar dalam pengembangan pendidikan tinggi harus dilakukan secara serius. &ldquo;Artinya Bapak Ibu Rektor harus kerja lebih serius! Karena ini nantinya sama seperti infrastruktur, kita akan mati-matian mengubah infrastruktur kita. SDM kita juga akan akan diubah konsep, cara, keputusan lapangan. Semuanya akan kita ubah,&rdquo; kata Kepala Negara.</p>\r\n<p>Di awal sambutan, Presiden mengatakan bahwa acara forum rektor hari ini seperti dalam sidang kabinet paripurna pada senin (12/2) lalu, karena dalam sidang kabinet tersebut, Presiden meminta kepada para menteri untuk memikirkan terobosan yang signifikan dalam mengembangkan SDM.</p>\r\n<p>&ldquo;Saya sampaikan kita harus mengejar dua hal yaitu investasi di bidang infrastruktur dan investasi di bidang SDM. Inilah dua hal ini yang harus kita kejar. Karena dua hal inilah kita ketinggalan dengan negara lain,&rdquo; ujar Presiden.</p>\r\n<p><strong>Manfaatkan Peluang Revolusi Industri 4.0 untuk Perkokoh Karakter Bangsa</strong></p>\r\n<p><a href="http://presidenri.go.id/wp-content/uploads/2018/02/FR4.jpeg"><img class="alignnone size-large wp-image-19742" src="http://presidenri.go.id/wp-content/uploads/2018/02/FR4-1024x604.jpeg" alt="" width="640" height="378" /></a>Dunia saat ini berjalan sangat cepat dan juga berubah sangat cepat. Globalisasi sudah tidak terhindarkan lagi. Kompetisi antar negara semakin ketat dan semua negara ingin jadi pemenang, termasuk kita. Teknologi juga berkembang sangat cepat, dari hari per hari, teknologi terus berkembang. Lalu lintas orang, lalu lintas barang, lalu lintas modal, lalu lintas informasi, semuanya berjalan sangat cepat. Demikian disampaikan Presiden Joko Widodo ketika memberikan sambutan pada Peresmian Pembukaan Konvensi Kampus XIV dan Temu Tahunan XX Forum Rektor Indonesia Tahun 2018 yang dilaksanakan di Gedung Baruga Andi Pangeran Pettarani, Universitas Hasanuddin, Kota Makassar, Kamis 15 Februari 2018.</p>\r\n<p>Revolusi Industri 4.0 yang sedang berlangsung harus diantisipasi secara serius. Digitilalisasi, computing power dan data analytic telah melahirkan terobosan-terobosan yang mengejutkan di berbagai bidang, yang men-disrupsi kehidupan kita. &ldquo;Bahkan men-disrupsi peradaban kita. Yang mengubah lanskap ekonomi global, nasional, dan daerah serta laskap politik global, nasional dan daerah. Lanskap interaksi global, nasional, dan daerah. Semuanya akan berubah,&rdquo; tutur Kepala Negara.</p>\r\n<p>Revolusi Industri 4.0 memang membawa beberapa akibat negatif, seperti media sosial pembawa berita bohong, juga pergeseran model-model bisnis yang mengakibatkan beberapa jenis pekerjaan tidak lagi dibutuhkan. &ldquo;Namun juga banyak kesempatan positif yang bisa kita pakai untuk menjadikan sebagai pemenang. Apabila kita bisa memanfaatkan peluang-peluang ini,&rdquo; kata Kepala Negara.</p>\r\n<p>Teknologi Cyber-Physical, misalnya ditandai dengan munculnya Autonomous Vehicle, mobil tanpa awak. Three-D-Printing, yang bisa membuat barang secara sempurna dengan cara yang cepat dan murah. Advanced Robotic yang bisa mengambil alih peran manusia.</p>\r\n<p>Yang kedua, Internet-of-Things, Big Data, Artificial Intellegence dan Virtual Reality. Ternyata terus berkembang, yang mulai diaplikasikan dalam Block-chain<br />juga dalam Crypto-currency yaitu mata uang yang tanpa bank sentral, yang saat ini sedang diperebutkan banyak orang.</p>\r\n<p>Yang ketiga perkembangan bio-teknologi juga banyak contohnya. Penggunaan computing power dalam Ilmu Syaraf, Teknologi Edit-DNA untuk mengembangkan pengobatan spesifik orang- per- orang berdasarkan DNA-nya. Bio-teknologi untuk pertanian moderen, multi-layer-urban-farming misalnya yang bisa meningkatkan produksi berlipat ganda tanpa butuh tambahan lahan.</p>\r\n<p>&ldquo;Peluang-peluang besar tersebut harus segera kita manfaatkan untuk kemajuan bangsa, untuk kemakmuran rakyat Indonesia. Kita manfaatkan Ilmu Pengetahuan dan Teknologi untuk memperkokoh karakter bangsa kita, memberantas kemiskinan, mengurangi ketimpangan, menciptakan peluang kerja, mengembangkan wirausaha-wirausaha baru serta untuk melayani semua warga negara secara berkeadilan di seluruh Tanah Air,&rdquo; ujar Presiden.</p>\r\n<p><strong>Perlu Deregulasi dan Debirokratisasi untuk Dukung Perguruan Tinggi</strong></p>\r\n<p><a href="http://presidenri.go.id/wp-content/uploads/2018/02/FR2.jpeg"><img class="alignnone size-large wp-image-19741" src="http://presidenri.go.id/wp-content/uploads/2018/02/FR2-1024x705.jpeg" alt="" width="640" height="441" /></a>Presiden Joko Widodo mengingatkan agar dalam bekerja harus fokus dan memiliki prioritas apa yang ingin dikerjakan. Jangan lagi anggaran dibagi rata ke berbagai kegiatan yang tanpa fokus. &ldquo;Bertahun-tahun dilakukan, hasilnya tiap tahun enggak berasa. Kontrolnya secara manajemen juga sulit. Kadang &lsquo;baunya&rsquo; saja tidak terasa, duitnya hilang, hasilnya juga tidak terlihat sama sekali. &lsquo;Baunya&rsquo; kadang-kadang tidak kelihatan, apalagi fisiknya,&rdquo; ujar Kepala Negara ketika memberikan sambutan pada Peresmian Pembukaan Konvensi Kampus XIV dan Temu Tahunan XX Forum Rektor Indonesia Tahun 2018 yang dilaksanakan di Gedung Baruga Andi Pangeran Pettarani, Universitas Hasanuddin, Kota Makassar, Kamis 15 Februari 2018.</p>\r\n<p>Untuk itu, Presiden selalu mengingatkan agar tidak terjebak pada rutinitas yang monoton. &ldquo;Harus berani melakukan perubahan dan berinovasi. Saya tegur pada Menristekdikti agar fakultas yang sudah berpuluh tahun tidak mengubah diri segera kita ubah karena dunia sudah berubah sangat cepatnya,&rdquo; kata Presiden.</p>\r\n<p>Pemerintah juga harus bergerak cepat karena yang memenangkan kompetisi hanyalah yang memiliki kecepatan. Sekarang bukan lagi negara besar yang menang terhadap negara kecil. &ldquo;Sekarang ini yang cepat adalah yang menang. Yang tanggap, yang responsif yang menang meski itu negara kecil,&rdquo; ujarnya.</p>\r\n<p>Oleh karena itu, berulang kali Presiden meminta dilakukan deregulasi untuk memangkas aturan yang menjebak dan menjerat diri kita sendiri. Selama tiga tahun ini Presiden terus berusaha memangkas regulasi, memangkas prosedur yang berbelit-belit.</p>\r\n<p>&ldquo;Saya masih mendengar guru, kepala sekolah tak sempat mendampingi murid belajar karena mengurus SPJ. Saya tidak tahu di perguruan tinggi sama atau tidak, sama saya kira. Negara ini habis energinya hanya klarena urusan SPJ,&rdquo; ucapnya.</p>\r\n<p>Untuk masalah SPJ ini, Presiden pernah menanyakan kepada menteri keuangan dimana terdapat 43 laporan yang harus disampaikan. Selain 43 laporan, terdapat 119 laporan turunannya. &ldquo;Coba apa negara ini hanya ngurusin 43 laporan plus anak laporan 119 tadi. Saya tidak mau lagi ini. Saya minta maksimal tiga laporan saja cukup. Laporan bertumpuk-tumpuk. Inilah rezim SPJ, rezim laporan yang ingin kita sederhanakan, sehingga semuanya dapat berjalan dengan cepat,&rdquo; ujar Presiden.</p>\r\n<p>Selain kepala sekolah, guru dan dosen tidak sempat mendampingi siswa karena mengurus SPJ, penyuluh pertanian tak sempat pergi ke sawah karena sibuk membuat proposal dan laporan bantuan. &ldquo;Ini sama dengan SPJ, persis sama. Tadi sudah saya sampaikan, saya khawatir jangan-jangan dosen dan rektor sibuk urus administrasi, SPJ penelitian daripada mengajar dan meneliti,&rdquo; kata Presiden.</p>\r\n<p>Untuk itu, Presiden memerintahkan Menristekdikti untuk melakukan deregulasi dan debirokratisasi di Kementerian Riset, Teknologi dan Pendidikan Tinggi. Hal ini perlu dilakukan agar jajaran perguruan tinggi tidak lagi mengalami kesulitan dalam mengurus banyak hal.</p>\r\n<p>&ldquo;Duduk dengan menteri-menteri terkait, kembangkan sistem informasi handal, bangun aplikasi yang simpel dan menyederhanakan administrasi. Karena ini menjadi contoh bagi kementerian lain. Karena biasanya yang cepat mengubah dan berubah itu perguruan tinggi dan dimulai dari kemenristekdikti. Berubah terlebih dahulu. Ini sebenarnya mudah asal niat, asal mau,&rdquo; ujar Presiden.</p>\r\n<p><strong>Ingatkan Perguruan Tinggi Tingkatkan Kualitas Untuk Hadapi Era Kompetisi</strong></p>\r\n<p><a href="http://presidenri.go.id/wp-content/uploads/2018/02/FR1.jpeg"><img class="alignnone size-large wp-image-19740" src="http://presidenri.go.id/wp-content/uploads/2018/02/FR1-1024x705.jpeg" alt="" width="640" height="441" /></a></p>\r\n<p>Saat ini tidak ada pilihan lain bahwa kita untuk harus cepat berbenah, bekerja secara cepat dan efisien, berani melakukan perubahan besar dan terus melakukan inovasi. Bahkan tanpa adanya kompetisi maka budaya yang berkembang adalah budaya yang lamban dan tidak inovatif karena tidak ada kompetitor. Hal ini disampaikan Presiden Joko Widodo ketika memberikan sambutan pada Peresmian Pembukaan Konvensi Kampus XIV dan Temu Tahunan XX Forum Rektor Indonesia Tahun 2018 yang dilaksanakan di Gedung Baruga Andi Pangeran Pettarani, Universitas Hasanuddin, Kota Makassar, Kamis 15 Februari 2018.</p>\r\n<p>Presiden teringat ketika dirinya masih duduk di bangku SMP, bank milik pemerintah tutup pada pukul 13 karena tidak adanya bank pesaing. Tapi setelah muncul bank-bank swasta, bank-bank pemerintah langsung berbenah diri dan tetap memenangkan kompetisi.</p>\r\n<p>&ldquo;Ternyata alhamdulillah keuntungan terbesar ada di BRI bukan bank swasta, bukan bank asing. Artinya bank pemerintah bisa berkompetisi dengan bank asing ataupun bank swasta,&rdquo; ujar Presiden.</p>\r\n<p>Di bidang perguruan tinggi, Presiden telah menerima usulan dari Menteri Riset, Teknologi dan Pendidikan Tinggi M Nasir. &ldquo;Pak, ini perguruan tinggi kalau enggak berubah kita kasih kompetisi dengan universitas asing,&rdquo; ucap Presiden menyampaikan usulan Menristekdikti.</p>\r\n<p>Namun Presiden tidak lantas menyetujuinya dan meminta Menristekdikti berbicara dengan semua rektor, baik negeri maupun swasta.</p>\r\n<p>&ldquo;Kalau tanpa diberi kompetitor berubah ya enggak usah. Tapi kalau kita tunggu enggak berubah ya kita beri. Gimana setuju atau tidak? Kok diam semua. Silakan nanti dibicarakan dengan Menristekdikti,&rdquo; ujar Kepala Negara.</p>\r\n<p>Presiden memahami bahwa kondisi perguruan tinggi beragam. &ldquo;Ada yang memang sudah bisa dikatakan world class university. Tapi juga ada perguruan tinggi baru yang masih dihadapkan pada permasalahan-permasalahan dasar,&rdquo; tutur Kepala Negara.</p>\r\n<p>Tapi harus diingat, bahwa keduanya memiliki potensi yang sama untuk memberikan kontribusi kepada masyarakat. &ldquo;Ada yang kontribusinya pada masyarakat lokal, ada yang levelnya nasional maupun internasional,&rdquo; ucapnya.</p>\r\n<p>Presiden mengingatkan bahwa tidak semua perguruan tinggi perlu menjadi world class. Tapi semua perguruan tinggi, perlu menjadi relevan dan berkontribusi kepada masyarakat di sekitarnya.</p>\r\n<p>Misalnya sebuah perguruan tinggi yang berada di daerah pesisir atau kepulauan bisa memberikan nilai lebih atas keberadaan pantai atau laut di daerahnya melalui inovasi pembudidayaan ikan, pengolahan hasil-hasil laut, pelestarian budaya bahari dan yang lainnya.</p>\r\n<p>Begitu juga dengan perguruan tinggi yang berada di daerah pertanian. Inovasi pengelolaan lahan yang efektif dan efisien, teknologi peningkatan hasil peternakan dan industri pengolahannya. Penyediaan energi yang efisien dan masih banyak lagi.</p>\r\n<p>Bagi perguruan tinggi yang besar yang sudah masuk dalam arena kompetisi global, harus mampu bersaing dan memenangkan kompetisi global.<br />&ldquo;Mengembangkan Prodi atau Departeman atau Fakultas baru yang baru, yang inovatif, yang memanfaatkan peluang lanskap ekonomi global,&rdquo; kata Presiden.</p>\r\n<p>Misalnya, sebagai implikasi industri 4.0 dan berkembangnya life style industry. Dikembangkan Program Studi Computional Data Science yang mencetak Data Scientist, Digital Economy juga e-commerce.</p>\r\n<p>Selain itu juga, Presiden minta dipikirkan adanya fakultas digital ekonomi jurusan retail manajemen. &ldquo;Lalu fakultas manajemen logistik karena logistik begitu sangat berperan mendistribusikan barang. Ke depan juga berkaitan dengan services atau jasa juga penting sekali,&rdquo; tuturnya.</p>\r\n<p>Untuk mendukung industri sepak bola seharusnya sudah ada fakultas industri olahraga. &ldquo;Jurusan manajemen sepak bola atau langsung saja fakultas manajemen sepakbola. Itu ada di negara lain. Ada enggak di sini yang fakultas industri olahraga? Enggak ada kan,&rdquo; kata Presiden.</p>\r\n<p>Juga jurusan industri life style yang lain seperti Kopi dan Coklat. &ldquo;Sekali lagi, kata kuncinya adalah relevansi dan inovasi. Jangan lagi terjebak pada rutinitas. Cara-cara baru harus dikembangkan. Keinginan mahasiswa dan dosen untuk berinovasi harus ditumbuhkan. Kreasi-kreasi baru harus difasilitasi dan dikembangkan. Saya yakin Bapak dan Ibu bisa bersinergi dengan pemerintah untuk melakukan terobosan besar,&rdquo; ujar Presiden.</p>\r\n<p>Turut hadir mendampingi Presiden dan Ibu Negara Iriana Joko Widodo, Menteri Sekretaris Negara Pratikno, Menteri Riset, Teknologi dan Pendidikan Tinggi M Nasir, Menteri Pendidikan dan Kebudayaan Muhadjir Effendy, Menteri PU dan Perumahan Rakyat Basuki Hadimuljono, Gubernur Sulawesi Selatan Syahrul Yasin Limpo, Ketua FRI Suyatno dan Rektor Universitas Hasanuddin Dwia Ariestina Pulubuhu.</p>\r\n<p>sumber : http://presidenri.go.id</p>', 'Terobosan di bidang pendidikan harus lebih signifikan dibanding dengan terobosan pembangunan infrastruktur dalam tiga tahun terakhir ini.'),
(6, 43, 1, 'Presiden Jokowi : Membangun Kekuatan TNI Harus Direncanakan dengan Matang', '<p><strong>SIARAN PERS &ndash; </strong>Dalam lima tahun mendatang, Presiden Joko Widodo menyadari bahwa untuk membangun TNI yang profesional dan disegani, harus mampu memenuhi alutsista bagi trimatra secara terpadu. Hal ini disampaikan Presiden dalam arahan pembuka rapat terbatas dengan topik bahasan Pembangunan Kekuatan TNI di Kantor Presiden, 23 Februari 2016.</p>\r\n<figure id="attachment_4324" class="wp-caption alignleft"><a href="http://presidenri.go.id/wp-content/uploads/2016/02/IMG_4132.jpg" rel="attachment wp-att-4324"><img class="size-medium wp-image-4324" src="http://presidenri.go.id/wp-content/uploads/2016/02/IMG_4132-300x144.jpg" alt="Foto: Rusman_Biro Pers, Media, dan Informasi, Sekretariat Presiden" width="300" height="144" /></a><figcaption class="wp-caption-text">Foto: Rusman_Biro Pers, Media, dan Informasi, Sekretariat Presiden</figcaption></figure>\r\n<p>Dalam ratas tersebut, Presiden memberikan sedikit gambaran tentang anggaran TNI, dimana rata-rata rasio belanja militer tahun 2005-2014 sebesar 0,82 persen dari Pendapatan Domestik Bruto (PDB). Sebelumnya, rata-rata rasio belanja militer tahun 2000-2004 hanya sebesar 0,78 persen dari PDB. &ldquo;Sekarang paling tidak 1,1 persen dari PDB kita,&rdquo; ucap Presiden.</p>\r\n<p>Bila pertumbuhan ekonomi terus meningkat dan di atas 6 persen, maka anggaran untuk TNI dapat mencapai angka 1,5 persen dari PDB. &ldquo;Ini sebuah angka yang besar, hitung-hitungan saya tadi kurang lebih bisa mencapai Rp. 250 triliyun. Ini angka yang harus mulai diantisipasi dari sekarang, artinya harus ada sebuah perencanaan yang betul-betul matang, betul-betul detail, betul-betul terinci sehingga anggaran dan uang itu betul-betul dipergunakan dengan baik, tepat guna dan juga terdesain dari awal,&rdquo; ucap Presiden.</p>\r\n<figure id="attachment_4325" class="wp-caption alignright"><a href="http://presidenri.go.id/wp-content/uploads/2016/02/IMG_4135.jpg" rel="attachment wp-att-4325"><img class="size-medium wp-image-4325" src="http://presidenri.go.id/wp-content/uploads/2016/02/IMG_4135-300x180.jpg" alt="Foto: Rusman_Biro Pers, Media, dan Informasi, Sekretariat Presiden" width="300" height="180" /></a><figcaption class="wp-caption-text">Foto: Rusman_Biro Pers, Media, dan Informasi, Sekretariat Presiden</figcaption></figure>\r\n<p>Untuk itu, Presiden menekankan agar perencanaannya harus matang. &ldquo;Detil dalam sebuah strategi pembangunan kekuatan kita seperti apa. Ini mungkin yang kita inginkan ke depan,&rdquo; kata Presiden.</p>\r\n<p>Dan yang kedua juga agar dilihat mengenai penggunaan produk-produk dalam negeri. &ldquo;Ini sangat penting sekali misalnya kita lihat memang belanja-belanja yang ada. Saya kira porsi-porsi seperti belanja pegawai belanja barang dan belanja untuk alutsista sudah baik. Tetapi sekali lagi bahwa perencanaannya harus matang, detail dalam sebuah strategi pembangunan kekuatan kita seperti apa. Ini mungkin yang kita inginkan ke depan,&rdquo; ujar Presiden.</p>\r\n<p>Lebih lanjut Presiden menyatakan bahwa pemenuhan kebutuhan alutsista ini sebenarnya bisa sejalan dengan upaya negara mewujudkan kemandirian pertahanan negara dengan pengembangan industri alat pertahanan dalam negeri. &ldquo;Agar dilihat mengenai penggunaan produk-produk dalam negeri. Ini sangat penting sekali,&rdquo; ucap Presiden.</p>\r\n<p>sumber : http://presidenri.go.id</p>', 'Dalam lima tahun mendatang, Presiden Joko Widodo menyadari bahwa untuk membangun TNI yang profesional dan disegani, harus mampu memenuhi alutsista bagi trimatra secara terpadu.'),
(7, 44, 1, 'Sukses Pariwisata Indonesia di Forum Dunia', '<p><strong>BANGKOK-</strong> Forum World Travel &amp; Tourism Council (WTTC) Global Summit, 26-27 April 2017 benar-benar menjadi panggung buat Wonderful Indonesia. Sekjen UNWTO &ndash; United National World Tourism Organization Taleb Rifai yang memimpin Ministrial Dialogue itu secara khusus meminta Menpar Arief Yahya untuk bertestimoni kisah sukses mengembangkan Wonderful Indonesia.</p>\r\n<p>Menpar Arief pun memaparkan key success factorsnya di Hyatt Hotel Erawan, Bangkok, Thailand di hadapan para menteri pariwisata, dan private sector itu. Di hadapan private sector CEO&rsquo;s investment and partnerships for Sustainable Tourism Development itu, Mantan Dirut PT Telkom itu berkisah.</p>\r\n<p>Dalam sesi WTTC-United Nation World Tourism Organization (UNWTO) Ministerial Dialogue, Selasa (25/4), Arief membeberkan pariwisata Indonesia terkini. Menurutnya, peran CEO Commitment atau keberpihakan Presiden Joko Widodo untuk sektor pariwisata itu paling penting.</p>\r\n<p>&ldquo;Apalagi Presiden Joko Widodo telah menempatkan pariwisata sebagai leading sector pembangunan. Maka seluruh Kementerian dan Lembaga mendukung pengembangan infrastruktur pariwisata, terutama di sepuluh destinasi yang biasa kami sebut dengan istilah Sepuluh Bali Baru,&rdquo; ujar Arief di forum itu.</p>\r\n<p>Di forum yang dihadiri para chief executive officer (CEO) perusahaan investasi dan kemitraan untuk program pengembangan pariwisata berkelanjutan atau sustainable tourism development (STD) itu Arief sekaligus mengucapkan terima kasih kepada The World Bank.</p>\r\n<p>&ldquo;Tiga dari 10 destinasi wisata unggulan di Indonesia, yakni Danau Toba, Borobudur dan Mandalika, disupport pembiayaan infrastrukturnya oleh World Bank. Terima kasih World Bank,&rdquo; sebut Arief Yahya.</p>\r\n<p>Menteri Arief yang asli Banyuwangi ini pun membanggakan kepedulian Presiden Jokowi pada pariwisata. Sebab, Presiden Jokowi terus mendorong upaya untuk memoles destinasi wisata unggulan di Indonesia. Presiden sendiri yang mengendors pariwisata sehingga menjadi sektor unggulan, selain infrastruktur, pangan, energi, dan maritime.</p>\r\n<p>&ldquo;Untungnya kami punya presiden yang peduli pada turisme. Presiden menempatkan turisme sebagai leading sector sehingga semuanya menjadi jauh lebih mudah, lebih cepat dan lebih baik,&rdquo; tegasnya.</p>\r\n<p>Arief tak mau sekadar mengumbar klaim. Menteri yang lulusan ITB Bandung, Surrey University Inggris dan Program Doktoral Unpad Bandung itu lantas menyodorkan bukti.</p>\r\n<p>Guna memudahkan wisatawan mancanegara masuk Indonesia, pemerintah Indonesia telah menyediakan fasilitas bebas visa. &ldquo;Kami sekarang memfasilitasi 169 negara sebagai penerima bebas visa,&rdquo; sebutnya, yang semula hanya 25 negara, yang Bebas Visa Kunjungan (BVK) itu.</p>\r\n<p>Menurut Arief, imbas kebijakan itu sangat terasa. &ldquo;Tahun pertana, sejak pemberlakuan Bebas Visa Kunjungan itu, jumlah wisatawan mancanegara yang masuk ke Indonesia naik dramatik, 20 persen,&rdquo; akunya, yang membuat seluruh audience terdiam.</p>\r\n<p>Kebijakan BVK itu, sejatinya bermula dari saran para petinggi UNWTO saat Menpar Arief buka-bukaan mempresentasikan kondisi pariwisata Indonesia. Terutama dengan target double, dari 9,3 juta 2014, harus melompat ke 20 juta di 2019. Salah satu pointnya adalah Visa Fasilitation itu.</p>\r\n<p>Hampir semua sarannya dijalankan, termasuk harus mengkalibrasi dengan 14 pilar TTCI &ndash; Travel Tourism Competitiveness Index yang diformulasi World Economic Forum (WEF) itu. &ldquo;Point pertama: Go Digital! Menggunakan teknologi digital untuk percepatan pembangujan kepariwisataan Indonesia!&rdquo; jelas Arief yang berkali-kali dipuji Sekjen UNWTO Taleb Rifai itu.</p>\r\n<p>Sejak di ITB Berlin bulan lalu, Arief Yahya diundang secara khusus oleh Minister of Tourism and Sport Thailand Kobkarn Wattanavrangkul untuk hadir di Bangkok ini. Dia bahkan datang sendiri ke Pavilion Wonderful Indonesia di pameran industri pariwisata terbesar dunia itu.</p>\r\n<p>Karena itu, baik Menteri Kobkarn maupun Permanent Secretary Thailand Pongpanu Svetarundra yang hadir di acara itu mengucapkan terima kasih pada Menpar Arief yang hadir dan menjadi pemapar success story pariwisata Indonesia.</p>\r\n<p>sumber :&nbsp;http://presidenri.go.id</p>', 'Menpar Arief pun memaparkan key success factorsnya di Hyatt Hotel Erawan, Bangkok, Thailand di hadapan para menteri pariwisata, dan private sector itu.'),
(8, 45, 1, 'Semua Pemeriksaan Tanpa Keluar Uang', '<p><strong>Diluncurkan hampir tiga tahun lalu, Kartu Indonesia Sehat (KIS) dan Kartu Indonesia Pintar (KIP) menjadi strategi Presiden Jokowi untuk memberi akses seluas-luasnya kesehatan dan pendidikan bagi masyarakat yang kurang mampu. Redaksi presidenri.go.id menemui dua orang yang merasa sangat terbantu menerima kartu ini. </strong></p>\r\n<p>Disambangi di Puskesmas Pandanaran, Kota Semarang, Rabu (23/8/2017) Budiati, pengguna KIS bersyukur kesehatan seluruh anggota keluarganya ditanggung pemerintah dengan kartu ini. &ldquo;Awalnya ada yang ngantar pos ke rumah, setelah amplop saya buka ternyata isinya KIS,&rdquo; ungkapnya. Ia mengaku tidak tahu apa KIS. Kemudian, ia berinisiatif menanyakan kepada Ketua Rukun Tetangga di Wonotrikopen tempat tinggalnya. Ketua RT lantas menjelaskan, KIS bisa dipakai untuk pemeriksaan kesehatan di Puskesmas.</p>\r\n<p>Sejak itu (setahun lalu), Budiati pun selalu memeriksakan kesehatan ke Puskesmas tersebut. Seperti pada 22 Agustus 2017 lalu, ia memeriksakan rutin kehamilannya yang memasuki bulan ke-9. Sebelumnya, rupa-rupa pemeriksaan kesehatan ia dan keluarga pernah dijalani. Mulai dari operasi pada leher, menjahit luka tangan anaknya yang terkena kaca, dan pemeriksaan rutin lainnya. &ldquo;Saya terimakasih sekali pada pemerintah, semua pemeriksaan tanpa keluar uang, seribu pun tidak,&rdquo; ujar Budiati.</p>\r\n<p>Masih di kota Lumpia, kami menemui Angle, siswi SMPN 7, kelas 9. Angle yang sudah dua tahun menerima manfaat Kartu Indonesia Pintar (kelas 8 dan 9) merasa terbantu dengan KIP. &ldquo;Semua kebutuhan sekolah saya tercukupi oleh dana dari KIP. Mulai dari tas, buku, sepatu, dan kebutuhan sekolah lainnya,&rdquo; ucapnya.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2017/09/penerima-KIS.jpg"><img class="alignnone size-large wp-image-16206" src="http://www.presidenri.go.id/wp-content/uploads/2017/09/penerima-KIS-1024x683.jpg" alt="" width="640" height="427" /></a></p>\r\n<p>Angle yang bertekad bisa melanjutkan ke SMA , yang baik ini bercerita bagaimana mudahnya proses mendapatkan KIP. &ldquo;Saya kumpulkan kartu keluarga, akta kelahiran, fotocopy KTP, rapor, dan kartu pengambilan KIP,&rdquo; jelasnya. Menurutnya, pencairan KIP juga mudah. &ldquo;Pertama coba langsung dapat Rp 750 ribu. Jumlah tersebut merupakan akumulasi bantuan dan sisa dari dari bantuan sebelumnya,&rdquo; ungkapnya</p>\r\n<p>Walikota Semarang Hendrar Prihadi mengapresiasi program KIS dan KIP yang dicanangkan pemerintah dan memfasilitasi itu sebagai <em>wildcard </em>untuk pelayanan kesehatan dan pendidikan bagi warga miskin di Kota Semarang. &ldquo;Ini sebuah terobosan di zaman Pak Jokowi, bantuan-bantuan tersebut tidak diberikan secara tunai, namun lewat sebuah kartu, yang merangsang masyarakat untuk tidak konsumtif,&rdquo; ungkap Hendrar.</p>\r\n<p>Kepala Dinas Kesehatan Kota Semarang Sarwoko Utomo menjelaskan, KIS meng-<em>cover </em>kesehatan seluruh rakyat Indonesia dalam mendapatkan pengobatan gratis, baik rawat jalan maupun rawat inap di rumah sakit pelayanan kesehatan lain baik pemerintah atau swasta. &ldquo;Jadi KIS membantu sekali, ada yang sakit negara hadir,&rdquo; ungkapnya.</p>\r\n<p>Harus diakui, kesehatan dan pendidikan merupakan sektor yang menopang sumber daya manusia di masa depan. Di lain sisi biaya kesehatan dan pendidikan semakin hari semakin mahal. Tanpa intervensi pemerintah, masyarakat miskin makin lama makin tertinggal. Baik kesehatannya ataupun intelektualnya. Di sinilah peran pemerintah dalam membantu mereka agar tetap bisa mendapatkan pelayanan di sektor yang sangat strategis ini.</p>\r\n<p>Itulah sebabnya, sejak awal, kesehatan dan pendidikan juga sudah jadi prioritas yang tertuang dalam Rencana Pembangunan Jangka Menengah Nasional (RPJMN). RPJMN bidang kesehatan 2015-2019 menyebut langkah yang wajib dilakukan, yakni: (1) meningkatkan status kesehatan dan gizi ibu dan anak; (2) meningkatnya pengendalian penyakit; (3) bertambahnya akses dan mutu pelayanan kesehatan dasar dan rujukan terutama di daerah terpencil, tertinggal dan perbatasan; (4) memperluas cakupan pelayanan kesehatan universal melalui Kartu Indonesia Sehat dan kualitas pengelolaan SJSN kesehatan, (5) terpenuhinya kebutuhan tenaga kesehatan, obat dan vaksin; serta (6) meningkatkan responsivitas sistem kesehatan.</p>\r\n<p>Enam sasaran tersebut dijalankan lewat 3 pilar. Yakni, 1) Paradigma sehat dilakukan dengan promotif preventif dan pemberdayaan masyarakat; 2) Peningkatan akses layanan kesehatan, sistem rujukan dan peningkatan mutu pelayanan kesehatan, menggunakan pendekatan continuum of care dan intervensi berbasis risiko. kesehatan; 3) Perluasan sasaran dan benefit jaminan kesehatan nasional dengan memperhatikan mutu dan mengendalikan biaya.</p>\r\n<p><a href="http://www.presidenri.go.id/wp-content/uploads/2017/09/bonus-demografi-2.jpg"><img class="alignnone size-large wp-image-16208" src="http://www.presidenri.go.id/wp-content/uploads/2017/09/bonus-demografi-2-1024x836.jpg" alt="" width="640" height="523" /></a></p>\r\n<p>Sementara di sektor pendidikan, RPJMN mengamanatkan peningkatan kualitas pembelajaran di semua jenjang dan jalur pendidikan, perhatian lebih besar pada daerah tertinggal, terluar, dan terdepan (3T), memastikan masyarakat miskin dan kelompok marjinal lebih mudah mengakses layanan pendidikan dengan memperhatikan keadilan dan kesetaraan gender.<br />Melalui pemberian KIP, pemerintah berharap agar anak-anak putus sekolah dapat melanjutkan sekolah. Pemerintah juga berharap masyarakat membantu pemerintah dengan mendorong penerima KIP untuk memanfaatkan KIP sebagai sarana dalam membantu meraih cita-cita dan melanjutkan sekolah sampai jenjang pendidikan yang lebih tinggi.</p>\r\n<p>Data menunjukkan, Kementerian Pendidikan dan Kebudayaan (Kemendikbud) pada Juni 2017, telah menyalurkan KIP selama tahun 2017 kepada 7.674.914 siswa atau 42 persen dari target sebesar 17.927.308 siswa. KIP merupakan bantuan pendidikan dari Program Indonesia Pintar (PIP) yang diberikan pemerintah kepada anak usia 6 sampai 21 tahun yang berasal dari keluarga miskin/rentan miskin, berstatus yatim piatu/yatim/piatu, peserta Program Keluarga Harapan (PKH), keluarga pemegang Kartu Keluarga Sejahtera (KKS).<br />Presiden Jokowi menegaskan, masyarakat pengguna Kartu Indonesia Sehat (KIS) harus dilayani dengan baik. Bahkan, jika pengguna KIS merasa tidak mendapat pelayanan sebagaimana mestinya, Presiden meminta agar dilaporkan langsung kepadanya.</p>', 'Diluncurkan hampir tiga tahun lalu, Kartu Indonesia Sehat (KIS) dan Kartu Indonesia Pintar (KIP) menjadi strategi Presiden Jokowi untuk memberi akses seluas-luasnya kesehatan dan pendidikan bagi masyarakat yang kurang mampu. Redaksi presidenri.go.id '),
(9, 46, 1, 'Reformasi Perpajakan untuk Kesejahteraan Rakyat', '<p>Sejak awal Januari 2016, Presiden Joko Widodo meminta seluruh perusahaan di Indonesia tidak ragu untuk meminta pengampunan pajak atau Tax Amnesty apabila aturan tersebut keluar. Dengan program ini, perusahaan besar maupun kecil akan mendapat sejumlah keringanan dalam perpajakan.</p>\r\n<p>Rancangan Undang-undang (RUU) Pengampunan Pajak atau Tax Amnesty yang didorong pemerintah untuk segera disahkan merupakan upaya mereformasi perpajakan di Indonesia. Tujuan utamanya adalah perluasan basis data pajak dalam rangka melakukan akselerasi pembangunan yang berkelanjutan.</p>\r\n<p>&ldquo;Tidak usah ragu lagi (aturannya) seperti apa. Pemerintah memberikan jaminan, Presiden juga memberikan jaminan,&rdquo; kata Presiden Jokowi dalam pembukaan perdagangan di Gedung Bursa Efek Indonesia, Jakarta, 4 Januari 2016.</p>\r\n<p>Selain sebagai pintu masuk, Tax Amnesty adalah langkah awal dalam reformasi perpajakan secara lebih luas yang akan berimbas pada perubahan-perubahan UU lain seperti UU Ketentuan Umum Perpajakan (KUP) dan UU Perbankan.</p>\r\n<p>Dalam konteks UU KUP, poin-poin penting yang masih harus diperjelas antara lain hak-hak pembayar pajak, prosedur pembayaran pajak dan administrasi yang lebih sederhana serta adanya kepastian hukum bagi pembayar pajak. Revisi terhadap UU KUP menjadi penting agar terjadi kesetaraan hak-hak bagi setiap pembayar pajak.</p>\r\n<p>Berbagai program reformasi pajak ini, akan sejalan dengan program lain yang juga masuk dalam ranah reformasi birokrasi seperti penerapan Single Identification Number (SIN). Penerapan SIN akan memberikan dampak positif yang luas dan menyentuh ke berbagai aspek kehidupan masyarakat. Melalui SIN, semua data perorangan akan terangkum dalam satu nomor identifikasi. SIN akan mempermudah pemerintah dalam mengelola pembayar pajak hingga menyalurkan program-program sosial secara tepat sasaran.</p>\r\n<p>Untuk melengkapi upaya reformasi perpajakan, pemerintah telah mengintrodusir gagasan pembentukan badan otonom yang akan mengurusi penerimaan perpajakan, sehingga basis data yang telah dimiliki dapat dikelola dengan baik. Badan otonom penerimaan pajak harus memiliki kemandirian yang cukup sehingga bisa menentukan program yang tepat sasaran dan kelayakan sumber daya manusia yang dibutuhkan.</p>\r\n<p>Pembentukan badan otonom akan memberikan dampak positif seperti meningkatnya kepercayaaan pembayar pajak melalui berbagai pelayanan yang diberikan secara profesional, akuntabel dan transparan.</p>\r\n<p>Dorongan kuat dari Presiden Jokowi kepada legislatif untuk segera mengesahkan RUU Pengampunan Pajak merupakan tindakan yang akan dinikmati masyarakat dalam waktu panjang. Penguatan dan perluasan basis data pajak melalui RUU ini merupakan langkah awal yang semestinya didukung berbagai pihak agar reformasi perpajakan untuk kesejahteraan masyarakat dapat berjalan efektif.</p>\r\n<p>Dalam jangka pendek, manfaatnya akan segera terasa dengan masuknya dana dalam jumlah cukup besar ke Indonesia. Sehingga akselerasi pembangunan yang terus didorong oleh Presiden Jokowi dapat terlaksana dan terselesaikan secara tepat waktu.</p>\r\n<p>Menurut perhitungan Ketua Tim Ahli Wakil Presiden, Sofjan Wanandi, ada sekitar 100 miliar dolar AS atau sekitar Rp1.350 triliun dana milik orang Indonesia di luar negeri yang berpotensi masuk ke Indonesia jika Tax Amnesty berjalan. Namun, jika di tahap awal pemerintah mampu menarik separuh dari jumlah itu, sudah akan sangat signifikan dalam akselerasi pembangunan nasional.</p>\r\n<p>Selama lima tahun ke depan, untuk membangun infrastruktur seperti yang tertuang dalam Nawacita, negara membutuhkan dana sekitar Rp. 5.000 triliun. Selain melalui APBN, kebutuhan pembiayaan pembangunan ini akan diperoleh melalui investasi sektor swasta.</p>', 'Mengapa Presiden Jokowi mendorong RUU pengampunan pajak? Satu jawaban pasti: Tax Amnesty bisa memperluas basis pajak secara nasional dan menjadi pintu masuk reformasi perpajakan secara menyeluruh.'),
(10, 47, 1, '3 Tahun Jokowi', '<p>Di tahun ke-3 mewujudkan janji Nawacita-nya, pemerintahan Joko Widodo dan Jusuf Kalla, mulai menunjukan hasil positif. Kerja nyata tahap demi tahap, dilakukan untuk mengatasi ketimpangan sosial. Membangun manusia Papua menjadi salah satu tujuan besar pemerintah.</p>', ''),
(11, 48, 1, 'Perubahan Sektor di Era Jokowi', '<p>TIGA TAHUN PRESIDEN JOKO WIDODO (JOKOWI) MEMIMPIN MAMPU BUAT PERUBAHAN DI SEJUMLAH SEKTOR, MASYARAKAT PUAS KINERJA JOKOWI, PENCAPAIAN JOKOWI SELAMA TIGA TAHUN MEMIMPIN INDONESIA.</p>', ''),
(12, 49, 1, 'Saham Freeport untuk Papua', '<p>Presiden Joko Widodo melalui Menteri ESDM Iganasius Jonan akhirnya sepakat untuk membagi porsi saham PT Freeport Indonesia sebanyak 10 persen kepada masyarakat Papua.</p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_hashtag`
--

CREATE TABLE `ar_posts_hashtag` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_position`
--

CREATE TABLE `ar_posts_position` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_posts_position`
--

INSERT INTO `ar_posts_position` (`id`, `title`, `slug`, `description`, `status`) VALUES
(1, 'HL News', 'hl-news', 'HL News', 1),
(3, 'HL Video', 'hl-video', 'HL Video', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_position_relation`
--

CREATE TABLE `ar_posts_position_relation` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `posts_position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_tag`
--

CREATE TABLE `ar_posts_tag` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ar_posts_view`
--

CREATE TABLE `ar_posts_view` (
  `id` int(11) NOT NULL,
  `posts_id` int(10) UNSIGNED NOT NULL,
  `user_ip` varchar(50) NOT NULL,
  `viewed` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_posts_view`
--

INSERT INTO `ar_posts_view` (`id`, `posts_id`, `user_ip`, `viewed`) VALUES
(1, 38, '::1', '2018-04-25 09:58:46'),
(2, 42, '::1', '2018-04-25 10:18:01'),
(3, 42, '::1', '2018-04-25 10:23:36'),
(4, 42, '::1', '2018-04-25 10:29:34'),
(5, 39, '::1', '2018-04-25 10:54:42'),
(6, 39, '::1', '2018-04-25 11:01:57'),
(7, 39, '::1', '2018-04-25 11:10:21'),
(8, 38, '::1', '2018-04-25 11:11:59'),
(9, 38, '127.0.0.1', '2018-04-25 11:12:20'),
(10, 38, '::1', '2018-04-25 11:29:40'),
(11, 38, '::1', '2018-04-28 09:43:34'),
(12, 38, '::1', '2018-04-28 09:48:58'),
(13, 39, '::1', '2018-04-28 09:53:26'),
(14, 39, '::1', '2018-04-28 10:09:04'),
(15, 44, '::1', '2018-04-28 10:19:50'),
(16, 45, '::1', '2018-04-28 01:01:44'),
(17, 38, '::1', '2018-04-30 10:30:38'),
(18, 38, '::1', '2018-05-01 10:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `ar_settings`
--

CREATE TABLE `ar_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ar_settings`
--

INSERT INTO `ar_settings` (`id`, `title`, `key`, `value`) VALUES
(1, 'Default Web Title', 'default_web_title', 'Komunitas Anak Bangsa'),
(2, 'Default Web Keyword', 'default_web_keyword', 'Komunitas Anak Bangsa'),
(3, 'Default Web Description', 'default_web_description', 'Komunitas Anak Bangsa'),
(7, 'Web Default Email', 'default_email', 'kab@gmail.com'),
(9, 'Web Offline Status', 'web_offline_status', 'NO'),
(10, 'Web Offline Messages', 'web_offline_message', 'Sorry, this site is temporarily closed for maintenance                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       '),
(13, 'Active Template Folder', 'active_template_folder', 'kab'),
(14, 'Facebook', 'facebook', 'https://www.facebook.com'),
(15, 'Twitter', 'twitter', 'https://twitter.com/komanakbangsa'),
(16, 'Youtube', 'youtube', 'https://www.youtube.com/user'),
(17, 'Instagram', 'instagram', 'https://www.instagram.com/komunitas.anakbangsa/'),
(18, 'Google Plus', 'gplus', 'http://google.com/'),
(19, 'Company Name', 'company_name', 'Komunitas Anak Bangsa'),
(20, 'Address 1', 'address_1', 'Jl. Pluit Raya Kav. 12 Blok A5, Penjaringan'),
(21, 'Address 2', 'address_2', 'Kota Jakarta Utara, DKI Jakarta, Indonesia 14440'),
(22, 'Telepon', 'telp', '(021) 6655925 ext. 122/103'),
(23, 'Fax', 'fax', ''),
(24, 'Linked in', 'linkedin', 'http://linkedin.com'),
(25, 'Short Company Profile', 'short_company_profile', 'Proactively fabricate one-to-one materials via effective e-business. Objectively integrate emerging core competencies before process-centric communities'),
(26, 'Content Jalan Tol', 'content_jalan_tol', '568 KM'),
(27, 'Content Bendungan', 'content_bendungan', '9'),
(28, 'Content Jembatan', 'content_jembatan', '25.149 KM'),
(29, 'Content Pembangkit Listrik', 'content_pembangkit_listrik', '9.246 MW'),
(30, 'Content Widget Twitter', 'content_widget_twitter', '<a class="twitter-timeline" href="https://twitter.com/komanakbangsa?ref_src=twsrc%5Etfw" height="400">Tweets by komanakbangsa</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>'),
(31, 'Content Widget Facebook', 'content_widget_facebook', '<div class="fb-page" data-href="https://www.facebook.com/jokowi/" data-tabs="timeline" data-width="370" data-height="400" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/jokowi/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/jokowi/">Presiden Joko Widodo</a></blockquote></div>'),
(32, 'Content Widget Instagram', 'content_widget_instagram', '<!-- SnapWidget -->\r\n<script src="https://snapwidget.com/js/snapwidget.js"></script>\r\n<iframe src="https://snapwidget.com/embed/541848" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `ar_subscriber`
--

CREATE TABLE `ar_subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_subscribe` int(11) NOT NULL,
  `subscribe_date` datetime NOT NULL,
  `unsubscribe_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_subscriber`
--

INSERT INTO `ar_subscriber` (`id`, `email`, `is_subscribe`, `subscribe_date`, `unsubscribe_date`) VALUES
(1, 'arbomb.serv@gmail.com', 1, '2018-04-17 23:31:12', '2018-04-18 06:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `ar_visitor`
--

CREATE TABLE `ar_visitor` (
  `id` int(11) NOT NULL,
  `user_ip` varchar(50) NOT NULL,
  `viewed` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ar_admin`
--
ALTER TABLE `ar_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `ar_admin_category`
--
ALTER TABLE `ar_admin_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_language`
--
ALTER TABLE `ar_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_media`
--
ALTER TABLE `ar_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `ar_media_category`
--
ALTER TABLE `ar_media_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_menu`
--
ALTER TABLE `ar_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_id` (`pages_id`);

--
-- Indexes for table `ar_menu_detail`
--
ALTER TABLE `ar_menu_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`,`language_id`);

--
-- Indexes for table `ar_pages`
--
ALTER TABLE `ar_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`admin_id`);

--
-- Indexes for table `ar_pages_detail`
--
ALTER TABLE `ar_pages_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`,`language_id`);

--
-- Indexes for table `ar_polling`
--
ALTER TABLE `ar_polling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_polling_answer`
--
ALTER TABLE `ar_polling_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_polling_option`
--
ALTER TABLE `ar_polling_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_posts`
--
ALTER TABLE `ar_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category_id`,`admin_id`);

--
-- Indexes for table `ar_posts_category`
--
ALTER TABLE `ar_posts_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_posts_category_detail`
--
ALTER TABLE `ar_posts_category_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`category_id`,`language_id`);

--
-- Indexes for table `ar_posts_detail`
--
ALTER TABLE `ar_posts_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`,`language_id`);

--
-- Indexes for table `ar_posts_hashtag`
--
ALTER TABLE `ar_posts_hashtag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_posts_position`
--
ALTER TABLE `ar_posts_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_posts_position_relation`
--
ALTER TABLE `ar_posts_position_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_posts_tag`
--
ALTER TABLE `ar_posts_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_posts_view`
--
ALTER TABLE `ar_posts_view`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`);

--
-- Indexes for table `ar_settings`
--
ALTER TABLE `ar_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_subscriber`
--
ALTER TABLE `ar_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_visitor`
--
ALTER TABLE `ar_visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ar_admin`
--
ALTER TABLE `ar_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ar_admin_category`
--
ALTER TABLE `ar_admin_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ar_language`
--
ALTER TABLE `ar_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ar_media`
--
ALTER TABLE `ar_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `ar_media_category`
--
ALTER TABLE `ar_media_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `ar_menu`
--
ALTER TABLE `ar_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `ar_menu_detail`
--
ALTER TABLE `ar_menu_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `ar_pages`
--
ALTER TABLE `ar_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ar_pages_detail`
--
ALTER TABLE `ar_pages_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ar_polling`
--
ALTER TABLE `ar_polling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ar_polling_answer`
--
ALTER TABLE `ar_polling_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ar_polling_option`
--
ALTER TABLE `ar_polling_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ar_posts`
--
ALTER TABLE `ar_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `ar_posts_category`
--
ALTER TABLE `ar_posts_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ar_posts_category_detail`
--
ALTER TABLE `ar_posts_category_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ar_posts_detail`
--
ALTER TABLE `ar_posts_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ar_posts_hashtag`
--
ALTER TABLE `ar_posts_hashtag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ar_posts_position`
--
ALTER TABLE `ar_posts_position`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ar_posts_position_relation`
--
ALTER TABLE `ar_posts_position_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ar_posts_tag`
--
ALTER TABLE `ar_posts_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ar_posts_view`
--
ALTER TABLE `ar_posts_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ar_settings`
--
ALTER TABLE `ar_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `ar_subscriber`
--
ALTER TABLE `ar_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ar_visitor`
--
ALTER TABLE `ar_visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
