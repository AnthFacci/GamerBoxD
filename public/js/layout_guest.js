const menuToggle = document.getElementById('menu-toggle');
const navbarAncors = document.getElementById('navbarNav');
const navbarAncorsLimit = document.getElementById('navbarNavLimit');
const btnShowSearch = document.getElementById('btn-show-search');
const search_user = document.getElementById('search_user');
const main_search_result = document.getElementById('main--search--result');

console.log(navbarAncorsLimit, navbarAncors, menuToggle);

menuToggle.addEventListener('click', ()=>{
    const isExpanded = menuToggle.getAttribute('aria-expanded');
    if(isExpanded === 'false'){
        navbarAncors.classList.remove('navbar--ancors');
        navbarAncors.classList.add('navbar--ancors--show');
        navbarAncorsLimit.classList.remove('navbar--ancors-limit');
        // navbarAncorsLimit.classList.add('navbar--ancors--limit--show');
        menuToggle.setAttribute('aria-expanded', 'true');
    }else{
        navbarAncors.classList.remove('navbar--ancors--show');
        navbarAncors.classList.add('navbar--ancors');
        // navbarAncorsLimit.classList.remove('navbar--ancors--limit--show');
        navbarAncorsLimit.classList.add('navbar--ancors--limit');
        menuToggle.setAttribute('aria-expanded', 'false');
    }
})

btnShowSearch.addEventListener('click', ()=>{
    const isExpanded = btnShowSearch.getAttribute('aria-expanded');
    if(isExpanded === 'false'){
        document.querySelector('.main--search').classList.add('main--search--active');
        btnShowSearch.setAttribute('aria-expanded', 'true');
    }else{
        document.querySelector('.main--search').classList.remove('main--search--active');
        btnShowSearch.setAttribute('aria-expanded', 'false');
    }
});

search_user.addEventListener('input', async (value) =>{
    const query = value.target.value.trim();
    console.log(query);

    if (query.length < 2) {
        main_search_result.innerHTML = '';
        return;
    }

    lastQuery = query;

    try{
        main_search_result.innerHTML = '';
        const response = await fetch(`/search?q=${query}`);
        const data = await response.json();

        if (lastQuery !== query) {
            return; // Se a consulta mudou, não adicionar os resultados
        }

        console.log(data);
        console.log(main_search_result);

        for (let index = 0; index < 4; index++) {
            const user = data[index];

             // Criação do elemento
             const div = document.createElement('div');
             const ancor = document.createElement('a');
             const img = document.createElement('img');
             const span = document.createElement('span');
             const div_img = document.createElement('div');
             const div_img_filho = document.createElement('div');
             const div_name = document.createElement('div');

             // Atribuição de valores
             span.innerHTML = user.name;
             ancor.href = `/perfil/${user.id}`;

             if(user.picture != null){
                 img.src = user.picture;
             }else{
                img.src = user.profile_photo_url;
             }

             // Adição de classes
             div.classList.add('main--search--result--div');
             div_img.classList.add('main--search--result--div--img');
             div_name.classList.add('main--search--result--div--name');

             div_img_filho.appendChild(img)
             div_img.appendChild(div_img_filho);
             div_name.appendChild(span);
             ancor.append(div_img, div_name);
             div.append(ancor);
             console.log(div);
             main_search_result.appendChild(div);
        }
    }
    catch{
        console.error('Erro na busca:', error);
    }
});
