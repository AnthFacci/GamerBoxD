const search_user = document.getElementById('search_user_page');
const main_search_result = document.getElementById('main--content--search--results');
const main_content_search_paginator_mainDiv = document.getElementById('main--content--search--paginator--mainDiv');
let data;
let index_paginator = 0;
let index_for = 0;

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
        data = await response.json();

        if (lastQuery !== query) {
            return; // Se a consulta mudou, não adicionar os resultados
        }

        console.log(data);
        console.log(main_search_result);
        console.log(index_for);

        // AQUI
        UpdateData();

        console.log(index_for);
        if(main_content_search_paginator_mainDiv.children.length === 0){
            index_paginator = 1;
            criarPagination();
        }

    }
    catch{
        console.error('Erro na busca:', error);
    }
});

function UpdateData(){
    if(main_search_result.children.length > 0){
        main_search_result.innerHTML = '';
    }
    for (let i = index_for; i < index_for + 4; i++) {
        const user = data[i];
        if (!user) break;
        console.log(index_for);
         // Criação do elemento
         const div = document.createElement('div');
         const ancor = document.createElement('a');
         const div_img = document.createElement('div');
         const div_name = document.createElement('div');
         const img = document.createElement('img');
         const span = document.createElement('span');
        //  const div_img_filho = document.createElement('div');

         // Atribuição de valores
         span.innerHTML = user.name;
        if(user.picture != null){
            img.src = user.picture;
        }else{
            img.src = user.profile_photo_url;
        }
         ancor.href = `/perfil/${user.id}`;

         // Adição de classes
         div.classList.add('main--content--search--results--childrens');
         div_img.classList.add('main--content--search--results--childrens--img');
         div_name.classList.add('main--content--search--results--childrens--span');

        //  div_img_filho.appendChild(img)
         div_img.appendChild(img);
         div_name.appendChild(span);
         ancor.append(div_img, div_name);
         div.appendChild(ancor);
        //  console.log(div);
         main_search_result.appendChild(div);
    }
}

function criarPagination(){
    console.log('entrei');
    // Anterior
    const div_anterior = document.createElement('div');
    div_anterior.classList.add('main--content--search--paginator--mainDiv--anterior');
    div_anterior.innerHTML = '<button id="btn_anterior"><span>Anterior</span></button>';
    div_anterior.id = 'div_anterior';
    // Páginas
    const div_paginas = document.createElement('div');
    div_paginas.classList.add('main--content--search--paginator--mainDiv--paginas');
    // Páginas - Anterior
    const div_paginas_anterior = document.createElement('div');
    div_paginas_anterior.classList.add('pag_anterior');
    div_paginas_anterior.innerHTML = '<span>-</span>';
    div_paginas_anterior.id = 'pag_anterior';
    // Páginas - Atual
    const div_paginas_atual = document.createElement('div');
    div_paginas_atual.classList.add('pag_atual');
    div_paginas_atual.innerHTML = '<span>1</span>';
    div_paginas_atual.id = 'pag_atual';
    // Páginas - Próximo
    const div_paginas_proximo = document.createElement('div');
    div_paginas_proximo.classList.add('pag_proximo');
    div_paginas_proximo.innerHTML = '<span>2</span>';
    div_paginas_proximo.id = 'pag_proximo';
    // Append Páginas
    div_paginas.append(div_paginas_anterior, div_paginas_atual, div_paginas_proximo);
    // Próximo
    const div_proximo = document.createElement('div');
    div_proximo.classList.add('main--content--search--paginator--mainDiv--proximo');
    div_proximo.innerHTML = '<button id="btn_proximo"><span>Próximo</span></button>';
    div_proximo.id = 'div_proximo';
    // Append Geral
    console.log('ultimo teste');
    main_content_search_paginator_mainDiv.append(div_anterior, div_paginas, div_proximo);
    atualizar_pagination();
}

function atualizar_pagination(){
        const btn_anterior = document.getElementById('btn_anterior');
        const btn_proximo = document.getElementById('btn_proximo');
        const pag_anterior = document.getElementById('pag_anterior');
        const pag_atual = document.getElementById('pag_atual');
        const pag_proximo = document.getElementById('pag_proximo');
        btn_anterior.addEventListener('click', ()=>{
            if(index_for <= 4){
                pag_anterior.innerText = '-';
                btn_anterior.setAttribute("disabled", true);
                btn_proximo.removeAttribute("disabled");
            }
            index_for -= 4;
            console.log(index_for);
            UpdateData();
            pag_atual.innerText = (index_paginator - 1);
            pag_proximo.innerText = (index_paginator);
            pag_anterior.innerText = (index_paginator -2);
            index_paginator--;
            console.log((data.length - index_for) , 'resultado')
        });
        btn_proximo.addEventListener('click', ()=>{
            // btn_anterior.setAttribute("disabled", false);
            index_for += 4;
            console.log(index_for);
            UpdateData();
            pag_atual.innerText = (index_paginator + 1);
            pag_proximo.innerText = (index_paginator + 2);
            pag_anterior.innerText = (index_paginator);
            index_paginator++;
            console.log((data.length - index_for) , 'resultado')
            if((data.length - index_for) <= 4){
                pag_proximo.innerText = '-';
                btn_proximo.setAttribute("disabled", true);
                btn_anterior.removeAttribute("disabled");
            }
        });
}
