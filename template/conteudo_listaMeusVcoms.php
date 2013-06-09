<?php 

$lib = new lib();
// Var sessores utilizaveis
//print_r($_SESSION);

// contador para numeracao da tabelas meus vcoms
$contadorVcom = 1;
// vetor com valores do get para acesso ao Vcom
$p = new Papel();
$re = $p->recuperarPorUsuario($_SESSION['usuario']['id']);
//print_r($re);
?>

<h2 class="mbemvindo">Listagem dos Espaços Virtuais!</h2>
<?php foreach ($_SESSION['vcomsUsuario'] as $vcom) {?>  
<br>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="5%" bgcolor="#FFFFFF" scope="col"><img src="images/icones/m2.png" width="27" height="29" /></th>
    <th width="95%" bgcolor="#DBE7E8" scope="col"><div align="left" class="mmstyle13"> <span class="mstyle14">&nbsp;<strong>&nbsp;<span class="mtituloSubmenu"><?=$this->lib->link($vcom['titulo'], array("idVcom"=> $vcom['id'], "acao"=>"abrirVcom"));  ?></span></strong></span></div></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="mtextomenu"> <?=$vcom['descricao']; ?> </td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td class="mtextomenu"> Criado em <?=$vcom['data']; ?> por <?=$vcom['usuario']['nomeCompleto']; ?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="micone"><img src="images/icones/bullet2.gif" width="9" height="10" /><span class="mstyle16"><?=$lib->link("Mais informações", array("idVcom"=> $_SESSION['vcom']['id'], "acao"=>"abrirVcomDetalhes"));  ?></span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<br>


<h2 class="mbemvindo">Novo VCom?</h2>
<br>
<table width="95%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <th width="5%" bgcolor="#FFFFFF" scope="col"><img src="images/icones/subseta.gif" width="13" height="13" /></th>
    <th width="95%" bgcolor="" scope="col"><div align="left" class="mmstyle13"> <span class="mstyle14">&nbsp;<strong>&nbsp;<span class="mtituloSubmenu"> <?=$lib->link("Importar VCom (Biblioteca)", array("idVcom"=> $_SESSION['vcom']['id'], "acao"=>"importarVcom"));  ?></span></strong></span></div></th>
  </tr>
<tr>
    <th width="5%" bgcolor="#FFFFFF" scope="col"><img src="images/icones/subseta.gif" width="13" height="13" /></th>
    <th width="95%" bgcolor="" scope="col"><div align="left" class="mmstyle13"> <span class="mstyle14">&nbsp;<strong>&nbsp;<span class="mtituloSubmenu"> <?=$lib->link("Importar (Xml)", array("idVcom"=> $_SESSION['vcom']['id'], "acao"=>"importarVcomXml"));  ?></span></strong></span></div></th>
  </tr>
</table>
<?php }?>   


