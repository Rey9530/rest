﻿# Host: localhost  (Version 5.5.5-10.4.22-MariaDB)
# Date: 2022-05-01 01:56:31
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "categorias"
#

/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Desayunos','1651300345.jpg','1'),(2,'Almuerzos','1651300741.png','1'),(3,'Cena','1651390751.jpg','1'),(4,'Bebidas','1651391245.jpg','1'),(5,'Entradas','1651391313.jpg','1');
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1' COMMENT '1=activo, 0=eliminado',
  `precio` decimal(10,2) DEFAULT 0.00,
  `id_categoria` int(11) DEFAULT 0,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "productos"
#

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Huevos ','1 huevo estrellado con pan de caja','1651300596.jpg','1',45.00,1),(2,'Carne','2 Quesadillas con carne extra','1651300791.jpg','1',56.00,2),(3,'Cóctel de Camarones','Es un coptel de camarones','1651391365.jpg','1',9.00,5),(4,'Camarones Empanizados','Es un Camarones Empanizados','1651391401.jpg','1',10.00,5),(5,'Churrasco Teriyaki 6oz','Lomito de aguja acompañado\r\nde yuca frita','1651391459.jpg','1',17.00,2),(6,'Pamperito Mixto 6oz','Lomito de aguja acompañado\r\nde 6oz de camarones','1651391498.jfif','1',25.00,2),(7,'Entraña 8oz','Entraña 8oz','1651391555.jpg','1',30.00,3),(8,'Cerveza Corona','Cerveza Corona','1651391696.jpg','1',2.00,4),(9,'Pilsener','Serveza','1651391760.jpg','1',1.00,4);
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
