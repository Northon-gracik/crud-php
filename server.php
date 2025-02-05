<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/controller/PessoaController.php';
require_once __DIR__ . '/controller/TelefoneController.php';

$pessoaController = new PessoaController();
$telefoneController = new TelefoneController();

$pessoaController->handleRequest();
$telefoneController->handleRequest();
