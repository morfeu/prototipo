<?php
include_once 'Secao.php';

class VCom extends Elemento
{
	public $Secao;
	public $Container;
	public $Etapa;
	public $Perfil;
	public $Contrato;
	
	function __construct() {
        parent::__construct();
        $this->setTabela("vcom");
	}
	
	function cadastrarUsuario($titulo,$descricao,$publico,$idusuario)
	{
		$sql = "insert into vcom (titulo,descricao,publico,idusuario, data) VALUES ('$titulo','$descricao','$publico','$idusuario', now())";
		$inseriu = $this->conexao->exec($sql);
		if($inseriu)
		{
			$this->_setId($this->conexao->lastInsertId());
			return true;
		}
		else{
			return false;
		}
	}
    // implementar ainda
    function recuperarVcom($id)
    {
        $result = $this->recuperar($id);
        if(count($result)==1)
        {
            return $result[0]; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }
    
    function construir($atributos, $Contrato, $Compromisso){
    	
    	$result =  $this->salvar($atributos['titulo'], $atributos['descricao'], $atributos['publico'], $atributos['idusuario']);
    	
    	if($result != false){
    		return true;
    	}
    }
    
    
    /*
     * Param: Nome e id do user 
     * todo: o nome poderia ser opcional caso nao passasse por parametro , faria a recuperacao dos dados do user e pegaria o nome do user
     */
    function construirVcomPadrao($nomedousuario, $idusuario){
        $this->Secao = new Secao();
    	$this->Container = new Container();
    	$this->Etapa = new Etapa();
    	$this->Perfil = new Perfil();
    	$this->Contrato = new Contrato();
    	$this->Papel = new Papel();
        echo "<br>";
        $result_vcom =  $this->salvar("Blog do ".$nomedousuario,"Espaço Virtual colaborativo padrão do MOrFEu. Este espaço tem com formato de interação similar ao que consideramos como Blog", 1, $idusuario);  echo "<br>";
        if($result_vcom != false){
        	$result_secao = $this->Secao->salvar("Principal", "Página principal do Blog", 1, $result_vcom);
        	if($result_secao != false){
        		$result_container = $this->Container->salvar("Container Principal", $result_secao,1 ); 
	        	if($result_container  != false){
	                $result_etapa1 =   $this->Etapa->salvar("Notícia", "Criar Notícia",99,0,0,$result_container ); 
	                $result_etapa2 =   $this->Etapa->salvar("Comentário", "Comentar",99,0,$result_etapa1 ,$result_container ); 
	                if($result_etapa1  != false){
	                	$result_perfil1 = $this->Perfil->salvar('Blogueiro','Responsável pela publicação das postagens do blog',$result_vcom ,0); 
	                	if($result_perfil1  != false){
	                		$result_contrato1 = $this->Contrato->salvar($result_perfil1,$result_etapa1,0); 
	                		$result_papel = $this->Papel->salvar($idusuario,$result_perfil1 ); 
	                	}
	                }
	        	    if($result_etapa2  != false){
	        	    	$result_perfil2 = $this->Perfil->salvar('Visitante','Responsável pelos comentários nas postagem do blog',$result_vcom ,0); 
	        	        if($result_perfil2  != false){
                            $result_contrato2 = $this->Contrato->salvar($result_perfil2,$result_etapa2,0); 
                            
                        }
                    }
                    
	            }
        	}
          
        }
            echo "................<br> Erro T01: ";
            var_dump($result_contrato1);
            var_dump($result_contrato2);
            var_dump($result_papel);
            echo "<br>";
        if( ($result_contrato2 != false ) and ($result_contrato1 != false )){
        	echo "registro realizado com Sucesso!";
        }
        else{
        	echo "[[merda]] <br>";
        }
        
          
        return false;
    }

    function salvar($titulo,$desc,$publico,$idusuario)
    {
      echo  $sql = "insert into vcom (titulo,descricao,publico,idusuario, data) VALUES ('$titulo','$desc','$publico',$idusuario, now())";
        
        $lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

        if($lastId != false)
        {
            return $lastId;
        }
        return false;
    }       
    
    
    function recuperarPorColecaoIdvcom($colecao_idvcom)
    {
    	if(count($colecao_idvcom)==0){return false;}
    	
    	if(count($colecao_idvcom)>1)
    	{
	    	foreach ($colecao_idvcom as $idvcom)
	    	{
	    	   $colecao[] =  $this->recuperarVcom($idvcom);
	    	}
    	}
    	else {
    		   $colecao[] =  $this->recuperarVcom($colecao_idvcom[0]);
    	}
    	
    	return $colecao;
    }
    
    //por autor , criado do vcom
    function recuperarVcomPorUsuario($idusuario)
    {
        $result = $this->recuperar($idusuario);
        if(count($result)>=1)
        {
            return $result; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }
    
    // xxx
    //deveria estar na secao, aqui deveria ter um obj secao
    function recuperarSecao($idvcom)
    {
        $Secao = new Secao();
    	$result = $Secao->recuperarPorVcom($idvcom);
        if(count($result)>=1)
        {
            return $result; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }     
    
	private function recuperar($id, $whereAdd=null)
	{
	  	$sql = "SELECT * FROM vcom
                     WHERE id = $id ".$whereAdd ;
		try {
			
			$Usuario = new Usuario();
			
			foreach ($this->conexao->query($sql) as $row) {
				$resultado['id'] = $row['id'] ;
				$resultado['titulo'] = $row['titulo'] ;
				$resultado['descricao'] = $row['descricao'];
				$resultado['publico'] = $row['publico'] ;
				$resultado['idusuario'] = $row['idusuario'] ;
				$resultado['usuario'] = $Usuario->recuperarPorId($row['idusuario']);
				$resultado['secao'] = $this->recuperarSecao($row['id']);
				$resultado['data'] = $row['data'] ;
				$colecao[] = $resultado;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		}
		
		return $colecao;

	}
	
	//bak xxx
    private function recuperarbak($idusuario, $whereAdd=null)
    {
        $sql = "SELECT * FROM vcom
                     WHERE idusuario= $idusuario ".$whereAdd ;
        try {
            
            $Usuario = new Usuario();
            
            foreach ($this->conexao->query($sql) as $row) {
                $resultado['id'] = $row['id'] ;
                $resultado['titulo'] = $row['titulo'] ;
                $resultado['descricao'] = $row['descricao'];
                $resultado['publico'] = $row['publico'] ;
                $resultado['idusuario'] = $row['idusuario'] ;
                $resultado['usuario'] = $Usuario->recuperarPorId($row['idusuario']);
                $resultado['secao'] = $this->recuperarSecao($row['id']);
                $resultado['data'] = $row['data'] ;
                $colecao[] = $resultado;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
        return $colecao;

    }


}




?>
