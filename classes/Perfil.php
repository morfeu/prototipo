<?php

class Perfil extends Elemento
{
    //public $Upi;

    function __construct() {
        parent::__construct();
        $this->setTabela("perfil");
        //$this->Upi = new Upi();
    }
    
    
    // ainda n testado
    function recuperarPorVcom($idvcom)
    {
        $result = $this->consulta("and idvcom =".$idvcom);
        if((is_array($result)) and (count($result)>0) )
        {
           return $result;
        }
        else {
            return false;	
        }
        
    }
    
    function salvar($titulo,$descricao,$idvcom,$idtipo)
    {
       echo $sql = "insert into perfil (titulo,descricao,idvcom,idtipo) VALUES ('$titulo','$descricao',$idvcom, $idtipo)";

        $lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

        if($lastId != false)
        {
            return $lastId;
        }
        return false;
    }
  
}

?>
