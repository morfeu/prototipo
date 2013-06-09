<?php
require_once 'Template.php';
include_once 'Elemento.php';
include_once 'Upi.php';
include_once 'Post.php';
include_once 'Perfil.php';
include_once 'Etapa.php';
include_once 'Prazo.php';
include_once 'Contrato.php';
include_once 'Usuario.php';
include_once 'Papel.php';
include_once 'Session.php';
include_once 'Container.php';
include_once 'Vcom.php';
include_once 'lib.php';
include_once 'Visao.php';
include_once 'Tema.php';
include_once 'Processador.php';

class Controlador
{
	//  objects
	var $Template = null;
	var $Usuario = null;
	var $Papel = null;
	var $Post = null;
    var $Vcom = null;
	var $_acao = null;

	function __construct() {

		//classes extras
		$this->sessao = new Session();
		
		//classes sistema
		$this->Template = new Template();
		$this->Usuario = new Usuario();
		$this->Papel = new Papel();
		$this->Post= new Post();
		$this->Vcom = new Vcom();
		$this->lib = new lib();
		$this->_acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : 'view';
	}

	function efetuaLogin($email,$senha){

		if($this->Usuario->validaUsuario($email,$senha) )
		{
			$this->sessao->atualizarInfoUsuario($email,$senha);
				
			return $_SESSION['logon'] = true;
		}
		else{
			return $_SESSION['logon'] = false;
		}
	}

    function recuperarConteudoVcomPrincipal($idvcom)
    {
        
        $this->sessao->atualizarInfoVcom($idvcom);
        
    }
    function recuperarConteudoVcomDetalhes($idvcom){
    	
    	$this->sessao->atualizarInfoVcom($idvcom);
    	
    }

   function recuperarConteudoSecaoDetalhes($idSecao){
        
        $this->sessao->atualizarInfoSecao($idSecao);
        $this->sessao->atualizarInfoSecaoMenuOpcEtapasIniciais();
        
    }   
    
	function recuperarConteudoUsuarioPrincipal()
	{
		$colecaoPerfil = $this->Papel->recuperarPorUsuario($_SESSION['usuario']['id']);
		$colecao_idvcom = $this->Papel->filtrarVcoms($colecaoPerfil);
		$_SESSION['vcomsUsuario'] = $this->Vcom->recuperarPorColecaoIdvcom($colecao_idvcom );
	//	$_SESSION['vcomsUsuario'] = $this->Vcom->recuperarVcomPorUsuario($_SESSION['usuario']['id']);
	}
   

    function recuperarUltimosVcoms()
    {
        $colecaoVcom = $this->Vcom->recuperarTodos("data");
        $ultimosVcom[] = $colecaoVcom[0];
        $ultimosVcom[] = $colecaoVcom[1];
        $ultimosVcom[] = $colecaoVcom[2];
        
        $this->sessao->atualizarUltimosVcoms($ultimosVcom);
    }
   
   function recuperarUltimasPostagens()
    {
        $colecaoPost = $this->Post->recuperarTodos("data");
        $ultimosPosts[] = $colecaoPost[0];
        $ultimosPosts[] = $colecaoPost[1];
        $ultimosPosts[] = $colecaoPost[2];
        $ultimosPosts[] = $colecaoPost[3];
        
        $this->sessao->atualizarUltimosPosts($ultimosPosts);
    }

    function recuperarUltimosVcomsAtualizados()
    {
        $colecaoPost = $this->Post->recuperarTodos("data");
        $colecao_idvcom = array();
        
        foreach ($colecaoPost as $post)
        {
        	if(count($colecao_idvcom)>0 )
        	{
        		if( (array_search($post['container']['secao']['vcom']['id'], $colecao_idvcom))=== null  )
        		{
        			$colecao_idvcom[] = $post['container']['secao']['vcom']['id'];
        		}
        	}
        	else{
        		$colecao_idvcom[] = $post['container']['secao']['vcom']['id'];
        	}
        }
        
        foreach ($colecao_idvcom as $idvcom)
        {
        	$colecaovcom[] = $this->Vcom->recuperarPorId($idvcom);
        }
        
        $ultimosAtualizados[] = $colecaovcom[0];
        $ultimosAtualizados[] = $colecaovcom[1];
        $ultimosAtualizados[] = $colecaovcom[2];
        
        $this->sessao->atualizarUltimosVcomsAtualizados($ultimosAtualizados);
    }    
    
    function efetuaLogout(){

        $_SESSION['logon'] = false;
        $_SESSION['usuario'] = null;
       // session_destroy();

    }
	function verificalogon(){

		if ($_SESSION['logon'] === true )
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function apresentaConteudo(){

		switch($this->_acao) {
			case 'cadNovoUser':
				// Form para cad novo user
				$this->Template->apresenta_conteudo_formCadNovoUser();
				break;
            case 'cadNovoVcom':
                // Form para cad novo VCom
                $this->Template->apresenta_conteudo_formCadNovoVcom();
                break;		
            case 'meusVcoms':
                // pag ini vcom
                if($this->verificalogon())
                {
                    $this->recuperarConteudoUsuarioPrincipal();
                    $this->Template->apresenta_listagemMeusVcoms();
                }
                else{
                    $this->Template->apresenta_conteudo_index();
                }
                break;              		
			case 'abrirVcom':
				// pag ini vcom
				if($this->verificalogon())
				{
					$this->recuperarConteudoVcomPrincipal($_GET['idVcom']);
					$this->Template->apresenta_conteudo_listaSecoesVcom();
					//$this->Template->apresenta_conteudo_vcom();
				}
				else{
					$this->Template->apresenta_conteudo_index();						
				}
				break;
            case 'abrirVcomDetalhes':
                // pag ini vcom
                if($this->verificalogon())
                {
                    $this->recuperarConteudoVcomDetalhes($_GET['idVcom']);
                    $this->Template->apresenta_conteudo_vcomDetalhes();
                }
                else{
                    $this->Template->apresenta_conteudo_index();                        
                }
                break;		
            case 'abrirSecao':
                // pag ini secao
                if($this->verificalogon())
                {
                    $this->recuperarConteudoSecaoDetalhes($_GET['idSecao']);
                    $this->Template->apresenta_conteudo_abrirSecao($_GET['idSecao']);
                }
                else{
                    $this->Template->apresenta_conteudo_index();                        
                }
                break;                  		
			case 'efetuarLogin':
				// pag ini vcom
				if($this->efetuaLogin($_POST['email'],$_POST['senha'] ))
				{
					$this->recuperarConteudoUsuarioPrincipal();
					$this->Template->apresenta_menuPrincipal();
					//$this->Template->apresenta_listagemMeusVcoms();
				}
				else{
					$this->Template->apresenta_conteudo_formLogin();
				}
				break;
			case 'salvarUser':
				// submit form_Registrese
				if( (isset($_POST['nome'])) and (!empty($_POST['nome'])) )
				{
					$result_user =  $this->Usuario->salvar($_POST['nome'],$_POST['sobrenome'],$_POST['email'],$_POST['senha']);
					if ($result_user != false) {
						echo "Cadastro User realizado com sucesso";
						
						//contrucao do vcom padrao : blog
						//$result_vcom =  $this->Vcom->salvar("Blog do ".$_POST['nome'],"Espaço Virtual colaborativo padrão do MOrFEu.",1,$result_user);
						$result_vcom =  $this->Vcom->construirVcomPadrao($_POST['nome'],$result_user);
						if ($result_vcom != false) {
							echo "Cadastro Vcom realizado com sucesso";
						}
					}
					else{
						echo "Cadastro não realizado !!";
					}
				}
				else
				{
					echo "Erro dados inválidos: tente novamente";
				}
				break;
            case 'minhasUpis':
		        if($this->verificalogon())
                {
                    $this->Template->apresenta_conteudo_minhasUpis();
                }
                else{
                    $this->Template->apresenta_conteudo_index();                        
                }
                break;				
            case 'registrese':
                // pag ini vcom
                $this->Template->apresenta_form_Registrese();
                break;
            case 'importarVcom':
                // importar da biblioteca
                $this->Template->apresenta_form_Registrese();
                break;
            case 'importarVcomXml':
                // importar de arquivo xml
                // direciona para template para executar processador xml
                $this->Template->apresenta_form_importVcomXml();
                break;                              
                
            case 'logout':
				// pag ini vcom
				$this->efetuaLogout();
				$this->Template->apresenta_conteudo_index();
				break;
			case 'view':
			default:
				
				$this->efetuaLogout();
				$this->recuperarUltimasPostagens();
				$this->recuperarUltimosVcoms();
				$this->recuperarUltimosVcomsAtualizados();
				// erro nada demias
				$this->Template->apresenta_conteudo_index();
				break;
		}


	}

}