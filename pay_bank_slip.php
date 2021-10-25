<?php
include('connect_iugu.php');

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

if(isset($_GET['id'])) {
    $id_client = $_GET['id'];
} elseif(isset($_POST['id_client'])) {
    $id_client = $_POST['id_client'];
} else {
    $id_client = 0;
}

/** obtem-se os dados do cliente */
$customer = $iugu->customers()->get([
    "id" => $id_client
]);

if(isset($_POST['id_client']) && !empty($_POST['id_client'])) {
    include('connect_iugu.php');

    $id_client = $_POST['id_client'];

    $customer = $iugu->customers()->get([
        "id" => $id_client
    ]);

    /** total de produtos selecionados */
    $total = 0;
    $array_itens = [];

    foreach($_POST['produto_price'] as $key => $value) {
        $total += $value;
        $data_prod = [
            'description' => $_POST['produto_name'][$key],
            'quantity' => 1,
            'price_cents' => $value
        ];
        array_push($array_itens, $data_prod);
    }


    /** realiza-se o pagamento por boleto */
    $invoice = $iugu->invoices()->create([
        "email" => $customer->email,
        "due_date" => date('Y-m-d'),
        "items" => $array_itens,
        "total" => (int)$total,
        "payer" => [
            "cpf_cnpj" => $customer->cpf_cnpj,
            "name" => $customer->name,
            "address" => [
                "zip_code" => $customer->zip_code,
                "number" => $customer->number
            ]
        ]
    ]);

    var_dump($invoice);
    exit;
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
            <h2>Pagar com Boleto Bancário</h2>
            <form action="pay_bank_slip.php" method="post">
                <input type="hidden" name="id_client" value="<?php echo $_GET['id']; ?>" />
                <div class="row">
                    <div class="col">Nome</div>
                    <div class="col"><?php echo $customer->name; ?></div>
                </div>
                <div class="row">
                    <div class="col">E-mail</div>
                    <div class="col"><?php echo $customer->email; ?></div>
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
                    <div class="col">Número endereço</div>
                    <div class="col"><?php echo $customer->number; ?></div>
                </div>
                <h5>Selecione os ítens que desejar comprar</h5>
            <?php foreach($itens as $key => $value) { ?>
                <div class="row">
                    <div class="col-1">
                        <input type="checkbox" name="produto_price[]" value="<?php echo $value['price_cents']; ?>" id="<?php echo "prod_" . $value['id']; ?>" />
                        <input type="hidden" name="produto_name[]" value="<?php echo $value['description']; ?>" />
                    </div>
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