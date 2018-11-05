<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "14/08/2018",
		"CONTROLADOR": "Erro 404",
		"LAST EDIT": "04/11/2018",
		"VERSION":"0.0.2"
	}
*/
class Erro404 {

	public $_cor;

	private $_push = false;

	private $metas = array();

	function __construct(){

		$this->_cor = new Model_GOD;

		if(isset($_POST['push']) and $_POST['push'] == 'push'){
			$this->_push = true;
		}
	}

	function index(){

		$mustache = array();

		$this->metas['title'] = 'Página não encontrada - Abigor';

		if($this->_push === false){

			header("HTTP/1.0 404 Not Found");
			echo $this->_cor->_visao($this->_cor->_layout('erro404', 'erro404', $this->metas), $mustache);

		}else{

			echo $this->_cor->push('erro404', 'erro404', $mustache, $this->metas);
		}
	}
}