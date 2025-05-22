const cards = document.getElementsByClassName('card_fav');

console.log(cards);

document.addEventListener('DOMContentLoaded', () =>{

    for (let index = 0; index < cards.length; index++) {
        let aleatoryNumber = Math.floor(Math.random() * cards.length);
        cards[aleatoryNumber].classList.add('destaque');
        console.log('oi');
        console.log(aleatoryNumber);
    }
})
