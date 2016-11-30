-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.6.26 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para padel
CREATE DATABASE IF NOT EXISTS `padel` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `padel`;


-- Volcando estructura para tabla padel.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla padel.categorias: ~10 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`, `genero`) VALUES
	(114, 'Benjamin', 'Masculino'),
	(115, 'Benjamin', 'Femenino'),
	(116, 'Alevin', 'Femenino'),
	(117, 'Alevin', 'Masculino'),
	(118, 'Infantil', 'Femenino'),
	(119, 'Infantil', 'Masculino'),
	(120, 'Cadete', 'Femenino'),
	(121, 'Cadete', 'Masculino'),
	(122, 'Junior', 'Femenino'),
	(123, 'Junior', 'Masculino');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;


-- Volcando estructura para tabla padel.cuadros
CREATE TABLE IF NOT EXISTS `cuadros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_torneo` int(11) NOT NULL,
  `id_ronda` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_pareja_1` int(11) DEFAULT NULL,
  `id_pareja_2` int(11) DEFAULT NULL,
  `id_pareja_ganadora` int(11) DEFAULT NULL,
  `resultado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla padel.cuadros: ~0 rows (aproximadamente)
DELETE FROM `cuadros`;
/*!40000 ALTER TABLE `cuadros` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuadros` ENABLE KEYS */;


-- Volcando estructura para tabla padel.inscripciones
CREATE TABLE IF NOT EXISTS `inscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_torneo` int(11) NOT NULL,
  `id_pareja` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla padel.inscripciones: ~0 rows (aproximadamente)
DELETE FROM `inscripciones`;
/*!40000 ALTER TABLE `inscripciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscripciones` ENABLE KEYS */;


-- Volcando estructura para tabla padel.jugadores
CREATE TABLE IF NOT EXISTS `jugadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla padel.jugadores: ~0 rows (aproximadamente)
DELETE FROM `jugadores`;
/*!40000 ALTER TABLE `jugadores` DISABLE KEYS */;
/*!40000 ALTER TABLE `jugadores` ENABLE KEYS */;


-- Volcando estructura para tabla padel.parejas
CREATE TABLE IF NOT EXISTS `parejas` (
  `id` int(11) NOT NULL,
  `id_jugador_1` int(11) NOT NULL,
  `id_jugador_2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla padel.parejas: ~0 rows (aproximadamente)
DELETE FROM `parejas`;
/*!40000 ALTER TABLE `parejas` DISABLE KEYS */;
/*!40000 ALTER TABLE `parejas` ENABLE KEYS */;


-- Volcando estructura para tabla padel.rondas
CREATE TABLE IF NOT EXISTS `rondas` (
  `id` int(11) NOT NULL,
  `cuadro` varchar(50) NOT NULL,
  `ronda` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla padel.rondas: ~12 rows (aproximadamente)
DELETE FROM `rondas`;
/*!40000 ALTER TABLE `rondas` DISABLE KEYS */;
INSERT INTO `rondas` (`id`, `cuadro`, `ronda`) VALUES
	(101, 'Principal', 'Final'),
	(102, 'Principal', 'Semifinales'),
	(104, 'Principal', 'Cuartos'),
	(108, 'Principal', 'Octavos'),
	(116, 'Principal', 'Dieciseisavos'),
	(132, 'Principal', 'Treintaidosavos'),
	(201, 'Consolacion', 'Final'),
	(202, 'Consolacion', 'Semifinales'),
	(204, 'Consolacion', 'Cuartos'),
	(208, 'Consolacion', 'Octavos'),
	(216, 'Consolacion', 'Dieciseisavos'),
	(232, 'Consolacion', 'Treintaidosavos');
/*!40000 ALTER TABLE `rondas` ENABLE KEYS */;


-- Volcando estructura para tabla padel.torneos
CREATE TABLE IF NOT EXISTS `torneos` (
  `id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `torneo` varchar(150) NOT NULL,
  `categoria` varchar(50) NOT NULL DEFAULT 'MENORES',
  `tipo` varchar(50) NOT NULL DEFAULT 'A',
  `lugar` varchar(150) DEFAULT NULL,
  `sede` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla padel.torneos: ~0 rows (aproximadamente)
DELETE FROM `torneos`;
/*!40000 ALTER TABLE `torneos` DISABLE KEYS */;
/*!40000 ALTER TABLE `torneos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
