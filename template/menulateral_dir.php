<?php $img = "<img width=\"10\" height=\"10\" src=\"images/icones/edit/edit7.png\">" ;?>
<?php $img2 = "<img width=\"15\" height=\"15\" src=\"images/icones/edit/edit13.png\">" ;?>
<?php $lib = new lib();?>		
		<div id="sidebar">
			<ul>
			    <?php if($_SESSION['logon']){?>
                 <?php if(is_array($_SESSION['menuLateral']['minhasUpis'])){ ?>
                 <li>
                    <h2><?=$img2 ?> Minhas Produções</h2>
                    <?php foreach ($_SESSION['menuLateral']['minhasUpis'] as $opcmenu){  ?>
                    <p><?=$img ?>  <?=$opcmenu ?> </p>
                    <?php }?>
                    <p> &nbsp;</p>
                 </li>
                 <?php }?>			    
			    
			    <?php if((isset($_SESSION['vcom'])) and (strcasecmp($_GET['acao'],"abrirSecao" )== 0 )){?>
			    <?php if(is_array($_SESSION['secao']['menu'])){ ?>
                <li>
                    <h2><?=$img2 ?> Criar novo Post</h2>
                    <?php foreach ($_SESSION['secao']['menu'] as $opcmenu){  ?>
                    <p><?=$img ?>  <?=$opcmenu ?> </p>
                    <?php }?>
                    <p> &nbsp;</p>
                </li>
                <?php }?>
                <?php }?>
                <?php if(isset($_SESSION['vcom'])){?>
                <li>
                    <h2>Veículo de Comunicação</h2>
                    <p>Titulo: <?=$_SESSION['vcom']['titulo'] ?></p>
                    <p>Seção: <?=$_SESSION['secao']['titulo'] ?></p>
                    <p>Último Acesso: <?=$_SESSION['usuarioData'] ?></p>
                    <p>Registrado em: <?=$_SESSION['usuarioData'] ?></p>
                    <p><?=$lib->link("Mais informações", array("idVcom"=> $_SESSION['vcom']['id'], "acao"=>"abrirVcomDetalhes"));  ?></p>
                    <p><a href="index.php?acao=logout">[ Sair ]</a> </p>
                </li>
                <?php }?>
				<li>
					<h2>Informações de acesso</h2>
					<p>Usuário: <?=$_SESSION['usuario']['nome'] ?></p>
					<p>E-mail: <?=$_SESSION['usuario']['email'] ?></p>
					<p>Último Acesso: <?=$_SESSION['usuario']['data'] ?></p>
					<p>Registrado em: <?=$_SESSION['usuario']['data'] ?></p>
					<p><a href="index.php?acao=logout">[ Sair ]</a> </p>
				</li>
				<li>
					<h2>Meus VComs</h2>
					<ul>
						<li><a href="#">Morfeu Blog</a></li>
						<li><a href="#">Forum do Lied</a></li>
						<li><a href="#">Morfeus Respostas </a></li>
						<li><a href="#">Mural do PPGI</a></li>
						<li><a href="#">Blog do Java</a></li>
					</ul>
				</li>
				<?php }
				else{
				?>
				<form name="form2" method="post" action="index.php?acao=efetuarLogin">
                <li>
                    <h2>Acesso:</h2>
                    <p>Login : <input name="email" type="text" id="email" size="15" maxlength="40" ></p>
                    <p>Senha: <input name="senha" type="password" size="15"  id="senha"><input type="submit" value="Ok" ></p>
                    <p>&nbsp; </p>
                    <p><a href="index.php?acao=registrese">[ Registre-se ]</a> </p>
                </li>
                </form>    	
                <?php }?>	
               	
				<li>
					<h2>Outros VComs</h2>
					<ul>
                        <li><a href="#">Ramons Blog</a></li>
                        <li><a href="#">Blog Test</a></li>
                        <li><a href="#">Forum Teste</a></li>
						<li><a href="#">Debate de Teses</a></li>
						<li><a href="#">Noticias do Lied</a></li>
						<li><a href="#">Caderno da Info</a></li>
						<li><a href="#">Blog Edu</a></li>
						<li><a href="#">Blog.Net </a></li>
						<li><a href="#">Que blog é Esse</a></li>
						<li><a href="#">Forum de Noticias</a></li>
					</ul>
				</li>
			</ul>
	  </div>