-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: ticketera_hu
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adjunto`
--

DROP TABLE IF EXISTS `adjunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adjunto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto`
--

LOCK TABLES `adjunto` WRITE;
/*!40000 ALTER TABLE `adjunto` DISABLE KEYS */;
INSERT INTO `adjunto` VALUES (1,'1732197267_20241112_085622.mp4','storage/tickets_files/1732197267_20241112_085622.mp4'),(2,'1732629946_hu_logo.png','storage/tickets_files/1732629946_hu_logo.png'),(3,'1732630338_hu_logo.png','storage/tickets_files/1732630338_hu_logo.png'),(4,'1732630540_Luciano Badilla CV-2.pdf','storage/tickets_files/1732630540_Luciano Badilla CV-2.pdf');
/*!40000 ALTER TABLE `adjunto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adjunto_ticket`
--

DROP TABLE IF EXISTS `adjunto_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adjunto_ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adjunto_id` int DEFAULT NULL,
  `ticket_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `adjunto_id` (`adjunto_id`),
  KEY `ticket_id` (`ticket_id`),
  CONSTRAINT `adjunto_ticket_ibfk_1` FOREIGN KEY (`adjunto_id`) REFERENCES `adjunto` (`id`) ON DELETE CASCADE,
  CONSTRAINT `adjunto_ticket_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto_ticket`
--

LOCK TABLES `adjunto_ticket` WRITE;
/*!40000 ALTER TABLE `adjunto_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjunto_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adjunto_ticket_respuesta`
--

DROP TABLE IF EXISTS `adjunto_ticket_respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adjunto_ticket_respuesta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adjunto_id` int DEFAULT NULL,
  `ticket_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `adjunto_id` (`adjunto_id`),
  KEY `ticket_id` (`ticket_id`),
  CONSTRAINT `adjunto_ticket_respuesta_ibfk_1` FOREIGN KEY (`adjunto_id`) REFERENCES `adjunto` (`id`) ON DELETE CASCADE,
  CONSTRAINT `adjunto_ticket_respuesta_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_respuesta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto_ticket_respuesta`
--

LOCK TABLES `adjunto_ticket_respuesta` WRITE;
/*!40000 ALTER TABLE `adjunto_ticket_respuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjunto_ticket_respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ticketera_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (3,'Desarrollo',4);
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('admin|::1','i:1;',1728044235),('admin|::1:timer','i:1728044235;',1728044235),('lucianobadilla88@gmail.comas|::1','i:1;',1732627670),('lucianobadilla88@gmail.comas|::1:timer','i:1732627670;',1732627670),('lucianobadilla88@gmail.comx|::1','i:1;',1732627512),('lucianobadilla88@gmail.comx|::1:timer','i:1732627512;',1732627512),('lucianobadilla88@gmail.comxd|::1','i:1;',1732627610),('lucianobadilla88@gmail.comxd|::1:timer','i:1732627610;',1732627610);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'lucianobadilla88@gmail.com'),(2,'juancruzfilippini@gmail.com'),(3,'test@test.com');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_tickets`
--

DROP TABLE IF EXISTS `dashboard_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detalle` text NOT NULL,
  `pretext` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_tickets`
--

LOCK TABLES `dashboard_tickets` WRITE;
/*!40000 ALTER TABLE `dashboard_tickets` DISABLE KEYS */;
INSERT INTO `dashboard_tickets` VALUES (1,'Seguridad e\r\n Higiene','Gestiona tickets relacionados\r\n                                                con la seguridad y la higiene en el lugar de trabajo.','fa-mask-face','Bienvenido a nuestro Sistema de Seguridad e Higiene. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de soporte, por favor seleccione un departamento.',NULL),(2,'Mantenimiento','Solicita reparaciones o\r\n                                                mantenimiento para equipos e instalaciones.','fa-tools','Bienvenido a nuestro Sistema de Mantenimiento. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de mantenimiento, por favor seleccione un departamento.',NULL),(3,'Historias Clínicas','Reporta duplicados o errores en historaias clínicas para su correción','fa-file-circle-xmark','Bienvenido a nuestro Sistema de Control de Gestión. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas. Recuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar Con el fin de abrir un ticket de Control de Gestión, por favor seleccione un departamento.','<div style=\"display: flex; gap: 20px; justify-content: space-between;\">\r\n    <!-- Sección HC CORRECTA -->\r\n    <div>\r\n        <p><strong>HC CORRECTA:</strong></p>\r\n        <p><strong>DNI:</strong></p>\r\n        <p><strong>Nombre y Apellido:</strong></p>\r\n        <p><strong>Fecha de Nacimiento:</strong></p>\r\n        <p><strong>Obra Social:</strong></p>\r\n    </div>\r\n<div></div>\r\n    <p></p>\r\n\r\n    <!-- Sección HC INCORRECTA -->\r\n    <div>\r\n        <p><strong>HC INCORRECTA:</strong></p>\r\n        <p><strong>DNI:</strong></p>\r\n        <p><strong>Nombre y Apellido:</strong></p>\r\n        <p><strong>Fecha de Nacimiento:</strong></p>\r\n        <p><strong>Obra Social:</strong></p>\r\n    </div>\r\n</div>\r\n'),(4,'Tecnología y\r\n Comunicaciones (TICS)','Solicita soporte para problemas\r\n                                                de tecnología, informática y comunicaciones.','fa-computer','Bienvenido a nuestro Sistema de Mesa de Ayuda. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de soporte, por favor seleccione un departamento.',NULL),(5,'Biotecnología','Gestiona tickets relacionados\r\n                                                con equipos y procesos biotecnológicos.','fa-dna','Bienvenido a nuestro Sistema de Biotecnología. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de soporte, por favor seleccione un departamento.',NULL),(6,'Call Center','Reporta problemas o solicita\r\n                                                asistencia relacionada con el centro de llamadas.','fa-headset','Bienvenido a la ticketera de Call Center\r\n\r\nGracias por comunicarse con el sistema de turnos de Hospital Universitario, por favor complete todos los datos solicitados. (No audios).\r\nDNI:\r\nNombre y Apellido\r\nFecha de Nacimiento\r\nDirección\r\nTeléfonos de Contacto:\r\nObra Social\r\nNº de afiliado\r\ncorreo electrónico\r\nProfesional o especialidad para quien solicita turno\r\nSi tiene pedido médico, envíe foto por favor\r\nSI UD NO PUEDE EN ALGÚN HORARIO O PREFIERE ALGUNO ESPECÍFICO, ACLÁRELO.\r\nLos mensajes se responden en un lapso de 24 horas hábiles. Si precisa respuesta urgente, comuníquese al 08109991029\r\nSeleccione un departamento.','<p><strong>DNI:<br>Nombre y Apellido:<br>Fecha de Nacimiento:<br>Dirección:<br>Teléfonos de Contacto:<br>Obra Social:<br>Nº de afiliado:<br>correo electrónico:<br>Profesional o especialidad para quien solicita turno: </strong></p>'),(7,'RRHH (AVISO DE SALIDAS)','Gestiona avisos de salidas del equipo de coordinaciones.','fa-person-walking-arrow-right','Bienvenido a nuestra ticketera de RRHH.\r\n\r\nSr/a Coordinador/a el siguiente sistema le ayudará a ponerse en contacto con nosotros para dar aviso de salidas de los integrantes de su equipo.\r\n\r\nRecuerde utilizar el correo institucional para realizar el aviso. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de aviso, por favor seleccione el departamento que coordina',NULL);
/*!40000 ALTER TABLE `dashboard_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Facturación'),(2,'Tesorería'),(3,'Mantenimiento'),(4,'Dirección General'),(5,'Dirección Académica'),(6,'Dirección Asistencial'),(7,'Dirección Administrativa'),(8,'Contabilidad'),(10,'Admisión'),(11,'Despacho'),(12,'Estadística y Procesos Hospitalarios'),(13,'RRHH'),(14,'Farmacia'),(15,'Laboratorio'),(16,'Comunicación Institucional'),(17,'Informes'),(18,'Mesa de entradas'),(19,'Anatomía patológica'),(20,'Tecnología biomédica'),(21,'Rayos'),(22,'Guardia Médica'),(23,'Odontología'),(24,'DAMSU'),(25,'Secretaría Sector Amarillo'),(26,'Sistemas'),(27,'Consultorios'),(28,'Archivo HC'),(29,'Patrimonio'),(30,'Gestión de Personas'),(31,'Compras'),(32,'Rehabilitación'),(34,'UDA'),(35,'Enfermería'),(36,'Shock Room'),(37,'Traumatología'),(38,'Cardiología'),(39,'Microbiología'),(40,'Hematología'),(41,'Vacunatorio'),(42,'Recepción'),(43,'Call Center'),(44,'Biotecnología'),(45,'Fundación HU'),(46,'Coordinación Económica Financiera'),(47,'Comercialización'),(48,'Control de Gestión'),(49,'Seguridad e Higiene'),(51,'EPH (EN DESHUSO|NO USAR)'),(52,'Jefatura de Call Center, Informes y Secretaría de Odontología'),(55,'Ginecología'),(56,'Esterilización'),(57,'Unidad Quirúrgica'),(58,'Desarrollo');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Respondido'),(2,'Cerrado'),(3,'Abierto'),(4,'Pendiente');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1),(3,'2024_07_29_113229_create_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prioridad`
--

DROP TABLE IF EXISTS `prioridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prioridad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prioridad`
--

LOCK TABLES `prioridad` WRITE;
/*!40000 ALTER TABLE `prioridad` DISABLE KEYS */;
INSERT INTO `prioridad` VALUES (1,'Baja'),(2,'Media'),(3,'Alta');
/*!40000 ALTER TABLE `prioridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Agente'),(2,'Administrador');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('iR8DUQGzI0mUlYOktpbTvPeTZgVnBYdsfZESq716',5,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMVVLcE9RaVZOT0k1YVBmWUdzcTlHcG9IZ1F1bFBZR1hYQU5YMXFQcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3QvdGlja2V0ZXJhSFUvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9',1732725371);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subarea`
--

DROP TABLE IF EXISTS `subarea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subarea` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ticketera_id` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subarea`
--

LOCK TABLES `subarea` WRITE;
/*!40000 ALTER TABLE `subarea` DISABLE KEYS */;
/*!40000 ALTER TABLE `subarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asunto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cuerpo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `estado_id` int DEFAULT '3',
  `departamento_id` int DEFAULT NULL,
  `cliente_id` int DEFAULT NULL,
  `prioridad_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_problema_id` bigint DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `estado_id` (`estado_id`),
  KEY `departamento_id` (`departamento_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `prioridad_id` (`prioridad_id`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`prioridad_id`) REFERENCES `prioridad` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (149,'Test de estados','<p>Test de estados</p>',1,26,1,2,'2024-11-26 14:55:21','2024-11-27 14:22:01',7,NULL);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_respuesta`
--

DROP TABLE IF EXISTS `ticket_respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_respuesta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int DEFAULT NULL,
  `cuerpo` mediumtext,
  `personal_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `ticket_id` (`ticket_id`),
  CONSTRAINT `ticket_respuesta_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_respuesta`
--

LOCK TABLES `ticket_respuesta` WRITE;
/*!40000 ALTER TABLE `ticket_respuesta` DISABLE KEYS */;
INSERT INTO `ticket_respuesta` VALUES (90,149,'<p>Deberia cambiar a Respondido</p>','5','2024-11-26 15:01:23','2024-11-26 15:01:23'),(91,149,'<p>Hola?</p>','5','2024-11-26 15:01:58','2024-11-26 15:01:58'),(92,149,'<p>w</p>','5','2024-11-26 15:03:22','2024-11-26 15:03:22'),(93,149,'<p>asd</p>','5','2024-11-26 15:03:47','2024-11-26 15:03:47'),(94,149,'<p>alo</p>','5','2024-11-26 15:04:19','2024-11-26 15:04:19'),(95,149,'<p>Che nunca llego nadie</p>','lucianobadilla88@gmail.com','2024-11-26 15:04:36','2024-11-26 15:04:36'),(96,149,'<p>Hola?</p>','lucianobadilla88@gmail.com','2024-11-26 15:04:51','2024-11-26 15:04:51'),(97,149,NULL,'5','2024-11-26 15:09:12','2024-11-26 15:09:12'),(98,149,NULL,'5','2024-11-26 15:09:17','2024-11-26 15:09:17'),(99,149,'<p>Holaaaaa</p>','5','2024-11-27 14:22:01','2024-11-27 14:22:01');
/*!40000 ALTER TABLE `ticket_respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticketera_ticket`
--

DROP TABLE IF EXISTS `ticketera_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticketera_ticket` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `ticketera_id` bigint NOT NULL,
  `ticket_id` bigint NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticketera_ticket`
--

LOCK TABLES `ticketera_ticket` WRITE;
/*!40000 ALTER TABLE `ticketera_ticket` DISABLE KEYS */;
INSERT INTO `ticketera_ticket` VALUES (7,4,149,'ticket');
/*!40000 ALTER TABLE `ticketera_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_problemas`
--

DROP TABLE IF EXISTS `tipo_problemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_problemas` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_problemas`
--

LOCK TABLES `tipo_problemas` WRITE;
/*!40000 ALTER TABLE `tipo_problemas` DISABLE KEYS */;
INSERT INTO `tipo_problemas` VALUES (1,'ALEPHOO'),(2,'TELEFONIA'),(3,'SERVICIO TECNICO'),(4,'OPTIMI'),(5,'BIOBOX'),(6,'PRODUCTIVIDAD'),(7,'OTRO');
/*!40000 ALTER TABLE `tipo_problemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_and_surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol_id` bigint NOT NULL DEFAULT '1',
  `ticketera_id` bigint NOT NULL,
  `validated` binary(1) NOT NULL DEFAULT '0',
  `requestsPassword` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'Luciano Badilla','lucianobadilla88@gmail.com',NULL,'$2y$12$uvAbNbKhKKTz8HK0qiMe1ewRy3xvEg6nr/EcNExczh2LkIjhjkjV2',NULL,'2024-11-26 13:16:28','2024-11-26 14:28:48',2,4,_binary '1',_binary '0'),(6,'Juan Cruz','juancruzfilippini@gmail.com',NULL,'$2y$12$4DmIUyN11dZDBhdaLcGnr.AiA3eaGR.hMC6h8s3Cw3JEiq/7gS.bO',NULL,'2024-11-26 13:22:53','2024-11-27 14:24:57',1,4,_binary '1',_binary '1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ticketera_hu'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27 13:36:31
