<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorHub</title>
    <style type="text/css">
        @import url("css/estilos.css");
    </style>
    <script src="js/script.js" defer></script>
</head>
<body>
    <header>
        <h1>MotorHub: Seu Ranking de velocidade</h1>
    </header>
    <?php include 'nav.php'; ?>
    <main>
        <h2>Serviço de Atendimento ao Consumidor</h2>
        <p>Você pode nos dar uma sugestão ou informação enviando uma mensagem pelo formulário abaixo:</p>
        <form action="" method="post">
            <label for="id_nome">Seu Nome:</label><br>
            <input type="text" name="nome" id="id_nome"><br><br>
            
            <label for="id_email">Seu E-mail:</label><br>
            <input type="text" name="email" id="id_email"><br><br>

            <label for="id_cpf">Seu CPF:</label><br>
            <input type="text" name="cpf" id="id_cpf"><br><br>
            
            <label for="id_mensagem">Mensagem:</label><br>
            <textarea name="mensagem" id="id_mensagem"></textarea><br><br>
            <button type="submit">Enviar</button>
        </form>

    </main>
    <?php include 'footer.php'; ?>
    <script src="js/tema.js"></script>
    <script src="js/validacao.js"></script>

</body>
</html>