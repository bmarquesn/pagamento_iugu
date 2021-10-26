<?php
include('connect_iugu.php');
/**
 * 2021-10-25
 * Olá, boa tarde
 * Estou desenvolvendo uma API em PHP de comunicação com a plataforma Iugu... já consegui fazer o pagamento por cartão de crédito e boleto... mas não consegui cadastrar um pagamento recorrente...
 * Qual a sintaxe PHP que preciso usar para fazer um pagamento recorrente?
 * O email da responsável pela conta da empresa ai na Iugu é cristina.justo@energygroup.com.br
 *  Olá, peço desculpas por manter você esperando. Seu atendimento está aguardando na fila. Deixe uma mensagem que irei responder o mais rápido possível.
 * Olá, boa tarde
 * Estou desenvolvendo uma API em PHP de comunicação com a plataforma Iugu... já consegui fazer o pagamento por cartão de crédito e boleto... mas não consegui cadastrar um pagamento recorrente...
 * Qual a sintaxe PHP que preciso usar para fazer um pagamento recorrente?
 * O email da responsável pela conta da empresa ai na Iugu é cristina.justo@energygroup.com.br
 * Cleyton S. entrou no chat
 * Cleyton S.
 * Olá Bruno Energy, boa tarde! Tudo bem?
 * Para você fazer cobranças recorrentes você precisa criar cobranças recorrentes através da chamada:  https://dev.iugu.com/reference/criar-assinatura
 * Caso queira deixar o cartão do cliente salvo para cobrar de forma automático as cobranças, só utilizar a chamada:  https://dev.iugu.com/reference/criar-forma-de-pagamento
 * Para criar assinaturas é obrigatório ter planos? Pelo que entendi é necessário ter planos para pagamentos sem ser com cartão de crédito... certo?
 * Cleyton S.
 * Qualquer cobrança recorrente é preciso criar um plano, independente qual vai ser a forma de pagamento, tanto faz se cartão, pix ou boleto, mas o plano será obrigatório criar
 */
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
                    <ul>
                        <li><a href="clients.php">Clientes</a></li>
                        <li><a href="clients.php">Pagamentos com Cartão de Crédito</a></li>
                        <li><a href="bills_generated.php">Pagamentos com Boleto</a></li>
                        <li><a href="plans.php">Planos (é necessário para usar com pagamentos recorrentes)</a></li>
                        <li><a href="subscriptions.php">Assinaturas (pagamentos recorrentes)</a></li>
                    </ul>
                </div>
            </div>
            <hr />
        </div>
        <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){});
        </script>
    </body>
</html>