<?php 
 foreach ($_SESSION['vcomsUsuario'] as $vcom) {
    
    if($vcom['id']==$_GET['idVcom'])
    {
        $secoes = $vcom['secao'];
        $VCOM = $vcom;
    }
 }

//print_r($secoes);

 //-----------------------------
 
function imprimirArvoreEtapas($etapas, $nivel = 1)
{
	foreach ($etapas as $etapa)
	{
        imprimirAtividade($etapa['alias'], $nivel);
		
		if(is_array($etapa['etapa'])){
            $nivel++;
			imprimirArvoreEtapas($etapa['etapa'],$nivel);
		}	
	}
}

// fx de html
// para imprimir a identacao da arvore de atividades/etapas
// e a figura
function imprimirAtividade($texto,$nivel)
{
	if($nivel ==1){
		$img = "<img src=\"images/icones/edit4.gif\" width=\"9\" height=\"10\" /> ";
	}
	else{
		$img = "<img src=\"images/icones/subseta.gif\" width=\"9\" height=\"10\" /> ";
	}

	$nivel = $nivel*15;
	$nivel.="px";
	echo "|<span style=\"padding-left: $nivel \"> ".$img.$texto."</span>";
	echo "<br>";
}

?>

<div class="caixaHomePT" id="conteudoNoticiasServicos">
<div class="noticiasHome">
<div class="titulosHome">
 <span class="linksmais"> 
    <a class="rss"	href="#"> Todos</a>
     | 
    <a	title="mais notícias" href="#">Meus Espaços</a>
     | 
    <a title="Informes ao Mercado"	href="#">Meus Espaços Privados</a>
 </span>
 
<h2 class="titulos"><?=$VCOM['titulo'];  ?></h2>
</div>


<div class="noticias">
<ul>
	<li class="primeiroItem" > 
	   <div class="data">Criado em  <?=$VCOM['data']; ?>  por <?=$VCOM['usuario']['nomeCompleto']; ?> </div>
	   <!-- <div class="title">	   <h3><a href="#" >Consulta Pública</a></h3> 	</div>  COMENTARIO!!! -->
	   <div class="description">    <a href="#" >  <?=$VCOM['descricao']; ?> </a>		</div>
	   <br>
	   <span> Seções: <br></span>
	   <?php foreach ($secoes as $secao) {?>
	   <span> <img src="images/icones/subseta.gif" width="9" height="10" /> <?=$secao['titulo'] ?></span> <br>
	   <?php }?>
	</li>
    <li class="Item">
    </li>
</ul>
</div>

<?php foreach ($secoes as $secao) {
        $container = $secao['container'][0]; //container nao dinamico                                   ?>
    <div class="left_shows">
     <div class="Item">
        <div class="data"><?php echo $this->lib->link($secao['titulo'], array("idVcom"=> $secao['idvcom'], "acao"=>"abrirSecao", "idSecao"=>$secao['id'])); ?>  </div>
     </div>     
     
     <div class="show_date"> Criado em <?php echo $secao['data']; ?>  <br> Autor: <?=$VCOM['usuario']['nomeCompleto']; ?>  <br> Nº <?php echo $this->lib->link("Participantes", array('filtro' => 1), true); ?>: X<br> Nº Atividades: <?=$container['qtdEtapas'] ?> <br> Publico: Sim
     <div class="description">


     
     </div></div>
     
     <div class="show_date2">
           <div class="descricaoSecao"><?php echo $secao['descricao']; ?> </div>
           <br>
           <div class="tituloAtividade">Atividades:</div>
           <br>
           <?php 
           $etapa = $container['etapas'];
         //  print_r($etapa);
           imprimirArvoreEtapas($etapa); 
           
           ?><br>
     </div>
     <a class="more_details" href="#">Última atualização: 20/01/2011 </a>
    </div>

<?php }?>
<br><br><br>


     


     


</div>

</div>


