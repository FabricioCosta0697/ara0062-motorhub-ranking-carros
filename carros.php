<?php
// carros.php

/**
 * Busca lista de carros da API usando cURL.
 */
function fetchCarrosFromApi(string $api_url): array {
    $carros = [];
    $error = null;

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception("Erro cURL: " . curl_error($ch));
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        if ($http_code === 200) {
            if (is_array($data) && count($data) > 0 && isset($data[0]['id'])) {
                $carros = $data;

            } elseif (is_array($data) && empty($data)) {
                $error = "Nenhum carro cadastrado.";
            } else {
                $error = "Formato inesperado de dados da API.";
            }
        } else {
            $error_message = $data['message'] ?? "HTTP $http_code";
            throw new Exception("Falha ao buscar dados: " . $error_message);
        }

    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    return ['carros' => $carros, 'error' => $error];
}

$api_url = 'http://localhost/ara0062-motorhub-ranking-carros/backend/api.php?resource=carros';
$result = fetchCarrosFromApi($api_url);

$carros = $result['carros'];
$error = $result['error'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorHub - Gerenciar Carros</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<main>
    <h2>Gerenciamento de Carros</h2>
    <p>Aqui você pode cadastrar, editar ou excluir carros do ranking.</p>

    <a href="form_carro.php?action=novo">
        <button type="button" class="btn-adicionar">+ Adicionar Novo Carro</button>
    </a>

    <table border="1">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Motor</th>
                <th>Velocidade</th>
                <th>ID</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody id="tabela-carros">
        <?php if ($error): ?>
            <tr style="color: red;">
                <td colspan="7"><?= htmlspecialchars($error) ?></td>
            </tr>

        <?php elseif (!empty($carros)): ?>
            <?php foreach ($carros as $carro): ?>
                <tr>
                    <td>
                        <?php if (!empty($carro['imagem'])): ?>
                            <img src="<?= htmlspecialchars($carro['imagem']) ?>" width="70">
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars($carro['nome']) ?></td>
                    <td><?= htmlspecialchars($carro['marca']) ?></td>
                    <td><?= htmlspecialchars($carro['motor']) ?></td>
                    <td><?= htmlspecialchars($carro['velocidade']) ?></td>
                    <td><?= htmlspecialchars($carro['id']) ?></td>

                    <td>
                        <!-- Editar -->
                        <button
                            style="background-color:#d4a017; width:100%; margin-bottom:5px;"
                            onclick="window.location.href='form_carro.php?action=editar&id=<?= $carro['id'] ?>&nome=<?= urlencode($carro['nome']) ?>&marca=<?= urlencode($carro['marca']) ?>&motor=<?= urlencode($carro['motor']) ?>&velocidade=<?= urlencode($carro['velocidade']) ?>&imagem=<?= urlencode($carro['imagem']) ?>'">
                            Editar
                        </button>

                        <!-- Deletar -->
                        <button 
                            style="background-color:#b30000; width:100%;"
                            onclick="abrirConfirmacaoDelete(<?= $carro['id'] ?>)">
                            Deletar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="7">Nenhum carro encontrado.</td>
            </tr>

        <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>

<!-- ======================= -->
<!-- MODAL CONFIRMAÇÃO DELETE -->
<!-- ======================= -->

<div id="modalOverlay" style="display:none;" class="modal-motorhub-overlay">
  <div class="modal-motorhub-box">
    <p id="modalMessage"></p>

    <div id="modalButtons">
      <button id="btnModalCancel" style="display:none;" class="btn-modal-cancel">Cancelar</button>
      <button id="btnModalOK" class="btn-modal-ok">OK</button>
    </div>
  </div>
</div>

<script src="js/tema.js"></script>
<script src="js/deletar_carro.js?v=1000"></script>

</body>
</html>
