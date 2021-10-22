<?php
include('connect_iugu.php');

$id_cliente = $_GET['id'];

$customer = $iugu->customers()->get([
    "id" => $id_cliente
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
                    <h2>Visualizar Cliente</h2>
                </div>
            </div>
        <?php if(!empty($customer)) { ?>
            <div class="row">
                <div class="col">Nome</div>
                <div class="col"><?php echo $customer->name; ?></div>
            </div>
            <div class="row">
                <div class="col">E-mail</div>
                <div class="col"><?php echo $customer->email; ?></div>
            </div>
            <div class="row">
                <div class="col">Detalhes</div>
                <div class="col"><?php echo $customer->notes; ?></div>
            </div>
            <div class="row">
                <div class="col">Criado em</div>
                <div class="col"><?php echo date('d/m/Y H:i:s', strtotime($customer->created_at)); ?></div>
            </div>
            <div class="row">
                <div class="col">Última alteração</div>
                <div class="col"><?php echo date('d/m/Y H:i:s', strtotime($customer->updated_at)); ?></div>
            </div>
            <div class="row">
                <div class="col">E-mails vinculados</div>
                <div class="col"><?php echo $customer->cc_emails; ?></div>
            </div>
            <div class="row">
                <div class="col">CPF / CNPJ</div>
                <div class="col"><?php echo $customer->cpf_cnpj; ?></div>
            </div>
            <div class="row">
                <div class="col">CEP</div>
                <div class="col"><?php echo $customer->zip_code; ?></div>
            </div>
            <div class="row">
                <div class="col">Endereço</div>
                <div class="col"><?php echo $customer->street; ?></div>
            </div>
            <div class="row">
                <div class="col">Número</div>
                <div class="col"><?php echo $customer->number; ?></div>
            </div>
            <div class="row">
                <div class="col">Complemento</div>
                <div class="col"><?php echo $customer->complement; ?></div>
            </div>
            <div class="row">
                <div class="col">Bairro</div>
                <div class="col"><?php echo $customer->district; ?></div>
            </div>
            <div class="row">
                <div class="col">Cidade</div>
                <div class="col"><?php echo $customer->city; ?></div>
            </div>
            <div class="row">
                <div class="col">UF</div>
                <div class="col"><?php echo $customer->state; ?></div>
            </div>
            <div class="row">
                <div class="col">Telefone</div>
                <div class="col"><?php echo $customer->phone_prefix . ' ' . $customer->phone; ?></div>
            </div>
            <div class="row">
                <div class="col">Método de Pagamento Padrão</div>
                <div class="col"><?php echo $customer->default_payment_method_id; ?></div>
            </div>
            <div class="row">
                <div class="col">IPs pagamentos realizados</div>
                <div class="col"><?php echo $customer->proxy_payments_from_customer_id; ?></div>
            </div>
            <div class="row">
                <div class="col">Variáveis customizadas</div>
                <div class="col"><?php !empty($customer->custom_variables)?print_r($customer->custom_variables):''; ?></div>
            </div>
            <div class="row">
                <div class="col">Métodos de pagamento</div>
                <div class="col"><?php !empty($customer->payment_methods)?print_r($customer->payment_methods):''; ?></div>
            </div>
        <?php } else { ?>
                <p><em>Não foram encontrados dados do cliente solicitado</em></p>
        <?php } ?>
            <p><a href="index.php" class="btn btn-default">Voltar</a></p>
            <hr />
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