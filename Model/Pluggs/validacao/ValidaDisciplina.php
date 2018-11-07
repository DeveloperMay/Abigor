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

class ValidaDisciplina{

	function novaDisciplina($dados){

		$error 		= 0;
		$mensagem 	= '';

		/* VALIDAÇÃO DE NOME DISCIPLINA */
		$dis_nome 	= $dados['dis_nome'] ?? '';

		if(empty($dis_nome)){

			$error = 1;
			$mensagem = 'Informe o nome da disciplina!';

		}elseif(!preg_match('/^[a-z A-Z]*$/', $dis_nome)){

			$error = 1;
			$mensagem = 'Nome da disciplina não pode conter números e nem caracteres especiais!';

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

		}elseif(!preg_match('/^[0-9]*$/', $dis_ensino)){

			$error = 1;
			$mensagem = 'Esta opção não é ensino médio nem ensino fundamental!';

		}elseif(!is_numeric($dis_ensino)){

			$error = 1;
			$mensagem = 'Esta opção não é ensino médio nem ensino fundamental!';

		}elseif($dis_ensino != 1 AND $dis_ensino != 2 AND $dis_ensino != 3){

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
}