// Variáveis
const quadrados = document.querySelectorAll('.quadrado');
const addReviewButton = document.getElementById('add_review');
const reviewForm = document.getElementById('review_form');
const cancelButton = document.getElementById('cancel_review');
const cancel_list = document.getElementById('cancel_list');
const submitForm = document.getElementById('enviar_review');
const list = document.getElementById('show_list');
const enviar_list = document.getElementById('enviar_list');
const quadrados2 = document.querySelectorAll('.quadrado_review');
const ratingInput2 = document.getElementById('ratingInput');

// Adiciona o event listener para cada quadrado
quadrados.forEach(quadrado => {
    quadrado.addEventListener('click', function() {
        // Quando o quadrado for clicado, acessa o atributo 'data-value'
        const valor = quadrado.getAttribute('data-value');
        console.log('Quadrado clicado com valor:', valor);
    });
});

// document.addEventListener('DOMContentLoaded', () =>{
//     const cima = document.getElementById('cima');
//     const text = document.getElementById('text');
//     const acoes = document.getElementById('acoes');

//     // Pegar alturas reais dos elementos
//     const textHeight = text.offsetHeight; // Altura do elemento, incluindo padding e border
//     const acoesHeight = acoes.offsetHeight;

//     const total = textHeight - acoesHeight;
//     console.log(textHeight);
//     console.log(acoesHeight);
//     console.log(total);

//     cima.style.height = `${total}px`;
// });


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
function closeMenuList() {
    // Exibe o formulário de review
    const list = document.getElementById('show_list');
    list.style.display = 'none';

}
function closeReview() {
    // Exibe o formulário de review
    reviewForm.style.display = 'none';

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

quadrados2.forEach((quadrado, index) => {
    // Evento para destacar os quadrados no hover

    // Evento de clique para selecionar o quadrado
    quadrado.addEventListener('click', function () {
        // Atualizar o valor do input escondido
        ratingInput2.value = this.dataset.value;
        console.log(ratingInput2.value);

        // Remover destaque de outros quadrados (caso necessário)
        quadrados2.forEach(q => q.classList.remove('selecionado'));

        // Adicionar destaque ao quadrado clicado (caso necessário)
        this.classList.add('selecionado');
    });
});

document.getElementById('reviewForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita o comportamento padrão de enviar o formulário e recarregar a página

    const formData = new FormData(this);
    console.log(ratingInput2);
    console.log(ratingInput2.value);
    // Adicionar evento de clique
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    console.log(formData);
    fetch('/jogo/storeReview', {
        method: 'POST',
        body: formData, // Envia os dados do formulário
    })
    .then(response => response.json()) // Converte a resposta para JSON
    .then(data => {
        closeReview();
        if (data.success) {
            alert('Review enviada com sucesso!');
            window.location.reload();
        } else {
            alert('Erro ao enviar a review.');
        }
    })
    .catch(error => {
        closeReview();
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
            closeMenuList();
            alert(data.message);
        } else {
            closeMenuList();
            alert(data.message);
        }
    })
    .catch(error => {
        closeMenuList();
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
            const like_comment = document.getElementById('like_comment');
            const comment_count = document.getElementById('comment_count');
            if (data.delete == true) {
                // let valor = parseInt(comment_count.textContent, 10) - 1;
                // comment_count.textContent = valor;
                // like_comment.src = like_comment.dataset.semCurtida; // Atualiza a imagem
                window.location.reload();
            } else {
                // let valor = parseInt(comment_count.textContent, 10) + 1;
                // comment_count.textContent = valor;
                // like_comment.src = like_comment.dataset.reviewCurtido;
                window.location.reload();
            }
            alert(data.message);
        } else {
            alert(data.message);
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
            alert(data.message);
            if(data.message == 'Favorito adicionado com sucesso!'){
                const favoritar_game = document.getElementById('favoritar_game');
                const imgLiked = favoritar_game.dataset.imgLiked;
                console.log(imgLiked);
                favoritar_game.src = imgLiked;
            }else if(data.message == 'Favorito removido com sucesso!'){
                const favoritar_game = document.getElementById('favoritar_game');
                const imgnolike = favoritar_game.dataset.imgnolike;
                console.log(imgnolike);
                favoritar_game.src = imgnolike;
            }
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


const quadradosLista = document.querySelectorAll('.quadrado');
const ratingInput = reviewForm.querySelector('input[name="rating"]'); // Campo de rating no formulário

quadradosLista.forEach((quadrado, index) => {
    // Atribui um ID único ao quadrado (opcional, pode ser qualquer identificador)
    quadrado.setAttribute('data-id', index); // Você pode mudar o valor para o ID do jogo ou outro valor relevante

    quadrado.addEventListener('mouseover', () => {
        for (let i = 0; i <= index; i++) {
            quadradosLista[i].style.opacity = '1'; // Opacidade 100% para os quadrados à esquerda
        }
        for (let i = index + 1; i < quadradosLista.length; i++) {
            quadradosLista[i].style.opacity = '0.5'; // Opacidade 50% para os quadrados à direita
        }
    });

    quadrado.addEventListener('mouseout', () => {
        quadradosLista.forEach(q => {
            q.style.opacity = '0.5'; // Opacidade 50% para todos os quadrados
        });
    });

    quadrado.addEventListener('click', () => {
        const quadradoId = quadrado.getAttribute('data-id'); // Obter o ID do quadrado clicado
        const ratingValue = quadrado.getAttribute('data-value'); // Obter o valor do quadrado clicado
        console.log('Você clicou no quadrado com ID:', quadradoId);
        console.log('Valor do rating:', ratingValue);

        // Atualiza o valor do rating no formulário
        ratingInput.value = ratingValue; // Altera o valor do campo rating no formulário

        // Exibe o formulário de review
        reviewForm.style.display = 'block'; // Supondo que o reviewForm esteja inicialmente escondido
    });
});
