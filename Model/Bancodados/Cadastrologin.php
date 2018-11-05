<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "04/11/2018",
		"MODEL": "Cadastro Login",
		"LAST EDIT": "04/11/2018",
		"VERSION":"0.0.1"
	}
*/
class Model_Bancodados_Cadastrologin {

	function _getLogins(){

		$esc_codigo = ESC_CODIGO;

		$this->_PDO->beginTransaction();

		$html = '';

		try {

			$sql = $this->_PDO->prepare("
				SELECT 
					log_codigo,
					log_cpf,
					log_nome,
					log_status,
					log_group
				FROM login
				WHERE esc_codigo = :esc_codigo
			");
			$sql->bindParam(':esc_codigo', $esc_codigo);
			$sql->execute();
			$fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
			$sql = null;

			if(is_array($fetch) and count($fetch) > 0){
				/**	
				*	6 DEUS
				* @see 5 Administrador / Diretor
				* @see 4 Professor
				*
				**/
				foreach ($fetch as $arr){
					
					$group = 'Deus';
					if(isset($arr['log_group']) and $arr['log_group'] == 5){
						$group = 'Administrador / Diretor';
					}
					if(isset($arr['log_group']) and $arr['log_group'] == 4){
						$group = 'Professor';
					}

					$html .= <<<html

						<p>{$arr['log_nome']} - {$group}</p>
html;
				}
			}
		
			return $html;

			$this->_PDO->commit();

		}catch (Exception $e){

			$this->_PDO->rollBack();
			new Model_Debugger($e, __METHOD__);
			
			return '';
		}/* finally {

			return $html;
		}*/
	}
}