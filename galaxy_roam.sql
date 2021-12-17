/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : gr_bk

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 17/12/2021 17:31:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT 0,
  `order` int(10) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT 1,
  `icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT 0,
  `level` int(1) NOT NULL DEFAULT 1,
  `order` int(10) NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 0, 1, 0, '数据管理', 'iconfont-shuju', NULL, NULL, '2021-11-09 17:24:19', '2021-11-09 17:24:19');
INSERT INTO `menus` VALUES (2, 1, 2, 1, '分类列表', 'iconfont-fenlei', 'category', NULL, '2021-11-09 17:25:11', '2021-11-09 17:25:11');
INSERT INTO `menus` VALUES (3, 1, 2, 2, '标签列表', 'iconfont-biaoqian', 'tag', NULL, '2021-11-09 17:25:49', '2021-11-09 17:25:49');
INSERT INTO `menus` VALUES (4, 1, 2, 3, '团队列表', 'iconfont-tuandui', 'team', NULL, '2021-11-09 17:26:22', '2021-11-09 17:26:22');
INSERT INTO `menus` VALUES (5, 1, 2, 4, '站点列表', 'iconfont-zhandianditu', 'site', NULL, '2021-11-09 17:26:50', '2021-11-09 17:26:50');
INSERT INTO `menus` VALUES (6, 0, 1, 0, '后台管理', 'iconfont-houtaiguanli', NULL, NULL, '2021-11-09 17:27:29', '2021-11-09 17:27:29');
INSERT INTO `menus` VALUES (7, 6, 2, 0, '菜单列表', 'iconfont-caidan', 'menu', NULL, '2021-11-09 17:27:45', '2021-11-09 17:27:45');
INSERT INTO `menus` VALUES (8, 6, 2, 0, '权限列表', 'iconfont-shenqingquanxian', 'permission', NULL, '2021-11-09 17:27:48', '2021-11-09 17:27:48');
INSERT INTO `menus` VALUES (9, 6, 2, 0, '角色列表', 'iconfont-jiaose', 'role', NULL, '2021-11-09 17:27:56', '2021-11-09 17:27:56');
INSERT INTO `menus` VALUES (10, 6, 2, 0, '用户列表', 'iconfont-yonghu-yuan', 'user', NULL, '2021-11-09 17:28:02', '2021-11-09 17:28:02');

-- ----------------------------
-- Table structure for operation_log
-- ----------------------------
DROP TABLE IF EXISTS `operation_log`;
CREATE TABLE `operation_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `method` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `input` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for role_menus
-- ----------------------------
DROP TABLE IF EXISTS `role_menus`;
CREATE TABLE `role_menus`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id_menu_id`(`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `permission_id` int(10) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id_permission_id`(`role_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id_role_id`(`user_id`, `role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sites
-- ----------------------------
DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `tags_id` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `desc` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `thumb` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order` int(10) NOT NULL DEFAULT 0,
  `tag` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `tags_id` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `desc` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `homepage` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `class_start_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE `user_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `permission_id` int(10) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id_permission_id`(`user_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `state` tinyint(2) NOT NULL DEFAULT 1,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT '',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$10$xqtlhw43wZFykNZdzdoO6.a6AgPAFU1XMgPR1K0Yu747AopMf0p5m', 1, '1577972852@qq.com', 'https://tvax3.sinaimg.cn/crop.0.0.1080.1080.180/003vrsRJly8gtrpee7mkuj60u00u0weu02.jpg?KID=imgbed,tva&Expires=1636546828&ssig=CnjmaBQJlF', '', '2021-11-08 15:41:50', '2021-11-10 17:59:03');
INSERT INTO `users` VALUES (4, 'test007', '$2y$10$5ExjqSr6vQX4/ZrFJOBrZOpIzxtqxjXLaImTu.8pAAUl.CLkvON9m', 1, '007@test.com', 'https://tvax4.sinaimg.cn/crop.0.0.800.800.180/66ff28fcly8gq5e0mdl7xj20m80m8djw.jpg?KID=imgbed,tva&Expires=1636540145&ssig=Q4JDDb%2FAxM', '', '2021-11-10 15:29:38', '2021-11-10 15:29:38');
INSERT INTO `users` VALUES (5, 'test006', '$2y$10$5ExjqSr6vQX4/ZrFJOBrZOpIzxtqxjXLaImTu.8pAAUl.CLkvON9m', 1, '006@qq.com', 'https://tvax4.sinaimg.cn/crop.0.0.578.578.180/002at72Bly8gtacgcilvbj60g20gsacb02.jpg?KID=imgbed,tva&Expires=1636540350&ssig=hwR3kW97WA', '', '2021-11-10 15:32:48', '2021-11-10 15:32:48');
INSERT INTO `users` VALUES (8, 'test009', '$2y$10$oJ3Ays89qUjRWv7GuMY/F.krRIRvYbsNQobPWV9LLIv0Y8EGBNDFS', 0, '009@test.com', 'https://tvax1.sinaimg.cn/crop.0.0.844.844.180/77b46083ly8go6ltxoa06j20ng0ngq54.jpg?KID=imgbed,tva&Expires=1636548604&ssig=wD1EJ4RAtV', '', '2021-11-10 17:50:13', '2021-11-10 17:50:22');

SET FOREIGN_KEY_CHECKS = 1;
