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
                echo "<table>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Email</th>";
                            echo "<th>Nome</th>";
                            echo "<th>CPF/CNPJ</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach($customers->items as $key => $value) {
                        echo "<tr>";
                            echo "<td>" . $value->name . "</td>";
                            echo "<td>" . $value->email . "</td>";
                            echo "<td>" . $value->cpf_cnpj . "</td>";
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
                        <p>CPF/CNPJ: <input type="text" name="cpf_cnpj" value="" /></p>
                        <p>Email: <input type="text" name="email" value="" /></p>
                        <p>Nome: <input type="text" name="name" value="" /></p>
                        <p>Detalhes: <input type="text" name="notes" value="" /></p>
                        <p>DDD: <input type="text" name="phone_prefix" value="" /></p>
                        <p>Telefone: <input type="text" name="phone" value="" /></p>
                        <p>CEP: <input type="text" name="zip_code" value="" /></p>
                        <p>Endereço: <input type="text" name="street" value="" /></p>
                        <p>Número: <input type="text" name="number" value="" /></p>
                        <p>Complemento: <input type="text" name="complement" value="" /></p>
                        <p>Cidade: <input type="text" name="city" value="" /></p>
                        <p>Estado: <input type="text" name="state" value="" /></p>
                        <p>Distrito: <input type="text" name="district" value="" /></p>
                        <p><input type="submit" value="Enviar" /></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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