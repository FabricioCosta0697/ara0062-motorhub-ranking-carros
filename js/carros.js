// Seleção dos elementos da tabela
const tabelaRapidos = document.getElementById('rapidos');
const tabelaLentos = document.getElementById('lentos');

// URLs da API separadas por tipo
const URL_RAPIDOS = "http://localhost/ara0062-motorhub-ranking-carros/backend/api.php?resource=carros&tipo=rapidos";
const URL_LENTOS = "http://localhost/ara0062-motorhub-ranking-carros/backend/api.php?resource=carros&tipo=lentos";

// Função que monta as linhas da tabela
function renderizarTabela(lista, tabela) {
    tabela.innerHTML = "";

    lista.forEach(item => {
        tabela.innerHTML += `
            <tr>
                <td><img src="${item.imagem}"></td>
                <td>${item.nome}</td>
                <td>${item.marca}</td>
                <td>${item.motor}</td>
                <td>${item.velocidade}</td>
            </tr>
        `;
    });
}

// Carrega listas de rápidos e lentos ao mesmo tempo
Promise.all([
    fetch(URL_RAPIDOS).then(r => r.json()),
    fetch(URL_LENTOS).then(r => r.json())
]).then(([rapidos, lentos]) => {
    renderizarTabela(rapidos, tabelaRapidos);
    renderizarTabela(lentos, tabelaLentos);
}).catch(err => {
    console.error("Erro ao carregar carros:", err);
});
