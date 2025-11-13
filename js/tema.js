document.addEventListener('DOMContentLoaded', function() { 

    const body = document.body; 
    const btnAlternarTema = document.getElementById('alternaTema');  

    // FUNÇÃO 1: APLICAR O TEMA SALVO AO CARREGAR A PÁGINA 
    function carregarTema() { 
        const temaSalvo = localStorage.getItem('preferenciaTema') || 'light'; 

        if (temaSalvo === 'dark') { 
            body.classList.add('tema-escuro'); 
            if (btnAlternarTema) { 
                btnAlternarTema.textContent = 'Alternar para Tema Claro'; 
            } 
        } else { 
            body.classList.remove('tema-escuro'); 
            if (btnAlternarTema) { 
                btnAlternarTema.textContent = 'Alternar para Tema Escuro'; 
            } 
        } 
    }

    // FUNÇÃO 2: ALTERAR E SALVAR O NOVO TEMA
    function alternarESalvarTema() { 
        body.classList.toggle('tema-escuro'); 

        let novoTema; 

        if (body.classList.contains('tema-escuro')) { 
            novoTema = 'dark'; 
            btnAlternarTema.textContent = 'Alternar para Tema Claro'; 
        } else { 
            novoTema = 'light'; 
            btnAlternarTema.textContent = 'Alternar para Tema Escuro'; 
        } 

        // SALVA CORRETAMENTE O TEMA ESCOLHIDO
        localStorage.setItem('preferenciaTema', novoTema); 
    }

    // INICIALIZAÇÃO
    carregarTema(); 

    if (btnAlternarTema) { 
        btnAlternarTema.addEventListener('click', alternarESalvarTema); 
    }

});
