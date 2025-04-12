const carrosseis = document.querySelectorAll('.container--carrossel-images');

const setasEsquerda = document.querySelectorAll('.seta-esquerda');
const setasDireita = document.querySelectorAll('.seta-direita');

carrosseis.forEach((carrossel_total, index) => {
    const esquerda = setasEsquerda[index];
    const direita = setasDireita[index];

    direita.addEventListener('click', () => {
        const larguraItem = carrossel_total.querySelector('.container--carrossel-images--jogos').offsetWidth;
        carrossel_total.scrollLeft += larguraItem + 10; // + gap
    });

    esquerda.addEventListener('click', () => {
        const larguraItem = carrossel_total.querySelector('.container--carrossel-images--jogos').offsetWidth;
        carrossel_total.scrollLeft -= larguraItem + 10; // - gap
    });
});
