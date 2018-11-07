<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "14/08/2018",
	"MODEL": "Grid",
	"LAST EDIT": "14/08/2018",
	"VERSION":"0.0.1"
}
*/
class Model_Grid {

	private $fetch;

	private $controlador;

	private $totalResults;

	function __construct(){

	}


	/* RETORNA O THEAD DO GRID */
	function thead($thead){

		$th = '';
		foreach ($thead as $arr){

			$th .= '<th>'.$arr.'</th>';
		}

		$html = '<thead>'.$th.'<th></th></thead>';

		return $html;
	}

	/* RETORNA O TBODY DO GRID */
	function tbody($fetch, $prefixo, $controlador){

		$td = '';
		foreach ($fetch as $coluna => $arr){

			foreach ($arr as $ar){

				$codigo = $arr[$prefixo.'_codigo'];
				$td .= '<td>'.$ar.'</td>';
			}
		}

		$html = '<tbody>'.$td.$this->compAcao($controlador, $codigo, $codigo).'</tbody>';

		return $html;
	}

	function init($thead, $fetch, $totalResults, $prefixo, $controlador){

		$thead = $this->thead($thead);
		$tbody = $this->tbody($fetch, $prefixo, $controlador);

		$html = <<<html
		<table>
			{$thead}
			{$tbody}
		</table>
html;

		return $html;
	}

	function grid(){

		$html = <<<html

			{$this->_render->renPagination('pessoa', $totalResults)}
			<table>
				<thead>
					<th>Nome</th>
					<th>CPF</th>
					<th>E-mail</th>
					<th>Tipo</th>
					<th>Ensino</th>
					<th></th>
				</thead>
				<tbody>

html;

		foreach ($fetch as $arr){
			$ensino = 'Ensino Médio';
			if(isset($arr['dis_ensino']) and $arr['dis_ensino'] == 2){
				$ensino = 'Ensino Fundamental';
			}
			$tipo = 'Aluno';
			if(isset($arr['pes_tipo']) and $arr['pes_tipo'] == 2){
				$tipo = 'Professor';
			}

			$html .= <<<html
			<tr>
				<td class="text-left">{$arr['pes_nome']}</td>
				<td>{$arr['pes_cpf']}</td>
				<td>{$arr['pes_email']}</td>
				<td>{$tipo}</td>
				<td>{$ensino}</td>
				<td>
					
					{$this->compAcao($this->_controlador, $arr['pes_codigo'], $arr['pes_nome'])}
				</td>
			</tr>
html;
		}

		if(is_array($fetch) and count($fetch) <= 0){

			$html .= '<tr><td colspan="6">Nenhum dado encontrado</td></tr>';
		}


		$html .= <<<html
				</tbody>
			</table>
html;
	}

	function renPagination($controlador, $totalPaginas){

		$back = $this->_page - 1;
		$next = $this->_page + 1;


		if($back <= 0){
			$back = 1;
		}

		if($next >= $totalPaginas){
			$next = $totalPaginas;
		}

		$paginas = '';
		for ($i = 1; $i < $totalPaginas; $i++){
			$ativo = 'style="color: gray"';
			$num = ((int) $i + 1);
			if($this->_page == $num){
				$ativo = 'style="color: red"';
			}

			$paginas .= ' <a href="/'.$controlador.'?p='.$i.'" '.$ativo.'>'.$i.'</a> ';
		}

		$html = <<<html
		<p>
			<a href="/{$controlador}?p={$back}"><<<</a>
			{$paginas}
			<a href="/{$controlador}?p={$next}">>>></a>
		</p>
html;
		return $html;

	}

	function compAcao($controlador, $codigo, $descricao){

		$html = <<<html
		<div class="comp-acao">
			<button>Ações</button>
			<ul>
				<li><button onclick="openURL('/{$controlador}/ver/{$codigo}/{$descricao}');">Editar</button></li>
				<li><button onclick="openURL('/{$controlador}/excluir/{$codigo}');">Excluir</button></li>
			</ul>
		</div>
html;

		return $html;
	}
}