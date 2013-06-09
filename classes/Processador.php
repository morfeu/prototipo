<?php


class Processador
{
    var $objxml = null;
    var $prefixoDir = null;
    var $Vcom ;
    

    function __construct($nomedoarquivo) {
    	
    	$this->objxml = simplexml_load_file('xml/'.$nomedoarquivo);
    	echo ($this->objxml->secao[1]->titulo); // Obtem o atributo "formato" da data do livro
    	echo " - ";
    	echo count(strval($this->objxml) );
    	echo count($this->objxml) ;
        //------------------
    	$this->Vcom = new VCom();
        $this->Secao = new Secao();
        $this->Container = new Container();
        $this->Etapa = new Etapa();
        $this->Perfil = new Perfil();
        $this->Contrato = new Contrato();
        $this->Papel = new Papel();
    	
    	// AQUIIIIIIIIII
    }
    
    function salvar() {
        
        $see = new Secao();
        $see.aa();
    }
    
}