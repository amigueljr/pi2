<?php

    class Evento{

        public $id;
        public $nome_arquivo;
        public $data_upload;
        public $data_evento;
        public $hora_evento;
        public $status;
        public $contagem;

        private $conexao;
        private $table_name = "inspecoes";

        public function __construct($db){
            $this->conexao = $db;
            
        }
        
        function criar(){
            
            
            
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        nome_arquivo=:nome_arquivo, data_upload=:data_upload, data_evento=:data_evento, hora_evento=:hora_evento, stat=:stat";
          
            
            $stmt = $this->conexao->prepare($query);
          
            
            $this->nome_arquivo=htmlspecialchars(strip_tags($this->nome_arquivo));
            $this->data_upload=htmlspecialchars(strip_tags($this->data_upload));
            $this->data_evento=htmlspecialchars(strip_tags($this->data_evento));
            $this->hora_evento=htmlspecialchars(strip_tags($this->hora_evento));
            $this->status=htmlspecialchars(strip_tags($this->status));
    
          
            
            if($stmt->bindParam(":nome_arquivo", $this->nome_arquivo)){
                // echo "Fez o Bind no nome_arquivo";
            }else{
                // echo "Não fez o Bind no nome_arquivo";
            }
            if($stmt->bindParam(":data_upload", $this->data_upload)){
                // echo "Fez o Bind no data_upload";
            }else{
                // echo "Não fez o Bind no data_upload";
            }
            if($stmt->bindParam(":data_evento", $this->data_evento)){
                // echo "Fez o Bind no data_evento";
            }else{
                // echo "Não fez o Bind no data_evento";
            }

            if($stmt->bindParam(":hora_evento", $this->hora_evento)){
                // echo "Fez o Bind no hora_evento";
            }else{
                // echo "Não fez o Bind no hora_evento";
            }
            
            if($stmt->bindParam(":stat", $this->status)){
                // echo "Fez o Bind no status";
            }else{
                // echo "Não fez o Bind no status";
            }
            
            
            if(!$stmt->execute()){
                $arr = $stmt->errorInfo();
                echo "ERROR SQL";
                print_r($arr);
            }
   
            // if($stmt->execute()){
            //     return true;
            //     echo "Executou o statement";
            // }else{
            //     return false; 
            //     echo "Não executou o statement";

            // }
          
            
              
        }
        function getDatasIniciais(){
            
            $query = 'SELECT DISTINCT data_evento FROM inspecoes';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            // echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            return $stmt;

        }

        function getDatasFinais(){
            
            $query = 'SELECT DISTINCT data_evento FROM inspecoes';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            // echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            return $stmt;

        }

        function consultar(){
  
            $query = "SELECT * FROM " . $this->table_name."";
          
            
            $stmt = $this->conexao->prepare($query);
          
            
            $stmt->execute();
          
            return $stmt;
        }
        function consultaVaziaEDeleta(){
  
            
            $query = " SELECT COUNT(1) FROM ".$this->table_name."";
            $stmt = $this->conexao->prepare($query);
          
            
            $stmt->execute();

            
            if($stmt->rowCount() < 1){
                $this->delete();
            }
            
            
        }

        function update(){
  
    
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        nome = :nome,
                        email = :email,
                        telefone = :telefone
                        
                    WHERE
                        id = :id";
          
            
            $stmt = $this->conexao->prepare($query);
          
            
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->usuario=htmlspecialchars(strip_tags($this->usuario));
            $this->senha=htmlspecialchars(strip_tags($this->senha));
            
             $this->id=htmlspecialchars(strip_tags($this->id));
          
            
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':telefone', $this->telefone);
            
             $stmt->bindParam(':id', $this->id);
          
            
            if($stmt->execute()){
                return true;
            }
          
            return false;
        }

        function delete(){
  
    
            $query = "DELETE FROM " . $this->table_name;
          
           
            $stmt = $this->conexao->prepare($query);
          
          
            $this->id=htmlspecialchars(strip_tags($this->id));
          
        
            $stmt->bindParam(1, $this->id);
          
            
            if($stmt->execute()){
                return true;
            }
          
            return false;
        }

    }