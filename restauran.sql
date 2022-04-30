# Host: localhost  (Version 5.5.5-10.4.22-MariaDB)
# Date: 2022-04-30 00:41:28
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "categorias"
#

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1' COMMENT '1=activo, 0=eliminado',
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "categorias"
#

/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Desayunos','1651300345.jpg','1'),(2,'Almuerzos','1651300741.png','1');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

#
# Structure for table "mesas"
#

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE `mesas` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `capacidad` varchar(255) DEFAULT '2',
  `estado` varchar(1) DEFAULT '1' COMMENT '1=activo, 0=eliminado',
  PRIMARY KEY (`id_mesa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "mesas"
#

/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,'Mesa 1','4','1');
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;

#
# Structure for table "productos"
#

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1' COMMENT '1=activo, 0=eliminado',
  `precio` decimal(10,2) DEFAULT 0.00,
  `id_categoria` int(11) DEFAULT 0,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "productos"
#

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Huevos ','1651300596.jpg','1',45.00,2),(2,'Carne','1651300791.jpg','0',56.00,2);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

#
# Structure for table "usuarios"
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT '',
  `clave` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT '',
  `estado` varchar(1) DEFAULT '1' COMMENT '1=Activo, 1=Eliminado',
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "usuarios"
#

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','1234','Administrador','1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
