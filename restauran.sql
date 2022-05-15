# Host: localhost  (Version 5.5.5-10.4.24-MariaDB)
# Date: 2022-05-14 20:51:55
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "agenda_eventos"
#

DROP TABLE IF EXISTS `agenda_eventos`;
CREATE TABLE `agenda_eventos` (
  `id_agenda_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT 0,
  `id_sucursal` int(11) DEFAULT 0,
  `id_cliente` int(11) DEFAULT 0,
  `numero_personas` int(11) DEFAULT 0,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `fecha_capturada` datetime DEFAULT NULL,
  `id_tipo_evento` int(11) DEFAULT 0,
  `color_fondo` varchar(255) DEFAULT NULL,
  `nota` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1 COMMENT '0 eliminado, 1 activo, 2 llegada,  3despachado',
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_agenda_reserva`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

#
# Data for table "agenda_eventos"
#

INSERT INTO `agenda_eventos` VALUES (1,1,2,6,4,'2022-05-06 19:01:00','2022-05-06 19:01:00','2022-05-06 19:01:00',3,'#1ABC9C','Prueba',1,'2022-05-05 21:53:33'),(2,1,3,1,2,'2022-05-07 00:00:00','2022-05-07 00:00:00','2022-05-07 00:00:00',2,'#E2A03F','Nuevo empleo',1,'2022-05-06 20:46:23'),(3,1,3,5,5,'2022-05-12 00:00:00','2022-05-12 00:00:00','2022-05-12 00:00:00',5,'#805dca','Prueba',1,'2022-05-06 20:48:52'),(4,1,2,7,2,'2022-05-10 20:00:00','2022-05-10 20:00:00','2022-05-10 20:00:00',1,'#4361EE','El día de las madres',1,'2022-05-09 23:31:33'),(5,1,2,44,2,'2022-05-14 20:00:00','2022-05-14 20:00:00','2022-05-14 20:00:00',2,'#E2A03F','Por nueva propuesta de trabajo',1,'2022-05-14 15:40:10');

#
# Structure for table "bitacora"
#

DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT 0,
  `id_sucursal` int(11) DEFAULT 0,
  `accion_realizada` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_bitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

#
# Data for table "bitacora"
#

INSERT INTO `bitacora` VALUES (1,1,1,'Actualizo el nuevo mensaje ID 2, con titulo de: Mensaje de cancelación.','2022-05-09 23:18:15'),(2,1,1,'Cambio el mensaje ID 2, a estado: inhabilito','2022-05-09 23:22:00'),(3,1,1,'Registro un nuevo cliente ID7, con nombre: Juana Maria Vasquez lopez','2022-05-09 23:31:33'),(4,1,1,'Registro una nueva reverva ID4, para el cliente ID 7','2022-05-09 23:31:33'),(5,1,1,'Se han realizado intentos de ingresos con el usuario: ADMIN','2022-05-10 09:39:28'),(6,1,1,'A ingresado al sistema','2022-05-10 09:41:26'),(7,1,1,'¡Aviso! Se ha realizado un intento de ingreso al sisterma con el usuario: ADMIN','2022-05-10 09:41:46'),(8,1,1,'A ingresado al sistema','2022-05-10 09:46:30'),(9,1,1,'Edito la informacion del cliente ID: 1','2022-05-10 14:34:30'),(10,1,1,'Edito la informacion del cliente ID: 1','2022-05-10 14:34:39'),(11,1,1,'Elimino el registro del cliente ID: 6','2022-05-10 16:04:17'),(12,1,1,'A ingresado al sistema','2022-05-11 20:45:34'),(13,1,1,'A ingresado al sistema','2022-05-12 21:11:34'),(14,1,1,'A ingresado al sistema','2022-05-12 23:42:15'),(15,1,1,'A ingresado al sistema','2022-05-13 19:58:02'),(16,1,1,'A ingresado al sistema','2022-05-13 22:01:40'),(17,1,1,'A ingresado al sistema','2022-05-14 14:34:29'),(18,1,1,'Registro un nuevo cliente ID 44, con nombre: Ana Laura Aguirre','2022-05-14 15:40:10'),(19,1,1,'Registro una nueva reverva ID 5, para el cliente ID 44','2022-05-14 15:40:10'),(20,1,1,'A ingresado al sistema','2022-05-14 20:39:51');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "categorias"
#

/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Desayunos','1651300345.jpg','1'),(2,'Almuerzos','1651300741.png','1'),(3,'Cena','1651390751.jpg','1'),(4,'Bebidas','1651391245.jpg','1'),(5,'Entradas','1651391313.jpg','1');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

#
# Structure for table "clientes"
#

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT 0,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `telefono_cliente` varchar(255) DEFAULT NULL,
  `dos_telefono_cliente` varchar(255) DEFAULT NULL,
  `correo_cliente` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT 1 COMMENT '0 eliminado, 1 activo',
  `id_sucursal` int(11) DEFAULT 0,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (1,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(5,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(6,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(7,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(8,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(9,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(10,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(11,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(12,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(13,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(14,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(15,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(16,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(17,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(18,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(19,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(20,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(21,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(22,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(23,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(24,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(25,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(26,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(27,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(28,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(29,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(30,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(31,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(32,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(33,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(34,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(35,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(36,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(37,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(38,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(39,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(40,1,'Diego Arturo Lopez Vasquez','(503) 7358-2967','','','2022-05-05 21:53:33',1,1),(41,1,'Veronica Fernanda Hernadez Ramoz','(503) 7485-1564','','','2022-05-06 20:42:48',1,1),(42,1,'Paola Maria Lope Vasquez','(503) 6104-4860','','','2022-05-06 23:30:19',1,1),(43,1,'Juana Maria Vasquez lopez','(503) 6515-1515','','','2022-05-09 23:31:33',1,1),(44,1,'Ana Laura Aguirre','(503) 5645-1541','','','2022-05-14 15:40:10',1,1);

#
# Structure for table "mensaje_whatsapp"
#

DROP TABLE IF EXISTS `mensaje_whatsapp`;
CREATE TABLE `mensaje_whatsapp` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_mensaje` varchar(255) DEFAULT NULL,
  `contenido_mensaje` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT 0,
  `id_sucursal` int(11) DEFAULT 0,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT 1 COMMENT '0 eliminado, 1 activo',
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

#
# Data for table "mensaje_whatsapp"
#

INSERT INTO `mensaje_whatsapp` VALUES (1,'Recordatorio de reserva','Muy buenos días estimado cliente, le recordamos que tiene una reserva este día.\r\n\r\nEsperamos su confirmación. 🙌❤',1,1,'2022-05-06 22:41:09',1),(2,'Mensaje de cancelación.','Estimado cliente su reversa fue calenda por no llevar a tiempo.\r\n\r\nTenga un feliz día 🙌✔🐱‍🐉.',1,1,'2022-05-08 13:41:11',0);

#
# Structure for table "menu_disponibilidad"
#

DROP TABLE IF EXISTS `menu_disponibilidad`;
CREATE TABLE `menu_disponibilidad` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `id_producto` int(11) DEFAULT 0,
  `estado` varchar(1) DEFAULT '1',
  `cantidad` varchar(255) DEFAULT '0',
  `tipo_disponibilidad` int(11) DEFAULT 0 COMMENT '1= significa que cantidad y la fecha son las que mandan , 2= significa que las cantidades on infinita para esa misma fecha, 3= cantidad es infinita para todas las fechas',
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "menu_disponibilidad"
#


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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Data for table "mesas"
#

/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (2,'Mesa 1','4','1'),(3,'Mesa 2','4','1'),(4,'Mesa 3','2','1'),(5,'Mesa 4','3','1'),(6,'Mesa 5','4','1'),(7,'Mesa 6','12','1'),(8,'Mesa 7','5','1'),(9,'Mesa 8','4','1');
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;

#
# Structure for table "mesas_cuentas"
#

DROP TABLE IF EXISTS `mesas_cuentas`;
CREATE TABLE `mesas_cuentas` (
  `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(255) DEFAULT NULL,
  `cantidad` varchar(255) DEFAULT '0',
  `id_mesa` int(11) DEFAULT 0,
  `observacion` text DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1' COMMENT '1=cuenta activa, 0=cuenta cancelada, 2=cuenta cerrada',
  PRIMARY KEY (`id_cuenta`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "mesas_cuentas"
#

/*!40000 ALTER TABLE `mesas_cuentas` DISABLE KEYS */;
INSERT INTO `mesas_cuentas` VALUES (1,'Alexander Rosales','1',9,'','2'),(2,'Prueba','1',9,'','1');
/*!40000 ALTER TABLE `mesas_cuentas` ENABLE KEYS */;

#
# Structure for table "ordenes_restaurante"
#

DROP TABLE IF EXISTS `ordenes_restaurante`;
CREATE TABLE `ordenes_restaurante` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuenta` int(11) DEFAULT 0,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(1) DEFAULT '1' COMMENT '1= activo , 0=eliminado',
  PRIMARY KEY (`id_orden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "ordenes_restaurante"
#

/*!40000 ALTER TABLE `ordenes_restaurante` DISABLE KEYS */;
INSERT INTO `ordenes_restaurante` VALUES (1,1,'2022-05-14 20:40:22','2022-05-14 20:40:22','1'),(2,1,'2022-05-14 20:40:27','2022-05-14 20:40:27','1'),(3,1,'2022-05-14 20:40:59','2022-05-14 20:40:59','1'),(4,2,'2022-05-14 20:49:58','2022-05-14 20:49:58','1');
/*!40000 ALTER TABLE `ordenes_restaurante` ENABLE KEYS */;

#
# Structure for table "ordenes_restaurante_detalle"
#

DROP TABLE IF EXISTS `ordenes_restaurante_detalle`;
CREATE TABLE `ordenes_restaurante_detalle` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden` int(11) DEFAULT 0,
  `id_producto` int(11) DEFAULT 0,
  `cantidad` varchar(255) DEFAULT '',
  `precio` decimal(10,2) DEFAULT 0.00 COMMENT 'este precio es antes de coto complementos',
  `monto_complementos` decimal(10,2) DEFAULT 0.00,
  `sub_total` decimal(10,2) DEFAULT 0.00 COMMENT 'esot es el resultado de cantiodad por precio + monto_commplementos',
  `ids_complementos` varchar(255) DEFAULT '0',
  `comentario` text DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1' COMMENT '1= activo, 0=Eliminado',
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_detalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "ordenes_restaurante_detalle"
#

/*!40000 ALTER TABLE `ordenes_restaurante_detalle` DISABLE KEYS */;
INSERT INTO `ordenes_restaurante_detalle` VALUES (1,4,8,'3',2.00,0.00,6.00,'','Para ayer','1','2022-05-14 20:49:58'),(2,4,3,'1',9.50,0.50,10.00,'8','','1','2022-05-14 20:49:58');
/*!40000 ALTER TABLE `ordenes_restaurante_detalle` ENABLE KEYS */;

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
  `estado_disponibilidad` varchar(1) DEFAULT '1' COMMENT '1= activo, 0=inactivo',
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "productos"
#

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Huevos ','','1651300596.jpg','1',45.00,1,'1'),(2,'Carne','2 Quesadillas con carne extra','1651300791.jpg','1',56.00,2,'1'),(3,'Cóctel de Camarones','Es un coptel de camarones','1651391365.jpg','1',9.00,5,'1'),(4,'Camarones Empanizados','Es un Camarones Empanizados','1651391401.jpg','1',10.00,5,'1'),(5,'Churrasco Teriyaki 6oz','Lomito de aguja acompañado\r\nde yuca frita','1651391459.jpg','1',17.00,2,'1'),(6,'Pamperito Mixto 6oz','Lomito de aguja acompañado\r\nde 6oz de camarones','1651391498.jfif','1',25.00,2,'1'),(7,'Entraña 8oz','Entraña 8oz','1651391555.jpg','1',30.00,3,'1'),(8,'Cerveza Corona','Cerveza Corona','1651391696.jpg','1',2.00,4,'1'),(9,'Pilsener','Serveza','1651391760.jpg','1',1.00,4,'1');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

#
# Structure for table "productos_componentes"
#

DROP TABLE IF EXISTS `productos_componentes`;
CREATE TABLE `productos_componentes` (
  `id_componenete` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT 0,
  `nombre` varchar(255) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1',
  PRIMARY KEY (`id_componenete`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "productos_componentes"
#

/*!40000 ALTER TABLE `productos_componentes` DISABLE KEYS */;
INSERT INTO `productos_componentes` VALUES (1,1,'huevos','0'),(2,1,'Frijoles','1'),(3,1,'Bebida','0'),(4,1,'Entrada','1'),(5,2,'prueba 1','1'),(6,3,'Guarniciones','1');
/*!40000 ALTER TABLE `productos_componentes` ENABLE KEYS */;

#
# Structure for table "productos_componentes_detalle"
#

DROP TABLE IF EXISTS `productos_componentes_detalle`;
CREATE TABLE `productos_componentes_detalle` (
  `id_componente_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_componente` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT 0.00,
  `estado` varchar(1) DEFAULT '1',
  PRIMARY KEY (`id_componente_detalle`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "productos_componentes_detalle"
#

/*!40000 ALTER TABLE `productos_componentes_detalle` DISABLE KEYS */;
INSERT INTO `productos_componentes_detalle` VALUES (1,'2','sdfdf',33.00,'1'),(2,'5','estrellados',1.25,'0'),(3,'5','fsdsdf',3.00,'0'),(4,'5','asdfa',4344.00,'0'),(5,'6','Guarnicion1',0.00,'1'),(6,'6','Guarnicion2',0.25,'1'),(7,'6','Guarnicion 3',0.50,'0'),(8,'6','Guarnicio3',0.50,'1');
/*!40000 ALTER TABLE `productos_componentes_detalle` ENABLE KEYS */;

#
# Structure for table "sucursales"
#

DROP TABLE IF EXISTS `sucursales`;
CREATE TABLE `sucursales` (
  `id_sucursal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sucursal` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1 COMMENT '0 eliminado, 1 activo',
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#
# Data for table "sucursales"
#

INSERT INTO `sucursales` VALUES (1,'Sucursal 1',1),(2,'Sucursal 2',1),(3,'Sucursal 3',1);

#
# Structure for table "tipo_evento"
#

DROP TABLE IF EXISTS `tipo_evento`;
CREATE TABLE `tipo_evento` (
  `id_tipo_evento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_evento` varchar(255) DEFAULT NULL,
  `color_fondo` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1 COMMENT '0 eliminado, 1 activo',
  PRIMARY KEY (`id_tipo_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

#
# Data for table "tipo_evento"
#

INSERT INTO `tipo_evento` VALUES (1,'Personal','#4361EE',1),(2,'Trabajo','#E2A03F',1),(3,'Cita','#1ABC9C',1),(4,'Reunion','#E7515A',1),(5,'Particular','#805dca',1);

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
  `id_sucursal` int(11) DEFAULT 1,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "usuarios"
#

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','1234','Administrador','1',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
