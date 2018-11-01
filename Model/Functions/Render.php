<?php
/*
	"AUTHOR":"Matheus Maydana",
	"CREATED_DATA": "09/04/2018",
	"MODEL": "Render HTML",
	"LAST EDIT": "31/10/2018",
	"VERSION":"0.0.9"
*/

class Model_Functions_Render{

	public $_util;

	public $_url;

	function __construct(){

		$this->_util = new Model_Pluggs_Utilit;

		$this->_url = new Model_Pluggs_Url;
	}

	function renPagination($controlador, $totalPaginas){

		$page = $_GET['page'] ?? 0;
		$back = $page - 1;
		$next = $page + 1;


		if($back <= 0){
			$back = 1;
		}
		if($next >= $totalPaginas){
			$next = $totalPaginas;
		}

		$paginas = '';
		for ($i = 1; $i < $totalPaginas; $i++){


			$paginas .= ' <a href="/'.$controlador.'?page='.$i.'">'.$i.'</a> ';
		}

		$html = <<<html
		<p>
			<a href="/{$controlador}?page={$back}"><<<</a>
			{$paginas}
			<a href="/{$controlador}?page={$next}">>>></a>
		</p>
html;
		return $html;

	}

	function compAcao($controlador, $codigo, $descricao){

		$html = <<<html
		<div class="comp-acao">
			<button>Ações</button>
			<ul>
				<li><button onclick="openURL('/{$controlador}/ver/{$codigo}/{$this->_url->trataURL($descricao)}');">Editar</button></li>
				<li><button onclick="openURL('/{$controlador}/excluir/{$codigo}');">Excluir</button></li>
			</ul>
		</div>
html;

		return $html;
	}
}