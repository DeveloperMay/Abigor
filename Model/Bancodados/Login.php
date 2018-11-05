<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "25/10/2018",
		"CONTROLADOR": "Login",
		"LAST EDIT": "03/11/2018",
		"VERSION":"0.0.2"
	}
*/
class Model_Bancodados_Login extends Model_Bancodados_Pessoa {

	function login($dados){

		if(is_array($dados) and !empty($dados) and count($dados) > 0){

			$log_cpf = $dados['cpf'];
			$senha 	= $dados['senha'];
			//$senha = $this->HASH($dados['senha']);

			$this->_PDO->beginTransaction();

			try {

				$sql = $this->_PDO->prepare('
					SELECT 
						log_codigo
					FROM login
					WHERE log_cpf = :log_cpf AND log_senha = :senha');
				$sql->bindParam(':log_cpf', $log_cpf);
				$sql->bindParam(':senha', $senha);
				$sql->execute();
				$fetch = $sql->fetch(PDO::FETCH_ASSOC);
				$sql = null;


				/* SUCESSO NA QUERY */
				if(is_array($fetch) and isset($fetch['log_codigo'])){

					/* DEFINE QUEM ESTÁ LOGADO */
					$this->_timesnow($fetch['log_codigo'], 1);
					/* LOGADO COM SUCESSO */
					return 1;
				}


				$this->_PDO->commit();
				/* SENHA ERRADA */
				sleep(2);
				return 3;

			}catch (Exception $e){
				
				$this->_PDO->rollBack();
				new Model_Debugger($e, __METHOD__);

				/* FALHA */
				return 2;
			}
		}

		/* VOCÊ ESTÁ NO LUGAR ERRADO*/
		sleep(3);
		return 4;
	}

	function logout($log_codigo){

		$return = 1;
		if(!empty($log_codigo) and is_numeric($log_codigo)){
			
			$this->_timesnow($log_codigo);
			unset($_SESSION['login']);
			$return = 2;
		}

		return $return;
	}

	function _timesnow($log_codigo, $login = null){

		/**
		** @param (INT)
		** @param (boolean)
		** @see ESTA FUNÇÃO ATUALIZA OS DADOS NO BANCO, DATA, HORA E IP (last login)
		** @see SE $login vier !== null, usuario está logando
		**/

		$log_codigo = $this->_util->basico($log_codigo);

		/* USUARIO SAINDO (LOGOUT) - MUDA STATUS */
		$log_status = 2;
		if($login !== null){

			/* USUARIO LOGANDO (LOGIN) - MUDA STATUS */
			$log_status = 1;
		}

		$sql = $this->_PDO->prepare('
			UPDATE login SET 
				log_status = :log_status, 
				log_hora = :log_hora, 
				log_dia = :log_dia, 
				log_ip	= :log_ip 
			WHERE log_codigo = :log_codigo
		');
		$sql->bindParam(':log_status', $log_status, PDO::PARAM_INT);
		$sql->bindParam(':log_hora', $this->_agora, PDO::PARAM_STR);
		$sql->bindParam(':log_dia', $this->_hoje, PDO::PARAM_STR);
		$sql->bindParam(':log_ip', $this->_ip, PDO::PARAM_STR);
		$sql->bindParam(':log_codigo', $log_codigo, PDO::PARAM_INT);
		$sql->execute();
		$sql = null;

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){

			$informacoesLogin[$log_codigo]['log_codigo'] 	= $this->getInfoCliente('log_codigo', $log_codigo);
			$informacoesLogin[$log_codigo]['log_nome'] 		= $this->getInfoCliente('log_nome', $log_codigo);

			$_SESSION['login'] = $informacoesLogin;
		}
	}
	
	function getInfoCliente($infoCliente, $log_codigo){

		$sql = 'SELECT {{coluna}} FROM login WHERE log_codigo = :log_codigo';
		$sql = str_replace('{{coluna}}', $infoCliente, $sql);
		$sql = $this->_PDO->prepare($sql);
		$sql->bindParam(':log_codigo', $log_codigo);
		$sql->execute();
		$fetch = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = null;

		return $fetch[$infoCliente];
	}

}