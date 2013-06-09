<?php

class Prazo extends Elemento
{
	public $Contrato;

	function __construct() {
		parent::__construct();
		$this->setTabela("prazo");
		//$this->Perfil = new Perfil();
		//   $this->Etapa = new Etapa();
		//$this->setPk(1);
	}

	function recuperaPorContrato($idcontrato)
	{
		//$this->debug = true;
		$result = $this->consulta("and idperfil_etapa = ".$idcontrato);
		if((is_array($result)) and (count($result)>0) )
		{
			return $result;
		}
		else {
			return False;
		}
	}

	/*
	 * @param array: $contrato
	 * @return boolean
	 *
	 */
	public function verificaPrazoEscrita(array $prazos)
	{
        $prazoLimite = false;
        
        foreach ($prazos as $prazo)
        {
            if($prazo['escrita']==1) //leitura
            {
                if(date('ymd', strtotime($prazo['datafim']) ) >= date('ymd') and (date('ymd', strtotime($prazo['dataini'])) <= date('ymd')) ) 
                {
                    $prazoLimite = true;
                }
            }
        }
         
            return $prazoLimite;
		
	}
	/*
	 * @param array: $prazos
	 * @return boolean
	 *
	 */
	public function verificaPrazoLeitura(array $prazos)
	{
		$prazoLimite = false;
		
		foreach ($prazos as $prazo)
		{
			if($prazo['escrita']==0) //leitura
			{
				if(date('ymd', strtotime($prazo['datafim']) ) >= date('ymd') and (date('ymd', strtotime($prazo['dataini'])) <= date('ymd')) ) 
				{
					$prazoLimite = true;
				}
			}
		}
		 
			return $prazoLimite;
	}

}

?>
