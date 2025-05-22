const cards = document.getElementsByClassName('card_list');

console.log(cards);

document.addEventListener('DOMContentLoaded', () =>{

    for (let index = 0; index < cards.length; index++) {
        let aleatoryNumber = Math.floor(Math.random() * cards.length);
        cards[aleatoryNumber].classList.add('destaque');
        console.log('oi');
        console.log(aleatoryNumber);
    }
})


// function excluirJogo(event, game_id, playlist_id) {
//     event.preventDefault();

//     const confirmacao = confirm("Tem certeza que deseja excluir este jogo?");
//     if (!confirmacao) return;
//     console.log(game_id);
//     console.log(playlist_id);

//     fetch(`/removeGameFromList/${playlist_id}/${game_id}`, {
//         method: 'DELETE',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         }
//     })
//     .then(response => {
//         if (response.ok) {
//             alert('Jogo excluído com sucesso!');
//             // Remover o card da interface
//             event.target.closest('.card').remove();
//         } else {
//             alert('Erro ao excluir o jogo.');
//         }
//     })
//     .catch(error => console.error('Erro:', error));
// }

function excluirJogo(event, game_id, playlist_id) {
    event.preventDefault();

    // const confirmacao = confirm("Tem certeza que deseja excluir este jogo?");
    // if (!confirmacao) return;
    // console.log(game_id);
    // console.log(playlist_id);

    Swal.fire({
        title: 'Tem certeza?',
        text: 'Essa ação não poderá ser desfeita!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) =>{
        if(result.isConfirmed){
            fetch(`/removeGameFromList/${playlist_id}/${game_id}`, {
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
                        text: 'Jogo removida da Playlist.',
                        confirmButtonText: 'OK'
                    });
                    // Remover o card da interface
                    event.target.closest('.card').remove();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Erro ao remover jogo da Playlist.',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    })
}
