<?php
require_once __DIR__ . '/../service/PessoaService.php';
class PessoaController
{
    private $pessoaService;
    public function __construct()
    {
        $this->pessoaService = new PessoaService();
    }
    public function handleRequest()
    {
        header("Content-Type: application/json");
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (strpos($uri, '/pessoas') === false) {
            return;
        }

        switch ($method) {
            case 'GET':
                if (isset($_GET['id'])) {
                    echo json_encode($this->pessoaService->getById($_GET['id']));
                } else {
                    echo json_encode($this->pessoaService->getAll());
                }
                break;

            case 'POST':
                $data = $_POST;
                if (isset($_GET['id'])) {
                    echo json_encode($this->pessoaService->update($data, $_GET['id']));
                } else {
                    echo json_encode($this->pessoaService->create($data));
                }
                break;
            case 'DELETE':
                if (isset($_GET['id'])) {
                    echo json_encode($this->pessoaService->delete($_GET['id']));
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "ID é obrigatório para excluir"]);
                }
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Método não permitido"]);
        }
    }
}



