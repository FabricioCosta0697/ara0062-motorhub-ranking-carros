<?php
// api.php
// API RESTful Procedural para gerenciamento de carros com roteamento baseado em Query String.

// 1. Cabeçalhos e Configuração
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inclui o arquivo de conexão com o banco (PDO + MySQL)
include_once 'dbconfig.php';

// Trata o preflight OPTIONS (CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Inicializa a conexão PDO
$pdo = getDbConnection();

// Obtém o método HTTP e o corpo JSON
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"), true); // Para POST/PUT


// Obtém o recurso (ex: ?resource=carros)
$resource = $_GET['resource'] ?? '';

// Obtém o ID (ex: ?id=5)
$id = $_GET['id'] ?? null;

// Importa o DAO referente ao recurso
include_once 'carros_dao.php';

// Importa o roteador principal
include_once 'routes.php';
?>