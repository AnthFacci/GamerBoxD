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

    // const confirmacao = confirm("Tem certeza que deseja excluir este jogo?");
    // if (!confirmacao) return;
    // console.log(user_id);
    // console.log(playlist_id);
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Essa ação não poderá ser desfeita!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
       if(result.isConfirmed){
         fetch(`/removeList/${playlist_id}/${user_id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                 Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Playlist excluída com sucesso.',
                    confirmButtonText: 'OK'
                });
                // Remover o card da interface
                event.target.closest('.ancor_lista').remove();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Erro ao excluir a playlist.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro inesperado',
                    text: 'Algo deu errado. Tente novamente.'
                });
        });
       }
    })
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

    const btn_criar = document.getElementById('btn-criar');

    btn_criar.addEventListener('click', () => {
        const btn_criar = document.getElementById('btn-criar');
        const nm_lista = document.getElementById('nm_lista');
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Playlist criada com sucesso.',
                            confirmButtonText: 'OK'
                        });
                        nm_lista.value = '';
                        window.location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Erro a criar playlist.',
                            confirmButtonText: 'OK'
                        });
                        window.location.reload();
                    }
                })
                .catch(error => {
                    btn_criar.removeAttribute('data-clicked', 'true');
                    console.error('Erro:', error);
                    alert('Erro na requisição.');
                    nm_lista.value = '';
                });
    });
