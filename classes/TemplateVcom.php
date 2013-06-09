<?php

class TemplateVcom
{
	var $Tema;
	
	 function __construct($Tema) {
	 	$this->Tema = $Tema;
	 }
	
	//utf8_encode()
	//mb_detect_encoding($s, "UTF-8") == "UTF-8" ? : $s = utf8_encode($s);
	public function apresentaBlog($posts,$indiceNivel)
	{
		$this->Papel = new Papel();
		$this->Contrato = new Contrato();
		$this->Post = new Post();
		$dataPost= $this->formataData($posts['data']);
		
		$colecaoPerfil = $posts['etapa']['contrato']; // para cada POSt terá uma colecao de perfil ...llogo colecao de perfil , cada perfil possui seus prazozs . Essa colecao é o contrato!
        $this->perfisDoUser = $this->Papel->filtraPerfisdoUsuario($_SESSION['usuario']['id'], $colecaoPerfil);
		
   
        
		?>
		    <div style="margin-left: <?php echo 35*$indiceNivel; ?>px;">
				<div class="post">
					<h2 class="title"><a href="#"><?php echo $posts['etapa']['alias'];  ?></a></h2>
					<p class="<?=$this->Tema->sombra1; ?>"><?=$dataPost ?> Postado por <a href="#"><?php echo $posts['upi']['usuario']['nome'];  ?></a></p>
					<div class="entry">
					    <?php if($this->Papel->verificaUsuarioPorColecaoPerfil($_SESSION['usuario']['id'],$colecaoPerfil  ) ) { ?>
					       <?php if( $this->Contrato->verificaPermissaoLeitura($colecaoPerfil, $this->perfisDoUser ) ) { ?>
	           				        <p><?php echo $posts['upi']['texto']; ?></p>
					       <?php } ?>
					             
					    <?php }
					    else{ ?>   
                                    <p><?php echo $posts['upi']['texto']; ?></p>
                        <?php }?>
						<div> 
						<?php //*************** PERMISSAO PARA EDITAR - PERMISSAO ESCRITA ?> 
						<?php if($this->Papel->verificaUsuarioPorColecaoPerfil($_SESSION['usuario']['id'],$colecaoPerfil  ) and ($this->Contrato->verificaPermissaoEscrita($colecaoPerfil, $this->perfisDoUser ))){ ?>
							<a href="#" class="<?=$this->Tema->link_EstiloEditar; ?>"  onclick="window.open('editores/editorupi/index.php?acao=editarpost&idpost=<?=$posts['id']?>&idusuario=<?=$_SESSION['usuario']['id']?>&idupi=<?=$posts['upi']['id']?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Editar Post</a>
							
						<?php } ?>     
						<?php //*************** PERMISSAO PARA RESPONDER ?>   
					    <?php if( $this->permiteReply($posts)  )
						      {
                                    
						      	       $this->mostrarLinkSubEtapa($posts);
						      }?>
						    
						</div>
					</div>
				</div>
			</div>
	<?php
	}
	
    public function apresentaChat($posts,$indiceNivel)
    {
        $this->Papel = new Papel();
        $this->Contrato = new Contrato();
        $this->Post = new Post();
        $dataPost= $this->formataData($posts['data']);
        
        $colecaoPerfil = $posts['etapa']['contrato']; // para cada POSt terá uma colecao de perfil ...llogo colecao de perfil , cada perfil possui seus prazozs . Essa colecao é o contrato!
        $this->perfisDoUser = $this->Papel->filtraPerfisdoUsuario($_SESSION['usuario']['id'], $colecaoPerfil);
        
        ?>
            <div style="margin-left: <?php echo 35*$indiceNivel; ?>px;">
                <div class="post">
                   <p class="<?=$this->Tema->sombra1; ?>"> <span style="color: rgb<?=$this->escolheCorRGB($posts['upi']['usuario']['id']); ?>;font-size: 10px;">(<b><?php echo $posts['etapa']['alias'];  ?></b>) 
                   
                       <?=$posts['data'] ?></span> 
                       
                       <b> <span style="color: rgb<?=$this->escolheCorRGB($posts['upi']['usuario']['id']); ?> ;font-size: 12px;"> <?php echo $posts['upi']['usuario']['nome'];  ?>:    </span></b>  
                 
                        <?php if($this->Papel->verificaUsuarioPorColecaoPerfil($_SESSION['usuario']['id'],$colecaoPerfil  ) ) { ?>
                           <?php if( $this->Contrato->verificaPermissaoLeitura($colecaoPerfil, $this->perfisDoUser ) ) { ?>
                                    <?php echo $posts['upi']['texto']; ?>
                           <?php } ?>
                        <?php }
		                      else{ ?>   
		                          <?php echo $posts['upi']['texto']; ?>
		                    <?php }?>
                        
                        <?php //*************** PERMISSAO PARA RESPONDER ?>   
                        <?php if( $this->permiteReply($posts)  )
                              {

                              	     $this->mostrarLinkSubEtapa($posts);
                              }?>
                      </p>  
                </div>
            </div>
    <?php
    }
	

    public function apresentaArvoreUpi($posts,$indiceNivel)
    {
        $dataPost= $this->formataData($posts['data']);
        ?>
            <div style="margin-left: <?php echo 35*$indiceNivel; ?>px;">
                <div class="post">
                      <p>
                       <?=$dataPost ?> <?php echo $posts['upi']['texto']; ?>
                      </p>  
                </div>
            </div>
    <?php
    }
	
	function mostrarLinkSubEtapa($posts){

		//$colecaoPerfil2 = $posts['etapa']['prox_etapa'][0]['contrato'];
    	
		foreach ($posts['etapa']['prox_etapa'] as $prox_etapa)
		{
			$colecaoPerfil = $prox_etapa['contrato']; //contrato é uma colecao de perfil 
	        $perfisDoUser = $this->Papel->filtraPerfisdoUsuario($_SESSION['usuario']['id'], $colecaoPerfil);    
	        
	        
			if($this->Papel->verificaUsuarioPorColecaoPerfil($_SESSION['usuario']['id'],$colecaoPerfil  ) and ($this->Contrato->verificaPermissaoEscrita($colecaoPerfil, $perfisDoUser )) and ($prox_etapa['max'] > $this->Post->imprimirQtd($prox_etapa['id']) )) 
			{  
			?>
		         <a href="#" class="<?=$this->Tema->link_EstiloSubetapa; ?>" onclick="window.open('editores/editorupi/index.php?acao=novopost&idpost=<?=0?>&idpostpai=<?=$posts['id'] ?>&idcontainer=<?=$posts['idcontainer'] ?>&idetapa=<?=$prox_etapa['id'] ?>&idusuario=<?=$_SESSION['usuario']['id'] ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=600');"><?php  echo $prox_etapa['rotulo']; echo " (max: ".($this->maximoPostsParaSubetapa($prox_etapa)).") ";  //echo $this->ver($posts);  ?> </a>
		         
	        <?php 
	       
	        } 
	       
		}
	}
	
   /*
	* Formata a data e hora por extenso
	* @param datetime (xx-xx-xx 00:00:00)
	* @return string
	*/
	function formataData($data){

		$dia = substr($data, 0,10);

		setlocale(LC_TIME, "pt_BR.utf8");

		$info['data'] = strftime("%A, %d de %B de %Y", strtotime($dia)); //"1992-06-01"
		$info['hora'] = substr($data, -8);
        
		$dataformatada = $info['data']." às ".$info['hora'];
		
		return ucfirst($dataformatada); //array
	}
	
	// fx do Obj etapa
	function ver($post){
		return count($post['posts']);
	}
	// fx do Obj etapa
    function maximoPostsParaSubetapa($etapa){
        return $etapa['max'];
    }
    
    function permiteReply($posts){
    	
    	$Post= new Post();

    	if(  ($Post->existeSubetapa($posts['etapa']) ) and ($posts['etapa']['max'] >=  count($posts['posts']) ) )
    	{
    	   return true;	
    	}	
    	else{
    	   return false;	
    	}
        
    }
    
    public function escolheCorRGB($id,$random = false ){
         
        if($id == $_SESSION['usuario']['id'])
        {
            return $this->retornaCor(0);//retorna o default = red
        }
        else{
        	if(empty($_SESSION['fx'][$id]) )
        	{
        		$_SESSION['fx'][$id] = $this->retornaCor(count($_SESSION['fx'])+1);	
        		return $_SESSION['fx'][$id];
        	}
        	else{
        		return $_SESSION['fx'][$id];
        	}
        }
    }
    
    // chat!!! 
    public function retornaCor($num){

        if(!is_null($num))
        {
            switch($num) {
                case 1:
                    // Form para cad novo user
                     return "(0, 102, 153)"; // do usuario logado
                    break;
                case 2:
                    // Form para cad novo VCom
                     return "(33,94,33)";
                    break;
                case 3:
                    // Form para cad novo VCom
                     return "(142,107,35)";
                    break;
                case 4:
                    // Form para cad novo VCom
                     return "(300,0,0)";
                    break;
                case 5:
                    // Form para cad novo VCom
                     return "(153,50,205)";
                    break;
                case 6:
                    // Form para cad novo VCom
                     return "(143,143,189)";
                    break;
                case 7:
                    // Form para cad novo VCom
                     return "(66,66,111)";
                    break;
                case 8:
                    // Form para cad novo VCom
                     return "(78,47,47)";
                    break;
                case 9:
                    // Form para cad novo VCom
                     return "(0,0,156)";
                    break;                                                                                
                default:
                    return "(128,0,0)"; // do usuario logado
                 
                    break;
            }
        }
    	
    }
    
    
 }
?>