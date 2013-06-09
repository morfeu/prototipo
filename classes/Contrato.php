<?php

class Contrato extends Elemento
{
	public $Perfil;
	public $Etapa;
	public $Prazo;

	function __construct() {
		parent::__construct();
		$this->setTabela("perfil_etapa");
		$this->Perfil = new Perfil();
		$this->Prazo= new Prazo();
		//$this->setPk(1);
	}

	// refatorar  xxxxx
	// Precisa retornar o vetor contrato com as info de perfil e etapa
	// no momento so retorna o vetor interessado nessa fx , retorna perfil
	// menu lateral e templatevcom usam essa fx
	function recuperarPerfilPorEtapa($idetapa)
	{
	//	$this->debug = true;
		$cont = 0;
		$result = $this->consulta("and idetapa = ".$idetapa);
		if((is_array($result)) and (count($result)>0) )
		{
			foreach ($result as $r)
			{
				$cont++;
				$colecao[$cont] = $this->Perfil->recuperarPorId($r['idperfil']);
				$colecao[$cont]['possuiPrazo'] = $r['prazo'];
				// $this->Prazo->debug = true;
				$colecao[$cont]['prazo'] =  $this->Prazo->recuperaPorContrato($r['id'] );
			}

		}
		else {
			return False;
		}
		return $colecao;
	}

        
    /*
     * Podem escrever todos aqueles que possuem contratos e estiverem dentro do prazo
     * Caso não tiverem contrato não oferecerá opcao para Postagem
     * Caso tiverem contrato e não estiver no prazo não oferecerá opcao para Postagem/edição
     */
    public function verificaPermissaoEscrita(array $colecaoPerfil, $perfisdouser)
    {
        foreach ($colecaoPerfil as $perfil)
        {
            foreach ($perfisdouser as $p)
            {
                if($perfil['id'] == $p['id'] )
                {
                    
                	//print_r($perfil);
                	
                	if($perfil['possuiPrazo']){
                	   $prazos[] = $perfil['prazo'];	
                	}
                	else{
                		return true; //permissao ok, ja que nao possui prazos definidos. sao indeterminados.
                	}
                	
                }
            }
        }
        if(count($prazos)==0)
        {
            return true;
        }
        else{
            return $this->verificaPrazoEscrita($perfil['prazo']);
        }
    }
   
    /*
     * Podem ler todos aqueles que nao possuem contratos 
     * Podem ler todos aqueles que possuem contratos , possuem prazo (true/1) e estao dentro do prazo  
     * Caso não estiver no prazo não oferecerá opcao para Postagem/edicao
     */
    public function verificaPermissaoLeitura(array $colecaoPerfil, $perfisdouser)
    {
    	foreach ($colecaoPerfil as $perfil)
    	{
    		foreach ($perfisdouser as $p)
    		{
                if($perfil['id'] == $p['id'] )
                {
                	if($perfil['possuiPrazo'])
                	{
                		$prazos[] = $perfil['prazo'];
                	}
                	else{
                		return true; //permissao ok, ja que nao possui prazos definidos. Os prazos sao indeterminados.
                	}
                }
    		}
    	}
    	if(count($prazos)==0)
    	{
    		return false;
    	}
    	else{
    		return $this->verificaPrazoLeitura($perfil['prazo']);
    	}
    	
    }
	
    public function verificaPrazoLeitura($prazo)
    {
    	return $this->Prazo->verificaPrazoLeitura($prazo);
    }
    public function verificaPrazoEscrita($prazo)
    {
        return $this->Prazo->verificaPrazoEscrita($prazo);
    }
    
    
    function salvar($idperfil,$idetapa,$prazo)
    {
       echo  $sql = "insert into perfil_etapa (idperfil,idetapa, prazo) VALUES ( $idperfil,$idetapa, $prazo)";
        
        $lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false
        
        if($lastId != false)
        {
            return $lastId;
        }
        return false;
    }
}

?>
