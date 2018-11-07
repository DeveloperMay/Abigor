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

require_once 'ValidaCadastrologin.php';

class ValidaPessoa extends ValidaCadastrologin{

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

		}elseif(strlen($nome) > 40){

			$error = 1;
			$mensagem = 'Porra! Seu nome é muito grande, diminiu isso!';
		}

		/* SE HOUVER ERRO, EXIBIR */
		if($error > 0){

			return $mensagem;
		}


		/* VALIDAÇÃO DE CPF */
		$cpf 	= $dados['cpf'] ?? '';

		if(empty($cpf)){

			$error = 1;
			$mensagem = 'Informe o CPF!';

		}elseif(!preg_match('/[0-9]*/', $cpf)){

			$error = 1;
			$mensagem = 'Informe o CPF com somente números';

		}elseif(strlen($cpf) < 11){

			$error = 1;
			$mensagem = 'Informe o CPF completamente, faltam números!';

		}elseif(strlen($cpf) > 13){

			$error = 1;
			$mensagem = 'Informe somente os números do CPF, está muito grande!';
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