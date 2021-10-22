<?php include('connect_iugu.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <title>Exemplo Loja Iugu</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container-fluid">
            <h1>Exemplos Consultas Iugu</h1>
            <div class="row">
                <div class="col">
                    <h2>Listando Clientes</h2>
                </div>
                <div class="col">
                    <input type="button" value="Inserir Cliente" class="btn btn-primary" id="btn_inserir_cliente" />
                </div>
            </div>
            <?php
            $customers = $iugu->customers()->getList();

            if($customers->totalItems === 0) {
                echo "<p>Não há clientes cadastrados</p>";
            } else {
                echo "<table class=\"table table-striped table-hover\">";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Email</th>";
                            echo "<th>Nome</th>";
                            echo "<th>CPF/CNPJ</th>";
                            echo "<th colspan=\"3\">Ações</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach($customers->items as $key => $value) {
                        echo "<tr>";
                            echo "<td>" . $value->name . "</td>";
                            echo "<td>" . $value->email . "</td>";
                            echo "<td>" . $value->cpf_cnpj . "</td>";
                            echo "<td><a href=\"view_client.php?id=" . $value->id . "\"><input type=\"button\" value=\"Visualizar\" class=\"btn btn-primary\" /></a></td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                        echo "</tr>";
                    }

                    echo "<tbody>";
                echo "</table>";
            }
            ?>
            <hr />
        </div>
        <div class="modal fade" id="inserirClienteModal" tabindex="-1" aria-labelledby="inserirClienteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inserirClienteModalLabel">Inserir Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="save_client_iugu.php" method="post">
                        <div class="row">
                            <div class="col-3">CPF/CNPJ</div>
                            <div class="col"><input type="text" name="cpf_cnpj" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Email</div>
                            <div class="col"><input type="text" name="email" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Nome</div>
                            <div class="col"><input type="text" name="name" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Detalhes</div>
                            <div class="col"><input type="text" name="notes" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">DDD</div>
                            <div class="col"><input type="text" name="phone_prefix" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Telefone</div>
                            <div class="col"><input type="text" name="phone" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">CEP</div>
                            <div class="col"><input type="text" name="zip_code" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Endereço</div>
                            <div class="col"><input type="text" name="street" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Número</div>
                            <div class="col"><input type="text" name="number" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Complemento</div>
                            <div class="col"><input type="text" name="complement" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Cidade</div>
                            <div class="col"><input type="text" name="city" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Estado</div>
                            <div class="col"><input type="text" name="state" value="" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-3">Distrito</div>
                            <div class="col"><input type="text" name="district" value="" class="form-control" /></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){
            $('#btn_inserir_cliente').on('click', function(){
                $('#inserirClienteModal').modal();
            });
        });
        </script>
    </body>
</html>