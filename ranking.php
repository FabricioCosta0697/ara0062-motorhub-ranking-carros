<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudFlix</title>
    <style type="text/css">
        @import url("css/estilos.css");
    </style>
</head>

<body>
    <!-- Testando Github com vscode.dev -->
    <header>
        <h1>CloudFlix: Seu catálogo fictício de filmes</h1>
    </header>
    <?php include 'nav.php'; ?>
    <main>
        <h2>Catálogo de filmes</h2>
        <p>Desfrute desse catálogo imenso de filmes extradionários</p>
        <table border="1" id="tabela-catalogo">
            <thead>
                <tr>
                    <th>Cartaz</th>
                    <th>Título</th>
                    <th>Gênero</th>
                </tr>
            </thead>
            <tbody id="corpo-tabela-filmes">
                ___
            </tbody>
        </table>
    </main>
          <?php include 'footer.php'; ?>
    <script src="js/tema.js"></script> 
    <script src="js/catalogo.js"></script>
</body>

</html>