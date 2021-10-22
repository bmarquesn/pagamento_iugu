<?php
require __DIR__ . "/vendor/autoload.php";

/** insira a chave do Iugu e reomeie este arquivo tirando os 2 underlines (__) no início do nome do arquivo */
$codeIuguClient = "KEYIUGU";

$iugu = new Iugu\Client($codeIuguClient);