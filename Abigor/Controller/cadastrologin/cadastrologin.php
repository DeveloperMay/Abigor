<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "04/11/2018",
		"CONTROLADOR": "Cadastro Login",
		"LAST EDIT": "04/11/2018",
		"VERSION":"0.0.1"
	}
*/
class Cadastrologin {

	public $_func;

	private $_cor;

	private $_util;

	private $_validacao;

	private $_consulta;

	private $_conexao;

	private $_push = false;

	private $_controlador = 'cadastrologin';

	private $metas = array();

	private $_url;

	function __construct(){

		$this->_func = new Model_Functions_Functions;

		$this->_cor = new Model_GOD;

		$this->_util = new Model_Pluggs_Utilit;

		$this->_validacao = new Model_Pluggs_Validacao;

		$this->_conexao = new Model_Bancodados_Conexao;

		$this->_consulta = new Model_Bancodados_Consultas($this->_conexao);

		$this->_url = $this->_cor->getUrl();

		if(isset($_POST['push']) and $_POST['push'] == 'push'){
			$this->_push = true;
		}
	}

	function index(){

		$this->metas['title'] = 'Cadastro Login - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];

		$mustache = array(
			'{{controlador}}' => $this->_controlador,
			'{{logins}}'	=> $this->_consulta->_getLogins()
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout($this->_controlador, 'cadastrologin', $this->metas), $mustache);

		}else{

			echo $this->_cor->push($this->_controlador, 'cadastrologin', $mustache, $this->metas);
		}
	}

	function cadastrar(){

		$this->metas['title'] = 'Cadastrar login - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];

		/* QUANDO FOR CADASTRAR INSCRIÇÃO */
		$visao = 'cadastrar';

		/* GERA O TOKEN PARA LOGIN */
		$token = $this->_cor->_TokenForm('novo');

		$mustache = array(
			'{{token}}' 		=> $token,
			'{{controlador}}' 	=> $this->_controlador
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout($this->_controlador, $visao, $this->metas), $mustache);

		}else{

			echo $this->_cor->push($this->_controlador, $visao, $mustache, $this->metas);
		}
	}

	function novo(){

		/* VERIFICA SE EXISTE TOKEN */
		if(isset($_POST['token']) and !empty($_POST['token'])){
			
			/* VERIFICA SE O TOKEN É VÁLIDO */
			$token = $this->_cor->_verificaToken('novo', $_POST['token']);
	
			/* SE FOR VÁLIDO SEGUE ...*/
			if($token === true){

				/* SETA VARIAVEIS, PASSANDO STRIP_TAGS */
				$log_nome 		= $this->_util->basico($_POST['nome'] ?? '');
				$log_group 		= $this->_util->basico($_POST['group'] ?? '');
				$log_cpf 		= $this->_util->basico($_POST['cpf'] ?? '');
				$log_senha 		= $this->_util->basico($_POST['senha'] ?? '');

				/* VALIDA OS DADOS */
				$valida = $this->_validacao->novoCadastrologin(array(
					'log_nome' => $log_nome, 
					'log_group' => $log_group, 
					'log_cpf' => $log_cpf, 
					'log_senha' => $log_senha
				));

				/* SE FOR VÁLIDO SEGUE ... */
				if($valida === true){

					$cadastra = $this->_consulta->novoCadastrologin(array(
						'log_nome' => $log_nome, 
						'log_group' => $log_group, 
						'log_cpf' => $log_cpf, 
						'log_senha' => $log_senha
					));

					switch ($cadastra){

						case 1:

							/* FALHA AO CADASTRAR */
							echo json_encode(array('res' => 'no', 'info' => 'Ops, tente novamente mais tarde!'));
							break;

						case 3:

							/* CADASTRO JÁ EXISTENTE */
							echo json_encode(array('res' => 'no', 'info' => 'Já existe um login CPF'));
							break;
						
						default:

							/* CADASTRADO COM SUCESSO */
							echo json_encode(array('res' => 'ok', 'info' => 'Login cadastrado com sucesso!'));
							break;
					}
				}else{

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
}