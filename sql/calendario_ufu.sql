/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : calendario_ufu

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2025-11-16 23:12:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for custom_categorias
-- ----------------------------
DROP TABLE IF EXISTS `custom_categorias`;
CREATE TABLE `custom_categorias` (
  `id` tinyint(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cor` varchar(7) DEFAULT '#3788D8',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_dias_semana
-- ----------------------------
DROP TABLE IF EXISTS `custom_dias_semana`;
CREATE TABLE `custom_dias_semana` (
  `id` tinyint(4) NOT NULL,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_eventos
-- ----------------------------
DROP TABLE IF EXISTS `custom_eventos`;
CREATE TABLE `custom_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `descr` longtext DEFAULT NULL,
  `fk_status` int(11) DEFAULT NULL,
  `fk_categoria` int(11) DEFAULT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  `fk_dia_semana` int(11) DEFAULT NULL,
  `fk_dia_mes` int(11) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_meses
-- ----------------------------
DROP TABLE IF EXISTS `custom_meses`;
CREATE TABLE `custom_meses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_status_evento
-- ----------------------------
DROP TABLE IF EXISTS `custom_status_evento`;
CREATE TABLE `custom_status_evento` (
  `id` tinyint(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_tipo_usuario
-- ----------------------------
DROP TABLE IF EXISTS `custom_tipo_usuario`;
CREATE TABLE `custom_tipo_usuario` (
  `id` tinyint(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_users
-- ----------------------------
DROP TABLE IF EXISTS `custom_users`;
CREATE TABLE `custom_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sobrenome` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass_senha` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `fk_tipo` int(11) DEFAULT NULL,
  `tel_telefone` varchar(255) DEFAULT NULL,
  `data_aceite_termo` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
