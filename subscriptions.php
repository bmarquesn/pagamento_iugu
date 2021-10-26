<?php
include('connect_iugu.php');

if(isset($_GET['id_plan']) && !empty($_GET['id_plan'])) {
    $id_plan = $_GET['id_plan'];

    $plan = $iugu->plans()->get([
        "id" => $id_plan
    ]);

    echo json_encode($plan);
    exit;
} else {
    /** toda a assinatura, conforme instrução do suporte Iugu ('Qualquer cobrança recorrente é preciso criar um plano'), deverá ter um Plano */
    $plans = $iugu->plans()->getList();
    $customers = $iugu->customers()->getList();
}
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
                    <h2>Assinaturas</h2>
                </div>
                <div class="col">
                    <input type="button" value="Inserir Assinatura" class="btn btn-primary" id="btn_inserir_assinatura" />
                </div>
            </div>
            <div class="row">
                <div class="col"><p><em>Pagamentos recorrentes</em></p>
                    <p>O valor e alguns dados que compõe a Assinatura serão compostos pelos dados do Plano desta Assinatura</p></div>
            </div>
            <?php
            $subscriptions = $iugu->subscriptions()->getList();
            //var_dump($subscriptions);die;

            if($subscriptions->totalItems === 0) {
                echo "<p>Não há assinaturas (pagamentos recorrentes) cadastradas</p>";
            } else {
                echo "<table class=\"table table-striped table-hover\">";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Identificador do Plano</th>";
                            echo "<th>Preço</th>";
                            echo "<th>Expira em</th>";
                            echo "<th>Nome Cliente</th>";
                            echo "<th>Meios Pagamento</th>";
                            echo "<th>&nbsp;</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach($subscriptions->items as $key => $value) {
                        echo "<tr>";
                            echo "<td>" . $value->plan_identifier . "</td>";
                            echo "<td>" . $value->price_cents . "</td>";
                            echo "<td>" . $value->expires_at . "</td>";
                            echo "<td>" . $value->customer_name . "</td>";
                            echo "<td>";
                                foreach($value->payable_with as $key2 => $value2) {
                                    echo $value2 . "<br />";
                                }
                            echo "</td>";
                            echo "<td><a href=\"view_subscription.php?id=" . $value->id . "\"><input type=\"button\" value=\"Visualizar\" class=\"btn btn-primary\" /></a></td>";
                        echo "</tr>";
                    }

                    echo "<tbody>";
                echo "</table>";
            }
            ?>
            <p><a href="index.php" class="btn btn-secondary">Voltar</a></p>
            <hr />
        </div>
        <div class="modal fade" id="inserirSubscriptionModal" tabindex="-1" aria-labelledby="inserirSubscriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inserirSubscriptionModalLabel">Inserir Assinatura (pagamento recorrente)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="save_subscription_iugu.php" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">Plano</div>
                                <div class="col">
                                    <select name="plan_identifier" class="form-control">
                                        <option value="">Selecione</option>
                                        <?php
                                        if($plans->totalItems > 0) {
                                            foreach($plans->items As $key => $value) {
                                                echo '<option value="' . $value->id . '">' . $value->identifier . ' - ' . $value->name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">Cliente</div>
                                <div class="col">
                                    <select name="customer_id" class="form-control">
                                        <option value="">Selecione</option>
                                        <?php
                                        if($customers->totalItems > 0) {
                                            foreach($customers->items As $key => $value) {
                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">Pagar com</div>
                                <div class="col">
                                    <select name="payable_with[]" class="form-control" multiple="multiple">
                                        <option value="">Selecione</option>
                                        <option value="all">Todas as formas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">Data Expiração</div>
                                <div class="col"><input type="text" name="expires_at" value="01/01/2025" class="form-control" /></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <input type="submit" value="Salvar" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){
            $('#btn_inserir_assinatura').on('click', function(){
                $('#inserirSubscriptionModal').modal();
            });
            $('select[name="plan_identifier"]').on('change', function(){
                var id_plan = $(this).val();
                $.ajax({
                    type: 'GET',
                    data: {
                        id_plan:id_plan
                    },
                    url: 'subscriptions.php',
                    cache: 'false',
                    dataType: 'json',
                    beforeSend: function(){
                        $('select[name="payable_with[]"]').attr('disabled', 'disabled');
                    },
                    complete:function(response){
                        var optionsPayableWithPlan = '<option value="">Selecione</option><option value="all">Todas as formas</option>';
                        if(response.status == 200) {
                            $('select[name="payable_with[]"]').find('option').remove();
                            var retorno = response.responseJSON;
                            if(retorno != undefined) {
                                $.each(retorno.payable_with, function(index, element){
                                    optionsPayableWithPlan += '<option value="'+element+'">'+element+'</option>';
                                });
                            }
                        }
                        $('select[name="payable_with[]"]').append(optionsPayableWithPlan);
                        $('select[name="payable_with[]"]').removeAttr('disabled');
                    }
                });
            });
        });
        </script>
    </body>
</html>