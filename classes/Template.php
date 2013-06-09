<?php
include_once 'lib.php';

//phpinfo();

class Template
{
	var $lib = null;
	var $prefixoDir = null;

	function __construct() {

		$this->lib = new lib();
		if(PHP_OS != "WINNT") { // Se "não for Windows"
			$quebraLinha = "\n";
			$separaDiretorio = ":";
			$extModulo = ".so";
			$this->prefixoDir = "";
			
		} else { // Se for Windows
			$quebraLinha = "\r\n";
			$separaDiretorio = ";";
			$extModulo = ".dll";
			$this->prefixoDir = "/../";
		}
	}

	function apresenta_conteudo_index(){

		include $this->prefixoDir.'template/conteudo_index.php';	
	}
    function apresenta_conteudo_formLogin(){

        include $this->prefixoDir.'template/conteudo_formLogin.php';    
    }
    function apresenta_conteudo_listaSecoesVcom(){

        include $this->prefixoDir.'template/conteudo_listaSecoesVcom.php';

    }
	function apresenta_conteudo_vcom(){

		include $this->prefixoDir.'template/conteudo_vcom.php';

	}
    function apresenta_menuPrincipal(){

        include $this->prefixoDir.'template/menuPrincipal.php';

    }	
    function apresenta_conteudo_abrirSecao(){

        include $this->prefixoDir.'template/conteudo_abrirSecao.php';
    }	
    function apresenta_conteudo_vcomDetalhes(){

        include $this->prefixoDir.'template/conteudo_vcomDetalhes.php';
    }	

	function apresenta_form_Registrese(){
		include $this->prefixoDir.'template/form_registrese.php';
	}

    function apresenta_form_importVcomXml(){
        include $this->prefixoDir.'template/form_importVcomXml.php';
    }

	function apresenta_listagemMeusVcoms(){
		//include $this->prefixoDir.'template/conteudo_opcaoCadVcom.php';
		include $this->prefixoDir.'template/conteudo_listaMeusVcoms.php';
	}
	function apresenta_conteudo_formCadNovoVcom(){
		include $this->prefixoDir.'template/conteudo_formCadNovoVcom.php';
		 
	}
    function apresenta_conteudo_minhasUpis(){
        include $this->prefixoDir.'template/conteudo_minhasUpis.php';
         
    }	
	
}


?>