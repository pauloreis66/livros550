-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Maio-2018 às 18:48
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aeblivros`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `idCat` tinyint(4) NOT NULL,
  `categoria` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estrutura da tabela `detalhesrequisicao`
--

CREATE TABLE `detalhesrequisicao` (
  `idReq` int(10) NOT NULL,
  `idLivro` int(6) NOT NULL,
  `quantidade` tinyint(4) NOT NULL,
  `dataDevolucao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `detalhesrequisicao`
--

INSERT INTO `detalhesrequisicao` (`idReq`, `idLivro`, `quantidade`, `dataDevolucao`) VALUES
(1, 3, 1, '0000-00-00'),
(1, 2, 9, '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `editoras`
--

CREATE TABLE `editoras` (
  `idEditora` tinyint(4) NOT NULL,
  `editora` varchar(40) NOT NULL,
  `url` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `idiomas` (
  `idIdioma` tinyint(2) NOT NULL,
  `idioma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `idiomas`
--

INSERT INTO `idiomas` (`idIdioma`, `idioma`) VALUES
(1, 'Português'),
(2, 'Português do Brasil'),
(3, 'Inglês'),
(4, 'Espanhol'),
(5, 'Francês'),
(6, 'Alemão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `idLivro` int(6) NOT NULL,
  `idCat` tinyint(4) NOT NULL,
  `idEditora` tinyint(4) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `isbn` int(13) DEFAULT NULL,
  `anoEdicao` int(4) DEFAULT NULL,
  `idIdioma` tinyint(2) NOT NULL,
  `idOrigem` tinyint(2) NOT NULL,
  `sinopse` text,
  `imgCapa` varchar(255) DEFAULT NULL,
  `exemplares` tinyint(4) UNSIGNED DEFAULT '1',
  `promo` bit(1) NOT NULL DEFAULT b'0',
  `dataReg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`idLivro`, `idCat`, `idEditora`, `titulo`, `autor`, `isbn`, `anoEdicao`, `idIdioma`, `idOrigem`, `sinopse`, `imgCapa`, `exemplares`, `promo`, `dataReg`) VALUES
(1, 13, 1, 'Ajax - Guia Prático para Windows', 'Wallace Soares', 2147483647, 2010, 2, 2, NULL, '0001 - Ajax - Guia PrÃ¡tico para Windows.jpg', 1, b'0', '2018-03-06 19:50:44'),
(2, 13, 1, 'JavaScript - Guia Prático do Webmaster', 'Osmar J. Silva', 2147483647, 2000, 2, 3, NULL, '0002 - JavaScript - Guia PrÃ¡tico do Webmaster.jpg', 1, b'0', '2018-03-06 19:50:44'),
(3, 13, 2, 'FrontPage 2003 - Curso Completo', 'Ana Mendes, Maria Mendes, Francisco Marques', 2147483647, 2006, 1, 3, NULL, '0003 - FrontPage 2003 - Curso Completo.jpg', 1, b'0', '2018-03-06 19:50:44'),
(4, 13, 2, 'Web Design - estrutura, concepção e produção de sites Web', 'Bruno Figueiredo', 2147483647, 2002, 1, 4, NULL, '0004 - Web Design - estrutura, concepÃ§Ã£o e produÃ§Ã£o de sites Web.jpg', 1, b'0', '2018-03-06 19:50:44'),
(5, 13, 2, 'Como criar Páginas Web, Depressa e Bem', 'Pedro Coelho', 2147483647, 2003, 1, 4, NULL, '0005 - Como criar PÃ¡ginas Web, Depressa e Bem.jpg', 1, b'0', '2018-03-06 19:50:44'),
(6, 13, 1, 'Web Total - Desenvolva Sites com Tecnologias de Uso Livre', 'Evandro Carlos Teruel', 2147483647, 2009, 2, 4, NULL, '0006 - Web Total - Desenvolva Sites com Tecnologias de Uso Livre.jpg', 1, b'0', '2018-03-06 19:50:44'),
(7, 13, 1, 'Guia de Orientação e Desenvolvimento de Sites', 'José Augusto Manzano, Suely Alves de Toledo', 2147483647, 2008, 2, 4, NULL, '0007 - Guia de OrientaÃ§Ã£o e Desenvolvimento de Sites.jpg', 1, b'0', '2018-03-06 19:50:44'),
(8, 13, 2, 'Dreamweaver CS3 - Depressa e Bem', 'Helder Oliveira', 2147483647, 2008, 1, 4, NULL, '0008 - Dreamweaver CS3 - Depressa e Bem.jpg', 1, b'0', '2018-03-06 19:55:39'),
(9, 13, 3, 'O Guia Prático do Dreamweaver CS3 com PHP, JavaScript e Ajax', 'Pedro Remoaldo', 2147483647, 2008, 1, 4, NULL, '0009 - O Guia PrÃ¡tico do Dreamweaver CS3 com PHP, JavaScript e Ajax.jpg', 1, b'0', '2018-03-08 14:32:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `origem`
--

CREATE TABLE `origem` (
  `idOrigem` tinyint(2) NOT NULL,
  `origem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estrutura da tabela `requisicao`
--

CREATE TABLE `requisicao` (
  `idReq` int(6) UNSIGNED NOT NULL,
  `idUser` int(6) UNSIGNED NOT NULL,
  `dataRequisicao` date NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisicao`
--

INSERT INTO `requisicao` (`idReq`, `idUser`, `dataRequisicao`, `estado`) VALUES
(1, 3, '2018-05-10', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `temprequisicao`
--

CREATE TABLE `temprequisicao` (
  `sessao` varchar(50) NOT NULL,
  `idLivro` int(6) NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `temprequisicao`
--

INSERT INTO `temprequisicao` (`sessao`, `idLivro`, `quantidade`) VALUES
('7ckpuqltdpophc3r8p70ru6buu', 1, 1),
('7ckpuqltdpophc3r8p70ru6buu', 8, 1),
('7ckpuqltdpophc3r8p70ru6buu', 9, 0),
('bvkdsu75qko9jp3nuc26qde4lo', 9, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `idUser` int(6) NOT NULL,
  `login` varchar(40) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nivel` bit(1) NOT NULL DEFAULT b'1',
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  `dtRegisto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`idUser`, `login`, `nome`, `senha`, `email`, `nivel`, `ativo`, `dtRegisto`) VALUES
(1, 'admin', 'Administrador', 'admin', 'admin@nowhere.com', b'1', b'1', '0000-00-00 00:00:00'),
(3, 'f828', 'Paulo Reis', '123', 'pmpreis@gmail.com', b'1', b'1', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
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
-- Indexes for table `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`idLivro`),
  ADD KEY `idCat` (`idCat`),
  ADD KEY `idEditora` (`idEditora`),
  ADD KEY `idIdioma` (`idIdioma`),
  ADD KEY `idOrigem` (`idOrigem`);

--
-- Indexes for table `origem`
--
ALTER TABLE `origem`
  ADD PRIMARY KEY (`idOrigem`);

--
-- Indexes for table `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`idReq`);

--
-- Indexes for table `temprequisicao`
--
ALTER TABLE `temprequisicao`
  ADD PRIMARY KEY (`sessao`,`idLivro`),
  ADD KEY `idLivro` (`idLivro`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCat` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `editoras`
--
ALTER TABLE `editoras`
  MODIFY `idEditora` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `idIdioma` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `livros`
--
ALTER TABLE `livros`
  MODIFY `idLivro` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
  MODIFY `idOrigem` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requisicao`
--
ALTER TABLE `requisicao`
  MODIFY `idReq` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `idUser` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`idCat`) REFERENCES `categorias` (`idCat`),
  ADD CONSTRAINT `livros_ibfk_2` FOREIGN KEY (`idEditora`) REFERENCES `editoras` (`idEditora`),
  ADD CONSTRAINT `livros_ibfk_3` FOREIGN KEY (`idIdioma`) REFERENCES `idiomas` (`idIdioma`),
  ADD CONSTRAINT `livros_ibfk_4` FOREIGN KEY (`idOrigem`) REFERENCES `origem` (`idOrigem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
