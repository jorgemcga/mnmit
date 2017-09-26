-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Set-2017 às 03:06
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gerenciamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ativo`
--

CREATE TABLE `ativo` (
  `id` int(11) NOT NULL,
  `nrpatrimonio` varchar(45) DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `datacompra` date DEFAULT NULL,
  `monitorar` char(1) NOT NULL DEFAULT '0',
  `categoria_ativo_id` int(11) NOT NULL,
  `so_id` int(11) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `modelo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ativo`
--

INSERT INTO `ativo` (`id`, `nrpatrimonio`, `nome`, `tag`, `descricao`, `datacompra`, `monitorar`, `categoria_ativo_id`, `so_id`, `serial`, `modelo_id`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, '1', 'Notebook Acer', 'ES1-572-32LD', '', '2017-08-11', '1', 1, 3, 'Y2F7C-N2PMX-VT48Y-77Y7K-WTYP6', 1, 1, NULL, NULL),
(2, '2', 'Desktop Familia', 'N/A', '', '2009-01-10', '0', 2, 1, '', 4, 2, NULL, NULL),
(3, '123', 'testando', '123', '', '1999-07-23', '1', 1, 0, '', 0, 2, '2017-09-23 18:29:47', '2017-09-23 18:57:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_ativo`
--

CREATE TABLE `categoria_ativo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_ativo`
--

INSERT INTO `categoria_ativo` (`id`, `nome`) VALUES
(1, 'Notebook'),
(2, 'Desktop'),
(3, 'Impressora'),
(4, 'Switch'),
(5, 'Access Point'),
(6, 'Rádio NanoStation');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_componente`
--

CREATE TABLE `categoria_componente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo_valor` varchar(45) DEFAULT NULL,
  `sigla_valor` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_componente`
--

INSERT INTO `categoria_componente` (`id`, `nome`, `tipo_valor`, `sigla_valor`) VALUES
(1, 'Disco Rígido Físico', 'GigaBytes', 'GB'),
(2, 'Memória DDR4', 'GigaBytes', 'GB'),
(3, 'Processador', 'GigaHertz', 'GHz');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_equipamento`
--

CREATE TABLE `categoria_equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_equipamento`
--

INSERT INTO `categoria_equipamento` (`id`, `nome`) VALUES
(1, 'Teclado'),
(3, 'Mouse'),
(4, 'Fones de Ouvido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_licenca`
--

CREATE TABLE `categoria_licenca` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sigla` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_licenca`
--

INSERT INTO `categoria_licenca` (`id`, `nome`, `sigla`) VALUES
(1, 'GNU General Public License', 'GPL'),
(2, 'GNU Lesser General Public License', 'LGPL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `componente`
--

CREATE TABLE `componente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `categoria_componente_id` int(11) NOT NULL,
  `ativo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `componente`
--

INSERT INTO `componente` (`id`, `nome`, `valor`, `categoria_componente_id`, `ativo_id`, `created_at`, `updated_at`) VALUES
(1, 'Disco Rídigo', '970', 1, 0, NULL, NULL),
(2, 'Memória 2', '2', 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nrpatrimonio` varchar(45) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `datacompra` date DEFAULT NULL,
  `categoria_equipamento_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `nrpatrimonio`, `nome`, `datacompra`, `categoria_equipamento_id`, `usuario_id`, `created_at`, `update_at`) VALUES
(1, '1', 'Teclado Reserva', '2017-08-31', 1, 2, NULL, NULL),
(2, '', 'Mouse sem Fio', '2017-01-01', 3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE `fabricante` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fabricante`
--

INSERT INTO `fabricante` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Acer', NULL, NULL),
(3, 'Asus', NULL, NULL),
(4, 'Dell', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Administradores', '2017-09-17 19:17:59', '2017-09-17 19:17:59'),
(2, 'Usuários', '2017-09-17 19:17:59', '2017-09-17 19:17:59'),
(3, 'Comercial', '2017-09-17 20:46:00', '2017-09-17 20:46:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `interface_rede`
--

CREATE TABLE `interface_rede` (
  `id` int(11) NOT NULL,
  `hostname` varchar(45) DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `mascara` varchar(16) DEFAULT NULL,
  `gateway` varchar(16) DEFAULT NULL,
  `dns1` varchar(16) DEFAULT NULL,
  `dns2` varchar(16) DEFAULT NULL,
  `macaddress` varchar(17) DEFAULT NULL,
  `ativo_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `interface_rede`
--

INSERT INTO `interface_rede` (`id`, `hostname`, `ip`, `mascara`, `gateway`, `dns1`, `dns2`, `macaddress`, `ativo_id`) VALUES
(1, 'NOTE_JMA', '192.168.2.11', '255.255.255.0', '192.196.2.10', '192.168.2.8', '192.168.2.7', '5C-C9-D3-88-2B-BF', 1),
(6, 'DESK_FAMILIA', '192.168.2.9', '255.255.255.0', '192.196.2.10', '192.168.2.8', '192.168.2.7', '5C-C9-D3-88-2B-BF', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `licenca`
--

CREATE TABLE `licenca` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `datacompra` date DEFAULT NULL,
  `datavence` date DEFAULT NULL,
  `categoria_licenca_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `licenca`
--

INSERT INTO `licenca` (`id`, `nome`, `serial`, `datacompra`, `datavence`, `categoria_licenca_id`, `created_at`, `updated_at`) VALUES
(1, 'Xen1 Licença', 'N/A', '2017-09-09', '2018-09-09', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `licenciamento`
--

CREATE TABLE `licenciamento` (
  `ativo_id` int(11) NOT NULL,
  `licenca_id` int(11) NOT NULL,
  `datahora` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao`
--

CREATE TABLE `manutencao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(2048) NOT NULL,
  `datainicio` datetime DEFAULT NULL,
  `datafim` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `ativo_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `manutencao`
--

INSERT INTO `manutencao` (`id`, `descricao`, `datainicio`, `datafim`, `status`, `ativo_id`, `created_at`, `updated_at`) VALUES
(1, 'teste', '2017-08-31 23:00:00', '2017-09-02 23:00:00', '3', 1, NULL, '2017-09-23 19:55:19'),
(2, 'teste2', '2018-02-21 21:11:00', '2018-02-21 20:20:00', '4', 1, NULL, NULL),
(3, 'Ainda em produção', '2017-09-01 10:00:43', '0000-00-00 00:00:00', '0', 2, NULL, NULL),
(4, 'Teste', '2017-09-16 13:39:04', '2017-09-16 13:39:04', '0', 1, NULL, NULL),
(5, 'Teste', '2017-09-23 16:50:43', '2017-09-24 00:00:00', '0', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `fabricante_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`id`, `nome`, `fabricante_id`) VALUES
(1, 'Aspire ES 15', 1),
(2, 'Inspirion 15 1550', 4),
(4, 'P5L-MX', 3),
(5, 'Latitude E5530', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `so`
--

CREATE TABLE `so` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `versao` varchar(45) DEFAULT NULL,
  `arq` varchar(45) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `so`
--

INSERT INTO `so` (`id`, `nome`, `versao`, `arq`, `path`) VALUES
(1, 'Windows 10 Home', '1703', NULL, NULL),
(3, 'Windows 10 Pro', '1703', NULL, NULL),
(4, 'Windows 10 Pro', '1607', NULL, NULL),
(5, 'Windows 7 Professional', '', NULL, NULL),
(6, 'Debian', '8.7', '64 bits', '\\\\backup\\iso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `grupo_id`) VALUES
(1, 'Adminsitrador', 'administrador@administrador.com.br', '$2y$10$EjEeYLPasDSVcSDH.soeI.sLbV1oKxeZgwpVGPBj6/gEDdRbRY.1u', '2017-09-17 19:55:49', '2017-09-17 21:36:37', 1),
(2, 'Jorge M. Abdalla', 'jorge_miguelcga@hotmail.com', '$2y$10$lOSgDPN0cNo75cgq9IH7E.k6rHnbqn9zJ3gDzdhmXiWhxbY1lzb6m', '2017-09-17 19:59:57', '2017-09-24 23:45:42', 1),
(3, 'Usuário', 'usuario@user.com', '$2y$10$a2d04pdTp996t7Zp2E95yOmGMqNQJio3fcYvrHKofSNhb/lNSENAq', '2017-09-24 22:56:08', '2017-09-24 22:56:56', 2),
(4, '', '', '$2y$10$esA3ucl6A6vW5htmMYUg1OW.HiD1lZQk.4QLFgNxSQa32bbeSLN32', '2017-09-24 23:41:31', '2017-09-24 23:41:31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ativo`
--
ALTER TABLE `ativo`
  ADD PRIMARY KEY (`id`,`categoria_ativo_id`),
  ADD KEY `fk_ativo_categoria_ativo1_idx` (`categoria_ativo_id`),
  ADD KEY `fk_ativo_so1_idx` (`so_id`),
  ADD KEY `fk_ativo_modelo1_idx` (`modelo_id`),
  ADD KEY `fk_ativo_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `categoria_ativo`
--
ALTER TABLE `categoria_ativo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria_componente`
--
ALTER TABLE `categoria_componente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria_equipamento`
--
ALTER TABLE `categoria_equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria_licenca`
--
ALTER TABLE `categoria_licenca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `componente`
--
ALTER TABLE `componente`
  ADD PRIMARY KEY (`id`,`categoria_componente_id`),
  ADD KEY `fk_componente_categoria_componente1_idx` (`categoria_componente_id`),
  ADD KEY `fk_componente_ativo1_idx` (`ativo_id`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`,`categoria_equipamento_id`),
  ADD KEY `fk_equipamento_categoria_equipamento1_idx` (`categoria_equipamento_id`),
  ADD KEY `fk_equipamento_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interface_rede`
--
ALTER TABLE `interface_rede`
  ADD PRIMARY KEY (`id`,`ativo_id`),
  ADD KEY `fk_interface_rede_ativo1_idx` (`ativo_id`);

--
-- Indexes for table `licenca`
--
ALTER TABLE `licenca`
  ADD PRIMARY KEY (`id`,`categoria_licenca_id`),
  ADD KEY `fk_licenca_categoria_licenca1_idx` (`categoria_licenca_id`);

--
-- Indexes for table `licenciamento`
--
ALTER TABLE `licenciamento`
  ADD PRIMARY KEY (`ativo_id`,`licenca_id`),
  ADD KEY `fk_licenciamento_licenca1_idx` (`licenca_id`);

--
-- Indexes for table `manutencao`
--
ALTER TABLE `manutencao`
  ADD PRIMARY KEY (`id`,`ativo_id`),
  ADD KEY `fk_manutencao_ativo1_idx` (`ativo_id`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`,`fabricante_id`),
  ADD KEY `fk_modelo_fabricante_idx` (`fabricante_id`);

--
-- Indexes for table `so`
--
ALTER TABLE `so`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_usuario_grupo1_idx` (`grupo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ativo`
--
ALTER TABLE `ativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categoria_ativo`
--
ALTER TABLE `categoria_ativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categoria_componente`
--
ALTER TABLE `categoria_componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categoria_equipamento`
--
ALTER TABLE `categoria_equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categoria_licenca`
--
ALTER TABLE `categoria_licenca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `componente`
--
ALTER TABLE `componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `interface_rede`
--
ALTER TABLE `interface_rede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `licenca`
--
ALTER TABLE `licenca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `manutencao`
--
ALTER TABLE `manutencao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `so`
--
ALTER TABLE `so`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
