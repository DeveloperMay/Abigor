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

require_once 'ValidaDisciplina.php';

class ValidaInscricao extends ValidaDisciplina{

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
}