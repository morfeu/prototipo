<?php

class Etapa extends Elemento
{
	public $Post;
	public $Perfil;
	public $Contrato;
	public $qtdSubEtapa;
	
	function __construct() {

		parent::__construct();
		$this->setTabela("etapa");
		$this->Post = new Post();
		$this->Perfil = new Perfil();
		$this->Contrato= new Contrato();
	}

	function recuperarPorContainer($idContainer)
	{
		//return $this->consulta("and idcontainer =".$idContainer);
		$container = $this->consulta("and idcontainer =".$idContainer);
	}

	// antigo , verificar se ainda utiliza esse metodo
	function recuperarArvoreEtapa($idContainer,$idetapa=null)
	{
		if(is_null($idetapa)){ $id = 0; }
        $poste = $this->consulta("and idetapa = $idetapa and idcontainer =".$idContainer); 
        
		for($cont =0; $poste != false ;$cont++) 
		{
			$idetapa = $poste[0]['id'];
			$post_raiz['post'] = $poste;
			$poste = $this->consulta("and idetapa = $idetapa and idcontainer =".$idContainer); 
			
		}
		return $post_raiz;
	}
	
	function recuperarArvoreEtapas($idContainer,$idetapa=null)
    {
        if(is_null($idetapa)){ $idetapa = 0; }
       
      //  $this->debug = true;
        $etapas = $this->consulta("and idetapa = $idetapa and idcontainer =".$idContainer);
        
        if($etapas != false)
        {
        	$cont =0;
        	
        	foreach ($etapas as $etapa)
            {
            	$idetapa = $etapa['id'];
            	$etapas[$cont]['contrato'] = $this->Contrato->recuperarPerfilPorEtapa($idetapa);
            	$etapas[$cont]['etapa'] = $this->recuperarArvoreEtapas($idContainer,$idetapa);
                $cont++;
            }
        }
        else {

        	 return null;
        }
        return $etapas;
    }

    //recupera a quantidfade de etapas a partir do container (id)
    // se repassar o parametro da etapa (id) , o resultyado será a quantidade de subetapas iniciais para uma determinada etapa 
    function getQtdEtapas($idcontainer,$idetapa = null )
    {
        if((is_null($idetapa) or ($idetapa ==0)) ){ $idetapa = "idetapa" ; }

    	$result = $this->consulta("and idetapa = $idetapa and idcontainer =".$idcontainer);
    	
    	return count($result);

    }
    
    function salvar($alias,$rotulo,$max,$min,$idetapa,$idcontainer)
    {
       echo $sql = "insert into etapa (alias,rotulo,max,min,idetapa,idcontainer) VALUES ('$alias','$rotulo',$max,$min,$idetapa, $idcontainer)";

        $lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

        if($lastId != false)
        {
            return $lastId;
        }
        return false;
    }
    
    
    
}




?>
