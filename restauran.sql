# Host: localhost  (Version 5.5.5-10.4.24-MariaDB)
# Date: 2022-05-02 18:19:45
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "agenda_eventos"
#

DROP TABLE IF EXISTS `agenda_eventos`;
CREATE TABLE `agenda_eventos` (
  `id_agenda_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT 0,
  `id_sucursal` int(11) DEFAULT 0,
  `id_cliente` int(11) DEFAULT 0,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `fecha_capturada` datetime DEFAULT NULL,
  `id_tipo_evento` int(11) DEFAULT 0,
  `color_fondo` varchar(255) DEFAULT NULL,
  `nota` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1 COMMENT '0 activo, 1 eliminado, 2 llegada, despachado',
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_agenda_reserva`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

#
# Data for table "agenda_eventos"
#

INSERT INTO `agenda_eventos` VALUES (1,1,2,1,'2022-05-01 23:33:00','2022-05-01 23:33:00','2022-05-01 23:33:00',3,'#1ABC9C','Prueba',1,'2022-05-01 23:34:11');

#
# Structure for table "clientes"
#

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT 0,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `numero_personas` int(11) DEFAULT 0,
  `telefono_cliente` varchar(255) DEFAULT NULL,
  `correo_cliente` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT 1 COMMENT '0 eliminado, 1 activo',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (1,1,'Demostracion',5,'(503) 7358-2967','cliente@gmail.com','2022-05-01 23:34:11',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

#
# Data for table "tipo_evento"
#

INSERT INTO `tipo_evento` VALUES (1,'Personal','#4361EE',1),(2,'Trabajo','#E2A03F',1),(3,'Cita','#1ABC9C',1),(4,'Reunion','#E7515A',1);
