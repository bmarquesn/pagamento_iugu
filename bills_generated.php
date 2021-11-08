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
                    <h2>Boletos Gerados</h2>
                </div>
            </div>
            <?php
            $invoices = $iugu->invoices()->getList();

            if($invoices->totalItems === 0) {
                echo "<p>Não há boletos cadastrados</p>";
            } else {
                echo "<table class=\"table table-striped table-hover\">";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Email</th>";
                            echo "<th>Nome</th>";
                            echo "<th>CPF/CNPJ</th>";
                            echo "<th>Boleto</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach($invoices->items as $key => $value) {
                        echo "<tr>";
                            echo "<td>" . $value->email . "</td>";
                            echo "<td>" . $value->payer_name . "</td>";
                            echo "<td>" . $value->payer_cpf_cnpj . "</td>";
                            echo "<td><a href=\"" . $value->secure_url . "\" target=\"_blank\"><input type=\"button\" value=\"Visualizar\" class=\"btn btn-primary\" /></a></td>";
                        echo "</tr>";
                    }

                    echo "<tbody>";
                echo "</table>";
            }
            ?>
            <p><a href="index.php" class="btn btn-secondary">Voltar</a></p>
            <hr />
        </div>
        <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){

        });
        </script>
    </body>
</html>