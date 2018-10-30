<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "29/10/2018",
		"MODEL": "Vaga",
		"LAST EDIT": "29/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Bancodados_Vaga {

	function _getVagas(){}

	function _novaVaga($dados){

		$esc_codigo = ESC_CODIGO;
		$log_codigo = LOG_CODIGO;
		$vag_quantidade	= $this->_util->basico($dados['vag_quantidade'] ?? null);
		$dis_codigo 	= $this->_util->basico($dados['dis_codigo'] ?? null);
		$vag_atedia 	= date('dmY', strtotime($this->_util->basico($dados['vag_atedia'] ?? null)));
		$vag_descricao 	= $this->_util->basico($dados['vag_descricao'] ?? null);

		$sql = $this->_conexao->prepare("
			SELECT vag_codigo
			FROM vaga
			WHERE dis_codigo = :dis_codigo AND vag_atedia = :vag_atedia
		");
		$sql->bindParam(':dis_codigo', $dis_codigo);
		$sql->bindParam(':vag_atedia', $vag_atedia);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Select nova Vaga');
		$temp = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = null;

		if(is_array($temp) and isset($temp['vag_codigo']) and !empty($temp['vag_codigo'])){

			/* JÁ EXISTE UMA VAGA COM ESTE vag_codigo E vag_atedia */
			return 3;
		}

		$sql = $this->_conexao->prepare("INSERT INTO vaga (
			vag_quantidade,
			dis_codigo,
			log_codigo,
			vag_atedia,
			vag_descricao,
			vag_dia_cadastro,
			vag_hora_cadastro,
			vag_ip
		) VALUES (
			:vag_quantidade,
			:dis_codigo,
			:log_codigo,
			:vag_atedia,
			:vag_descricao,
			:vag_dia_cadastro,
			:vag_hora_cadastro,
			:vag_ip
		)");
		$sql->bindParam(':vag_quantidade', $vag_quantidade);
		$sql->bindParam(':dis_codigo', $dis_codigo);
		$sql->bindParam(':log_codigo', $log_codigo);
		$sql->bindParam(':vag_atedia', $vag_atedia);
		$sql->bindParam(':vag_descricao', $vag_descricao);
		$sql->bindParam(':vag_dia_cadastro', $this->_hoje);
		$sql->bindParam(':vag_hora_cadastro', $this->_agora);
		$sql->bindParam(':vag_ip', $this->_ip);
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