<?php
include_once 'Elemento.php';

class Upi extends Elemento
{
	function __construct() {
		parent::__construct();
		$this->setTabela("upi");

		$fk1['tabela'] = "usuario";
		$fk1['campo'] = "idusuario";
		$this->fks[] = $fk1;
	}
	/*
	 * Cadastra nova upi, ou seja NAO registra o campo idupi (upi pai)
	 */
	function salvar($idusuario,$texto){
			
		echo $sql = "insert into upi (id,idusuario,texto,data)
                values (null, $idusuario,'$texto',now())";

		$lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

		if($lastId != false)
		{
			return $lastId;
		}
		return false;
	}

	/*
	 * Cadastra nova versao de upi, ou seja registra o campo idupi (upi pai)
	 */
	function salvarVersao($idusuario,$texto,$idupi =0){

		echo $sql = "insert into upi (id,idusuario,texto,data,idupi)
                values (null, $idusuario,'$texto',now(),$idupi)";

		$lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

		if($lastId != false)
		{
			return $lastId;
		}
		return false;
	}



	function recuperarPorUsuario($idusuario)
	{
		//$this->sort = "data";
		//$this->debug = true;
		$upis = $this->consulta(" and idusuario =".$idusuario,"data");
			
		if((is_array($upis)) and (count($upis)>0) )
		{
			foreach ($upis as $upi)
			{
				//$upi = $this->recuperarPorId($post['idupi']);
				// $post['upi'] = $upi;
				// $colecao[] = $post;
			} 
		}
		return $upis;
	}

	function recuperarArvoreUpi($idupi)
	{
		//upi raiz (pai) 
		
		$upi = $this->recuperarPorId($idupi);
        // retorna upi filha(s) : que possui pai upi anterior(raiz)
        // returnar >= 1
        //$this->debug = true;
		$upi_filhas = $this->consulta(" and idupi =".$upi['id']);
		
		if((is_array($upi_filhas)) and (count($upi_filhas)>0) )
		{
			foreach ($upi_filhas as $upi_filha)
			{
				//$upi_pai = $this->recuperarPorId($upi['idupi']);
				$upi['upi'][] = $this->recuperarArvoreUpi($upi_filha['id']);
				//$upis['upi'] = $upi_pai;
				//$colecao[] = $post;
			}
		}
		return $upi;

	}
	
	function recuperarRaizUpi($idupi){
		
		for($x=0;$idupi!=0;$x++)
		{
			$upi = $this->recuperarPorId($idupi);
			$idupi = $upi['idupi'];
		}
		
		return $upi['id']; 
		
		
	}


}

?>
