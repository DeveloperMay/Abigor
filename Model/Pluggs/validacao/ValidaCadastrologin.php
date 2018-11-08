<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "31/07/2018",
	"MODEL": "Validacão",
	"LAST EDIT": "08/11/2018",
	"VERSION":"0.0.4"
}
*/

require_once 'ValidaVaga.php';

class ValidaCadastrologin extends ValidaVaga{

	function novoCadastrologin($dados){

		$error 		= 0;
		$mensagem 	= '';

		/* VALIDAÇÃO DE NOME */
		$log_nome 	= $dados['log_nome'] ?? '';

		if(empty($log_nome)){

			$error = 1;
			$mensagem = 'Informe o nome do Login';

		}elseif(!preg_match('/[A-Z][a-z]* [A-Z][a-z]*/', $log_nome)){

			$error = 1;
			$mensagem = 'Informe seu nome completo e correto!';

		}elseif(strlen($log_nome) < 6){

			$error = 1;
			$mensagem = 'Informe o nome completo!';

		}elseif(strlen($log_nome) > 20){

			$error = 1;
			$mensagem = 'O nome do login é muito grande!';
		}
		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE ACESSO */
		$log_group = $dados['log_group'] ?? '';

		if(empty($log_group)){

			$error = 1;
			$mensagem = 'Informe o tipo de acesso do login';

		}elseif(!preg_match('/^[0-9]*$/', $log_group)){

			$error = 1;
			$mensagem = 'Esta opção não é nenhum tipo de acesso';

		}elseif(!is_numeric($log_group)){

			$error = 1;
			$mensagem = 'Esta opção não é nenhum tipo de acesso!';

		}
		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		/* VALIDAÇÃO DE CPF */
		$log_cpf = $dados['log_cpf'] ?? '';

		if(empty($log_cpf)){

			$error = 1;
			$mensagem = 'Informe o CPF do login';

		}elseif(!preg_match('/^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$/', $log_cpf)){

			$error = 1;
			$mensagem = 'Informe o cpf somente com números';

		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}

		$log_senha 	= $dados['log_senha'];
		if(empty($log_senha)){

			$error = 1;
			$mensagem = 'Informe a senha do login';
		
		}elseif(strlen($log_senha) < 8){

			$error = 1;
			$mensagem = 'A senha precisa ter mais de 8 digitos!';

		}elseif(strlen($log_senha) > 20){

			$error = 1;
			$mensagem = 'A senha não pode ser muito longa!';
		}
		if($error > 0){

			return $mensagem;
		}


		if($error === 0){
			return true;
		}
	}
}