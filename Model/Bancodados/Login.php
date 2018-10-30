<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "25/10/2018",
		"CONTROLADOR": "Login",
		"LAST EDIT": "25/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Bancodados_Login extends Model_Bancodados_Pessoa {

	function login($dados){

		if(is_array($dados) and !empty($dados) and count($dados) > 0){

			$nome = $dados['nome'];
			$senha = $dados['senha'];
			//$senha = $this->HASH($dados['senha']);

			$sql = $this->_conexao->prepare('SELECT log_codigo FROM login WHERE log_nome = :nome AND log_senha = :senha');
			$sql->bindParam(':nome', $nome);
			$sql->bindParam(':senha', $senha);
			$sql->execute();
			new Model_Debugger($sql, __METHOD__, 'Checa se existe esse usuário para fazer login');
			$fetch = $sql->fetch(PDO::FETCH_ASSOC);
			$sql = null;

			if($fetch){

				$this->_timesnow($fetch['log_codigo'], 1);
				/* LOGADO COM SUCESSO */
				return 1;

			}else{

				/* SENHA ERRADA */
				sleep(2);
				return 3;
			}
		}else{

			/* VOCÊ ESTÁ NO LUGAR ERRADO*/
			sleep(3);
			return 4;
		}
	}

	function logout($id_conta){

		$return = 1;
		if(!empty($id_conta) and is_numeric($id_conta)){
			
			$this->_timesnow($id_conta);
			unset($_SESSION[CLIENTE]);
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

		$sql = $this->_conexao->prepare('
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
		new Model_Debugger($sql, __METHOD__, 'Atualiza IP, Hora, Data, Status');
		$sql = null;

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){

			$informacoesLogin[$log_codigo]['log_codigo'] 	= $this->getInfoCliente('log_codigo', $log_codigo);

			$_SESSION['login'] = $informacoesLogin;
		}
	}
	
	function getInfoCliente($infoCliente, $log_codigo){

		$sql = 'SELECT {{coluna}} FROM login WHERE log_codigo = :log_codigo';
		$sql = str_replace('{{coluna}}', $infoCliente, $sql);
		$sql = $this->_conexao->prepare($sql);
		$sql->bindParam(':log_codigo', $log_codigo);
		$sql->execute();
		new Model_Debugger($sql, __METHOD__, 'Busca dado em coluna específica, no caso '.$infoCliente);
		$fetch = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = null;

		return $fetch[$infoCliente];
	}

}