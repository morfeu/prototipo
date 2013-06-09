<?php
$lib = new lib();
$Upi = new UPI();

function imprimirAtividade($upi,$nivel)
{
	
    $img = "<img align=\"bottom\" width=\"11\" height=\"11\" src=\"images/icones/edit/edit3.png\" > " ;
	
    $vetor['idupi'] = $upi['id'];
    $vetor['filtro'] = 1; // exibe arvore de uma versao de upi
    
    $param['acao'] = "novaversaoupi";
    $param['idusuario'] = $_SESSION['usuario']['id'];
    $param['idupi'] = $upi['id'];
    $space = "&nbsp;&nbsp; &nbsp; ";
    $lib = new lib();
    
    if($_GET['idupi'] == $upi['id'])    {
    	   $upi_format_fundo = "#FFFFCC";      //   $upi_format_fundo = "#F8F0E9";
    }
    else{
        $upi_format_fundo = "#F8F7E9";	
    }
    ?>
    <div style="margin-left: <?php echo 25*$nivel; ?>px;">
        <div class="desc_upi"><?php echo $lib->formataData($upi['data'])?></div>
            <minhaupi class="">
                <blockquote style="background:<?php echo $upi_format_fundo; ?>"><?php echo $upi['texto']?></blockquote>
            </minhaupi>
        <div class="versao_upi"><?php echo $img; echo $lib->linkpopup("Nova Versão", $param); echo $space; echo $img; echo $lib->link("Ver Versões", $vetor, true);?></div>
    </div>
    <?php
}

function imprimirArvoreUpis($upi_tree, $nivel = -1)
{
    $nivel++;
	foreach ($upi_tree as $upi)
    {
        imprimirAtividade($upi, $nivel);
        
        if(is_array($upi['upi'])){
            
            imprimirArvoreUpis($upi['upi'],$nivel);
        }   
    }
}

function apresentarArvoreUpi($idupi){
	$Upi = new UPI();
	
	if( (isset($idupi) and (!empty($idupi))) ){

		$idupi = $Upi->recuperarRaizUpi($_GET['idupi']);
		$upi_tree[] = $Upi->recuperarArvoreUpi($idupi);
		//print_r($upi_tree);
		imprimirArvoreUpis($upi_tree);
	}

	else{
        echo "Você ainda não possui produções realiozadas no MOrFEu!";
	}
}

function apresentarTodasUpis(){
    $Upi = new UPI();
	$colecao_upi = $Upi->recuperarPorUsuario($_SESSION['usuario']['id']);
   // print_r($colecao_upi);
	if(is_array($colecao_upi)){
		foreach ($colecao_upi as $upi){
			imprimirAtividade($upi, $nivel);
		}
	}
}

function apresentarTodasUpisRaiz(){
    $Upi = new UPI();
    $colecao_upi = $Upi->recuperarPorUsuario($_SESSION['usuario']['id']);

    if(is_array($colecao_upi)){
        foreach ($colecao_upi as $upi){
        	if($upi['idupi'] == 0){
        	   imprimirAtividade($upi, $nivel);	
        	}
            
        }
    }
}

?>
<div class="titulosHome">
 <span class="linksmais"> 
    <?php echo $lib->link("Todas", array('filtro' => 2), true); ?>
     | 
    <?php echo $lib->link("Blog", array('filtro' => 3), true); ?>
     | 
    <?php echo $lib->link("Publicados", array('filtro' => 4), true); ?>
 </span>
 
<h2 class="titulos"> Minhas Produções</h2>
</div>

<br><br>

<?php 

//===============================================================================
//===============================================================================
//===============================================================================

switch($_GET['filtro']) {
	case '1':
		// filtro para apresentar arvore de versoes completa de uma upi
		apresentarArvoreUpi($_GET['idupi']);
		break;
	case '2':
		// filtro para apresentar TODAS as upis em forma de listagem
		apresentarTodasUpis();
		break;
    case '3':
        // Somente as upis RAIZ : opc Blog
        apresentarTodasUpisRaiz();
        break;
    case '4':
        // filtro para apresentar apenas as upis Publicadas em ordem recente
        $this->Template->apresenta_conteudo_formCadNovoVcom();
        break;
	default:
		apresentarTodasUpis();
    }





?>



