<?php

require_once '../modelo/clientesClasse.php';
$objCliente = new Cliente();

if (isset($_POST['insert'])) {
    $nome = $_POST['txtNome'];
    $idade = $_POST['txtIdade'];
    $cpf = $_POST['txtCpf'];
    if($objCliente->insert($nome, $idade, $cpf)){
        $objCliente->redirect('../clientes.php');
    }
}

if(isset($_POST['editar'])) {
    $nome = $_POST['txtNome'];
    $idade = $_POST['txtIdade'];
    $cpf = $_POST['txtCpf'];
    $id = $_POST['txtId'];
    if($objCliente->editar($nome, $idade, $cpf,$id)){
        $objCliente->redirect('../clientes.php');
    }
}

if(isset($_POST['delete'])) {
    $id = $_POST['txtId'];
    if($objCliente->deletar($id)){
        $objCliente->redirect('../clientes.php');
    }
}

?>