# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Base de Dados: projeto_permissao
# Tempo de Geração: 2017-09-29 21:50:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela documentos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_tarefas`;

CREATE TABLE `tb_tarefas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` TEXT,
  `descricao` TEXT,
  `data_criacao` DATE,
  `data_conclusao` DATE DEFAULT NULL,
  `status` boolean,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tb_tarefas` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;

INSERT INTO `documentos` (`id`, `titulo`, `descricao`, `data_criacao`, `data_conclusao`, `status`)
VALUES
	(1,'Tarefa 1', 'descrição da tarefa 1', 'NOW()', '', 'false'),
	(2,'Tarefa 2', 'descrição da tarefa 2', 'NOW()', '', 'false'),
	(3,'Tarefa 3', 'descrição da tarefa 3', 'NOW()', '', 'false'),

/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `permissoes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id`, `email`, `senha`, `permissoes`)
VALUES
	(1,'romariogn10@gmail.com','698dc19d489c4e4db73e28a713eab07b','EDIT,ADD,DEL,SECRET');

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
