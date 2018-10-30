<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "25/10/2018",
		"CONTROLADOR": "Pessoa",
		"LAST EDIT": "25/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Bancodados_Pessoa extends Model_Bancodados_Disciplina {

	function _getPessoa($pes_tipo = false){

		$tipo = '';
		if($pes_tipo !== false){
			$tipo = 'AND pes_tipo  = :pes_tipo';
		}

		$esc_codigo = ESC_CODIGO;

		$sql = $this->_conexao->prepare("
			SELECT 
				*
			FROM cad_pessoa
			WHERE esc_codigo = :esc_codigo $tipo
			ORDER BY pes_nome ASC
		");
		$sql->bindParam(':esc_codigo', $esc_codigo);
		if($pes_tipo !== false){
			$sql->bindParam(':pes_tipo', $pes_tipo);
		}
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Select get Todas pessoas');
		$fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql = null;

		$html = '';

		foreach($fetch as $arr){

			$ensino = 'Ensino Médio';
			if(isset($arr['pes_ensino']) and $arr['pes_ensino'] == 2){
				$ensino = 'Ensino Fundamental';
			}

			$html .= <<<php
		<option value="{$arr['pes_codigo']}">{$arr['pes_nome']} - {$ensino}</option>
php;
		}

		return $html;
	}

	function _novaPessoa($dados){

		$esc_codigo 	= ESC_CODIGO;
		$pes_tipo		= $this->_util->basico($dados['pes_tipo'] ?? null);
		$pes_nome 		= $this->_util->basico($dados['pes_nome'] ?? null);
		$pes_cpf 		= $this->_util->basico($dados['pes_cpf'] ?? null);
		$pes_sexo 		= $this->_util->basico($dados['pes_sexo'] ?? 0);
		$pes_nascimento	= $this->_util->basico($dados['pes_nascimento'] ?? 0);
		$pes_email		= $this->_util->basico($dados['pes_email'] ?? 0);
		$est_codigo		= $this->_util->basico($dados['est_codigo'] ?? null);
		$cid_codigo		= $this->_util->basico($dados['cid_codigo'] ?? null);



		$sql = $this->_conexao->prepare("
			SELECT pes_nome
			FROM cad_pessoa
			WHERE pes_nome = :pes_nome OR pes_cpf = :pes_cpf
		");
		$sql->bindParam(':pes_nome', $pes_nome);
		$sql->bindParam(':pes_cpf', $pes_cpf);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Select nova pessoa');
		$temp = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = null;

		if(is_array($temp) and isset($temp['pes_nome']) and !empty($temp['pes_nome'])){

			/* JÁ EXISTE UM CADASTROM COM ESTE NOME OU CPF*/
			return 3;
		}

		$sql = $this->_conexao->prepare("INSERT INTO cad_pessoa (
			esc_codigo,
			pes_tipo,
			pes_nome,
			pes_sexo,
			pes_nascimento,
			pes_cpf,
			pes_email,
			est_codigo,
			cid_codigo
		) VALUES (
			:esc_codigo,
			:pes_tipo,
			:pes_nome,
			:pes_sexo,
			:pes_nascimento,
			:pes_cpf,
			:pes_email,
			:est_codigo,
			:cid_codigo
		)");
		$sql->bindParam(':esc_codigo', $esc_codigo);
		$sql->bindParam(':pes_tipo', $pes_tipo);
		$sql->bindParam(':pes_nome', $pes_nome);
		$sql->bindParam(':pes_sexo', $pes_sexo);
		$sql->bindParam(':pes_nascimento', $pes_nascimento);
		$sql->bindParam(':pes_cpf', $pes_cpf);
		$sql->bindParam(':pes_email', $pes_email);
		$sql->bindParam(':est_codigo', $est_codigo);
		$sql->bindParam(':cid_codigo', $cid_codigo);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Cadastra nova pessoa');
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
