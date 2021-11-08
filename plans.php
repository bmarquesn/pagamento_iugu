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
                    <h2>Planos</h2>
                    <p><em>* São necessários para criar os pagamentos recorrentes</em></p>
                </div>
                <div class="col">
                    <input type="button" value="Inserir Plano" class="btn btn-primary" id="btn_inserir_plano" />
                </div>
            </div>
            <?php
            $plans = $iugu->plans()->getList();

            if($plans->totalItems === 0) {
                echo "<p>Não há planos cadastrados</p>";
            } else {
                echo "<table class=\"table table-striped table-hover\">";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Nome</th>";
                            echo "<th>Identificador</th>";
                            echo "<th>Intervalo</th>";
                            echo "<th>Tipo Intervalo</th>";
                            echo "<th>&nbsp;</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach($plans->items as $key => $value) {
                        echo "<tr>";
                            echo "<td>" . $value->name . "</td>";
                            echo "<td>" . $value->identifier . "</td>";
                            echo "<td>" . $value->interval . "</td>";
                            echo "<td>" . $value->interval_type . "</td>";
                            echo "<td><a href=\"view_plan.php?id=" . $value->id . "\"><input type=\"button\" value=\"Visualizar\" class=\"btn btn-primary\" /></a></td>";
                        echo "</tr>";
                    }

                    echo "<tbody>";
                echo "</table>";
            }
            ?>
            <p><a href="index.php" class="btn btn-secondary">Voltar</a></p>
            <hr />
        </div>
        <div class="modal fade" id="inserirPlanoModal" tabindex="-1" aria-labelledby="inserirPlanoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inserirPlanoModalLabel">Inserir Plano</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="save_plan_iugu.php" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">Nome</div>
                                <div class="col"><input type="text" name="name" value="" class="form-control" /></div>
                            </div>
                            <div class="row">
                                <div class="col-3">ID</div>
                                <div class="col"><input type="text" name="identifier" value="" class="form-control" /></div>
                            </div>
                            <div class="row">
                                <div class="col-3">Qtd. Intervalo</div>
                                <div class="col"><input type="text" name="interval" value="" class="form-control" /></div>
                            </div>
                            <div class="row">
                                <div class="col-3">Tipo Intervalo</div>
                                <div class="col">
                                    <select name="interval_type" class="form-control">
                                        <option value="weeks">Semanas</option>
                                        <option value="months">Meses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">Preço</div>
                                <div class="col"><input type="text" name="value_cents" value="" class="form-control" /></div>
                            </div>
                            <div class="row">
                                <div class="col-3">Tipos Pagamento</div>
                                <div class="col">
                                    <ul>
                                        <li><label><input type="checkbox" name="payable_with[]" value="all" /> Todos</label></li>
                                        <li><label><input type="checkbox" name="payable_with[]" value="credit_card" /> Cartão de Crédito</label></li>
                                        <li><label><input type="checkbox" name="payable_with[]" value="bank_slip" /> Boleto Bancário</label></li>
                                        <li><label><input type="checkbox" name="payable_with[]" value="pix" /> Pix</label></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">Dia de Faturamento</div>
                                <div class="col"><input type="text" name="billing_days" value="" class="form-control" /></div>
                            </div>
                            <div class="row">
                                <div class="col-3">Limite de Ciclos</div>
                                <div class="col"><input type="text" name="max_cycles" value="0" class="form-control" /></div>
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
            $('#btn_inserir_plano').on('click', function(){
                $('#inserirPlanoModal').modal();
            });
        });
        </script>
    </body>
</html>