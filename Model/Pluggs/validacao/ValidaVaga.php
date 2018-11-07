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

require_once 'ValidaInscricao.php';

class ValidaVaga extends ValidaInscricao{

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
}