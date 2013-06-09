<?php

class Papel extends Elemento
{
    public $Perfil;
    public $Usuario;

    function __construct() {
        parent::__construct();
        $this->setTabela("usuario_perfil");
        $this->Perfil = new Perfil();
        $this->Usuario = new Usuario();
        $this->setPk(1);
        
        $fk1['tabela'] = "perfil";
        $fk1['campo'] = "idperfil"; 
        $this->fks[] = $fk1; 
        $fk2['tabela'] = "usuario";
        $fk2['campo'] = "idusuario"; 
        $this->fks[] = $fk2; 
        
    }

    //naop testado
    function recuperarPorPerfil($idperfil)
    {
        $result = $this->consulta("and idperfil =".$idperfil);
        if((is_array($result)) and (count($result)>0) )
        {
            foreach ($result as $r)
            {
                $perfil = $this->Perfil->recuperarPorId($r['idperfil']);
                $r['perfil'] = $perfil[0];
                $colecao[] = $r;
            }
        }
        return $colecao;
    }
    
    
    /* @return boolean
     * @param $colecaoPerfil pode ser o array contrato
     */
    function verificaUsuarioPorColecaoPerfil($idusuario="idusuario",$colecaoPerfil = array())
    {
        foreach ($colecaoPerfil as $perfil)
        {
        	if($this->verificaUsuarioPerfil($idusuario,$perfil['id']) )
        	{
        		return true;
        	}
        }
        
        //caso não retorne true é pq nenhum dos perfis pertence ao usuario
        return false;
    }

    /* Retorna uma colecao de perfil de um mesmo usuario a partir de uma colecao de perfis
     * @return array:perfil em caso de sucesso
     * @return boolean em caso de não possuir
     * @param $colecaoPerfil pode ser o array contrato
     */
    function filtraPerfisdoUsuario($idusuario="idusuario",$colecaoPerfil = array())
    {
        foreach ($colecaoPerfil as $perfil)
        {
            if($this->verificaUsuarioPerfil($idusuario,$perfil['id']) )
            {
                $Perfis[] = $perfil;
            }
        }
        
        if(count($Perfis)==0)
        {
            //caso não retorne true é pq nenhum dos perfils pertence ao usuario
            return false;
        }
        else{
        	return $Perfis;
        }
    }    
    
    function verificaUsuarioPerfil($idusuario="idusuario",$idperfil="idperfil")
    {
    	//$this->debug = true;
    	
        $result = $this->consulta("and idusuario = ".$idusuario." and idperfil = ".$idperfil);
        if((is_array($result)) and (count($result)>0) )
        {
            return true;            
        }
        else {
            return False;
        }
    }
    
    function recuperarPorUsuario($idusuario)
    {
    	$this->setPk("idusuario");
    	
        $result = $this->recuperarPorId($idusuario);
        if((is_array($result)) )
        {
            return $result;    
        }
        else{
        	return false;
        }
    }
    
    
    function filtrarVcoms($colecaoPapeis)
    {
    	$colecao_idvcom =  array();
    	//print_r($colecaoPapeis);
    	
    	if(is_array($colecaoPapeis))
    	{
    		//caso o parametro for somente 1 item , desta forma ele nao receberá um vetor de array Papel, apenas o PAPEL...ou seja
    		// Para caso quando não for uma colecao , e assim apenas o vetor papel  
	    	if(is_array($colecaoPapeis['perfil'])){
	    	
	    		$colecao_idvcom[] = $colecaoPapeis['perfil']['idvcom'];
	    		return $colecao_idvcom;
	    	}
	    	else{
		    	
	    		foreach ($colecaoPapeis as $papel) {
		            
		    		$idvcom = $papel['perfil']['idvcom'];
		    		if (!in_array($idvcom, $colecao_idvcom)) {
		    			$colecao_idvcom[] = $idvcom;
		    		}
		    	}
	    	}
    	}
    	return $colecao_idvcom;
    }
    
    
    function salvar($idusuario, $idperfil)
    {
       echo  $sql = "insert into usuario_perfil (idusuario,idperfil) VALUES ( $idusuario,$idperfil)";
        
        $lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false
        
        if($lastId != false)
        {
            return $lastId;
        }
        return false;
    }
}

?>
