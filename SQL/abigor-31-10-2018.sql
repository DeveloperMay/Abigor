-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31-Out-2018 às 16:27
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abigor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_pessoa`
--

CREATE TABLE `cad_pessoa` (
  `pes_codigo` int(10) NOT NULL,
  `esc_codigo` int(10) NOT NULL,
  `pes_nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `pes_cpf` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_rg` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_sexo` smallint(10) NOT NULL,
  `pes_nascimento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pes_telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_whats` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cid_codigo` int(10) NOT NULL,
  `est_codigo` int(10) NOT NULL,
  `bai_codigo` int(10) NOT NULL,
  `pes_status` smallint(10) NOT NULL,
  `pes_atualizacao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_criacao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_tipo` smallint(6) NOT NULL DEFAULT '1' COMMENT '1 = aluno, 2 professor',
  `pes_ensino` smallint(10) NOT NULL DEFAULT '1' COMMENT '1= médio, 2 = fundamental'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cad_pessoa`
--

INSERT INTO `cad_pessoa` (`pes_codigo`, `esc_codigo`, `pes_nome`, `pes_cpf`, `pes_rg`, `pes_sexo`, `pes_nascimento`, `pes_telefone`, `pes_whats`, `pes_email`, `cid_codigo`, `est_codigo`, `bai_codigo`, `pes_status`, `pes_atualizacao`, `pes_criacao`, `pes_ip`, `pes_tipo`, `pes_ensino`) VALUES
(4, 1, 'Matheus Fogaça Maydanas', '841.676.700-97', '', 1, '12/05/1995', '', '', 'email@para.teste', 0, 0, 0, 0, '', '', '', 1, 1),
(24, 1, 'Deusz Jesus', '', '', 1, '12/05/1995', '', '', 'mattheuszcabal@gmail.com', 0, 0, 0, 0, '', '', '', 1, 1),
(28, 1, 'Maria Elena Fagundes', '987987', '', 2, '01/10/2014', '', '', 'deus@jamais.com', 0, 0, 0, 0, '', '', '', 2, 1),
(29, 1, 'Shara TS', '898733', '', 2, '25/08/1975', '', '', 'sharaa@gmail.com', 0, 0, 0, 0, '', '', '', 2, 1),
(30, 1, 'Javali Muito', '8754557', '', 1, '12/05/1994', '', '', 'qwdiza@gmail.com', 0, 0, 0, 0, '', '', '', 1, 1),
(31, 1, 'Professor Girafales', '323477871', '', 1, '04/09/1930', '', '', 'gira@email.com', 0, 0, 0, 0, '', '', '', 2, 1),
(32, 1, 'Matheus Fogaça Maydana', '9879875', '', 2, '12/05/1994', '', '', 'eomail@para.teste', 0, 0, 0, 0, '', '', '', 1, 1),
(33, 1, 'Rita Cássia', '54548787', '', 2, '11/02/1999', '', '', 'rita@matheusz.com.br', 0, 0, 0, 0, '', '', '', 2, 1),
(34, 1, 'Brayan Munick', '54548787444', '', 1, '11/02/1974', '', '', 'bra@gwqewqd.com.br', 0, 0, 0, 0, '', '', '', 1, 1),
(35, 1, 'Sknup KP-903', '123456789', '', 1, '31/10/2018', '', '', 'sknup@email.com', 0, 0, 0, 0, '', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `dis_codigo` int(10) NOT NULL,
  `dis_ensino` smallint(6) NOT NULL DEFAULT '1' COMMENT '1 ensi medio, 2 ensi fundamental',
  `esc_codigo` int(10) NOT NULL,
  `dis_nome` varchar(50) NOT NULL,
  `dis_descricao` varchar(250) NOT NULL,
  `dis_criacao` varchar(20) NOT NULL,
  `dis_atualizacao` varchar(20) NOT NULL,
  `dis_ativo` smallint(10) NOT NULL DEFAULT '2' COMMENT '1 nao, 2 sim',
  `dis_ip` varchar(20) NOT NULL,
  `usu_codigo` int(10) NOT NULL,
  `usu_codigo_change` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`dis_codigo`, `dis_ensino`, `esc_codigo`, `dis_nome`, `dis_descricao`, `dis_criacao`, `dis_atualizacao`, `dis_ativo`, `dis_ip`, `usu_codigo`, `usu_codigo_change`) VALUES
(6, 1, 1, 'Português', 'ensino médio', '', '', 2, '', 0, 0),
(7, 2, 1, 'Português', 'ensino fundamental', '', '', 2, '', 0, 0),
(8, 1, 1, 'História', 'nossa história', '', '', 2, '', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE `inscricao` (
  `ins_codigo` int(10) NOT NULL,
  `pes_codigo` int(10) NOT NULL,
  `esc_codigo` int(10) NOT NULL,
  `vag_codigo` int(10) NOT NULL,
  `log_codigo` int(10) NOT NULL,
  `ins_ensino` smallint(6) NOT NULL DEFAULT '1' COMMENT '1 = medio, 2 = fundamental',
  `ins_descricao` varchar(250) NOT NULL,
  `ins_data_marcado` varchar(20) NOT NULL,
  `ins_hora_marcado` varchar(10) NOT NULL,
  `ins_dia_cadastro` varchar(20) NOT NULL,
  `ins_hora_cadastro` varchar(10) NOT NULL,
  `ins_ip` varchar(30) NOT NULL,
  `ins_status` smallint(6) NOT NULL DEFAULT '2' COMMENT '1 = recusado, 2 = aceito'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `inscricao`
--

INSERT INTO `inscricao` (`ins_codigo`, `pes_codigo`, `esc_codigo`, `vag_codigo`, `log_codigo`, `ins_ensino`, `ins_descricao`, `ins_data_marcado`, `ins_hora_marcado`, `ins_dia_cadastro`, `ins_hora_cadastro`, `ins_ip`, `ins_status`) VALUES
(17, 34, 1, 64, 2, 1, '', '31102018', '0830', '31/10/2018', '16:18:44', '127.0.0.1', 2),
(18, 24, 1, 64, 2, 1, '', '31102018', '0830', '31/10/2018', '16:18:48', '127.0.0.1', 2),
(19, 30, 1, 64, 2, 1, '', '31102018', '0830', '31/10/2018', '16:18:52', '127.0.0.1', 2),
(20, 32, 1, 64, 2, 1, '', '31102018', '0830', '31/10/2018', '16:18:55', '127.0.0.1', 2),
(21, 35, 1, 64, 2, 1, '', '31102018', '0830', '31/10/2018', '16:18:58', '127.0.0.1', 2),
(22, 34, 1, 65, 2, 1, '', '31102018', '0830', '31/10/2018', '16:19:04', '127.0.0.1', 2),
(23, 24, 1, 65, 2, 1, '', '31102018', '0830', '31/10/2018', '16:19:08', '127.0.0.1', 2),
(24, 32, 1, 65, 2, 1, '', '31102018', '0830', '31/10/2018', '16:19:10', '127.0.0.1', 2),
(25, 30, 1, 65, 2, 1, '', '31102018', '0830', '31/10/2018', '16:19:13', '127.0.0.1', 2),
(26, 35, 1, 65, 2, 1, '', '31102018', '0830', '31/10/2018', '16:19:21', '127.0.0.1', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `log_codigo` int(10) NOT NULL,
  `log_nome` varchar(20) NOT NULL,
  `log_senha` varchar(20) NOT NULL,
  `log_status` smallint(10) DEFAULT '2' COMMENT '1 on, 2 off',
  `log_criacao` varchar(20) NOT NULL,
  `log_hora` varchar(20) NOT NULL,
  `log_dia` varchar(20) NOT NULL,
  `log_ip` varchar(20) NOT NULL,
  `log_group` smallint(6) NOT NULL DEFAULT '6' COMMENT '6 DEUS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`log_codigo`, `log_nome`, `log_senha`, `log_status`, `log_criacao`, `log_hora`, `log_dia`, `log_ip`, `log_group`) VALUES
(2, 'Maydana Maydana', '89578779', 1, '25/10/2018', '17:46:34', '26/10/2018', '127.0.0.1', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `vag_codigo` int(10) NOT NULL,
  `log_codigo` int(10) NOT NULL,
  `esc_codigo` int(10) NOT NULL,
  `dis_codigo` int(10) NOT NULL,
  `vag_quantidade` int(10) NOT NULL,
  `vag_atedia` varchar(20) NOT NULL,
  `vag_descricao` varchar(250) NOT NULL,
  `vag_status` int(10) NOT NULL COMMENT '1 venceu, 2 ativo',
  `vag_hora_cadastro` varchar(10) NOT NULL,
  `vag_dia_cadastro` varchar(20) NOT NULL,
  `vag_ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`vag_codigo`, `log_codigo`, `esc_codigo`, `dis_codigo`, `vag_quantidade`, `vag_atedia`, `vag_descricao`, `vag_status`, `vag_hora_cadastro`, `vag_dia_cadastro`, `vag_ip`) VALUES
(62, 2, 1, 6, 25, '31102018', '', 1, '09:24:59', '31/10/2018', '127.0.0.1'),
(63, 2, 1, 6, 20, '31102018', '', 1, '09:26:40', '31/10/2018', '127.0.0.1'),
(64, 2, 1, 6, 19, '31102018', '', 2, '09:33:26', '31/10/2018', '127.0.0.1'),
(65, 2, 1, 8, 17, '31102018', '', 2, '16:04:03', '31/10/2018', '127.0.0.1'),
(66, 2, 1, 7, 25, '31102018', '', 2, '16:18:32', '31/10/2018', '127.0.0.1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_cad_pessoa`
-- (See below for the actual view)
--
CREATE TABLE `view_cad_pessoa` (
`pes_codigo` int(10)
,`pes_nome` varchar(150)
,`pes_nascimento` varchar(10)
,`pes_telefone` varchar(20)
,`pes_whats` varchar(20)
,`pes_cpf` varchar(20)
,`pes_rg` varchar(20)
,`pes_email` varchar(150)
,`pes_ip` varchar(20)
,`pes_atualizacao` varchar(20)
,`pes_criacao` varchar(20)
,`pes_sexo` varchar(6)
);

-- --------------------------------------------------------

--
-- Structure for view `view_cad_pessoa`
--
DROP TABLE IF EXISTS `view_cad_pessoa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cad_pessoa`  AS  select `cad_pessoa`.`pes_codigo` AS `pes_codigo`,`cad_pessoa`.`pes_nome` AS `pes_nome`,`cad_pessoa`.`pes_nascimento` AS `pes_nascimento`,`cad_pessoa`.`pes_telefone` AS `pes_telefone`,`cad_pessoa`.`pes_whats` AS `pes_whats`,`cad_pessoa`.`pes_cpf` AS `pes_cpf`,`cad_pessoa`.`pes_rg` AS `pes_rg`,`cad_pessoa`.`pes_email` AS `pes_email`,`cad_pessoa`.`pes_ip` AS `pes_ip`,`cad_pessoa`.`pes_atualizacao` AS `pes_atualizacao`,`cad_pessoa`.`pes_criacao` AS `pes_criacao`,(case `cad_pessoa`.`pes_sexo` when (`cad_pessoa`.`pes_sexo` = 1) then 'Homem' when (`cad_pessoa`.`pes_sexo` = 2) then 'Mulher' else 'Outro' end) AS `pes_sexo` from `cad_pessoa` order by `cad_pessoa`.`pes_nome` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cad_pessoa`
--
ALTER TABLE `cad_pessoa`
  ADD PRIMARY KEY (`pes_codigo`),
  ADD UNIQUE KEY `pes_cpf` (`pes_cpf`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`dis_codigo`);

--
-- Indexes for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`ins_codigo`),
  ADD KEY `pes_codigo` (`pes_codigo`),
  ADD KEY `log_codigo` (`log_codigo`),
  ADD KEY `inscricao_ibfk_2` (`vag_codigo`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`log_codigo`),
  ADD UNIQUE KEY `log_codigo` (`log_codigo`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`vag_codigo`),
  ADD KEY `log_codigo` (`log_codigo`),
  ADD KEY `dis_codigo` (`dis_codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cad_pessoa`
--
ALTER TABLE `cad_pessoa`
  MODIFY `pes_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `dis_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `ins_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `log_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `vag_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`pes_codigo`) REFERENCES `cad_pessoa` (`pes_codigo`),
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`vag_codigo`) REFERENCES `vaga` (`vag_codigo`),
  ADD CONSTRAINT `inscricao_ibfk_3` FOREIGN KEY (`log_codigo`) REFERENCES `login` (`log_codigo`);

--
-- Limitadores para a tabela `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `vaga_ibfk_1` FOREIGN KEY (`log_codigo`) REFERENCES `login` (`log_codigo`),
  ADD CONSTRAINT `vaga_ibfk_2` FOREIGN KEY (`dis_codigo`) REFERENCES `disciplina` (`dis_codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
