<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "29/10/2018",
		"CONTROLADOR": "Inscrição",
		"LAST EDIT": "29/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Inscricao {

	public $_func;

	private $_cor;

	private $_util;

	private $_validacao;

	private $_consulta;

	private $_conexao;

	private $_push = false;

	private $_controlador = 'inscricao';

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

		$this->metas['title'] = 'Inscrição - Abigor';

		$mustache = array(
			'{{inscricao}}' => 'Maria <br />José',
			'{{controlador}}' => $this->_controlador
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout($this->_controlador, 'inscricao', $this->metas), $mustache);

		}else{

			echo $this->_cor->push($this->_controlador, 'inscricao', $mustache, $this->metas);
		}
	}

	function cadastrar(){

		$this->metas['title'] = 'Cadastrar disciplina - Abigor';

		/* QUANDO FOR CADASTRAR ALUNO */
		$visao = 'cadastrar';

		/* GERA O TOKEN PARA LOGIN */
		$token = $this->_cor->_TokenForm('novo');

		$mustache = array(
			'{{token}}' => $token,
			'{{controlador}}' => $this->_controlador,
			'{{disciplinas}}'	=> $this->_consulta->_getDisciplinas(),
			'{{pessoas}}'	=> $this->_consulta->_getPessoa(2),
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
				$pes_codigo 		= $this->_util->basico($_POST['pessoa'] ?? '');
				$dis_codigo 		= $this->_util->basico($_POST['disciplina'] ?? '');
				$ins_data_marcado 	= $this->_util->basico($_POST['data'] ?? '');
				$ins_hora_marcado 	= $this->_util->basico($_POST['hora'] ?? '');

				/* VALIDA OS DADOS */
				$valida = $this->_validacao->novaInscricao(array(
					'pes_codigo' => $pes_codigo,
					'dis_codigo' => $dis_codigo,
					'ins_data_marcado' => $ins_data_marcado,
					'ins_hora_marcado' => $ins_hora_marcado
				));

				/* SE FOR VÁLIDO SEGUE ... */
				if($valida === true){

					$cadastra = $this->_consulta->_novaInscricao(array(
						'pes_codigo' => $pes_codigo,
						'dis_codigo' => $dis_codigo,
						'ins_data_marcado' => $ins_data_marcado,
						'ins_hora_marcado' => $ins_hora_marcado
					));

					switch ($cadastra){

						case 1:

							/* FALHA AO CADASTRAR */
							new de('Ops, tente novamente mais tarde!');
							break;

						case 3:

							/* CADASTRO JÁ EXISTENTE */
							new de('Já existe uma inscrição nesta disciplina para este aluno');
							break;
						
						default:
							
							/* CADASTRADO COM SUCESSO */
							new de('Inscrição cadastrada com sucesso!');
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