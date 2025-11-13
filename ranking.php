<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorHub</title>
    <style type="text/css">
        @import url("css/estilos.css");
    </style>
</head>

<body>
    <header>
        <h1>MotorHub: Seu Ranking de velocidade</h1>
    </header>
    <?php include 'nav.php'; ?>
    <main>
       <h2>Lista dos 5 Mais Rápidos do Mundo</h2>
        <p>Conheça os carros que estão redefinindo os limites da velocidade automotiva:</p>
        <table border="1">
            <thead>
                 <tr>
                  <th>Imagem</th>
                  <th>Nome</th>
                  <th>Marca</th>
                  <th>Motorização</th>
                  <th>Velocidade Máx.</th>
                </tr>
            </thead>

            <tbody id="rapidos">
            
            </tbody>
        </table>

          <h2>Lista dos 5 Mais Lentos do Mundo</h2>
        <p>Nem só de velocidade vive o automobilismo. Conheça os carros que priorizam o conforto e a eficiência:</p>
            <table border="1">
                 <thead>
                 <tr>
                  <th>Imagem</th>
                  <th>Nome</th>
                  <th>Marca</th>
                  <th>Motorização</th>
                  <th>Velocidade Máx.</th>
                </tr>
            </thead>
            <tbody id="lentos">
            </tbody>
        </table>

    </main>
          <?php include 'footer.php'; ?>
            <script src="js/tema.js" defer></script>
            <script src="js/carrega_dados.js" defer></script>

</body>

</html>