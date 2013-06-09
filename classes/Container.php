<?php

class Container extends Elemento
{
	public $Etapa;
	public $Secao;
	
	function __construct() {
			
		parent::__construct();
		$this->setTabela("container");
		//$this->pk = "id";
		$fk1['tabela'] = "secao";
        $fk1['campo'] = "idsecao";
        $this->fks[] = $fk1;
		
        $this->Etapa = new Etapa();
        $this->Secao = new Secao();
	}
	
    
	function recuperarPorId($idcontainer)
	{
		
		$container =  parent::recuperarPorId($idcontainer);
		
		if((is_array($container)) and (count($container)>0) )
		{
			$container['secao'] = $this->Secao->recuperarPorId($container['idsecao']);
		}
		return $container;
	}
	/*
   * 
   */
	function recuperarPorSecao($idSecao)
	{
		$containers = $this->consulta("and idsecao =".$idSecao);
		
		$Post = new Post();
		
		foreach ($containers as $container)
		{
            $container['etapas'] = $this->recuperarEtapas($container['id']);
			$container['posts'] =  $Post->recuperarArvorePosts($container['id']);
	        $container['qtdEtapas'] = $this->Etapa->getQtdEtapas($container['id']);
			$colecao[] = $container;
		}
        
		return $colecao;
	}
   

   function recuperarEtapas($idContainer)
   {
      //  $containers = $this->consulta("and idsecao =".$idSecao);
        
    	$etapas = $this->Etapa->recuperarArvoreEtapas($idContainer);

    	return $etapas;
   }
    
    
    function salvar($alias,$idsecao,$idtemplate)
    {
        echo  $sql = "insert into container (alias, idsecao, idtemplate) VALUES ('$alias',$idsecao, $idtemplate)";
        
        $lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

        if($lastId != false)
        {
            return $lastId;
        }
        return false;
    }

}

?>
