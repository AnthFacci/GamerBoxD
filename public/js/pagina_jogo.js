console.log('ola');
// Variáveis
const quadrados = document.querySelectorAll('.quadrado');
const addReviewButton = document.getElementById('add_review');
const reviewForm = document.getElementById('review_form');
const cancelButton = document.getElementById('cancel_review');
const submitForm = document.getElementById('enviar_review');
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


// Oculta o formulário quando o botão "Cancelar" é clicado
cancelButton.addEventListener('click', function() {
    reviewForm.style.display = 'none';
});

function redirectToLogin() {
    // Redireciona para a página de login
    window.location.href = loginRoute;
}
