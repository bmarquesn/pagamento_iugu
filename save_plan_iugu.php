<?php
include('connect_iugu.php');

$plan = $iugu->plans()->create([
    "name" => $_POST['name'],
    "identifier" => $_POST['identifier'],
    "interval" => $_POST['interval'],
    "interval_type" => $_POST['interval_type'],
    "value_cents" => $_POST['value_cents'],
    "payable_with" => $_POST['payable_with'],
    "billing_days" => $_POST['billing_days'],
    "max_cycles" => $_POST['max_cycles']
]);

if(isset($plan->id) && !empty($plan->id)) {
    echo "<script type=\"text/javascript\">alert('Plano salvo com sucesso');";
} else {
    echo "alert('Erro ao salvar o plano');";
}
echo "window.location.assign(\"plans.php\");</script>";