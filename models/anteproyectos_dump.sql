-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: anteproyectos
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `profilepic` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`idadmin`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','Administrador',NULL,'admin@admin',1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `idhistory` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` int(11) NOT NULL,
  `id_responsible` int(11) NOT NULL,
  `id_affected` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `message` text DEFAULT NULL,
  PRIMARY KEY (`idhistory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor` (
  `idprofessor` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `profilepic` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`idprofessor`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (1,'haflorez','92482d851920e3703851e1ab246c574d','Hector Arturo Florez',NULL,'haflorez@correo.udistrital.edu.co',1),(2,'osrozoc',NULL,'Oriana Susana Rozo Corzo',NULL,'osrozoc@correo.udistrital.edu.co',0),(3,'nmonroyr',NULL,'Natalia Monroy Rendón',NULL,'nmonroyr@correo.udistrital.edu.co',0),(4,'ejsierrah','75110a6fcea1a149b5509579d13c9e47','Erika Julieth Sierra Hormiga',NULL,'ejsierrah@correo.udistrital.edu.co',1),(5,'djsierrah','01ef664b9e994d0e22814d6597544a6b','Diana Janeth Sierra Hormiga',NULL,'djsierrah@correo.udistrital.edu.co',1);
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor_x_program`
--

DROP TABLE IF EXISTS `professor_x_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor_x_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professor` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  PRIMARY KEY (`id`,`professor`,`program`),
  KEY `fk_professor_has_program_program1_idx` (`program`),
  KEY `fk_professor_has_program_professor1_idx` (`professor`),
  CONSTRAINT `fk_professor_has_program_professor1` FOREIGN KEY (`professor`) REFERENCES `professor` (`idprofessor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_has_program_program1` FOREIGN KEY (`program`) REFERENCES `program` (`idprogram`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor_x_program`
--

LOCK TABLES `professor_x_program` WRITE;
/*!40000 ALTER TABLE `professor_x_program` DISABLE KEYS */;
INSERT INTO `professor_x_program` VALUES (1,1,2),(2,2,6),(3,3,1),(4,4,3),(5,5,5);
/*!40000 ALTER TABLE `professor_x_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `idprogram` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`idprogram`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (1,'Ingeniería de Sistemas',1),(2,'Ingeniería en Electrónica',1),(3,'Ingeniería Mecánica',1),(4,'Ingeniería Industrial',1),(5,'Ingeniería Ambiental',1),(6,'Danza y Actuacíon',1),(7,'Licenciatura en Educación Infantil',1),(8,'Arte Contemporáneo',1),(9,'Geodesia',1);
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `idprojects` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL,
  `abstract` text DEFAULT NULL,
  `problem_statement` text DEFAULT NULL,
  `objectives` text DEFAULT NULL,
  `pdf_url` varchar(400) NOT NULL,
  `state` varchar(45) NOT NULL,
  PRIMARY KEY (`idprojects`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'	Sistema web dinámico para la gestión de pedidos, fabricación y entrega de los productos metal-mecánicos en la Empresa Minacoples S.A.S','The purpose of the project was to develop a web system to advertise the products and services offered by the company Minacoples SAS, which is dedicated to general industrial maintenance with a focus on hydraulics, also to the commercialization and manufacture of metalworking parts. In addition, the web system had to have a subsystem integrated that allows managing company orders in a practical way and from a remote location. Therefore, the system must have a user registration and registration module and in turn provide users with the guarantee that their data will be handled well and will be protected. Also, the system must have a module to update user data, modules to manage (create, modify and delete) the products offered, which can only be accessed by the administrator user and modules for order management . Because the company not only sells prefabricated products, but also offers the manufacturing service from scratch according to the needs of the users, the prices of these services can vary greatly and it became necessary for the system to have a module that allows users Request a quote for a specific service. The project included a working environment with small modules that will help to perform a good maintenance of the system.','The purpose of the project was to develop a web system to advertise the products and services offered by the company Minacoples SAS, which is dedicated to general industrial maintenance with a focus on hydraulics, also to the commercialization and manufacture of metalworking parts. In addition, the web system had to have a subsystem integrated that allows managing company orders in a practical way and from a remote location. Therefore, the system must have a user registration and registration module and in turn provide users with the guarantee that their data will be handled well and will be protected. Also, the system must have a module to update user data, modules to manage (create, modify and delete) the products offered, which can only be accessed by the administrator user and modules for order management . Because the company not only sells prefabricated products, but also offers the manufacturing service from scratch according to the needs of the users, the prices of these services can vary greatly and it became necessary for the system to have a module that allows users Request a quote for a specific service. The project included a working environment with small modules that will help to perform a good maintenance of the system.','The purpose of the project was to develop a web system to advertise the products and services offered by the company Minacoples SAS, which is dedicated to general industrial maintenance with a focus on hydraulics, also to the commercialization and manufacture of metalworking parts. In addition, the web system had to have a subsystem integrated that allows managing company orders in a practical way and from a remote location. Therefore, the system must have a user registration and registration module and in turn provide users with the guarantee that their data will be handled well and will be protected. Also, the system must have a module to update user data, modules to manage (create, modify and delete) the products offered, which can only be accessed by the administrator user and modules for order management . Because the company not only sells prefabricated products, but also offers the manufacturing service from scratch according to the needs of the users, the prices of these services can vary greatly and it became necessary for the system to have a module that allows users Request a quote for a specific service. The project included a working environment with small modules that will help to perform a good maintenance of the system.','2020-02-19_06-46-01_WIN_20190611_06_58_38_Pro.jpg','4'),(2,'	Aplicativo móvil para la enseñanza de la programación aprende POO!P','In the following work the proposal of the MOBILE APPLICATION FOR THE TEACHING OF PROGRAMMING LEARN POO is released! P, which will be structured in different modules,these will have great support material focused specifically on basic concepts of object-oriented programming in the java language. It will be developed for students of curricular projects of the Universidad Francisco José de Caldas, developed by students and so that this application can be used as a knowledge reinforcement for their learning in programming oriented to objects, which include concepts such as: variables, constants, data types, data operators, control structure, repetitive structures, and more.','In the following work the proposal of the MOBILE APPLICATION FOR THE TEACHING OF PROGRAMMING LEARN POO is released! P, which will be structured in different modules,these will have great support material focused specifically on basic concepts of object-oriented programming in the java language. It will be developed for students of curricular projects of the Universidad Francisco José de Caldas, developed by students and so that this application can be used as a knowledge reinforcement for their learning in programming oriented to objects, which include concepts such as: variables, constants, data types, data operators, control structure, repetitive structures, and more.','In the following work the proposal of the MOBILE APPLICATION FOR THE TEACHING OF PROGRAMMING LEARN POO is released! P, which will be structured in different modules,these will have great support material focused specifically on basic concepts of object-oriented programming in the java language. It will be developed for students of curricular projects of the Universidad Francisco José de Caldas, developed by students and so that this application can be used as a knowledge reinforcement for their learning in programming oriented to objects, which include concepts such as: variables, constants, data types, data operators, control structure, repetitive structures, and more.','2020-02-19_06-50-30_WIN_20190611_06_58_38_Pro.jpg','2'),(3,'	Sistema de facturación para la empresa grupo empresarial L y M','	This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','	This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','	This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','2020-02-19_06-51-36_WIN_20190611_06_58_38_Pro.jpg','2'),(4,'project4','abstract','planteamiento','objetivos','2020-02-19_12-17-55_WIN_20180910_10_48_13_Pro.jpg','0'),(5,'project4','This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','2020-02-19_12-19-09_WIN_20190617_18_45_10_Pro.jpg','0'),(6,'project4','This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','This project was made in order to generate an optimal billing model for the company GRUPO EMPRESARIAL L Y M. providing a web tool that allows that to keep track of billing and finally optimize processes at the time of internal billing.','2020-02-19_12-19-32_WIN_20190617_18_45_21_Pro.jpg','0'),(7,'Proyecto de Cristian Daniel','Animating the Muses was the most fun I had during 20+ years at Disney.','Animating the Muses was the most fun I had during 20+ years at Disney.','Animating the Muses was the most fun I had during 20+ years at Disney.','2020-02-19_14-45-29_WIN_20190611_06_58_38_Pro.jpg','4'),(8,'Proyecto de Cristian Daniel 2','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Me','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Me','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Me','2020-02-19_14-50-05_WIN_20180910_10_48_13_Pro.jpg','2'),(9,'Proyecto de Cristian Daniel 3','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Meg','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Meg','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Meg','2020-02-19_14-50-27_WIN_20190626_10_44_50_Pro.jpg','0'),(10,'Proyecto de Cristian Daniel 4','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Megs song was a troubled production child then the directors decided to add the Muses. Anyway, there have been so many great versions of the Muses over the years. This is one of the most fun a','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Megs song was a troubled production child then the directors decided to add the Muses. Anyway, there have been so many great versions of the Muses over the years. This is one of the most fun a','Animating the Muses was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group was the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Megs song was a troubled production child then the directors decided to add the Muses. Anyway, there have been so many great versions of the Muses over the years. This is one of the most fun a','2020-02-19_15-08-05_WIN_20180910_10_48_13_Pro.jpg','0'),(11,'Proyecto de Cristian Daniel 5','Animating the Muses<b>bonito</b> was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group wasn\'t the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Meg\'s song was a troubled production child then the director\'s decided to add the Muses. Anyway, there have been so many great versions of the Muses over the years. This is one of the most fun a','Animating the Muses<b>bonito</b> was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group wasn\'t the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Meg\'s song was a troubled production child then the director\'s decided to add the Muses. Anyway, there have been so many great versions of the Muses over the years. This is one of the most fun a','Animating the Muses<b>bonito</b> was the most fun I had during 20+ years at Disney. Changing them from the traditional Greek Muses to a gospel chorus girl group wasn\'t the idea of brilliant Chicago native John Musker (director). The funny thing is they were originally considered the absolutely least important characters in the movie. If I remember there were not any plans to use them other than \"Zero to Hero\". Meg\'s song was a troubled production child then the director\'s decided to add the Muses. Anyway, there have been so many great versions of the Muses over the years. This is one of the most fun a','2020-02-19_15-41-42_WIN_20180910_10_48_13_Pro.jpg','0');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_x_professor`
--

DROP TABLE IF EXISTS `project_x_professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_x_professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professor` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`,`professor`,`project`),
  KEY `fk_project_has_professor_professor1_idx` (`professor`),
  KEY `fk_project_has_professor_project1_idx` (`project`),
  CONSTRAINT `fk_project_has_professor_professor1` FOREIGN KEY (`professor`) REFERENCES `professor` (`idprofessor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_has_professor_project1` FOREIGN KEY (`project`) REFERENCES `project` (`idprojects`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_x_professor`
--

LOCK TABLES `project_x_professor` WRITE;
/*!40000 ALTER TABLE `project_x_professor` DISABLE KEYS */;
INSERT INTO `project_x_professor` VALUES (1,4,1,0),(2,4,2,0),(3,1,3,0),(4,1,1,1),(5,4,7,0),(6,1,7,1),(7,1,8,0);
/*!40000 ALTER TABLE `project_x_professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_x_student`
--

DROP TABLE IF EXISTS `project_x_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_x_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`,`student`,`project`),
  KEY `fk_student_has_project_project1_idx` (`project`),
  KEY `fk_student_has_project_student1_idx` (`student`),
  CONSTRAINT `fk_student_has_project_project1` FOREIGN KEY (`project`) REFERENCES `project` (`idprojects`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_project_student1` FOREIGN KEY (`student`) REFERENCES `student` (`idstudent`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_x_student`
--

LOCK TABLES `project_x_student` WRITE;
/*!40000 ALTER TABLE `project_x_student` DISABLE KEYS */;
INSERT INTO `project_x_student` VALUES (1,1,1,0),(2,1,2,0),(3,1,3,0),(4,1,4,0),(5,1,5,0),(6,1,6,0),(7,4,7,0),(8,4,8,0),(9,4,9,0),(10,4,10,0),(11,4,11,0);
/*!40000 ALTER TABLE `project_x_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `idstudent` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `profilepic` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`idstudent`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'acsierrah','17258834ac15d6868a583a7957a4d8da','Andrés Camilo Sierra Hormiga',NULL,'camilo-hormiga@hotmail.com',1),(2,'mopereza',NULL,'Mario Orlando Pérez Almanza',NULL,'mopereza@correo.udistrital.edu.co',0),(3,'raul',NULL,'Rafael Alberto Urrego Lozada',NULL,'raul@correo.udistrital.edu.co',0),(4,'cdsierrah','a98b8d8d56c7354def982a0ed352bdc9','Cristian Daniel Sierra Hormiga',NULL,'cdsierrah_changed@correo.udistrital.edu.co',1);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_x_program`
--

DROP TABLE IF EXISTS `student_x_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_x_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  PRIMARY KEY (`id`,`student`,`program`),
  KEY `fk_student_has_program_program1_idx` (`program`),
  KEY `fk_student_has_program_student1_idx` (`student`),
  CONSTRAINT `fk_student_has_program_program1` FOREIGN KEY (`program`) REFERENCES `program` (`idprogram`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_program_student1` FOREIGN KEY (`student`) REFERENCES `student` (`idstudent`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_x_program`
--

LOCK TABLES `student_x_program` WRITE;
/*!40000 ALTER TABLE `student_x_program` DISABLE KEYS */;
INSERT INTO `student_x_program` VALUES (1,1,1),(2,2,7),(3,3,2),(4,4,3);
/*!40000 ALTER TABLE `student_x_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `idtag` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  PRIMARY KEY (`idtag`,`project`),
  KEY `fk_keywords_project1_idx` (`project`),
  CONSTRAINT `fk_keywords_project1` FOREIGN KEY (`project`) REFERENCES `project` (`idprojects`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-19 11:39:41
