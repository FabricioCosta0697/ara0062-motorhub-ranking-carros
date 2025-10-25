const tabelaCorpo = document.getElementById('corpo-tabela-filmes'); // atualizar para 'corpo-tabela-veículos'

const urlDados = 'data/catalogo.json'; // atualizar para 'data/ranking.json'


function carregarRankingJSON() {

fetch(urlDados)

.then(response => {

if (!response.ok) {

throw new Error(`Erro ao buscar dados: ${response.statusText}`);

}

return response.json();

})

.then(data => {

renderizarFilmes(data); // trocar "renderizarFilmes" por "renderizarVeículos"
 
})

.catch(error => {

console.error('Houve um erro ao carregar o ranking:', error);

tabelaCorpo.innerHTML = `<tr><td colspan="3">Erro ao carregar os veículos.</td></tr>`;

});

}


function renderizarVeículos(filmes) { // trocar "filmes" por "veículos"

let htmlFilmes = ''; // trocar "htmlFilmes" por "htmlVeículos"


filmes.forEach(filme => { // trocar "filme" por "veículo"

htmlFilmes += ` // trocar "htmlFilmes" por "htmlVeículos"

<tr>

<td><img src="${filme.imagem.src}" alt="${filme.imagem.alt}" width="70"></td> // trocar "filme.imagem" por "veículo.imagem"

<td>${filme.titulo}</td> // trocar "filme.titulo" por "veículo.nome"

<td>${filme.genero}</td> // trocar "filme.genero" por "veículo.marca"

</tr>

`;

});


tabelaCorpo.innerHTML = htmlFilmes; // atualizar para "veículos"

}


// 4. Inicia o carregamento

carregarCatalogoJSON(); // atualizar para "carregarVeículosJSON"