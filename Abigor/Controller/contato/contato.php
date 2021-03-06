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
class Contato {

	public $_func;

	private $_cor;

	private $_push = false;

	private $metas = array();

	function __construct(){

		$this->_func = new Model_Functions_Functions;

		$this->_cor = new Model_GOD;

		if(isset($_POST['push']) and $_POST['push'] == 'push'){
			$this->_push = true;
		}
	}

	function index(){

		$mustache = array();

		$this->metas['title'] = 'Contato - '.$_SESSION['login'][LOG_CODIGO]['log_nome'];

		if($this->_push === false){

			echo $this->_cor->_visao($this->_cor->_layout('contato', 'contato', $this->metas), $mustache);

		}else{

			echo $this->_cor->push('contato', 'contato', $mustache, $this->metas);
		}
	}
}