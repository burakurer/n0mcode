-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 05 Mar 2020, 11:51:52
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `n0mcode`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ann`
--

DROP TABLE IF EXISTS `ann`;
CREATE TABLE IF NOT EXISTS `ann` (
  `duyuru_id` int(11) NOT NULL AUTO_INCREMENT,
  `duyuru_ikon` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `duyuru_icerik` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `duyuru_url` varchar(300) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`duyuru_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ann`
--

INSERT INTO `ann` (`duyuru_id`, `duyuru_ikon`, `duyuru_icerik`, `duyuru_url`) VALUES
(20, 'ft-heart', 'google', 'https://google.com'),
(25, 'ft-heart', 'test duyuru', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `code`
--

DROP TABLE IF EXISTS `code`;
CREATE TABLE IF NOT EXISTS `code` (
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  `code_baslik` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `code_icerik` varchar(20000) COLLATE utf8_turkish_ci NOT NULL,
  `code_tarih` date NOT NULL,
  `code_sahip` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `code_public` int(1) NOT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `code`
--

INSERT INTO `code` (`code_id`, `code_baslik`, `code_icerik`, `code_tarih`, `code_sahip`, `code_public`) VALUES
(1, 'test', 'test içerik <?php echo \'admin\'; ?>', '2020-02-27', 'admin', 1),
(2, 'test2', 'test içerik <?php echo \'user\'; ?>', '2020-02-27', 'user', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `n0m_setting` int(1) NOT NULL,
  `n0m_userreg` int(1) NOT NULL,
  `n0m_guard` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `setting`
--

INSERT INTO `setting` (`n0m_setting`, `n0m_userreg`, `n0m_guard`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `todo` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `todo`
--

INSERT INTO `todo` (`id`, `todo`) VALUES
(2, '2 faktörlü doğrulama'),
(3, 'güvenlik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_pass` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `user_mail` varchar(65) COLLATE utf8_turkish_ci NOT NULL,
  `user_yetki` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `user_picture` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `user_reg` varchar(16) COLLATE utf8_turkish_ci NOT NULL,
  `user_notes` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pass`, `user_mail`, `user_yetki`, `user_picture`, `user_reg`, `user_notes`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 'admin', 'http://localhost:10019/theme/dox/images/usern0m.png', '0000-00-0', 'R6w[M]uhammet'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@example.com', 'user', 'http://localhost:10019/theme/dox/images/usern0m.png', '14:01 02.03.2020', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
