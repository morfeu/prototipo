<?php
/* $user = new Usuario();
 $user->recuperarUsuario("rafa@gmail.com", "12345");

 $u = new VCom();
 $a = $u->recuperarVcom(1);*/
 
 //print_r($_SESSION);
 
 
 
?>
<div class="post">
    <h2 class="title"><a href="#"><?php echo $_SESSION['vcom']['titulo'];  ?></a></h2>
    <p class="meta">Criado em Domingo, 26 Abril, 2010 12:27  por <a href="#"><?php echo $_SESSION['vcom']['usuario']['nome'];  ?></a></p>
    <div class="entry">
           <p>Abaixo estão informações referentes a criação do VCom</p>
           
           <span class="dados">Titulo: </span> <span ><?php echo $_SESSION['vcom']['titulo'];  ?> </span> <br>
           <span class="dados">Descrição: </span> <span ><?php echo $_SESSION['vcom']['descricao'];  ?> </span> <br>
           <span class="dados">Seção: </span> <span ><?php echo $_SESSION['vcom']['secao'][0]['titulo'];  ?> </span> <br>
           <span class="dados">Etapas: </span> <span ><?php echo $_SESSION['vcom'][''];  ?> </span> <br>
           <span class="dados">Acessar: </span> <br>
           <span class="dados">Perfís: </span> <br>
           <p> </p>
           
         <div><a href="#" class="links">Editar Post</a><a href="#" class="comments">Responder</a></div>
    </div>
</div>