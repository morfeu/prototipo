<?php 

//print_r($_SESSION);

$link_editorUpi = $this->lib->link($vcom['titulo'], array("idVcom"=> $vcom['id'], "acao"=>"abrirEditorUpi"));
$link_meusVcoms = $this->lib->link("Acesse", array("idVcom"=> $vcom['id'], "acao"=>"meusVcoms"));
$link_outrosVcoms = $this->lib->link($vcom['titulo'], array("idVcom"=> $vcom['id'], "acao"=>"abrirVcom"));

?>


<h2 class="mbemvindo">Bem Vindo!</h2>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="5%" scope="col"></th>
    <th width="98%" scope="col" class="mtexto">O MOrFEu é um Multi-Organizador Flexível de Espaços Virtuais, cujo o principal objetivo é oferecer a criação de novos ciberespaço, com fins de criação de documentos colaborativos. O grande diferencial é a possibilidade de configuração dos protocolos de interação. O administrador do Espaço virtual poderá definir quais atividades serão criadas e delegar a cada perfil as suas respectivas ações.</th>
  </tr>
  <tr>
    <th width="5%" scope="col"></th>
    <th width="98%" scope="col"><div align="left"><p align="left" class="mtexto">Crie o seu espaço virtual e convide seus amigos para participar</p></div></th>
  </tr>
</table>

<br>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="5%" bgcolor="#FFFFFF" scope="col"><img src="images/icones/M1.png" width="27" height="29" /></th>
    <th width="95%" bgcolor="#ECE1D7" scope="col"><div align="left" class="mstyle3"> &nbsp;<span class="mproducoes">&nbsp;<span class="mtituloSubmenu">Minhas Produções</span></span></div></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="mtextomenu">Acesse seu<strong> Editor de UPI</strong> para visualizar, criar, versionar e pesquisar sua produções. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="micone"><img src="images/icones/bullet1.gif" width="9" height="10" />Acesse</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="5%" bgcolor="#FFFFFF" scope="col"><img src="images/icones/m2.png" width="27" height="29" /></th>
    <th width="95%" bgcolor="#DBE7E8" scope="col"><div align="left" class="mmstyle13"> <span class="mstyle14">&nbsp;<strong>&nbsp;<span class="mtituloSubmenu">Meus Espaços Virtuais</span></strong></span></div></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="mtextomenu">Acesse a relação de <strong>Espaços Virtuais</strong> criados por você. Você poderá visalizar os resultados das interações entre os participantes. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="micone"><img src="images/icones/bullet2.gif" width="9" height="10" /><span class="mstyle16"><?=$link_meusVcoms; ?></span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="5%" bgcolor="#FFFFFF" scope="col"><img src="images/icones/m3.png" width="27" height="29" /></th>
    <th width="95%" bgcolor="#E2E9DA" scope="col"><div align="left" class="mstyle18"> &nbsp;<strong>&nbsp;<span class="mtituloSubmenu">Outros Espaços Virtuais</span></strong></div></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="mtextomenu">Descubra outros <strong>Espaços Virtuais</strong>. Acesse e/ou solicite sua participação caso necessário. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="micone"><img src="images/icones/bullet3.gif" width="9" height="10" /><span class="mstyle19">Acesse</span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
