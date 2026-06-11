function validarGestao(event) {
    let valido = true;
    let mensagensErro = [];

    const nomeJogo = document.getElementById('nome_jogo');
    const dispCampo = document.getElementById('disp_campo');

    const vipData = document.getElementById('vip_datahora');
    const vipNome = document.getElementById('vip_nome');
    const vipPessoas = document.getElementById('vip_pessoas');

    if (nomeJogo.value.trim() === '') {
        nomeJogo.style.borderColor = 'red';
        mensagensErro.push("A Identificação do Jogo/Evento é obrigatória.");
        valido = false;
    } else {
        nomeJogo.style.borderColor = 'green';
    }

    if (dispCampo.value === '') {
        dispCampo.style.borderColor = 'red';
        mensagensErro.push("A Disponibilidade do Campo é obrigatória.");
        valido = false;
    } else {
        dispCampo.style.borderColor = 'green';
    }

    const vipEmUso = vipData.value !== '' || vipNome.value.trim() !== '' || vipPessoas.value !== '';

    if (vipEmUso) {
        if (vipData.value === '') {
            vipData.style.borderColor = 'red';
            valido = false;
        } else {
            vipData.style.borderColor = 'green';
        }

        if (vipNome.value.trim() === '') {
            vipNome.style.borderColor = 'red';
            valido = false;
        } else {
            vipNome.style.borderColor = 'green';
        }

        if (vipPessoas.value === '') {
            vipPessoas.style.borderColor = 'red';
            valido = false;
        } else if (vipPessoas.value < 1 || vipPessoas.value > 50) {
            vipPessoas.style.borderColor = 'red';
            mensagensErro.push("O número de pessoas na Sala VIP tem de ser entre 1 e 50.");
            valido = false;
        } else {
            vipPessoas.style.borderColor = 'green';
        }

        if (!valido && (vipData.value === '' || vipNome.value.trim() === '' || vipPessoas.value === '')) {
            mensagensErro.push("Como iniciou a marcação VIP, tem de preencher a Data, Nome e Número de Pessoas.");
        }
    } else {
        vipData.style.borderColor = '';
        vipNome.style.borderColor = '';
        vipPessoas.style.borderColor = '';
    }

    if (!valido) {
        event.preventDefault();
        if (mensagensErro.length > 0) {
            alert("Foram encontrados os seguintes erros:\n\n- " + mensagensErro.join("\n- "));
        }
    }
}