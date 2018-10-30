<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "25/10/2018",
		"CONTROLADOR": "Disciplina",
		"LAST EDIT": "25/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Bancodados_Disciplina extends Model_Bancodados_Inscricao {

	function _getDisciplinasVagas(){

		$esc_codigo = ESC_CODIGO;

		$sql = $this->_conexao->prepare("
			SELECT 
				vag.vag_codigo,
				vag.vag_quantidade,
				vag.vag_atedia,
				dis.dis_codigo,
				dis.dis_ensino,
				dis.dis_nome
			FROM disciplina AS dis
			LEFT JOIN vaga AS vag ON vag.dis_codigo = dis.dis_codigo
			WHERE dis.esc_codigo = :esc_codigo
			ORDER BY dis.dis_ensino ASC, dis.dis_nome ASC
		");
		$sql->bindParam(':esc_codigo', $esc_codigo);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Select _getDisciplinasVagas');
		$fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql = null;

		$html = '';
		foreach($fetch as $arr){

			if(isset($arr['vag_atedia']) and $arr['vag_atedia'] <= date('dmY')){
				continue;
			}

			$ensino = 'Ensino Médio';
			if(isset($arr['dis_ensino']) and $arr['dis_ensino'] == 2){
				$ensino = 'Ensino Fundamental';
			}

			$html .= <<<php
		<option value="{$arr['dis_codigo']}">{$arr['dis_nome']} - {$ensino}</option>
php;
		}

		return $html;
	}

	function _getDisciplinas(){

		$esc_codigo = ESC_CODIGO;

		$sql = $this->_conexao->prepare("
			SELECT 
				*
			FROM disciplina
			WHERE esc_codigo = :esc_codigo
			ORDER BY dis_ensino ASC, dis_nome ASC
		");
		$sql->bindParam(':esc_codigo', $esc_codigo);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Select _getDisciplinas');
		$fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql = null;

		$html = '';

		foreach($fetch as $arr){

			$ensino = 'Ensino Médio';
			if(isset($arr['dis_ensino']) and $arr['dis_ensino'] == 2){
				$ensino = 'Ensino Fundamental';
			}

			$html .= <<<php
		<option value="{$arr['dis_codigo']}">{$arr['dis_nome']} - {$ensino}</option>
php;
		}

		return $html;
	}

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
		new Model_Debugger($sql, __METHOD__, 'Select _getDisciplina');
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