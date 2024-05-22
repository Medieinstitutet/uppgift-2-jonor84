-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 22 maj 2024 kl 23:50
-- Serverversion: 10.6.17-MariaDB-cll-lve
-- PHP-version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `mhemsi31_mailboy`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `data_access`
--

CREATE TABLE `data_access` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `access_name` char(20) DEFAULT NULL,
  `access_name_halo` text DEFAULT NULL,
  `access_notes` mediumtext DEFAULT NULL,
  `access_updated` mediumtext DEFAULT NULL,
  `access_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_access`
--

INSERT INTO `data_access` (`id`, `access_name`, `access_name_halo`, `access_notes`, `access_updated`, `access_active`) VALUES
(1, 'Prenumerant', NULL, '', '1702232962', 1),
(2, 'KundAdmin', NULL, '', '1636585194', 1),
(3, 'Kund Huvudadmin', NULL, 'Huvudbehörighet, användaren går ej att ta bort.', '1636585194', 1),
(4, 'ÅF Medarbetare', NULL, '', '1636585194', 0),
(5, 'ÅF Admin', NULL, '', '1642690029', 1),
(6, 'ÅF HuvudAdmin', NULL, '', '1636585194', 0),
(7, 'Admin', NULL, '', '1636585194', 1),
(8, 'Super Admin', NULL, '', '1636585194', 1),
(9, 'SystemAdmin', NULL, NULL, '1636585194', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_activate`
--

CREATE TABLE `data_activate` (
  `email` varchar(256) NOT NULL,
  `code` varchar(256) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `data_activities`
--

CREATE TABLE `data_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand` text DEFAULT NULL,
  `uid` int(10) UNSIGNED DEFAULT NULL,
  `resellerid` int(11) NOT NULL DEFAULT 1,
  `clientid` int(11) NOT NULL DEFAULT 0,
  `sessionid` char(32) DEFAULT NULL,
  `event` varchar(20) DEFAULT NULL,
  `ip` varchar(11) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_activities`
--

INSERT INTO `data_activities` (`id`, `brand`, `uid`, `resellerid`, `clientid`, `sessionid`, `event`, `ip`, `notes`, `date`) VALUES
(1, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:31:11'),
(2, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:31:30'),
(3, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:31:52'),
(4, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:32:19'),
(5, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:38:44'),
(6, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:44:12'),
(7, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:46:11'),
(8, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:47:16'),
(9, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 15:48:34'),
(10, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 16:30:51'),
(11, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 16:32:18'),
(12, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 16:33:14'),
(13, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 17:08:49'),
(14, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 17:35:20'),
(15, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 17:36:20'),
(16, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 17:40:06'),
(17, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 17:59:22'),
(18, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 17:59:22'),
(19, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:04:46'),
(20, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:13:05'),
(21, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:15:20'),
(22, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:19:01'),
(23, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:32:34'),
(24, 'mailboy', 5, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:36:44'),
(25, 'mailboy', 5, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:41:43'),
(26, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:42:37'),
(27, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:43:13'),
(28, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:53:40'),
(29, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:53:49'),
(30, 'mailboy', 5, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:54:08'),
(31, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 18:54:30'),
(32, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 19:29:44'),
(33, 'mailboy', 2, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 19:56:55'),
(34, 'mailboy', 4, 1, 0, '8eb3cf6f222e9d74d47e560332963a8d', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 19:57:27'),
(35, 'mailboy', 5, 1, 0, '96f97e93380358fd0a227b9816eba648', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 21:33:20'),
(36, 'mailboy', 5, 1, 0, '96f97e93380358fd0a227b9816eba648', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 22:02:28'),
(37, 'mailboy', 5, 1, 0, '96f97e93380358fd0a227b9816eba648', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 22:13:17'),
(38, 'mailboy', 4, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 23:11:44'),
(39, 'mailboy', 2, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 23:12:03'),
(40, 'mailboy', 2, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 23:21:01'),
(41, 'mailboy', 1, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 23:22:09'),
(42, 'mailboy', 1, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 23:24:22'),
(43, 'mailboy', 6, 1, 0, '0', 'usernew', '3562364093', 'Du registrerade kontot.', '2024-05-22 23:31:58'),
(44, 'mailboy', 0, 1, 0, '0', 'register', '3562364093', 'Användaren registrerade sig.', '2024-05-22 23:31:58'),
(45, 'mailboy', 6, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 23:32:16'),
(46, 'mailboy', 6, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'newaccount', '3562364093', 'Profilen blev ifylld för första gången av användaren', '2024-05-22 23:45:52'),
(47, 'mailboy', 6, 1, 0, '6a3036801f6bde23b0f809ce9c701662', 'login', '3562364093', 'Inlogging: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', '2024-05-22 23:46:57');

-- --------------------------------------------------------

--
-- Tabellstruktur `data_branding`
--

CREATE TABLE `data_branding` (
  `id` int(11) NOT NULL,
  `rid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `brandname` mediumtext DEFAULT NULL,
  `startapp` mediumtext DEFAULT NULL,
  `sitename` mediumtext DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `companyname` mediumtext DEFAULT NULL,
  `domain` mediumtext DEFAULT NULL,
  `focuscolor` mediumtext DEFAULT NULL,
  `linkcolor` mediumtext DEFAULT NULL,
  `linkhovercolor` mediumtext DEFAULT NULL,
  `buttoncolor` mediumtext DEFAULT NULL,
  `buttontextcolor` mediumtext DEFAULT NULL,
  `titlecolor` mediumtext DEFAULT NULL,
  `bkgcolor` mediumtext DEFAULT NULL,
  `bkgcolor2` mediumtext DEFAULT NULL,
  `textcolor` mediumtext DEFAULT NULL,
  `logowhite` mediumtext DEFAULT NULL,
  `logoblack` mediumtext DEFAULT NULL,
  `templatelogin` mediumtext DEFAULT NULL,
  `templatemail` mediumtext DEFAULT NULL,
  `templatemain` mediumtext DEFAULT NULL,
  `templateview` mediumtext DEFAULT NULL,
  `templatestart` mediumtext DEFAULT NULL,
  `templatesupport` mediumtext DEFAULT NULL,
  `templatecontact` mediumtext DEFAULT NULL,
  `starwars` int(11) NOT NULL DEFAULT 0,
  `favicon` mediumtext DEFAULT NULL,
  `loginlogo` mediumtext DEFAULT NULL,
  `maillogo` mediumtext DEFAULT NULL,
  `mainlogo` mediumtext DEFAULT NULL,
  `infosupport` mediumtext DEFAULT NULL,
  `infoterms` mediumtext DEFAULT NULL,
  `infoabout` mediumtext DEFAULT NULL,
  `infowelcome` mediumtext DEFAULT NULL,
  `infoimportant` mediumtext DEFAULT NULL,
  `infoinfo` mediumtext DEFAULT NULL,
  `infotopnote` mediumtext DEFAULT NULL,
  `infosidenote` mediumtext DEFAULT NULL,
  `font` mediumtext DEFAULT NULL,
  `mail` mediumtext DEFAULT NULL,
  `mailsupport` mediumtext DEFAULT NULL,
  `phone` int(11) NOT NULL DEFAULT 0,
  `phonesupport` int(11) NOT NULL DEFAULT 0,
  `gdprlink` mediumtext DEFAULT NULL,
  `termslink` mediumtext DEFAULT NULL,
  `mailwelcome` mediumtext DEFAULT NULL,
  `msgwelcome` mediumtext DEFAULT NULL,
  `profilelogo` mediumtext DEFAULT NULL,
  `darklogin` int(11) NOT NULL DEFAULT 0,
  `hideregister` int(11) NOT NULL DEFAULT 1,
  `hideforget` int(11) NOT NULL DEFAULT 0,
  `websiteactive` int(11) NOT NULL DEFAULT 0,
  `websiteincluded` int(11) NOT NULL DEFAULT 0,
  `type` mediumtext DEFAULT NULL,
  `imageintro` mediumtext DEFAULT NULL,
  `closedmess` mediumtext DEFAULT NULL,
  `open` int(11) NOT NULL DEFAULT 1,
  `added` mediumtext DEFAULT NULL,
  `updated` mediumtext DEFAULT NULL,
  `addeduid` int(11) NOT NULL DEFAULT 0,
  `updateduid` int(11) NOT NULL DEFAULT 0,
  `showstarthere` int(11) NOT NULL DEFAULT 0,
  `starthere_title` mediumtext DEFAULT NULL,
  `starthere_desc` mediumtext DEFAULT NULL,
  `starthere_welcome` mediumtext DEFAULT NULL,
  `shownews` int(11) NOT NULL DEFAULT 1,
  `shownewsoutside` int(11) NOT NULL DEFAULT 1,
  `showhelpcenter` int(11) NOT NULL DEFAULT 0,
  `startsupport_title` mediumtext DEFAULT NULL,
  `startsupport_desc` mediumtext DEFAULT NULL,
  `startsupport_welcome` mediumtext DEFAULT NULL,
  `startcontact_title` mediumtext DEFAULT NULL,
  `startcontact_desc` mediumtext DEFAULT NULL,
  `startcontact_welcome` mediumtext DEFAULT NULL,
  `showstatus` int(11) NOT NULL DEFAULT 1,
  `showknowledgebase` int(11) NOT NULL DEFAULT 1,
  `showdomain` int(11) NOT NULL DEFAULT 1,
  `showwhois` int(11) NOT NULL DEFAULT 1,
  `showcontact` int(11) NOT NULL DEFAULT 1,
  `showcreatecase` int(11) NOT NULL DEFAULT 1,
  `showterms` int(11) NOT NULL DEFAULT 1,
  `defaultstart` mediumtext DEFAULT NULL,
  `defaultlanguageid` int(11) NOT NULL DEFAULT 1,
  `mservice` int(11) NOT NULL DEFAULT 0,
  `startappswelcome` mediumtext DEFAULT NULL,
  `preloader` mediumtext DEFAULT NULL,
  `gfont` mediumtext DEFAULT NULL,
  `showcontactcenter` int(11) NOT NULL DEFAULT 1,
  `contactcenterimage` mediumtext DEFAULT NULL,
  `smsname` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_branding`
--

INSERT INTO `data_branding` (`id`, `rid`, `cid`, `brandname`, `startapp`, `sitename`, `active`, `companyname`, `domain`, `focuscolor`, `linkcolor`, `linkhovercolor`, `buttoncolor`, `buttontextcolor`, `titlecolor`, `bkgcolor`, `bkgcolor2`, `textcolor`, `logowhite`, `logoblack`, `templatelogin`, `templatemail`, `templatemain`, `templateview`, `templatestart`, `templatesupport`, `templatecontact`, `starwars`, `favicon`, `loginlogo`, `maillogo`, `mainlogo`, `infosupport`, `infoterms`, `infoabout`, `infowelcome`, `infoimportant`, `infoinfo`, `infotopnote`, `infosidenote`, `font`, `mail`, `mailsupport`, `phone`, `phonesupport`, `gdprlink`, `termslink`, `mailwelcome`, `msgwelcome`, `profilelogo`, `darklogin`, `hideregister`, `hideforget`, `websiteactive`, `websiteincluded`, `type`, `imageintro`, `closedmess`, `open`, `added`, `updated`, `addeduid`, `updateduid`, `showstarthere`, `starthere_title`, `starthere_desc`, `starthere_welcome`, `shownews`, `shownewsoutside`, `showhelpcenter`, `startsupport_title`, `startsupport_desc`, `startsupport_welcome`, `startcontact_title`, `startcontact_desc`, `startcontact_welcome`, `showstatus`, `showknowledgebase`, `showdomain`, `showwhois`, `showcontact`, `showcreatecase`, `showterms`, `defaultstart`, `defaultlanguageid`, `mservice`, `startappswelcome`, `preloader`, `gfont`, `showcontactcenter`, `contactcenterimage`, `smsname`) VALUES
(1, 1, 1, 'mailboy', 'default', 'Mailboy', 1, 'Mailboy AB', 'mailboy.myhalo.se', '#c1bbfd', '#8b52ff', '#6d5ffc', '#6d5ffc', '#ffffff', '#6d5ffc', '#f1f0f5', '#ffffff', '#292f51', 'mailboy-logo.png', 'mailboy-logo.png', 'default', 'default', 'default', 'default', 'default', 'default', NULL, 0, '', 'black', 'black', 'black', '<h4 class=\"text-dark\">Behöver du hjälp?<br>\nMailboy finns här!</h4> \nVår support finns här för dig 24/7 (begränsad på de svenska storhelgerna).', '<p>Villkor här..</p>', '<p>Denna webbplats &auml;r Mailboy`s tj&auml;nsteportal.</p>', 'Tjo', '', '', '', '', '', 'info@mailboy.myhalo.se', 'support@mailboy.myhalo.se.', 123, 213, 'https://mailboy.myhalo.se.', 'https://mailboy.myhalo.se.', '<p>Vi hoppas du ska trivas hos oss och med våra tjänster. Logga in och utforska vad vi har att erbjuda.</p>\n<p>Om du undrar något, tveka inte att kontakta vår support, vi finns här för dig 24/7. Dock tillfällig, begränsad support på de stora svenska storhelgerna.</p>', '<p>Vi hoppas du ska trivas hos oss och med våra tjänster.</p> <p>Om du undrar något, tveka inte att kontakta vår support, vi finns här för dig 24/7.<br> (Dock tillfällig, begränsad support på de stora svenska storhelgerna).</p>', 'moonbird_black.png', 0, 0, 0, 0, 0, 'INTRA', '', '', 1, '2023-09-25 17:23', '2024-02-17 18:05', 2, 2, 1, 'Kom igång', 'Här kommer du igång med våra tjänster enkelt.', 'Välkommen till Mailboy`s Kom igång', 1, 1, 1, 'Behöver du hjälp? Mailboy finns här!', 'Support info här..', 'Behöver du hjälp? Mailboy finns här!', NULL, '              <h3 class=\"mb-0 font-weight-semibold\">Vi finns här om du behöver hjälp eller tips och råd!</h3>\r\n              <p class=\"leading-normal\">Moonserver är verksamma i hela Sverige. Vi har lokala säljare i Stockholm, Västerås, Gävle, Sandviken, Hofors, Falun, Borlänge och Ludvika. </p>\r\n              <div class=\"alert alert-info\" role=\"alert\">\r\n                <i class=\"fa-solid fa-circle-info\"></i> Vår Support/Kundservice och Försäljning talar Svenska och Engelska.\r\n              </div>\r\n              <!--<h4 class=\"leading-normal\">Vi finns här om du behöver hjälp eller tips och råd.</h4>-->\r\n              <h4 class=\"mb-0 text-purple\"><b>Öppettider: </b></h4>\r\n              <p class=\"leading-normal\">Telefonväxel:\r\n                Måndag till Torsdag 09:00 - 16:00, <br>\r\n                Fredagar 09:00 - 15:00 (Svensk tid)\r\n                <br>\r\n                Support via E-post/Helpdesk: 24/7\r\n                <br> <br>\r\n                 Under nattetid (00:00-06:00) samt på de stora svenska helgdagarna har vi begränsad support. Det betyder att ett svar kan dröja lite längre men svar kommer så fort som möjligt.\r\n              </p>', NULL, 1, 1, 1, 1, 0, 1, 1, NULL, 1, 0, 'Detta är din personliga dashboard hos Mailboy. Här nedan ser du vilka tjänster du har tillgång till med ditt Mailboy Konto.', NULL, NULL, 1, 'support.jpg', 'Mailboy');

-- --------------------------------------------------------

--
-- Tabellstruktur `data_clients`
--

CREATE TABLE `data_clients` (
  `id` int(11) NOT NULL,
  `clientid` varchar(20) NOT NULL DEFAULT '0',
  `brand` text DEFAULT NULL,
  `typeid` int(11) NOT NULL DEFAULT 5,
  `companyname` mediumtext DEFAULT NULL,
  `companyid` mediumtext DEFAULT NULL,
  `vatid` mediumtext DEFAULT NULL,
  `mbingo` int(11) NOT NULL DEFAULT 0,
  `msite` int(11) NOT NULL DEFAULT 0,
  `contactname` mediumtext DEFAULT NULL,
  `phone` mediumtext DEFAULT NULL,
  `phone2` mediumtext DEFAULT NULL,
  `email` mediumtext DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `countryid` int(11) NOT NULL DEFAULT 0,
  `town` mediumtext DEFAULT NULL,
  `added` mediumtext DEFAULT NULL,
  `updated` mediumtext DEFAULT NULL,
  `addeduid` int(11) NOT NULL DEFAULT 0,
  `updateduid` int(11) NOT NULL DEFAULT 0,
  `info` mediumtext DEFAULT NULL,
  `userid` mediumtext DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `invoiceaddress` mediumtext DEFAULT NULL,
  `paddress` mediumtext DEFAULT NULL,
  `pzip` mediumtext DEFAULT NULL,
  `ptown` mediumtext DEFAULT NULL,
  `iemail` mediumtext DEFAULT NULL,
  `iaddress` mediumtext DEFAULT NULL,
  `izip` mediumtext DEFAULT NULL,
  `itown` mediumtext DEFAULT NULL,
  `ilandid` int(11) NOT NULL DEFAULT 1,
  `plandid` int(11) NOT NULL DEFAULT 1,
  `isnailmail` int(11) NOT NULL DEFAULT 0,
  `afid` int(11) NOT NULL DEFAULT 1,
  `website` mediumtext DEFAULT NULL,
  `facebook` mediumtext DEFAULT NULL,
  `instagram` mediumtext DEFAULT NULL,
  `alliance` mediumtext DEFAULT NULL,
  `landskapsid` int(11) NOT NULL DEFAULT 0,
  `image` varchar(111) NOT NULL DEFAULT 'client.png',
  `notes` mediumtext DEFAULT NULL,
  `adminnotes` mediumtext DEFAULT NULL,
  `orgemail` mediumtext DEFAULT NULL,
  `orgiemail` mediumtext DEFAULT NULL,
  `orgnew` int(11) NOT NULL DEFAULT 1,
  `orgadmin` int(11) NOT NULL DEFAULT 0,
  `closed` int(11) NOT NULL DEFAULT 0,
  `pud` int(11) NOT NULL DEFAULT 0,
  `brandid` int(11) NOT NULL DEFAULT 1,
  `bingoorganizerid` int(11) NOT NULL DEFAULT 0,
  `noinvoice` int(11) NOT NULL DEFAULT 0,
  `public` int(11) NOT NULL DEFAULT 0,
  `mainbrand` text DEFAULT NULL,
  `profilebkg` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_clients`
--

INSERT INTO `data_clients` (`id`, `clientid`, `brand`, `typeid`, `companyname`, `companyid`, `vatid`, `mbingo`, `msite`, `contactname`, `phone`, `phone2`, `email`, `active`, `countryid`, `town`, `added`, `updated`, `addeduid`, `updateduid`, `info`, `userid`, `address`, `invoiceaddress`, `paddress`, `pzip`, `ptown`, `iemail`, `iaddress`, `izip`, `itown`, `ilandid`, `plandid`, `isnailmail`, `afid`, `website`, `facebook`, `instagram`, `alliance`, `landskapsid`, `image`, `notes`, `adminnotes`, `orgemail`, `orgiemail`, `orgnew`, `orgadmin`, `closed`, `pud`, `brandid`, `bingoorganizerid`, `noinvoice`, `public`, `mainbrand`, `profilebkg`) VALUES
(1, '484484887', 'mailboy', 5, 'Mailboy AB', '5592591266', '', 1, 1, 'Johan Norr', '0790067505', '', 'johan@moonserver.se', 1, 1, 'Årsunda', '1636585194', '1713660799', 0, 2, '', '', '1', '', 'Prärievägen 4', '81173', 'Årsunda', '', 'Prärievägen 4', '81173', 'Årsunda', 1, 1, 0, 1, 'mailboy.myhalo.se', '', '', '', 0, 'client.png', '', '', '', '', 0, 1, 0, 0, 1, 1, 1, 1, 'mailboy', NULL),
(2, '484484887', 'mailboy', 5, 'Kund AB', '5592591266', '', 1, 1, 'Kalle Anka', '0790067505', '', 'kalle@anka.se', 1, 1, 'Årsunda', '1636585194', '1713660799', 0, 2, '', '', '1', '', 'Prärievägen 4', '81173', 'Årsunda', '', 'Prärievägen 4', '81173', 'Årsunda', 1, 1, 0, 1, 'kalleanka.se', '', '', '', 0, 'client.png', '', '', '', '', 0, 1, 0, 0, 1, 1, 1, 1, 'mailboy', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_clients_access`
--

CREATE TABLE `data_clients_access` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `aid` int(11) NOT NULL DEFAULT 0,
  `added` mediumtext DEFAULT NULL,
  `addeduid` int(11) NOT NULL DEFAULT 0,
  `updated` mediumtext DEFAULT NULL,
  `updateduid` int(11) NOT NULL DEFAULT 0,
  `accepted` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `activesites` int(11) NOT NULL DEFAULT 0,
  `sitesid` mediumtext DEFAULT NULL,
  `activehalo` int(11) NOT NULL DEFAULT 0,
  `halosid` mediumtext DEFAULT NULL,
  `activebingo` int(11) NOT NULL DEFAULT 0,
  `bingosid` mediumtext DEFAULT NULL,
  `activehosting` int(11) NOT NULL DEFAULT 0,
  `hostingsid` text DEFAULT NULL,
  `activecards` int(11) NOT NULL DEFAULT 0,
  `cardsid` text DEFAULT NULL,
  `activedrives` int(11) NOT NULL DEFAULT 0,
  `drivesid` text DEFAULT NULL,
  `economy` int(11) NOT NULL DEFAULT 0,
  `sales` int(11) NOT NULL DEFAULT 0,
  `support` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_clients_access`
--

INSERT INTO `data_clients_access` (`id`, `uid`, `cid`, `aid`, `added`, `addeduid`, `updated`, `updateduid`, `accepted`, `active`, `activesites`, `sitesid`, `activehalo`, `halosid`, `activebingo`, `bingosid`, `activehosting`, `hostingsid`, `activecards`, `cardsid`, `activedrives`, `drivesid`, `economy`, `sales`, `support`) VALUES
(1, 2, 1, 9, '1643638104', 2, '1704711346', 2, 1, 1, 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0),
(4, 1, 1, 9, '1643638104', 2, '1704711346', 2, 1, 1, 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0),
(2, 5, 2, 3, '1643638104', 2, '1704711346', 2, 1, 1, 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_clienttypes`
--

CREATE TABLE `data_clienttypes` (
  `id` int(11) NOT NULL,
  `short` text NOT NULL,
  `se_type` mediumtext DEFAULT NULL,
  `en_type` mediumtext DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_clienttypes`
--

INSERT INTO `data_clienttypes` (`id`, `short`, `se_type`, `en_type`, `active`) VALUES
(1, '', 'Privatperson/Enskild firma', 'Private person', 1),
(2, '', 'Ekonomisk Förening', 'Economic Association', 1),
(3, '', 'Ideell Förening', 'Non-profit Association\r\n', 1),
(4, '', 'Stiftelse', 'Foundation', 1),
(5, '', 'Företag', 'Company', 1),
(6, '', 'Samfällighetsförening', 'Community Association', 1),
(7, '', 'Bostadsrättsförening', 'Housing Cooperative', 1),
(8, '', 'Trossamfund', 'Religious Community', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_countrys`
--

CREATE TABLE `data_countrys` (
  `id` int(11) NOT NULL,
  `country_name` mediumtext DEFAULT NULL,
  `country_name_en` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `regactive` int(11) NOT NULL DEFAULT 0,
  `added` mediumtext DEFAULT NULL,
  `addeduser` int(11) NOT NULL DEFAULT 0,
  `updated` mediumtext DEFAULT NULL,
  `updateduser` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_countrys`
--

INSERT INTO `data_countrys` (`id`, `country_name`, `country_name_en`, `active`, `regactive`, `added`, `addeduser`, `updated`, `updateduser`) VALUES
(1, 'Sverige', 'Sweden', 1, 1, '2023-01-06', 2, '2023-01-06', 2),
(2, 'Storbrittanien', 'United Kingdom', 1, 0, '2023-01-06', 2, '2023-01-06', 2),
(3, 'Finland', 'Finland', 1, 0, '2023-01-06', 2, '2023-01-06', 2),
(4, 'Norge', 'Norway', 1, 0, '2023-01-06', 2, '2023-01-06', 2),
(5, 'Danmark', 'Denmark', 1, 0, '2023-01-06', 2, '2023-01-06', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_languages`
--

CREATE TABLE `data_languages` (
  `id` int(11) NOT NULL,
  `name` mediumtext DEFAULT NULL,
  `langfile` mediumtext DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `flag` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_languages`
--

INSERT INTO `data_languages` (`id`, `name`, `langfile`, `active`, `flag`) VALUES
(1, 'Svenska', 'sv', 1, '1x1/se.svg'),
(2, 'English', 'en', 1, '1x1/gb.svg');

-- --------------------------------------------------------

--
-- Tabellstruktur `data_messages`
--

CREATE TABLE `data_messages` (
  `id` int(11) NOT NULL,
  `fromuid` int(11) NOT NULL DEFAULT 0,
  `touid` int(11) NOT NULL DEFAULT 0,
  `header` mediumtext DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `history` mediumtext DEFAULT NULL,
  `signature` mediumtext DEFAULT NULL,
  `opened` int(11) NOT NULL DEFAULT 0,
  `openeddate` int(11) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL DEFAULT 0,
  `sent` int(11) NOT NULL DEFAULT 0,
  `datesent` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_messages`
--

INSERT INTO `data_messages` (`id`, `fromuid`, `touid`, `header`, `message`, `history`, `signature`, `opened`, `openeddate`, `date`, `sent`, `datesent`) VALUES
(1, 0, 6, 'Varmt välkommen till Mailboy', '<p>Vi hoppas du ska trivas hos oss och med våra tjänster.</p> <p>Om du undrar något, tveka inte att kontakta vår support, vi finns här för dig 24/7.<br> (Dock tillfällig, begränsad support på de stora svenska storhelgerna).</p>', NULL, 'Mvh, System', 0, 0, 1716413518, 0, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_news`
--

CREATE TABLE `data_news` (
  `id` int(11) NOT NULL,
  `news_image` mediumtext DEFAULT NULL,
  `news_header` mediumtext DEFAULT NULL,
  `news_info` mediumtext DEFAULT NULL,
  `news_userid` int(11) NOT NULL DEFAULT 0,
  `news_added` mediumtext DEFAULT NULL,
  `news_updated` mediumtext DEFAULT NULL,
  `news_important` int(11) NOT NULL DEFAULT 0,
  `brand` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `data_newsletters`
--

CREATE TABLE `data_newsletters` (
  `id` int(11) NOT NULL,
  `brand` text DEFAULT NULL,
  `cid` int(11) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `addeduid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_newsletters`
--

INSERT INTO `data_newsletters` (`id`, `brand`, `cid`, `name`, `description`, `active`, `added`, `addeduid`) VALUES
(1, 'mailboy', 2, 'Test 1', 'Testar att skapa ett nyhetsbrev', 1, '2024-05-22 19:06:42', 5),
(2, 'mailboy', 2, 'Test 2', 'Testar att skapa ett nyhetsbrev2', 1, '2024-05-22 19:06:42', 5),
(4, 'mailboy', 2, 'Test 3', '<p>Kort beskrivning.. 5ghgrtgrg&nbsp;</p>', 1, '2024-05-22 22:12:55', 5),
(7, 'mailboy', 2, 'rgfr11111111', '<p>Kort beskrivning..rggrg</p>', 0, '2024-05-22 22:44:04', 5),
(8, 'mailboy', 2, '4f4f4f', '333f3f3', 1, '2024-05-22 22:45:41', 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_newsletters_sending`
--

CREATE TABLE `data_newsletters_sending` (
  `id` int(11) NOT NULL,
  `newsletterid` int(11) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `sent` int(11) NOT NULL DEFAULT 0,
  `sentdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_newsletters_sending`
--

INSERT INTO `data_newsletters_sending` (`id`, `newsletterid`, `content`, `added`, `sent`, `sentdate`) VALUES
(1, 1, 'test', '2024-05-22 19:13:04', 0, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_newsletters_users`
--

CREATE TABLE `data_newsletters_users` (
  `id` int(11) NOT NULL,
  `newsletterid` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_newsletters_users`
--

INSERT INTO `data_newsletters_users` (`id`, `newsletterid`, `uid`, `active`, `added`) VALUES
(5, 1, 4, 1, '2024-05-22 21:15:35');

-- --------------------------------------------------------

--
-- Tabellstruktur `data_notifications`
--

CREATE TABLE `data_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `typeid` int(11) NOT NULL DEFAULT 1,
  `userid` int(10) UNSIGNED DEFAULT 0,
  `clientid` int(11) NOT NULL DEFAULT 0,
  `adminuserid` int(11) NOT NULL DEFAULT 0,
  `sessionid` char(32) DEFAULT NULL,
  `appname` varchar(20) DEFAULT NULL,
  `app` mediumtext DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `date` mediumtext DEFAULT NULL,
  `applink` mediumtext DEFAULT NULL,
  `open` int(11) DEFAULT 0,
  `open_date` mediumtext DEFAULT NULL,
  `invite` int(11) NOT NULL DEFAULT 0,
  `sent` int(11) NOT NULL DEFAULT 0,
  `datesent` mediumtext DEFAULT NULL,
  `important` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `data_notifications_type`
--

CREATE TABLE `data_notifications_type` (
  `id` int(11) NOT NULL,
  `shortname` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_notifications_type`
--

INSERT INTO `data_notifications_type` (`id`, `shortname`, `name`, `active`) VALUES
(1, 'alert', 'Notifikation', 1),
(2, 'mess', 'Meddelande', 1),
(3, 'task', 'Uppgift', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `data_pw_reset`
--

CREATE TABLE `data_pw_reset` (
  `id` int(11) NOT NULL,
  `user` varchar(60) DEFAULT NULL COMMENT 'old part from old system - deprecated - use reciever instead',
  `receiver` varchar(60) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(32) DEFAULT NULL,
  `pin` int(11) NOT NULL DEFAULT 0,
  `date_sent` datetime DEFAULT current_timestamp(),
  `date_expire` datetime DEFAULT current_timestamp(),
  `valid` varchar(1) NOT NULL DEFAULT 'Y',
  `brand` text DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `ip` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_pw_reset`
--

INSERT INTO `data_pw_reset` (`id`, `user`, `receiver`, `uid`, `hash`, `pin`, `date_sent`, `date_expire`, `valid`, `brand`, `type`, `ip`) VALUES
(1, NULL, 'mailboytest@moonserver.nu', 0, NULL, 774755, '2024-05-22 23:31:15', '2024-05-22 23:36:00', 'N', 'mailboy', 'email', '3562364093');

-- --------------------------------------------------------

--
-- Tabellstruktur `data_resellers`
--

CREATE TABLE `data_resellers` (
  `id` int(11) NOT NULL,
  `brand` text DEFAULT NULL,
  `resellerid` int(11) NOT NULL DEFAULT 0,
  `companyid` mediumtext DEFAULT NULL,
  `vatid` int(11) NOT NULL DEFAULT 0,
  `typeid` int(11) NOT NULL DEFAULT 5,
  `paddress` mediumtext DEFAULT NULL,
  `pzip` mediumtext DEFAULT NULL,
  `ptown` mediumtext DEFAULT NULL,
  `iaddress` mediumtext DEFAULT NULL,
  `izip` mediumtext DEFAULT NULL,
  `itown` mediumtext DEFAULT NULL,
  `ilandid` int(11) NOT NULL DEFAULT 1,
  `plandid` int(11) NOT NULL DEFAULT 1,
  `isnailmail` int(11) NOT NULL DEFAULT 0,
  `facebook` mediumtext DEFAULT NULL,
  `instagram` mediumtext DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `companyname` mediumtext DEFAULT NULL,
  `worktitle` mediumtext DEFAULT NULL,
  `contactname` mediumtext DEFAULT NULL,
  `phone` mediumtext DEFAULT NULL,
  `email` mediumtext DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `countryid` int(11) NOT NULL DEFAULT 0,
  `invoiceaddress` mediumtext DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `zip` text DEFAULT NULL,
  `town` mediumtext DEFAULT NULL,
  `added` mediumtext DEFAULT NULL,
  `updated` mediumtext DEFAULT NULL,
  `addeduid` int(11) NOT NULL DEFAULT 0,
  `updateduid` int(11) NOT NULL DEFAULT 0,
  `info` mediumtext DEFAULT NULL,
  `userid` int(11) NOT NULL DEFAULT 0,
  `logo` mediumtext DEFAULT NULL,
  `logos` int(11) NOT NULL DEFAULT 0,
  `support_phone` int(11) NOT NULL DEFAULT 0,
  `support_email` mediumtext DEFAULT NULL,
  `support_info` mediumtext DEFAULT NULL,
  `support_link` mediumtext DEFAULT NULL,
  `website` mediumtext DEFAULT NULL,
  `addresstype` int(11) NOT NULL DEFAULT 0,
  `mainbrand` text DEFAULT NULL,
  `bg` text DEFAULT NULL,
  `pg` text DEFAULT NULL,
  `adminnotes` mediumtext DEFAULT NULL,
  `orgemail` mediumtext DEFAULT NULL,
  `orgiemail` mediumtext DEFAULT NULL,
  `orgadmin` int(11) NOT NULL DEFAULT 0,
  `closed` int(11) NOT NULL DEFAULT 0,
  `noinvoice` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT 0,
  `profilebkg` text DEFAULT NULL,
  `image` varchar(111) NOT NULL DEFAULT 'haloreseller.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_resellers`
--

INSERT INTO `data_resellers` (`id`, `brand`, `resellerid`, `companyid`, `vatid`, `typeid`, `paddress`, `pzip`, `ptown`, `iaddress`, `izip`, `itown`, `ilandid`, `plandid`, `isnailmail`, `facebook`, `instagram`, `notes`, `companyname`, `worktitle`, `contactname`, `phone`, `email`, `active`, `countryid`, `invoiceaddress`, `address`, `zip`, `town`, `added`, `updated`, `addeduid`, `updateduid`, `info`, `userid`, `logo`, `logos`, `support_phone`, `support_email`, `support_info`, `support_link`, `website`, `addresstype`, `mainbrand`, `bg`, `pg`, `adminnotes`, `orgemail`, `orgiemail`, `orgadmin`, `closed`, `noinvoice`, `public`, `profilebkg`, `image`) VALUES
(1, NULL, 0, '123456', 0, 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, 'Mailboy AB', '', 'Johan Norr', '010-4241960', 'info@mailboy.myhalo.se', 1, 1, 'Polhemsgatan 9 B\r\n81160 Sandviken', 'fr4', '81162', 'Sandviken', '1636585194', '1702304299', 0, 2, '', 2, '', 2, 213, 'support@mailboy.myhalo.se', '', 'https://mailboy.myhalo.se', 'mailboy.myhalo.se', 0, 'mailboy', '1221', '354434', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 'haloreseller.png');

-- --------------------------------------------------------

--
-- Tabellstruktur `data_sentmessages`
--

CREATE TABLE `data_sentmessages` (
  `id` int(11) NOT NULL,
  `brand` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0,
  `rid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `message` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(11) DEFAULT NULL,
  `receiver` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_sentmessages`
--

INSERT INTO `data_sentmessages` (`id`, `brand`, `type`, `uid`, `rid`, `cid`, `message`, `subject`, `date`, `ip`, `receiver`) VALUES
(1, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 15:44<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 15:44:12', '3562364093', 'johan@moonserver.se'),
(2, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 15:46<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 15:46:11', '3562364093', 'johan@moonserver.se'),
(3, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 15:47<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 15:47:16', '3562364093', 'johan@moonserver.se'),
(4, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 15:48<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 15:48:34', '3562364093', 'johan@moonserver.se'),
(5, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 16:30<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 16:30:51', '3562364093', 'johan@moonserver.se'),
(6, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 16:32<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 16:32:18', '3562364093', 'johan@moonserver.se'),
(7, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 16:33<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 16:33:14', '3562364093', 'johan@moonserver.se'),
(8, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 17:08<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 17:08:49', '3562364093', 'johan@moonserver.se'),
(9, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 17:35<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 17:35:20', '3562364093', 'johan@moonserver.se'),
(10, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 17:36<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 17:36:20', '3562364093', 'johan.norr84@gmail.com'),
(11, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 17:40<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 17:40:06', '3562364093', 'johan.norr84@gmail.com'),
(12, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 17:59<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 17:59:22', '3562364093', 'johan.norr84@gmail.com'),
(13, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 17:59<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 17:59:22', '3562364093', 'johan.norr84@gmail.com'),
(14, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:04<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:04:46', '3562364093', 'johan@moonserver.se'),
(15, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:13<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:13:05', '3562364093', 'johan.norr84@gmail.com'),
(16, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:15<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:15:20', '3562364093', 'johan.norr84@gmail.com'),
(17, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:19<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:19:01', '3562364093', 'johan.norr84@gmail.com'),
(18, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:32<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:32:34', '3562364093', 'johan.norr84@gmail.com'),
(19, 'mailboy', 'email', 5, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:36<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:36:44', '3562364093', 'malin.lofling@gmail.com'),
(20, 'mailboy', 'email', 5, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:41<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:41:43', '3562364093', 'malin.lofling@gmail.com'),
(21, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:42<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:42:37', '3562364093', 'johan.norr84@gmail.com'),
(22, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:43<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:43:13', '3562364093', 'johan@moonserver.se'),
(23, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:53<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:53:40', '3562364093', 'johan@moonserver.se'),
(24, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:53<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:53:49', '3562364093', 'johan.norr84@gmail.com'),
(25, 'mailboy', 'email', 5, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:54<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:54:08', '3562364093', 'malin.lofling@gmail.com'),
(26, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 18:54<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 18:54:30', '3562364093', 'johan@moonserver.se'),
(27, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 19:29<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 19:29:44', '3562364093', 'johan.norr84@gmail.com'),
(28, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 19:56<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 19:56:55', '3562364093', 'johan@moonserver.se'),
(29, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 19:57<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 19:57:27', '3562364093', 'johan.norr84@gmail.com'),
(30, 'mailboy', 'email', 5, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 21:33<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 21:33:20', '3562364093', 'malin.lofling@gmail.com'),
(31, 'mailboy', 'email', 5, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 22:02<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 22:02:28', '3562364093', 'malin.lofling@gmail.com'),
(32, 'mailboy', 'email', 5, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 22:13<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 22:13:17', '3562364093', 'malin.lofling@gmail.com'),
(33, 'mailboy', 'email', 4, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 23:11<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 23:11:44', '3562364093', 'johan.norr84@gmail.com'),
(34, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 23:12<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 23:12:03', '3562364093', 'johan@moonserver.se'),
(35, 'mailboy', 'email', 2, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 23:21<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 23:21:01', '3562364093', 'johan@moonserver.se'),
(36, 'mailboy', 'email', 1, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 23:22<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 23:22:09', '3562364093', 'mattias.ekendahl@elevera.org'),
(37, 'mailboy', 'email', 1, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 23:24<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 23:24:22', '3562364093', 'mattias.ekendahl@elevera.org'),
(38, 'mailboy', 'email', 0, 1, 0, '<b>Använd denna 6-siffriga KOD för att verifiera din e-postadress: </b><br><h1>774755</h1></p><p>Om det inte var du som begärde detta så kan du strunta i detta mailet.</p>', 'Verifiera din e-postadress - Mailboy', '2024-05-22 23:31:15', '3562364093', 'mailboytest@moonserver.nu'),
(39, 'mailboy', 'email', 0, 1, 0, '<p>Vi hoppas du ska trivas hos oss och med våra tjänster. Logga in och utforska vad vi har att erbjuda.</p>\n<p>Om du undrar något, tveka inte att kontakta vår support, vi finns här för dig 24/7. Dock tillfällig, begränsad support på de stora svenska storhelgerna.</p>', 'Varmt välkommen till Mailboy', '2024-05-22 23:31:58', '3562364093', 'mailboytest@moonserver.nu'),
(40, 'mailboy', 'email', 6, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 23:32<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 23:32:16', '3562364093', 'mailboytest@moonserver.nu'),
(41, 'mailboy', 'email', 6, 1, 0, 'Det har skett en ny inloggning på ditt konto nyss.<br><br>\r\n        Datum: 2024-05-22 23:46<br>\r\n        App: Chrome<br>\r\n        IP: 212.85.92.189<br><br>\r\n        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>\r\n        Vänligen kontakta support om du behöver hjälp.\r\n        ', 'Ny inloggning på ditt konto - Mailboy', '2024-05-22 23:46:57', '3562364093', 'mailboytest@moonserver.nu');

-- --------------------------------------------------------

--
-- Tabellstruktur `data_tasks`
--

CREATE TABLE `data_tasks` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `rid` int(11) NOT NULL DEFAULT 0,
  `typeid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `csid` int(11) NOT NULL DEFAULT 0,
  `text` mediumtext DEFAULT NULL,
  `added` mediumtext DEFAULT NULL,
  `addeduid` int(11) NOT NULL DEFAULT 0,
  `updated` mediumtext DEFAULT NULL,
  `updateduid` int(11) NOT NULL DEFAULT 0,
  `usernotes` mediumtext DEFAULT NULL,
  `adminnotes` mediumtext DEFAULT NULL,
  `done` int(11) NOT NULL DEFAULT 0,
  `brand` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `data_users`
--

CREATE TABLE `data_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand` text DEFAULT NULL COMMENT 'reseller brand',
  `userid` varchar(20) DEFAULT NULL,
  `pid` varchar(12) NOT NULL DEFAULT '0',
  `user_name` varchar(10) DEFAULT NULL,
  `user_fname` varchar(30) DEFAULT NULL,
  `user_sname` varchar(30) DEFAULT NULL,
  `user_worktitle` mediumtext DEFAULT NULL,
  `user_adress1` varchar(30) DEFAULT NULL,
  `user_adress2` varchar(30) DEFAULT NULL,
  `countryid` int(11) NOT NULL DEFAULT 1,
  `user_city` varchar(20) DEFAULT NULL,
  `user_zip` varchar(10) DEFAULT NULL,
  `user_email` varchar(40) DEFAULT NULL,
  `user_phone` varchar(40) DEFAULT NULL,
  `user_pass` mediumtext DEFAULT NULL,
  `user_added` mediumtext DEFAULT NULL,
  `user_updated` mediumtext DEFAULT NULL,
  `user_notes` text DEFAULT NULL,
  `user_access` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `user_active` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `user_img` varchar(100) NOT NULL DEFAULT 'nopic.png',
  `user_img_date` mediumtext DEFAULT NULL,
  `login_tries` int(11) NOT NULL DEFAULT 5,
  `using_tmp_pw` varchar(1) NOT NULL DEFAULT 'N',
  `group_id` int(11) NOT NULL DEFAULT 1 COMMENT 'resellerid',
  `user_presentation` mediumtext DEFAULT NULL,
  `user_hidden` tinyint(1) DEFAULT 0,
  `last_login` mediumtext DEFAULT NULL,
  `accepted_terms` tinyint(1) DEFAULT 0,
  `accounttype_id` int(11) NOT NULL DEFAULT 0,
  `account_startdate` mediumtext DEFAULT NULL,
  `account_enddate` mediumtext DEFAULT NULL,
  `account_updated` mediumtext DEFAULT NULL,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `gids` mediumtext DEFAULT NULL,
  `user_balance` decimal(19,2) NOT NULL DEFAULT 0.00,
  `user_reservedmoney` decimal(19,2) NOT NULL DEFAULT 0.00,
  `user_new` mediumtext DEFAULT NULL,
  `user_newclient` int(11) NOT NULL DEFAULT 0,
  `bbk_terms` mediumtext DEFAULT NULL,
  `gdpr_terms` int(11) NOT NULL DEFAULT 0,
  `findus` mediumtext DEFAULT NULL,
  `pcid` int(11) NOT NULL DEFAULT 0,
  `defaultcid` int(11) NOT NULL DEFAULT 0,
  `registered` int(11) NOT NULL DEFAULT 1,
  `brandid` int(11) NOT NULL DEFAULT 1,
  `exceptmail` int(11) NOT NULL DEFAULT 0,
  `defaultstart` mediumtext DEFAULT NULL,
  `defaultlanguageid` int(11) NOT NULL DEFAULT 0,
  `profilebkg` text DEFAULT NULL,
  `verifiedemail` int(11) NOT NULL DEFAULT 0,
  `verifiedphone` int(11) NOT NULL DEFAULT 0,
  `2fasms` int(11) NOT NULL DEFAULT 0,
  `closed` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumpning av Data i tabell `data_users`
--

INSERT INTO `data_users` (`id`, `brand`, `userid`, `pid`, `user_name`, `user_fname`, `user_sname`, `user_worktitle`, `user_adress1`, `user_adress2`, `countryid`, `user_city`, `user_zip`, `user_email`, `user_phone`, `user_pass`, `user_added`, `user_updated`, `user_notes`, `user_access`, `user_active`, `user_img`, `user_img_date`, `login_tries`, `using_tmp_pw`, `group_id`, `user_presentation`, `user_hidden`, `last_login`, `accepted_terms`, `accounttype_id`, `account_startdate`, `account_enddate`, `account_updated`, `client_id`, `gids`, `user_balance`, `user_reservedmoney`, `user_new`, `user_newclient`, `bbk_terms`, `gdpr_terms`, `findus`, `pcid`, `defaultcid`, `registered`, `brandid`, `exceptmail`, `defaultstart`, `defaultlanguageid`, `profilebkg`, `verifiedemail`, `verifiedphone`, `2fasms`, `closed`) VALUES
(2, 'mailboy', '2302525279', '190000000000', 'system', 'Johan', 'Norr', 'SystemAdmin', 'Testgatan 1', NULL, 1, 'Teststan', '51110', 'johan@moonserver.se', '0790067505', '$2y$10$VA1OQp/bM90Liy1loax/Ke.EF6X8i6UFhI0FKpl68hF3ovcSWZiRS', '1636583948', '1713659696', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim mauris quis velit sagittis, vitae gravida sapien suscipit. Mauris euismod pharetra mauris, sit amet porttitor lectus sodales sed. Phasellus tristique tellus in justo maximus, ut tristique ipsum mattis. Donec in sapien quis turpis facilisis commodo id eget leo. Vivamus eu ornare mauris, at condimentum nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed imperdiet leo felis, vehicula tincidunt lacus malesuada id. Aliquam porttitor turpis quis velit luctus, nec elementum tortor volutpat. Fusce eget neque dapibus, porttitor purus at, sollicitudin lectus. Fusce sit amet libero turpis. Fusce sagittis augue vel lacus fringilla, vitae laoreet lacus pretium. Aliquam tincidunt sem ipsum, vitae gravida eros lacinia nec. Nulla dignissim, purus eget fermentum elementum, elit sem condimentum turpis, et iaculis ipsum risus vel leo. Pellentesque aliquam dui in consectetur consequat. Aliquam pellentesque diam sed eros lobortis sodales ut sit amet ligula.', 9, 1, 'sampleprofil.png', '1704486788', 5, 'N', 1, NULL, 0, '2024-05-22 23:21:01', 1, 4, '2021-06-01', '2099-12-24', '2021-05-30', 1, '', 0.00, 0.00, '', 0, '', 0, '', 0, 1, 1, 1, 0, '', 1, '', 1, 1, 0, 0),
(1, 'mailboy', '2305372733', '190000000000', 'admin', 'Mattias', 'Ekendahl', 'SystemAdmin', '', NULL, 1, 'a', '1', 'mattias.ekendahl@elevera.org', '0790067505', '$2y$10$ETyRUZXHSLqsG1fdU4K8Su5kpCzcT0xkvS1hqiT2GfJLjWMjU3c1G', '1636585194', '1716412914', NULL, 9, 1, 'sampleprofil.png', '', 5, 'N', 1, NULL, 0, '2024-05-22 23:24:22', 1, 4, '2021-06-01', '2099-12-24', '2021-05-30', 1, '', 0.00, 0.00, '', 0, '', 0, '', 0, 1, 1, 1, 0, '', 0, '', 1, 0, 0, 0),
(4, 'mailboy', '2305372778', '190000000000', 'johan', 'Johan', 'Norr', '', NULL, NULL, 1, NULL, NULL, 'johan.norr84@gmail.com', '0790067505', '$2y$10$E91VYnzY3/CrrE7Fxsu2e.9nRxRq3hNlfkA4WydlyaCT2xMl82vJe', '1636585194', '1707397714', NULL, 1, 1, 'sampleprofil.png', '1670960266', 5, 'N', 1, NULL, 0, '2024-05-22 23:11:44', 1, 4, '2021-06-01', '2099-12-24', '2021-05-30', 0, '', 0.00, 0.00, '', 0, '', 0, '', 0, 0, 1, 1, 0, '', 0, '', 1, 0, 0, 0),
(5, 'mailboy', '2402348555', '190000000000', NULL, 'Malin', 'Löfling', '', NULL, NULL, 1, NULL, NULL, 'malin.lofling@gmail.com', '0723297708', '$2y$10$0wBHF5JXL3g5u7MBIVFS4ugzY.CKCOaq2kTbn.29l0ZG8dBPtRS56', '1658428773', '2024-05-21 18:55:34', NULL, 3, 1, 'sampleprofil.png', '1711573540', 5, 'N', 1, NULL, 0, '2024-05-22 22:13:17', 1, 0, '', '', '', 0, '', 0.00, 0.00, '', 0, '', 1, 'Rekommendation', 0, 2, 1, 1, 0, '', 1, '', 1, 0, 0, 0),
(6, 'mailboy', '2406963451', '0', NULL, 'Kalle', 'Svensson', NULL, NULL, NULL, 1, NULL, NULL, 'mailboytest@moonserver.nu', '0790067505', '$2y$10$npQplfLM7J/DOEk4u1c5FedLOJF0vW/ywJ7qyor.y3zJSg842Vh7C', '1716413518', '1716414352', NULL, 3, 1, 'nopic.png', NULL, 5, 'N', 1, NULL, 0, '2024-05-22 23:46:57', 1, 0, NULL, NULL, NULL, 0, NULL, 0.00, 0.00, '0', 0, NULL, 1, 'Google', 0, 0, 1, 1, 0, NULL, 0, NULL, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `log_admin`
--

CREATE TABLE `log_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` char(32) DEFAULT NULL,
  `log_event` varchar(20) DEFAULT NULL,
  `log_ip` int(10) UNSIGNED DEFAULT NULL,
  `log_notes` mediumtext DEFAULT NULL,
  `log_date` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `data_access`
--
ALTER TABLE `data_access`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_activities`
--
ALTER TABLE `data_activities`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_branding`
--
ALTER TABLE `data_branding`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_clients`
--
ALTER TABLE `data_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_clients_access`
--
ALTER TABLE `data_clients_access`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_clienttypes`
--
ALTER TABLE `data_clienttypes`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_countrys`
--
ALTER TABLE `data_countrys`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_languages`
--
ALTER TABLE `data_languages`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_messages`
--
ALTER TABLE `data_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_news`
--
ALTER TABLE `data_news`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_newsletters`
--
ALTER TABLE `data_newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_newsletters_sending`
--
ALTER TABLE `data_newsletters_sending`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_newsletters_users`
--
ALTER TABLE `data_newsletters_users`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_notifications`
--
ALTER TABLE `data_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_notifications_type`
--
ALTER TABLE `data_notifications_type`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_pw_reset`
--
ALTER TABLE `data_pw_reset`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_resellers`
--
ALTER TABLE `data_resellers`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_sentmessages`
--
ALTER TABLE `data_sentmessages`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_tasks`
--
ALTER TABLE `data_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `data_users`
--
ALTER TABLE `data_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user_name`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Index för tabell `log_admin`
--
ALTER TABLE `log_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `data_access`
--
ALTER TABLE `data_access`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT för tabell `data_activities`
--
ALTER TABLE `data_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT för tabell `data_branding`
--
ALTER TABLE `data_branding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT för tabell `data_clients`
--
ALTER TABLE `data_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `data_clients_access`
--
ALTER TABLE `data_clients_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT för tabell `data_clienttypes`
--
ALTER TABLE `data_clienttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT för tabell `data_countrys`
--
ALTER TABLE `data_countrys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `data_languages`
--
ALTER TABLE `data_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `data_messages`
--
ALTER TABLE `data_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `data_news`
--
ALTER TABLE `data_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `data_newsletters`
--
ALTER TABLE `data_newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT för tabell `data_newsletters_sending`
--
ALTER TABLE `data_newsletters_sending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `data_newsletters_users`
--
ALTER TABLE `data_newsletters_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `data_notifications`
--
ALTER TABLE `data_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `data_notifications_type`
--
ALTER TABLE `data_notifications_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `data_pw_reset`
--
ALTER TABLE `data_pw_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `data_resellers`
--
ALTER TABLE `data_resellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `data_sentmessages`
--
ALTER TABLE `data_sentmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT för tabell `data_tasks`
--
ALTER TABLE `data_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `data_users`
--
ALTER TABLE `data_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `log_admin`
--
ALTER TABLE `log_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
