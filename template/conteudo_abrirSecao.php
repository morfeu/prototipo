<?php
// Var sessores utilizaveis
//print_r($_SESSION['secao']);

$secao = $_SESSION['secao'];
//echo $secao['container'][0]['etapa'][0]['max'];
$v = new Visao($secao['container']);

//print_r($secao['container'][0]['etapa']);
//print_r($secao['container']);
// apenas o primeiro esta sendo apresentado ... verificar xxx

//print_r($_SESSION['vcomsUsuario']);

//echo $secao['container'][0]['idtemplate'];

$v->setTemplate($secao['container'][0]['idtemplate']);
$v->apresentaContainer($secao['container'][0]['posts']);




?>
