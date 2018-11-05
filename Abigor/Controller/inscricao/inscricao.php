<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "29/10/2018",
		"CONTROLADOR": "Inscrição",
		"LAST EDIT": "31/10/2018",
		"VERSION":"0.0.2"
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

		$this->metas['title'] = 'Inscrições - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];

		$mustache = array(
			'{{inscricao}}' => $this->_consulta->_getInscricaoes(),
			'{{controlador}}' => $this->_controlador
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout($this->_controlador, 'inscricao', $this->metas), $mustache);

		}else{

			echo $this->_cor->push($this->_controlador, 'inscricao', $mustache, $this->metas);
		}
	}

	/* QUANDO FOR VISUALIZAR INSCRIÇÃO */
	function ver(){

		/* CASO EXISTA O CODE */
		$title = 'Inscrição não encontrada - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];
		$html = 'Inscrição não encontrada.';
		if(isset($this->_url[3]) and is_numeric($this->_url[3])){

			$inscrito = $this->_consulta->_getInscricao($this->_url[3]);

			$title = $inscrito['title'];
			$html = $inscrito['html'];

			if(isset($inscrito['title']) and empty($inscrito['title'])){
				$title = 'Inscrição não encontrada - Abigor';
				$html = 'Inscrição não encontrada.';
			}

			$this->metas['title'] = $title.' - Abigor';

		}

		/* QUANDO FOR VISUALIZAR INSCRIÇÃO */
		$visao = 'ver';

		$mustache = array(
			'{{inscrito}}' => $html
		);

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout($this->_controlador, $visao, $this->metas), $mustache);

		}else{

			echo $this->_cor->push($this->_controlador, $visao, $mustache, $this->metas);
		}
	}

	function cadastrar(){

		$this->metas['title'] = 'Cadastrar disciplina - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];

		/* QUANDO FOR CADASTRAR INSCRIÇÃO */
		$visao = 'cadastrar';

		/* GERA O TOKEN PARA LOGIN */
		$token = $this->_cor->_TokenForm('novo');

		$mustache = array(
			'{{token}}' 		=> $token,
			'{{controlador}}' 	=> $this->_controlador,
			'{{disciplinas}}'	=> $this->_consulta->_getDisciplinasInscricao(),
			'{{pessoas}}'		=> $this->_consulta->_getPessoa(1),
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
				$vag_codigo 		= $this->_util->basico($_POST['vaga'] ?? '');
				$ins_data_marcado 	= date('dmY', strtotime($this->_util->basico($_POST['data'] ?? '')));
				$ins_hora_marcado 	= date('hi', strtotime($this->_util->basico($_POST['hora'] ?? '')));

				/* VALIDA OS DADOS */
				$valida = $this->_validacao->novaInscricao(array(
					'pes_codigo' => $pes_codigo,
					'vag_codigo' => $vag_codigo,
					'ins_data_marcado' => $ins_data_marcado,
					'ins_hora_marcado' => $ins_hora_marcado
				));

				/* SE FOR VÁLIDO SEGUE ... */
				if($valida === true){

					$cadastra = $this->_consulta->_novaInscricao(array(
						'pes_codigo' => $pes_codigo,
						'vag_codigo' => $vag_codigo,
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
							new de('Este aluno já está inscrito nesta disciplina');
							break;

						case 4:

							/* VAGA NÃO EXISTE OU INSCRIÇÕES ENCERRADAS */
							new de('Está vaga não existe ou as inscrições já estão incerradas!');
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