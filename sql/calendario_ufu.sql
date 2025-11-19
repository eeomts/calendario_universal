/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : calendario_ufu1

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2025-11-18 22:21:47
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
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_datas
-- ----------------------------
DROP TABLE IF EXISTS `custom_datas`;
CREATE TABLE `custom_datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `fk_custom_dia_semana` tinyint(4) NOT NULL,
  `fk_custom_mes` int(11) NOT NULL,
  `dia_mes` tinyint(4) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_data_dia_semana` (`fk_custom_dia_semana`),
  KEY `fk_data_mes` (`fk_custom_mes`),
  CONSTRAINT `fk_data_dia_semana` FOREIGN KEY (`fk_custom_dia_semana`) REFERENCES `custom_dias_semana` (`id`),
  CONSTRAINT `fk_data_mes` FOREIGN KEY (`fk_custom_mes`) REFERENCES `custom_meses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73416 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_dias_semana
-- ----------------------------
DROP TABLE IF EXISTS `custom_dias_semana`;
CREATE TABLE `custom_dias_semana` (
  `id` tinyint(4) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
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
  `fk_custom_status` tinyint(4) DEFAULT NULL,
  `fk_custom_categoria` tinyint(4) DEFAULT NULL,
  `fk_custom_materia` int(11) DEFAULT NULL,
  `fk_custom_data` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_evento_status` (`fk_custom_status`),
  KEY `fk_evento_categoria` (`fk_custom_categoria`),
  KEY `fk_evento_materia` (`fk_custom_materia`),
  KEY `fk_evento_data` (`fk_custom_data`),
  CONSTRAINT `fk_evento_categoria` FOREIGN KEY (`fk_custom_categoria`) REFERENCES `custom_categorias` (`id`),
  CONSTRAINT `fk_evento_data` FOREIGN KEY (`fk_custom_data`) REFERENCES `custom_datas` (`id`),
  CONSTRAINT `fk_evento_materia` FOREIGN KEY (`fk_custom_materia`) REFERENCES `custom_materia` (`id`),
  CONSTRAINT `fk_evento_status` FOREIGN KEY (`fk_custom_status`) REFERENCES `custom_status_evento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_materia
-- ----------------------------
DROP TABLE IF EXISTS `custom_materia`;
CREATE TABLE `custom_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `fk_custom_setor` varchar(255) DEFAULT NULL,
  `fk_custom_professor` varchar(255) DEFAULT NULL,
  `fk_custom_token` varchar(10) DEFAULT '',
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_meses
-- ----------------------------
DROP TABLE IF EXISTS `custom_meses`;
CREATE TABLE `custom_meses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_status_evento
-- ----------------------------
DROP TABLE IF EXISTS `custom_status_evento`;
CREATE TABLE `custom_status_evento` (
  `id` tinyint(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for custom_tipo_usuario
-- ----------------------------
DROP TABLE IF EXISTS `custom_tipo_usuario`;
CREATE TABLE `custom_tipo_usuario` (
  `id` tinyint(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
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
  `fk_tipo` tinyint(4) DEFAULT NULL,
  `tel_telefone` varchar(255) DEFAULT NULL,
  `data_aceite_termo` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_user_tipo` (`fk_tipo`),
  CONSTRAINT `fk_user_tipo` FOREIGN KEY (`fk_tipo`) REFERENCES `custom_tipo_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for remember_tokens
-- ----------------------------
DROP TABLE IF EXISTS `remember_tokens`;
CREATE TABLE `remember_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token_hash` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token_hash` (`token_hash`),
  KEY `fk_remember_user` (`user_id`),
  CONSTRAINT `fk_remember_user` FOREIGN KEY (`user_id`) REFERENCES `custom_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
