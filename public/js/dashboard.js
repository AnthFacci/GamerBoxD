console.log('ola');


function addPlaylist(){
    const menuListas = document.getElementById('menuListas');
    if (menuListas.style.display === 'none' || menuListas.style.display === '') {
        menuListas.style.display = 'block';
    } else {
        menuListas.style.display = 'none';
    }
}

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
