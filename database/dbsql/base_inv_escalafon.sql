/*
 Navicat Premium Dump SQL

 Source Server         : LMysql
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : inv_escalafon

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 04/05/2025 12:45:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for caja
-- ----------------------------
DROP TABLE IF EXISTS `caja`;
CREATE TABLE `caja`  (
  `id_caja` int NOT NULL,
  `caja_num_let` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `caja_tipo_per` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `id_est` int NULL DEFAULT NULL,
  `id_inst` int NULL DEFAULT NULL,
  `caja_obs` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_caja`) USING BTREE,
  INDEX `fk_caja_est`(`id_est` ASC) USING BTREE,
  INDEX `fk_caja_inst`(`id_inst` ASC) USING BTREE,
  CONSTRAINT `fk_caja_est` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_caja_inst` FOREIGN KEY (`id_inst`) REFERENCES `institucion` (`id_inst`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of caja
-- ----------------------------

-- ----------------------------
-- Table structure for cargo
-- ----------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo`  (
  `id_car` int NOT NULL,
  `car_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_car`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cargo
-- ----------------------------
INSERT INTO `cargo` VALUES (1, 'DOCENTE');
INSERT INTO `cargo` VALUES (2, 'ADMINISTRATIVO');
INSERT INTO `cargo` VALUES (3, 'AUXILIAR');

-- ----------------------------
-- Table structure for docente
-- ----------------------------
DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente`  (
  `id_dcnt` int NOT NULL AUTO_INCREMENT,
  `dcnt_dni` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `dcnt_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `dcnt_apell1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `dcnt_apell2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `dcnt_fec_ces` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `dcnt_rdr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `dcnt_tip_ces` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `dcnt_cel` int NULL DEFAULT NULL,
  `dcnt_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `id_car` int NULL DEFAULT NULL,
  `id_est` int NULL DEFAULT NULL,
  `id_ley` int NULL DEFAULT NULL,
  `id_inst` int NULL DEFAULT NULL,
  `id_caja` int NULL DEFAULT NULL,
  `dcnt_obs` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dcnt`) USING BTREE,
  INDEX `fk_dcnt_car`(`id_car` ASC) USING BTREE,
  INDEX `fk_dcnt_est`(`id_est` ASC) USING BTREE,
  INDEX `fk_dcnt_ley`(`id_ley` ASC) USING BTREE,
  INDEX `fk_dcnt_inst`(`id_inst` ASC) USING BTREE,
  INDEX `fk_dcnt_caja`(`id_caja` ASC) USING BTREE,
  CONSTRAINT `fk_dcnt_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_dcnt_car` FOREIGN KEY (`id_car`) REFERENCES `cargo` (`id_car`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_dcnt_est` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_dcnt_inst` FOREIGN KEY (`id_inst`) REFERENCES `institucion` (`id_inst`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_dcnt_ley` FOREIGN KEY (`id_ley`) REFERENCES `ley` (`id_ley`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2396 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of docente
-- ----------------------------

-- ----------------------------
-- Table structure for estado
-- ----------------------------
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado`  (
  `id_est` int NOT NULL,
  `est_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_est`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of estado
-- ----------------------------
INSERT INTO `estado` VALUES (1, 'ACTIVO');
INSERT INTO `estado` VALUES (2, 'CESANTE');
INSERT INTO `estado` VALUES (3, 'PENSIONISTA');
INSERT INTO `estado` VALUES (4, 'NO LEGIX');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for institucion
-- ----------------------------
DROP TABLE IF EXISTS `institucion`;
CREATE TABLE `institucion`  (
  `id_inst` int NOT NULL,
  `inst_cod_mod` int NULL DEFAULT NULL,
  `inst_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `inst_lugar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `id_tipo` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_inst`) USING BTREE,
  INDEX `fk_inst_tipoinst`(`id_tipo` ASC) USING BTREE,
  CONSTRAINT `fk_inst_tipoinst` FOREIGN KEY (`id_tipo`) REFERENCES `tipoinst` (`id_tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of institucion
-- ----------------------------
INSERT INTO `institucion` VALUES (1, 1025279, 'ACORA', 'ACORA', 1);
INSERT INTO `institucion` VALUES (2, 1026319, 'ANDRES AVELINO CACERES', 'PUTINA', 1);
INSERT INTO `institucion` VALUES (3, 716779, 'AYAVIRI', 'AYAVIRI', 1);
INSERT INTO `institucion` VALUES (4, 1273911, 'AYAVIRI', 'AYAVIRI', 4);
INSERT INTO `institucion` VALUES (5, 630558, 'AZANGARO', 'AZANGARO', 4);
INSERT INTO `institucion` VALUES (6, 1390004, 'CHUPA', 'CHUPA', 1);
INSERT INTO `institucion` VALUES (7, 1025089, 'CABANILLAS', 'CABANILLAS', 1);
INSERT INTO `institucion` VALUES (8, 1029404, 'DESAGUADERO', 'DESAGUADERO', 1);
INSERT INTO `institucion` VALUES (10, 1025683, 'HUANCANE', 'HUANCANE', 4);
INSERT INTO `institucion` VALUES (11, 0, 'DREP', 'PUNO', 0);
INSERT INTO `institucion` VALUES (12, 481218, 'JOSE ANTONIO ENCINAS', 'PUNO', 1);
INSERT INTO `institucion` VALUES (13, 1028554, 'NUÑOA', 'NUÑOA', 1);
INSERT INTO `institucion` VALUES (14, 630616, 'EDUCACION FISICA LAMPA', 'LAMPA', 3);
INSERT INTO `institucion` VALUES (15, 1027754, 'JULI', 'JULI', 4);
INSERT INTO `institucion` VALUES (16, 474320, 'PUNO', 'PUNO', 4);
INSERT INTO `institucion` VALUES (17, 239970, 'JULIACA', 'JULIACA', 7);
INSERT INTO `institucion` VALUES (18, 702837, 'JULIACA', 'JULIACA', 6);
INSERT INTO `institucion` VALUES (19, 240135, 'PUNO', 'PUNO', 6);
INSERT INTO `institucion` VALUES (20, 481226, 'MANUEL NUÑEZ BUTRON', 'JULIACA', 1);
INSERT INTO `institucion` VALUES (21, 1027085, 'ILAVE', 'ILAVE', 1);
INSERT INTO `institucion` VALUES (22, 1025691, 'HUANCANE', 'HUANCANE', 1);
INSERT INTO `institucion` VALUES (23, 1025824, 'MUÑANI', 'MUÑANI', 1);
INSERT INTO `institucion` VALUES (24, 1029297, 'YUNGUYO', 'YUNGUYO', 1);
INSERT INTO `institucion` VALUES (25, 1580034, 'SANTA ROSA', 'SANTA ROSA', 1);
INSERT INTO `institucion` VALUES (26, 1028919, 'SAN JUAN DEL ORO', 'SAN JUAN DEL ORO', 1);
INSERT INTO `institucion` VALUES (27, 630467, 'JULI', 'JULI', 1);
INSERT INTO `institucion` VALUES (28, 1276492, 'MAÑAZO', 'MAÑAZO', 1);
INSERT INTO `institucion` VALUES (29, 1024785, 'MACUSANI', 'MACUSANI', 1);
INSERT INTO `institucion` VALUES (30, NULL, 'CAPACHICA', 'CAPACHICA', 1);
INSERT INTO `institucion` VALUES (31, 1351956, 'SANTA LUCIA', 'SANTA LUCIA', 1);
INSERT INTO `institucion` VALUES (32, 1029404, 'DESAGUADERO', 'DESAGUADERO', 1);
INSERT INTO `institucion` VALUES (33, 1023514, 'PEDRO VILCAPAZA', 'AZANGARO', 1);
INSERT INTO `institucion` VALUES (34, 1025584, 'PILCUYO', 'PILCUYO', 6);
INSERT INTO `institucion` VALUES (35, 1027564, 'MOHO', 'MOHO', 6);
INSERT INTO `institucion` VALUES (36, NULL, 'OTROS', 'OTROS', 8);

-- ----------------------------
-- Table structure for ley
-- ----------------------------
DROP TABLE IF EXISTS `ley`;
CREATE TABLE `ley`  (
  `id_ley` int NOT NULL,
  `ley_num` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  `ley_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_ley`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ley
-- ----------------------------
INSERT INTO `ley` VALUES (1, '	LEY 24029', 'LEY DEL PROFESORADO');
INSERT INTO `ley` VALUES (2, 'LEY 30512', 'EDUCACIÓN SUPERIOR NO UNIVERSITARIA NOMBRADOS');
INSERT INTO `ley` VALUES (3, 'DECRETO LEGISLATIVO 276', 'CARRERA ADMINISTRATIVA');
INSERT INTO `ley` VALUES (4, 'LEY 29944', 'REFORMA MAGISTERIAL');
INSERT INTO `ley` VALUES (5, 'DECRETO LEGISLATIVO 1057', 'CAS');
INSERT INTO `ley` VALUES (6, 'LEY 30057', 'LEY SERVIR');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('soyveronicalaurajuarez@gmail.com', '$2y$10$krGMvr7KflGkyQ0WlA1raeawqRglsD.ECbFx9X5gj6NzrAilLy0oy', '2023-02-28 15:50:20');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for tipoinst
-- ----------------------------
DROP TABLE IF EXISTS `tipoinst`;
CREATE TABLE `tipoinst`  (
  `id_tipo` int NOT NULL,
  `tipo_inst` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipoinst
-- ----------------------------
INSERT INTO `tipoinst` VALUES (0, 'SEDE');
INSERT INTO `tipoinst` VALUES (1, 'IESTP');
INSERT INTO `tipoinst` VALUES (2, 'ISEP');
INSERT INTO `tipoinst` VALUES (3, 'ISEPF');
INSERT INTO `tipoinst` VALUES (4, 'IESPP');
INSERT INTO `tipoinst` VALUES (6, 'ESFAP');
INSERT INTO `tipoinst` VALUES (7, 'EESPP');
INSERT INTO `tipoinst` VALUES (8, 'EBR');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Arhyel Ramos', 'arhyel.860@gmail.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mEdFKH9rbzbIVqlxG9Fa0kAkvvgdc5y46tw10E1RoOKmzX316W5ZVdw0o9Mw', '2023-01-19 15:54:57', '2023-01-19 15:54:57');
INSERT INTO `users` VALUES (2, 'Philippe Flores', 'arhyel.8601@gmail.com', NULL, '$2y$10$jfPP1wJUfWeKfbRYS0MtwOtr9GC/SbvSoAjO1zYtRJ7FQOnNswFTu', NULL, '2023-01-20 15:31:04', '2023-01-20 15:31:04');
INSERT INTO `users` VALUES (3, 'ALAN FERNANDEZ', 'escalafon@gmail.com', NULL, '$2y$10$F4ybiixjGsGaIfjBSgNWg.jpr1MHaZNQ/6bO.3uQH7qACs9svv.IS', NULL, '2023-02-17 16:33:35', '2023-02-17 16:33:35');
INSERT INTO `users` VALUES (4, 'VERONICA LAURA JUAREZ', 'soyveronicalaurajuarez@gmail.com', NULL, '$2y$10$Oqwj6CcGjhy3pMSvk0HK8OuNh07xxW4ag/eur/KR5IMBIhwSc7QYK', NULL, '2023-02-17 16:47:52', '2023-02-17 16:47:52');
INSERT INTO `users` VALUES (5, 'ELBA ROMERO', 'elba@gmail.com', NULL, '$2y$10$zCV3jxS/.of0fsZXMoPZp.m/lgotbGmomzT5E.YNIpD3v1sCj.I/.', NULL, '2023-02-17 17:59:30', '2023-02-17 17:59:30');
INSERT INTO `users` VALUES (6, 'Hector Arturo Mullisaca Jaen', 'mullisaca.jaen@gmail.com', NULL, '$2y$10$8qSYbmrQZBiJuuthTt/saOakCWTFLLmFW8co9KjsTpw6WGJbYH2sW', NULL, '2023-03-13 15:01:13', '2023-03-13 15:01:13');

SET FOREIGN_KEY_CHECKS = 1;
