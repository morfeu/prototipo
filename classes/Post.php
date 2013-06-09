<?php

class Post extends Elemento
{
	public $Upi;
	public $Container;
	public $Etapa;

	function __construct() {
		parent::__construct();
		$this->setTabela("post");
		
		$fk1['tabela'] = "upi";
        $fk1['campo'] = "idupi";
        $this->fks[] = $fk1;
        $fk2['tabela'] = "container";
        $fk2['campo'] = "idcontainer";
        $this->fks[] = $fk2;        

        
		$this->Upi = new Upi();
	}

	function recuperarPorEtapa($idEtapa)
	{
		$posts = $this->consulta("and idetapa =".$idEtapa);
		if((is_array($posts)) and (count($posts)>0) )
		{
			foreach ($posts as $post)
			{
				$upi = $this->Upi->recuperarPorId($post['idupi']);
				$post['upi'] = $upi[0];
				$colecao[] = $post;
			}
		}
		return $colecao;
	}
	
	//deveria a classe Elemento fazer esta operacao de recuperar as UPIs 
	// atraves de setar o FK
    function recuperarPorId($idpost)
    {
        $colecao = null ; //inicializando
    	$posts = $this->consulta(" and id =".$idpost);
        if((is_array($posts)) and (count($posts)>0) )
        {
            foreach ($posts as $post)
            {
                $upi = $this->Upi->recuperarPorId($post['idupi']);
                $post['upi'] = $upi;
              //  $post['container'] = $this->Container->recuperarPorId($post['idcontainer']);
                $colecao[] = $post;
            }
        }
        return $colecao;
    }
        	
    //deveria a classe Elemento fazer esta operacao de recuperar as UPIs 
    // atraves de setar o FK
    function recuperarTodos($sort =null)
    {
        $colecao = null ; //inicializando
    	$posts = parent::recuperarTodos($sort);
    	$this->Container = new Container();
        
        if((is_array($posts)) and (count($posts)>0) )
        {
            foreach ($posts as $post)
            {
                $upi = $this->Upi->recuperarPorId($post['idupi']);
                $post['upi'] = $upi;
                $post['container'] = $this->Container->recuperarPorId($post['idcontainer']);
                $colecao[] = $post;
            }
        }
        return $colecao;
    }    
    
	//necessita de refatorar por conta da etapa
	// recuperar arvore etapa em Etapa , 
	// talvez em vez de buscar etapa , buscar perfil_etapa
    function recuperarArvorePosts($idContainer,$idpost=null)
    {
        $Etapa = new Etapa();
        $Upi= new Upi();
        $Contrato= new Contrato();
    	
    	if(is_null($idpost)){ $idpost = 0; }
        
        $poste = $this->consulta("and idpost = $idpost and idcontainer =".$idContainer);
            
        if($poste != false)
        {
        	foreach ($poste as $posti)
            {
                $idpost = $posti['id'];
                $posti['etapa'] = $Etapa->recuperarPorId($posti['idetapa']);
                $posti['etapa']['contrato'] = $Contrato->recuperarPerfilPorEtapa($posti['idetapa']);
                $posti['etapa']['prox_etapa'] = $Etapa->recuperarArvoreEtapas($idContainer,$posti['idetapa']);
                $posti['upi'] = $Upi->recuperarPorId($posti['idupi']);
                $posti['posts'] = $this->recuperarArvorePosts($idContainer,$idpost);
                $post[] = $posti;
            }
        }
        else {
             return null;
        }
        return $post;
    }    
	
    function existeSubetapa($etapa)
    {
       if( is_array($etapa['prox_etapa'])  )
       {
            return true; 
       }
       else{
            return false;
       }
    }   
    
    function imprimirQtd($idetapa){
    	
    	return count($this->recuperarPorEtapa($idetapa));
    }


    function atualizar($idpost,$idupi){

        $sql = "UPDATE post SET idupi=$idupi, data=now()  WHERE id = $idpost ";
        $result = $this->update($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false
        return $result; //true ou false
    }
    
 
    
    function salvar($idupi,$idetapa,$idpostpai,$idcontainer){

    	$sql = "insert into post (idupi,idetapa,idpost,idcontainer,data)
                values ($idupi,$idetapa,$idpostpai,$idcontainer, now() )";
        
    	$lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

    	if($lastId != false)
    	{
    		return $lastId;
    	}
    	return false;
    }

}

?>
