-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2019 at 11:24 AM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.2.18-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forecasting`
--

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_hasil`
--

CREATE TABLE `forecasting_hasil` (
  `id_hasil` int(12) NOT NULL,
  `tanggal_hasil` datetime DEFAULT NULL,
  `nama_hasil` varchar(50) DEFAULT NULL,
  `status_hasil` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecasting_hasil`
--

INSERT INTO `forecasting_hasil` (`id_hasil`, `tanggal_hasil`, `nama_hasil`, `status_hasil`) VALUES
(14, '2017-08-16 00:00:00', 'Peramalan Tahun 2015', 1),
(15, '2017-08-09 00:00:00', 'Hasil Peramalan Periode Tahun 2015', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_hasil_detail`
--

CREATE TABLE `forecasting_hasil_detail` (
  `id_hasil_detail` int(12) NOT NULL,
  `id_hasil` int(12) DEFAULT NULL,
  `periode_char` varchar(20) DEFAULT NULL,
  `hasil` float DEFAULT NULL,
  `periode_urutan` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecasting_hasil_detail`
--

INSERT INTO `forecasting_hasil_detail` (`id_hasil_detail`, `id_hasil`, `periode_char`, `hasil`, `periode_urutan`) VALUES
(541, 14, '2015 - Januari (1)', 803.882, 1),
(542, 14, '2015 - Januari (2)', 823.473, 2),
(543, 14, '2015 - Januari (3)', 843.064, 3),
(544, 14, '2015 - Januari (4)', 862.655, 4),
(545, 14, '2015 - Januari (5)', 882.247, 5),
(546, 14, '2015 - Februari (1)', 901.838, 6),
(547, 14, '2015 - Februari (2)', 921.429, 7),
(548, 14, '2015 - Februari (3)', 941.02, 8),
(549, 14, '2015 - Februari (4)', 960.611, 9),
(550, 14, '2015 - Februari (5)', 980.202, 10),
(551, 14, '2015 - Maret (1)', 999.793, 11),
(552, 14, '2015 - Maret (2)', 1019.38, 12),
(553, 14, '2015 - Maret (3)', 1038.98, 13),
(554, 14, '2015 - Maret (4)', 1058.57, 14),
(555, 14, '2015 - Maret (5)', 1078.16, 15),
(556, 14, '2015 - April (1)', 1097.75, 16),
(557, 14, '2015 - April (2)', 1117.34, 17),
(558, 14, '2015 - April (3)', 1136.93, 18),
(559, 14, '2015 - April (4)', 1156.52, 19),
(560, 14, '2015 - April (5)', 1176.11, 20),
(561, 14, '2015 - Mei (1)', 1195.7, 21),
(562, 14, '2015 - Mei (2)', 1215.3, 22),
(563, 14, '2015 - Mei (3)', 1234.89, 23),
(564, 14, '2015 - Mei (4)', 1254.48, 24),
(565, 14, '2015 - Mei (5)', 1274.07, 25),
(566, 14, '2015 - Juni (1)', 1293.66, 26),
(567, 14, '2015 - Juni (2)', 1313.25, 27),
(568, 14, '2015 - Juni (3)', 1332.84, 28),
(569, 14, '2015 - Juni (4)', 1352.43, 29),
(570, 14, '2015 - Juni (5)', 1372.02, 30),
(571, 14, '2015 - Juli (1)', 1391.62, 31),
(572, 14, '2015 - Juli (2)', 1411.21, 32),
(573, 14, '2015 - Juli (3)', 1430.8, 33),
(574, 14, '2015 - Juli (4)', 1450.39, 34),
(575, 14, '2015 - Juli (5)', 1469.98, 35),
(576, 14, '2015 - Agustus (1)', 1489.57, 36),
(577, 14, '2015 - Agustus (2)', 1509.16, 37),
(578, 14, '2015 - Agustus (3)', 1528.75, 38),
(579, 14, '2015 - Agustus (4)', 1548.34, 39),
(580, 14, '2015 - Agustus (5)', 1567.94, 40),
(581, 14, '2015 - September (1)', 1587.53, 41),
(582, 14, '2015 - September (2)', 1607.12, 42),
(583, 14, '2015 - September (3)', 1626.71, 43),
(584, 14, '2015 - September (4)', 1646.3, 44),
(585, 14, '2015 - September (5)', 1665.89, 45),
(586, 14, '2015 - Oktober (1)', 1685.48, 46),
(587, 14, '2015 - Oktober (2)', 1705.07, 47),
(588, 14, '2015 - Oktober (3)', 1724.66, 48),
(589, 14, '2015 - Oktober (4)', 1744.25, 49),
(590, 14, '2015 - Oktober (5)', 1763.85, 50),
(591, 14, '2015 - November (1)', 1783.44, 51),
(592, 14, '2015 - November (2)', 1803.03, 52),
(593, 14, '2015 - November (3)', 1822.62, 53),
(594, 14, '2015 - November (4)', 1842.21, 54),
(595, 14, '2015 - November (5)', 1861.8, 55),
(596, 14, '2015 - Desember (1)', 1881.39, 56),
(597, 14, '2015 - Desember (2)', 1900.98, 57),
(598, 14, '2015 - Desember (3)', 1920.57, 58),
(599, 14, '2015 - Desember (4)', 1940.17, 59),
(600, 14, '2015 - Desember (5)', 1959.76, 60),
(601, 15, '2015 - Januari (1)', 803.882, 1),
(602, 15, '2015 - Januari (2)', 823.473, 2),
(603, 15, '2015 - Januari (3)', 843.064, 3),
(604, 15, '2015 - Januari (4)', 862.655, 4),
(605, 15, '2015 - Januari (5)', 882.247, 5),
(606, 15, '2015 - Februari (1)', 901.838, 6),
(607, 15, '2015 - Februari (2)', 921.429, 7),
(608, 15, '2015 - Februari (3)', 941.02, 8),
(609, 15, '2015 - Februari (4)', 960.611, 9),
(610, 15, '2015 - Februari (5)', 980.202, 10),
(611, 15, '2015 - Maret (1)', 999.793, 11),
(612, 15, '2015 - Maret (2)', 1019.38, 12),
(613, 15, '2015 - Maret (3)', 1038.98, 13),
(614, 15, '2015 - Maret (4)', 1058.57, 14),
(615, 15, '2015 - Maret (5)', 1078.16, 15),
(616, 15, '2015 - April (1)', 1097.75, 16),
(617, 15, '2015 - April (2)', 1117.34, 17),
(618, 15, '2015 - April (3)', 1136.93, 18),
(619, 15, '2015 - April (4)', 1156.52, 19),
(620, 15, '2015 - April (5)', 1176.11, 20),
(621, 15, '2015 - Mei (1)', 1195.7, 21),
(622, 15, '2015 - Mei (2)', 1215.3, 22),
(623, 15, '2015 - Mei (3)', 1234.89, 23),
(624, 15, '2015 - Mei (4)', 1254.48, 24),
(625, 15, '2015 - Mei (5)', 1274.07, 25),
(626, 15, '2015 - Juni (1)', 1293.66, 26),
(627, 15, '2015 - Juni (2)', 1313.25, 27),
(628, 15, '2015 - Juni (3)', 1332.84, 28),
(629, 15, '2015 - Juni (4)', 1352.43, 29),
(630, 15, '2015 - Juni (5)', 1372.02, 30),
(631, 15, '2015 - Juli (1)', 1391.62, 31),
(632, 15, '2015 - Juli (2)', 1411.21, 32),
(633, 15, '2015 - Juli (3)', 1430.8, 33),
(634, 15, '2015 - Juli (4)', 1450.39, 34),
(635, 15, '2015 - Juli (5)', 1469.98, 35),
(636, 15, '2015 - Agustus (1)', 1489.57, 36),
(637, 15, '2015 - Agustus (2)', 1509.16, 37),
(638, 15, '2015 - Agustus (3)', 1528.75, 38),
(639, 15, '2015 - Agustus (4)', 1548.34, 39),
(640, 15, '2015 - Agustus (5)', 1567.94, 40),
(641, 15, '2015 - September (1)', 1587.53, 41),
(642, 15, '2015 - September (2)', 1607.12, 42),
(643, 15, '2015 - September (3)', 1626.71, 43),
(644, 15, '2015 - September (4)', 1646.3, 44),
(645, 15, '2015 - September (5)', 1665.89, 45),
(646, 15, '2015 - Oktober (1)', 1685.48, 46),
(647, 15, '2015 - Oktober (2)', 1705.07, 47),
(648, 15, '2015 - Oktober (3)', 1724.66, 48),
(649, 15, '2015 - Oktober (4)', 1744.25, 49),
(650, 15, '2015 - Oktober (5)', 1763.85, 50),
(651, 15, '2015 - November (1)', 1783.44, 51),
(652, 15, '2015 - November (2)', 1803.03, 52),
(653, 15, '2015 - November (3)', 1822.62, 53),
(654, 15, '2015 - November (4)', 1842.21, 54),
(655, 15, '2015 - November (5)', 1861.8, 55),
(656, 15, '2015 - Desember (1)', 1881.39, 56),
(657, 15, '2015 - Desember (2)', 1900.98, 57),
(658, 15, '2015 - Desember (3)', 1920.57, 58),
(659, 15, '2015 - Desember (4)', 1940.17, 59),
(660, 15, '2015 - Desember (5)', 1959.76, 60);

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_hasil_error`
--

CREATE TABLE `forecasting_hasil_error` (
  `id_hasil_error` int(12) NOT NULL,
  `id_hasil` int(12) DEFAULT NULL,
  `nilaiPerhitunganMADValue` varchar(50) DEFAULT NULL,
  `nilaiHasilMADValue` varchar(50) DEFAULT NULL,
  `nilaiPerhitunganMSEValue` varchar(50) DEFAULT NULL,
  `nilaiHasilMSEValue` varchar(50) DEFAULT NULL,
  `nilaiPerhitunganMAPEValue` varchar(50) DEFAULT NULL,
  `nilaiHasilMAPEValue` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecasting_hasil_error`
--

INSERT INTO `forecasting_hasil_error` (`id_hasil_error`, `id_hasil`, `nilaiPerhitunganMADValue`, `nilaiHasilMADValue`, `nilaiPerhitunganMSEValue`, `nilaiHasilMSEValue`, `nilaiPerhitunganMAPEValue`, `nilaiHasilMAPEValue`) VALUES
(4, 14, '11028.631 / 59', '186.93', '3313033.526789 / 59', '56,153.11', '3844.5349255513 / 59', '65.16%'),
(5, 15, '11028.631 / 59', '186.93', '3313033.526789 / 59', '56,153.11', '3844.5349255513 / 59', '65.16%');

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_property`
--

CREATE TABLE `forecasting_property` (
  `id_property` int(12) NOT NULL,
  `alfa_value_single` float DEFAULT NULL,
  `alfa_value_double` float DEFAULT NULL,
  `beta_value_double` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_transaction`
--

CREATE TABLE `forecasting_transaction` (
  `id_transaction` int(12) NOT NULL,
  `periode` int(30) NOT NULL,
  `x_value` float NOT NULL,
  `a_value` float NOT NULL,
  `aa_value` float NOT NULL,
  `at_value` float NOT NULL,
  `bt_value` float NOT NULL,
  `method` tinyint(2) NOT NULL,
  `forecasting` float NOT NULL,
  `status` tinyint(2) NOT NULL,
  `alfa` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecasting_transaction`
--

INSERT INTO `forecasting_transaction` (`id_transaction`, `periode`, `x_value`, `a_value`, `aa_value`, `at_value`, `bt_value`, `method`, `forecasting`, `status`, `alfa`) VALUES
(1, 2014011, 185, 185, 185, 185, 0, 1, 0, 1, 0.2),
(2, 2014012, 405, 229, 193.8, 264.2, 8.8, 1, 185, 1, 0.2),
(3, 2014013, 367, 256.6, 206.36, 306.84, 12.56, 1, 273, 1, 0.2),
(4, 2014014, 479, 301.08, 225.304, 376.856, 18.944, 1, 319.4, 1, 0.2),
(5, 2014015, 606, 362.064, 252.656, 471.472, 27.352, 1, 395.8, 1, 0.2),
(6, 2014021, 713, 432.251, 288.575, 575.927, 35.919, 1, 498.824, 1, 0.2),
(7, 2014022, 579, 461.601, 323.18, 600.021, 34.6052, 1, 611.846, 1, 0.2),
(8, 2014023, 598, 488.881, 356.32, 621.441, 33.1402, 1, 634.626, 1, 0.2),
(9, 2014024, 654, 521.905, 389.437, 654.373, 33.117, 1, 654.581, 1, 0.2),
(10, 2014025, 106, 438.724, 399.294, 478.154, 9.8574, 1, 687.49, 1, 0.2),
(11, 2014031, 478, 446.579, 408.751, 484.407, 9.45704, 1, 488.011, 1, 0.2),
(12, 2014032, 544, 466.063, 420.213, 511.913, 11.4624, 1, 493.864, 1, 0.2),
(13, 2014033, 278, 428.45, 421.86, 435.04, 1.64748, 1, 523.375, 1, 0.2),
(14, 2014034, 336, 409.96, 419.48, 400.44, -2.38, 1, 436.687, 1, 0.2),
(15, 2014035, 237, 375.368, 410.658, 340.078, -8.8224, 1, 398.06, 1, 0.2),
(16, 2014041, 97, 319.694, 392.465, 246.924, -18.1927, 1, 331.256, 1, 0.2),
(17, 2014042, 328, 321.355, 378.243, 264.467, -14.222, 1, 228.731, 1, 0.2),
(18, 2014043, 321, 321.284, 366.851, 275.717, -11.3918, 1, 250.245, 1, 0.2),
(19, 2014044, 558, 368.627, 367.206, 370.048, 0.35524, 1, 264.325, 1, 0.2),
(20, 2014045, 715, 437.902, 381.345, 494.458, 14.1391, 1, 370.403, 1, 0.2),
(21, 2014051, 341, 418.522, 388.78, 448.263, 7.43532, 1, 508.597, 1, 0.2),
(22, 2014052, 240, 382.818, 387.588, 378.048, -1.19248, 1, 455.698, 1, 0.2),
(23, 2014053, 278, 361.854, 382.441, 341.268, -5.14672, 1, 376.856, 1, 0.2),
(24, 2014054, 358, 361.083, 378.169, 343.997, -4.27156, 1, 336.121, 1, 0.2),
(25, 2014055, 73, 303.466, 363.228, 243.704, -14.9405, 1, 339.725, 1, 0.2),
(26, 2014061, 229, 288.573, 348.297, 228.849, -14.931, 1, 228.764, 1, 0.2),
(27, 2014062, 471, 325.058, 343.649, 306.468, -4.64772, 1, 213.918, 1, 0.2),
(28, 2014063, 590, 378.046, 350.528, 405.564, 6.87948, 1, 301.82, 1, 0.2),
(29, 2014064, 486, 399.637, 360.35, 438.924, 9.82176, 1, 412.443, 1, 0.2),
(30, 2014065, 190, 357.71, 359.822, 355.597, -0.52808, 1, 448.746, 1, 0.2),
(31, 2014071, 119, 309.968, 349.851, 270.085, -9.9708, 1, 355.069, 1, 0.2),
(32, 2014072, 221, 292.174, 338.316, 246.033, -11.5353, 1, 260.114, 1, 0.2),
(33, 2014073, 296, 292.939, 329.241, 256.638, -9.07536, 1, 234.498, 1, 0.2),
(34, 2014074, 398, 313.951, 326.183, 301.719, -3.05796, 1, 247.563, 1, 0.2),
(35, 2014075, 531, 357.361, 332.419, 382.303, 6.23556, 1, 298.661, 1, 0.2),
(36, 2014081, 587, 403.289, 346.593, 459.985, 14.174, 1, 388.539, 1, 0.2),
(37, 2014082, 559, 434.431, 364.161, 504.702, 17.5676, 1, 474.159, 1, 0.2),
(38, 2014083, 431, 433.745, 378.078, 489.412, 13.9168, 1, 522.27, 1, 0.2),
(39, 2014084, 428, 432.596, 388.982, 476.21, 10.9036, 1, 503.329, 1, 0.2),
(40, 2014085, 244, 394.877, 390.161, 399.593, 1.17896, 1, 487.114, 1, 0.2),
(41, 2014091, 220, 359.902, 384.109, 335.694, -6.05188, 1, 400.772, 1, 0.2),
(42, 2014092, 309, 349.722, 377.232, 322.212, -6.87748, 1, 329.642, 1, 0.2),
(43, 2014093, 424, 364.578, 374.701, 354.454, -2.53088, 1, 315.335, 1, 0.2),
(44, 2014094, 382, 368.062, 373.373, 362.752, -1.32772, 1, 351.923, 1, 0.2),
(45, 2014095, 254, 345.25, 367.748, 322.751, -5.62468, 1, 361.424, 1, 0.2),
(46, 2014101, 347, 345.6, 363.318, 327.882, -4.4296, 1, 317.126, 1, 0.2),
(47, 2014102, 911, 458.68, 382.39, 534.97, 19.0724, 1, 323.452, 1, 0.2),
(48, 2014103, 841, 535.144, 412.941, 657.347, 30.5508, 1, 554.042, 1, 0.2),
(49, 2014104, 458, 519.715, 434.296, 605.135, 21.3548, 1, 687.898, 1, 0.2),
(50, 2014105, 115, 438.772, 435.191, 442.353, 0.8952, 1, 626.49, 1, 0.2),
(51, 2014111, 686, 488.218, 445.796, 530.639, 10.6053, 1, 443.248, 1, 0.2),
(52, 2014112, 593, 509.174, 458.472, 559.877, 12.6757, 1, 541.244, 1, 0.2),
(53, 2014113, 766, 560.539, 478.885, 642.193, 20.4134, 1, 572.553, 1, 0.2),
(54, 2014114, 777, 603.831, 503.874, 703.788, 24.9892, 1, 662.606, 1, 0.2),
(55, 2014115, 292, 541.465, 511.392, 571.537, 7.51816, 1, 728.777, 1, 0.2),
(56, 2014121, 454, 523.972, 513.908, 534.036, 2.516, 1, 579.055, 1, 0.2),
(57, 2014122, 938, 606.778, 532.482, 681.073, 18.5739, 1, 536.552, 1, 0.2),
(58, 2014123, 1287, 742.822, 574.55, 911.095, 42.0681, 1, 699.647, 1, 0.2),
(59, 2014124, 737, 741.658, 607.971, 875.344, 33.4215, 1, 953.163, 1, 0.2),
(60, 2014125, 563, 705.926, 627.562, 784.291, 19.5911, 1, 908.766, 1, 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_transaction_double`
--

CREATE TABLE `forecasting_transaction_double` (
  `id_transaction` int(12) NOT NULL,
  `periode` int(6) DEFAULT NULL,
  `x_value` float DEFAULT NULL,
  `at_value` float DEFAULT NULL,
  `t_value` float DEFAULT NULL,
  `forecasting` float DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `alfa` float DEFAULT NULL,
  `beta` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecasting_transaction_double`
--

INSERT INTO `forecasting_transaction_double` (`id_transaction`, `periode`, `x_value`, `at_value`, `t_value`, `forecasting`, `status`, `alfa`, `beta`) VALUES
(1, 201401, 143, 143, 9, 0, 1, 0.2, 0.3),
(2, 201402, 152, 152, 9, 152, 1, 0.2, 0.3),
(3, 201403, 161, 161, 9, 161, 1, 0.2, 0.3),
(4, 201404, 134, 162.8, 6.84, 170, 1, 0.2, 0.3);

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_user`
--

CREATE TABLE `forecasting_user` (
  `id_user` int(12) NOT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `status_user` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecasting_user`
--

INSERT INTO `forecasting_user` (`id_user`, `user_name`, `password`, `status_user`) VALUES
(1, 'admin', 'admin', 1),
(3, 'enigma', 'enigma', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forecasting_hasil`
--
ALTER TABLE `forecasting_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `forecasting_hasil_detail`
--
ALTER TABLE `forecasting_hasil_detail`
  ADD PRIMARY KEY (`id_hasil_detail`),
  ADD KEY `id_hasil` (`id_hasil`);

--
-- Indexes for table `forecasting_hasil_error`
--
ALTER TABLE `forecasting_hasil_error`
  ADD PRIMARY KEY (`id_hasil_error`),
  ADD KEY `id_hasil` (`id_hasil`);

--
-- Indexes for table `forecasting_property`
--
ALTER TABLE `forecasting_property`
  ADD PRIMARY KEY (`id_property`);

--
-- Indexes for table `forecasting_transaction`
--
ALTER TABLE `forecasting_transaction`
  ADD PRIMARY KEY (`id_transaction`);

--
-- Indexes for table `forecasting_transaction_double`
--
ALTER TABLE `forecasting_transaction_double`
  ADD PRIMARY KEY (`id_transaction`);

--
-- Indexes for table `forecasting_user`
--
ALTER TABLE `forecasting_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forecasting_hasil`
--
ALTER TABLE `forecasting_hasil`
  MODIFY `id_hasil` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `forecasting_hasil_detail`
--
ALTER TABLE `forecasting_hasil_detail`
  MODIFY `id_hasil_detail` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=661;
--
-- AUTO_INCREMENT for table `forecasting_hasil_error`
--
ALTER TABLE `forecasting_hasil_error`
  MODIFY `id_hasil_error` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `forecasting_property`
--
ALTER TABLE `forecasting_property`
  MODIFY `id_property` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forecasting_transaction`
--
ALTER TABLE `forecasting_transaction`
  MODIFY `id_transaction` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `forecasting_transaction_double`
--
ALTER TABLE `forecasting_transaction_double`
  MODIFY `id_transaction` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `forecasting_user`
--
ALTER TABLE `forecasting_user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `forecasting_hasil_detail`
--
ALTER TABLE `forecasting_hasil_detail`
  ADD CONSTRAINT `forecasting_hasil_detail_ibfk_1` FOREIGN KEY (`id_hasil`) REFERENCES `forecasting_hasil` (`id_hasil`) ON DELETE CASCADE;

--
-- Constraints for table `forecasting_hasil_error`
--
ALTER TABLE `forecasting_hasil_error`
  ADD CONSTRAINT `forecasting_hasil_error_ibfk_1` FOREIGN KEY (`id_hasil`) REFERENCES `forecasting_hasil` (`id_hasil`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
