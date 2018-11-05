-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Nov-2018 às 09:02
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
  `est_codigo` int(10) NOT NULL,
  `esc_codigo` int(10) NOT NULL,
  `pes_tipo` smallint(6) NOT NULL DEFAULT '1' COMMENT '1 = aluno, 2 professor',
  `pes_ensino` smallint(10) NOT NULL DEFAULT '1' COMMENT '1= médio, 2 = fundamental',
  `pes_nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `cad_pessoa` (`pes_codigo`, `bai_codigo`, `cid_codigo`, `est_codigo`, `esc_codigo`, `pes_tipo`, `pes_ensino`, `pes_nome`, `pes_nascimento`, `pes_cpf`, `pes_rg`, `pes_sexo`, `pes_telefone`, `pes_whats`, `pes_email`, `pes_status`, `pes_data`, `pes_hora`, `pes_ip`, `pes_atualizacao`) VALUES
(40, 0, 0, 0, 1, 2, 1, 'Matheus Fogaça Maydana', '12/05/1995', '841.676.700-97', '', 1, '', '', 'matheus@objetivawebsites.com.br', 0, '01/11/2018', '20:17:25', '127.0.0.1', '01/11/2018');

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
(8, 1, 1, 'História', 'nossa história', '', '', 2, '', 0, 0),
(9, 1, 1, 'Matheus Fogaça Maydana', '', '', '', 2, '', 0, 0),
(10, 1, 1, 'Matheus MaydanaTeste', 'wdq', '', '', 2, '', 0, 0);

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
(2, 71, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nasome\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '19:52:17', '127.0.0.1'),
(3, 71, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nasome\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:00:31', '127.0.0.1'),
(4, 71, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nasome\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:02:44', '127.0.0.1'),
(5, 71, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nasome\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:04:15', '127.0.0.1'),
(6, 71, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nasome\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:05:39', '127.0.0.1'),
(7, 70, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nosme\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:26:54', '127.0.0.1'),
(8, 70, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nosme\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:29:18', '127.0.0.1'),
(9, 70, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nosme\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:29:43', '127.0.0.1'),
(10, 70, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nosme\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:30:37', '127.0.0.1'),
(11, 70, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Pessoa.php', 'Model_Bancodados_Pessoa::_novaPessoa', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'pes_nasdome\' in \'field list\'', 2, 'Escola de Testes', 'abigor.com.br', '/pessoa/novo', 'http://abigor.local/pessoa/cadastrar', '01/11/2018', '20:33:37', '127.0.0.1'),
(12, 187, 42, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Disciplina.php', 'Model_Bancodados_Disciplina::_novaDisciplina', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'abigor.disciplinsa\' doesn\'t exist', 2, 'Escola de Testes', 'abigor.com.br', '/disciplina/novo', 'http://abigor.local/disciplina/cadastrar', '02/11/2018', '06:31:15', '127.0.0.1'),
(13, 131, 0, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Login.php', 'Model_Bancodados_Login::_timesnow', 'There is already an active transaction', 0, 'Escola de Testes', 'abigor.com.br', '/login/entrar', 'http://192.168.0.100/login', '02/11/2018', '08:01:10', '192.168.0.101'),
(14, 131, 0, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Login.php', 'Model_Bancodados_Login::_timesnow', 'There is already an active transaction', 0, 'Escola de Testes', 'abigor.com.br', '/login/entrar', 'http://192.168.0.100/login', '02/11/2018', '08:05:56', '192.168.0.102'),
(15, 131, 0, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Login.php', 'Model_Bancodados_Login::_timesnow', 'There is already an active transaction', 0, 'Escola de Testes', 'abigor.com.br', '/login/entrar', 'http://192.168.0.100/login', '02/11/2018', '08:06:37', '192.168.0.102'),
(16, 131, 0, 'C:\\xampp\\htdocs\\Abigor\\Model\\Bancodados\\Login.php', 'Model_Bancodados_Login::_timesnow', 'There is already an active transaction', 0, 'Escola de Testes', 'abigor.com.br', '/login/entrar', 'http://abigor.local/login', '02/11/2018', '08:07:10', '127.0.0.1');

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
(2, 'Maydana Maydana', '89578779', 1, '25/10/2018', '08:13:38', '02/11/2018', '127.0.0.1', 6),
(3, 'Teste Celular', '123456789', 1, '', '08:13:53', '02/11/2018', '192.168.0.102', 6);

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
-- Indexes for table `erro_log`
--
ALTER TABLE `erro_log`
  ADD PRIMARY KEY (`err_codigo`);

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
  MODIFY `pes_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `dis_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `erro_log`
--
ALTER TABLE `erro_log`
  MODIFY `err_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `ins_codigo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `log_codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `vag_codigo` int(10) NOT NULL AUTO_INCREMENT;

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
