-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Mar-2018 às 13:43
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aeblivros`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`idCat` int(4) NOT NULL,
  `categoria` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`idCat`, `categoria`) VALUES
(1, 'Base de Dados'),
(2, 'Design & Multimédia'),
(3, 'Gestão de Projetos'),
(4, 'Hardware &amp; Arquitetura de Computadores'),
(5, 'Internet & Iniciação à Informática'),
(6, 'Office'),
(7, 'Programação'),
(8, 'Programação Móvel'),
(9, 'Redes & Comunicações'),
(10, 'Robótica'),
(11, 'Segurança'),
(12, 'Sistemas de Informação & Engenharia de Software'),
(13, 'Tecnologias & Programação Web');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias1`
--

CREATE TABLE IF NOT EXISTS `categorias1` (
`idCat` int(4) NOT NULL,
  `categoria` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `editoras`
--

CREATE TABLE IF NOT EXISTS `editoras` (
`idEditora` int(4) NOT NULL,
  `editora` varchar(40) NOT NULL,
  `url` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `editoras`
--

INSERT INTO `editoras` (`idEditora`, `editora`, `url`) VALUES
(1, 'Érica', 'https://www.saraiva.com.br/parcerias/editoraerica'),
(2, 'FCA - Editora de Informática', 'https://www.fca.pt/pt/'),
(3, 'Edições Centro Atlântico', 'http://www.centroatl.pt/'),
(4, 'Porto Editora', 'https://www.portoeditora.pt/'),
(5, 'Edições Sílabo', 'http://www.silabo.pt/'),
(6, 'Microsoft Press', 'https://www.microsoftpressstore.com/'),
(7, 'Sams Publishing', 'http://www.informit.com/imprint/series_detail.aspx?st=61327'),
(8, 'Editora Campus', NULL),
(9, 'Bookman', NULL),
(10, 'Areal Editores', 'https://www.arealeditores.pt/'),
(11, 'Texto Editora', 'http://www.texto.pt/pt/'),
(12, 'IST Press', 'http://istpress.tecnico.ulisboa.pt/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `idiomas`
--

CREATE TABLE IF NOT EXISTS `idiomas` (
`idIdioma` int(4) NOT NULL,
  `Idioma` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `idiomas`
--

INSERT INTO `idiomas` (`idIdioma`, `Idioma`) VALUES
(1, 'Português'),
(2, 'Português do Brasil'),
(3, 'Inglês'),
(4, 'Espanhol'),
(5, 'Francês'),
(6, 'Alemão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros1`
--

CREATE TABLE IF NOT EXISTS `livros1` (
`idLivro` int(6) NOT NULL,
  `idCat` int(11) NOT NULL,
  `idEditora` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `isbn` int(13) DEFAULT NULL,
  `anoEdicao` int(4) DEFAULT NULL,
  `idIdioma` int(11) NOT NULL,
  `idOrigem` int(11) NOT NULL,
  `sinopse` text,
  `capa` mediumblob,
  `imgCapa` varchar(255) DEFAULT NULL,
  `exemplares` int(4) DEFAULT '1',
  `promo` bit(1) NOT NULL DEFAULT b'0',
  `DataReg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livros1`
--

INSERT INTO `livros1` (`idLivro`, `idCat`, `idEditora`, `titulo`, `autor`, `isbn`, `anoEdicao`, `idIdioma`, `idOrigem`, `sinopse`, `capa`, `imgCapa`, `exemplares`, `promo`, `DataReg`) VALUES
(1, 13, 1, 'Ajax - Guia Prático para Windows', 'Wallace Soares', 2147483647, 2010, 2, 2, NULL, NULL, '0001 - Ajax - Guia PrÃ¡tico para Windows.jpg', 1, b'0', '2018-03-06 19:50:44'),
(2, 13, 1, 'JavaScript - Guia Prático do Webmaster', 'Osmar J. Silva', 2147483647, 2000, 2, 3, NULL, NULL, '0002 - JavaScript - Guia PrÃ¡tico do Webmaster.jpg', 1, b'0', '2018-03-06 19:50:44'),
(3, 13, 2, 'FrontPage 2003 - Curso Completo', 'Ana Mendes, Maria Mendes, Francisco Marques', 2147483647, 2006, 1, 3, NULL, NULL, '0003 - FrontPage 2003 - Curso Completo.jpg', 1, b'0', '2018-03-06 19:50:44'),
(4, 13, 2, 'Web Design - estrutura, concepção e produção de sites Web', 'Bruno Figueiredo', 2147483647, 2002, 1, 4, NULL, NULL, '0004 - Web Design - estrutura, concepÃ§Ã£o e produÃ§Ã£o de sites Web.jpg', 1, b'0', '2018-03-06 19:50:44'),
(5, 13, 2, 'Como criar Páginas Web, Depressa e Bem', 'Pedro Coelho', 2147483647, 2003, 1, 4, NULL, NULL, '0005 - Como criar PÃ¡ginas Web, Depressa e Bem.jpg', 1, b'0', '2018-03-06 19:50:44'),
(6, 13, 1, 'Web Total - Desenvolva Sites com Tecnologias de Uso Livre', 'Evandro Carlos Teruel', 2147483647, 2009, 2, 4, NULL, NULL, '0006 - Web Total - Desenvolva Sites com Tecnologias de Uso Livre.jpg', 1, b'0', '2018-03-06 19:50:44'),
(7, 13, 1, 'Guia de Orientação e Desenvolvimento de Sites', 'José Augusto Manzano, Suely Alves de Toledo', 2147483647, 2008, 2, 4, NULL, NULL, '0007 - Guia de OrientaÃ§Ã£o e Desenvolvimento de Sites.jpg', 1, b'0', '2018-03-06 19:50:44'),
(8, 13, 2, 'Dreamweaver CS3 - Depressa e Bem', 'Helder Oliveira', 2147483647, 2008, 1, 4, NULL, NULL, '0008 - Dreamweaver CS3 - Depressa e Bem.jpg', 1, b'0', '2018-03-06 19:55:39'),
(9, 13, 3, 'O Guia Prático do Dreamweaver CS3 com PHP, JavaScript e Ajax', 'Pedro Remoaldo', 2147483647, 2008, 1, 4, NULL, NULL, '0009 - O Guia PrÃ¡tico do Dreamweaver CS3 com PHP, JavaScript e Ajax.jpg', 1, b'0', '2018-03-08 14:32:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `origem`
--

CREATE TABLE IF NOT EXISTS `origem` (
`idOrigem` int(4) NOT NULL,
  `origem` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `origem`
--

INSERT INTO `origem` (`idOrigem`, `origem`) VALUES
(1, 'Grupo 550'),
(2, 'Prodep - Medida 1 - Acção 1.2'),
(3, 'Prodep III - Medida 1 - Acção 1.3'),
(4, 'POPH - Financi. Cursos Profissionais'),
(5, 'POCH - Cursos Profissionais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores1`
--

CREATE TABLE IF NOT EXISTS `utilizadores1` (
`idUser` int(11) NOT NULL,
  `Login` varchar(40) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Senha` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Nivel` int(1) NOT NULL DEFAULT '1',
  `Ativo` tinyint(1) NOT NULL DEFAULT '1',
  `dtRegisto` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores1`
--

INSERT INTO `utilizadores1` (`idUser`, `Login`, `Nome`, `Senha`, `Email`, `Nivel`, `Ativo`, `dtRegisto`) VALUES
(1, 'admin', 'Administrador', 'admin', 'admin@nowhere.com', 3, 1, '0000-00-00 00:00:00'),
(2, 'f828', '', 'pmpreis@gmail.com', '123', 1, 1, '0000-00-00 00:00:00'),
(3, 'f828', 'Paulo Reis', '123', 'pmpreis@gmail.com', 1, 1, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`idCat`);

--
-- Indexes for table `categorias1`
--
ALTER TABLE `categorias1`
 ADD PRIMARY KEY (`idCat`);

--
-- Indexes for table `editoras`
--
ALTER TABLE `editoras`
 ADD PRIMARY KEY (`idEditora`);

--
-- Indexes for table `idiomas`
--
ALTER TABLE `idiomas`
 ADD PRIMARY KEY (`idIdioma`);

--
-- Indexes for table `livros1`
--
ALTER TABLE `livros1`
 ADD PRIMARY KEY (`idLivro`);

--
-- Indexes for table `origem`
--
ALTER TABLE `origem`
 ADD PRIMARY KEY (`idOrigem`);

--
-- Indexes for table `utilizadores1`
--
ALTER TABLE `utilizadores1`
 ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `idCat` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `categorias1`
--
ALTER TABLE `categorias1`
MODIFY `idCat` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `editoras`
--
ALTER TABLE `editoras`
MODIFY `idEditora` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `idiomas`
--
ALTER TABLE `idiomas`
MODIFY `idIdioma` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `livros1`
--
ALTER TABLE `livros1`
MODIFY `idLivro` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
MODIFY `idOrigem` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `utilizadores1`
--
ALTER TABLE `utilizadores1`
MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
