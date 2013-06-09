

<div class="corpoindex">
	<div class="index1">
    	<div class="toplistaVcom">
            <div class=""><img width="9" height="10" src="images/icones/bullet1.gif"> Últimos Espaços Criados</div>
        </div>
        <?php foreach ($_SESSION['ultimosVcoms'] as $vcom){ ?>    
		<div class="">
		    <div class="data"><?php echo $vcom['data_br']; ?></div>
			<div class="mtituloSubmenu2"><?php echo $vcom['titulo']; ?> </div>
			<div class="mtexto"><?php echo $vcom['descricao']; ?> </div>
		</div>
        <?php }?>
	</div>
	
	<div class="index1">
	    <div class="toplistaVcom">
            <div class=""> <img width="9" height="10" src="images/icones/bullet1.gif"> Últimos Espaços Atualizados</div>
        </div>
        <?php foreach ($_SESSION['ultimosVcomsAtualizados'] as $vcom){ ?>    
        <div class="">
            <div class="data"><?php echo $vcom['data_br']; ?></div>
            <div class="mtituloSubmenu2"><?php echo $vcom['titulo']; ?> </div>
            <div class="mtexto"><?php echo $vcom['descricao']; ?> </div>
        </div>
        <?php }?>
	</div>
</div>


<div class="corpoindex">
    <div class="index2">
        <div class="left_shows">
            <div class=""> <img width="9" height="10" src="images/icones/bullet1.gif"> Últimas Postagens</div>
        </div>
        <?php foreach ($_SESSION['ultimosPosts'] as $post){ ?>        
        <div class="">
            <div class="data"> <?php echo $post['data_extenso'];?> Postado por <?php echo $post['upi']['usuario']['nome'] . " " . $post['upi']['usuario']['sobrenome'] ?></div>
            <div class="mtituloSubmenu2"><?php echo $post['container']['secao']['vcom']['titulo']. " - "; ?>  <span class="mtituloSubmenu3"> <?php echo $post['container']['secao']['titulo']; ?> </span></div>
            <div class="mtexto"> <?php echo strip_tags($post['upi']['texto']); ?></div>
        </div>
        <?php }?>
    </div>
    
</div>

<div>
    <div class="index2">
        <div class="left_shows">
            <div class=""> <img width="9" height="10" src="images/icones/bullet1.gif"> Sobre o Morfeu</div>
	        </div>
		        <div class="">
		        <div ><span>05-04-2011: 12:00:13</span> <span class="bbb" >Morfeu Atualizado , versão 0.1.2 </span> </div>
		        <div ><span>05-04-2011: 12:00:13</span> <span class="bbb" >Morfeu Atualizado , versão 0.1.1 </span> </div>
		        <div ><span>05-04-2011: 12:00:13</span> <span class="bbb" >Morfeu Atualizado , versão 0.1.0 </span> </div>
	        </div>
    </div>
</div>