<?php

$response = [];

// Garante que o recurso solicitado é "carros"
if ($resource !== 'carros') {
    http_response_code(404);
    echo json_encode(["message" => "Recurso não encontrado. Use ?resource=carros"]);
    exit;
}

// Parâmetro opcional para listas especiais
$tipo = $_GET['tipo'] ?? null;

// Roteamento principal baseado no método HTTP
switch ($method) {

    // -----------------------------------------------------------
    // GET  →  Listar carros
    // -----------------------------------------------------------
    case 'GET':

        if ($tipo === 'rapidos') {
            $response = readCarrosRapidos($pdo);

        } elseif ($tipo === 'lentos') {
            $response = readCarrosLentos($pdo);

        } elseif ($id) {
            // GET /carros?id=5
            $response = readCarroById($pdo, $id);

        } else {
            // GET /carros
            $response = readAllCarros($pdo);
        }
        break;


    // -----------------------------------------------------------
    // POST → Criar carro
    // -----------------------------------------------------------
    case 'POST':
        if ($id) {
            http_response_code(405);
            $response = ["message" => "POST não deve incluir ID. Use apenas ?resource=carros"];
        } else {
            $response = createCarro($pdo, $data);
        }
        break;


    // -----------------------------------------------------------
    // PUT → Atualizar carro
    // -----------------------------------------------------------
    case 'PUT':
        if (!$id) {
            http_response_code(400);
            $response = ["message" => "ID obrigatório no método PUT"];
        } else {
            $response = updateCarro($pdo, $id, $data);
        }
        break;


    // -----------------------------------------------------------
    // DELETE → Excluir carro
    // -----------------------------------------------------------
    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            $response = ["message" => "ID obrigatório no método DELETE"];
        } else {
            $response = deleteCarro($pdo, $id);
        }
        break;


    // -----------------------------------------------------------
    // MÉTODO NÃO SUPORTADO
    // -----------------------------------------------------------
    default:
        http_response_code(405);
        $response = ["message" => "Método não permitido para este recurso."];
}

echo json_encode($response);
