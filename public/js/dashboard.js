const form_image = document.getElementById('form_image');
const form_picture = document.getElementById('form_picture');
const add_picture = document.getElementById('add_picture');

function addPlaylist(){
    const menuListas = document.getElementById('menuListas');
    if (menuListas.style.display === 'none' || menuListas.style.display === '') {
        menuListas.style.display = 'block';
    } else {
        menuListas.style.display = 'none';
    }
}

function excluirJogo(event, user_id ,playlist_id) {
    event.preventDefault();

    const confirmacao = confirm("Tem certeza que deseja excluir este jogo?");
    if (!confirmacao) return;
    console.log(user_id);
    console.log(playlist_id);

    fetch(`/removeList/${playlist_id}/${user_id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.ok) {
            alert('Jogo excluído com sucesso!');
            // Remover o card da interface
            event.target.closest('.ancor_lista').remove();
        } else {
            alert('Erro ao excluir o jogo.');
        }
    })
    .catch(error => console.error('Erro:', error));
}

form_image.addEventListener('click', () => {
    const isExpanded = form_image.getAttribute('aria-expanded');
    if(isExpanded === 'false'){
        console.log('teste2');
        document.querySelector('.add_picture').classList.add('add_picture--active');
        form_image.setAttribute('aria-expanded', 'true');
    }else{
        console.log('teste3');
        document.querySelector('.add_picture').classList.remove('add_picture--active');
        form_image.setAttribute('aria-expanded', 'false');
    }
});

form_picture.addEventListener('submit', (e) => {
    e.preventDefault();
    var formData = new FormData(form_picture);

    // Envia os dados via AJAX
    fetch('/updatePicture', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Sucesso:', data);
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});

document.addEventListener('click', function (event) {
    const menuListas = document.getElementById('menuListas');
    const adicionarLista = document.querySelector('.adicionar_lista img');
    const btn_criar = document.getElementById('btn-criar');
    const nm_lista = document.getElementById('nm_lista');
    const pesquisar = document.getElementById('pesquisar');

    if (!menuListas.contains(event.target) && event.target !== adicionarLista) {
        menuListas.style.display = 'none';
        pesquisar.classList.add('input_menuListas');
        pesquisar.classList.remove('hide_custom')
        nm_lista.classList.add('hide_custom');
        nm_lista.classList.remove('input_menuListas')
        btn_criar.removeAttribute('data-clicked', 'true');
        nm_lista.value = '';
    }

    btn_criar.addEventListener('click', () => {
        nm_lista.classList.add('input_menuListas');
        nm_lista.classList.remove('hide_custom');
        pesquisar.classList.add('hide_custom');
        pesquisar.classList.remove('input_menuListas');

        // Verifique se o evento já foi adicionado
        if (!btn_criar.hasAttribute('data-clicked')) {
            btn_criar.setAttribute('data-clicked', 'true'); // Marca o evento como adicionado

            btn_criar.addEventListener('click', () => {
                console.log('Botão clicado novamente!');
                const name = nm_lista.value;
                const formData = new FormData();
                formData.append('name', name);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch('/storeList', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    btn_criar.removeAttribute('data-clicked', 'true');
                    if (data.success) {
                        console.log('Lista criada com sucesso!');
                        nm_lista.value = '';
                    } else {
                        console.log('Erro na criação da lista!');
                    }
                })
                .catch(error => {
                    btn_criar.removeAttribute('data-clicked', 'true');
                    console.error('Erro:', error);
                    alert('Erro na requisição.');
                    nm_lista.value = '';
                });
            });
        }
    });
});
