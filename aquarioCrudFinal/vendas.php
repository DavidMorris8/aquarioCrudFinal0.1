<?php
require_once('./modelo/vendasClasse.php');
$objVendas = new Vendas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Vendas</title>
</head>

<body>
    <?php
    include('navegacao.php')
        ?>
    <div class="container">
        <h2 class="text-center m-3">Lista das Vendas</h2>
        <p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Cadastrar</button>
        </p>
        <br>
        <table class="table table-striped text-center border">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nome do Cliente</th>
                    <th class="text-center">Nome do Funcionário</th>
                    <th class="text-center">Nome do Produto</th>
                    <th class="text-center">Data da Venda</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    $sql = "SELECT v.id, cli.nome as 'idCliente', pro.nome as 'idProduto', func.nome as 'idFuncionario', v.diaVenda, v.quantidade FROM vendas v 
                    INNER JOIN clientes cli ON cli.id = v.idCliente 
                    INNER JOIN funcionarios func ON func.id = v.idFuncionario
                    INNER JOIN produtos pro ON pro.id = v.idProduto";
                    $stmt = $objVendas->runQuery($sql);
                    $stmt->execute();
                    while ($objVendas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td>
                                <?php echo $objVendas['id']; ?>
                            </td>
                            <td>
                                <?php echo $objVendas['idCliente']; ?>
                            </td>
                            <td>
                                <?php echo $objVendas['idFuncionario']; ?>
                            </td>
                            <td>
                                <?php echo $objVendas['idProduto']; ?>
                            </td>
                            <td>
                                <?php echo $objVendas['diaVenda']; ?>
                            </td>
                            <td>
                                <?php echo $objVendas['quantidade']; ?>
                            </td>
                            <td>
                                <button 
                                    
                                    type="button" class="btn btn-success" 
                                    data-toggle="modal" 
                                    data-target="#myModalEditar" 
                                    data-id="<?php echo $objVendas['id']; ?>"
                                    data-idCliente="<?php echo $objVendas['idCliente']; ?>"
                                    data-idFuncionario="<?php echo $objVendas['idFuncionario']; ?>"
                                    data-idProduto="<?php echo $objVendas['idProduto']; ?>"
                                    data-diaVenda="<?php echo $objVendas['diaVenda']; ?>"
                                    data-quantidade="<?php echo $objVendas['quantidade']; ?>"
                                    > Editar 
                                </button> 
                            </td>
                            <td>
                                <button 
                                    type="button" class="btn btn-danger" 
                                    data-toggle="modal" 
                                    data-target="#myModalDelete" 
                                    data-id="<?php echo $objVendas['id']; ?>"
                                    data-idCliente="<?php echo $objVendas['idCliente']; ?>"
                                    data-idFuncionario="<?php echo $objVendas['idFuncionario']; ?>"
                                    data-idProduto="<?php echo $objVendas['idProduto']; ?>"
                                    data-diaVenda="<?php echo $objVendas['diaVenda']; ?>"
                                    data-quantidade="<?php echo $objVendas['quantidade']; ?>"
                                    > Deletar 
                                </button> 
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        <div class="modal" id="myModal">
            <!-- Modal Cadastro -->
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Nova Venda</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./controle/ctr_vendas.php" method="post">
                            <input type="hidden" name="insert">                           
                            <div class="form-group">
                                <label for="idCliente">ID do Cliente:</label>
                                <input type="number" class="form-control" placeholder="Digite o ID do cliente" id="idCliente" name="txtIdCliente">
                            </div>
                            <div class="form-group">
                                <label for="idFuncionario">ID do Funcionário:</label>
                                <input type="number" class="form-control" placeholder="Digite o ID do funcionario" id="idFuncionario" name="txtIdFuncionario">
                            </div>
                            <div class="form-group">
                                <label for="idProduto">ID do Produto:</label>
                                <input type="number" class="form-control" placeholder="Digite o ID do produto" id="idProduto" name="txtIdProduto">
                            </div>
                            <div class="form-group">
                                <label for="diaVenda">Data da Venda:</label>
                                <input type="date" class="form-control" placeholder="Digite a data da venda" id="diaVenda" name="txtDiaVenda">
                            </div>
                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input type="text" class="form-control" placeholder="Digite a quantidade" id="quantidade" name="txtQuantidade">
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>

                </div>
            </div>
        </div>

         <!-- Modal Editar -->
         <div class="modal" id="myModalEditar">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Editar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./controle/ctr_vendas.php" method="post">
                            <input type="hidden" name="editar">
                            <input type="hidden" name="txtId" id="recipient-id" readonly>
                            <div class="form-group">
                                <label for="idCliente">ID do cliente:</label>
                                <input type="number" class="form-control" placeholder="Digite o ID do cliente" id="recipient-idCliente" name="txtIdCliente">
                            </div>
                            <div class="form-group">
                                <label for="idFuncionario">ID do Funcionário:</label>
                                <input type="number" class="form-control" placeholder="Digite o ID do funcionario" id="recipient-idFuncionario" name="txtIdFuncionario">
                            </div>
                            <div class="form-group">
                                <label for="idProduto">ID do produto:</label>
                                <input type="number" class="form-control" placeholder="Digite ID do produto" id="recipient-idProduto" name="txtIdProduto">
                            </div>
                            <div class="form-group">
                                <label for="diaVenda">Data da venda:</label>
                                <input type="date" class="form-control" placeholder="Digite a data da venda" id="recipient-diaVenda" name="txtDiaVenda">
                            </div>
                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input type="text" class="form-control" placeholder="Digite a quantidade" id="recipient-quantidade" name="txtQuantidade">
                            </div>
                            <div class="formAlign">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal" id="myModalDelete">
            <!-- Modal Delete -->
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Deletar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./controle/ctr_vendas.php" method="post">
                            <input type="hidden" name="delete">
                            <input type="hidden" name="txtId" id="recipient-id" readonly>
                            <div class="form-group">
                                <label for="nome">Deseja deletar?</label>
                                

                            </div>
                            <button type="submit" class="btn btn-primary">Deletar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $('#myModalEditar').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientIdCliente = button.data('idCliente');
            var recipientIdFuncionario = button.data('idFuncionario');
            var recipientIdProduto = button.data('idProduto');
            var recipientDiaVenda = button.data('diaVenda');
            var recipientQtd = button.data('quantidade');

            var modal = $(this);
            modal.find('#recipient-idCliente').val(recipientIdCliente);
            modal.find('#recipient-idFuncionario').val(recipientIdFuncionario);
            modal.find('#recipient-idProduto').val(recipientIdProduto);
            modal.find('#recipient-diaVenda').val(recipientDiaVenda);
            modal.find('#recipient-quantidade').val(recipientQtd);
            modal.find('#recipient-id').val(recipientId);
        });
    </script>
    <script>
        $('#myModalDelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientNome = button.data('nome');
            var recipientIdCliente = button.data('idCliente');
            var recipientIdFuncionario = button.data('idFuncionario');
            var recipientIdProduto = button.data('idProduto');

            var modal = $(this);
            modal.find('#recipient-id').val(recipientId);
            modal.find('#recipient-idCliente').val(recipientIdCliente);
            modal.find('#recipient-idFuncionario').val(recipientIdFuncionario);
            modal.find('#recipient-idProduto').val(recipientIdProduto);
        });
    </script>
</body>

</html>