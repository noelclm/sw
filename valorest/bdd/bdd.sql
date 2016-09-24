
/*
	Practica ValoRest: Pagina par la asignatura SW
    Copyright (C) 2016  
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

# -------------------------------------------
# Estructura de `sesion`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `session` (
    `idsession`         INT(11) NOT NULL AUTO_INCREMENT,
    `iduser`            INT(11) NOT NULL,
    `key`               VARCHAR(32) NOT NULL,
    `activesince`       INT(11) NOT NULL,
    `lastactivity`      INT(11) NOT NULL,
    `ip`                VARCHAR(15) NOT NULL,
    PRIMARY KEY  (`idsession`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 1;

# -------------------------------------------
# Estructura de `province`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `province` (
  `idprovince`          INT(11) NOT NULL AUTO_INCREMENT,
  `name`                VARCHAR(75) NOT NULL DEFAULT '',
  PRIMARY KEY (`idprovince`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 63;

INSERT INTO `province` VALUES(1, 'Alava');
INSERT INTO `province` VALUES(2, 'Albacete');
INSERT INTO `province` VALUES(3, 'Alicante');
INSERT INTO `province` VALUES(4, 'Almería');
INSERT INTO `province` VALUES(5, 'Asturias');
INSERT INTO `province` VALUES(6, 'Avila');
INSERT INTO `province` VALUES(7, 'Badajoz');
INSERT INTO `province` VALUES(8, 'Baleares');
INSERT INTO `province` VALUES(9, 'Barcelona');
INSERT INTO `province` VALUES(10, 'Burgos');
INSERT INTO `province` VALUES(11, 'Cáceres');
INSERT INTO `province` VALUES(12, 'Cadiz');
INSERT INTO `province` VALUES(13, 'Cantabria');
INSERT INTO `province` VALUES(14, 'Castellón');
INSERT INTO `province` VALUES(15, 'Ceuta');
INSERT INTO `province` VALUES(16, 'Ciudad Real');
INSERT INTO `province` VALUES(17, 'Córdoba');
INSERT INTO `province` VALUES(18, 'La Coruña');
INSERT INTO `province` VALUES(19, 'Cuenca');
INSERT INTO `province` VALUES(20, 'Gerona');
INSERT INTO `province` VALUES(21, 'Granada');
INSERT INTO `province` VALUES(22, 'Guadalajara');
INSERT INTO `province` VALUES(23, 'Guipúzcoa');
INSERT INTO `province` VALUES(24, 'Huelva');
INSERT INTO `province` VALUES(25, 'Huesca');
INSERT INTO `province` VALUES(26, 'Jaén');
INSERT INTO `province` VALUES(27, 'León');
INSERT INTO `province` VALUES(28, 'Lérida');
INSERT INTO `province` VALUES(29, 'Lugo');
INSERT INTO `province` VALUES(30, 'Madrid');
INSERT INTO `province` VALUES(31, 'Málaga');
INSERT INTO `province` VALUES(32, 'Melilla');
INSERT INTO `province` VALUES(33, 'Murcia');
INSERT INTO `province` VALUES(34, 'Navarra');
INSERT INTO `province` VALUES(35, 'Orense');
INSERT INTO `province` VALUES(36, 'Palencia');
INSERT INTO `province` VALUES(37, 'Las Palmas');
INSERT INTO `province` VALUES(38, 'Pontevedra');
INSERT INTO `province` VALUES(39, 'La Rioja');
INSERT INTO `province` VALUES(40, 'Salamanca');
INSERT INTO `province` VALUES(41, 'Sta. Cruz de Tenerife');
INSERT INTO `province` VALUES(42, 'Segovia');
INSERT INTO `province` VALUES(43, 'Sevilla');
INSERT INTO `province` VALUES(44, 'Soria');
INSERT INTO `province` VALUES(45, 'Tarragona');
INSERT INTO `province` VALUES(46, 'Teruel');
INSERT INTO `province` VALUES(47, 'Toledo');
INSERT INTO `province` VALUES(48, 'Valencia');
INSERT INTO `province` VALUES(49, 'Valladolid');
INSERT INTO `province` VALUES(50, 'Vizcaya');
INSERT INTO `province` VALUES(51, 'Zamora');
INSERT INTO `province` VALUES(52, 'Zaragoza');

# -------------------------------------------
# Estructura de `pais`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `country` (
    `idcountry`         INT(11) NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(100) NOT NULL,
    PRIMARY KEY  (`idcountry`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 217;

INSERT INTO `country` VALUES (1,'España');

# -------------------------------------------
# Estructura de `restaurante`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `restaurant` (
    `idrestaurant`      INT(11) NOT NULL AUTO_INCREMENT,
    `idcountry`         INT(11) NOT NULL,
    `idprovince`        INT(11) NOT NULL,
    `image`             VARCHAR(255) NOT NULL,
    `name`              VARCHAR(255) NOT NULL,
    `address1`          VARCHAR(255) NOT NULL,
    `address2`          VARCHAR(255) NOT NULL,
    `phone`             VARCHAR(75) NOT NULL,
    `web`               VARCHAR(255) NOT NULL,
    `email`             VARCHAR(255) NOT NULL,
    `halfprice`         DECIMAL(14,3) NOT NULL,
    `score`             DECIMAL(14,3) NOT NULL,
    `description`       TEXT NOT NULL,
    `frontpage`         CHAR(1) NOT NULL,
    `sequence`          INT(11) NOT NULL,
    PRIMARY KEY  (`idrestaurant`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 217;

# -------------------------------------------
# Estructura de `usuario`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `user` (
    `iduser`            INT(11) NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(75) NOT NULL,
    `user`              VARCHAR(75) NOT NULL,
    `psw`               VARCHAR(255) NOT NULL,
    `email`             VARCHAR(255) NOT NULL,
    `rol`               INT(11) NOT NULL,
    PRIMARY KEY  (`iduser`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 1;

INSERT INTO `user` VALUES(1, 'Administrador', 'admin', '$2y$10$AFJe0aHPSdx.mkechsGyee7nWtjeFjx0V9zSW.uvpdY7Q/pKV2nda', '', 2);
#La contraseña es '0valorest1'

# -------------------------------------------
# Estructura de `comentario`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `comment` (
    `idcomment`         INT(11) NOT NULL AUTO_INCREMENT,
    `idrestaurant`      INT(11) NOT NULL,
    `iduser`            INT(11) NOT NULL,
    `score`             DECIMAL(14,3) NOT NULL,
    `date`              DATE NOT NULL,
    `comment`           TEXT NOT NULL,
    PRIMARY KEY  (`idcomment`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 1;

# -------------------------------------------
# Estructura de `menu`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `menu` (
    `idmenu`            INT(11) NOT NULL AUTO_INCREMENT,
    `permissions`       INT(11) NOT NULL,
    `type`              INT(11) NOT NULL,
    `sequence`          INT(11) NOT NULL,
    `page`              VARCHAR(255) NOT NULL,
    `name`              VARCHAR(255) NOT NULL,
    `parameter`         VARCHAR(255) NOT NULL,
    PRIMARY KEY  (`idmenu`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 1;

INSERT INTO `menu` VALUES(01, 0, 1, 001, 'resnacional', 'Nacional', '');
INSERT INTO `menu` VALUES(02, 0, 1, 002, 'internacional', 'Internacional', '');

INSERT INTO `menu` VALUES(03, 0, 1, 003, 'tapeo', 'Tapeo', '');
INSERT INTO `menu` VALUES(04, 0, 1, 004, 'comer', 'Comer', '');
INSERT INTO `menu` VALUES(05, 0, 1, 005, 'copas', 'Copas', '');

INSERT INTO `menu` VALUES(06, 1, 2, 001, 'restaurantes', 'Restaurantes', '');

INSERT INTO `menu` VALUES(07, 2, 2, 002, 'portada', 'Portada', '');
INSERT INTO `menu` VALUES(08, 2, 2, 003, 'editores', 'Editores', '');

# -------------------------------------------
# Estructura de `tags`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `tag` (
    `idtag`             INT(11) NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(255) NOT NULL,
    PRIMARY KEY  (`idtag`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 1;

INSERT INTO `tag` VALUES(1, 'Nacional');
INSERT INTO `tag` VALUES(2, 'Internacional');
INSERT INTO `tag` VALUES(3, 'Tapeo');
INSERT INTO `tag` VALUES(4, 'Comer');
INSERT INTO `tag` VALUES(5, 'Copas');

# -------------------------------------------
# Estructura de `tagsrestaurante`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `tagrestaurant` (
    `idtagrestaurant`   INT(11) NOT NULL AUTO_INCREMENT,
    `idtag`             INT(11) NOT NULL,
    `idrestaurant`      INT(11) NOT NULL,
    PRIMARY KEY  (`idtagrestaurant`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 1;
