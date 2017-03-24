/*
Navicat MySQL Data Transfer

Source Server         : pictwin
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : liga

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2017-02-18 21:15:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
`codigoCategoria`  varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL ,
`nombreCategoria`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`codigoCategoria`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of categoria
-- ----------------------------
BEGIN;
INSERT INTO `categoria` VALUES ('1', 'Primera Division Adulta'), ('2', 'Segunda Division Adulta'), ('3', 'Senior');
COMMIT;

-- ----------------------------
-- Table structure for clubdeportivo
-- ----------------------------
DROP TABLE IF EXISTS `clubdeportivo`;
CREATE TABLE `clubdeportivo` (
`rutClubDeportivo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`nombreClubDeportivo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`fechaFundacion`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`personalidadJuridica`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`escudoClubDeportivo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`rutClubDeportivo`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of clubdeportivo
-- ----------------------------
BEGIN;
INSERT INTO `clubdeportivo` VALUES ('1', 'COBREMAR', '2017-02-16', 'b', ''), ('2', 'FLOR DE CHILE', '2017-02-16', 'flor', ''), ('3', 'CALI', '2017-02-16', 'c', null);
COMMIT;

-- ----------------------------
-- Table structure for dirigente
-- ----------------------------
DROP TABLE IF EXISTS `dirigente`;
CREATE TABLE `dirigente` (
`rutDirigente`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`contactoDirigente`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`correoDirigente`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`rutClubDeportivo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`rutDirigente`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of dirigente
-- ----------------------------
BEGIN;
INSERT INTO `dirigente` VALUES ('a', 'a', 'a', '2'), ('b', 'b', 'b', '1'), ('c', '', '', '1'), ('d', '', '', '1');
COMMIT;

-- ----------------------------
-- Table structure for equipo
-- ----------------------------
DROP TABLE IF EXISTS `equipo`;
CREATE TABLE `equipo` (
`codigoEquipo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`codigoCategoria`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`rutClubDeportivo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`codigoGrupo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`codigoEquipo`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of equipo
-- ----------------------------
BEGIN;
INSERT INTO `equipo` VALUES ('1', '1', '1', null), ('2', '2', '1', null), ('3', '2', '2', null), ('4', '3', '2', null), ('5', '1', '3', null);
COMMIT;

-- ----------------------------
-- Table structure for jugador
-- ----------------------------
DROP TABLE IF EXISTS `jugador`;
CREATE TABLE `jugador` (
`rutJugador`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`fechaNacimiento`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`fechaInscripcion`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`rolJugador`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`rolANDABA`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`sancion`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`codigoEquipo`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`rutJugador`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of jugador
-- ----------------------------
BEGIN;
INSERT INTO `jugador` VALUES ('b', '2017-02-16', '2017-02-02', 'b', 'b', null, '1');
COMMIT;

-- ----------------------------
-- Table structure for persona
-- ----------------------------
DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
`rutPersona`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`nombrePersona`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
PRIMARY KEY (`rutPersona`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of persona
-- ----------------------------
BEGIN;
INSERT INTO `persona` VALUES ('182355025', 'a'), ('18235502k', 'Andres'), ('a', 'a'), ('b', 'b'), ('c', 'c'), ('d', 'd');
COMMIT;
SET FOREIGN_KEY_CHECKS=1;
