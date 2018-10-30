<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "29/10/2018",
		"MODEL": "Inscrição",
		"LAST EDIT": "29/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Bancodados_Inscricao extends Model_Bancodados_Vaga {

	function _getInscricaoes(){

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
		new Model_Debugger($sql, __METHOD__, 'Select get Todas inscrições');
		$fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql = null;

		$html = '';
	}

	function _novaInscricao($dados){

		$esc_codigo = ESC_CODIGO;
		$log_codigo = LOG_CODIGO;
		$pes_codigo	= $this->_util->basico($dados['pes_codigo'] ?? null);
		$dis_codigo = $this->_util->basico($dados['dis_codigo'] ?? null);
		$ins_data_marcado 	= $this->_util->basico($dados['ins_data_marcado'] ?? null);
		$ins_hora_marcado 	= $this->_util->basico($dados['ins_hora_marcado'] ?? null);

		$sql = $this->_conexao->prepare("
			SELECT pes_codigo
			FROM inscricao
			WHERE pes_codigo = :pes_codigo AND dis_codigo = :dis_codigo
		");
		$sql->bindParam(':pes_codigo', $pes_codigo);
		$sql->bindParam(':dis_codigo', $dis_codigo);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Select nova inscrição');
		$temp = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = null;

		if(is_array($temp) and isset($temp['pes_codigo']) and !empty($temp['pes_codigo'])){

			/* JÁ EXISTE UMA INSCRICAO COM ESTE PES_CODIGO E DISCIPLINA */
			return 3;
		}

		$sql = $this->_conexao->prepare("INSERT INTO inscricao (
			pes_codigo,
			dis_codigo,
			log_codigo,
			ins_data_marcado,
			ins_hora_marcado,
			ins_dia_cadastro,
			ins_hora_cadastro,
			ins_ip
		) VALUES (
			:pes_codigo,
			:dis_codigo,
			:log_codigo,
			:ins_data_marcado,
			:ins_hora_marcado,
			:ins_dia_cadastro,
			:ins_hora_cadastro,
			:ins_ip
		)");
		$sql->bindParam(':pes_codigo', $pes_codigo);
		$sql->bindParam(':dis_codigo', $dis_codigo);
		$sql->bindParam(':log_codigo', $log_codigo);
		$sql->bindParam(':ins_data_marcado', $ins_data_marcado);
		$sql->bindParam(':ins_hora_marcado', $ins_hora_marcado);
		$sql->bindParam(':ins_dia_cadastro', $this->_hoje);
		$sql->bindParam(':ins_hora_cadastro', $this->_agora);
		$sql->bindParam(':ins_ip', $this->_ip);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Cadastra nova inscrição');
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