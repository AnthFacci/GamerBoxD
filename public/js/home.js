const gift = document.getElementById('gift');
const news = document.getElementById('news');

function openTab(evt, target) {
    tabGiveways = document.getElementById('Container--Giveways');
    tabNews     = document.getElementById('Container-news');

    if(target === 'Container--Giveways'){
        tabGiveways.style.display = "flex";
        tabNews.style.display     = "none";
        gift.classList.add('button_target');
        news.classList.remove('button_target');
    }

    if(target === 'Container-news'){
        tabNews.style.display     = "flex";
        tabGiveways.style.display = "none";
        news.classList.add('button_target');
        gift.classList.remove('button_target');
    }

  }

