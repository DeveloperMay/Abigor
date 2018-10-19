<?php
/*
{
	"AUTHOR":"Matheus Maydana",
	"CREATED_DATA": "14/08/2018",
	"MODEL": "Layout",
	"LAST EDIT": "18/08/2018",
	"VERSION":"0.0.2"
}
*/


/**
**
** @see o Layout precisa ser formato .HTML ou confirgurar no arquivo Setting.php 
**
**/

class Model_Layout extends Model_View{

	public function setLayout($st_view){

		try{

			if(file_exists(DIR_CLASS.DIR.SUBDOMINIO.'/Layout/'.$st_view.EXTENSAO_VISAO)){

				$this->st_view = $st_view;
			}

		}catch(PDOException $e){

			/**
			** ERRO, LAYOUT NÃO ENCONTRADO
			**/
			new de('layout não encontrado');
		}
	}

	public function Layout($metas){

		try{

			$layout = LAYOUT;

			/* COLOCAR CACHE NOS ARQUIVOS STATICOS QUANDO NÃO ESTÁ EM PRODUÇÃO */
			$cache = '';
			$random = mt_rand(10000, 99999);

			if(DEV !== true){
				$cache = '?cache='.$random;
			}

			$mustache = array(
				'{{static}}' 		=> URL_STATIC,
				'{{header}}' 		=> $this->_headerHTML($metas),
				'{{cache}}' 		=> $cache,
				'{{lang}}'			=> $this->_url,
				'{{ano}}'			=> date('Y'),
				'{{dominio_site}}'	=> DOMINIO_SITE
			);

			$layout = str_replace(array_keys($mustache), array_values($mustache), file_get_contents(DIR_CLASS.DIR.'Layout/'.$layout.EXTENSAO_VISAO));
			return $layout;

		}catch(PDOException $e){

			new de('nada de layout');
			/**
			** ERRO, ARQUIVO LAYOUT NÃO ENCONTRADO
			**/
		} 
	}

	private function _headerHTML($metas){

		$url = $this->url;
		
		$noscript = '<noscript><meta  http-equiv="refresh"  content="1; URL=/noscript"  /></noscript>';
		if(isset($url[1]) and $url[1] == 'noscript'){

			$noscript = '';
		}

		$meta_title = $metas['title'] ?? 'Abigor';
		$meta_description = $metas['description'] ?? 'Criação de site responsivo, criação de site em Marau-RS, criação de site exclusivo, Webdesign em Marau, Webdesign, desenvolvimento web, site fácil';

		$header = <<<php
<title>{$meta_title}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, height=device-height, user-scalable=yes, initial-scale=1" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="format-detection" content="telephone=no" />
<meta name="description" content="{$meta_description}">
<meta name="robots" content="index, follow" />
{$noscript}
<meta name="msapplication-tap-highlight" content="no"/>
<meta name="apple-mobile-web-app-title" content="Abigor"/>
<meta name="application-name" content="Abigor"/>
<meta name="msapplication-TileImage" content="/img/caveira.png"/>
<meta name="msapplication-TileColor" content="#e8e6e8"/>
<meta name="theme-color" content="#1c5f8e"/>
<meta name="author" content="Bames" />
<link rel="manifest" href="/manifest.json"/>
<link rel="shortcut icon" href="/img/site/caveira.png" type="image/x-icon">
<link rel="icon" href="/img/site/caveira.png" type="image/x-icon">
<script defer src="/js/MS.min.js{{cache}}"></script>
<script defer src="/js/site.min.js{{cache}}"></script>
<link rel="stylesheet" type="text/css" href="/css/basico.min.css{{cache}}">
php;

		return $header;
	}


	protected function _navi(){

		return '';
	}
}