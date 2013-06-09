<?php

include_once 'Usuario.php';
include_once 'Vcom.php';
include_once 'lib.php';

class Session
{
	//dados do usuario
    var $usuarioNome = null;
    var $usuarioEmail= null;
    var $usuarioNomeCompleto = null;
    var $usuarioData = null;
    var $usuarioId = null;
    
    function __construct() {
    	$this->analisaGet();
    }
    
    function analisaGet(){
    	
    	if( $_GET['acao'] === "minhasUpis"  ){
    		
    		$Lib = new lib();
    		$_SESSION['menuLateral']['minhasUpis'] = array();
    		$_SESSION['menuLateral']['minhasUpis'][0] = $Lib->linkpopup("Criar Nova UPI", array("acao"=>"novaupi","idusuario"=>$_SESSION['usuario']['id']));
    	}
    	else{
    		$_SESSION['menuLateral']['minhasUpis'] = null;
    	}
    }

    function atualizarUltimosVcomsAtualizados($colecao){
      //  print_r($colecao);
        $_SESSION['ultimosVcomsAtualizados'] = $colecao;
    }    

    function atualizarUltimosVcoms($colecao){
        //print_r($colecao);
        $_SESSION['ultimosVcoms'] = $colecao;
    }    
    
    function atualizarUltimosPosts($colecao){
 
        $_SESSION['ultimosPosts'] = $colecao;
    }    
    
    function atualizarInfoUsuario($email,$senha){
    	
    	$user = new Usuario();
    	$usuario = $user->recuperarUsuario($email, $senha);
    	$_SESSION['usuario'] = $usuario;
    		
    }
    function atualizarInfoVcom($idvcom){
        
        $VCom = new Vcom();
        $_SESSION['vcom'] = $VCom->recuperarVcom($idvcom);
        
    }
    function atualizarInfoSecao($idsecao){        
        $Secao = new Secao();
        $s = $Secao->recuperarPorId($idsecao);
        $_SESSION['secao'] = $s;
    }
       
    // insere na session as opcoes de Postagem das etapas iniciais do Vcom, especificamente da Secao. 
    function atualizarInfoSecaoMenuOpcEtapasIniciais(){    
        
    	$Lib = new lib();
        $Papel = new Papel();
        $Contrato = new Contrato();
        
       // print_r($_SESSION['secao']);
        //container [0] trabalhando só com 1 container   
        
    	foreach ($_SESSION['secao']['container'][0]['etapas'] as $etapa){
    		$colecaoPerfil = $etapa['contrato'];
    		$perfisDoUser = $Papel->filtraPerfisdoUsuario($_SESSION['usuario']['id'], $colecaoPerfil);
    		//print_r($colecaoPerfil);
            if($Papel->verificaUsuarioPorColecaoPerfil($_SESSION['usuario']['id'],$colecaoPerfil  )){

            	if( $Contrato->verificaPermissaoEscrita($colecaoPerfil, $perfisDoUser ) ) { 	
	    	       	$_SESSION['secao']['menu'][] = $Lib->linkpopup($etapa['rotulo'], array("acao"=>"novopost","idusuario"=>$_SESSION['usuario']['id'],"idpostpai"=> 0,"idetapa"=> $etapa['id'],"idpost"=> 0,"idcontainer"=> $etapa['idcontainer']));
	             }	
        	}
    	}
    }    
    
	
}