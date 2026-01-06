<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorHub - SAC</title>
    <style>@import url("css/estilos.css");</style>
</head>

<body>
    <?php include 'header.php'; ?>
    <?php include 'nav.php'; ?>
   
    <main>
        <h2>Serviço de Atendimento ao Consumidor</h2>
        <p>Nos envie sugestões, críticas ou dúvidas:</p>

        <form id="form-sac">
            <label for="id_nome">Seu Nome:</label>
            <input type="text" id="id_nome">

            <label for="id_email">Seu E-mail:</label>
            <input type="text" id="id_email">

            <label for="id_cpf">Seu CPF:</label>
            <input type="text" id="id_cpf">

            <label for="id_mensagem">Mensagem:</label>
            <textarea id="id_mensagem"></textarea>

            <button type="submit">Enviar</button>
        </form>
    </main>

    <?php include 'footer.php'; ?>

    <script src="js/tema.js"></script>
    <script src="js/validacao.js"></script>
</body>
</html>
