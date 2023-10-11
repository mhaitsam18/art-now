-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2022 at 06:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `art_now`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsitek`
--

CREATE TABLE `arsitek` (
  `id_arsitek` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `alamat` text NOT NULL,
  `saldo` bigint(20) NOT NULL DEFAULT 0,
  `bank` varchar(30) DEFAULT NULL,
  `nomor_rekening` varchar(30) DEFAULT NULL,
  `ktp` varchar(255) NOT NULL,
  `ijazah` varchar(255) NOT NULL,
  `sertifikasi_arsitek` varchar(255) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arsitek`
--

INSERT INTO `arsitek` (`id_arsitek`, `id_user`, `deskripsi`, `alamat`, `saldo`, `bank`, `nomor_rekening`, `ktp`, `ijazah`, `sertifikasi_arsitek`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, 53, '<p>Lulusan ITB tahun 2009</p>', 'Jl. Pahlawan No. 77 Bekasi', 652000000, 'BCA', '7689054321', '3981658657000.jpg', '3671658657000.jpg', '7621658657000.png', '2022-07-24 10:03:20', '2022-07-24 10:09:07'),
(2, 54, '<p>Lulusan UMY 2011</p>', 'Jl. Otista No 112, Bandung, Jawa Barat', 212000000, 'BANK MANDIRI', '124167894', '6731658657586.jpg', '9671658657586.jpg', '5521658657586.png', '2022-07-24 10:13:06', '2022-07-24 10:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT current_timestamp(),
  `diperbaharui_pada` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `gambar`, `isi`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, 'Tips Memastikan Bangunan Kokoh Ketika Gempa', 'depositphotos_79481102-stock-photo-modern-business-skyscraper-1658662232.jpg', '<p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">Sebagai negara yang berada di kawasan cincin api, gempa bumi sering terjadi di beberapa wilayah di Indonesia. Guna meminimalisir terjadinya kerusakan dan kerugian pada saat gempa terjadi, diperlukan langkah-langkah preventif atau pencegahan. Melihat fakta bahwa akhir-akhir ini pusat gempa sering terjadi di dekat daratan, maka potensi kerusakan bangunan akan menjadi lebih yang tinggi. Badan Nasional Penanggulangan Bencana (BNPB) sendiri juga telah mengeluarkan pernyataan bahwa di Indonesia belum banyak bangunan yang memenuhi standar tahan gempa. Hal ini terjadi karena berbagai faktor antara lain, minimnya regulasi dari pemerintah, alasan ekonomi, faktor dari segi tata ruang, terbatasnya pengetahuan masyarakat, dan penyebab lainnya.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">Meskipun belum banyak, sebenarnya sudah ada beberapa bangunan yang tahan gempa di Indonesia. Dalam Pedoman Teknis Rumah dan Bangunan Gedung Tahan Gempa Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR),  terdapat beberapa tips yang bisa digunakan untuk memastikan sebuah bangunan tersebut kokoh dan tahan gempa :</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">1. Bila terkena gempa bumi yang lemah, bangunan tersebut tidak mengalami kerusakan sama sekali.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">2. Bila terkena gempa bumi berkekuatan sedang, bangunan tersebut tidak rusak pada konstruksi non-struktural, tetapi bisa mengalami kerusakan pada elemen-elemen struktur.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">3. Bila terkena gempa bumi yang sangat kuat, bangunan tersebut tidak runtuh baik sebagian maupun seluruhnya. Selain itu, bangunan juga tidak mengalami kerusakan, dan jika terjadi kerusakan kecil masih bisa diperbaiki sehingga dapat berfungsi kembali.</span></p><p><br></p><p><br></p><p class=\"ql-align-justify\"><strong style=\"background-color: transparent;\">Selain itu, ada beberapa ciri yang bisa dilihat dari bentuk bangunannya sendiri, yaitu:</strong></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">1. Dari sisi pondasi, harus dibangun pada tanah yang keras dan simetris dengan tanah di sekitarnya. Apabila pondasi dibangun pada tanah yang lunak, maka menggunakan pondasi pelat beton bertulang.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">2. Dari sisi denah bangunan atau rumah, harus simetris terhadap sumbu bangunan. Penempatan dinding-dinding penyekat juga harus simetris dengan sumbu bangunan serta membentuk kotak-kotak tertutup.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">3. Dari sisi kuda-kuda bangunan atau rumah, harus memenuhi standar. Misalnya untuk rumah tempat tinggal, menggunakan kuda-kuda papan paku.</span></p><p class=\"ql-align-justify\"><strong style=\"background-color: transparent;\">Pasca gempa besar yang terjadi di Lombok dan sekitarnya beberapa waktu lalu, BNPB juga merilis konstruksi bangunan modern tahan gempa. Konstruksi tersebut terdiri dari:</strong></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">- Growing house: rumah yang didesain dengan keamanan yang baik dan memikirkan dampak lingkungan</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">- Rumah Dome: bangunan tanpa pondasi yang memiliki tingkat ketahanan gempa yang cukup kuat</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">- Barrataga: bangunan dengan penguatan pada besi tulangan bangunan yang saling mengait sehingga tahan akan guncangan gempa</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">- RUSPIN: teknologi rangka rumah pracetak dengan menggunakan sistem sambungan dengan baut</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">- Rumah Conwood: rumah yang desain konstruksinya berhubungan erat dengan material Panel dari rumah Conwood terbuat dari semen dan serat sehingga lebih lentur jika terjadi goncangan</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">- Rumah RISHA: rumah yang menggunakan bahan beton bertulang pada struktur utamanya dan telah teruji tahan gempa hingga 8 SR</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent;\">- Rumah RIKA: rumah instan dari bahan kayu kelas rendah cepat tumbuh sehingga tahan akan guncangan gempa</span></p><p><br></p><p><br></p>', '2022-07-24 11:30:32', '2022-07-24 11:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `desain`
--

CREATE TABLE `desain` (
  `id_desain` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `dokumen` varchar(100) NOT NULL,
  `tautan` text NOT NULL,
  `catatan_revisi` text DEFAULT NULL,
  `konfirmasi_revisi` int(11) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desain`
--

INSERT INTO `desain` (`id_desain`, `id_pesanan`, `dokumen`, `tautan`, `catatan_revisi`, `konfirmasi_revisi`, `dibuat_pada`) VALUES
(1, 1, 'desain-rumah-apung-1658658175.pdf', 'https://www.youtube.com/watch?v=6m4No9KU2C4', NULL, 0, '2022-07-24 17:22:55'),
(2, 1, 'desain-rumah-apung-1658658273.pdf', 'https://www.youtube.com/watch?v=6m4No9KU2C4', NULL, 0, '2022-07-24 17:24:33'),
(3, 2, 'desain-desain-rumah-modern-1658662015.pdf', 'https://www.youtube.com/watch?v=6m4No9KU2C4', 'revisi', 1, '2022-07-24 18:26:55'),
(4, 3, 'desain-desain-rumah-modern-1658662718.pdf', 'https://www.youtube.com/watch?v=6m4No9KU2C4', NULL, 0, '2022-07-24 18:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `komen`
--

CREATE TABLE `komen` (
  `id_komen` int(11) NOT NULL,
  `id_reply_komen` int(11) DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `komen` text NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komen`
--

INSERT INTO `komen` (`id_komen`, `id_reply_komen`, `id_produk`, `id_user`, `komen`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, NULL, 2, 52, 'Desainnya bagus sekali', '2022-07-24 11:21:37', '2022-07-24 11:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `komen_artikel`
--

CREATE TABLE `komen_artikel` (
  `id_komen` int(11) NOT NULL,
  `id_reply_komen` int(11) DEFAULT NULL,
  `id_artikel` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `komen` text NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komen_artikel`
--

INSERT INTO `komen_artikel` (`id_komen`, `id_reply_komen`, `id_artikel`, `id_user`, `komen`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, NULL, 1, 52, 'Artikel ini sangat berguna', '2022-07-24 11:41:43', '2022-07-24 11:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `judul`, `keterangan`, `link`, `status`, `dibuat_pada`) VALUES
(1, 53, 'Selamat Datang di ArtNow', 'Selamat, datamu telah diverifikasi admin. Sekarang kamu bisa mengakses semua menu sebagai Arsitek. Jangan lupa buat Produkmu sekarang!', '/arsitek/produk', 1, '2022-07-24 10:06:59'),
(2, 54, 'Selamat Datang di ArtNow', 'Selamat, datamu telah diverifikasi admin. Sekarang kamu bisa mengakses semua menu sebagai Arsitek. Jangan lupa buat Produkmu sekarang!', '/arsitek/produk', 1, '2022-07-24 10:14:56'),
(3, 54, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 1, '2022-07-24 10:19:33'),
(4, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/3\">Desain Rumah Apung</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-24 10:20:55'),
(5, 54, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost/art-now/public/arsitek/detail_produk/3\">Desain Rumah Apung</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 1, '2022-07-24 10:21:22'),
(6, 53, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 1, '2022-07-24 11:24:21'),
(7, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/2\">Desain Rumah Modern</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-24 11:24:51'),
(8, 53, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost/art-now/public/arsitek/detail_produk/2\">Desain Rumah Modern</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 1, '2022-07-24 11:25:27'),
(9, 54, 'Pembayaran Berhasil', 'Selamat! Pelanggan baru saja membayar pesanannya. Cek <a href=\"http://localhost/art-now/public/arsitek/saldo\">saldo</a> sekarang!', '/arsitek/saldo', 1, '2022-07-24 11:28:30'),
(10, 53, 'Pembayaran Berhasil', 'Selamat! Pelanggan baru saja membayar pesanannya. Cek <a href=\"http://localhost/art-now/public/arsitek/saldo\">saldo</a> sekarang!', '/arsitek/saldo', 1, '2022-07-24 11:29:03'),
(11, 53, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 1, '2022-07-24 11:35:53'),
(12, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/2\">Desain Rumah Modern</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-24 11:36:23'),
(13, 53, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost/art-now/public/arsitek/detail_produk/2\">Desain Rumah Modern</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 1, '2022-07-24 11:37:11'),
(14, 53, 'Pembayaran Berhasil', 'Selamat! Pelanggan baru saja membayar pesanannya. Cek <a href=\"http://localhost/art-now/public/arsitek/saldo\">saldo</a> sekarang!', '/arsitek/saldo', 1, '2022-07-24 11:40:55'),
(15, 54, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 1, '2022-07-25 08:17:04'),
(16, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/3\">Desain Rumah Apung</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-25 08:18:00'),
(17, 54, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost/art-now/public/arsitek/detail_produk/3\">Desain Rumah Apung</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 0, '2022-07-25 08:18:10'),
(18, 52, 'Pembayaran Ditolak', 'Pembayaran Ditolak. Jumlahnya kurang', '/pengguna/index', 1, '2022-07-25 08:20:09'),
(19, 53, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 1, '2022-07-26 04:44:46'),
(20, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/2\">Desain Rumah Modern</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-26 04:45:22'),
(21, 53, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost/art-now/public/arsitek/detail_produk/2\">Desain Rumah Modern</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 1, '2022-07-26 04:45:44'),
(22, 53, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 1, '2022-07-26 09:50:33'),
(23, 53, 'Pembayaran Berhasil', 'Selamat! Pelanggan baru saja membayar pesanannya. Cek <a href=\"http://localhost/art-now/public/arsitek/saldo\">saldo</a> sekarang!', '/arsitek/saldo', 1, '2022-07-26 09:53:37'),
(24, 55, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/2\">Desain Rumah Modern</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-26 09:54:23'),
(25, 53, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 0, '2022-07-27 02:18:52'),
(26, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/2\">Desain Rumah Modern</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-27 02:19:29'),
(27, 53, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost/art-now/public/arsitek/detail_produk/2\">Desain Rumah Modern</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 0, '2022-07-27 02:23:20'),
(28, 53, 'Pembayaran Berhasil', 'Selamat! Pelanggan baru saja membayar pesanannya. Cek <a href=\"http://localhost/art-now/public/arsitek/saldo\">saldo</a> sekarang!', '/arsitek/saldo', 0, '2022-07-27 03:30:41'),
(29, 53, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 0, '2022-07-27 03:34:24'),
(30, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost/art-now/public/home/produk/2\">Desain Rumah Modern</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 1, '2022-07-27 03:38:13'),
(31, 53, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost/art-now/public/arsitek/detail_produk/2\">Desain Rumah Modern</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 0, '2022-07-27 03:39:11'),
(32, 53, 'Anda memiliki pesanan baru', 'Anda baru saja memiliki pesanan baru. <a href=\"http://localhost:8080/art-now/public/arsitek/pesanan\">Klik di sini untuk melihat.</a>.', 'arsitek/pesanan', 0, '2022-07-29 02:18:42'),
(33, 52, 'Tawaran Pesananan Sudah Ditentukan Arsitek', 'Pesanan Anda kepada Arsitek dengan Produk <a href=\"http://localhost:8080/art-now/public/home/produk/1\">Desain Rumah Taman</a> telah memiliki tawaran harga. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/pengguna/index', 0, '2022-07-29 02:36:25'),
(34, 53, 'Tawaran Pesananan Diterima Pelanggan', 'Tawaran pesanan dengan Produk <a href=\"http://localhost:8080/art-now/public/arsitek/detail_produk/1\">Desain Rumah Taman</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!', '/arsitek/pesanan', 0, '2022-07-29 02:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `total_dibayar` bigint(20) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesanan`, `bukti_pembayaran`, `total_dibayar`, `pembayaran`, `status`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, 1, '1071658658117.jpg', 2000000, -1, 1, '2022-07-24 10:21:57', '2022-07-24 10:22:08'),
(2, 1, '1491658658312.jpg', 208000000, 1, 1, '2022-07-24 10:25:12', '2022-07-24 11:28:30'),
(3, 2, '9921658661954.jpg', 2000000, -1, 1, '2022-07-24 11:25:54', '2022-07-24 11:26:11'),
(4, 2, '8941658662134.jpg', 148000000, 1, 1, '2022-07-24 11:28:14', '2022-07-24 11:29:03'),
(5, 3, '1991658662663.jpg', 2000000, -1, 1, '2022-07-24 11:37:43', '2022-07-24 11:37:56'),
(6, 3, '3291658662845.jpg', 198000000, 1, 1, '2022-07-24 11:40:45', '2022-07-24 11:40:55'),
(7, 4, '3211658737112.jpg', 2000000, -1, 1, '2022-07-25 08:18:32', '2022-07-25 08:19:03'),
(8, 4, '9051658737188.jpg', 208000000, 1, -1, '2022-07-25 08:19:48', '2022-07-25 08:20:09'),
(9, 5, '7041658829167.jpeg', 2000000, -1, 1, '2022-07-26 09:52:47', '2022-07-26 09:53:09'),
(10, 5, '7991658829208.png', 148000000, 1, 1, '2022-07-26 09:53:28', '2022-07-26 09:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_penarikan`
--

CREATE TABLE `permintaan_penarikan` (
  `id_permintaan_penarikan` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `dibuat_pada` datetime DEFAULT current_timestamp(),
  `diperbaharui_pada` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `id_user_dari` int(11) NOT NULL,
  `id_user_kepada` int(11) NOT NULL,
  `tipe` tinyint(1) NOT NULL,
  `pesan` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user_dari`, `id_user_kepada`, `tipe`, `pesan`, `status`, `dibuat_pada`) VALUES
(1, 52, 54, 1, 'Halo, saya tertarik untuk membeli desain rumah apung anda', 2, '2022-07-24 10:16:27'),
(2, 54, 52, 1, 'Oke, silakan melakukan pemesanan', 2, '2022-07-24 10:16:41'),
(3, 52, 54, 1, 'Saya ingin menambah 1 Kamar', 2, '2022-07-24 10:23:51'),
(4, 54, 52, 1, 'Oke', 2, '2022-07-24 10:24:06'),
(5, 52, 53, 1, 'Halo, saya tertarik untuk membeli desain rumah modern anda', 2, '2022-07-24 11:22:23'),
(6, 53, 52, 1, 'Oke, silakan melakukan pemesanan', 2, '2022-07-24 11:22:40'),
(7, 52, 53, 1, 'Saya ingin membeli desain rumah modern anda', 2, '2022-07-24 11:33:58'),
(8, 53, 52, 1, 'Oke, silakan melakukan pemesanan', 2, '2022-07-24 11:34:15'),
(9, 53, 52, 1, 'Saya sudah mengunggah desainnya harap di cek', 2, '2022-07-24 11:39:12'),
(10, 53, 52, 2, 'revisi-1658815520.pdf', 2, '2022-07-26 06:05:20'),
(11, 53, 52, 2, 'form-revisi-desain-1658823558.docx', 2, '2022-07-26 08:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `luas_tanah` int(11) NOT NULL,
  `detail` text NOT NULL,
  `tawaran_harga` bigint(20) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `jadwal_survei` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_produk`, `id_user`, `lokasi`, `luas_tanah`, `detail`, `tawaran_harga`, `status`, `jadwal_survei`, `deadline`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, 3, 52, '', 12, 'Ingin dibuat untuk 2 lantai, ada 4 Kamar Tidur, 2 kamar mandi, masing masing Ruang Keluarga di lantai atas dan lantai bawah', 210000000, 3, NULL, NULL, '2022-07-24 10:19:33', '2022-07-24 11:28:30'),
(2, 2, 52, '', 9, 'Rumah untuk 2 lantai, 4 kamar tidur, 2 kamar mandi, dapur, ruang keluarga di tiap lantai, ruang tamu dan garasi', 13133121, 4, NULL, '2022-08-12', '2022-07-24 11:24:21', '2022-07-29 03:49:56'),
(3, 2, 52, '', 9, 'Berada di daerah pegunungan, ingin 2 lantai, terapat 4 kamar tidur, 2 kamar mandi, 1 ruang keluarga di setiap lantai, dapur, ruang tamu, dan juga garasi', 200000000, 3, NULL, NULL, '2022-07-24 11:35:53', '2022-07-24 11:40:55'),
(4, 3, 52, '', 8, 'Ingin ada 2 kamar tidur, 2 kamar tidur', 210000000, 2, NULL, NULL, '2022-07-25 08:17:04', '2022-07-25 08:19:34'),
(5, 2, 52, '', 7, 'ingin ada 2 kamar mandi dan 2 kamar tidur', 150000000, 3, NULL, NULL, '2022-07-26 04:44:46', '2022-07-26 09:53:37'),
(6, 2, 55, '', 6, '-', 150000000, 0, NULL, NULL, '2022-07-26 09:50:33', '2022-07-26 09:54:23'),
(9, 1, 52, '', 20, 'ingin begini tapi suka pengen begitu, ', 120000000, 1, '2022-08-01', NULL, '2022-07-29 02:18:42', '2022-07-29 02:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `tautan_video` varchar(255) DEFAULT NULL,
  `kategori` int(11) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_user`, `judul`, `gambar`, `harga`, `dokumen`, `tautan_video`, `kategori`, `deskripsi`, `status`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, 53, 'Desain Rumah Taman', 'garden-house-rumah-taman-yang-segar-dan-alami--2068eca515092abe4f4adaf380b0df20c-1658657187.jpg', 120000000, 'revisi-1658815520-1658823325.pdf', 'https://www.youtube.com/watch?v=XFNuRsKCFa4', 2, '<p>Ukuran tanah 8x15 m2</p><p>2 Kamar tidur</p><p>1 Kamar mandi</p><p>1 Ruang tamu</p><p>1 Garasi</p>', 1, '2022-07-24 10:06:27', '2022-07-26 08:15:25'),
(2, 53, 'Desain Rumah Modern', '6c8cfd43cd52d1e504aec65c4e2f3b32-1658657466.jpg', 150000000, 'desain-desain-rumah-modern-1658657466.pdf', '', 1, '<p>Ukuran 9x18 m2</p><p>3 Kamar tidur</p><p>2 kamar mandi</p><p>1 Ruang tamu</p><p>1 Ruang keluarga</p><p>1 Garasi</p>', 1, '2022-07-24 10:11:06', '2022-07-24 10:11:06'),
(3, 54, 'Desain Rumah Apung', 'villa-on-water-palm-beach-australia-2-5ebd281d63b33-700-b610379a4fd6210344cb66231ed6ce2d_750x500-1658657687.jpg', 210000000, 'desain-rumah-apung-1658657687.pdf', '', 0, '<p>Ukuran 7x12 m2</p><p>2 Kamar tidur</p><p>1 Kamar mandi</p><p>1 Ruang tamu</p><p>1 Ruang keluarga</p>', 1, '2022-07-24 10:14:47', '2022-07-24 10:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `komen` varchar(250) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_user`, `id_produk`, `rating`, `komen`, `dibuat_pada`) VALUES
(1, 52, 3, 4, 'Bagus', '2022-07-24 10:25:12'),
(2, 52, 2, 5, 'Keren', '2022-07-24 11:28:14'),
(3, 52, 2, 4, 'Bagus', '2022-07-24 11:40:45'),
(4, 52, 3, 3, 'Bagus', '2022-07-25 08:19:48'),
(5, 52, 2, 5, '-', '2022-07-26 09:53:28'),
(6, 52, 2, 5, '--', '2022-07-27 03:30:25'),
(7, 52, 2, 5, ':)', '2022-07-27 16:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `rekening_bank`
--

CREATE TABLE `rekening_bank` (
  `id_rekening` bigint(20) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor` bigint(20) NOT NULL,
  `pemegang` varchar(50) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekening_bank`
--

INSERT INTO `rekening_bank` (`id_rekening`, `logo`, `nama`, `nomor`, `pemegang`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(8, '5401643236835.png', 'BNI', 987654321234, 'Bambang', '2022-01-26 22:40:35', '2022-01-26 22:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `id_user`, `nominal`, `keterangan`, `bukti`, `dibuat_pada`) VALUES
(1, 54, 2000000, 'Bayaran dari produk Desain Rumah Apung oleh Elpris', NULL, '2022-07-24 17:22:08'),
(2, 53, 2000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-24 18:26:11'),
(3, 54, 208000000, 'Bayaran dari produk Desain Rumah Apung oleh Elpris', NULL, '2022-07-24 18:28:30'),
(4, 53, 148000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-24 18:29:03'),
(5, 53, 2000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-24 18:37:56'),
(6, 53, 198000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-24 18:40:55'),
(7, 54, 2000000, 'Bayaran dari produk Desain Rumah Apung oleh Elpris', NULL, '2022-07-25 15:19:03'),
(8, 53, 2000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-26 16:53:09'),
(9, 53, 148000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-26 16:53:37'),
(10, 53, 2000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-27 10:29:34'),
(11, 53, 148000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-27 10:30:41'),
(12, 53, 2000000, 'Bayaran dari produk Desain Rumah Modern oleh Elpri', NULL, '2022-07-27 10:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT NULL,
  `diperbaharui_pada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `level`, `nama_lengkap`, `telepon`, `foto`, `status`, `dibuat_pada`, `diperbaharui_pada`) VALUES
(1, 'admin@gmail.com', '5c90b96a75d4f9d5a1cfaa6f532afdc8', 2, 'Super Admin', '085156055277', NULL, 1, '2021-11-19 10:02:06', '2022-07-04 09:25:54'),
(52, 'elpriska@gmail.com', '79c6a0115027e84092a6a87ef4af4229', 0, 'Elpriska Annisa', '089654329887', NULL, 1, '2022-07-24 09:56:08', '2022-07-24 09:56:08'),
(53, 'alfiya@gmail.com', '1e3f8db04919f512f577f2f5df0c72da', 1, 'Alfiya', '87897657442', 'portrait-professional-architect-woman-wearing-yellow-helmet-standing-outdoors-engineer-architect-concept-1-scaled-1658657312.jpg', 1, '2022-07-24 09:56:40', '2022-07-24 11:16:22'),
(54, 'aksara@gmail.com', 'af08692072f7cc799b964d2fe32cb59a', 1, 'Aksara', '089658891231', 'img1sah-1658657726.jpg', 1, '2022-07-24 10:12:05', '2022-07-24 10:15:26'),
(55, 'elpriska1@gmail.com', '592d5424309f3c51d8db58deb5b9685c', 0, 'Elpriska', '0876543212', NULL, 1, '2022-07-26 09:50:03', '2022-07-26 09:50:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsitek`
--
ALTER TABLE `arsitek`
  ADD PRIMARY KEY (`id_arsitek`),
  ADD UNIQUE KEY `id_user_2` (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `desain`
--
ALTER TABLE `desain`
  ADD PRIMARY KEY (`id_desain`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `komen`
--
ALTER TABLE `komen`
  ADD PRIMARY KEY (`id_komen`),
  ADD KEY `id_reply_komen` (`id_reply_komen`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `komen_artikel`
--
ALTER TABLE `komen_artikel`
  ADD PRIMARY KEY (`id_komen`),
  ADD KEY `id_reply_komen` (`id_reply_komen`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_artikel` (`id_artikel`) USING BTREE;

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `permintaan_penarikan`
--
ALTER TABLE `permintaan_penarikan`
  ADD PRIMARY KEY (`id_permintaan_penarikan`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_user_from` (`id_user_dari`),
  ADD KEY `id_user_to` (`id_user_kepada`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telepon` (`telepon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsitek`
--
ALTER TABLE `arsitek`
  MODIFY `id_arsitek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `desain`
--
ALTER TABLE `desain`
  MODIFY `id_desain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komen`
--
ALTER TABLE `komen`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komen_artikel`
--
ALTER TABLE `komen_artikel`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permintaan_penarikan`
--
ALTER TABLE `permintaan_penarikan`
  MODIFY `id_permintaan_penarikan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  MODIFY `id_rekening` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsitek`
--
ALTER TABLE `arsitek`
  ADD CONSTRAINT `arsitek_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `desain`
--
ALTER TABLE `desain`
  ADD CONSTRAINT `desain_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komen`
--
ALTER TABLE `komen`
  ADD CONSTRAINT `komen_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komen_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komen_artikel`
--
ALTER TABLE `komen_artikel`
  ADD CONSTRAINT `komen_artikel_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komen_artikel_ibfk_2` FOREIGN KEY (`id_artikel`) REFERENCES `artikel` (`id_artikel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`id_user_dari`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesan_ibfk_2` FOREIGN KEY (`id_user_kepada`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
