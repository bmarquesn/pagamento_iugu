<?php
include('connect_iugu.php');

$id_plan = $_GET['id'];

$plan = $iugu->plans()->get([
    "id" => $id_plan
]);
?>
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
                    <h2>Visualizar Assinatura</h2>
                </div>
            </div>
        <?php if(!empty($subscription)) { ?>
            <div class="row">
                <div class="col">Nome</div>
                <div class="col"><?php echo $plan->name; ?></div>
            </div>
            <div class="row">
                <div class="col">Identificador</div>
                <div class="col"><?php echo $plan->identifier; ?></div>
            </div>
            <div class="row">
                <div class="col">Intervalo</div>
                <div class="col"><?php echo $plan->interval; ?></div>
            </div>
            <div class="row">
                <div class="col">Tipo Intervalo</div>
                <div class="col"><?php echo $plan->interval_type; ?></div>
            </div>
            <div class="row">
                <div class="col">Quantidade de Ciclos</div>
                <div class="col"><?php echo $plan->max_cycles; ?></div>
            </div>
            <div class="row">
                <div class="col">Dia de Cobrança</div>
                <div class="col"><?php echo $plan->billing_days; ?></div>
            </div>
            <div class="row">
                <div class="col">Preço</div>
                <div class="col"><?php echo $plan->prices[0]->value_cents; ?></div>
            </div>
            <div class="row">
                <div class="col">Métodos pagamento</div>
                <div class="col">
                    <ul>
                        <?php
                        foreach($plan->payable_with as $key => $value) {
                            echo "<li>" . $value . "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        <?php } else { ?>
                <p><em>Não foram encontrados dados da Assinatura solicitada</em></p>
        <?php } ?>
            <p><a href="plans.php" class="btn btn-default">Voltar</a></p>
            <hr />
        </div>
        <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script type="text/javascript">

        </script>
    </body>
</html>