function openTab(evt, target) {
    tabGiveways = document.getElementById('Container--Giveways');
    tabNews     = document.getElementById('Container-news');

    if(target === 'Container--Giveways'){
        tabGiveways.style.display = "flex";
        tabNews.style.display     = "none";
    }

    if(target === 'Container-news'){
        tabNews.style.display     = "flex";
        tabGiveways.style.display = "none";
    }
  }
