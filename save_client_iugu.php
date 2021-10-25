<?php
include('connect_iugu.php');

$customer = $iugu->customers()->create([
    "email" => $_POST['email'],
    "name" => $_POST['name'],
    "notes" => $_POST['notes'],
    "phone" => $_POST['phone'],
    "phone_prefix" => $_POST['phone_prefix'],
    "cpf_cnpj" => $_POST['cpf_cnpj'],
    "zip_code" => $_POST['zip_code'],
    "number" => $_POST['number'],
    "street" => $_POST['street'],
    "city" => $_POST['city'],
    "state" => $_POST['state'],
    "district" => $_POST['district'],
    "complement" => $_POST['complement']
    /*,"custom_variables" => [
        "key" => "value"
    ]*/
]);

if(isset($customer->id) && !empty($customer->id)) {
    echo "<script type=\"text/javascript\">alert('Cliente salvo com sucesso');";
} else {
    echo "alert('Erro ao salvar o cliente');";
}
echo "window.location.assign(\"index.php\");</script>";