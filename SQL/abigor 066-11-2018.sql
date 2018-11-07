-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2018 às 10:31
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
  `bai_codigo` int(10) NOT NULL,
  `cid_codigo` int(10) NOT NULL,
  `esc_codigo` int(10) NOT NULL,
  `pes_tipo` smallint(6) NOT NULL DEFAULT '1' COMMENT '1 = aluno, 2 professor',
  `pes_ensino` smallint(10) NOT NULL DEFAULT '1' COMMENT '1= médio, 2 = fundamental',
  `pes_nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `pes_nascimento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pes_cpf` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_rg` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_sexo` smallint(10) NOT NULL,
  `pes_telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_whats` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `pes_status` smallint(10) NOT NULL,
  `pes_data` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_hora` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_atualizacao` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cad_pessoa`
--

INSERT INTO `cad_pessoa` (`pes_codigo`, `bai_codigo`, `cid_codigo`, `esc_codigo`, `pes_tipo`, `pes_ensino`, `pes_nome`, `pes_nascimento`, `pes_cpf`, `pes_rg`, `pes_sexo`, `pes_telefone`, `pes_whats`, `pes_email`, `pes_status`, `pes_data`, `pes_hora`, `pes_ip`, `pes_atualizacao`) VALUES
(5, 0, 0, 1, 1, 1, 'Matheus Fogaça<a href=\"#\"> Maydana</a>', '', '84167670097', '', 1, '', '', '', 0, '06/11/2018', '09:32:57', '127.0.0.1', '06/11/2018');

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
  `log_codigo` int(10) NOT NULL,
  `log_codigo_change` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erro_log`
--

CREATE TABLE `erro_log` (
  `err_codigo` int(10) NOT NULL,
  `err_line` int(10) NOT NULL,
  `err_code` int(10) NOT NULL,
  `err_file` varchar(150) NOT NULL,
  `err_funcao` varchar(150) NOT NULL,
  `err_message` varchar(150) NOT NULL,
  `log_codigo` int(10) NOT NULL,
  `err_cliente` varchar(150) NOT NULL,
  `err_dominio` varchar(150) NOT NULL,
  `err_uri` varchar(150) NOT NULL,
  `err_referer` varchar(150) NOT NULL,
  `err_data` varchar(30) NOT NULL,
  `err_hora` varchar(30) NOT NULL,
  `err_ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `erro_log`
--

INSERT INTO `erro_log` (`err_codigo`, `err_line`, `err_code`, `err_file`, `err_funcao`, `err_message`, `log_codigo`, `err_cliente`, `err_dominio`, `err_uri`, `err_referer`, `err_data`, `err_hora`, `err_ip`) VALUES
(17, 104, 0, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Login.php', 'Model_Bancodados_Login::login', 'There is already an active transaction', 0, 'CLIENTE', 'abigor.com.br', '/login/entrar', 'http://abigor.local/login', '03/11/2018', '23:53:47', '127.0.0.1'),
(18, 187, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Disciplina.php', 'Model_Bancodados_Disciplina::_novaDisciplina', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'abigor.disciplinsa\' doesn\'t exist', 12, 'Escola São Patrick', 'abigor.com.br', '/disciplina/novo', 'http://abigor.local/disciplina/cadastrar', '05/11/2018', '11:24:59', '127.0.0.1'),
(19, 87, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'est_codigo\' in \'field list\'', 11, 'Escola São Patrick', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '05/11/2018', '11:31:21', '127.0.0.1'),
(20, 87, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'est_codigo\' in \'field list\'', 11, 'Escola São Patrick', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '05/11/2018', '11:31:26', '127.0.0.1'),
(21, 87, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'est_codigo\' in \'field list\'', 11, 'Escola São Patrick', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '05/11/2018', '11:31:56', '127.0.0.1'),
(22, 87, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'est_codigo\' in \'field list\'', 11, 'Escola São Patrick', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '05/11/2018', '11:32:13', '127.0.0.1'),
(23, 87, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'est_codigo\' in \'field list\'', 11, 'Escola São Patrick', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '05/11/2018', '11:32:43', '127.0.0.1'),
(24, 87, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Consultas.php', 'Model_Bancodados_Consultas::__construct', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'log.log_codig\' in \'field list\'', 11, 'CLIENTE', 'abigor.com.br', '/pessoa', 'http://abigor.local/pessoa', '06/11/2018', '08:50:54', '127.0.0.1'),
(25, 86, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Consultas.php', 'Model_Bancodados_Consultas::__construct', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'log.log_codig\' in \'field list\'', 11, 'Desconhecido', 'abigor.com.br', '/pessoa', 'http://abigor.local/pessoa', '06/11/2018', '08:54:26', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `esc_codigo` int(10) NOT NULL,
  `esc_nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`esc_codigo`, `esc_nome`) VALUES
(2, 'Escola Afonso Volpato'),
(1, 'Escola São Patrick');

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
  `ins_status` smallint(6) NOT NULL DEFAULT '2' COMMENT '1 = recusado, 2 = aceito',
  `log_codigo_change` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `log_codigo` int(10) NOT NULL,
  `esc_codigo` int(10) NOT NULL,
  `log_group` smallint(6) NOT NULL DEFAULT '6' COMMENT '6 DEUS',
  `log_cpf` varchar(30) DEFAULT NULL,
  `log_nome` varchar(20) NOT NULL,
  `log_senha` varchar(20) NOT NULL,
  `log_status` smallint(10) NOT NULL COMMENT '1 on, 2 off',
  `log_hora` varchar(20) NOT NULL,
  `log_data` varchar(20) NOT NULL,
  `log_ip` varchar(20) NOT NULL,
  `log_atualizacao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`log_codigo`, `esc_codigo`, `log_group`, `log_cpf`, `log_nome`, `log_senha`, `log_status`, `log_hora`, `log_data`, `log_ip`, `log_atualizacao`) VALUES
(4, 1, 6, '84167670097', 'Abigor', '89578779', 2, '10:14:16', '06/11/2018', '192.168.0.100', '06/11/2018'),
(11, 1, 4, '123456789', 'Teste Ajax', '123456789', 2, '07:41:37', '06/11/2018', '127.0.0.1', '06/11/2018'),
(12, 1, 5, '12345678', 'Jasmin Dolares', '12345678', 2, '11:25:11', '05/11/2018', '127.0.0.1', '05/11/2018');

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
  `vag_ip` varchar(20) NOT NULL,
  `log_codigo_change` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cad_pessoa`
--
ALTER TABLE `cad_pessoa`
  ADD PRIMARY KEY (`pes_codigo`),
  ADD UNIQUE KEY `pes_cpf` (`pes_cpf`),
  ADD KEY `esc_codigo` (`esc_codigo`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`dis_codigo`),
  ADD KEY `esc_codigo` (`esc_codigo`),
  ADD KEY `disciplina_ibfk_2` (`log_codigo`);

--
-- Indexes for table `erro_log`
--
ALTER TABLE `erro_log`
  ADD PRIMARY KEY (`err_codigo`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`esc_codigo`),
  ADD UNIQUE KEY `esc_nome` (`esc_nome`);

--
-- Indexes for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`ins_codigo`),
  ADD KEY `pes_codigo` (`pes_codigo`),
  ADD KEY `log_codigo` (`log_codigo`),
  ADD KEY `inscricao_ibfk_2` (`vag_codigo`),
  ADD KEY `esc_codigo` (`esc_codigo`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`log_codigo`),
  ADD UNIQUE KEY `log_codigo` (`log_codigo`),
  ADD UNIQUE KEY `log_cpf` (`log_cpf`),
  ADD KEY `esc_codigo` (`esc_codigo`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`vag_codigo`),
  ADD KEY `log_codigo` (`log_codigo`),
  ADD KEY `dis_codigo` (`dis_codigo`),
  ADD KEY `esc_codigo` (`esc_codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cad_pessoa`
--
ALTER TABLE `cad_pessoa`
  MODIFY `pes_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `dis_codigo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erro_log`
--
ALTER TABLE `erro_log`
  MODIFY `err_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `esc_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `ins_codigo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `log_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `vag_codigo` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cad_pessoa`
--
ALTER TABLE `cad_pessoa`
  ADD CONSTRAINT `cad_pessoa_ibfk_1` FOREIGN KEY (`esc_codigo`) REFERENCES `escola` (`esc_codigo`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`esc_codigo`) REFERENCES `escola` (`esc_codigo`),
  ADD CONSTRAINT `disciplina_ibfk_2` FOREIGN KEY (`log_codigo`) REFERENCES `login` (`log_codigo`);

--
-- Limitadores para a tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`pes_codigo`) REFERENCES `cad_pessoa` (`pes_codigo`),
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`vag_codigo`) REFERENCES `vaga` (`vag_codigo`),
  ADD CONSTRAINT `inscricao_ibfk_3` FOREIGN KEY (`log_codigo`) REFERENCES `login` (`log_codigo`),
  ADD CONSTRAINT `inscricao_ibfk_4` FOREIGN KEY (`esc_codigo`) REFERENCES `escola` (`esc_codigo`);

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`esc_codigo`) REFERENCES `escola` (`esc_codigo`);

--
-- Limitadores para a tabela `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `vaga_ibfk_1` FOREIGN KEY (`log_codigo`) REFERENCES `login` (`log_codigo`),
  ADD CONSTRAINT `vaga_ibfk_2` FOREIGN KEY (`dis_codigo`) REFERENCES `disciplina` (`dis_codigo`),
  ADD CONSTRAINT `vaga_ibfk_3` FOREIGN KEY (`esc_codigo`) REFERENCES `escola` (`esc_codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
