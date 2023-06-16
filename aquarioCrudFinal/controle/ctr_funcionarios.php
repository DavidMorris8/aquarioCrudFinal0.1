<?php

require_once '../modelo/funcionariosClasse.php';
$objFuncionarios = new Funcionarios();

if (isset($_POST['insert'])) {
    $nome = $_POST['txtNome'];
    $idade = $_POST['txtIdade'];
    $cpf = $_POST['txtCpf'];
    if($objFuncionarios->insert($nome, $idade, $cpf)){
        $objFuncionarios->redirect('../funcionarios.php');
    }
}
if(isset($_POST['editar'])) {
    $nome = $_POST['txtNome'];
    $idade = $_POST['txtIdade'];
    $cpf = $_POST['txtCpf'];
    $id = $_POST['txtId'];
    if($objFuncionarios->editar($nome, $idade, $cpf,$id)){
        $objFuncionarios->redirect('../funcionarios.php');
    }
}

if(isset($_POST['delete'])) {
    $id = $_POST['txtId'];
    if($objFuncionarios->deletar($id)){
        $objFuncionarios->redirect('../funcionarios.php');
    }
}

?>