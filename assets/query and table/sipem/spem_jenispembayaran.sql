/*
 Navicat Premium Data Transfer

 Source Server         : localDb
 Source Server Type    : MySQL
 Source Server Version : 100128
 Source Host           : localhost:3306
 Source Schema         : siak

 Target Server Type    : MySQL
 Target Server Version : 100128
 File Encoding         : 65001

 Date: 04/03/2020 15:07:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for spem_jenispembayaran
-- ----------------------------
DROP TABLE IF EXISTS `spem_jenispembayaran`;
CREATE TABLE `spem_jenispembayaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Kodejnsbayar` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namajenisbayar` char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_jurnal` int(11) NULL DEFAULT NULL,
  `isdeleted` int(11) NOT NULL,
  `createdAt` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updatedAt` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of spem_jenispembayaran
-- ----------------------------
INSERT INTO `spem_jenispembayaran` VALUES (1, 'BKP', 'Buku Paket', 8, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (2, 'FRM', 'Pengambilan Formulir', 9, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (3, 'GDG', 'Gedung', 5, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (4, 'KAT', 'Kegiatan Akhir Tahun', 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (5, 'KGT', 'Kegiatan', 6, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (6, 'MDL', 'Modul', 7, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (7, 'MTS', 'Mutasi', NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (8, 'PMB', 'Pembangunan', 5, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (9, 'SPP', 'SPP', 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (10, 'SRG', 'Seragam', 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `spem_jenispembayaran` VALUES (12, 'TST', 'TEST', 1, 0, '2020-03-04 14:22:56', '2020-03-04 08:22:56');
INSERT INTO `spem_jenispembayaran` VALUES (13, 'TER', 'ABCD', 147, 0, '2020-03-04 08:39:03', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for spem_tarif_berlaku
-- ----------------------------
DROP TABLE IF EXISTS `spem_tarif_berlaku`;
CREATE TABLE `spem_tarif_berlaku`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodesekolah` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Kodejnsbayar` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun` int(11) NOT NULL,
  `Nominal` decimal(18, 0) NOT NULL,
  `createdAt` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updatedAt` timestamp(0) NOT NULL,
  `isdeleted` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 93 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of spem_tarif_berlaku
-- ----------------------------
INSERT INTO `spem_tarif_berlaku` VALUES (6, '06', 'SRG', 1, 950000, '2020-03-04 11:53:14', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (7, '06', 'SPP', 1, 3600000, '2020-03-04 11:53:27', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (8, '06', 'KGT', 1, 1000000, '2020-03-04 11:53:29', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (9, '06', 'GDG', 1, 2500000, '2020-03-04 11:53:33', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (10, '06', 'FRM', 1, 65000, '2020-03-04 14:21:07', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (11, '05', 'SRG', 1, 950000, '2020-03-04 11:53:43', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (12, '05', 'SPP', 1, 3600000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (13, '05', 'KGT', 1, 1000000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (14, '05', 'GDG', 1, 2500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (15, '05', 'FRM', 1, 65000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (16, '04', 'SRG', 1, 950000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (17, '04', 'SPP', 1, 3600000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (18, '04', 'KGT', 1, 1000000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (19, '04', 'GDG', 1, 2500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (20, '04', 'FRM', 1, 65000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (22, '03', 'SRG', 1, 900000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (23, '03', 'SPP', 1, 3600000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (24, '03', 'KGT', 1, 800000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (25, '03', 'GDG', 1, 2500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (26, '03', 'FRM', 1, 65000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (27, '02', 'SRG', 1, 900000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (28, '02', 'SPP', 1, 3600000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (29, '02', 'KGT', 1, 800000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (30, '02', 'GDG', 1, 2500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (31, '02', 'FRM', 1, 65000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (32, '01', 'SRG', 1, 800000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (33, '01', 'SPP', 1, 2400000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (34, '01', 'KGT', 1, 600000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (35, '01', 'GDG', 1, 2500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (36, '01', 'FRM', 1, 65000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (37, '01', 'SPP', 1, 1800000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (38, '01', 'KGT', 1, 400000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (39, '01', 'GDG', 1, 1500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (40, '01', 'FRM', 1, 50000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (41, '02', 'SRG', 1, 700000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (42, '02', 'SPP', 1, 3000000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (43, '02', 'KGT', 1, 600000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (44, '02', 'GDG', 1, 1500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (45, '02', 'FRM', 1, 50000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (46, '03', 'SRG', 1, 700000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (47, '03', 'SPP', 1, 3000000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (48, '03', 'KGT', 1, 600000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (49, '03', 'GDG', 1, 1500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (50, '03', 'FRM', 1, 50000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (51, '04', 'SRG', 1, 900000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (52, '04', 'SPP', 1, 3000000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (53, '04', 'KGT', 1, 700000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (54, '04', 'GDG', 1, 1500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (55, '04', 'FRM', 1, 50000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (56, '05', 'SRG', 1, 900000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (57, '05', 'SPP', 1, 3000000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (58, '05', 'KGT', 1, 700000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (59, '05', 'GDG', 1, 1500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (60, '05', 'FRM', 1, 50000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (61, '06', 'SRG', 1, 900000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (62, '06', 'SPP', 1, 3000000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (63, '06', 'KGT', 1, 700000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (64, '06', 'GDG', 1, 1500000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (65, '06', 'FRM', 1, 50000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (71, '01', 'MDL', 1, 100000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (72, '02', 'MDL', 1, 120000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (73, '03', 'MDL', 1, 130000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (74, '04', 'MDL', 1, 140000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (75, '05', 'MDL', 1, 150000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (76, '06', 'MDL', 1, 110000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (77, '01', 'MDL', 1, 100000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (78, '01', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (79, '02', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (80, '03', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (81, '04', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (82, '05', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (83, '06', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (84, '01', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (85, '02', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (86, '03', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (87, '04', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (88, '05', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (89, '06', 'BKP', 1, 0, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (90, '01', 'SRG', 1, 700000, '2020-03-04 11:55:06', '0000-00-00 00:00:00', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (91, '1', 'TST', 1, 200000, '2020-03-04 14:36:42', '2020-03-04 08:34:55', 0);
INSERT INTO `spem_tarif_berlaku` VALUES (92, '8', 'TST', 3, 10000, '2020-03-04 08:37:15', '0000-00-00 00:00:00', 0);

SET FOREIGN_KEY_CHECKS = 1;
