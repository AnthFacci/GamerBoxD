function excluirJogo(event, game_id, playlist_id) {
    event.preventDefault();

    const confirmacao = confirm("Tem certeza que deseja excluir este jogo?");
    if (!confirmacao) return;
    console.log(game_id);
    console.log(playlist_id);

    fetch(`/removeGameFromList/${playlist_id}/${game_id}`, {
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
            event.target.closest('.card').remove();
        } else {
            alert('Erro ao excluir o jogo.');
        }
    })
    .catch(error => console.error('Erro:', error));
}
