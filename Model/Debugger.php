<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "25/10/2018",
		"CONTROLADOR": "Debugger",
		"LAST EDIT": "25/10/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Debugger {

	function __construct($execute, $method, $info = ''){


		/* CLASSE DE DEBUGGER, FAZER ALGO COM ISSO! É SÓ ALTERAR AQUI, MUDA EM TUDO!*/
		if(isset($execute->errorInfo()[0]) and $execute->errorInfo()[0] !== '00000'){

			new de(
				array(
					'escola' => CLIENTE,
					'Info' => $info,
					'Uri' => $_SERVER['REQUEST_URI'],
					'Url' => $_SERVER['HTTP_REFERER'],
					'Method' => $method,
					'Code' =>  $execute->errorInfo()[1],
					'Erro' => $execute->errorInfo()[2],
					'Query' => PHP_EOL.$execute->queryString
				)
			);
		}
	}
}