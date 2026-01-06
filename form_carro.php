<?php
// form_carro.php

$action = $_GET['action'] ?? 'novo';
$id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MotorHub - Cadastro de Carros</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<main>
    <h2><?= $action == 'editar' ? 'Editar Carro' : 'Cadastrar Novo Carro' ?></h2>

    <form id="form_carro">

        <label for="imagem">Imagem (URL ou caminho)</label>
        <input type="text" id="imagem"
            value="<?= htmlspecialchars($_GET['imagem'] ?? '') ?>" required>

        <label for="nome">Nome</label>
        <input type="text" id="nome"
            value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>" required>

        <label for="marca">Marca</label>
        <input type="text" id="marca"
            value="<?= htmlspecialchars($_GET['marca'] ?? '') ?>" required>

        <label for="motor">Motorização</label>
        <input type="text" id="motor"
            value="<?= htmlspecialchars($_GET['motor'] ?? '') ?>" required>

        <label for="velocidade">Velocidade Máxima (ex: 345 km/h)</label>
        <input type="text" id="velocidade"
            value="<?= htmlspecialchars($_GET['velocidade'] ?? '') ?>" required>

        <button type="submit">
            <?= $action == 'editar' ? 'Salvar Alterações' : 'Cadastrar Carro' ?>
        </button>
    </form>

</main>

<?php include 'footer.php'; ?>

<!-- MODAL PADRÃO MOTORHUB (MESMO DO DELETE / UPDATE) -->
<div id="modalOverlay" style="display:none;" class="modal-motorhub-overlay">
  <div class="modal-motorhub-box">
    <p id="modalMessage"></p>

    <div id="modalButtons">
      <button id="btnModalOK" class="btn-modal-ok">OK</button>
    </div>
  </div>
</div>

<!-- Variáveis globais para o JS -->
<script>
    window.CARRO_ACTION = "<?= $action ?>";
    window.CARRO_ID = "<?= $id ?>";
</script>

<script src="js/tema.js"></script>
<script src="js/carros_form.js"></script>

</body>
</html>
