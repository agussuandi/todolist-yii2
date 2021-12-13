/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100419
 Source Host           : localhost:3306
 Source Schema         : testing

 Target Server Type    : MySQL
 Target Server Version : 100419
 File Encoding         : 65001

 Date: 13/12/2021 19:39:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for todolist
-- ----------------------------
DROP TABLE IF EXISTS `todolist`;
CREATE TABLE `todolist`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kegiatan_date` date NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of todolist
-- ----------------------------
INSERT INTO `todolist` VALUES (3, 'Bermain Dota 2', '2021-12-16', '2021-12-13 13:27:31', '2021-12-13 13:38:41');
INSERT INTO `todolist` VALUES (4, 'Bermain Futsal Dengan Anak TI', '2021-12-30', '2021-12-13 13:38:55', NULL);

SET FOREIGN_KEY_CHECKS = 1;
