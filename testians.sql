-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 26 Mar 2014 pada 05.34
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `testians`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(200) NOT NULL,
  `msg_id_fk` int(10) NOT NULL,
  `uid_fk` int(10) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`com_id`, `comment`, `msg_id_fk`, `uid_fk`, `ip`, `created`) VALUES
(1, 'keep spirit bro.... :D', 1, 2, '::1', 1395242152),
(3, 'thx 4 add ya..', 3, 1, '::1', 1395374945),
(4, 'cemungudt eaa..', 1, 2, '::1', 1395377474);

-- --------------------------------------------------------

--
-- Struktur dari tabel `follow_user`
--

CREATE TABLE IF NOT EXISTS `follow_user` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `uid_fk` int(10) NOT NULL,
  `following_uid` int(10) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `follow_user`
--

INSERT INTO `follow_user` (`fid`, `uid_fk`, `following_uid`) VALUES
(4, 2, 1),
(5, 1, 2),
(7, 3, 2),
(8, 3, 1),
(9, 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_id_fk` int(10) NOT NULL,
  `uid_fk` int(10) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `likes`
--

INSERT INTO `likes` (`like_id`, `msg_id_fk`, `uid_fk`) VALUES
(3, 2, 2),
(4, 1, 2),
(5, 3, 1),
(6, 6, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(200) NOT NULL,
  `uid_fk` int(10) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `created` int(10) NOT NULL,
  `uploads` varchar(50) NOT NULL,
  `profile_uid` int(10) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`msg_id`, `message`, `uid_fk`, `ip`, `created`, `uploads`, `profile_uid`) VALUES
(1, 'bosand malam ini', 1, '::1', 1395242044, '0', 1),
(2, 'update update........', 2, '::1', 1395242273, '0', 2),
(5, 'Motivation. :D', 1, '::1', 1395375096, '3,', 1),
(6, 'test ajah', 3, '::1', 1395378982, '0', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) DEFAULT NULL,
  `birth` date NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `cover_img` varchar(500) DEFAULT NULL,
  `gender` enum('pria','wanita') NOT NULL,
  `religion` enum('islam','katolik','protestan','hindu','budha') NOT NULL,
  `status` enum('lajang','pacaran','menikah','lain-lain') NOT NULL,
  `address` text NOT NULL,
  `activity` text NOT NULL,
  `hobby` text NOT NULL,
  `photo_profil` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`uid`, `fullname`, `birth`, `password`, `email`, `cover_img`, `gender`, `religion`, `status`, `address`, `activity`, `hobby`, `photo_profil`) VALUES
(1, 'hery', '2014-03-21', '123456', 'hery.trie@gmail.com', '1395242090al-art.jpg', 'pria', 'islam', 'lajang', '', '', '', ''),
(2, 'tri', '2014-03-21', '123456', 'he@ri.com', '1395385387e.jpg', 'pria', 'islam', 'lajang', '', '', '', ''),
(3, 'wibowo', '1985-10-18', '123456', 'heri_28@yahoo.co.id', '1395378931.jpg', 'pria', 'islam', 'lajang', '', '', '', ''),
(4, 'test2', '1987-10-16', '123456', 'test2@t.com', 'default.jpg', 'pria', 'islam', 'lajang', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_uploads`
--

CREATE TABLE IF NOT EXISTS `user_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(500) NOT NULL,
  `uid_fk` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `user_uploads`
--

INSERT INTO `user_uploads` (`id`, `image_path`, `uid_fk`) VALUES
(1, '13953730692.jpg', 2),
(2, '13953750311.jpg', 1),
(3, '13953750821.jpg', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
