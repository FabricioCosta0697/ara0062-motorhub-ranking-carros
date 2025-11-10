// O RegEx para validar e-mails é crucial aqui. 
// Esta é uma expressão regular comum para verificar se a string contém: 
// 1. Caracteres no início. 
// 2. O símbolo '@'. 
// 3. Mais caracteres (o domínio). 
// 4. Um ponto ('.'). 
// 5. O final do domínio (pelo menos dois caracteres). 

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

// Espera o documento ser totalmente carregado 
document.addEventListener('DOMContentLoaded', function() { 

    // 1. Seleciona o campo de e-mail pelo ID 
    const emailInput = document.getElementById('id_email'); 

    // 2. Adiciona o listener de evento 'blur' (quando o campo perde o foco) 
    emailInput.addEventListener('blur', function() { 
        validateEmail(emailInput); 
    }); 

    emailInput.addEventListener('keypress', function() { 
        emailInput.setCustomValidity(''); 
    }); 

    // 3. Adiciona o ouvinte de evento 'submit' ao formulário para verificação final 
    const form = document.querySelector('form'); 
    form.addEventListener('submit', function(event) { 

        if (!validateEmail(emailInput)) { 

            // Se a validação falhar, impede o envio do formulário 
            event.preventDefault();  
            alert('Por favor, corrija o e-mail antes de enviar o formulário.'); 
        } 
    }); 
}); 

/** 
 * Função principal para validar o e-mail usando a expressão regular. 
 * @param {HTMLElement} input - O campo de input do e-mail. 
 * @returns {boolean} - Retorna true se o e-mail for válido, false caso contrário. 
 */ 

function validateEmail(input) { 

    const email = input.value; 

    // Testa o valor do campo com a RegEx 
    if (emailRegex.test(email)) { 

        // E-mail válido: remove qualquer estilo de erro 
        input.style.border = '1px solid green'; 
        input.setCustomValidity(''); // Remove a mensagem de erro do navegador 

        return true; 

    } else { 

        // E-mail inválido: aplica um estilo de erro 
        input.style.border = '2px solid red'; 
        input.setCustomValidity('Por favor, insira um endereço de e-mail válido.'); 
        input.reportValidity(); // Mostra a mensagem de erro do navegador 

        return false; 

    } 

} 