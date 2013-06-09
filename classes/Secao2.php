<?php
class Secao2
{
    function __construct() {
        $dsn = 'mysql:host=localhost;port=3306;dbname=morfeu3';
        $usuario = 'ramon';
        $senha = 'amadis';
        $opcoes = array(
           PDO::ATTR_PERSISTENT => true,
           PDO::ATTR_CASE => PDO::CASE_LOWER
        );

        try {
            $this->conexao = new PDO($dsn, $usuario, $senha, $opcoes);
        } catch (PDOException $e) {
            echo 'Erro: '.$e->getMessage();
        }
    }
    
    // Implementar Ainda
    function recuperarPorId($id)
    {
        $result = $this->recuperar("idvcom"," and id = ".$id); 
        if(count($result)==1)
        {
            return $result[0]; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }
    
    function recuperarPorVcom($idvcom)
    {
        $result = $this->recuperar($idvcom);
        if(count($result)>=1)
        {
            return $result; //retorna a primeira e unica linha da colecao
        }else{
            return false;
        }
    }
    
    private function recuperar($idvcom, $whereAdd=null)
    {
        $sql = "SELECT * FROM secao
                WHERE idvcom= $idvcom ".$whereAdd ;
        try {
            foreach ($this->conexao->query($sql) as $row) {
                $resultado['id'] = $row['id'] ;
                $resultado['titulo'] = $row['titulo'] ;
                $resultado['idvcom'] = $row['idvcom'];
                $resultado['publico'] = $row['publico'];
                $resultado['descricao'] = $row['descricao'];
                $resultado['data'] = $row['data'];
                $Container = new Container();
                $resultado['container'] =  $Container->recuperarPorSecao($row['id']);
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
