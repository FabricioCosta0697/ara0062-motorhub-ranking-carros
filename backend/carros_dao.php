<?php
// carros_dao.php
// Funções CRUD completas para o recurso 'carros'


/**
 * READ – Todos os carros
 */
function readAllCarros($pdo) {
    $sql = "SELECT * FROM carros ORDER BY id DESC";

    try {
        $stmt = $pdo->query($sql);
        $carros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        return $carros ?: [];

    } catch (PDOException $e) {
        http_response_code(503);
        return ["message" => "Erro ao buscar carros: " . $e->getMessage()];
    }
}



/**
 * READ – Buscar carro por ID
 */
function readCarroById($pdo, $id) {
    $sql = "SELECT * FROM carros WHERE id = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $carro = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($carro) {
            http_response_code(200);
            return $carro;
        } else {
            http_response_code(404);
            return ["message" => "Carro não encontrado."];
        }

    } catch (PDOException $e) {
        http_response_code(503);
        return ["message" => "Erro ao buscar carro: " . $e->getMessage()];
    }
}



/**
 * READ – 5 mais rápidos (maior → menor)
 */
function readCarrosRapidos($pdo) {
    $sql = "SELECT * FROM carros 
            ORDER BY 
                CAST(REPLACE(REPLACE(velocidade, ' km/h', ''), ',', '.') AS DECIMAL(10,2)) DESC 
            LIMIT 5";

    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        http_response_code(503);
        return ["message" => "Erro ao buscar carros rápidos: " . $e->getMessage()];
    }
}



/**
 * READ – 5 mais lentos (maior → menor, como você pediu)
 */
function readCarrosLentos($pdo) {
    // Pega os 5 menores valores de velocidade
    $sql = "SELECT * FROM carros 
            ORDER BY 
                CAST(REPLACE(REPLACE(velocidade, ' km/h', ''), ',', '.') AS DECIMAL(10,2)) ASC 
            LIMIT 5";

    try {
        $stmt = $pdo->query($sql);
        $carros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agora reordena do maior para o menor conforme solicitado
        usort($carros, function($a, $b) {
            $velA = floatval(str_replace([' km/h', ','], ['', '.'], $a['velocidade']));
            $velB = floatval(str_replace([' km/h', ','], ['', '.'], $b['velocidade']));
            return $velB <=> $velA; // maior → menor
        });

        return $carros ?: [];

    } catch (PDOException $e) {
        http_response_code(503);
        return ["message" => "Erro ao buscar carros lentos: " . $e->getMessage()];
    }
}



/**
 * CREATE – Inserir carro
 */
function createCarro($pdo, $data) {

    if (
        empty($data['nome']) ||
        empty($data['marca']) ||
        empty($data['motor']) ||
        empty($data['velocidade']) ||
        empty($data['imagem'])
    ) {
        http_response_code(400);
        return ["message" => "Dados incompletos. Todos os campos são obrigatórios."];
    }

    $sql = "INSERT INTO carros (nome, marca, motor, velocidade, imagem)
            VALUES (?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['nome'],
            $data['marca'],
            $data['motor'],
            $data['velocidade'],
            $data['imagem']
        ]);

        $newId = $pdo->lastInsertId();

        http_response_code(201);
        return [
            "message" => "Carro criado com sucesso.",
            "id" => $newId
        ];

    } catch (PDOException $e) {
        http_response_code(503);
        return ["message" => "Erro ao criar carro: " . $e->getMessage()];
    }
}



/**
 * UPDATE – Atualizar carro
 */
function updateCarro($pdo, $id, $data) {

    if (!$id) {
        http_response_code(400);
        return ["message" => "ID do carro é obrigatório para atualização."];
    }

    if (
        empty($data['nome']) ||
        empty($data['marca']) ||
        empty($data['motor']) ||
        empty($data['velocidade']) ||
        empty($data['imagem'])
    ) {
        http_response_code(400);
        return ["message" => "Dados incompletos. Todos os campos são obrigatórios."];
    }

    $sql = "UPDATE carros 
            SET nome = ?, marca = ?, motor = ?, velocidade = ?, imagem = ?
            WHERE id = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['nome'],
            $data['marca'],
            $data['motor'],
            $data['velocidade'],
            $data['imagem'],
            $id
        ]);

        if ($stmt->rowCount() > 0) {
            http_response_code(200);
            return ["message" => "Carro atualizado com sucesso."];
        } else {
            http_response_code(404);
            return ["message" => "Carro não encontrado ou nenhum dado alterado."];
        }

    } catch (PDOException $e) {
        http_response_code(503);
        return ["message" => "Erro ao atualizar carro: " . $e->getMessage()];
    }
}



/**
 * DELETE – Remover carro
 */
function deleteCarro($pdo, $id) {

    if (!$id) {
        http_response_code(400);
        return ["message" => "ID do carro é obrigatório para exclusão."];
    }

    $sql = "DELETE FROM carros WHERE id = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            http_response_code(200);
            return ["message" => "Carro excluído com sucesso."];
        } else {
            http_response_code(404);
            return ["message" => "Carro não encontrado."];
        }

    } catch (PDOException $e) {
        http_response_code(503);
        return ["message" => "Erro ao excluir carro: " . $e->getMessage()];
    }
}

?>
