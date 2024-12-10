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
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ticketera_id` bigint NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'Desarrollo',4,'fa-terminal'),(2,'Mesa de ayuda',4,'fa-handshake-angle'),(3,'Tecnica',4,'fa-screwdriver-wrench');
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
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=455 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'abril.villatoro@hospital.uncu.edu.ar','abril','villatoro'),(2,'academica@hospital.uncu.edu.ar','academica@hospital','academica'),(3,'admin@hospital.uncu.edu.ar','admin@hospital','admin'),(4,'admision@hospital.uncu.edu.ar','admision@hospital','admision'),(5,'adolfo.civico@hospital.uncu.edu.ar','adolfo','civico'),(6,'adriana.carrion@hospital.uncu.edu.ar','adriana','carrion'),(7,'adriana.giaccaglia@hospital.uncu.edu.ar','adriana','giaccaglia'),(8,'agostina.altamiranda@hospital.uncu.edu.ar','agostina','altamiranda'),(9,'agustin.correa@hospital.uncu.edu.ar','agustin','correa'),(10,'agustin.grimalt@hospital.uncu.edu.ar','agustin','grimalt'),(11,'agustin.sagas@hospital.uncu.edu.ar','agustin','sagas'),(12,'agustin.smiraglia@hospital.uncu.edu.ar','agustin','smiraglia'),(13,'agustina.pereyra@hospital.uncu.edu.ar','agustina','pereyra'),(14,'albana.encinas@hospital.uncu.edu.ar','albana','encinas'),(15,'alberto.catoira@hospital.uncu.edu.ar','alberto','catoira'),(16,'alberto.vallone@hospital.uncu.edu.ar','alberto','vallone'),(17,'alejandra.anzorena@hospital.uncu.edu.ar','alejandra','anzorena'),(18,'alejandra.mampel@hospital.uncu.edu.ar','alejandra','mampel'),(19,'alejandra.palomeque@hospital.uncu.edu.ar','alejandra','palomeque'),(20,'alejandro.flores@hospital.uncu.edu.ar','alejandro','flores'),(21,'alejandro.saracco@hospital.uncu.edu.ar','alejandro','saracco'),(22,'alejandro.villarroel@hospital.uncu.edu.ar','alejandro','villarroel'),(23,'alejandro.wulfsztat@hospital.uncu.edu.ar','alejandro','wulfsztat'),(24,'alexander.saenz@hospital.uncu.edu.ar','alexander','saenz'),(25,'alfredo.julian@hospital.uncu.edu.ar','alfredo','julian'),(26,'alfredo.torres@hospital.uncu.edu.ar','alfredo','torres'),(27,'alicia.derimais@hospital.uncu.edu.ar','alicia','derimais'),(28,'ana.bort@hospital.uncu.edu.ar','ana','bort'),(29,'ana.carrenio@hospital.uncu.edu.ar','ana','carrenio'),(30,'ana.estrabon@hospital.uncu.edu.ar','ana','estrabon'),(31,'ana.fuente@hospital.uncu.edu.ar','ana','fuente'),(32,'ana.ulloa@hospital.uncu.edu.ar','ana','ulloa'),(33,'ana.villegas@hospital.uncu.edu.ar','ana','villegas'),(34,'analia.herrera@hospital.uncu.edu.ar','analia','herrera'),(35,'analia.molina@hospital.uncu.edu.ar','analia','molina'),(36,'anatomiapatologica@hospital.uncu.edu.ar','anatomiapatologica@hospital','anatomiapatologica'),(37,'andrea.garcia@hospital.uncu.edu.ar','andrea','garcia'),(38,'andrea.magarinios@hospital.uncu.edu.ar','andrea','magarinios'),(39,'andrea.martin@hospital.uncu.edu.ar','andrea','martin'),(40,'andrea.martinez@hospital.uncu.edu.ar','andrea','martinez'),(41,'andrea.raina@hospital.uncu.edu.ar','andrea','raina'),(42,'andrea.sabatini@hospital.uncu.edu.ar','andrea','sabatini'),(43,'andres.marcucci@hospital.uncu.edu.ar','andres','marcucci'),(44,'andres.robles@hospital.uncu.edu.ar','andres','robles'),(45,'anelisa.nevarro@hospital.uncu.edu.ar','anelisa','nevarro'),(46,'antonella.gallardo@hospital.uncu.edu.ar','antonella','gallardo'),(47,'ariel.herrera@hospital.uncu.edu.ar','ariel','herrera'),(48,'arturo.salassa@hospital.uncu.edu.ar','arturo','salassa'),(49,'axel.dalcolmo@hospital.uncu.edu.ar','axel','dalcolmo'),(50,'ayelen.carranza@hospital.uncu.edu.ar','ayelen','carranza'),(51,'beatriz.nunez@hospital.uncu.edu.ar','beatriz','nunez'),(52,'beatriz.ortiz@hospital.uncu.edu.ar','beatriz','ortiz'),(53,'belen.inostroza@hospital.uncu.edu.ar','belen','inostroza'),(54,'betiana.baez@hospital.uncu.edu.ar','betiana','baez'),(55,'betiana.carrivale@hospital.uncu.edu.ar','betiana','carrivale'),(56,'brenda.barbaro@hospital.uncu.edu.ar','brenda','barbaro'),(57,'brian.paez@hospital.uncu.edu.ar','brian','paez'),(58,'camila.murua@hospital.uncu.edu.ar','camila','murua'),(59,'candela.maida@hospital.uncu.edu.ar','candela','maida'),(60,'capacitacion@hospital.uncu.edu.ar','capacitacion@hospital','capacitacion'),(61,'carina.martinez@hospital.uncu.edu.ar','carina','martinez'),(62,'carla.aguilar@hospital.uncu.edu.ar','carla','aguilar'),(63,'carla.aliaga@hospital.uncu.edu.ar','carla','aliaga'),(64,'carla.roques@hospital.uncu.edu.ar','carla','roques'),(65,'carlos.carrizo@hospital.uncu.edu.ar','carlos','carrizo'),(66,'carlos.estrada@hospital.uncu.edu.ar','carlos','estrada'),(67,'carlos.fernandez@hospital.uncu.edu.ar','carlos','fernandez'),(68,'carlos.mendez@hospital.uncu.edu.ar','carlos','mendez'),(69,'carlos.mengoni@hospital.uncu.edu.ar','carlos','mengoni'),(70,'carlos.ramirez@hospital.uncu.edu.ar','carlos','ramirez'),(71,'carmen.flores@hospital.uncu.edu.ar','carmen','flores'),(72,'carmen.mendez@hospital.uncu.edu.ar','carmen','mendez'),(73,'carolina.bautista@hospital.uncu.edu.ar','carolina','bautista'),(74,'carolina.dutto@hospital.uncu.edu.ar','carolina','dutto'),(75,'carolina.miranda@hospital.uncu.edu.ar','carolina','miranda'),(76,'cecilia.arce@hospital.uncu.edu.ar','cecilia','arce'),(77,'cecilia.gimenez@hospital.uncu.edu.ar','cecilia','gimenez'),(78,'cecilia.perez@hospital.uncu.edu.ar','cecilia','perez'),(79,'cecilia.persia@hospital.uncu.edu.ar','cecilia','persia'),(80,'cecilia.smordel@hospital.uncu.edu.ar','cecilia','smordel'),(81,'cecilia.torres@hospital.uncu.edu.ar','cecilia','torres'),(82,'cecilia.velazquez@hospital.uncu.edu.ar','cecilia','velazquez'),(83,'ceis@hospital.uncu.edu.ar','ceis@hospital','ceis'),(84,'celeste.abaca@hospital.uncu.edu.ar','celeste','abaca'),(85,'celina.mallar@hospital.uncu.edu.ar','celina','mallar'),(86,'celina.martino@hospital.uncu.edu.ar','celina','martino'),(87,'celina.villabueva@hospital.uncu.edu.ar','celina','villabueva'),(88,'ceremonialyprotocolo@hospital.uncu.edu.ar','ceremonialyprotocolo@hospital','ceremonialyprotocolo'),(89,'cinthia.sosa@hospital.uncu.edu.ar','cinthia','sosa'),(90,'cinthia.tejada@hospital.uncu.edu.ar','cinthia','tejada'),(91,'cintia.sales@hospital.uncu.edu.ar','cintia','sales'),(92,'claudia.fernandez@hospital.uncu.edu.ar','claudia','fernandez'),(93,'comunicacion@hospital.uncu.edu.ar','comunicacion@hospital','comunicacion'),(94,'conrado.rissopatron@hospital.uncu.edu.ar','conrado','rissopatron'),(95,'controldegestion@hospital.uncu.edu.ar','controldegestion@hospital','controldegestion'),(96,'controldestock@hospital.uncu.edu.ar','controldestock@hospital','controldestock'),(97,'cristian.petriachi@hospital.uncu.edu.ar','cristian','petriachi'),(98,'cristian.reta@hospital.uncu.edu.ar','cristian','reta'),(99,'cristina.nafissi@hospital.uncu.edu.ar','cristina','nafissi'),(100,'cristina.viale@hospital.uncu.edu.ar','cristina','viale'),(101,'dalma.aparicio@hospital.uncu.edu.ar','dalma','aparicio'),(102,'damian.navarro@hospital.uncu.edu.ar','damian','navarro'),(103,'dana.lucero@hospital.uncu.edu.ar','dana','lucero'),(104,'daniel.contreras@hospital.uncu.edu.ar','daniel','contreras'),(105,'daniel.elias@hospital.uncu.edu.ar','daniel','elias'),(106,'daniela.berna@hospital.uncu.edu.ar','daniela','berna'),(107,'daniela.galiana@hospital.uncu.edu.ar','daniela','galiana'),(108,'daniela.pereyra@hospital.uncu.edu.ar','daniela','pereyra'),(109,'daniela.salinas@hospital.uncu.edu.ar','daniela','salinas'),(110,'daniela.zambelli@hospital.uncu.edu.ar','daniela','zambelli'),(111,'david.taboada@hospital.uncu.edu.ar','david','taboada'),(112,'ddjjhu@hospital.uncu.edu.ar','ddjjhu@hospital','ddjjhu'),(113,'desire.pasten@hospital.uncu.edu.ar','desire','pasten'),(114,'diego.insaurralde@hospital.uncu.edu.ar','diego','insaurralde'),(115,'diego.panella@hospital.uncu.edu.ar','diego','panella'),(116,'diego.videla@hospital.uncu.edu.ar','diego','videla'),(117,'direccion@hospital.uncu.edu.ar','direccion@hospital','direccion'),(118,'direccionadministrativa@hospital.uncu.edu.ar','direccionadministrativa@hospital','direccionadministrativa'),(119,'eduardo.figueroa@hospital.uncu.edu.ar','eduardo','figueroa'),(120,'eduardo.hart@hospital.uncu.edu.ar','eduardo','hart'),(121,'educacionalhu@hospital.uncu.edu.ar','educacionalhu@hospital','educacionalhu'),(122,'educacionvirtual@hospital.uncu.edu.ar','educacionvirtual@hospital','educacionvirtual'),(123,'eleonora.oros@hospital.uncu.edu.ar','eleonora','oros'),(124,'eliana.ghilardi@hospital.uncu.edu.ar','eliana','ghilardi'),(125,'elizabeth.chiarparin@hospital.uncu.edu.ar','elizabeth','chiarparin'),(126,'elizabeth.pinia@hospital.uncu.edu.ar','elizabeth','pinia'),(127,'emanuel.tejerina@hospital.uncu.edu.ar','emanuel','tejerina'),(128,'emilia.gorriz@hospital.uncu.edu.ar','emilia','gorriz'),(129,'enzo.belver@hospital.uncu.edu.ar','enzo','belver'),(130,'erica.flores@hospital.uncu.edu.ar','erica','flores'),(131,'erica.porcel@hospital.uncu.edu.ar','erica','porcel'),(132,'estela.umana@hospital.uncu.edu.ar','estela','umana'),(133,'esterilizacionhu@hospital.uncu.edu.ar','esterilizacionhu@hospital','esterilizacionhu'),(134,'eugenia.rubio@hospital.uncu.edu.ar','eugenia','rubio'),(135,'evelyn.dolonguevich@hospital.uncu.edu.ar','evelyn','dolonguevich'),(136,'ezequiel.mirallas@hospital.uncu.edu.ar','ezequiel','mirallas'),(137,'fabian.berducci@hospital.uncu.edu.ar','fabian','berducci'),(138,'fabian.sanchez@hospital.uncu.edu.ar','fabian','sanchez'),(139,'fabiana.aballay@hospital.uncu.edu.ar','fabiana','aballay'),(140,'fabiana.colucci@hospital.uncu.edu.ar','fabiana','colucci'),(141,'fabiana.moscoso@hospital.uncu.edu.ar','fabiana','moscoso'),(142,'fabiana.sayegh@hospital.uncu.edu.ar','fabiana','sayegh'),(143,'facturacion@hospital.uncu.edu.ar','facturacion@hospital','facturacion'),(144,'facturaciondigital@hospital.uncu.edu.ar','facturaciondigital@hospital','facturaciondigital'),(145,'farmacia@hospital.uncu.edu.ar','farmacia@hospital','farmacia'),(146,'federica.riveros@hospital.uncu.edu.ar','federica','riveros'),(147,'federico.nanfaro@hospital.uncu.edu.ar','federico','nanfaro'),(148,'federico.passardi@hospital.uncu.edu.ar','federico','passardi'),(149,'federico.torres@hospital.uncu.edu.ar','federico','torres'),(150,'felicitas.garma@hospital.uncu.edu.ar','felicitas','garma'),(151,'fernanda.sanchez@hospital.uncu.edu.ar','fernanda','sanchez'),(152,'flavio.albarracin@hospital.uncu.edu.ar','flavio','albarracin'),(153,'florencia.castro@hospital.uncu.edu.ar','florencia','castro'),(154,'florencia.dinardo@hospital.uncu.edu.ar','florencia','dinardo'),(155,'florencia.moreno@hospital.uncu.edu.ar','florencia','moreno'),(156,'florencia.nunez@hospital.uncu.edu.ar','florencia','nunez'),(157,'florencia.sanchez@hospital.uncu.edu.ar','florencia','sanchez'),(158,'florencia.segui@hospital.uncu.edu.ar','florencia','segui'),(159,'francisco.carrivale@hospital.uncu.edu.ar','francisco','carrivale'),(160,'francisco.cerezo@hospital.uncu.edu.ar','francisco','cerezo'),(161,'francisco.florentino@hospital.uncu.edu.ar','francisco','florentino'),(162,'francisco.lopresti@hospital.uncu.edu.ar','francisco','lopresti'),(163,'fundacionhospital@hospital.uncu.edu.ar','fundacionhospital@hospital','fundacionhospital'),(164,'fundacionhu@hospital.uncu.edu.ar','fundacionhu@hospital','fundacionhu'),(165,'gabriel.apra@hospital.uncu.edu.ar','gabriel','apra'),(166,'gabriel.farrando@hospital.uncu.edu.ar','gabriel','farrando'),(167,'gabriel.yamin@hospital.uncu.edu.ar','gabriel','yamin'),(168,'gabriela.arcos@hospital.uncu.edu.ar','gabriela','arcos'),(169,'gabriela.cavallo@hospital.uncu.edu.ar','gabriela','cavallo'),(170,'gabriela.dilorenzo@hospital.uncu.edu.ar','gabriela','dilorenzo'),(171,'gabriela.scalia@hospital.uncu.edu.ar','gabriela','scalia'),(172,'gerardo.carlucci@hospital.uncu.edu.ar','gerardo','carlucci'),(173,'gerardo.gimenez@hospital.uncu.edu.ar','gerardo','gimenez'),(174,'german.duci@hospital.uncu.edu.ar','german','duci'),(175,'german.migone@hospital.uncu.edu.ar','german','migone'),(176,'gestiondepersonas@hospital.uncu.edu.ar','gestiondepersonas@hospital','gestiondepersonas'),(177,'giovana.macello@hospital.uncu.edu.ar','giovana','macello'),(178,'gloria.polizzi@hospital.uncu.edu.ar','gloria','polizzi'),(179,'gonzalo.morales@hospital.uncu.edu.ar','gonzalo','morales'),(180,'gonzalo.nalda@hospital.uncu.edu.ar','gonzalo','nalda'),(181,'gonzalo.valdes@hospital.uncu.edu.ar','gonzalo','valdes'),(182,'graciela.acosta@hospital.uncu.edu.ar','graciela','acosta'),(183,'grecia.lara@hospital.uncu.edu.ar','grecia','lara'),(184,'guillermo.parlade@hospital.uncu.edu.ar','guillermo','parlade'),(185,'gustavo.giacomelli@hospital.uncu.edu.ar','gustavo','giacomelli'),(186,'gustavo.higginson@hospital.uncu.edu.ar','gustavo','higginson'),(187,'ham.xvajnshsu@hospital.uncu.edu.ar','ham','xvajnshsu'),(188,'heber.seebeock@hospital.uncu.edu.ar','heber','seebeock'),(189,'hector.ortiz@hospital.uncu.edu.ar','hector','ortiz'),(190,'huaucke.lucero@hospital.uncu.edu.ar','huaucke','lucero'),(191,'hugo.giolo@hospital.uncu.edu.ar','hugo','giolo'),(192,'humbertoguebara@hospital.uncu.edu.ar','humbertoguebara@hospital','humbertoguebara'),(193,'ignacio.estrada@hospital.uncu.edu.ar','ignacio','estrada'),(194,'ignacio.femenia@hospital.uncu.edu.ar','ignacio','femenia'),(195,'ignacio.vera@hospital.uncu.edu.ar','ignacio','vera'),(196,'indiana.morales@hospital.uncu.edu.ar','indiana','morales'),(197,'info@hospital.uncu.edu.ar','info@hospital','info'),(198,'informes.laboratorio@hospital.uncu.edu.ar','informes','laboratorio'),(199,'informes2@hospital.uncu.edu.ar','informes2@hospital','informes2'),(200,'internacion@hospital.uncu.edu.ar','internacion@hospital','internacion'),(201,'ismael.decarlini@hospital.uncu.edu.ar','ismael','decarlini'),(202,'ivan.groba@hospital.uncu.edu.ar','ivan','groba'),(203,'javier.ortego@hospital.uncu.edu.ar','javier','ortego'),(204,'jean.oliveri@hospital.uncu.edu.ar','jean','oliveri'),(205,'jesica.gispert@hospital.uncu.edu.ar','jesica','gispert'),(206,'joana.romero@hospital.uncu.edu.ar','joana','romero'),(207,'joaquin.gonzalez@hospital.uncu.edu.ar','joaquin','gonzalez'),(208,'johan.fader@hospital.uncu.edu.ar','johan','fader'),(209,'johana.chacon@hospital.uncu.edu.ar','johana','chacon'),(210,'johana.orcko@hospital.uncu.edu.ar','johana','orcko'),(211,'jorge.cueto@hospital.uncu.edu.ar','jorge','cueto'),(212,'jorge.hidalgo@hospital.uncu.edu.ar','jorge','hidalgo'),(213,'jorge.miller@hospital.uncu.edu.ar','jorge','miller'),(214,'jorge.suarez@hospital.uncu.edu.ar','jorge','suarez'),(215,'jorgelina.vidal@hospital.uncu.edu.ar','jorgelina','vidal'),(216,'jose.bobillo@hospital.uncu.edu.ar','jose','bobillo'),(217,'jose.valdez@hospital.uncu.edu.ar','jose','valdez'),(218,'jose.vera@hospital.uncu.edu.ar','jose','vera'),(219,'juan.contreras@hospital.uncu.edu.ar','juan','contreras'),(220,'juan.guevara@hospital.uncu.edu.ar','juan','guevara'),(221,'juan.longo@hospital.uncu.edu.ar','juan','longo'),(222,'juan.march@hospital.uncu.edu.ar','juan','march'),(223,'juan.retamoza@hospital.uncu.edu.ar','juan','retamoza'),(224,'juan.zarate@hospital.uncu.edu.ar','juan','zarate'),(225,'juieta.sanchez@hospital.uncu.edu.ar','juieta','sanchez'),(226,'julian.alegria@hospital.uncu.edu.ar','julian','alegria'),(227,'julian.armani@hospital.uncu.edu.ar','julian','armani'),(228,'julieta.meza@hospital.uncu.edu.ar','julieta','meza'),(229,'julieta.pezzutti@hospital.uncu.edu.ar','julieta','pezzutti'),(230,'juliette.marun@hospital.uncu.edu.ar','juliette','marun'),(231,'karen.hansen@hospital.uncu.edu.ar','karen','hansen'),(232,'karim.caanan@hospital.uncu.edu.ar','karim','caanan'),(233,'laboratorio@hospital.uncu.edu.ar','laboratorio@hospital','laboratorio'),(234,'laura.benitez@hospital.uncu.edu.ar','laura','benitez'),(235,'laura.flores@hospital.uncu.edu.ar','laura','flores'),(236,'laura.herrera@hospital.uncu.edu.ar','laura','herrera'),(237,'laura.muros@hospital.uncu.edu.ar','laura','muros'),(238,'laura.olmedo@hospital.uncu.edu.ar','laura','olmedo'),(239,'laureano.heredia@hospital.uncu.edu.ar','laureano','heredia'),(240,'leandro.trovarelli@hospital.uncu.edu.ar','leandro','trovarelli'),(241,'leticia.garcia@hospital.uncu.edu.ar','leticia','garcia'),(242,'liliana.reale@hospital.uncu.edu.ar','liliana','reale'),(243,'lis.mini@hospital.uncu.edu.ar','lis','mini'),(244,'lorena.miranda@hospital.uncu.edu.ar','lorena','miranda'),(245,'lorena.okstein@hospital.uncu.edu.ar','lorena','okstein'),(246,'lorena.parlade@hospital.uncu.edu.ar','lorena','parlade'),(247,'lorena.parra@hospital.uncu.edu.ar','lorena','parra'),(248,'lucas.castro@hospital.uncu.edu.ar','lucas','castro'),(249,'lucas.montiel@hospital.uncu.edu.ar','lucas','montiel'),(250,'lucas.vendrell@hospital.uncu.edu.ar','lucas','vendrell'),(251,'lucas.zelada@hospital.uncu.edu.ar','lucas','zelada'),(252,'luciana.fuentes@hospital.uncu.edu.ar','luciana','fuentes'),(253,'luciana.gomez@hospital.uncu.edu.ar','luciana','gomez'),(254,'luciana.marabini@hospital.uncu.edu.ar','luciana','marabini'),(255,'luciano.marquez@hospital.uncu.edu.ar','luciano','marquez'),(256,'luisina.guzman@hospital.uncu.edu.ar','luisina','guzman'),(257,'magdalena.rodriguez@hospital.uncu.edu.ar','magdalena','rodriguez'),(258,'mantenimiento@hospital.uncu.edu.ar','mantenimiento@hospital','mantenimiento'),(259,'marcela.berges@hospital.uncu.edu.ar','marcela','berges'),(260,'marcela.campione@hospital.uncu.edu.ar','marcela','campione'),(261,'marcela.fragapane@hospital.uncu.edu.ar','marcela','fragapane'),(262,'marcela.heredia@hospital.uncu.edu.ar','marcela','heredia'),(263,'marcela.martin@hospital.uncu.edu.ar','marcela','martin'),(264,'marcela.pizarro@hospital.uncu.edu.ar','marcela','pizarro'),(265,'marcela.romero@hospital.uncu.edu.ar','marcela','romero'),(266,'maria.alonso@hospital.uncu.edu.ar','maria','alonso'),(267,'maria.arrula@hospital.uncu.edu.ar','maria','arrula'),(268,'maria.bianchi@hospital.uncu.edu.ar','maria','bianchi'),(269,'maria.boldrini@hospital.uncu.edu.ar','maria','boldrini'),(270,'maria.buttitta@hospital.uncu.edu.ar','maria','buttitta'),(271,'maria.calatayud@hospital.uncu.edu.ar','maria','calatayud'),(272,'maria.caram@hospital.uncu.edu.ar','maria','caram'),(273,'maria.cia@hospital.uncu.edu.ar','maria','cia'),(274,'maria.contreras@hospital.uncu.edu.ar','maria','contreras'),(275,'maria.distefano@hospital.uncu.edu.ar','maria','distefano'),(276,'maria.erice@hospital.uncu.edu.ar','maria','erice'),(277,'maria.fabbro@hospital.uncu.edu.ar','maria','fabbro'),(278,'maria.ferretti@hospital.uncu.edu.ar','maria','ferretti'),(279,'maria.garces@hospital.uncu.edu.ar','maria','garces'),(280,'maria.gimenez@hospital.uncu.edu.ar','maria','gimenez'),(281,'maria.hoffman@hospital.uncu.edu.ar','maria','hoffman'),(282,'maria.ingrassia@hospital.uncu.edu.ar','maria','ingrassia'),(283,'maria.juarez@hospital.uncu.edu.ar','maria','juarez'),(284,'maria.julian@hospital.uncu.edu.ar','maria','julian'),(285,'maria.laguna@hospital.uncu.edu.ar','maria','laguna'),(286,'maria.larocca@hospital.uncu.edu.ar','maria','larocca'),(287,'maria.martin@hospital.uncu.edu.ar','maria','martin'),(288,'maria.navarro@hospital.uncu.edu.ar','maria','navarro'),(289,'maria.negri@hospital.uncu.edu.ar','maria','negri'),(290,'maria.oppoliti@hospital.uncu.edu.ar','maria','oppoliti'),(291,'maria.ortiz@hospital.uncu.edu.ar','maria','ortiz'),(292,'maria.papini@hospital.uncu.edu.ar','maria','papini'),(293,'maria.pignolo@hospital.uncu.edu.ar','maria','pignolo'),(294,'maria.regallo@hospital.uncu.edu.ar','maria','regallo'),(295,'maria.rodriguez@hospital.uncu.edu.ar','maria','rodriguez'),(296,'maria.silva@hospital.uncu.edu.ar','maria','silva'),(297,'maria.sirera@hospital.uncu.edu.ar','maria','sirera'),(298,'maria.terraza@hospital.uncu.edu.ar','maria','terraza'),(299,'maria.valpreda@hospital.uncu.edu.ar','maria','valpreda'),(300,'maria.vener@hospital.uncu.edu.ar','maria','vener'),(301,'mariana.andino@hospital.uncu.edu.ar','mariana','andino'),(302,'mariana.carrizo@hospital.uncu.edu.ar','mariana','carrizo'),(303,'mariana.cerdan@hospital.uncu.edu.ar','mariana','cerdan'),(304,'mariana.martinez@hospital.uncu.edu.ar','mariana','martinez'),(305,'mariana.perez@hospital.uncu.edu.ar','mariana','perez'),(306,'mariano.ardisana@hospital.uncu.edu.ar','mariano','ardisana'),(307,'mariela.paez@hospital.uncu.edu.ar','mariela','paez'),(308,'mariela.velez@hospital.uncu.edu.ar','mariela','velez'),(309,'marina.monsalvo@hospital.uncu.edu.ar','marina','monsalvo'),(310,'marisa.oro@hospital.uncu.edu.ar','marisa','oro'),(311,'marta.livellara@hospital.uncu.edu.ar','marta','livellara'),(312,'martin.buenanueva@hospital.uncu.edu.ar','martin','buenanueva'),(313,'martin.gonzalez@hospital.uncu.edu.ar','martin','gonzalez'),(314,'martin.laredo@hospital.uncu.edu.ar','martin','laredo'),(315,'martin.rojas@hospital.uncu.edu.ar','martin','rojas'),(316,'martin.toro@hospital.uncu.edu.ar','martin','toro'),(317,'matias.aguilar@hospital.uncu.edu.ar','matias','aguilar'),(318,'matias.godoy@hospital.uncu.edu.ar','matias','godoy'),(319,'matias.miranda@hospital.uncu.edu.ar','matias','miranda'),(320,'matias.papini@hospital.uncu.edu.ar','matias','papini'),(321,'mauricio.martinez@hospital.uncu.edu.ar','mauricio','martinez'),(322,'mauricio.mayorga@hospital.uncu.edu.ar','mauricio','mayorga'),(323,'mauricio.olivares@hospital.uncu.edu.ar','mauricio','olivares'),(324,'mauro.goncalves@hospital.uncu.edu.ar','mauro','goncalves'),(325,'mayra.vega@hospital.uncu.edu.ar','mayra','vega'),(326,'medicinainternahu@hospital.uncu.edu.ar','medicinainternahu@hospital','medicinainternahu'),(327,'melanie.araujo@hospital.uncu.edu.ar','melanie','araujo'),(328,'melanie.pafundo@hospital.uncu.edu.ar','melanie','pafundo'),(329,'melina.buzon@hospital.uncu.edu.ar','melina','buzon'),(330,'melina.mercau@hospital.uncu.edu.ar','melina','mercau'),(331,'melisa.fuentes@hospital.uncu.edu.ar','melisa','fuentes'),(332,'mensajes@hospital.uncu.edu.ar','mensajes@hospital','mensajes'),(333,'mesadeayuda@hospital.uncu.edu.ar','mesadeayuda@hospital','mesadeayuda'),(334,'mesadeentrada@hospital.uncu.edu.ar','mesadeentrada@hospital','mesadeentrada'),(335,'micaela.frusin@hospital.uncu.edu.ar','micaela','frusin'),(336,'micaela.ramirez@hospital.uncu.edu.ar','micaela','ramirez'),(337,'milagros.diez@hospital.uncu.edu.ar','milagros','diez'),(338,'mirta.leucrini@hospital.uncu.edu.ar','mirta','leucrini'),(339,'moodle@hospital.uncu.edu.ar','moodle@hospital','moodle'),(340,'nadya.livellara@hospital.uncu.edu.ar','nadya','livellara'),(341,'nara.derra@hospital.uncu.edu.ar','nara','derra'),(342,'natacha.manzitti@hospital.uncu.edu.ar','natacha','manzitti'),(343,'natalia.bonilla@hospital.uncu.edu.ar','natalia','bonilla'),(344,'natalia.daher@hospital.uncu.edu.ar','natalia','daher'),(345,'natalia.opasso@hospital.uncu.edu.ar','natalia','opasso'),(346,'natalia.veliz@hospital.uncu.edu.ar','natalia','veliz'),(347,'nazarena.asus@hospital.uncu.edu.ar','nazarena','asus'),(348,'nelson.gabrielli@hospital.uncu.edu.ar','nelson','gabrielli'),(349,'nicolas.cangiani@hospital.uncu.edu.ar','nicolas','cangiani'),(350,'nicolas.carrasco@hospital.uncu.edu.ar','nicolas','carrasco'),(351,'nicolas.quintana@hospital.uncu.edu.ar','nicolas','quintana'),(352,'nicolena.andrioli@hospital.uncu.edu.ar','nicolena','andrioli'),(353,'noelia.paura@hospital.uncu.edu.ar','noelia','paura'),(354,'noelia.villarroel@hospital.uncu.edu.ar','noelia','villarroel'),(355,'noelia.zavala@hospital.uncu.edu.ar','noelia','zavala'),(356,'odontologia@hospital.uncu.edu.ar','odontologia@hospital','odontologia'),(357,'ordenesdamsuhu@hospital.uncu.edu.ar','ordenesdamsuhu@hospital','ordenesdamsuhu'),(358,'orlando.pardo@hospital.uncu.edu.ar','orlando','pardo'),(359,'pablo.bengolea@hospital.uncu.edu.ar','pablo','bengolea'),(360,'pablo.carral@hospital.uncu.edu.ar','pablo','carral'),(361,'pablo.gonzalez@hospital.uncu.edu.ar','pablo','gonzalez'),(362,'pablo.nervegna@hospital.uncu.edu.ar','pablo','nervegna'),(363,'pablo.tourn@hospital.uncu.edu.ar','pablo','tourn'),(364,'pagosfhu@hospital.uncu.edu.ar','pagosfhu@hospital','pagosfhu'),(365,'pamela.romero@hospital.uncu.edu.ar','pamela','romero'),(366,'pamela.salinas@hospital.uncu.edu.ar','pamela','salinas'),(367,'paola.estalles@hospital.uncu.edu.ar','paola','estalles'),(368,'patricia.chirino@hospital.uncu.edu.ar','patricia','chirino'),(369,'patricia.fernandez@hospital.uncu.edu.ar','patricia','fernandez'),(370,'patrimonio@hospital.uncu.edu.ar','patrimonio@hospital','patrimonio'),(371,'paula.benitez@hospital.uncu.edu.ar','paula','benitez'),(372,'paula.font@hospital.uncu.edu.ar','paula','font'),(373,'paula.gonzalez@hospital.uncu.edu.ar','paula','gonzalez'),(374,'raul.castro@hospital.uncu.edu.ar','raul','castro'),(375,'rebeca.medina@hospital.uncu.edu.ar','rebeca','medina'),(376,'recetas@hospital.uncu.edu.ar','recetas@hospital','recetas'),(377,'ricardo.maugeri@hospital.uncu.edu.ar','ricardo','maugeri'),(378,'ricardo.vergara@hospital.uncu.edu.ar','ricardo','vergara'),(379,'rita.valpreda@hospital.uncu.edu.ar','rita','valpreda'),(380,'roberto.coll@hospital.uncu.edu.ar','roberto','coll'),(381,'roberto.winter@hospital.uncu.edu.ar','roberto','winter'),(382,'rocio.chavalier@hospital.uncu.edu.ar','rocio','chavalier'),(383,'rocio.lopez@hospital.uncu.edu.ar','rocio','lopez'),(384,'romina.crivelli@hospital.uncu.edu.ar','romina','crivelli'),(385,'rosa.giunta@hospital.uncu.edu.ar','rosa','giunta'),(386,'rosa.leon@hospital.uncu.edu.ar','rosa','leon'),(387,'roxana.fioravanti@hospital.uncu.edu.ar','roxana','fioravanti'),(388,'rrhh@hospital.uncu.edu.ar','rrhh@hospital','rrhh'),(389,'ruben.canaan@hospital.uncu.edu.ar','ruben','canaan'),(390,'rxod@hospital.uncu.edu.ar','rxod@hospital','rxod'),(391,'rxodontologicos@hospital.uncu.edu.ar','rxodontologicos@hospital','rxodontologicos'),(392,'sabrina.ramirez@hospital.uncu.edu.ar','sabrina','ramirez'),(393,'sandra.dametto@hospital.uncu.edu.ar','sandra','dametto'),(394,'sandra.fernandez@hospital.uncu.edu.ar','sandra','fernandez'),(395,'sandra.perez@hospital.uncu.edu.ar','sandra','perez'),(396,'sasha.bricker@hospital.uncu.edu.ar','sasha','bricker'),(397,'sebastian.rauek@hospital.uncu.edu.ar','sebastian','rauek'),(398,'sebastian.suarez@hospital.uncu.edu.ar','sebastian','suarez'),(399,'seguimientocovid@hospital.uncu.edu.ar','seguimientocovid@hospital','seguimientocovid'),(400,'selma.silva@hospital.uncu.edu.ar','selma','silva'),(401,'sergio.furlan@hospital.uncu.edu.ar','sergio','furlan'),(402,'sergio.vergara@hospital.uncu.edu.ar','sergio','vergara'),(403,'silvana.bottoni@hospital.uncu.edu.ar','silvana','bottoni'),(404,'silvana.genovese@hospital.uncu.edu.ar','silvana','genovese'),(405,'silvana.pagliarulo@hospital.uncu.edu.ar','silvana','pagliarulo'),(406,'silvana.ruggeri@hospital.uncu.edu.ar','silvana','ruggeri'),(407,'silvana.semino@hospital.uncu.edu.ar','silvana','semino'),(408,'silvina.candela@hospital.uncu.edu.ar','silvina','candela'),(409,'silvina.juarez@hospital.uncu.edu.ar','silvina','juarez'),(410,'sofia.dacosta@hospital.uncu.edu.ar','sofia','dacosta'),(411,'sol.sttoco@hospital.uncu.edu.ar','sol','sttoco'),(412,'soledad.kent@hospital.uncu.edu.ar','soledad','kent'),(413,'soledad.yarzabal@hospital.uncu.edu.ar','soledad','yarzabal'),(414,'soraya.cherlo@hospital.uncu.edu.ar','soraya','cherlo'),(415,'spam.szqwlxruni@hospital.uncu.edu.ar','spam','szqwlxruni'),(416,'susana.gutierrez@hospital.uncu.edu.ar','susana','gutierrez'),(417,'suyay.arena@hospital.uncu.edu.ar','suyay','arena'),(418,'tamara.tobares@hospital.uncu.edu.ar','tamara','tobares'),(419,'thelma.guinazu@hospital.uncu.edu.ar','thelma','guinazu'),(420,'ticiana.sammito@hospital.uncu.edu.ar','ticiana','sammito'),(421,'tobias.deltin@hospital.uncu.edu.ar','tobias','deltin'),(422,'vacunatorio@hospital.uncu.edu.ar','vacunatorio@hospital','vacunatorio'),(423,'valentina.arce@hospital.uncu.edu.ar','valentina','arce'),(424,'valentina.villarreal@hospital.uncu.edu.ar','valentina','villarreal'),(425,'valeria.alonso@hospital.uncu.edu.ar','valeria','alonso'),(426,'valeria.fragapane@hospital.uncu.edu.ar','valeria','fragapane'),(427,'valeria.laurenti@hospital.uncu.edu.ar','valeria','laurenti'),(428,'valeria.rincon@hospital.uncu.edu.ar','valeria','rincon'),(429,'veronica.bordeira@hospital.uncu.edu.ar','veronica','bordeira'),(430,'veronica.giuliani@hospital.uncu.edu.ar','veronica','giuliani'),(431,'veronica.gomez@hospital.uncu.edu.ar','veronica','gomez'),(432,'veronica.lepe@hospital.uncu.edu.ar','veronica','lepe'),(433,'veronica.navarro@hospital.uncu.edu.ar','veronica','navarro'),(434,'veronica.rodio@hospital.uncu.edu.ar','veronica','rodio'),(435,'veronica.velez@hospital.uncu.edu.ar','veronica','velez'),(436,'veronica.zarate@hospital.uncu.edu.ar','veronica','zarate'),(437,'victor.fabrega@hospital.uncu.edu.ar','victor','fabrega'),(438,'victoria.diumenjo@hospital.uncu.edu.ar','victoria','diumenjo'),(439,'victoria.gonzalez@hospital.uncu.edu.ar','victoria','gonzalez'),(440,'virginia.giuliani@hospital.uncu.edu.ar','virginia','giuliani'),(441,'virus-quarantine.6frtgdrm@hospital.uncu.edu.ar','virus-quarantine','6frtgdrm'),(442,'viviana.chapier@hospital.uncu.edu.ar','viviana','chapier'),(443,'walter.frajberg@hospital.uncu.edu.ar','walter','frajberg'),(444,'walter.rosales@hospital.uncu.edu.ar','walter','rosales'),(445,'xavier.navarro@hospital.uncu.edu.ar','xavier','navarro'),(446,'yamila.chacon@hospital.uncu.edu.ar','yamila','chacon'),(447,'yanina.roslan@hospital.uncu.edu.ar','yanina','roslan'),(448,'yesica.perez@hospital.uncu.edu.ar','yesica','perez'),(449,'yesica.prieto@hospital.uncu.edu.ar','yesica','prieto'),(450,'yogendy.manoche@hospital.uncu.edu.ar','yogendy','manoche'),(451,'yolanda.pozzo@hospital.uncu.edu.ar','yolanda','pozzo'),(452,'luciano.badilla@hospital.uncu.edu.ar','luciano','badilla'),(453,'juan.filippini@hospital.uncu.edu.ar','Juan Cruz','Filippini'),(454,'juan.charparin@hospital.uncu.edu.ar','Juan Carlos','Charparin');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Facturación'),(2,'Tesorería'),(3,'Mantenimiento'),(4,'Dirección General'),(5,'Dirección Académica'),(6,'Dirección Asistencial'),(7,'Dirección Administrativa'),(8,'Contabilidad'),(9,'Call Center'),(10,'Admisión'),(11,'Despacho'),(12,'RRHH'),(13,'Farmacia'),(14,'Laboratorio'),(15,'Comunicación Institucional'),(16,'Informes'),(17,'Mesa de entradas'),(18,'Anatomía patológica'),(19,'Tecnología biomédica'),(20,'Rayos'),(21,'Guardia Médica'),(22,'Odontología'),(23,'Secretaría Sector Amarillo'),(24,'Tics'),(25,'Consultorios'),(26,'Patrimonio'),(27,'Gestión de Personas'),(28,'Compras'),(29,'Rehabilitación'),(30,'Traumatología'),(31,'UDA'),(32,'Enfermería'),(33,'Shock Room'),(34,'Cardiología'),(35,'Microbiología'),(36,'Hematología'),(37,'Vacunatorio'),(38,'Recepción'),(39,'Biotecnología'),(40,'Fundación HU'),(41,'Coordinación Económica Financiera'),(42,'Comercialización'),(43,'Control de Gestión'),(44,'Seguridad e Higiene'),(45,'Estadística y Procesos Hospitalarios'),(46,'Jefatura de Call Center, Informes y Secretaría de Odontología'),(47,'EPH (EN DESHUSO|NO USAR)'),(48,'Unidad Quirurgica'),(49,'Esterilización'),(50,'Internación'),(51,'Admisión Internación'),(52,'Enfermaría Internación'),(53,'Lavanderia'),(54,'Auditoría Médica');
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
  `icon` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Pendiente','fa-clock','en espera'),(2,'Respondido por cliente','fa-comment','respuestas recibidas'),(3,'Respondido por el staff','fa-user','en proceso de resolución'),(4,'Cerrado','fa-circle-check','casos finalizados');
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
INSERT INTO `rol` VALUES (1,'Staff'),(2,'Administrador');
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
INSERT INTO `sessions` VALUES ('7LYkjyr357j6iWScTYHRLZyO3IKsPDv6s25Sw8Bq',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjh6amU2aGNpdTA5SHp4ZDIxTlRxRUVHZ2hGSFdyQm9Yd1NkUlphdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvdGlja2V0ZXJhSFUvcHVibGljL3JlZ2lzdGVyIjt9fQ==',1733840673),('9gZhJXgSXr6dKp3WsgOhQEIpKiDFAeM0aY5KSjtq',NULL,'172.22.116.158','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnRSQ2x0dTVyZ3JzaGtwNzN4RXBjNkZJa3NvdmJKS1oxcTZUQW1tWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xNzIuMjIuMTE1LjEwMy90aWNrZXRlcmFIVS9wdWJsaWMvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1733840942),('k8yi0f8drlvtcTkiZ7CUf3IZOTuEHUhCEgcOKVqO',NULL,'172.22.117.170','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmEyUGVncjhrVU1pUjMwRnN3UFhkUkhvT0dUSm5tMEtoUzN4V0JtdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xNzIuMjIuMTE1LjEwMy90aWNrZXRlcmFIVS9wdWJsaWMvdmlldy84Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1733841764),('MLVPGQPrtvt3ZYuzsoOQDY0FtDHt7csTtSWMLrwV',10,'172.22.116.35','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZjlIR0xvekQ0U1R3UnRwdEtpSmpXM3FoSFowMFBqZnZSeFRBZUQ4MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM4OiJodHRwOi8vMTcyLjIyLjExNS4xMDMvdGlja2V0ZXJhSFUvcHVibGljL25ld190aWNrZXQvaWQ/ZGV0YWxsZT1CaWVudmVuaWRvJTIwYSUyMG51ZXN0cm8lMjBTaXN0ZW1hJTIwZGUlMjBNZXNhJTIwZGUlMjBBeXVkYS4lMjBFbCUyMFNpc3RlbWElMjBsZSUyMGF5dWRhciVDMyVBMSUyMGElMjBwb25lcnNlJTIwZW4lMjBjb250YWN0byUyMGNvbiUyMG5vc290cm9zJTIwcG9yJTIwdG9kYXMlMjBzdXMlMjBjb25zdWx0YXMlMjB5JTIwb2J0ZW5lciUyMHJlc3B1ZXN0YXMlMjBpbm1lZGlhdGFzJTIwYSUyMGVsbGFzLiUwRCUwQSUwRCUwQVJlY3VlcmRlJTIwdXRpbGl6YXIlMjBlbCUyMGNvcnJlbyUyMGluc3RpdHVjaW9uYWwlMjBwYXJhJTIwcmVhbGl6YXIlMjBlbCUyMHBlZGlkbyUyMGRlJTIwYXNpc3RlbmNpYS4lMjBFaiUzQSUyMG5vbWJyZS5hcGVsbGlkbyU0MGhvc3BpdGFsLnVuY3UuZWR1LmFyJTBEJTBBJTBEJTBBQ29uJTIwZWwlMjBmaW4lMjBkZSUyMGFicmlyJTIwdW4lMjB0aWNrZXQlMjBkZSUyMHNvcG9ydGUlMkMlMjBwb3IlMjBmYXZvciUyMHNlbGVjY2lvbmUlMjB1biUyMGRlcGFydGFtZW50by4maWQ9NCZ0aXR1bG89VGVjbm9sb2clQzMlQURhJTIweSUwRCUwQSUyMENvbXVuaWNhY2lvbmVzJTIwJTI4VElDUyUyOSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=',1733842554),('sGHWrjHfPBzj093YFshhtmZEdPea7DC19ko4cvTI',11,'172.22.114.16','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXhyekFBc0ZxVWFMdmdsVnNiWlNKVlpEdG82bHNCcU9vek9iVGd6SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xNzIuMjIuMTE1LjEwMy90aWNrZXRlcmFIVS9wdWJsaWMvYWRtaW4vdGlja2V0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=',1733843220),('TlPnuecPAZysXXzcKN3IlNtcpcMoaLmG6zQCx5oL',9,'172.22.116.159','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaFp4dUJPTXdOZGNyOURJOHhYeTRhU2k2WUlRWUxxYWE5MUZPTmEyWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly8xNzIuMjIuMTE1LjEwMy90aWNrZXRlcmFIVS9wdWJsaWMvYWRtaW4vdGlja2V0c19hcmVhX2VzdGFkbyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==',1733845726),('Vr8ZQXOdZr5FbjZ1FDHTXB928iPseURHeh5P014g',4,'172.22.115.103','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoianZZRVFiTTRVbFgwSDZhbWZmcHNGV3FiMjdJbEgwUWRFOWljMno1OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly8xNzIuMjIuMTE1LjEwMy90aWNrZXRlcmFIVS9wdWJsaWMvYWRtaW4vdGlja2V0c19hcmVhX2VzdGFkbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==',1733847777);
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
  `cuerpo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `estado_id` int DEFAULT '2',
  `departamento_id` int DEFAULT NULL,
  `cliente_id` int DEFAULT NULL,
  `prioridad_id` int DEFAULT '3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_problema_id` bigint DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `cerrado_por` bigint DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_respuesta`
--

LOCK TABLES `ticket_respuesta` WRITE;
/*!40000 ALTER TABLE `ticket_respuesta` DISABLE KEYS */;
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
  `rol_id` bigint NOT NULL DEFAULT '1',
  `ticketera_id` bigint NOT NULL,
  `validated` binary(1) NOT NULL DEFAULT '0',
  `requestsPassword` binary(1) NOT NULL DEFAULT '0',
  `recibe_emails` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@hospital.uncu.edu.ar',NULL,'$2y$12$NyJrGUZ9JEA50YsFc5jByO9KodLDAmQBBGp/sbInP5hJglUvPltga',NULL,'2024-12-03 13:09:24','2024-12-03 13:09:24',2,1,_binary '1',_binary '0',0),(2,'admin','admin@hospital.uncu.edu.ar',NULL,'$2y$12$NyJrGUZ9JEA50YsFc5jByO9KodLDAmQBBGp/sbInP5hJglUvPltga',NULL,'2024-12-03 13:09:24','2024-12-03 13:09:24',2,2,_binary '1',_binary '0',0),(3,'admin','admin@hospital.uncu.edu.ar',NULL,'$2y$12$NyJrGUZ9JEA50YsFc5jByO9KodLDAmQBBGp/sbInP5hJglUvPltga',NULL,'2024-12-03 13:09:24','2024-12-03 13:09:24',2,3,_binary '1',_binary '0',0),(4,'admin','admin@hospital.uncu.edu.ar',NULL,'$2y$12$NyJrGUZ9JEA50YsFc5jByO9KodLDAmQBBGp/sbInP5hJglUvPltga',NULL,'2024-12-03 13:09:24','2024-12-10 14:32:23',2,4,_binary '1',_binary '0',0),(5,'admin','admin@hospital.uncu.edu.ar',NULL,'$2y$12$NyJrGUZ9JEA50YsFc5jByO9KodLDAmQBBGp/sbInP5hJglUvPltga',NULL,'2024-12-03 13:09:24','2024-12-03 13:09:24',2,5,_binary '1',_binary '0',0),(6,'admin','admin@hospital.uncu.edu.ar',NULL,'$2y$12$NyJrGUZ9JEA50YsFc5jByO9KodLDAmQBBGp/sbInP5hJglUvPltga',NULL,'2024-12-03 13:09:24','2024-12-03 13:09:24',2,6,_binary '1',_binary '0',0),(7,'admin','admin@hospital.uncu.edu.ar',NULL,'$2y$12$NyJrGUZ9JEA50YsFc5jByO9KodLDAmQBBGp/sbInP5hJglUvPltga',NULL,'2024-12-03 13:09:24','2024-12-03 13:09:24',2,7,_binary '1',_binary '0',0),(8,'Luisina Guzman','luisinaguzman97@gmail.com',NULL,'$2y$12$mwPDor4GM4oYlbNzGLhSD.rfh9Asb6WrMGLrfvhmKxqyi9Lj6A0E6',NULL,'2024-12-10 14:29:02','2024-12-10 14:43:58',2,4,_binary '1',_binary '0',0),(9,'Cristian Reta','cristian.reta@hospital.uncu.edu.ar',NULL,'$2y$12$N/VJX1QcvAPf7nMgvr7WaOiQM4oT5nIk57NYr2v0ulWcHq32BjUcm',NULL,'2024-12-10 14:29:47','2024-12-10 16:20:24',2,4,_binary '1',_binary '0',1),(10,'Juan Cruz Filippini','juancruz.filippini@hospital.uncu.edu.ar',NULL,'$2y$12$1JtNWQi4BB3mBqBYrzemneenAf2Q8Q9eJTtdBBphLXfgA1Ck2eF62',NULL,'2024-12-10 14:32:44','2024-12-10 14:33:56',1,4,_binary '1',_binary '0',0),(11,'Alberto Catoira','alberto.catoira@hospital.uncu.edu.ar',NULL,'$2y$12$7iN5aD/LN7hE95IWqj6aDe0c/0tdrMbDGAR4pPTTPWbdlMSUemWJ2',NULL,'2024-12-10 14:33:34','2024-12-10 16:20:20',2,4,_binary '1',_binary '0',1);
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

-- Dump completed on 2024-12-10 13:23:09
