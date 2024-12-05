<x-guest-layout>
    @push('style')
        <link rel="stylesheet" href="{{asset('css/jogo.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ asset('js/pagina_jogo.js') }}" defer></script>
    @endpush
    <script>
        const loginRoute = "{{ route('login') }}";
    </script>
    <div class="text-white min-vh-100 d-flex flex-column">
        <nav class="navbar navbar-expand-lg fixed-top navbar-css">
            <div class="container-fluid justify-content-evenly">
                <a class="navbar-brand ps-5 logo-site" href="{{route('home')}}">
                    <img src="{{asset('svg/logo.png')}}" alt="logo gamerboxd" width="auto" height="auto" loading="lazy">
                </a>

                <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse pe-5 justify-content-end" id="navbarNav">
                    <div class="navbar-nav ms-auto ancor-nav nav-custom">
                        @if (auth()->check())
                        <a href="{{route('home')}}" class="nav-link_real">página inicial</a>
                        <a href="{{route('jogos')}}" class="nav-link_real">home</a>
                        <a href="{{route('catalogo')}}" class="nav-link_real">jogos</a>
                        <a href="{{route('dashboard')}}" class="nav-link_real"><img src="{{$informacoes_user->profile_photo_url}}" alt=""></a>
                        @else
                        <a href="{{route('login')}}" class="nav-link_real">login</a>
                        <a href="{{route('register')}}" class="nav-link_real">criar conta</a>
                        <a href="{{route('home')}}" class="nav-link_real">página inicial</a>
                        <a href="{{route('jogos')}}" class="nav-link_real">home</a>
                        <a href="{{route('catalogo')}}" class="nav-link_real">jogos</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        {{-- Main Section --}}
        <div class="container-fluid flex-grow-1 d-flex flex-column h-auto" style="padding: 0px !important; margin-top: 80px; gap: 100px;">
            <div class="capa container-fluid" style="padding: 0px !important;">
                @if ((int)$game['rating'] <= 2)
                    {{-- <div class="cima" style="background-color: #CC697B;" id="cima"> --}}
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}" style="border: 10px solid #CC697B;">
                        </div>
                        <div class="text" id="text">
                            {{-- <div class="nome_desc">
                                <h3>{{$game['name']}}</h3>
                                <p>{{$game['description_raw']}}</p>
                            </div>
                            <div class="funcoes">
                                <div class="acoes2">
                                     <img src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                    <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                                </div>
                            </div> --}}
                            <h3 id="h3_text">{{$game['name']}}</h3>
                            <p id="p_text">{{$game['description_raw']}}</p>
                            <div class="acoes" id="acoes">
                                @if (auth()->check())
                                    <img onclick="showMenuList()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking" id="ranking">
                                <span>minha nota:</span>
                                <div class="quadrados_nota">
                                    <div class="quadrado ruim" data-value="1"></div>
                                    <div class="quadrado ruim" data-value="2"></div>
                                    <div class="quadrado ruim" data-value="3"></div>
                                    <div class="quadrado ruim" data-value="4"></div>
                                    <div class="quadrado mid" data-value="5"></div>
                                    <div class="quadrado mid" data-value="6"></div>
                                    <div class="quadrado mid" data-value="7"></div>
                                    <div class="quadrado bom" data-value="8"></div>
                                    <div class="quadrado bom" data-value="9"></div>
                                    <div class="quadrado bom" data-value="10"></div>
                                </div>
                                @if (auth()->check())
                                    <button id="add_review" onclick="showReviewForm()">Adicionar Review</button>
                                @else
                                    <button id="add_review" onclick="redirectToLogin()">Adicionar Review</button>
                                @endif
                                <div id="review_form" style="display: none;">
                                    {{-- <form id="reviewForm">
                                        <label for="review">Sua Review:</label>
                                        <input type="hidden" name="id_game" value="{{$game['id']}}">
                                        <input type="hidden" name="rating" value="10">
                                        <input type="hidden" name="finalizado" value="pc">
                                        <textarea id="review" name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
                                        <button type="submit" id="enviar_review">Enviar</button>
                                        <button type="button" id="cancel_review">Cancelar</button>
                                    </form> --}}
                                    <div id="review_form" style="display: none;">
    <form id="reviewForm">
        <label for="review">Sua Review:</label>
        <input type="hidden" name="id_game" value="{{$game['id']}}">
        <input type="hidden" name="rating" id="rating"> <!-- Campo oculto para armazenar a nota -->
        <input type="hidden" name="finalizado" value="pc">

        <!-- Quadrados de avaliação -->
        <div class="quadrados_nota">
            <div class="quadrado ruim" data-value="1"></div>
            <div class="quadrado ruim" data-value="2"></div>
            <div class="quadrado ruim" data-value="3"></div>
            <div class="quadrado ruim" data-value="4"></div>
            <div class="quadrado mid" data-value="5"></div>
            <div class="quadrado mid" data-value="6"></div>
            <div class="quadrado mid" data-value="7"></div>
            <div class="quadrado bom" data-value="8"></div>
            <div class="quadrado bom" data-value="9"></div>
            <div class="quadrado bom" data-value="10"></div>
        </div>

        <!-- Área de texto para a review -->
        <textarea id="review" name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>

        <!-- Botões -->
        <button type="submit" id="enviar_review">Enviar</button>
        <button type="button" id="cancel_review">Cancelar</button>
    </form>
</div>

<script>
    // Seleciona todos os quadrados de avaliação
    const quadrados = document.querySelectorAll('.quadrado');

    // Para cada quadrado, adiciona um evento de clique
    quadrados.forEach(function(quadrado) {
        quadrado.addEventListener('click', function() {
            // Obtém o valor de nota do quadrado clicado
            const nota = quadrado.getAttribute('data-value');
            
            // Atualiza o campo hidden de "rating" com o valor da nota
            document.getElementById('rating').value = nota;

            // Altera a aparência dos quadrados (destaca o quadrado selecionado)
            quadrados.forEach(function(q) {
                q.classList.remove('selecionado'); // Remove a classe de seleção de todos os quadrados
            });
            quadrado.classList.add('selecionado'); // Adiciona a classe de seleção ao quadrado clicado
        });
    });

    // Envio do formulário de review
    document.getElementById('reviewForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Evita o comportamento padrão de enviar o formulário e recarregar a página

        const formData = new FormData(this);

        // Adiciona o CSRF Token
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        // Envia os dados para o servidor usando fetch
        fetch('/jogo/storeReview', {
            method: 'POST',
            body: formData, // Envia os dados do formulário
        })
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            if (data.success) {
                alert('Review enviada com sucesso!');
            } else {
                alert('Erro ao enviar a review.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro na requisição.');
        });
    });

    // Cancelar a review
    document.getElementById('cancel_review').addEventListener('click', function() {
        document.getElementById('reviewForm').reset(); // Reseta o formulário
        document.getElementById('review_form').style.display = 'none'; // Esconde o formulário
    });
</script>

<style>
    /* Adicionando estilos para destacar a seleção do quadrado */
    .quadrado.selecionado {
        border: 2px solid #4CAF50; /* Cor verde para destacar o quadrado */
    }
</style>
                                </div>
                                <div id="show_list" style="display: none;">
                                    <div class="menu_listas">
                                        <ul>
                                            @foreach ($playlists as $playlist )
                                                <li>
                                                    <form action="{{ route('store.game', ['id_playlist' => $playlist->id, 'id_game' => $game['id']]) }}" method="POST">
                                                        @csrf
                                                         {{-- <input type="hidden" value="{{$playlist->id}}" id="id_playlist" name="id_playlist">
                                                         <input type="hidden" value="{{$game['id']}}" id="id_game" name="id_game"> --}}
                                                        <button type="submit" onclick="storeGame({{$playlist->id}}, {{$game['id']}}, event)">{{$playlist->name}}</button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <button type="button" id="cancel_list">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="metricas">
                            <div class="plataformas">
                                @foreach ($game['platforms'] as $plataformas )
                                    <span>{{$plataformas['platform']['slug']}}</span>
                                @endforeach
                                <hr>
                            </div>
                            <div class="nota">
                                <span><span class="nota_jogo">{{number_format(floatval($game['rating']) * 20)}}</span>/100</span>
                                <hr>
                            </div>
                            <div class="generos">
                                @foreach ($game['genres'] as $generos )
                                    <span>{{$generos['name']}}</span>
                                @endforeach
                            </div>
                        </div>
                    {{-- </div> --}}
                @elseif ((float)$game['rating'] > 2 && (float)$game['rating'] <= 3.7)
                    {{-- <div class="cima" style="background-color: #96D9E0;" id="cima"> --}}
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}" style="border: 10px solid #96D9E0">
                        </div>
                        <div class="text" id="text">
                            <h3 id="h3_text">{{$game['name']}}</h3>
                            <p id="p_text">{{$game['description_raw']}}</p>
                            <div class="acoes" id="acoes">
                                @if (auth()->check())
                                    <img onclick="showMenuList()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking" id="ranking">
                                <span>minha nota:</span>
                                <div class="quadrados_nota">
                                    <div class="quadrado ruim" data-value="1"></div>
                                    <div class="quadrado ruim" data-value="2"></div>
                                    <div class="quadrado ruim" data-value="3"></div>
                                    <div class="quadrado ruim" data-value="4"></div>
                                    <div class="quadrado mid" data-value="5"></div>
                                    <div class="quadrado mid" data-value="6"></div>
                                    <div class="quadrado mid" data-value="7"></div>
                                    <div class="quadrado bom" data-value="8"></div>
                                    <div class="quadrado bom" data-value="9"></div>
                                    <div class="quadrado bom" data-value="10"></div>
                                </div>
                                @if (auth()->check())
                                    <button id="add_review" onclick="showReviewForm()">Adicionar Review</button>
                                @else
                                    <button id="add_review" onclick="redirectToLogin()">Adicionar Review</button>
                                @endif
                                <div id="review_form" style="display: none;">
                                    <form id="reviewForm">
                                        <label for="review">Sua Review:</label>
                                        <input type="hidden" name="id_game" value="{{$game['id']}}">
                                        <input type="hidden" name="rating" value="10">
                                        <input type="hidden" name="finalizado" value="pc">
                                        <textarea id="review" name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
                                        <button type="submit" id="enviar_review">Enviar</button>
                                        <button type="button" id="cancel_review">Cancelar</button>
                                    </form>
                                </div>
                                <div id="show_list" style="display: none;">
                                    <div class="menu_listas">
                                        <ul>
                                            @foreach ($playlists as $playlist )
                                                <li>
                                                    <form action="{{ route('store.game', ['id_playlist' => $playlist->id, 'id_game' => $game['id']]) }}" method="POST">
                                                        @csrf
                                                         {{-- <input type="hidden" value="{{$playlist->id}}" id="id_playlist" name="id_playlist">
                                                         <input type="hidden" value="{{$game['id']}}" id="id_game" name="id_game"> --}}
                                                         <button type="submit" onclick="storeGame({{$playlist->id}}, {{$game['id']}}, event)">{{$playlist->name}}</button>
                                                        </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <button type="button" id="cancel_list">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="metricas">
                            <div class="plataformas">
                                @foreach ($game['platforms'] as $plataformas )
                                    <span>{{$plataformas['platform']['slug']}}</span>
                                @endforeach
                                <hr>
                            </div>
                            <div class="nota">
                                <span><span class="nota_jogo">{{number_format(floatval($game['rating']) * 20)}}</span>/100</span>
                                <hr>
                            </div>
                            <div class="generos">
                                @foreach ($game['genres'] as $generos )
                                    <span>{{$generos['name']}}</span>
                                @endforeach
                            </div>
                        </div>
                    {{-- </div> --}}
                @elseif ((int)$game['rating'] > 3.7)
                    {{-- <div class="cima" style="background-color: #53e584;" id="cima"> --}}
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}" style="border: 10px solid #53e584;">
                        </div>
                        <div class="text" id="text">
                            <h3 id="h3_text">{{$game['name']}}</h3>
                            <p id="p_text">{{$game['description_raw']}}</p>
                            <div class="acoes" id="acoes">
                                @if (auth()->check())
                                    <img onclick="showMenuList()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking" id="ranking">
                                <span>minha nota:</span>
                                <div class="quadrados_nota">
                                    <div class="quadrado ruim" data-value="1"></div>
                                    <div class="quadrado ruim" data-value="2"></div>
                                    <div class="quadrado ruim" data-value="3"></div>
                                    <div class="quadrado ruim" data-value="4"></div>
                                    <div class="quadrado mid" data-value="5"></div>
                                    <div class="quadrado mid" data-value="6"></div>
                                    <div class="quadrado mid" data-value="7"></div>
                                    <div class="quadrado bom" data-value="8"></div>
                                    <div class="quadrado bom" data-value="9"></div>
                                    <div class="quadrado bom" data-value="10"></div>
                                </div>
                                @if (auth()->check())
                                    <button id="add_review" onclick="showReviewForm()">Adicionar Review</button>
                                @else
                                    <button id="add_review" onclick="redirectToLogin()">Adicionar Review</button>
                                @endif

                                <div id="review_form" style="display: none;">
                                    <form id="reviewForm">
                                        <label for="review">Sua Review:</label>
                                        <input type="hidden" name="id_game" value="{{$game['id']}}">
                                        <input type="hidden" name="rating" value="10">
                                        <input type="hidden" name="finalizado" value="pc">
                                        <textarea id="review" name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
                                        <button type="submit" id="enviar_review">Enviar</button>
                                        <button type="button" id="cancel_review">Cancelar</button>
                                    </form>
                                </div>
                                <div id="show_list" style="display: none;">
                                    <div class="menu_listas">
                                        <ul>
                                            @foreach ($playlists as $playlist )
                                                <li>
                                                    <form action="{{ route('store.game', ['id_playlist' => $playlist->id, 'id_game' => $game['id']]) }}" method="POST">
                                                        @csrf
                                                         {{-- <input type="hidden" value="{{$playlist->id}}" id="id_playlist" name="id_playlist">
                                                         <input type="hidden" value="{{$game['id']}}" id="id_game" name="id_game"> --}}
                                                         <button type="submit" onclick="storeGame({{$playlist->id}}, {{$game['id']}}, event)">{{$playlist->name}}</button>
                                                        </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <button type="button" id="cancel_list">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="metricas">
                            <div class="plataformas">
                                @foreach ($game['platforms'] as $plataformas )
                                    <span>{{$plataformas['platform']['slug']}}</span>
                                @endforeach
                                <hr>
                            </div>
                            <div class="nota">
                                <span><span class="nota_jogo">{{number_format(floatval($game['rating']) * 20)}}</span>/100</span>
                                <hr>
                            </div>
                            <div class="generos">
                                @foreach ($game['genres'] as $generos )
                                    <span>{{$generos['name']}}</span>
                                @endforeach
                            </div>
                        </div>
                    {{-- </div> --}}
                @else
                    {{-- <div class="cima" style="background-color: #BCBCBC;" id="cima"> --}}
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}" style="border: 10px solid #BCBCBC;">
                        </div>
                        <div class="text" id="text">
                            <h3 id="h3_text">{{$game['name']}}</h3>
                            <p id="p_text">{{$game['description_raw']}}</p>
                            <div class="acoes" id="acoes">
                                @if (auth()->check())
                                    <img onclick="showMenuList()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking" id="ranking">
                                <span>minha nota:</span>
                                <div class="quadrados_nota">
                                   <div class="quadrado ruim" data-value="1"></div>
                                    <div class="quadrado ruim" data-value="2"></div>
                                    <div class="quadrado ruim" data-value="3"></div>
                                    <div class="quadrado ruim" data-value="4"></div>
                                    <div class="quadrado mid" data-value="5"></div>
                                    <div class="quadrado mid" data-value="6"></div>
                                    <div class="quadrado mid" data-value="7"></div>
                                    <div class="quadrado bom" data-value="8"></div>
                                    <div class="quadrado bom" data-value="9"></div>
                                    <div class="quadrado bom" data-value="10"></div>
                                </div>
                                @if (auth()->check())
                                    <button id="add_review" onclick="showReviewForm()">Adicionar Review</button>
                                @else
                                    <button id="add_review" onclick="redirectToLogin()">Adicionar Review</button>
                                @endif
                                <div id="review_form" style="display: none;">
                                    <form id="reviewForm">
                                        <label for="review">Sua Review:</label>
                                        <input type="hidden" name="id_game" value="{{$game['id']}}">
                                        {{-- <input type="hidden" name="rating" value="10"> --}}
                                        <input type="hidden" name="finalizado" value="pc">
                                        <textarea id="review" name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
                                        <button type="submit" id="enviar_review">Enviar</button>
                                        <button type="button" id="cancel_review">Cancelar</button>
                                    </form>
                                </div>
                                <div id="show_list" style="display: none;">
                                    <div class="menu_listas">
                                            <ul>
                                                @foreach ($playlists as $playlist )
                                                <li>
                                                    <form action="{{ route('store.game', ['id_playlist' => $playlist->id, 'id_game' => $game['id']]) }}" method="POST">
                                                        @csrf
                                                         {{-- <input type="hidden" value="{{$playlist->id}}" id="id_playlist" name="id_playlist">
                                                         <input type="hidden" value="{{$game['id']}}" id="id_game" name="id_game"> --}}
                                                         <button type="submit" onclick="storeGame({{$playlist->id}}, {{$game['id']}}, event)">{{$playlist->name}}</button>
                                                        </form>
                                                </li>
                                            @endforeach
                                            </ul>
                                            <button type="button" id="cancel_list">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="metricas">
                            <div class="plataformas">
                                @foreach ($game['platforms'] as $plataformas )
                                    <span>{{$plataformas['platform']['slug']}}</span>
                                @endforeach
                                <hr>
                            </div>
                            <div class="nota">
                                <span><span class="nota_jogo">{{number_format(floatval($game['rating']) * 20)}}</span>/100</span>
                                <hr>
                            </div>
                            <div class="generos">
                                @foreach ($game['genres'] as $generos )
                                    <span>{{$generos['name']}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="comentarios container-fluid">
                {{-- <div class="outras_imagens">
                </div> --}}
                <div class="user_comentarios">
                    @foreach ( $comments as $comentario )
                        <div class="comentario">
                            <div class="foto_usuario">
                                <img src="{{$comentario->user->profile_photo_url}}" alt="commentarios">
                            </div>
                            <div class="informações_comentario">
                                <span>{{$comentario->user->name}}</span>
                                @if ($comentario->rating = 10)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating = 9)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating = 8)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating = 7)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating = 6)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating = 5)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating = 4)
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                @elseif ($comentario->rating = 3)
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                @elseif ($comentario->rating = 2)
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                @elseif ($comentario->rating = 1)
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                @else
                                    <div class="quadrado_rating"></div>
                                    <div class="quadrado_rating"></div>
                                    <div class="quadrado_rating"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                @endif
                                <span style="color: white;">{{$comentario->content}}</span>
                                <div class="like">
                                    @if (auth()->check())
                                        <img style="cursor: pointer;" onclick="likeComment({{$comentario->id}}, {{$comentario->user_id}})" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar comentário" id="like_comment">
                                    @else
                                        <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar comentário" id="like_comment">
                                    @endif
                                        <span>{{$comentario->likes_count}}</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
