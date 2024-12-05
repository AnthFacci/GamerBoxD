
const form_categoria = document.getElementsByClassName('form_categoria');
const all_games = document.getElementById('all_games');
const card_jogos = document.getElementById('card_jogos');
const pesquisar = document.getElementById('pesquisar');
// Importar biblioteca spin
// import { Spinner } from '../node_modules/spin.js/spin';
// const opts = {
//     lines: 13, // Número de linhas do spinner
//     length: 38, // Comprimento de cada linha
//     width: 17, // Espessura da linha
//     radius: 45, // Raio do círculo interno
//     scale: 1, // Escala geral do spinner
//     corners: 1, // Arredondamento das extremidades (0..1)
//     speed: 1, // Velocidade (voltas por segundo)
//     rotate: 0, // Rotação inicial
//     animation: 'spinner-line-shrink', // Animação CSS
//     direction: 1, // 1: horário, -1: anti-horário
//     color: '#ffffff', // Cor do spinner
//     fadeColor: 'transparent', // Cor de desvanecimento
//     top: '50%', // Posição vertical
//     left: '50%', // Posição horizontal
//     shadow: '0 0 1px transparent', // Sombra (CSS)
//     zIndex: 2000000000, // z-index
//     className: 'spinner', // Classe CSS para o spinner
//     position: 'absolute' // Posicionamento do spinner
//   };
let index_pagination = 1;
let next;
let previous;

// Evento para capturar quando o checkbox for alterado
document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', async function() {
        var formData = new FormData();

        // Itera sobre todos os checkboxes marcados
        document.querySelectorAll('input[type="checkbox"]:checked').forEach(function(checkedCheckbox) {
            formData.append(checkedCheckbox.name, checkedCheckbox.value);
        });
        console.log(formData)
        // Aqui você pode enviar os dados do formulário via fetch
        await fetch('/filtros', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => { return response.json();})
        .then(data =>{
            carregarJogos(data);
            // spinner.stop();
        })
        .catch(error => {
            console.log('Erro ao enviar o formulário', error);
        });

        const previous_html = document.getElementById('previous');
        const next_html = document.getElementById('next');

        previous_html.addEventListener('click', function (){
            console.log(previous);
            var previous_form = new FormData();
            previous_form.append('previous', previous)
            fetch('/filtros/nextOrPrevious', {
                method: 'POST',
                body: previous_form,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => { return response.json();})
            .then(data => {
                console.log(data);
                console.log(data);
                index_pagination--;
                carregarJogos(data)
            })
            .catch(error => {
                console.log('Erro ao enviar o formulário', error);
            });
        })
        next_html.addEventListener('click', function (){
            console.log(next)
            var next_form = new FormData();
            next_form.append('next', next)
            fetch('/filtros/nextOrPrevious', {
                method: 'POST',
                body: next_form,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => { return response.json();})
            .then(data => {
                console.log(data);
                index_pagination++;
                carregarJogos(data)
            })
            .catch(error => {
                console.log('Erro ao enviar o formulário', error);
            })
        })
    });
});

pesquisar.addEventListener('click', async function (e){
    e.preventDefault();
    const jogo_input = document.getElementById('jogo_input').value;
    var nm_jogo = new FormData();
    nm_jogo.append('name', jogo_input);
    await fetch('/filtros/searchByName', {
        method: 'POST',
        body: nm_jogo,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {return response.json();})
    .then(data => {
        carregarJogos(data);
    })
    .catch(error => {
        console.log('Erro ao enviar formulário', error);
    });

    const previous_html = document.getElementById('previous');
    const next_html = document.getElementById('next');

    previous_html.addEventListener('click', function (){
        console.log(previous);
        var previous_form = new FormData();
        previous_form.append('previous', previous)
        fetch('/filtros/nextOrPrevious', {
            method: 'POST',
            body: previous_form,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => { return response.json();})
        .then(data => {
            console.log(data);
            console.log(data);
            index_pagination--;
            carregarJogos(data)
        })
        .catch(error => {
            console.log('Erro ao enviar o formulário', error);
        });
    })
    next_html.addEventListener('click', function (){
        console.log(next)
        var next_form = new FormData();
        next_form.append('next', next)
        fetch('/filtros/nextOrPrevious', {
            method: 'POST',
            body: next_form,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => { return response.json();})
        .then(data => {
            console.log(data);
            index_pagination++;
            carregarJogos(data)
        })
        .catch(error => {
            console.log('Erro ao enviar o formulário', error);
        })
    })
});

function carregarJogos(data){
    card_jogos.innerHTML = '';
    // const spinner = new Spinner(opts).spin(target);
    console.log('HTML recebido com sucesso', data);
    // document.getElementById('all_games').innerHTML = html;
    // atualizar_pagination();
    next = data.next;
    previous = data.previous;
    data.results.forEach(jogo => {
        // Criação da div do card
        let card = document.createElement('div');
        card.className = 'card';

        // Criação link jogos
        let link = document.createElement('a');
        link.href = `/jogo/${jogo.id}`; 
        link.className = 'link-jogo'; 

        // Verificação de métrica para diferenciar coloração
        if(jogo.rating == 0)
            card.style.backgroundColor = '#BCBCBC';
        else if(jogo.rating <= 2)
            card.style.backgroundColor = '#CC697B';
        else if(jogo.rating > 2 && jogo.rating <= 3.7)
            card.style.backgroundColor = '#96D9E0';
        else if(jogo.rating > 3.7)
            card.style.backgroundColor = '#53e584';
        
        // Criação da imagem do card do jogo
        let img_card = document.createElement('img');
        img_card.src = jogo.background_image;
        img_card.className = 'img_lancamento';
        img_card.alt = `Capa ${jogo.name}`;
        // Criação div nome e nota
        let div_nm_nt = document.createElement('div');
        div_nm_nt.className = 'nome_nota';
        // Criação do p pro nome do jogo
        let p_nome = document.createElement('p');
        p_nome.className = 'nm_lancamento';
        p_nome.innerHTML = jogo.name;
        // Criação do p pra nota do jogo
        let p_nota = document.createElement('p');
        p_nota.className = 'nt_lancamento';
        if(jogo.metacritic == 0)
            p_nota.innerHTML = '-';
        else
            p_nota.innerHTML = Math.round(jogo.rating * 20);

        // Atribuindo os elementos dentro da div principal
        div_nm_nt.append(p_nome, p_nota);
        card.append(img_card,div_nm_nt);
        link.append(card);
        card_jogos.append(link);

    });
    // Criar paginação
    if(document.getElementsByClassName('pagination').length > 0){
        atualizar_pagination();
    }else{
         index_pagination = 1;
        criarPagination();
    }
    // spinner.stop();
}

function criarPagination(){
    // Criação div principal pagination
    if(document.getElementsByClassName('pagination').length){

    }
    const pagination = document.createElement('div');
    pagination.className = 'pagination';
    // Criação da div previous
    const previous = document.createElement('div');
    previous.className = 'previous';
    previous.id = 'previous';
    previous.innerHTML = '<span>anterior</span>';
    // Criação das páginas
    const paginas = document.createElement('div');
    paginas.className = 'paginas';
        // Criação da página anterior
        const pag_anterior = document.createElement('div');
        pag_anterior.className = 'pag_anterior';
        pag_anterior.id = 'pag_anterior';
        pag_anterior.innerHTML = '<span>-</span>';
        // Criação página atual
        const pag_atual = document.createElement('div');
        pag_atual.className = 'pag_atual';
        pag_atual.id = 'pag_atual';
        pag_atual.innerHTML = '<span>1</span>'
        // Criação da próxima página
        const pag_prox = document.createElement('div');
        pag_prox.className = 'pag_prox';
        pag_prox.id = 'pag_prox';
        pag_prox.innerHTML = '<span>2</span>';
    // Adicionando as div dentro da div paginas
    paginas.append(pag_anterior, pag_atual, pag_prox);
    // Criação da div next
    const next = document.createElement('div');
    next.className = 'next';
    next.id = 'next';
    next.innerHTML = '<span>próximo</span>';

    // Adicionando tudo dentro da div pagination
    pagination.append(previous, paginas, next);
    all_games.append(pagination);
    atualizar_pagination();
}

function atualizar_pagination(){
    const pag_anterior = document.getElementById('pag_anterior');
    const pag_atual = document.getElementById('pag_atual');
    const pag_prox = document.getElementById('pag_prox');

    if(index_pagination > 1){
        pag_anterior.innerText = (index_pagination - 1);
        pag_atual.innerText = index_pagination;
        pag_atual.style.backgroundColor = '#DA85DD';
        pag_prox.innerText = (index_pagination + 1);
    }else{
        pag_anterior.innerText = '-';
        pag_anterior.style.pointerEvents = 'none';
        pag_anterior.style.opacity = 0.6;
        pag_atual.innerText = index_pagination;
        pag_atual.style.backgroundColor = '#DA85DD';
        pag_prox.innerText = (index_pagination + 1);
    }

}

