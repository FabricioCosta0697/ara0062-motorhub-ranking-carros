// Seleção dos elementos da tabela
const tabelaRapidos = document.getElementById('rapidos');
const tabelaLentos = document.getElementById('lentos');

const urlDados = 'data/dados.json';

// Função principal
function carregarDadosJSON() {
    fetch(urlDados)
        .then(response => response.json())
        .then(data => {

            const rapidos = data.slice(0, 5);
            const lentos = data.slice(5, 10);

            renderizarTabela(rapidos, tabelaRapidos);
            renderizarTabela(lentos, tabelaLentos);
        })
        .catch(erro => {
            console.error("Erro ao carregar dados:", erro);
        });
}

// Função que monta as linhas da tabela
function renderizarTabela(lista, tabela) {
    tabela.innerHTML = "";

    lista.forEach(item => {
        tabela.innerHTML += `
            <tr>
                <td><img src="${item.imagem.src}" alt="${item.imagem.alt}" width="70"></td>
                <td>${item.nome}</td>
                <td>${item.marca}</td>
                <td>${item.motor}</td>
                <td>${item.velocidade}</td>
            </tr>
        `;
    });
}

carregarDadosJSON();
