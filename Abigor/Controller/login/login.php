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

		if(isset($_SESSION['login'])){
			header('location: /');
		}
	}

	function index(){

		$this->metas['title'] = 'Abigor - Login';

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
				$nome 	= $this->_util->basico($_POST['nome'] ?? '');
				$senha 	= $this->_util->basico($_POST['senha'] ?? '');

				/* VALIDA OS DADOS */
				$valida = $this->_validacao->_criarLogin(array('nome' => $nome, 'senha' => $senha));

				/* SE FOR VÁLIDO SEGUE ... */
				if($valida === true){

					$login = $this->_consulta->login(array('nome' => $nome, 'senha' => $senha));

					switch ($login){

						case 3:

							/* SENHA ERRADA */
							new de('Senha incorreta');
							break;
						
						case 4:

							/* DADOS INVÁLIDOS */
							new de('Tente novamente mais tarde!');
							break;
						
						default:
							
							/* LOGADO COM SUCESSO */
							header('location: /');
							break;
					}
				}

				new de($valida);
				exit;
			}

			new de('token errado seu pnc!');
			exit;
		}

		new de('informe o token !');
		exit;
	}
}