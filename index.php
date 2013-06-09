<?php 
session_start();
include_once('classes/Controlador.php');
include_once('classes/lib.php');
//error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
error_reporting(1); 


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MOrFEu - Multi-Organizador Flexível de Espaços Virtuais</title>
<style type="text/css">
<!--

.corpoindex{
   width: 800px;
}

.bbb {
   color: #4E79A0;
}

.index1 {
    width: 370px;
    float: left;
    padding-left: 30px;
}

.toplistaVcom {
    border-bottom: 1px dashed #AE1337;
    float: left;
    margin: 0 0 10px;
    padding: 10px 0 8px;
    padding-left: 10px;
    width: 97%;
}

.index2 {
    width: 800px;
    float: left;
    padding-left: 30px;
    padding-top: 25px;
}

minhaupi blockquote {
	width: auto;
	border-top: 1px solid #e1cc89;
	border-bottom: 1px solid #e1cc89;
	font: 10px Georgia, "Times New Roman", Times, serif;
	background: #F8F7E9;
	text-indent: -18px;
	padding: 15px 30px 15px 25px;
	padding-left: 50px;
	text-align: left;
}

.desc_upi {
    
    color: #A2A185;
    font: 11px "Trebuchet MS", sans-serif;
    margin-bottom: -12px;
    padding-left: 5px;
}

.versao_upi {
    
    color: #A2A185;
    font: 11px "Trebuchet MS", sans-serif;
    margin-top: -17px;
    left: 0px;
    float: right;
}

minhaupi blockquote:before {
	position: relative;
	top: 10px;
	left: -19px;
	content: '\201C';
	font-size: 60px;
	display: block;
	float: left;
	height: 20px;
	color: #CDC19B;
}

minhaupi blockquote:after {
	position: relative;
	left: 20px;
	bottom: 20px;
	content: '\201D';
	display: block;
	float: right;
	height: 25px;
	color: #CDC19B;
	margin-top: 0px;
	padding-top: 45px;
	margin-top: 0px;
	font-size: 500%;
}


minhaupi p,minhaupi blockquote {
	margin-bottom: 14px;
	line-height: 1.6em;
	font-size: 11px;
	color: #292929;
}

.left_shows {
	border-bottom: 1px dashed #AE1337;
	float: left;
	margin: 0 0 10px;
	padding: 10px 0 8px;
	padding-left: 10px;
	width: 97%;
}

.show_date {
	color: #5F6C7A;
	float: left;
	font-size: 12px;
	min-height: 100%;
	height: auto;
	width: 180px;
}

.show_date2 {
	float: left;
}

.show_date2 span {
	padding-left: 15px;
}

.show_text_content {
	float: left;
	line-height: 18px;
	padding: 0 0 0 10px;
	text-align: justify;
	width: 270px;
}

a.more_details {
	color: #AE1337;
	float: right;
	font-weight: bold;
	padding: 10px 0 0;
	text-decoration: none;
	height: auto;
}

.descricaoSecao {
	float: left;
	padding: 0 0 10px 0;
}

.tituloAtividade {
	color: #961A06;
	float: left;
	width: 270px;
}

.linksmais {
	color: #4E79A0;
	float: right;
	font: 11px "Trebuchet MS", sans-serif;
	margin-top: 7px;
	padding-left: 5px;
}

h2.titulos {
	color: #004685;
	font: bold 16px "Trebuchet MS", sans-serif;
	margin: 0;
	padding: 3px 0;
	white-space: normal;
}

.titulosHome {
	border-bottom: 4px solid #D8E2EB;
	border-top: 1px solid #D8E2EB;
	margin: 0;
	padding: 0;
	white-space: nowrap;
}

div.noticiasHome {
	background-color: #FFFFFF;
	float: left;
	position: relative;
	white-space: normal;
	width: 90%;
	padding-left: 15px;
}

div.noticiasHome ul {
	list-style: none outside none;
	margin: 0;
	padding: 0;
	white-space: normal;
	width: 100%;
}

div.noticiasHome ul li { /*    border-bottom: medium none; */
	color: #585A5B;
	font: 11px/15px "Trebuchet MS", sans-serif;
	margin-left: 0;
	padding-left: 10px;
	padding-right: 10px;
}

div.noticiasHome ul li div.title h3 a {
	font: bold 12px "Trebuchet MS", sans-serif;
}

div.noticias ul li { /*border-bottom: 1px solid #D3D6D8;  */
	padding: 13px 1px 8px;
}

li.primeiroItem {
	border-bottom: 4px solid #D8E2EB;
	border-left: 4px solid #D8E2EB;
	border-right: 4px solid #D8E2EB;
	/*    border-top: 4px solid #D8E2EB;  */
}

li.primeiroItem div.title h3 {
	color: #585A5B;
	font: bold 12px/15px "Trebuchet MS", sans-serif;
}

li.Item {
	border-bottom: 1px solid #D8E2EB;
	/*    border-top: 4px solid #D8E2EB;  */
}

div.noticiasHome ul li.primeiroItem {
	color: #585A5B;
	font-size: 14px;
	padding-left: 10px;
	padding-right: 10px;
}

div.noticiasHome ul li.primeiroItem h3 a {
	color: #585A5B;
	line-height: 15px;
}

div.noticiasHome ul li.primeiroItem a:link,div.noticiasHome ul li.primeiroItem a:visited,div.noticiasHome ul li.primeiroItem a:active,div.noticiasHome ul li.primeiroItem a:hover
	{
	color: #585A5B;
	font-size: 14px;
}

div.noticiasHome a:link,div.noticiasHome a:visited,div.noticiasHome ul li.primeiroItem h3 a:link,div.noticiasHome ul li.primeiroItem h3 a:visited
	{
	color: #961A06;
	text-decoration: none;
}

div.noticiasHome a:hover,div.noticiasHome a:active,div.noticiasHome ul li.primeiroItem h3 a:hover,div.noticiasHome ul li.primeiroItem h3 a:active
	{
	color: #585A5B;
	text-decoration: underline;
}

.data {
	color: #961A06;
	font: 10px "Trebuchet MS", sans-serif;
	margin: 0;
}

.data a {
	font: 12px "Trebuchet MS", sans-serif;
	margin: 0;
	font-weight: bold;
	text-transform: uppercase;
}

.mtexto {
	text-align: justify;
	font-family: sans-serif;
	font-size: 12px;
	font-weight: normal;
	padding: 5px 0px 5px 0px;
}

.mbemvindo {
	border-bottom: 4px solid #8F2F00;
	color: #8F2F00;
	font: 18px "Trebuchet MS", sans-serif;
	margin: 0 0 5px;
}

.mstyle3 {
	color: #FFFFFF;
	font-size: 12px;
}

.mtituloSubmenu {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 12px;
}
.mtituloSubmenu2 {
    font-family: Georgia, "Times New Roman", Times, serif;
    font-size: 12px;
    font-weight: bold;
    color: #8F2F00;
}
.mtituloSubmenu3 {
    font-family: sans-serif;
    font-size: 10px;
    
    color: #C7CACC;
}
.mtituloSubmenu a {
	color: #005380;
	text-decoration: none;
}

.mtituloSubmenu a:hover {
	color: #004380;
	text-decoration: underline;
}

.mproducoes {
	color: #8F2F00;
	font-weight: bold;
}

.mtextomenu {
	font-size: 12px;
	color: #666666;
	padding: 5px 0px 15px 15px;
}

.micone {
	font-size: 12px;
	font-weight: bold;
	color: #581E00;
}

.mstyle13 {
	color: #006295;
	font-size: 12px;
}

.mstyle14 {
	color: #005380
}

.mstyle16 {
	color: #003F5E
}

.mstyle16 a {
	color: #003F5E;
	text-decoration: none
}

.mstyle16 a:hover {
	text-decoration: underline
}

.mstyle18 {
	color: #184217;
	font-size: 12px;
}

.mstyle19 {
	color: #184217
}

#texto {
	font-weight: 300;
}
-->
</style>

<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="icone.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php include_once("template/cabecalho.php"); ?>
	<!-- end #header -->
	<div id="page">
		<div id="content">
		  <?php include_once("template/conteudo.php"); ?>
		</div><!-- end #content -->
		<?php include_once("template/menulateral_dir.php"); ?>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
	<?php include_once("template/rodape.php"); ?>
	<!-- end #footer -->
</body>
</html>
