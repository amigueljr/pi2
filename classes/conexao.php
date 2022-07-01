<?php
class Banco{
  
    
    private $host = "localhost"; //127.0.0.1
    // private $nome_banco = "cambui44_inspecao";
    private $nome_banco = "inspecao";
    // private $usuario = "cambui44_root";
    private $usuario = "root";
    // private $senha = "@S3gr3d0123";
    private $senha = "";
    public $conn;
  
    
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->nome_banco, $this->usuario, $this->senha);
            $this->conn->exec("set names utf8");
            // echo "Conexão bem sucedida";
        }catch(PDOException $exception){
            // echo "Erro de conexão: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}

// $conexao = new Banco();
// $conexao->getConnection();
