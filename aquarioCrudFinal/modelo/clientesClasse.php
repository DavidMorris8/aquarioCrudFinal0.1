<?php 
    require_once('conexao.php');

    class Cliente{
        private $connexao;

        public function __construct(){
            $dataBase = new dataBase();
            $this->connexao = $dataBase->dbConnection();                       
        }

        public function runQuery($sql){
            $stmt = $this->connexao->prepare($sql);
            return $stmt;
        }

        public function insert($nome, $idade, $cpf){
            try{
                $sql = "INSERT INTO clientes (nome, idade, cpf) VALUES (:nome, :idade, :cpf)";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':idade', $idade);
                $stmt->bindParam(':cpf', $cpf);

                $stmt->execute();

                return $stmt;
            }catch(PDOException $e){
                echo $e -> getMessage();
            }
        }

        public function deletar($id){
            try {
                $sql = "DELETE from clientes where id = :id";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function editar($nome, $idade, $cpf, $id){
            try {
                $sql = "UPDATE clientes set nome = :nome, idade = :idade, cpf = :cpf where id = :id";

                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':idade', $idade);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function redirect($url){
            header("Location: $url");
        }

        
    }
?>