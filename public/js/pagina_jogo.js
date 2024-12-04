console.log('ola');
// Variáveis
const quadrados = document.querySelectorAll('.quadrado');
const addReviewButton = document.getElementById('add_review');
const reviewForm = document.getElementById('review_form');
const cancelButton = document.getElementById('cancel_review');
const cancel_list = document.getElementById('cancel_list');
const submitForm = document.getElementById('enviar_review');
const list = document.getElementById('show_list');
const enviar_list = document.getElementById('enviar_list');
// Adiciona o event listener para cada quadrado
quadrados.forEach(quadrado => {
    quadrado.addEventListener('click', function() {
        // Quando o quadrado for clicado, acessa o atributo 'data-value'
        const valor = quadrado.getAttribute('data-value');
        console.log('Quadrado clicado com valor:', valor);
    });
});


// Exibe o formulário quando o botão "adicionar review" é clicado
function showReviewForm() {
    // Exibe o formulário de review
    const form = document.getElementById('review_form');
    form.style.display = 'block';
}

function showMenuList() {
    // Exibe o formulário de review
    const list = document.getElementById('show_list');
    list.style.display = 'block';
}

// document.addEventListener('click', function (event) {
//     const menuListas = document.getElementById('show_list');
//     if (!menuListas.contains(event.target) && event.target !== adicionarLista) {
//         menuListas.style.display = 'none';
//         pesquisar.classList.add('input_menuListas');
//         pesquisar.classList.remove('hide_custom')
//         nm_lista.classList.add('hide_custom');
//         nm_lista.classList.remove('input_menuListas')
//         btn_criar.removeAttribute('data-clicked', 'true');
//         nm_lista.value = '';
//     }
// });

document.getElementById('reviewForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita o comportamento padrão de enviar o formulário e recarregar a página

    const formData = new FormData(this);

    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    console.log(formData);
    fetch('/jogo/storeReview', {
        method: 'POST',
        body: formData, // Envia os dados do formulário
    })
    .then(response => response.json()) // Converte a resposta para JSON
    .then(data => {
        if (data.success) {
            alert('Review enviada com sucesso!');
        } else {
            alert('Erro ao enviar a review.');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro na requisição.');
    });
});

function storeGame(id_playlist,id_game, event){
    if (event) {
        event.preventDefault();
    }

    const formData = new FormData();

    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    console.log(formData);
    fetch(`/jogo/storeGameOnList/${id_playlist}/${id_game}`, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json()) // Converte a resposta para JSON
    .then(data => {
        if (data.success) {
            console.log('Review enviada com sucesso!');
        } else {
            console.log('Erro ao enviar a review.');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        console.log('Erro na requisição.');
    });
}


function likeComment(id, user_id) {
    // Exibe o formulário de review
    const reaction_type = 'like';
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('reaction_type', reaction_type);
    formData.append('comment_id', id);
    formData.append('user_id', user_id);
    fetch('/jogo/like', {
        method: 'POST',
        body: formData, // Envia os dados do formulário
    })
    .then(response => response.json()) // Converte a resposta para JSON
    .then(data => {
        if (data.success) {
            alert('Review enviada com sucesso!');
        } else {
            alert('Erro ao enviar a review.');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro na requisição.');
    });
}

function favoriteGame(game_id) {
    // Exibe o formulário de review
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('game_id', game_id);
    fetch('/jogo/favoriteGame', {
        method: 'POST',
        body: formData, // Envia os dados do formulário
    })
    .then(response => response.json()) // Converte a resposta para JSON
    .then(data => {
        if (data.success) {
            alert('Review enviada com sucesso!');
        } else {
            alert('Erro ao enviar a review.');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro na requisição.');
    });
}

function addPlaylist(){
    const menuListas = document.getElementById('menuListas');
    if (menuListas.style.display === 'none' || menuListas.style.display === '') {
        menuListas.style.display = 'block';
    } else {
        menuListas.style.display = 'none';
    }
}

// Oculta o formulário quando o botão "Cancelar" é clicado
cancelButton.addEventListener('click', function() {
    reviewForm.style.display = 'none';
});

cancel_list.addEventListener('click', function() {
    list.style.display = 'none';
});

function redirectToLogin() {
    // Redireciona para a página de login
    window.location.href = loginRoute;
}
