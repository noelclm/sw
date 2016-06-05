# CREATE DATABASE IF NOT EXISTS valorest CHARACTER SET utf8 COLLATE utf8_general_ci;
# CREATE USER 'valorest'@'localhost' IDENTIFIED BY '0tserolav1';
# GRANT ALL PRIVILEGES ON `valorest`.* TO 'valorest'@'localhost' WITH GRANT OPTION;

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
    `description`       TEXT NOT NULL,
    `frontpage`         CHAR(1) NOT NULL,
    PRIMARY KEY  (`idrestaurant`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 217;

INSERT INTO `restaurant` VALUES (1, 1, 30, 'losamigos.jpg', 'Los amigos', 'Ezequiel Solana, 114, Madrid, 28017', 'Distrito: Ciudad lineal - Barrio: Quintana', '', '', '', 15, 'Situado en Ezequiel Solana, una calle ancha entre La Almudena y Ascao plagada de comercios de barrio de todo tipo de productos y en la que no faltan multitud de bares, si bien ninguno es, ni de lejos, tan famoso como éste.','S');
INSERT INTO `restaurant` VALUES (2, 1, 30, '7copas.jpg', 'Siete Copas Bar','C/ Sor Ángela de la Cruz, 30, Madrid, 28020', 'Distrito: Tetuán', '', 'www.sietecopascafe.es', '', 15, 'El 01 de Junio de 1997 SieteCopasCafé, inicialmente llamado Café 7, abrió sus puertas en el madrileño barrio de Castillejos, recién inagurado el último tramo en obras que completaba la calle Sor Ángela de la Cruz, en el número 30, muy cerca de la Pza. Cuzco/Castellana. En aquel entonces, el local estaba dedicado principalmente a la venta de exquisitos y variados tipos de café, de varias zonas del mundo, cervezas, combinados, así como raciones y picoteo en general y su decoración recordaba a la de una terraza de playa. Ya a finales del 2001, antes del cambio de moneda, el local sufrió un cambio radical y se transformó en lo que es hoy en dia, una Taberna de estilo Irlandés, pero con todos sus elementos de caracter Español: carteles publicitarios antiguos, fotos reales de época, barriles rotulados procedentes de bodegas vinícolas, figuras, retroiluminaciones, etc... todo ello en un entorno de verdes paredes y suelos  y techos de madera. En 2010 volvimos a mejorar y se amplió enormemente la oferta en cervezas. Actualmente disponemos de 2 tipos de cerveza en barril y de más de 80 en botella. Se adecuó la decoración para todo ello, se adquirió la vajilla original de la mayoria de esas cervezas y se amplió también la oferta en alcoholes de primeras marcas, disponiendo hasta la fecha de más de 70 marcas diferentes de estos, incluyendo una veintena de Ginebras Premium (GinClub), más de 30 Rones de todos los tipos y más de 20 marcas de Whisky, nuevamente de todos los gustos y calidades. Completamos todo ello, con una exiquisita carta de Molletes recien hechos, tamaño mediano, perfecto! raciones de calidad y buen queso y nuestras afamadas aceitunas "de la abuela". Si todavía no nos conoces, en estos más de 18 años de andadura, esperamos que no tardes en hacerlo, porque estamos seguros de que te encantará y por supuesto, volverás.','S');
INSERT INTO `restaurant` VALUES (3, 1, 30, 'zenmarket.jpg', 'ZenMarket','Avda. Concha Espina, 1, 28036 - Madrid', 'Estadio Santiago Bernabeu (puerta 20-22)', '+34 91 457 18 73', 'www.zenmarket.es', '', 20, 'Zen Market, con capacidad para acoger a 290 personas en sus 2.000 metros cuadrados de espacio, cautiva a través de los sentidos, con piezas milenarias que decoran sus paredes y sus salones, mientras que una fusión de su cocina japonesa y china, consigue conquistar lo paladares más exquisitos. Sus especialidades son el pato laqueado y el sushi, regados con más de 350 referencias de vino nacional e internacional.','S');

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

INSERT INTO `user` VALUES(1, 'Admin', 'admin', '$2y$10$P2IJ.4IQSiHBVzDXuWtSLugaV5nw5v6PRMjMIf5Ji7JTfsuLcxN/S', '', 2);
INSERT INTO `user` VALUES(3, 'User', 'user', '$2y$10$P2IJ.4IQSiHBVzDXuWtSLugaV5nw5v6PRMjMIf5Ji7JTfsuLcxN/S', '', 1);
#La contraseña para todos es 'clave'

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

INSERT INTO `comment` VALUES(1, 1, 1, 10, '2016-05-12', 'Comentario');
INSERT INTO `comment` VALUES(2, 2, 4, 8, '2016-05-14', 'Comentario');
INSERT INTO `comment` VALUES(3, 1, 3, 6, '2016-05-20', 'Comentario');
INSERT INTO `comment` VALUES(4, 3, 3, 9, '2016-06-02', 'Comentario');

# -------------------------------------------
# Estructura de `menu`
# -------------------------------------------

CREATE TABLE IF NOT EXISTS `menu` (
    `idmenu`            INT(11) NOT NULL AUTO_INCREMENT,
    `permissions`       INT(11) NOT NULL,
    `type`              INT(11) NOT NULL,
    `order`             INT(11) NOT NULL,
    `page`              VARCHAR(255) NOT NULL,
    `name`              VARCHAR(255) NOT NULL,
    `parameter`         VARCHAR(255) NOT NULL,
    PRIMARY KEY  (`idmenu`)
)ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci AUTO_INCREMENT = 1;

INSERT INTO `menu` VALUES(01, 0, 1, 001, 'lista', 'Nacional', 'idtag=1');
INSERT INTO `menu` VALUES(02, 0, 1, 002, 'lista', 'Internacional', 'idtag=2');

INSERT INTO `menu` VALUES(03, 0, 1, 003, 'lista', 'Tapeo', 'idtag=3');
INSERT INTO `menu` VALUES(04, 0, 1, 004, 'lista', 'Comer', 'idtag=4');
INSERT INTO `menu` VALUES(05, 0, 1, 005, 'lista', 'Copas', 'idtag=5');

INSERT INTO `menu` VALUES(06, 1, 2, 001, 'gestion', 'Gestion', '');

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

INSERT INTO `tagrestaurant` VALUES(1, 1, 1);
INSERT INTO `tagrestaurant` VALUES(2, 1, 3);
INSERT INTO `tagrestaurant` VALUES(3, 2, 1);
INSERT INTO `tagrestaurant` VALUES(5, 2, 2);
INSERT INTO `tagrestaurant` VALUES(6, 2, 5);
INSERT INTO `tagrestaurant` VALUES(7, 3, 2);
INSERT INTO `tagrestaurant` VALUES(8, 3, 4);