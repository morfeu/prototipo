<?php
class Usuario extends Elemento
{

	var $conexao = null;
	var $id = null;
	var $nome = null;
	var $sobrenome = null;
	var $email = null;
	var $senha = null;
	var $data= null;

	function __construct() {

        parent::__construct();
        $this->setTabela("usuario");
	}

	function _getId(){
		return $this->id;
	}

    function _getNomeCompleto(){
        return $this->nome." ".$this->sobrenome;
    }	
	
	function _setId($id){
		$this->id = $id;
	}

    function salvar($nome,$sobrenome,$email,$senha)
    {
        $sql = "insert into usuario (nome,sobrenome,email,senha, data) VALUES ('$nome','$sobrenome','$email','$senha', now())";
        
        $lastId = $this->inserir($sql); //retorna o ultimo id inserido em caso de sucesso, senao return false

        if($lastId != false)
        {
            return $lastId;
        }
        return false;
    }	

	function validaUsuario($email,$senha)
	{
		$result = $this->recuperar($email,$senha);
		if(count($result)==1)
		{
			return true;
		}else{
			return false;
		}
	}

    function recuperarUsuario($email,$senha)
    {
        $result = $this->recuperar($email,$senha);
        if(count($result)==1)
        {
            return $result[0]; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }

    function recuperarPorId($id)
    {
        $result = $this->recuperar('email','senha',$id);
        if(count($result)==1)
        {
            return $result[0]; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }    
    
	private function recuperar($email,$senha = "senha",$id = 0 ,$whereAdd=null)
	{
		$sql = "SELECT * FROM usuario
		        WHERE
		        (id = $id) or 
		        ( email = '$email' and senha = '$senha' )         ".$whereAdd ;

		try {
			foreach ($this->conexao->query($sql) as $row) {
				$this->id = $usuario['id'] = $row['id'] ;
				$this->nome =  $usuario['nome'] = $row['nome'] ;
				$this->sobrenome = $usuario['sobrenome'] = $row['sobrenome'];
				$this->nomeCompleto = $usuario['nomeCompleto'] = $row['nome']." ".$row['sobrenome'];
				$this->email = $usuario['email'] = $row['email'] ;
				$this->senha = $usuario['senha'] = $row['senha'] ;
				$this->data = $usuario['data'] = $row['data'] ;
				
				$colecao[] = $usuario;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		}
		return $colecao;

	}


}