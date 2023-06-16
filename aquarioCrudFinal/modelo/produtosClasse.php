<?php 

require_once 'conexao.php';

class Produtos
{
    private $connexao;

    public function __construct(){
        $dataBase = new dataBase();
        $this->connexao = $dataBase->dbConnection();                       
    }

    public function runQuery($sql){
        $stmt = $this->connexao->prepare($sql);
        return $stmt;
    }

    public function insert($nome, $quantidade, $valor){
        try{
            $sql = "INSERT INTO produtos (nome, quantidade, valor) VALUES (:nome, :quantidade, :valor)";
            $stmt = $this->connexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':valor', $valor);
            $stmt->execute();

            return $stmt;
        }catch(PDOException $e){
            echo $e -> getMessage();
        }
    }

    public function deletar($id){
        try {
            $sql = "DELETE FROM produtos WHERE id = :id";
            $stmt = $this->connexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editar($nome, $quantidade, $valor, $id){
        try {
            $sql = "UPDATE produtos SET nome = :nome, quantidade = :quantidade, valor = :valor where id = :id";

            $stmt = $this->connexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':valor', $valor);
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