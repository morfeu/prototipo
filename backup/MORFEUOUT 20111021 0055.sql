-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.41


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema morfeu1
--

CREATE DATABASE IF NOT EXISTS morfeu1;
USE morfeu1;

--
-- Definition of table `container`
--

DROP TABLE IF EXISTS `container`;
CREATE TABLE `container` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idsecao` int(10) unsigned NOT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `idtemplate` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_container_1` (`idsecao`),
  CONSTRAINT `FK_container_1` FOREIGN KEY (`idsecao`) REFERENCES `secao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `container`
--

/*!40000 ALTER TABLE `container` DISABLE KEYS */;
INSERT INTO `container` (`id`,`idsecao`,`alias`,`idtemplate`) VALUES 
 (30,30,'Container Principal',1),
 (31,31,'Container Principal',1),
 (32,32,'Container Principal',1),
 (33,33,'Container Principal',1),
 (34,34,'Container Principal',1),
 (35,37,'Container Principal',1),
 (36,35,'Container Secao Pag Deb y',1),
 (37,38,'Container Principal',1);
/*!40000 ALTER TABLE `container` ENABLE KEYS */;


--
-- Definition of table `etapa`
--

DROP TABLE IF EXISTS `etapa`;
CREATE TABLE `etapa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(45) NOT NULL,
  `idcontainer` int(10) unsigned NOT NULL,
  `idetapa` int(10) unsigned NOT NULL,
  `max` int(10) unsigned NOT NULL DEFAULT '1',
  `min` int(10) unsigned NOT NULL DEFAULT '0',
  `rotulo` varchar(100) NOT NULL DEFAULT 'Postar',
  PRIMARY KEY (`id`),
  KEY `FK_post_1` (`idcontainer`),
  CONSTRAINT `FK_post_1` FOREIGN KEY (`idcontainer`) REFERENCES `container` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etapa`
--

/*!40000 ALTER TABLE `etapa` DISABLE KEYS */;
INSERT INTO `etapa` (`id`,`alias`,`idcontainer`,`idetapa`,`max`,`min`,`rotulo`) VALUES 
 (63,'Notícia',30,0,99,0,'Criar Notícia'),
 (64,'Comentário',30,63,99,0,'Comentar'),
 (65,'Notícia',31,0,99,0,'Criar Notícia'),
 (66,'Comentário',31,65,99,0,'Comentar'),
 (67,'Notícia',32,0,99,0,'Criar Notícia'),
 (68,'Comentário',32,67,99,0,'Comentar'),
 (69,'Notícia',33,0,99,0,'Criar Notícia'),
 (70,'Comentário',33,69,99,0,'Comentar'),
 (71,'Tese',34,0,99,0,'Criar Tese'),
 (72,'Argumento',34,74,1,0,'Argumentar'),
 (73,'Revisao1',34,72,1,0,'Criar Revisão'),
 (74,'Posicionamento Inicial',34,71,1,0,'Posicionamento'),
 (75,'Revisao2',34,72,1,0,'Criar Revisão'),
 (76,'Posicionamento Final',34,72,1,0,'Posicionamento Final'),
 (77,'Replica1',34,73,1,0,'Criar Réplica'),
 (78,'Replica2',34,75,1,0,'Criar Réplica'),
 (80,'Notícia',35,0,99,0,'Criar Notícia'),
 (81,'Comentário',35,80,99,0,'Comentar'),
 (82,'Tese',36,0,99,0,'Criar Tese'),
 (83,'Posicionamento Inicial',36,82,1,0,'Posicionamento Inicial'),
 (84,'Argumento',36,83,1,0,'Argumentar'),
 (85,'Revisão 1',36,84,1,0,'Criar Revisão'),
 (86,'Revisão 2',36,84,1,0,'Criar Revisão'),
 (87,'Replica1',36,85,1,0,'Criar Réplica'),
 (88,'Replica2',36,86,1,0,'Criar Réplica'),
 (89,'Notícia',37,0,99,0,'Criar Notícia'),
 (90,'Comentário',37,89,99,0,'Comentar');
/*!40000 ALTER TABLE `etapa` ENABLE KEYS */;


--
-- Definition of table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `idvcom` int(10) unsigned NOT NULL,
  `idtipo` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_perfil_vcom1` (`idvcom`) USING BTREE,
  CONSTRAINT `FK_perfil_1` FOREIGN KEY (`idvcom`) REFERENCES `vcom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfil`
--

/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`,`titulo`,`descricao`,`idvcom`,`idtipo`) VALUES 
 (43,'Blogueiro','Responsável pela publicação das postagens do blog',31,0),
 (44,'Visitante','Responsável pelos comentários nas postagem do blog',31,0),
 (45,'Blogueiro','Responsável pela publicação das postagens do blog',32,0),
 (46,'Visitante','Responsável pelos comentários nas postagem do blog',32,0),
 (47,'Blogueiro','Responsável pela publicação das postagens do blog',33,0),
 (48,'Visitante','Responsável pelos comentários nas postagem do blog',33,0),
 (49,'Blogueiro','Responsável pela publicação das postagens do blog',34,0),
 (50,'Visitante','Responsável pelos comentários nas postagem do blog',34,0),
 (51,'Argumentador','Argumentador - D. de teses',35,0),
 (52,'Mediador','coord, do debate D. de teses',35,0),
 (53,'Revisor','rev do D, teses',35,0),
 (54,'Argumetador2','Argumentador - D. de teses',35,0),
 (55,'Argumentador3','Argumentador - D. de teses',35,0),
 (56,'Revisor2','Revisor 2',35,0),
 (57,'Blogueiro','Responsável pela publicação das postagens do blog',35,0),
 (58,'Visitante','Responsável pelos comentários nas postagem do blog',35,0),
 (59,'Mediador','mm',35,0),
 (60,'Argumentador','aa',35,0),
 (61,'revisor 1','r1',35,0),
 (62,'revisor 2','r2',35,0),
 (63,'Blogueiro','Responsável pela publicação das postagens do blog',37,0),
 (64,'Visitante','Responsável pelos comentários nas postagem do blog',37,0);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;


--
-- Definition of table `perfil_etapa`
--

DROP TABLE IF EXISTS `perfil_etapa`;
CREATE TABLE `perfil_etapa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idperfil` int(11) unsigned NOT NULL,
  `idetapa` int(11) unsigned NOT NULL,
  `prazo` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cronograma_1` (`idperfil`),
  KEY `FK_cronograma_2` (`idetapa`),
  CONSTRAINT `FK_cronograma_1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cronograma_2` FOREIGN KEY (`idetapa`) REFERENCES `etapa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfil_etapa`
--

/*!40000 ALTER TABLE `perfil_etapa` DISABLE KEYS */;
INSERT INTO `perfil_etapa` (`id`,`idperfil`,`idetapa`,`prazo`) VALUES 
 (14,43,63,0),
 (15,44,64,0),
 (16,45,65,0),
 (17,46,66,0),
 (18,47,67,0),
 (19,48,68,0),
 (20,49,69,0),
 (21,50,70,0),
 (22,52,71,0),
 (23,51,72,0),
 (24,51,76,0),
 (26,51,74,0),
 (27,53,73,0),
 (28,56,75,0),
 (29,56,73,1),
 (30,53,75,1),
 (31,51,77,0),
 (32,51,78,0),
 (33,57,80,0),
 (34,58,81,0),
 (35,59,82,0),
 (36,60,83,0),
 (37,60,84,0),
 (38,60,87,0),
 (39,60,88,0),
 (40,63,89,0),
 (41,64,90,0);
/*!40000 ALTER TABLE `perfil_etapa` ENABLE KEYS */;


--
-- Definition of table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idupi` int(10) unsigned NOT NULL,
  `idetapa` int(10) unsigned NOT NULL,
  `idpost` int(10) unsigned DEFAULT NULL,
  `idcontainer` int(10) unsigned DEFAULT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1` (`idupi`),
  KEY `FK2` (`idetapa`),
  KEY `FK3` (`idcontainer`),
  CONSTRAINT `FK1` FOREIGN KEY (`idupi`) REFERENCES `upi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2` FOREIGN KEY (`idetapa`) REFERENCES `etapa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3` FOREIGN KEY (`idcontainer`) REFERENCES `container` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`,`idupi`,`idetapa`,`idpost`,`idcontainer`,`data`) VALUES 
 (2,10,63,0,30,'2011-08-10 12:06:04'),
 (3,6,65,0,31,'2011-05-12 14:37:21'),
 (5,15,69,0,33,'2011-08-16 10:26:22'),
 (27,42,71,0,34,'2011-08-29 19:01:07'),
 (29,44,74,27,34,'2011-08-29 19:23:05'),
 (31,46,73,30,34,'2011-08-29 19:31:57'),
 (32,47,75,30,34,'2011-08-29 19:33:20'),
 (33,49,77,31,34,'2011-08-29 20:20:18'),
 (34,52,71,0,34,'2011-10-07 12:14:41'),
 (35,53,69,0,33,'2011-10-13 10:55:28'),
 (36,54,69,0,33,'2011-10-13 10:56:28'),
 (37,55,89,0,37,'2011-10-17 07:44:26'),
 (38,58,72,29,34,'2011-10-18 17:16:13');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;


--
-- Definition of table `prazo`
--

DROP TABLE IF EXISTS `prazo`;
CREATE TABLE `prazo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataini` datetime NOT NULL,
  `datafim` datetime NOT NULL,
  `idperfil_etapa` int(10) unsigned NOT NULL,
  `escrita` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_prazo_1` (`idperfil_etapa`) USING BTREE,
  CONSTRAINT `FK_prazo_1` FOREIGN KEY (`idperfil_etapa`) REFERENCES `perfil_etapa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prazo`
--

/*!40000 ALTER TABLE `prazo` DISABLE KEYS */;
INSERT INTO `prazo` (`id`,`dataini`,`datafim`,`idperfil_etapa`,`escrita`) VALUES 
 (1,'2011-01-01 00:00:00','2011-01-03 00:00:00',29,0),
 (2,'2011-01-01 00:00:00','2011-01-03 00:00:00',30,0);
/*!40000 ALTER TABLE `prazo` ENABLE KEYS */;


--
-- Definition of table `secao`
--

DROP TABLE IF EXISTS `secao`;
CREATE TABLE `secao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `idvcom` int(10) unsigned NOT NULL,
  `publico` tinyint(4) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_secao_1` (`idvcom`),
  CONSTRAINT `FK_secao_1` FOREIGN KEY (`idvcom`) REFERENCES `vcom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `secao`
--

/*!40000 ALTER TABLE `secao` DISABLE KEYS */;
INSERT INTO `secao` (`id`,`titulo`,`idvcom`,`publico`,`data`,`descricao`) VALUES 
 (30,'Principal',31,1,'2011-05-11','Página principal do Blog'),
 (31,'Principal',32,1,'2011-05-12','Página principal do Blog'),
 (32,'Principal',33,1,'2011-05-12','Página principal do Blog'),
 (33,'Principal',34,1,'2011-08-14','Página principal do Blog'),
 (34,'Pagina debate do Usuario X',35,1,'2011-05-05','Pagina do debate do UsuarioX'),
 (35,'Pagina Debate do usuario Y',35,1,'2011-05-05','Pagina do debate do UsuarioY'),
 (36,'Pagina Debate do usuario Z',35,1,'2011-05-05','Pagina do debate do UsuarioZ'),
 (37,'Principal',36,1,'2011-08-29','Página principal do Blog'),
 (38,'Principal',37,1,'2011-10-17','Página principal do Blog');
/*!40000 ALTER TABLE `secao` ENABLE KEYS */;


--
-- Definition of table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE `tipo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipo`
--

/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;


--
-- Definition of table `upi`
--

DROP TABLE IF EXISTS `upi`;
CREATE TABLE `upi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idusuario` int(10) unsigned NOT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'aa',
  `data` datetime NOT NULL,
  `idupi` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_upi_2` (`idupi`),
  KEY `FK_upi_1` (`idusuario`),
  CONSTRAINT `FK_upi_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `upi`
--

/*!40000 ALTER TABLE `upi` DISABLE KEYS */;
INSERT INTO `upi` (`id`,`idusuario`,`texto`,`data`,`idupi`) VALUES 
 (2,43,'Meu primeiro t&oacute;pico publicado!! Aguardem os Pr&oacute;ximos...!&nbsp;','2011-05-11 11:00:18',0),
 (3,43,'Meu segundo t&oacute;pico publicado!! Aguardem um de muitos!','2011-05-11 11:02:34',2),
 (4,43,'Meu segundo t&oacute;pico publicado!! Aguardem um de muitos! 4','2011-05-12 14:34:56',3),
 (5,44,'Minha primera Noticia!!!!!!','2011-05-12 14:36:43',0),
 (6,44,'Minha primera super Noticia!!!!!!','2011-05-12 14:37:21',5),
 (7,44,'Minha primera super ultra Noticia!!!!!!','2011-05-12 14:37:47',6),
 (8,44,'Minha primera UPI!!!!!!','2011-05-12 14:38:07',5),
 (9,44,'MOrfeu &eacute; wild!!!!&nbsp;','2011-05-12 14:38:59',0),
 (10,43,'NOticia do dia:<br />\r\n<br />\r\nRamon testando esse codigo','2011-08-10 12:06:04',2),
 (11,47,'Embora o uso de diferentes m&iacute;dias possa tornar as atividades escolares mais atrativas, us&aacute;-las sem uma proposta pedag&oacute;gica que favore&ccedil;a a aprendizagem significa apenas &ldquo;adornar&rdquo; o que j&aacute; &eacute; feito sem elas.','2011-08-14 13:05:40',0),
 (12,47,'Embora o uso de <strong>diferentes m&iacute;dias</strong> possa tornar as atividades escolares mais atrativas, us&aacute;-las sem uma <strong>proposta pedag&oacute;gica</strong> que favore&ccedil;a a aprendizagem significa apenas &ldquo;<span style=\"color:#ff0000;\">adornar</span>&rdquo; o que j&aacute; &eacute; feito sem elas.','2011-08-14 14:08:38',11),
 (13,47,'A utiliza&ccedil;&atilde;o de <strong>diferentes m&iacute;dias</strong> pode tornar as atividades escolares mais atrativas, no entanto us&aacute;-las sem uma <strong>proposta pedag&oacute;gica</strong> que favore&ccedil;a a aprendizagem significa apenas &ldquo;<span style=\"color:#ff0000;\">adornar</span>&rdquo; o que j&aacute; &eacute; feito sem elas.','2011-08-14 14:10:52',12),
 (14,47,'Criando uma nova produ&ccedil;&atilde;o.','2011-08-16 10:22:16',0),
 (15,47,'Uma nova noticia','2011-08-16 10:26:22',0),
 (16,48,'concordo!','2011-08-16 11:13:12',0),
 (19,48,'revisao morfeu','2011-08-29 12:48:31',0),
 (20,49,'aaaaaaa','2011-08-29 13:17:07',0),
 (21,48,'Revisao 2','2011-08-29 13:38:08',0),
 (22,47,'Nova Tese !!!','2011-08-29 14:34:24',0),
 (23,47,'TESE 2','2011-08-29 14:37:36',0),
 (26,48,'REV1','2011-08-29 14:39:07',0),
 (27,49,'Rev 2','2011-08-29 14:39:38',0),
 (28,49,'<strong>Rev 2.1</strong>','2011-08-29 14:39:52',27),
 (29,49,'asxaa','2011-08-29 14:40:30',0),
 (30,47,'TESE 1','2011-08-29 14:48:30',0),
 (31,47,'TESE 1....','2011-08-29 14:48:53',30),
 (34,48,'REV1 . alunoy','2011-08-29 14:51:53',0),
 (35,49,'REV 2','2011-08-29 14:52:39',0),
 (36,50,'ashsSSJISJAISJAIOSJ ','2011-08-29 14:54:40',0),
 (37,47,'Teste poooo','2011-08-29 17:55:28',0),
 (38,48,'Posicionamento','2011-08-29 17:58:38',0),
 (39,47,'Usar diferentes<strong> M&iacute;dias e Tecnologias Digitais</strong> na escola, &eacute; modismo, afinal elas j&aacute; existem h&aacute; muito tempo e mesmo sem us&aacute;-las, continuamos a ensinar e aprender, sem perdas nem danos.','2011-08-29 18:32:08',0),
 (40,47,'A exposi&ccedil;&atilde;o de estudantes, de forma continuada e sem restri&ccedil;&atilde;o, a um ambiente informatizado, &eacute; uma boa maneira de promover transforma&ccedil;&otilde;es na escola.','2011-08-29 18:32:39',0),
 (41,47,'Usar diferentes<strong> <span style=\"color:#ff0000;\">M&iacute;dias e Tecnologias Digitais</span></strong><span style=\"color:#ff0000;\"> </span>na escola, &eacute; modismo, afinal elas j&aacute; existem h&aacute; muito tempo e mesmo sem us&aacute;-las, continuamos a ensinar e aprender, sem perdas nem danos.','2011-08-29 18:33:21',39),
 (42,47,'Os humanos percebem o mundo de diferentes formas, usando<strong> diferente sentidos</strong>. A linguagem textual n&atilde;o &eacute; suficiente para exprimir todas elas. Portanto, explorar o uso de diferentes m&iacute;dias, facilita a descri&ccedil;&atilde;o de nossas percep&ccedil;&otilde;es.','2011-08-29 19:01:07',0),
 (43,46,'Embora a linguagem textual possa ser rica, atrav&eacute;s da mais variadas manista&ccedil;&otilde;es lingu&iacute;sticas,&nbsp; as m&iacute;dias podem explorar de forma din&acirc;mica os sentidos atrav&eacute;s de ilustra&ccedil;&otilde;es, sons, sequ&ecirc;ncia de imagens, v&iacute;deos e at&eacute; mesmo pelo texto (apresentado dinamicamente). As percep&ccedil;&otilde;es dos humanos podem tornar-se mais sens&iacute;veis com a variabilidade, diversidade e combina&ccedil;&atilde;o no uso dessas m&iacute;dias.','2011-08-29 19:21:38',0),
 (44,46,'Concordo.','2011-08-29 19:23:05',0),
 (45,46,'Embora a linguagem textual possa ser rica, atrav&eacute;s da mais variadas manista&ccedil;&otilde;es lingu&iacute;sticas,&nbsp; as m&iacute;dias podem explorar de forma din&acirc;mica os sentidos atrav&eacute;s de ilustra&ccedil;&otilde;es, sons, sequ&ecirc;ncia de imagens, v&iacute;deos e at&eacute; mesmo pelo texto (apresentado dinamicamente). As percep&ccedil;&otilde;es dos humanos podem tornar-se mais sens&iacute;veis com a variabilidade, diversidade e combina&ccedil;&atilde;o no uso dessas m&iacute;dias.','2011-08-29 19:23:21',0),
 (46,48,'Faltou responder com mais precis&atilde;o a pergunta &quot;Porque a linguagem textual n&atilde;o &eacute; suficiente para exprimir as diferentes formas?&quot;','2011-08-29 19:31:57',0),
 (47,49,'Verifique sua ortografia.','2011-08-29 19:33:20',0),
 (48,46,'<p>Obrigado pela dica, pois me alertou para um aspecto muito importante..&nbsp;Na verdade eu discordo da tese, quando afirma que a linguagem textual n&atilde;o &eacute; suficiente. Mas concordo que facilita a descri&ccedil;&atilde;o de nossas percep&ccedil;&ouml;es. Esqueci de esclarecer que a linguagem textual &eacute; rica e atrav&eacute;s dos seus recursos lingu&iacute;sticos &eacute; possivel descrever nossas percep&ccedil;&otilde;es, por&eacute;m com um esfor&ccedil;o cognitivo maior comparado &aacute; m&iacute;dias digitais.</p>','2011-08-29 20:19:35',0),
 (49,46,'<p>Obrigado pela <strong>revis&atilde;o</strong>, pois me alertou para um aspecto muito importante..&nbsp;<strong>Na verdade eu discordo da tese</strong>, quando afirma que a linguagem textual n&atilde;o &eacute; suficiente. Mas concordo que facilita a descri&ccedil;&atilde;o de nossas percep&ccedil;&ouml;es. Esqueci de esclarecer que a linguagem textual &eacute; rica e atrav&eacute;s dos seus recursos lingu&iacute;sticos &eacute; possivel descrever nossas percep&ccedil;&otilde;es, por&eacute;m com um esfor&ccedil;o cognitivo maior comparado &aacute; m&iacute;dias digitais.</p>','2011-08-29 20:20:18',48),
 (50,46,'<p>Obrigado pela <strong>revis&atilde;o</strong>, pois me alertou para um aspecto muito importante..&nbsp;<strong>Na verdade eu discordo da tese</strong>, quando afirma que a linguagem textual n&atilde;o &eacute; suficiente.&nbsp;</p>','2011-08-29 20:20:53',49),
 (51,46,'Nova UPI teste!','2011-08-29 20:21:23',0),
 (52,47,'Quem produz software para educação precisa compreender os processos de aprendizagem e as abordagens pedagógicas ou, de preferência, trabalhar em parceria com educadores. ','2011-10-07 12:14:41',0),
 (53,47,'aaaaaa','2011-10-13 10:55:28',0),
 (54,47,'ashaushshua','2011-10-13 10:56:28',0),
 (55,51,'Testando meu novo blog!<br />\r\n<br />\r\nRamon maia','2011-10-17 07:44:26',0),
 (56,46,'Embora a linguagem textual possa ser rica, atrav&eacute;s da mais variadas manista&ccedil;&otilde;es lingu&iacute;sticas,&nbsp; as m&iacute;dias podem explorar de forma din&acirc;mica os sentidos atrav&eacute;s de <strong>ilustra&ccedil;&otilde;es</strong>, <strong>sons</strong>, <strong>sequ&ecirc;ncia de imagens</strong>, <strong>v&iacute;deos </strong>e at&eacute; mesmo pelo texto (apresentado dinamicamente). <strong><span style=\"color:#b22222;\">A percep&ccedil;&aacute;o humana </span></strong>podem tornar-se mais sens&iacute;veis com a <u>variabilidade</u>, <u>diversidade</u> e <u>combina&ccedil;&atilde;o </u>no uso dessas m&iacute;dias. ','2011-10-18 17:12:20',0),
 (57,46,'Embora a linguagem textual possa ser rica, atrav&eacute;s da mais variadas manista&ccedil;&otilde;es lingu&iacute;sticas,&nbsp; as m&iacute;dias podem explorar de forma din&acirc;mica os sentidos atrav&eacute;s de <span style=\"color:#000000;\"><strong>ilustra&ccedil;&otilde;es</strong>, <strong>sons</strong>, <strong>sequ&ecirc;ncia de imagens</strong>, <strong>v&iacute;deos </strong></span>e at&eacute; mesmo pelo texto (apresentado dinamicamente). <strong><span style=\"color:#b22222;\">A percep&ccedil;&aacute;o humana </span></strong>podem tornar-se mais sens&iacute;veis com a <u>variabilidade</u>, <u>diversidade</u> e <u>combina&ccedil;&atilde;o </u>no uso dessas m&iacute;dias. ','2011-10-18 17:13:04',56),
 (58,46,'Embora a linguagem textual possa ser rica, atrav&eacute;s da mais variadas manista&ccedil;&otilde;es lingu&iacute;sticas,&nbsp; as m&iacute;dias podem explorar de forma din&acirc;mica os sentidos atrav&eacute;s de <span style=\"color:#000000;\"><strong>ilustra&ccedil;&otilde;es</strong>, <strong>sons</strong>, <strong>sequ&ecirc;ncia de imagens</strong>, <strong>v&iacute;deos </strong></span>e at&eacute; mesmo pelo texto (apresentado dinamicamente). <strong><span style=\"color:#b22222;\">A percep&ccedil;&atilde;o humana </span></strong>podem tornar-se mais sens&iacute;veis com a <u>variabilidade</u>, <u>diversidade</u> e <u>combina&ccedil;&atilde;o </u>no uso dessas m&iacute;dias. ','2011-10-18 17:16:13',57);
/*!40000 ALTER TABLE `upi` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data` datetime NOT NULL COMMENT 'data de cadastro',
  PRIMARY KEY (`id`,`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`nome`,`sobrenome`,`email`,`senha`,`data`) VALUES 
 (43,'Ramon','maia','raamon@gmail.com','12345','2011-05-11 10:42:09'),
 (44,'Everton','Bada','bada@gmail.com','123','2011-05-12 14:35:22'),
 (45,'Gustavo','tavao','gu','123','2011-05-12 14:35:49'),
 (46,'AlunoX','Silva','alunox@email.com','123','2010-08-14 09:09:50'),
 (47,'ProfessorA','Menezes','professor@email.com','123','2010-08-14 09:09:50'),
 (48,'AlunoY','silva','alunoy@email.com','123','2010-08-14 09:09:50'),
 (49,'Aluno Z','silva','alunoz@email.com','123','2010-08-14 09:09:50'),
 (50,'Credinee','Menezes','cre@gmail.com','123','2011-08-29 14:53:54'),
 (51,'RAMON','Vieira','raamon@gmail.com','123','2011-10-17 07:42:50');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


--
-- Definition of table `usuario_perfil`
--

DROP TABLE IF EXISTS `usuario_perfil`;
CREATE TABLE `usuario_perfil` (
  `idusuario` int(10) unsigned NOT NULL,
  `idperfil` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idusuario`,`idperfil`) USING BTREE,
  KEY `fk_usuario_has_perfil_perfil1` (`idperfil`) USING BTREE,
  KEY `fk_usuario_has_perfil_usuario1` (`idusuario`) USING BTREE,
  CONSTRAINT `FK_usuario_perfil_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_perfil_2` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario_perfil`
--

/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;
INSERT INTO `usuario_perfil` (`idusuario`,`idperfil`) VALUES 
 (43,43),
 (44,45),
 (45,47),
 (47,49),
 (46,51),
 (47,52),
 (48,53),
 (48,54),
 (49,55),
 (49,56),
 (50,57),
 (47,59),
 (48,60),
 (46,61),
 (49,62),
 (51,63);
/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;


--
-- Definition of table `vcom`
--

DROP TABLE IF EXISTS `vcom`;
CREATE TABLE `vcom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) CHARACTER SET utf8 NOT NULL,
  `descricao` text CHARACTER SET utf8 NOT NULL,
  `publico` tinyint(3) unsigned NOT NULL,
  `idusuario` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vcom`
--

/*!40000 ALTER TABLE `vcom` DISABLE KEYS */;
INSERT INTO `vcom` (`id`,`titulo`,`descricao`,`publico`,`idusuario`,`data`) VALUES 
 (31,'Blog do Ramon','Espaço Virtual colaborativo padrão do MOrFEu. Este espaço tem com formato de interação similar ao que consideramos como Blog',1,43,'2011-05-11 10:42:09'),
 (32,'Blog do Everton','Espaço Virtual colaborativo padrão do MOrFEu. Este espaço tem com formato de interação similar ao que consideramos como Blog',1,44,'2011-05-12 14:35:22'),
 (33,'Blog do Gustavo','Espaço Virtual colaborativo padrão do MOrFEu. Este espaço tem com formato de interação similar ao que consideramos como Blog',1,45,'2011-05-12 14:35:49'),
 (34,'Blog do Professor A','Espaço Virtual colaborativo padrão do MOrFEu. Este espaço tem com formato de interação similar ao que consideramos como Blog',1,47,'2011-08-14 09:09:50'),
 (35,'Debate de Teses','AP Construindo Conceituações: Debate de Teses',1,47,'2011-05-05 11:00:06'),
 (36,'Blog do Credinee','Espaço Virtual colaborativo padrão do MOrFEu. Este espaço tem com formato de interação similar ao que consideramos como Blog',1,50,'2011-08-29 14:53:54'),
 (37,'Blog do RAMON','Espaço Virtual colaborativo padrão do MOrFEu. Este espaço tem com formato de interação similar ao que consideramos como Blog',1,51,'2011-10-17 07:42:50');
/*!40000 ALTER TABLE `vcom` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
