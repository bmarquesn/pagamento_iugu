<?php
include('connect_iugu.php');

$plan_identifier = $iugu->plans()->get([
    "id" => $_POST['plan_identifier']
]);

/*var_dump(
    $_POST,
    date('Y-m-d', strtotime($_POST['expires_at'])),
    $plan_identifier->identifier
);
die;*/

/** artentar que o payable_with tem que ser exatamente como do plano selecionado */

$subscriptions = $iugu->subscriptions()->create([
    "credits_based" => false,
    "plan_identifier" => $plan_identifier->identifier,
    "customer_id" => $_POST['customer_id'],
    "payable_with" => $_POST['payable_with'],
    "expires_at" => date('Y-m-d', strtotime($_POST['expires_at'])),
    "ignore_due_email" => true,
    "price_cents" => 1000,
    "only_on_charge_success" => false,
    "two_step" => false,
    "suspend_on_invoice_expired" => true,
    "only_charge_on_due_date" => true,
    "subitems" => [
        [
            "description" => "subitem1",
            "price_cents" => 100,
            "quantity" => 1
        ]
    ],
    "test"  => true
]);
//var_dump($subscriptions);die;

if(isset($subscriptions->id) && !empty($subscriptions->id)) {
    echo "<script type=\"text/javascript\">alert('Assinatura salva com sucesso');";
} else {
    echo "alert('Erro ao salvar a Assinatura');";
}
echo "window.location.assign(\"subscriptions.php\");</script>";