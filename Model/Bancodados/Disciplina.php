<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "26/10/2018",
		"CONTROLADOR": "Disciplina",
		"LAST EDIT": "26/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Bancodados_Disciplina {

	function _getDisciplina(){

		$esc_codigo = ESC_CODIGO;

		$sql = $this->_conexao->prepare("
			SELECT 
				*
			FROM disciplina
			WHERE esc_codigo = :esc_codigo
		");
		$sql->bindParam(':esc_codigo', $esc_codigo);
		$sql->execute();
		$fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql = null;

		$html = '';

		foreach($fetch as $arr){

			$html .= <<<php
		<div>{$arr['dis_nome']} - {$arr['dis_ensino']}</div>

		<br />
		<br />
		<br />
php;
		}

		return $html;
	}

	function _novaDisciplina($dados){

		$esc_codigo 	= ESC_CODIGO;
		$dis_nome		= $this->_util->basico($dados['dis_nome'] ?? null);
		$dis_ensino 	= $this->_util->basico($dados['dis_ensino'] ?? null);
		$dis_descricao 	= $this->_util->basico($dados['dis_descricao'] ?? null);

		$sql = $this->_conexao->prepare("
			SELECT dis_nome
			FROM disciplina
			WHERE dis_nome = :dis_nome AND dis_ensino = :dis_ensino
		");
		$sql->bindParam(':dis_nome', $dis_nome);
		$sql->bindParam(':dis_ensino', $dis_ensino);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Select nova disciplina');
		$temp = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = null;

		if(is_array($temp) and isset($temp['dis_nome']) and !empty($temp['dis_nome'])){

			/* JÁ EXISTE UM CADASTROM COM ESTE NOME OU CPF*/
			return 3;
		}

		$sql = $this->_conexao->prepare("INSERT INTO disciplina (
			esc_codigo,
			dis_nome,
			dis_descricao,
			dis_ensino
		) VALUES (
			:esc_codigo,
			:dis_nome,
			:dis_descricao,
			:dis_ensino
		)");
		$sql->bindParam(':esc_codigo', $esc_codigo);
		$sql->bindParam(':dis_nome', $dis_nome);
		$sql->bindParam(':dis_ensino', $dis_ensino);
		$sql->bindParam(':dis_descricao', $dis_descricao);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Cadastra nova disciplina');
		$fetch = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = null;

		/* SUCESSO */
		$return = 1;

		if($fetch === false){

			/* FALHA */
			$return = 2;
		}

		return $return;
	}

}