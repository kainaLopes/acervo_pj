-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Nov-2019 às 06:15
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pj_acervo_kaina`
--
CREATE DATABASE IF NOT EXISTS `pj_acervo_kaina` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pj_acervo_kaina`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo`
--

CREATE TABLE `acervo` (
  `id` int(11) NOT NULL,
  `idEditora` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `ano` int(11) NOT NULL,
  `preco` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acervo`
--

INSERT INTO `acervo` (`id`, `idEditora`, `titulo`, `autor`, `ano`, `preco`, `quantidade`, `tipo`) VALUES
(8, 1, 'era uma vez', 'santana', 2000, 12, 2, 1),
(9, 2, 'tao distante', 'fiona', 2010, 10, 2, 2),
(10, 3, 'bombom e balas', 'lucy alvez', 2004, 15, 1, 3),
(11, 4, 'friday', 'tammy', 2002, 16, 2, 4),
(12, 1, 'teste', 'rita', 2012, 1, 2, 5),
(13, 1, 'teste2', 'geo', 2010, 1.99, 3, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE `editora` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`id`, `nome`) VALUES
(1, 'Saraiva'),
(2, 'Brasil'),
(3, 'Wattapad'),
(4, 'reviews');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acervo`
--
ALTER TABLE `acervo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEditora` (`idEditora`);

--
-- Indexes for table `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acervo`
--
ALTER TABLE `acervo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `editora`
--
ALTER TABLE `editora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acervo`
--
ALTER TABLE `acervo`
  ADD CONSTRAINT `acervo_ibfk_1` FOREIGN KEY (`idEditora`) REFERENCES `editora` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
