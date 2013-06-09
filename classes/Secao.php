<?php
class Secao extends Elemento
{
	public $Vcom;
	
    function __construct() {
        parent::__construct();
        $this->setTabela("secao");
        
        $fk1['tabela'] = "vcom";
        $fk1['campo'] = "idvcom";
        $this->fks[] = $fk1;
        
        $this->Vcom = new VCom();
        
    }
    
    
    // Implementar Ainda
    function recuperarPorId2($id)
    {
        $result = $this->recuperar("idvcom"," and id = ".$id); 
        if(count($result)==1)
        {
            return $result[0]; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }

    function recuperarPorId($idsecao) 
    {
        $secao =  parent::recuperarPorId($idsecao);
        
        if((is_array($secao)) and (count($secao)>0) )
        {
            $secao['vcom'] = $this->Vcom->recuperarPorId($secao['vcom']['id']);
            $Container = new Container();
            $secao['container'] =  $Container->recuperarPorSecao($secao['id']);
            
        }
        return $secao;
    }    
    
    function recuperarPorVcom($idvcom)
    {
        $result = $this->recuperar($idvcom);
        if(count($result)>=1)
        {
            return $result; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }
    
    private function recuperar($idvcom, $whereAdd=null)
    {
        $Vcom = new VCom();
    	
    	$sql = "SELECT * FROM secao
                WHERE idvcom= $idvcom ".$whereAdd ;
        try {
            foreach ($this->conexao->query($sql) as $row) {
                $resultado['id'] = $row['id'] ;
                $resultado['titulo'] = $row['titulo'] ;
                $resultado['idvcom'] = $row['idvcom'];
                $resultado['vcom'] = $Vcom->recuperarPorId($row['idvcom'] );
                $resultado['publico'] = $row['publico'];
                $resultado['descricao'] = $row['descricao'];
                $resultado['data'] = $row['data'];
                $Container = new Container();
                $resultado['container'] =  $Container->recuperarPorSecao($row['id']);
                
                $colecao[] = $resultado;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
        return $colecao;
    }
    
    
    
    function salvar($titulo,$desc,$publico,$idvcom)
    {
    	echo $sql = "insert into secao (titulo,descricao,publico,idvcom, data) VALUES ('$titulo','$desc','$publico',$idvcom, now())";

    	$lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

    	if($lastId != false)
    	{
    		return $lastId;
    	}
    	return false;
    }
    
    
    
}




?>
