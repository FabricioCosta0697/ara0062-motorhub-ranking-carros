// js/validacao.js

// Regex estrito para o formato 000.000.000-00
const regexCPFFormato = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
// Regex simples para e-mail no formato joao.silva@net.com (ajustável)
const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/i;

function validarEmail(email) {
    return regexEmail.test(email);
}

function validarCPFFormato(cpf) {
    return regexCPFFormato.test(cpf);
}

// Função para aplicar máscara no campo CPF: 000.000.000-00
function aplicarMascaraCPF(value) {
    // Remove tudo que não for dígito
    const apenasDigitos = value.replace(/\D/g, '').slice(0, 11); // limita a 11 dígitos
    // Aplica os separadores
    let resultado = apenasDigitos;
    if (apenasDigitos.length > 9) {
        resultado = apenasDigitos.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
    } else if (apenasDigitos.length > 6) {
        resultado = apenasDigitos.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
    } else if (apenasDigitos.length > 3) {
        resultado = apenasDigitos.replace(/^(\d{3})(\d{0,3}).*/, '$1.$2');
    }
    return resultado;
}

document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector("form");
    const inputEmail = document.getElementById("id_email");
    const inputCPF = document.getElementById("id_cpf");

    // Só pros casos em que elemento existe (defesa)
    if (inputCPF) {
        // mascara ao digitar
        inputCPF.addEventListener("input", (e) => {
            const pos = inputCPF.selectionStart;
            const valorFormatado = aplicarMascaraCPF(inputCPF.value);
            inputCPF.value = valorFormatado;

            // tenta restaurar o caret pra fim (simples)
            inputCPF.selectionStart = inputCPF.selectionEnd = inputCPF.value.length;
        });

        // impede colar conteúdo inválido -- converte e aplica máscara
        inputCPF.addEventListener("paste", (e) => {
            e.preventDefault();
            const texto = (e.clipboardData || window.clipboardData).getData('text');
            inputCPF.value = aplicarMascaraCPF(texto);
        });
    }

    if (formulario) {
        formulario.addEventListener("submit", (e) => {
            const email = inputEmail ? inputEmail.value.trim() : "";
            const cpf = inputCPF ? inputCPF.value.trim() : "";

            // Validação do e-mail exigido
            if (!validarEmail(email)) {
                alert("E-mail inválido! Use o formato joao.silva@net.com");
                if (inputEmail) inputEmail.focus();
                e.preventDefault();
                return;
            }

            // Validação do CPF apenas no formato (000.000.000-00)
            if (!validarCPFFormato(cpf)) {
                alert("CPF inválido! Use o formato 000.000.000-00");
                if (inputCPF) inputCPF.focus();
                e.preventDefault();
                return;
            }

          
        });
    }
});
