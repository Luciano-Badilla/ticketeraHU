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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto`
--

LOCK TABLES `adjunto` WRITE;
/*!40000 ALTER TABLE `adjunto` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto_ticket_respuesta`
--

LOCK TABLES `adjunto_ticket_respuesta` WRITE;
/*!40000 ALTER TABLE `adjunto_ticket_respuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjunto_ticket_respuesta` ENABLE KEYS */;
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
INSERT INTO `cache` VALUES ('admin|::1','i:1;',1728044235),('admin|::1:timer','i:1728044235;',1728044235);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_tickets`
--

LOCK TABLES `dashboard_tickets` WRITE;
/*!40000 ALTER TABLE `dashboard_tickets` DISABLE KEYS */;
INSERT INTO `dashboard_tickets` VALUES (1,'Seguridad e\r\n Higiene','Gestiona tickets relacionados\r\n                                                con la seguridad y la higiene en el lugar de trabajo.','fa-mask-face','Bienvenido a nuestro Sistema de Seguridad e Higiene. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de soporte, por favor seleccione un departamento.'),(2,'Mantenimiento','Solicita reparaciones o\r\n                                                mantenimiento para equipos e instalaciones.','fa-tools','Bienvenido a nuestro Sistema de Mantenimiento. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de mantenimiento, por favor seleccione un departamento.'),(3,'Historias\rClínicas','Reporta duplicados o errores en\r\n                                                historias clínicas para su corrección.','fa-file-circle-xmark','Bienvenido a nuestro Sistema de Control de Gestión. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de Control de Gestión, por favor seleccione un departamento.'),(4,'Tecnología y\r\n Comunicaciones (TICS)','Solicita soporte para problemas\r\n                                                de tecnología, informática y comunicaciones.','fa-computer','Bienvenido a nuestro Sistema de Mesa de Ayuda. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de soporte, por favor seleccione un departamento.'),(5,'Biotecnología','Gestiona tickets relacionados\r\n                                                con equipos y procesos biotecnológicos.','fa-dna','Bienvenido a nuestro Sistema de Biotecnología. El Sistema le ayudará a ponerse en contacto con nosotros por todas sus consultas y obtener respuestas inmediatas a ellas.\r\n\r\nRecuerde utilizar el correo institucional para realizar el pedido de asistencia. Ej: nombre.apellido@hospital.uncu.edu.ar\r\n\r\nCon el fin de abrir un ticket de soporte, por favor seleccione un departamento.'),(6,'Call Center','Reporta problemas o solicita\r\n                                                asistencia relacionada con el centro de llamadas.','fa-headset','Bienvenido a la ticketera de Call Center\r\n\r\nGracias por comunicarse con el sistema de turnos de Hospital Universitario, por favor complete todos los datos solicitados. (No audios).\r\nDNI:\r\nNombre y Apellido\r\nFecha de Nacimiento\r\nDirección\r\nTeléfonos de Contacto:\r\nObra Social\r\nNº de afiliado\r\ncorreo electrónico\r\nProfesional o especialidad para quien solicita turno\r\nSi tiene pedido médico, envíe foto por favor\r\nSI UD NO PUEDE EN ALGÚN HORARIO O PREFIERE ALGUNO ESPECÍFICO, ACLÁRELO.\r\nLos mensajes se responden en un lapso de 24 horas hábiles. Si precisa respuesta urgente, comuníquese al 08109991029\r\nSeleccione un departamento.');
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Facturación'),(2,'Tesorería'),(3,'Mantenimiento'),(4,'Dirección General'),(5,'Dirección Académica'),(6,'Dirección Asistencial'),(7,'Dirección Administrativa'),(8,'Contabilidad'),(10,'Admisión'),(11,'Despacho'),(12,'Estadística y Procesos Hospitalarios'),(13,'RRHH'),(14,'Farmacia'),(15,'Laboratorio'),(16,'Comunicación Institucional'),(17,'Informes'),(18,'Mesa de entradas'),(19,'Anatomía patológica'),(20,'Tecnología biomédica'),(21,'Rayos'),(22,'Guardia Médica'),(23,'Odontología'),(24,'DAMSU'),(25,'Secretaría Sector Amarillo'),(26,'Sistemas'),(27,'Consultorios'),(28,'Archivo HC'),(29,'Patrimonio'),(30,'Gestión de Personas'),(31,'Compras'),(32,'Rehabilitación'),(34,'UDA'),(35,'Enfermería'),(36,'Shock Room'),(37,'Traumatología'),(38,'Cardiología'),(39,'Microbiología'),(40,'Hematología'),(41,'Vacunatorio'),(42,'Recepción'),(43,'Call Center'),(44,'Biotecnología'),(45,'Fundación HU'),(46,'Coordinación Económica Financiera'),(47,'Comercialización'),(48,'Control de Gestión'),(49,'Seguridad e Higiene'),(51,'EPH (EN DESHUSO|NO USAR)'),(52,'Jefatura de Call Center, Informes y Secretaría de Odontología'),(55,'Ginecología'),(56,'Esterilización'),(57,'Unidad Quirúrgica');
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
INSERT INTO `estado` VALUES (1,'respondido'),(2,'cerrado'),(3,'abierto'),(4,'respuesta al cliente'),(5,'en progreso');
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
INSERT INTO `sessions` VALUES ('I5u09wE4our33d90vUVJDDvjpG4Pdf3m3quHYLXV',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR20xTXdodGlBRFhxY0ZSdW1PQnJXZkNKcXhMbEV6Z0loMTB5TkhCRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vbG9jYWxob3N0L3RpY2tldGVyYUhVL3B1YmxpYy90aWNrZXQvMTQxL25ldy1tZXNzYWdlcz9sYXN0Q2hlY2tlZD0yMDI0LTExLTIwVDEzJTNBNDMlM0E0OS4wMDBaIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1732112208),('yFlqPy62qeZ3sYP0Dls0OwMwAI3bswredyw5RfGp',NULL,'172.22.114.219','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2djaXRlWnpKdFpvYnB2b05lYmdGWElISUFFcEpXWWNORXZPczB5dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA1OiJodHRwOi8vMTcyLjIyLjExNS4xMDMvdGlja2V0ZXJhSFUvcHVibGljL3RpY2tldC8xNDEvbmV3LW1lc3NhZ2VzP2xhc3RDaGVja2VkPTIwMjQtMTEtMjBUMTMlM0E0MyUzQTQ5LjAwMFoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1732112193);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
  `estado_id` int DEFAULT NULL,
  `departamento_id` int DEFAULT NULL,
  `cliente_id` int DEFAULT NULL,
  `prioridad_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_problema_id` bigint DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (142,'Subida de sueldo','<p>**Juan Pérez Gómez**&nbsp;&nbsp;</p><p>Calle Ficticia 123&nbsp;&nbsp;</p><p>Ciudad Inventada, Estado XY, 12345&nbsp;&nbsp;</p><p>20 de noviembre de 2024&nbsp;&nbsp;</p><p><br></p><p>**Lic. Marta Ramírez López**&nbsp;&nbsp;</p><p>Gerente de Recursos Humanos&nbsp;&nbsp;</p><p>Corporativo Innovación S.A.&nbsp;&nbsp;</p><p>Avenida Principal 456&nbsp;&nbsp;</p><p>Ciudad Inventada, Estado XY, 12345&nbsp;&nbsp;</p><p><br></p><p>**Asunto: Solicitud de revisión salarial**&nbsp;&nbsp;</p><p><br></p><p>Estimada Lic. Ramírez:&nbsp;&nbsp;</p><p><br></p><p>Por medio de la presente, me permito solicitar su amable atención para abordar un tema que considero relevante tanto para mi desarrollo profesional como para mi integración en los objetivos estratégicos de Corporativo Innovación S.A. Me refiero a la posibilidad de realizar un ajuste en mi remuneración actual.&nbsp;&nbsp;</p><p><br></p><p>Desde mi incorporación a esta empresa el 15 de marzo de 2020 como Analista de Procesos, he asumido con entusiasmo cada reto que se me ha planteado, buscando no solo cumplir con las expectativas de mi puesto, sino superarlas consistentemente. Mi compromiso y dedicación hacia los proyectos asignados han tenido un impacto positivo en varias áreas clave de la organización.&nbsp;&nbsp;</p><p><br></p><p>Entre mis logros más destacados, quisiera resaltar los siguientes:&nbsp;&nbsp;</p><p><br></p><p>1. **Optimización del proceso de inventario**: En 2022, lideré la implementación de un nuevo sistema automatizado que redujo en un 30% el tiempo promedio de gestión, generando un ahorro anual estimado en $250,000 MXN.&nbsp;&nbsp;</p><p>2. **Incremento en la eficiencia del equipo**: Diseñé y ejecuté un programa de capacitación para el departamento de operaciones que mejoró la productividad en un 18%, según los indicadores clave de desempeño (KPI).&nbsp;&nbsp;</p><p>3. **Gestión de crisis durante la pandemia**: Durante los meses más críticos de 2020, contribuí a establecer protocolos eficientes para el trabajo remoto, asegurando que el 95% de los procesos operativos se mantuvieran sin interrupciones significativas.&nbsp;&nbsp;</p><p><br></p><p>Adicionalmente, mi desarrollo profesional ha sido constante. Este año, concluí una certificación en Gestión de Proyectos Ágiles (Scrum Master), una herramienta que ya he aplicado en diversos proyectos internos, contribuyendo a cumplir plazos críticos y a optimizar recursos.&nbsp;&nbsp;</p><p><br></p><p>Considero que estos resultados, junto con mi disposición para asumir nuevas responsabilidades y mi compromiso con los valores de Corporativo Innovación S.A., justifican una revisión de mi salario actual. Actualmente, mi remuneración mensual es de $25,000 MXN, y propongo un ajuste a $30,000 MXN, lo cual está alineado con las tendencias del mercado para mi puesto y con las responsabilidades que desempeño.&nbsp;&nbsp;</p><p><br></p><p>Entiendo que este tipo de decisiones implican un análisis detallado, y agradezco de antemano su tiempo para considerar esta solicitud. Estoy a su disposición para reunirnos y discutir en mayor detalle cualquier aspecto relacionado con esta propuesta.&nbsp;&nbsp;</p><p><br></p><p>Aprovecho la ocasión para reiterar mi agradecimiento por la confianza depositada en mí durante estos años. Es un honor formar parte de un equipo tan profesional y comprometido.&nbsp;&nbsp;</p><p><br></p><p>Quedo en espera de su respuesta.&nbsp;&nbsp;</p><p><br></p><p>Atentamente,&nbsp;&nbsp;</p><p><br></p><p>**Juan Pérez Gómez**&nbsp;&nbsp;</p><p>Analista de Procesos&nbsp;&nbsp;</p><p>Teléfono: 555-123-4567&nbsp;&nbsp;</p><p>Correo electrónico: juan.perez@innovacion.com&nbsp;&nbsp;</p>',5,26,NULL,3,'2024-11-20 13:46:58','2024-11-20 13:46:58',6);
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_respuesta`
--

LOCK TABLES `ticket_respuesta` WRITE;
/*!40000 ALTER TABLE `ticket_respuesta` DISABLE KEYS */;
INSERT INTO `ticket_respuesta` VALUES (57,142,'<p>Segui soñando gil</p><p><br></p>','1','2024-11-20 13:47:47','2024-11-20 13:47:47'),(58,142,'<p>Vaaaa</p>','lucianobadilla88@gmail.com','2024-11-20 13:48:08','2024-11-20 13:48:08'),(59,142,'<p>eh dale no me ignores</p>','1','2024-11-20 14:01:49','2024-11-20 14:01:49');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticketera_ticket`
--

LOCK TABLES `ticketera_ticket` WRITE;
/*!40000 ALTER TABLE `ticketera_ticket` DISABLE KEYS */;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Luciano Badilla','lucianobadilla88@gmail.com',NULL,'$2y$12$JkA/IIFbRVfdzsS1gOd4WOAze28a4L7KUJB0uWdK9olzLT0JzqMnC',NULL,'2024-10-01 12:27:05','2024-10-01 12:27:05');
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

-- Dump completed on 2024-11-20 11:18:59
