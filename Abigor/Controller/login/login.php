<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "03/11/2018",
		"CONTROLADOR": "Login",
		"LAST EDIT": "03/11/2018",
		"VERSION":"0.0.2"
	}
*/

require_once 'metodos.php';

class Login extends metodos{

	public $_cor;

	private $_util;

	private $_validacao;

	private $_consulta;

	private $_conexao;

	private $_push = false;

	private $metas = array();

	function __construct(){

		$this->_cor = new Model_GOD;

		$this->_util = new Model_Pluggs_Utilit;

		$this->_validacao = new Model_Pluggs_Validacao;

		$this->_conexao = new Model_Bancodados_Conexao;

		$this->_consulta = new Model_Bancodados_Consultas($this->_conexao);

		if(isset($_POST['push']) and $_POST['push'] == 'push'){
			$this->_push = true;
		}
	}

	function index(){

		if(isset($_SESSION['login'])){
			header('location: /');
		}

		$this->metas['title'] = 'Login - Abigor';

		/* GERA O TOKEN PARA LOGIN */
		$token = $this->_cor->_TokenForm('login');

		$mustache = array(
			'{{token}}' => $token
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout('login', 'login', $this->metas), $mustache);

		}else{

			echo $this->_cor->push('login', 'login', $mustache, $this->metas);
		}
	}

	function entrar(){

		/* VERIFICA SE EXISTE TOKEN */
		if(isset($_POST['token']) and !empty($_POST['token'])){
			
			/* VERIFICA SE O TOKEN É VÁLIDO */
			$token = $this->_cor->_verificaToken('login', $_POST['token']);
	
			/* SE FOR VÁLIDO SEGUE ...*/
			if($token === true){

				/* SETA NOME E SENHA, PASSANDO STRIP_TAGS */
				$cpf 	= $this->_util->basico($_POST['cpf'] ?? '');
				$senha 	= $this->_util->basico($_POST['senha'] ?? '');

				/* VALIDA OS DADOS */
				$valida = $this->_validacao->_criarLogin(array('cpf' => $cpf, 'senha' => $senha));

				/* SE FOR VÁLIDO SEGUE ... */
				if($valida === true){

					$login = $this->_consulta->login(array('cpf' => $cpf, 'senha' => $senha));

					switch ($login){

						case 2:

							/* FALHA QUERY */
							echo json_encode(array('res' => 'no', 'info' => 'Ops, tente novamente mais tarde!'));
							break;

						case 3:

							/* SENHA ERRADA */
							echo json_encode(array('res' => 'no', 'info' => 'Senha incorreta'));
							break;
							exit;
						
						case 4:

							/* DADOS INVÁLIDOS */
							echo json_encode(array('res' => 'no', 'info' => 'Tente novamente mais tarde!'));
							break;
						
						default:
							
							/* LOGADO COM SUCESSO */
							echo json_encode(array('res' => 'ok', 'info' => 'Logando...'));
							break;
					}

				}else{

					/* ERROS VALIDAÇÃO */
					echo json_encode(array('res' => 'no', 'info' => $valida));
					exit;
				}

			}else{

				echo json_encode(array('res' => 'no', 'info' => 'token errado seu pnc!'));
				exit;
			}

		}else{

			echo json_encode(array('res' => 'no', 'info' => 'informe o token !'));
			exit;
		}
	}

	function logout(){

		if(isset($_GET['s']) and is_numeric($_GET['s'])){

			$logout = $this->_consulta->logout($_GET['s']);
			header('location: /login');
		}else{

			header('location: /pagina-nao-encontrada');
		}
	}
}