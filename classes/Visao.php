<?php
include_once 'lib.php';
include_once 'TemplateVcom.php';

class Visao
{
	var $lib = null;
	var $aliasContainer;
	
    var $container;
    var $indiceContainer;
    
    var $etapa;
    var $indiceEtapa=0;

    var $subEtapa;
    var $indiceSubEtapa = 0;
    
    var $indiceNivel = 0;

    var $idTemplate;
    
	function __construct($container) {
        
		if(!is_null($container))
		{
			
			
			$this->container = $container;
			$this->etapa =  $this->container[0]['etapa'];
			
			$Tema = new Tema($this->container[0]['idtemplate']);
			
			$this->Template = new TemplateVcom($Tema);
			//$this->lib = new lib();
		}
	}

    function setTemplate($idtemplate){
        $this->idTemplate = $idtemplate;
    }	
	
    function getTituloEtapa(){
        return $this->etapa[$this->indiceEtapa]['alias'];
    }
    function getMaxSubEtapa(){
       $subetapa = $this->container[0]['etapa'][$this->indiceEtapa]['etapa'];
       return $subetapa[0]['max'];
    }
    
	function apresentaContainer($posts, $indiceNivel=-1){
		$indiceNivel++;
        //echo "<br><br>"; print_r($etapa);
		for($indiceEtapa=0; $indiceEtapa < count($posts) ; $indiceEtapa++ )
		{
			if($this->idTemplate == 1)
			{
			     $this->Template->apresentaBlog($posts[$indiceEtapa],$indiceNivel);	
			}
		    if($this->idTemplate == 2){
                 $this->Template->apresentaChat($posts[$indiceEtapa],$indiceNivel); 
            }
					
		    if( is_array($posts[$indiceEtapa]['posts']))
	        {
	            $subetapa = $posts[$indiceEtapa]['posts'];
	            $this->apresentaContainer($subetapa,$indiceNivel);    
	        }
		} 
	}
	
   function apresentaEditorUpi($posts, $indiceNivel=-1){
        $indiceNivel++;
        for($indiceEtapa=0; $indiceEtapa < count($posts) ; $indiceEtapa++ )
        {
            $this->Template->apresentaEditorUpi($posts[$indiceEtapa],$indiceNivel); 
                    
            if( is_array($posts[$indiceEtapa]['posts']))
            {
                $subetapa = $posts[$indiceEtapa]['posts'];
                $this->apresentaContainer($subetapa,$indiceNivel);    
            }
        } 
    }

	
	
}


?>