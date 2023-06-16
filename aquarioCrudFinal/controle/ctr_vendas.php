<?php 

require_once '../modelo/vendasClasse.php';
$objVendas = new Vendas();

if(isset($_POST['insert'])) {
    $idCliente = $_POST['txtIdCliente'];
    $idFuncionario = $_POST['txtIdFuncionario'];
    $idProduto = $_POST['txtIdProduto'];
    $diaVenda = $_POST['txtDiaVenda'];
    $quantidade = $_POST['txtQuantidade'];
    if($objVendas->insert($idCliente, $idFuncionario, $idProduto, $diaVenda, $quantidade)) {
        $objVendas->redirect('../vendas.php');
    }
}

if(isset($_POST['editar'])) {
    $idCliente = $_POST['txtIdCliente'];
    $idFuncionario = $_POST['txtIdFuncionario'];
    $idProduto = $_POST['txtIdProduto'];
    $diaVenda = $_POST['txtDiaVenda'];
    $quantidade = $_POST['txtQuantidade'];
    $id = $_POST['txtId'];
    if($objVendas->editar($idCliente, $idFuncionario, $idProduto, $diaVenda, $quantidade ,$id)) {
        $objVendas->redirect('../vendas.php');
    }
}

if(isset($_POST['delete'])) {
    $id = $_POST['txtId'];
    if($objVendas->deletar($id)) {
        $objVendas->redirect('../vendas.php');
    }
}