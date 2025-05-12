<x-guest-layout :informacoes_user="$informacoes_user">
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
        {{-- <nav class="navbar navbar-expand-lg fixed-top navbar-css">
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
        </nav> --}}
        {{-- Main Section --}}
        <div class="container-fluid flex-grow-1 d-flex flex-column h-auto" style="padding: 0px !important; margin-top: 80px; gap: 100px;">
            <div class="capa container-fluid" style="padding: 0px !important;">
                @if ((int)$game['rating'] <= 2)
                    {{-- <div class="cima" style="background-color: #CC697B;" id="cima"> --}}
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}" style="border: 10px solid #CC697B;">
                        </div>
                        <div class="text" id="text">
                            <h3 id="h3_text">{{$game['name']}}</h3>
                            <p id="p_text">{{$game['description_raw']}}</p>
                            <div class="acoes" id="acoes">
                                @if (auth()->check())
                                    <img onclick="showMenuList()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                   @if ($favorite == true)
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @else
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @endif
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                @if (!empty($stores['results']['0']['url']))
                                    <a href="{{$stores['results']['0']['url']}}"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @else
                                    <a href="#"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @endif                            </div>
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
                                        <div class="superior">
                                            <input type="hidden" name="rating" value="10" id="ratingInput">
                                            <div class="quadrados_nota_review">
                                                <div class="quadrado_review ruim" data-value="1"></div>
                                                <div class="quadrado_review ruim" data-value="2"></div>
                                                <div class="quadrado_review ruim" data-value="3"></div>
                                                <div class="quadrado_review ruim" data-value="4"></div>
                                                <div class="quadrado_review mid" data-value="5"></div>
                                                <div class="quadrado_review mid" data-value="6"></div>
                                                <div class="quadrado_review mid" data-value="7"></div>
                                                <div class="quadrado_review bom" data-value="8"></div>
                                                <div class="quadrado_review bom" data-value="9"></div>
                                                <div class="quadrado_review bom" data-value="10"></div>
                                            </div>
                                            {{-- <input type="hidden" name="finalizado" value="pc"> --}}
                                            <select id="status" name="status">
                                                <option value="finalizado">finalizado</option>
                                                <option value="metade do jogo">metade do game</option>
                                                <option value="começo do jogo">começo do game</option>
                                            </select>
                                            <select id="finalizado" name="finalizado">
                                                <option value="pc">pc</option>
                                                <option value="switch">switch</option>
                                                <option value="playstation 4">playstation 4</option>
                                                <option value="playstation 5">playstation 5</option>
                                                <option value="xbox one">xbox one</option>
                                            </select>
                                        </div>
                                        <textarea id="review" required name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
                                        <button type="submit" id="enviar_review">Enviar</button>
                                        <button type="button" id="cancel_review">Cancelar</button>
                                    </form>
                                </div>
                                {{-- <div id="show_list" style="display: none;"> --}}
                                    <div class="menu_listas" id="show_list">
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
                                {{-- </div> --}}
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
                                   @if ($favorite == true)
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @else
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @endif
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                @if (!empty($stores['results']['0']['url']))
                                    <a href="{{$stores['results']['0']['url']}}"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @else
                                    <a href="#"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @endif
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
                                        <div class="superior">
                                            <input type="hidden" name="rating" value="10" id="ratingInput">
                                            <div class="quadrados_nota_review">
                                                <div class="quadrado_review ruim" data-value="1"></div>
                                                <div class="quadrado_review ruim" data-value="2"></div>
                                                <div class="quadrado_review ruim" data-value="3"></div>
                                                <div class="quadrado_review ruim" data-value="4"></div>
                                                <div class="quadrado_review mid" data-value="5"></div>
                                                <div class="quadrado_review mid" data-value="6"></div>
                                                <div class="quadrado_review mid" data-value="7"></div>
                                                <div class="quadrado_review bom" data-value="8"></div>
                                                <div class="quadrado_review bom" data-value="9"></div>
                                                <div class="quadrado_review bom" data-value="10"></div>
                                            </div>
                                            {{-- <input type="hidden" name="finalizado" value="pc"> --}}
                                            <select id="status" name="status">
                                                <option value="finalizado">finalizado</option>
                                                <option value="metade do jogo">metade do game</option>
                                                <option value="comeco do jogo">começo do game</option>
                                            </select>
                                            <select id="finalizado" name="finalizado">
                                                <option value="pc">pc</option>
                                                <option value="switch">switch</option>
                                                <option value="playstation 4">playstation 4</option>
                                                <option value="playstation 5">playstation 5</option>
                                                <option value="xbox one">xbox one</option>
                                            </select>
                                        </div>
                                        <textarea id="review" required name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
                                        <button type="submit" id="enviar_review">Enviar</button>
                                        <button type="button" id="cancel_review">Cancelar</button>
                                    </form>
                                </div>
                                {{-- <div id="show_list" style="display: none;"> --}}
                                    <div class="menu_listas" id="show_list">
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
                                {{-- </div> --}}
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
                                        <div class="menu_listas" id="show_list" style="display: none;">
                                            <ul>
                                                @foreach ($playlists as $playlist )
                                                    <li>
                                                        <form action="{{ route('store.game', ['id_playlist' => $playlist->id, 'id_game' => $game['id']]) }}" method="POST">
                                                            @csrf
                                                             <input type="hidden" value="{{$playlist->id}}" id="id_playlist" name="id_playlist">
                                                             <input type="hidden" value="{{$game['id']}}" id="id_game" name="id_game">
                                                             <button type="submit" onclick="storeGame({{$playlist->id}}, {{$game['id']}}, event)">{{$playlist->name}}</button>
                                                            </form>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <button type="button" id="cancel_list">Cancelar</button>
                                        </div>
                                   @if ($favorite == true)
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @else
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @endif
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                @if (!empty($stores['results']['0']['url']))
                                    <a href="{{$stores['results']['0']['url']}}"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @else
                                    <a href="#"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @endif                            </div>
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
                                        <div class="superior">
                                            <input type="hidden" name="rating" value="10" id="ratingInput">
                                            <div class="quadrados_nota_review">
                                                <div class="quadrado_review ruim" data-value="1"></div>
                                                <div class="quadrado_review ruim" data-value="2"></div>
                                                <div class="quadrado_review ruim" data-value="3"></div>
                                                <div class="quadrado_review ruim" data-value="4"></div>
                                                <div class="quadrado_review mid" data-value="5"></div>
                                                <div class="quadrado_review mid" data-value="6"></div>
                                                <div class="quadrado_review mid" data-value="7"></div>
                                                <div class="quadrado_review bom" data-value="8"></div>
                                                <div class="quadrado_review bom" data-value="9"></div>
                                                <div class="quadrado_review bom" data-value="10"></div>
                                            </div>
                                            {{-- <input type="hidden" name="finalizado" value="pc"> --}}
                                            <select id="status" name="status">
                                                <option value="finalizado">finalizado</option>
                                                <option value="metade do jogo">metade do game</option>
                                                <option value="começo do jogo">começo do game</option>
                                            </select>
                                            <select id="finalizado" name="finalizado">
                                                <option value="pc">pc</option>
                                                <option value="switch">switch</option>
                                                <option value="playstation 4">playstation 4</option>
                                                <option value="playstation 5">playstation 5</option>
                                                <option value="xbox one">xbox one</option>
                                            </select>
                                        </div>
                                        <textarea id="review" required name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
                                        <button type="submit" id="enviar_review">Enviar</button>
                                        <button type="button" id="cancel_review">Cancelar</button>
                                    </form>
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
                                   @if ($favorite == true)
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @else
                                    <img style="cursor: pointer;" onclick="favoriteGame({{$game['id']}})" data-img-liked="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-imgnolike="{{asset('svg/game/heart-svgrepo-com.svg')}}" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                   @endif
                                @else
                                    <img onclick="redirectToLogin()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                    <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                @endif
                                @if (!empty($stores['results']['0']['url']))
                                    <a href="{{$stores['results']['0']['url']}}"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @else
                                    <a href="#"><img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game"></a>
                                @endif                            </div>
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
                                        <div class="superior">
                                            <input type="hidden" name="rating" value="10" id="ratingInput">
                                            <div class="quadrados_nota_review">
                                                <div class="quadrado_review ruim" data-value="1"></div>
                                                <div class="quadrado_review ruim" data-value="2"></div>
                                                <div class="quadrado_review ruim" data-value="3"></div>
                                                <div class="quadrado_review ruim" data-value="4"></div>
                                                <div class="quadrado_review mid" data-value="5"></div>
                                                <div class="quadrado_review mid" data-value="6"></div>
                                                <div class="quadrado_review mid" data-value="7"></div>
                                                <div class="quadrado_review bom" data-value="8"></div>
                                                <div class="quadrado_review bom" data-value="9"></div>
                                                <div class="quadrado_review bom" data-value="10"></div>
                                            </div>
                                            {{-- <input type="hidden" name="finalizado" value="pc"> --}}
                                            <select id="status" name="status">
                                                <option value="finalizado">finalizado</option>
                                                <option value="metade do jogo">metade do game</option>
                                                <option value="começo do jogo">começo do game</option>
                                            </select>
                                            <select id="finalizado" name="finalizado">
                                                <option value="pc">pc</option>
                                                <option value="switch">switch</option>
                                                <option value="playstation 4">playstation 4</option>
                                                <option value="playstation 5">playstation 5</option>
                                                <option value="xbox one">xbox one</option>
                                            </select>
                                        </div>
                                        <textarea id="review" required name="content" rows="4" cols="50" placeholder="Escreva sua review aqui..."></textarea>
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
                                @if ($comentario->rating == 10)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating == 9)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating == 8)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating == 7)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating == 6)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating == 5)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating == 4)
                                    <div class="rating">
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                    </div>
                                @elseif ($comentario->rating == 3)
                                    <div class="rating">
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                    </div>
                                @elseif ($comentario->rating == 2)
                                    <div class="rating">
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                    </div>
                                @elseif ($comentario->rating == 1)
                                    <div class="rating">
                                        <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                        <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                    </div>
                                @else
                                <div class="rating">
                                    <div class="quadrado_rating"></div>
                                    <div class="quadrado_rating"></div>
                                    <div class="quadrado_rating"></div>
                                    <span><span class="finalizado">{{$comentario->status}}</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @endif
                                <span style="color: white;">{{$comentario->content}}</span>
                                <div class="like">
                                    @if (auth()->check())
                                        <img style="cursor: pointer;" onclick="likeComment({{$comentario->id}}, {{$comentario->user_id}}, {{$game['id']}})" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" data-reviewCurtido="{{asset('svg/game/heart-svgrepo-com-red.svg')}}" data-semCurtida="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar comentário" id="like_comment">
                                    @else
                                        <img style="cursor: pointer;" onclick="redirectToLogin()" src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar comentário" id="like_comment">
                                    @endif
                                        <span id="comment_count">{{$comentario->likes_count}}</span>
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
