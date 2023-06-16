<?php 

require_once '../modelo/produtosClasse.php';
$objProdutos = new Produtos();

if(isset($_POST['insert'])) {
    $nome = $_POST['txtNome'];
    $quantidade = $_POST['txtQuantidade'];
    $valor = $_POST['txtValor'];
    if($objProdutos->insert($nome, $quantidade, $valor)) {
        $objProdutos->redirect('../produtos.php');
    }
}

if(isset($_POST['editar'])) {
    $nome = $_POST['txtNome'];
    $quantidade = $_POST['txtQuantidade'];
    $valor = $_POST['txtValor'];
    $id = $_POST['txtId'];
    if($objProdutos->editar($nome, $quantidade, $valor, $id)) {
        $objProdutos->redirect('../produtos.php');
    }
}

if(isset($_POST['delete'])) {
    $id = $_POST['txtId'];
    if($objProdutos->deletar($id)) {
        $objProdutos->redirect('../produtos.php');
    }
}