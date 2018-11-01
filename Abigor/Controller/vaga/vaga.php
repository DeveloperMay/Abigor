<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "29/10/2018",
		"CONTROLADOR": "Vagas",
		"LAST EDIT": "31/10/2018",
		"VERSION":"0.0.2"
	}
*/
class Vaga {

	public $_func;

	private $_cor;

	private $_util;

	private $_validacao;

	private $_consulta;

	private $_conexao;

	private $_push = false;

	private $_controlador = 'vaga';

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

		$this->metas['title'] = 'Vagas - Abigor';

		$mustache = array(
			'{{vaga}}' => $this->_consulta->_getVagas(),
			'{{controlador}}' => $this->_controlador
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout($this->_controlador, 'vaga', $this->metas), $mustache);

		}else{

			echo $this->_cor->push($this->_controlador, 'vaga', $mustache, $this->metas);
		}
	}

	function cadastrar(){

		$this->metas['title'] = 'Cadastrar vaga - Abigor';

		/* QUANDO FOR CADASTRAR ALUNO */
		$visao = 'cadastrar';

		/* GERA O TOKEN PARA LOGIN */
		$token = $this->_cor->_TokenForm('novo');

		$mustache = array(
			'{{token}}' => $token,
			'{{controlador}}' => $this->_controlador,
			'{{vagas}}'	=> $this->_consulta->_getDisciplinasVagas(),
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
				$vag_quantidade 		= $this->_util->basico($_POST['vagas'] ?? '');
				$dis_codigo 			= $this->_util->basico($_POST['disciplina'] ?? '');
				$vag_atedia 			= date('dmY', strtotime($this->_util->basico($_POST['atedia'] ?? '')));
				$vag_descricao 			= $this->_util->basico($_POST['descricao'] ?? '');

				/* VALIDA OS DADOS */
				$valida = $this->_validacao->novaVaga(array(
					'vag_quantidade' => $vag_quantidade,
					'dis_codigo' => $dis_codigo,
					'vag_atedia' => $vag_atedia,
					'vag_descricao' => $vag_descricao
				));

				/* SE FOR VÁLIDO SEGUE ... */
				if($valida === true){

					$cadastra = $this->_consulta->_novaVaga(array(
						'vag_quantidade' => $vag_quantidade,
						'dis_codigo' => $dis_codigo,
						'vag_atedia' => $vag_atedia,
						'vag_descricao' => $vag_descricao
					));

					switch ($cadastra){

						case 1:

							/* FALHA AO CADASTRAR */
							new de('Ops, tente novamente mais tarde!');
							break;

						case 3:

							/* CADASTRO JÁ EXISTENTE */
							new de('Já existe uma VAGA neste dia para esta disciplina');
							break;
						
						default:
							
							/* CADASTRADO COM SUCESSO */
							new de('Vaga cadastrada com sucesso!');
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