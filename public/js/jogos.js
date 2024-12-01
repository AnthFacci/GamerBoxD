// CAROUSEL LANCAMENTOS
const cards_lancamentos = document.getElementById('cards_lancamentos');
const lancamento_left = document.getElementById('left_lancamento');
const lancamento_right = document.getElementById('right_lancamento');
// CAROUSEL MAIS ACESSADOS
const cards_acessados = document.getElementById('cards_acessados');
const acessados_left = document.getElementById('left_acessados');
const acessados_right = document.getElementById('right_acessados');
// CAROUSEL EM BREVE
const cards_breve = document.getElementById('cards_breve');
const breve_left = document.getElementById('left_breve');
const breve_right = document.getElementById('right_breve');
// CAROUSEL MAIS BEM AVALIADOS
const cards_avaliados = document.getElementById('cards_avaliados');
const avaliados_left = document.getElementById('left_avaliados');
const avaliados_right = document.getElementById('right_avaliados');

// Evento do carousel lancamento
lancamento_left.addEventListener('click', () => {
    cards_lancamentos.scrollLeft += 205
    console.log(cards_lancamentos.scrollLeft);
});

lancamento_right.addEventListener('click', () => {
    cards_lancamentos.scrollLeft -= 205;
    console.log(cards_lancamentos.scrollLeft);
});

// Evento do carousel mais acessados
acessados_left.addEventListener('click', () => {
    cards_acessados.scrollLeft += 205
    console.log(cards_lancamentos.scrollLeft);
});

acessados_right.addEventListener('click', () => {
    cards_acessados.scrollLeft -= 205;
    console.log(cards_lancamentos.scrollLeft);
});

// Evento do carousel em breve
breve_left.addEventListener('click', () => {
    cards_breve.scrollLeft += 205
    console.log(cards_lancamentos.scrollLeft);
});

breve_right.addEventListener('click', () => {
    cards_breve.scrollLeft -= 205;
    console.log(cards_lancamentos.scrollLeft);
});

// Evento do carousel mais bem avaliados
avaliados_left.addEventListener('click', () => {
    cards_avaliados.scrollLeft += 205
    console.log(cards_lancamentos.scrollLeft);
});

avaliados_right.addEventListener('click', () => {
    cards_avaliados.scrollLeft -= 205;
    console.log(cards_lancamentos.scrollLeft);
});
