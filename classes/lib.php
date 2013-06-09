<?php
class lib
{
	var $prefixoDir = null;
	
    function __construct() {
  
        if(PHP_OS != "WINNT") { // Se "não for Windows"
            $quebraLinha = "\n";
            $separaDiretorio = ":";
            $extModulo = ".so";
            $this->prefixoDir = "";
            
        } else { // Se for Windows
            $quebraLinha = "\r\n";
            $separaDiretorio = ";";
            $extModulo = ".dll";
            $this->prefixoDir = "/../";
        }
    }
	
	
	private function contruirLink($texto, array $param, $popup = false)
	{
        //
		$link = "index.php?";
        
		foreach ($param as $key => $param)
		{
			if ($param == "") {
				$param = 0;
			}

			$link .= "$key=$param&";
		}
		
		if(!$popup) {return "<a href=\"$link\"> $texto </a>"; }

		else{ 
			return "<a href=\"#\" class=\"links\"  onclick=\"window.open('editores/editorupi/$link',
		'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\">$texto</a>" ;  }

	}


	public function link($texto, array $param, $linkinterno = false){
		
		if($linkinterno)
		{
			$param = $param + $_GET;  
		}

		return  $this->contruirLink($texto, $param );

	}

	public function linkpopup($texto, array $param){
		 
		return  $this->contruirLink($texto, $param, true);

	}
    

   /*
    * Formata a data e hora por extenso
    * @param datetime (xx-xx-xx 00:00:00)
    * @return string
    */
    function formataData($data){

        $dia = substr($data, 0,10);

        setlocale(LC_TIME, "pt_BR.utf8");

        $info['data'] = strftime("%A, %d de %B de %Y", strtotime($dia)); //"1992-06-01"
        $info['hora'] = substr($data, -8);
        
        $dataformatada = $info['data']." às ".$info['hora'];
        
        return ucfirst($dataformatada); //array
    }

	
	
}
?>