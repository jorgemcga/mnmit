-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Set-2017 às 16:31
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

--
-- Extraindo dados da tabela `ativo`
--

INSERT INTO `ativo` (`ativo_id`, `nrpatrimonio`, `nome`, `tag`, `descricao`, `datacompra`, `monitorar`, `categoria_ativo_id`, `so_id`, `serial`, `modelo_id`, `usuario_id`) VALUES
(1, '1', 'Notebook Acer', 'ES1-572-32LD', 'Notebook do Jorge', '2017-08-11', '1', 1, 3, 'Y2F7C-N2PMX-VT48Y-77Y7K-WTYP6', 1, NULL),
(2, '2', 'Desktop Familia', 'N/A', '', '2009-01-10', '0', 2, 1, '', 4, NULL);

--
-- Extraindo dados da tabela `categoria_ativo`
--

INSERT INTO `categoria_ativo` (`categoria_ativo_id`, `nome`) VALUES
(1, 'Notebook'),
(2, 'Desktop'),
(3, 'Impressora'),
(4, 'Switch');

--
-- Extraindo dados da tabela `categoria_componente`
--

INSERT INTO `categoria_componente` (`categoria_componente_id`, `nome`, `tipo_valor`, `sigla_valor`) VALUES
(1, 'Disco Rígido Físico', 'GigaBytes', 'GB'),
(2, 'Memória DDR4', 'GigaBytes', 'GB');

--
-- Extraindo dados da tabela `categoria_equipamento`
--

INSERT INTO `categoria_equipamento` (`categoria_equipamento_id`, `nome`) VALUES
(1, 'Teclado'),
(3, 'Mouse'),
(4, 'Fones de Ouvido');

--
-- Extraindo dados da tabela `categoria_licenca`
--

INSERT INTO `categoria_licenca` (`categoria_licenca_id`, `nome`, `sigla`) VALUES
(1, 'GNU General Public License', 'GPL');

--
-- Extraindo dados da tabela `componente`
--

INSERT INTO `componente` (`componente_id`, `nome`, `valor`, `categoria_componente_id`, `ativo_id`) VALUES
(1, 'Disco Rídigo', '970', 1, 0),
(2, 'Memória 2', '2', 2, 2);

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`equipamento_id`, `nrpatrimonio`, `nome`, `datacompra`, `categoria_equipamento_id`, `usuario_id`) VALUES
(1, '1', 'Teclado Reserva', '2017-08-31', 1, NULL);

--
-- Extraindo dados da tabela `fabricante`
--

INSERT INTO `fabricante` (`fabricante_id`, `nome`) VALUES
(1, 'Acer'),
(3, 'Asus'),
(4, 'Dell');

--
-- Extraindo dados da tabela `interface_rede`
--

INSERT INTO `interface_rede` (`interface_rede_id`, `hostname`, `ip`, `mascara`, `gateway`, `dns1`, `dns2`, `macaddress`, `ativo_id`) VALUES
(1, 'NOTE_JMA', '192.168.2.11', '255.255.255.0', '192.196.2.10', '192.168.2.8', '192.168.2.7', '5C-C9-D3-88-2B-BF', 1),
(6, 'DESK_FAMILIA', '192.168.2.9', '255.255.255.0', '192.196.2.10', '192.168.2.8', '192.168.2.7', '5C-C9-D3-88-2B-BF', 2);

--
-- Extraindo dados da tabela `licenca`
--

INSERT INTO `licenca` (`licenca_id`, `nome`, `serial`, `datacompra`, `datavence`, `categoria_licenca_id`) VALUES
(1, 'Xen1 Licença', 'N/A', '2017-09-09', '2018-09-09', 1);

--
-- Extraindo dados da tabela `manutencao`
--

INSERT INTO `manutencao` (`manutencao_id`, `descricao`, `datainicio`, `datafim`, `status`, `ativo_id`) VALUES
(1, 'teste', '2017-08-31 23:00:00', '2017-09-01 23:00:00', '3', 1),
(2, 'teste2', '2018-02-21 21:11:00', '2018-02-21 20:20:00', '4', 1),
(3, 'Ainda em produção', '2017-09-01 10:00:43', '0000-00-00 00:00:00', '0', 2);

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`modelo_id`, `nome`, `fabricante_id`) VALUES
(1, 'Aspire ES 15', 1),
(2, 'Inspirion 15 1550', 4),
(4, 'P5L-MX', 3);

--
-- Extraindo dados da tabela `so`
--

INSERT INTO `so` (`so_id`, `nome`, `versao`) VALUES
(1, 'Windows 10 Home', '1703'),
(3, 'Windows 10 Pro', '1703'),
(4, 'Windows 10 Pro', '1607'),
(5, 'Windows 7 Professional', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
