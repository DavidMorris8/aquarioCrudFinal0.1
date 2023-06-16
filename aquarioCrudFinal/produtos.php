<?php
require_once('./modelo/produtosClasse.php');
$objProdutos = new Produtos();
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
    <title>Produtos</title>
    <style>
        .formAlign{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <?php
    include('navegacao.php');
        ?>
    <div class="container">
        <h2 class="text-center m-3">Lista dos Produtos</h2>
        <p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Cadastrar</button>
        </p>
        <br>
        <table class="table table-striped text-center border">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM produtos";
                    $stmt = $objProdutos->runQuery($sql);
                    $stmt->execute();
                    while ($objProdutos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td>
                                <?php echo $objProdutos['id']; ?>
                            </td>
                            <td>
                                <?php echo $objProdutos['nome']; ?>
                            </td>
                            <td>
                                <?php echo $objProdutos['quantidade']; ?>
                            </td>
                            <td>
                                <?php echo $objProdutos['valor']; ?>
                            </td>
                            <td>
                                <button 
                                    type="button" class="btn btn-success" 
                                    data-toggle="modal" 
                                    data-target="#myModalEditar" 
                                    data-id="<?php echo $objProdutos['id']; ?>"
                                    data-nome="<?php echo $objProdutos['nome']; ?>"
                                    data-quantidade="<?php echo $objProdutos['quantidade']; ?>"
                                    data-valor="<?php echo $objProdutos['valor']; ?>"
                                    > Editar 
                                </button> 
                            </td>
                            <td>
                                <button 
                                    type="button" class="btn btn-danger" 
                                    data-toggle="modal" 
                                    data-target="#myModalDelete" 
                                    data-id="<?php echo $objProdutos['id']; ?>"
                                    data-nome="<?php echo $objProdutos['nome']; ?>"> Deletar 
                                </button> 
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        <!-- Modal Cadastro -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Novo Produto</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./controle/ctr_produtos.php" method="post">
                            <input type="hidden" name="insert">
                            <div class="form-group">
                                <label for="iNome">Nome:</label>
                                <input type="text" class="form-control" placeholder="Digite o nome" id="iNome" name="txtNome">
                            </div>
                            <div class="form-group">
                                <label for="iQtd">Quantidade:</label>
                                <input type="text" class="form-control" placeholder="Digite a quantidade" id="iQtd" name="txtQuantidade">
                            </div>
                            <div class="form-group">
                                <label for="iValor">Valor:</label>
                                <input type="text" class="form-control" placeholder="Digite o valor" id="iValor" name="txtValor">
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
                        <form action="./controle/ctr_produtos.php" method="post">
                            <input type="hidden" name="editar">
                            <input type="hidden" name="txtId" id="recipient-id" readonly>
                            <div class="form-group">
                                <label for="iNome">Nome:</label>
                                <input type="text" class="form-control" placeholder="Digite o nome" id="recipient-nome" name="txtNome">
                            </div>
                            <div class="form-group">
                                <label for="iQtd">Quantidade:</label>
                                <input type="text" class="form-control" placeholder="Digite a quantidade" id="recipient-quantidade" name="txtQuantidade">
                            </div>
                            <div class="form-group">
                                <label for="iValor">Valor:</label>
                                <input type="text" class="form-control" placeholder="Digite o valor" id="recipient-valor" name="txtValor">
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
                        <form action="./controle/ctr_produtos.php" method="post">
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
            var recipientNome = button.data('nome');
            var recipientQuantidade = button.data('quantidade');
            var recipientValor = button.data('valor');

            var modal = $(this);
            modal.find('#recipient-nome').val(recipientNome);
            modal.find('#recipient-quantidade').val(recipientQuantidade);
            modal.find('#recipient-valor').val(recipientValor);
            modal.find('#recipient-id').val(recipientId);
        });
    </script>
    <script>
        $('#myModalDelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientNome = button.data('nome');

            var modal = $(this);
            modal.find('#recipient-id').val(recipientId);
            modal.find('#recipient-nome').val(recipientNome);
        });
    </script>
</body>

</html>