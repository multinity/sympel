-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17 Jan 2016 pada 18.17
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sympel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `sy_gbook`
--

CREATE TABLE IF NOT EXISTS `sy_gbook` (
  `id` int(11) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `website` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `pada` datetime NOT NULL,
  `status` enum('Y','N','TRASH') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sy_halaman`
--

CREATE TABLE IF NOT EXISTS `sy_halaman` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `menu` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `informasi` text NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `gplus` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `pada` datetime NOT NULL,
  `status` enum('INTRO','TENTANG','KONTAK') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sy_halaman`
--

INSERT INTO `sy_halaman` (`id`, `judul`, `menu`, `isi`, `informasi`, `facebook`, `twitter`, `gplus`, `url`, `pada`, `status`) VALUES
(1, 'Hi! We''re Sympel | Open source one page CMS', 'Intro', '<p><strong>Selamat datang !</strong> di website sederhana kami. Disini anda bisa melihat - lihat lebih jauh tentang kami, portofolio kami dan teman - teman satu tim kami, disini juga anda dapat memberikan komentar anda kepada kami. Kami hadir untuk membantu anda dalam pembuatan website personal, jika anda berminat untuk membuat website personal sendiri, anda hanya perlu mengunduh software/aplikasi sederhana yang telah kami buat.</p>', '', '', '', '', '', '2014-09-27 22:21:46', 'INTRO'),
(2, 'Tentang Kami', 'Tentang Kami', '<p>Terimakasih sudah menggunakan <i>sympel(CMS)</i>, sympel merupakan sebuah Content Management System(CMS) sederhana untuk membuat website dengan desain satu halaman. Tujuan utama CMS ini dibuat adalah untuk membantu pengembang-pengembang lain dalam memahami konsep dasar CMS. <i>Sympel</i> dibuat sangat sederhana karena keterbatasan waktu dan kemampuan saya yang masih duduk dibangku kelas 2 SMK. <br><br> Semoga <i>sympel</i> dapat membantu anda untuk membuat CMS yang anda buat sendiri. <i>Happy coding!</i></p>', '', '', '', '', '', '2014-09-27 22:26:44', 'TENTANG'),
(3, 'Kontak Kami', 'Kontak Kami', '<p>Dibagian ini anda bisa mengetahui informasi tentang saya dan anda bisa mengirim kritik/saran kepada kami.</p>', '<p><strong>Sympel</strong><br />Jl. Jalan Kemana aja<br />+6212345678909<br />Surat Elektronik : your@mail.net</p>', 'https://www.facebook.com/int11', 'http://twitter.com/NauvalAzharID', 'https://plus.google.com/+NauvalAzhar', 'http://www.nauvalazhar.net/', '2014-10-02 06:12:26', 'KONTAK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sy_partner`
--

CREATE TABLE IF NOT EXISTS `sy_partner` (
  `id` int(11) NOT NULL,
  `foto` text NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jabatan` varchar(250) NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `twitter` varchar(250) NOT NULL,
  `website` varchar(250) NOT NULL,
  `link` varchar(200) NOT NULL,
  `status` enum('Y','N','TRASH') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sy_portofolio`
--

CREATE TABLE IF NOT EXISTS `sy_portofolio` (
  `id` int(11) NOT NULL,
  `thumb` text NOT NULL,
  `judul` varchar(200) NOT NULL,
  `des` text NOT NULL,
  `status` enum('Y','N','TRASH') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sy_setting`
--

CREATE TABLE IF NOT EXISTS `sy_setting` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sy_themes`
--

CREATE TABLE IF NOT EXISTS `sy_themes` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tema` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sy_themes`
--

INSERT INTO `sy_themes` (`id`, `nama`, `tema`, `author`, `tahun`, `status`) VALUES
(1, 'Portofolio', 'portofolio', 'Start Bootstrap', 2014, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sy_user`
--

CREATE TABLE IF NOT EXISTS `sy_user` (
  `id` int(11) NOT NULL,
  `foto` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `passwordnohash` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `website` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sy_gbook`
--
ALTER TABLE `sy_gbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sy_halaman`
--
ALTER TABLE `sy_halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sy_partner`
--
ALTER TABLE `sy_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sy_portofolio`
--
ALTER TABLE `sy_portofolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sy_setting`
--
ALTER TABLE `sy_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sy_themes`
--
ALTER TABLE `sy_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sy_user`
--
ALTER TABLE `sy_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sy_gbook`
--
ALTER TABLE `sy_gbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sy_halaman`
--
ALTER TABLE `sy_halaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sy_partner`
--
ALTER TABLE `sy_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `sy_portofolio`
--
ALTER TABLE `sy_portofolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `sy_setting`
--
ALTER TABLE `sy_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `sy_themes`
--
ALTER TABLE `sy_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sy_user`
--
ALTER TABLE `sy_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
