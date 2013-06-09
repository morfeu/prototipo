<?php
//include_once 'lib.php';
//include_once 'TemplateVcom.php';

class Tema
{
    var $link_EstiloEditar = '';
    var $link_EstiloSubetapa = '';
    var $sombra1 = '';
  
    function __construct($idtema) {
        
        if(!is_null($idtema))
        {
            switch($idtema) {
	            case 1:
	                // Form para cad novo user
	                $this->setTemaBlog();
	                break;
	            case 2:
	                // Form para cad novo VCom
	                $this->setTemaChat();
	                break;            
	            default:
	               die("Erro T01: Tema não encontrado!");
	                break;
            }
        }
    }

    function setTemaBlog(){
    	$this->sombra1 = "meta";
    	$this->link_EstiloEditar = "links";
    	$this->link_EstiloSubetapa = 'comments';
    }

   function setTemaChat(){
   	    $this->sombra1 = "chat";
        $this->link_EstiloEditar = "";
        $this->link_EstiloSubetapa = "";
    }
      
}


?>