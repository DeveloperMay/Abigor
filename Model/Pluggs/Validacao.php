<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "31/07/2018",
	"MODEL": "Validacão",
	"LAST EDIT": "31/10/2018",
	"VERSION":"0.0.3"
}
*/

class Model_Pluggs_Validacao {
	
	function __construct(){

	}

	function novaVaga($dados){

		$error 		= 0;
		$mensagem 	= '';

		/* VALIDAÇÃO DE VAGAS */
		$vag_quantidade = $dados['vag_quantidade'] ?? '';

		if(empty($vag_quantidade)){

			$error = 1;
			$mensagem = 'Informe o número de vagas!';

		}elseif(!is_numeric($vag_quantidade)){

			$error = 1;
			$mensagem = 'Informe o número de vagas corretamente!';

		}elseif($vag_quantidade < 1){

			$erro = 1;
			$mensagem = 'O número de vagas precisa ser no 1 ou mais!';

		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE DISCIPLINA */
		$dis_codigo = $dados['dis_codigo'] ?? '';

		if(empty($dis_codigo)){

			$error = 1;
			$mensagem = 'Informe a disciplina!';

		}elseif(!is_numeric($dis_codigo)){

			$error = 1;
			$mensagem = 'Informe a disciplina corretamente!';

		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE ATEDIA */
		$vag_atedia = $dados['vag_atedia'] ?? '';

		if(empty($vag_atedia)){

			$error = 1;
			$mensagem = 'Informe até o dia!';

		}elseif($vag_atedia < date('dmY')){

			$error = 1;
			$mensagem = 'Até o dia não pode ser retroativo!';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		if($error === 0){
			return true;
		}
	}

	function novaInscricao($dados){

		$error 		= 0;
		$mensagem 	= '';

		/* VALIDAÇÃO DE ALUNO */
		$pes_codigo = $dados['pes_codigo'] ?? '';

		if(empty($pes_codigo)){

			$error = 1;
			$mensagem = 'Informe o aluno!';

		}elseif(!is_numeric($pes_codigo)){

			$error = 1;
			$mensagem = 'Informe o aluno corretamente!';

		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE VAGA */
		$vag_codigo = $dados['vag_codigo'] ?? '';

		if(empty($vag_codigo)){

			$error = 1;
			$mensagem = 'Informe a vaga!';

		}elseif(!is_numeric($vag_codigo)){

			$error = 1;
			$mensagem = 'Informe a vaga corretamente!';

		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE DATA */
		$ins_data_marcado = $dados['ins_data_marcado'] ?? '';

		if(empty($ins_data_marcado)){

			$error = 1;
			$mensagem = 'Informe a data da inscrição!';

		}elseif(strlen($ins_data_marcado) !== 8){

			$error = 1;
			$mensagem = 'Informe a data da inscrição corretamente!';

		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE HORA */
		$ins_hora_marcado = $dados['ins_hora_marcado'] ?? '';

		if(empty($ins_hora_marcado)){

			$error = 1;
			$mensagem = 'Informe a hora da inscrição!';

		}elseif(strlen($ins_hora_marcado) !== 4){

			$error = 1;
			$mensagem = 'Informe a hora da inscrição corretamente!';

		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		if($error === 0){
			return true;
		}
	}

	function novaDisciplina($dados){

		$error 		= 0;
		$mensagem 	= '';

		/* VALIDAÇÃO DE NOME DISCIPLINA */
		$dis_nome 	= $dados['dis_nome'] ?? '';

		if(empty($dis_nome)){

			$error = 1;
			$mensagem = 'Informe o nome da disciplina!';

		}elseif(strlen($dis_nome) < 4){

			$error = 1;
			$mensagem = 'Informe o nome da disciplina completo!';

		}elseif(strlen($dis_nome) > 35){

			$error = 1;
			$mensagem = 'Nome da disciplina muito grande!';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE ENSINO - MEDIO - FUNDAMENTAL */
		$dis_ensino 	= $dados['dis_ensino'] ?? '';

		if(empty($dis_ensino)){

			$error = 1;
			$mensagem = 'Informe o tipo de ensino da disciplina, ensino médio ou fundamental!';

		}elseif($dis_ensino !== 1 OR $dis_ensino !== 2){

			$error = 1;
			$mensagem = 'Informe corretamente se a disciplina é do ensino médio ou fundamental!';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		if($error === 0){
			return true;
		}
	}

	function novaPessoa($dados){

		$error 		= 0;
		$mensagem 	= '';

		/* VALIDAÇÃO DE NOME */
		$nome 	= $dados['nome'] ?? '';

		if(empty($nome)){

			$error = 1;
			$mensagem = 'Informe seu nome, ou você não tem!?';

		}elseif(!preg_match('/[A-Z][a-z]* [A-Z][a-z]*/', $nome)){

			$error = 1;
			$mensagem = 'Informe seu nome completo e correto!';

		}elseif(strlen($nome) < 6){

			$error = 1;
			$mensagem = 'Informe seu nome completo!';

		}elseif(strlen($nome) > 35){

			$error = 1;
			$mensagem = 'Porra! Seu nome é muito grande, diminiu isso!';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO EMAIL */
		$email 		= $dados['email'];
		$matchEmail = '/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/';
		
		if(empty($email)){

			$error = 1;
			$mensagem = 'Informe seu e-mail caralho!';

		}elseif(!preg_match($matchEmail, $email)){

			$error = 1;
			$mensagem = 'Esse e-mail é inválido, está tentando enganar quem ?';

		}elseif(strlen($email) > 50){

			$error = 1;
			$mensagem = 'Seu e-mail é muito grande! arruma outro aí..';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		if($error === 0){
			return true;
		}
	}

	function _criarLogin($dados){

		$error 		= 0;
		$mensagem 	= '';

		/* VALIDAÇÃO DE NOME */
		$nome 	= $dados['nome'] ?? '';

		if(empty($nome)){

			$error = 1;
			$mensagem = 'Informe seu nome, ou você não tem!?';

		}elseif(!preg_match('/[A-Z][a-z]* [A-Z][a-z]*/', $nome)){

			$error = 1;
			$mensagem = 'Informe seu nome completo e correto!';

		}elseif(strlen($nome) < 6){

			$error = 1;
			$mensagem = 'Informe seu nome completo!';

		}elseif(strlen($nome) > 35){

			$error = 1;
			$mensagem = 'Porra! Seu nome é muito grande, diminiu isso!';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO EMAIL */
		/*$email 		= $dados['email'];
		$matchEmail = '/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/';
		
		if(empty($email)){

			$error = 1;
			$mensagem = 'Informe seu e-mail caralho!';

		}elseif(!preg_match($matchEmail, $email)){

			$error = 1;
			$mensagem = 'Esse e-mail é inválido, está tentando enganar quem ?';

		}elseif(strlen($email) > 50){

			$error = 1;
			$mensagem = 'Seu e-mail é muito grande! arruma outro aí..';
		}

		/* SE HOUVER ERRO, EXIBIR */
		/*if($error > 0){

			return $mensagem;
		}*/


		/* VALIDAÇÃO SENHA */
		$senha 	= $dados['senha'];
		if(empty($senha)){

			$error = 1;
			$mensagem = 'Informe sua senha, como pretende ser identificado se não for por senha?';
		
		}elseif(strlen($senha) < 8){

			$error = 1;
			$mensagem = 'Sua senha precisa ter mais de 8 digitos, capricha ae!';

		}elseif(strlen($senha) > 50){

			$error = 1;
			$mensagem = 'Sua senha não pode ser muito longa, você é muito exagerado!';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		if($error === 0){
			return true;
		}

	}
}