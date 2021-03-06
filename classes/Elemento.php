<?php

class Elemento
{
	public $tabela;
	public $pk;
	public $fks;
	public $debug = false;
	public $sort = null;
	public $conexao;

	function __construct() {
		$dsn = 'mysql:host=localhost;port=3306;dbname=morfeu1';
		$usuario = 'ramon';
		$senha = 'password';
		$opcoes = array(
		PDO::ATTR_PERSISTENT => true,
		PDO::ATTR_CASE => PDO::CASE_LOWER,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		);
           
	
		try {
			$this->conexao = new PDO($dsn, $usuario, $senha, $opcoes);
		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}
		$this->pk = "id";
	}
    
	function setPk($pkdatabela){
        $this->pk = $pkdatabela;
    }	

	function setTabela($nomedatabela){
		$this->tabela = $nomedatabela;
	}

	function recuperarTodos($sort=null)
	{
		$result = $this->recuperar(null,null,$sort);
		if(count($result)>=1)
		{
			return $result; //retorna a primeira e unica linha da colecao
		}else{
			return false;
		}
	}
	function recuperarPorId($id)
	{
		$result = $this->recuperar($id);
		if(count($result)==1)
		{
			return $result[0];
		}
		if(count($result)>1)
		{
			return $result; //retorna a primeira e unica linha da colecao
		}
		else
		{
			return false;
		}
	}
	/*
	 * @param string
	 */
	function setFk($fks) //---------------
	{
		$this->fks = $fks;
	}

	function consulta($where, $sort=null)
	{
		$result = $this->recuperar($id,$where,$sort);
		
		if(count($result)>=1)
		{
			return $result;
		}
		else{
			return false;
		}
	}

	private function debugSql($sql)
    {
    	if($this->debug)
    	{
    	   echo $sql;	
    	   $this->debug = false;
    	}
    }
    
    public function ordenar($campo)
    {
    	if(!is_null($campo))
        {
        	$this->sort =  " order by $campo desc ";
        }
        else{
        	$this->sort = "";
        } 
    	
    }
    
    //retorna o ultimo id inserido em caso de sucesso, senao return false
    public function inserir($sql)
    {	
    	$result = $this->conexao->query($sql);
        if($result)
        {
            
//        	print_r($result);
        	//return mysql_insert_id($result);     
            //lastInsertId
           return  $this->conexao->lastInsertId();
        }
    	return false;
    }

    public function update($sql)
    {   
        $result = $this->conexao->query($sql);
        if($result)
        {
            //return mysql_insert_id($result);     
            //lastInsertId
           return true;
        }
        return false;
    }
    
	private function recuperar($id, $whereAdd=null, $sort = null)
	{
		if ((is_null($id)) or ($id==0 ))
		{
			$id = $this->pk;
		}
		
		 $sql = "SELECT * FROM {$this->tabela}
                     WHERE {$this->pk} = $id ".$whereAdd ;
		 
		 $this->ordenar($sort);
		 
		 $sql= $sql.$this->sort; //fx ordenar
		 
		$this->debugSql($sql);
		 
		$result = $this->conexao->query($sql);
		if( count($result) >= 1 )
        {
			try {
				foreach ($result  as $row)
				{
					if((isset( $row['data'])) and (!is_null($row['data']) ))
					{
						$row['data_extenso'] = $this->formataData($row['data']);
						$row['data_br'] = date('d-m-Y', strtotime($row['data']));
					}
					
					if( count($this->fks) >= 1 )
					{
						foreach ($this->fks as $fk){
							$nomecampo = $fk['campo'];
							$nometabela = $fk['tabela'];
							$row[$nometabela] = $this->recuperarFk($row[$nomecampo],$nometabela);
							//$nomedaclasse = ucfirst($nometabela);
							//$obj = new $nomedaclasse; 
							//$row[$nometabela] = $obj->recuperarPorId($row[$nomecampo]);
						}
					}
					$colecao[] = $row;
				}
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
				return false;
			}
        }else {
        	return false;
        }
		return $colecao;
	}

	private function recuperarFk($id,$table)
	{
		$sql = "SELECT * FROM $table
                     WHERE id = $id " ;
		try {
			foreach ($this->conexao->query($sql) as $row) {
				$colecao[] = $row;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		}
		return $colecao[0];
	}
	
	private function codificarUtf8($colecao)
	{
		if(is_array($colecao))
		{
			foreach ($colecao as &$item) {

				if(!is_array($item))
				{
					//   mb_detect_encoding($colecao[$cont], "UTF-8") == "UTF-8" ? : $colecao[$cont] = utf8_encode($colecao[$cont])." -";
					$s = $item;
				//	$item = $this->fix_latin($s ); 
				}
				else{
					
					$this->codificarUtf8($item);
				}
			}
		}
		return $colecao;
	}



	private function fix_latin($instr){
		if(mb_check_encoding($instr,'UTF-8'))return $instr; // no need for the rest if it's all valid UTF-8 already
		global $nibble_good_chars,$byte_map;
		$outstr='';
		$char='';
		$rest='';
		while((strlen($instr))>0){
			if(1==preg_match($nibble_good_chars,$input,$match)){
				$char=$match[1];
				$rest=$match[2];
				$outstr.=$char;
			}elseif(1==preg_match('@^(.)(.*)$@s',$input,$match)){
				$char=$match[1];
				$rest=$match[2];
				$outstr.=$byte_map[$char];
			}
			$instr=$rest;
		}
		return $outstr;
	}
	//=============================================================
	//=============================================================
	
	
   /*
    * Formata a data e hora por extenso
    * @param datetime (xx-xx-xx 00:00:00)
    * @return string
    */
   private function formataData($data){

        $dia = substr($data, 0,10);

        setlocale(LC_TIME, "pt_BR.utf8");

        $info['data'] = strftime("%A, %d de %B de %Y", strtotime($dia)); //"1992-06-01"
        $info['hora'] = substr($data, -8);
        
        $dataformatada = utf8_encode( $info['data'])." às ".$info['hora'];
        
        return ucfirst($dataformatada); //array
    }
	
}
?>
