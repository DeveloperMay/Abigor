<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "14/08/2018",
		"CONTROLADOR": "Index",
		"LAST EDIT": "18/08/2018",
		"VERSION":"0.0.2"
	}
*/
class Index {

	private $_cor;

	private $_consulta;

	private $_conexao;

	private $_push = false;

	private $_url;

	private $_lang;

	private $metas = array();

	function __construct(){

		$this->_cor = new Model_GOD;

		$this->_conexao = new Model_Bancodados_Conexao;

		$this->_consulta = new Model_Bancodados_Consultas($this->_conexao);

		if(isset($_POST['push']) and $_POST['push'] == 'push'){
			$this->_push = true;
		}

		$this->_url = $this->_cor->getUrl();

		$this->_lang = $this->_cor->getLang();
	}

	function index(){

		$mustache = array();
		$this->metas['title'] = 'Abigor - Início';

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout('index', 'index', $this->metas), $mustache);

		}else{

			echo $this->_cor->push('index', 'index', $mustache, $this->metas);
		}
	}
}