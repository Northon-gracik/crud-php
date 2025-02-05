<?php
require_once __DIR__ . '/../service/TelefoneService.php';
class TelefoneController
{
    private $telefoneService;

    public function __construct()
    {
        $this->telefoneService = new TelefoneService();
    }

    public function handleRequest()
    {
        header("Content-Type: application/json");
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (strpos($uri, '/telefones') === false) {
            return;
        }
        switch ($method) {
            case 'GET':
                if (isset($_GET['id'])) {
                    echo json_encode($this->telefoneService->getById($_GET['id']));
                } elseif (isset($_GET['pessoa_id'])) {
                    echo json_encode($this->telefoneService->getByPessoaId($_GET['pessoa_id']));
                } else {
                    echo json_encode($this->telefoneService->getAll());
                }
                break;

            case 'POST':

                $data = $_POST;
                if (isset($_GET['id'])) {
                    echo json_encode($this->telefoneService->update($data, $_GET['id']));
                } else {
                    echo json_encode($this->telefoneService->create($data));
                }
                break;


            case 'DELETE':
                if (isset($_GET['id'])) {
                    echo json_encode($this->telefoneService->delete($_GET['id']));
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

