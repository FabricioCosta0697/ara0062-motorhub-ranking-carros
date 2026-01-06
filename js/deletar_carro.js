// deletar_carro.js - versão final no padrão MotorHub

let idParaDeletar = null;

// Abre modal de confirmação
function abrirConfirmacaoDelete(id) {
    idParaDeletar = id;

    const modal = document.getElementById("modalOverlay");
    const texto = document.getElementById("modalMessage");
    const btnOK = document.getElementById("btnModalOK");
    const btnCancel = document.getElementById("btnModalCancel");

    texto.innerText = "Tem certeza que deseja excluir este carro?";
    btnCancel.style.display = "inline-block";
    btnOK.innerText = "Sim, excluir";

    modal.style.display = "flex";

    btnCancel.onclick = () => {
        modal.style.display = "none";
        idParaDeletar = null;
    };

    btnOK.onclick = () => {
        modal.style.display = "none";
        deleteCarro(idParaDeletar);
    };
}

// Envio real da exclusão
function deleteCarro(id) {

    const url = `http://localhost/ara0062-motorhub-ranking-carros/backend/api.php?resource=carros&id=${id}`;

    fetch(url, {
        method: "DELETE",
        headers: { "Content-Type": "application/json" }
    })
    .then(res => res.json())
    .then(data => {

        const modal = document.getElementById("modalOverlay");
        const texto = document.getElementById("modalMessage");
        const btnOK = document.getElementById("btnModalOK");
        const btnCancel = document.getElementById("btnModalCancel");

        texto.innerText = data.message || "Carro deletado com sucesso!";
        btnCancel.style.display = "none";
        btnOK.innerText = "OK";

        modal.style.display = "flex";

        btnOK.onclick = () => {
            window.location.href = "carros.php";
        };
    })
    .catch(err => {

        const modal = document.getElementById("modalOverlay");
        const texto = document.getElementById("modalMessage");
        const btnOK = document.getElementById("btnModalOK");
        const btnCancel = document.getElementById("btnModalCancel");

        texto.innerText = "Erro ao deletar carro.";
        btnCancel.style.display = "none";
        btnOK.innerText = "OK";

        modal.style.display = "flex";

        btnOK.onclick = () => {
            window.location.href = "carros.php";
        };
    });
}
