<?php 
//print_r($xml);
//echo strval($xml->secao['nome']); // Obtem o atributo "formato" da data do livro

$Proc = new Processador("vcomteste13.xml");

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