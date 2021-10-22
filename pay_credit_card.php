<?php
$itens = [
    [
        'id' => 1,
        'description' => "Nome Produto 1",
        'quantity' => 1,
        'price_cents' => 1000
    ]
    , [
        'id' => 2,
        'description' => "Nome Produto 2",
        'quantity' => 1,
        'price_cents' => 2000
    ]
    , [
        'id' => 3,
        'description' => "Nome Produto 3",
        'quantity' => 1,
        'price_cents' => 3000
    ]
];

if(isset($_POST['id_client']) && !empty($_POST['id_client'])) {
    include('connect_iugu.php');

    $id_client = $_POST['id_client'];

    /** cria-se o token de cobrança */
    $token = $iugu->paymentToken()->create([
        "account_id" => $codeIuguClient,
        "customer_id" => $id_client,
        "method" => "credit_card",
        "data" => [
            "number" => $_POST['id_client'],
            "verification_value" => $_POST['id_client'],
            "first_name" => $_POST['id_client'],
            "last_name" => $_POST['id_client'],
            "month" => $_POST['id_client'],
            "year" => $_POST['id_client']
        ],
        "test" => true,
    ]);

    /** token criado, realiza-se o pagamento */
    $charge = $iugu->charges()->create([
        "token" => $token,
        "customer_id" => $id_client,
        "total" => 10000,
        "payer" => [
            "cpf_cnpj" => "84752882000",
            "name" => "João das Neves",
            "address" => [
                "zip_code" => "72917210",
                "number" => "100"
            ]
        ],
        "items" => [
            [
                "description" => "Descrição do item 1",
                "quantity" => 1,
                "price_cents" => 10000
            ]
        ]
    ]);
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
            <h2>Pagar com cartão de crédito</h2>
            <form action="pay_credit_card.php" method="post">
                <input type="hidden" name="id_client" value="<?php echo $_GET['id']; ?>" />
                <div class="row">
                    <div class="col">Número do Cartão de Crédito</div>
                    <div class="col"><input type="text" name="number" value="" class="form-control" /></div>
                </div>
                <div class="row">
                    <div class="col">Código de Verificação</div>
                    <div class="col"><input type="text" name="verification_value" value="" class="form-control" /></div>
                </div>
                <div class="row">
                    <div class="col">Nome</div>
                    <div class="col"><input type="text" name="first_name" value="" class="form-control" /></div>
                </div>
                <div class="row">
                    <div class="col">Sobrenome</div>
                    <div class="col"><input type="text" name="last_name" value="" class="form-control" /></div>
                </div>
                <div class="row">
                    <div class="col">Mês validade cartão</div>
                    <div class="col-2"><input type="text" name="month" value="" class="form-control" /></div>
                </div>
                <div class="row">
                    <div class="col">Ano validade cartão</div>
                    <div class="col-2"><input type="text" name="year" value="" class="form-control" /></div>
                </div>
                <h5>Selecione os ítens que desejar comprar</h5>
            <?php foreach($itens as $key => $value) { ?>
                <div class="row">
                    <div class="col-1"><input type="checkbox" name="produto[]" value="<?php echo $value['description']; ?>" id="<?php echo "prod_" . $value['id']; ?>" /></div>
                    <div class="col">
                        <label for="<?php echo "prod_" . $value['id']; ?>">
                            <?php
                            echo $value['description'] . "<br />Valor: R$ " . number_format($value['price_cents'], 2, ',', '.');
                            ?>
                        </label>
                    </div>
                </div>
            <?php  } ?>
            <p><input type="submit" value="Pagar" class="btn btn-primary" /></p>
            </form>
            <hr />
        </div>
        <script src="assets/js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script type="text/javascript">

        </script>
    </body>
</html>