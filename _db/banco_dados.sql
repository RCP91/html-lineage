/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-10 20:58:00
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `login` varchar(45) NOT NULL DEFAULT '',
  `pergunta` varchar(255) NOT NULL,
  `resposta` varchar(255) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `lastactive` decimal(20,0) DEFAULT NULL,
  `access_level` int(11) DEFAULT NULL,
  `lastIP` varchar(20) DEFAULT NULL,
  `lastServer` int(4) DEFAULT '1',
  `nome` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------

-- ----------------------------
-- Table structure for `web_comprovantes`
-- ----------------------------
DROP TABLE IF EXISTS `web_comprovantes`;
CREATE TABLE `web_comprovantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `forma_pag` varchar(255) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `itens` varchar(255) DEFAULT NULL,
  `comprovante` varchar(255) DEFAULT NULL,
  `char_name` varchar(255) DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_comprovantes
-- ----------------------------

-- ----------------------------
-- Table structure for `web_configs`
-- ----------------------------
DROP TABLE IF EXISTS `web_configs`;
CREATE TABLE `web_configs` (
  `visitas` varchar(255) DEFAULT NULL,
  `manutencao` varchar(255) DEFAULT NULL,
  `manu_data` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `prevision` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_configs
-- ----------------------------

-- ----------------------------
-- Table structure for `web_doacoes`
-- ----------------------------
DROP TABLE IF EXISTS `web_doacoes`;
CREATE TABLE `web_doacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `preco_antigo` varchar(100) NOT NULL,
  `preco_atual` varchar(100) NOT NULL,
  `promocao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_doacoes
-- ----------------------------

-- ----------------------------
-- Table structure for `web_galeria`
-- ----------------------------
DROP TABLE IF EXISTS `web_galeria`;
CREATE TABLE `web_galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `url` varchar(800) DEFAULT NULL,
  `tamanho` varchar(255) DEFAULT NULL,
  `destaque` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_galeria
-- ----------------------------

-- ----------------------------
-- Table structure for `web_noticias`
-- ----------------------------
DROP TABLE IF EXISTS `web_noticias`;
CREATE TABLE `web_noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `autor` varchar(255) DEFAULT NULL,
  `noticia` text,
  `visitas` varchar(255) DEFAULT '1',
  `slug` text,
  `destaque` int(11) DEFAULT NULL,
  `privado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_noticias
-- ----------------------------

-- ----------------------------
-- Table structure for `web_report`
-- ----------------------------
DROP TABLE IF EXISTS `web_report`;
CREATE TABLE `web_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `reported_login` varchar(100) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_report
-- ----------------------------
