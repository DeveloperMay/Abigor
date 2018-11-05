<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "14/08/2018",
		"CONTROLADOR": "Index",
		"LAST EDIT": "14/08/2018",
		"VERSION":"0.0.1"
	}
*/
class Pessoa {

	public $_func;

	private $_cor;

	private $_util;

	private $_validacao;

	private $_consulta;

	private $_conexao;

	private $_push = false;

	private $_controlador = 'pessoa';

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

		$this->metas['title'] = 'Pessoas - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];

		$mustache = array(
			'{{controlador}}' => $this->_controlador,
			'{{pessoas}}'	=> $this->_consulta->_getPessoa()
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout($this->_controlador, 'pessoa', $this->metas), $mustache);

		}else{

			echo $this->_cor->push($this->_controlador, 'pessoa', $mustache, $this->metas);
		}
	}

	function cadastrar(){

		$this->metas['title'] = 'Cadastrar Pessoa - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];

		/* QUANDO FOR CADASTRAR ALUNO */
		$visao = 'cadastrar';

		/* GERA O TOKEN PARA LOGIN */
		$token = $this->_cor->_TokenForm('novo');

		$mustache = array(
			'{{token}}' => $token,
			'{{controlador}}' => $this->_controlador
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

				/* SETA NOME E SENHA, PASSANDO STRIP_TAGS */
				$tipo 		= $this->_util->basico($_POST['tipo'] ?? '');
				$nome 		= $this->_util->basico($_POST['nome'] ?? '');
				$cpf 		= $this->_util->basico($_POST['cpf'] ?? '');
				$nascimento = $this->_util->basico($_POST['nascimento'] ?? '');
				$sexo 		= $this->_util->basico($_POST['sexo'] ?? '');
				$email 		= $this->_util->basico($_POST['email'] ?? '');

				/* VALIDA OS DADOS */
				$valida = $this->_validacao->novaPessoa(array('nome' => $nome, 'email' => $email));

				/* SE FOR VÁLIDO SEGUE ... */
				if($valida === true){

					$cadastra = $this->_consulta->_novaPessoa(array(
						'pes_tipo' 			=> $tipo,
						'pes_nome' 			=> $nome,
						'pes_cpf' 			=> $cpf,
						'pes_sexo' 			=> $sexo,
						'pes_nascimento' 	=> $nascimento,
						'pes_email' 		=> $email
					));

					switch ($cadastra){

						case 1:

							/* FALHA AO CADASTRAR */
							new de('Ops, tente novamente mais tarde!');
							break;

						case 3:

							/* CADASTRO JÁ EXISTENTE */
							new de('Já existe um cadastro com este Nome ou CPF');
							break;
						
						default:
							
							/* CADASTRADO COM SUCESSO */
							new de('Pessoa cadastrada com sucesso!');
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