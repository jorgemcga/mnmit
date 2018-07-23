-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Maio-2018 às 22:15
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.0.21

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
-- Estrutura da tabela `agendador`
--

CREATE TABLE `agendador` (
  `id` int(11) NOT NULL,
  `minute` char(2) NOT NULL DEFAULT '*',
  `hour` char(2) NOT NULL DEFAULT '*',
  `day` char(2) NOT NULL DEFAULT '*',
  `month` char(2) NOT NULL DEFAULT '*',
  `week` char(2) NOT NULL DEFAULT '*',
  `tipo` varchar(45) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `categoria_ativo_id` int(11) NOT NULL,
  `so_id` int(11) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `modelo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ativo_oid`
--

CREATE TABLE `ativo_oid` (
  `oid_id` int(11) NOT NULL,
  `ativo_id` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_ativo`
--

CREATE TABLE `categoria_ativo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_componente`
--

CREATE TABLE `categoria_componente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo_valor` varchar(45) DEFAULT NULL,
  `sigla_valor` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_equipamento`
--

CREATE TABLE `categoria_equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_licenca`
--

CREATE TABLE `categoria_licenca` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sigla` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE `fabricante` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `telegram_group` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_categoria_ativo`
--

CREATE TABLE `grupo_categoria_ativo` (
  `grupo_id` int(11) NOT NULL,
  `categoria_ativo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `http`
--

CREATE TABLE `http` (
  `status` char(1) NOT NULL,
  `descricao` varchar(1024) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `icmp`
--

CREATE TABLE `icmp` (
  `status` char(1) NOT NULL,
  `descricao` varchar(1024) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `interface_rede_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `monitorar` char(1) NOT NULL,
  `ativo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `internet`
--

CREATE TABLE `internet` (
  `ping` double DEFAULT NULL,
  `download` double DEFAULT NULL,
  `upload` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `licenciamento`
--

CREATE TABLE `licenciamento` (
  `ativo_id` int(11) NOT NULL,
  `licenca_id` int(11) NOT NULL,
  `datahora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `fabricante_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `monitor`
--

CREATE TABLE `monitor` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `plataforma` varchar(45) NOT NULL,
  `email` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `oid`
--

CREATE TABLE `oid` (
  `id` int(11) NOT NULL,
  `nome` varchar(1024) NOT NULL,
  `oid` varchar(255) NOT NULL,
  `versao` varchar(45) NOT NULL,
  `string` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `snmp`
--

CREATE TABLE `snmp` (
  `valor` varchar(1024) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `oid_id` int(11) NOT NULL,
  `ativo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` char(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_grupo`
--

CREATE TABLE `usuario_grupo` (
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendador`
--
ALTER TABLE `agendador`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ativo_oid`
--
ALTER TABLE `ativo_oid`
  ADD PRIMARY KEY (`oid_id`,`ativo_id`),
  ADD KEY `fk_ativo_oid_ativo1_idx` (`ativo_id`);

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
-- Indexes for table `grupo_categoria_ativo`
--
ALTER TABLE `grupo_categoria_ativo`
  ADD PRIMARY KEY (`grupo_id`,`categoria_ativo_id`),
  ADD KEY `categoria_ativo_id` (`categoria_ativo_id`);

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
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oid`
--
ALTER TABLE `oid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snmp`
--
ALTER TABLE `snmp`
  ADD KEY `fk_snmp_ativo1_idx` (`ativo_id`);

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
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD PRIMARY KEY (`usuario_id`,`grupo_id`),
  ADD KEY `group_user` (`grupo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendador`
--
ALTER TABLE `agendador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ativo`
--
ALTER TABLE `ativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categoria_ativo`
--
ALTER TABLE `categoria_ativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categoria_componente`
--
ALTER TABLE `categoria_componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categoria_equipamento`
--
ALTER TABLE `categoria_equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categoria_licenca`
--
ALTER TABLE `categoria_licenca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `componente`
--
ALTER TABLE `componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interface_rede`
--
ALTER TABLE `interface_rede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `licenca`
--
ALTER TABLE `licenca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `manutencao`
--
ALTER TABLE `manutencao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `oid`
--
ALTER TABLE `oid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `so`
--
ALTER TABLE `so`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `grupo_categoria_ativo`
--
ALTER TABLE `grupo_categoria_ativo`
  ADD CONSTRAINT `grupo_categoria_ativo_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupo_categoria_ativo_ibfk_2` FOREIGN KEY (`categoria_ativo_id`) REFERENCES `categoria_ativo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD CONSTRAINT `group_user` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
