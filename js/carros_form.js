// js/carros_form.js

const action = window.CARRO_ACTION;
const carroId = window.CARRO_ID;

// ------------------------------------------------------
// 1. Se for edição → buscar dados do carro
// ------------------------------------------------------
if (action === "editar" && carroId) {
    fetch(`http://localhost/ara0062-motorhub-ranking-carros/backend/api.php?resource=carros&id=${carroId}`)
        .then(res => res.json())
        .then(data => {

            if (!data || data.message) {
                document.getElementById("modalMessage").innerText = "Erro ao carregar dados do carro.";
                document.getElementById("modalOverlay").style.display = "flex";
                return;
            }

            document.getElementById("imagem").value = data.imagem;
            document.getElementById("nome").value = data.nome;
            document.getElementById("marca").value = data.marca;
            document.getElementById("motor").value = data.motor;

            const velocidadeLimpa = String(data.velocidade)
                .replace("km/h", "")
                .replace("KM/H", "")
                .replace(" Km/h", "")
                .replace(" km/h", "")
                .trim();

            document.getElementById("velocidade").value = velocidadeLimpa;

        })
        .catch(err => {
            console.error(err);
            document.getElementById("modalMessage").innerText = "Erro ao carregar dados do carro.";
            document.getElementById("modalOverlay").style.display = "flex";
        });
}


// ------------------------------------------------------
// 2. Envio do formulário (POST ou PUT)
// ------------------------------------------------------
document.getElementById("form_carro").addEventListener("submit", async function (e) {
    e.preventDefault();

    const velocidade = document.getElementById("velocidade").value.trim();
    const velocidadeFormatada = velocidade.endsWith("km/h") ?
        velocidade : velocidade + " km/h";

    const payload = {
        imagem: document.getElementById("imagem").value,
        nome: document.getElementById("nome").value,
        marca: document.getElementById("marca").value,
        motor: document.getElementById("motor").value,
        velocidade: velocidadeFormatada
    };

    let url = "http://localhost/ara0062-motorhub-ranking-carros/backend/api.php?resource=carros";
    let method = "POST";

    if (action === "editar") {
        method = "PUT";
        url += `&id=${carroId}`;
    }

    try {
        const response = await fetch(url, {
            method,
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        document.getElementById("modalMessage").innerText = result.message;
        document.getElementById("modalOverlay").style.display = "flex";

    } catch (err) {
        document.getElementById("modalMessage").innerText =
            action === "editar" ? "Erro ao atualizar carro." : "Erro ao cadastrar carro.";
        document.getElementById("modalOverlay").style.display = "flex";
    }
});


// ------------------------------------------------------
// 3. OK → volta para carros.php
// ------------------------------------------------------
document.getElementById("btnModalOK").addEventListener("click", () => {
    window.location.href = "carros.php";
});
