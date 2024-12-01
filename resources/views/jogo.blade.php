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
        <nav class="navbar navbar-custom">
            <div class="container-fluid d-flex align-items-center justify-content-between px-5">
              <a class="navbar-brand text-white">Navbar</a>
              <div class="d-flex align-items-center g-3 form-ancor">
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </form>
                <div class="ancor-link">
                  <a href="{{route('login')}}">Login</a>
                  <a href="{{route('register')}}">Criar Conta</a>
                  <a href="#">Jogos</a>
                  <a href="#">Listas</a>
                </div>
              </div>
            </div>
        </nav>
        {{-- Main Section --}}
        <div class="container-fluid flex-grow-1 d-flex flex-column h-auto border border-danger" style="padding: 0px !important;">
            <div class="capa container-fluid" style="padding: 0px !important;">
                @if ((int)$game['metacritic'] <= 39)
                    <div class="cima" style="background-color: #CC697B;">
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}">
                        </div>
                        <div class="text">
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
                            <h3>{{$game['name']}}</h3>
                            <p>{{$game['description_raw']}}</p>
                            <div class="acoes">
                                <img src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                <img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking">
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
                                <span><span class="nota_jogo">{{$game['metacritic']}}</span>/100</span>
                                <hr>
                            </div>
                            <div class="generos">
                                @foreach ($game['genres'] as $generos )
                                    <span>{{$generos['name']}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @elseif ((int)$game['metacritic'] >= 40 && (int)$game['metacritic'] <= 74)
                    <div class="cima" style="background-color: #6ECC8E;">
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}">
                        </div>
                        <div class="text">
                            <h3>{{$game['name']}}</h3>
                            <p>{{$game['description_raw']}}</p>
                            <div class="acoes">
                                <img src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                <img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking">
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
                                <span><span class="nota_jogo">{{$game['metacritic']}}</span>/100</span>
                                <hr>
                            </div>
                            <div class="generos">
                                @foreach ($game['genres'] as $generos )
                                    <span>{{$generos['name']}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @elseif ((int)$game['metacritic'] >= 75)
                    <div class="cima" style="background-color: #53e584;">
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}">
                        </div>
                        <div class="text">
                            <h3>{{$game['name']}}</h3>
                            <p>{{$game['description_raw']}}</p>
                            <div class="acoes">
                                <img src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                <img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking">
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
                                <span><span class="nota_jogo">{{$game['metacritic']}}</span>/100</span>
                                <hr>
                            </div>
                            <div class="generos">
                                @foreach ($game['genres'] as $generos )
                                    <span>{{$generos['name']}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="cima" style="background-color: #BCBCBC;">
                        <div class="img_capa">
                            <img src="{{$game['background_image']}}" alt="capa do {{$game['name']}}">
                        </div>
                        <div class="text">
                            <h3>{{$game['name']}}</h3>
                            <p>{{$game['description_raw']}}</p>
                            <div class="acoes">
                                <img src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="Adicionar Jogo a lista" id="add_game">
                                <img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar Jogo" id="favoritar_game">
                                <img src="{{asset('svg/game/joystick-svgrepo-com.svg')}}" alt="Link para loja" id="store_game">
                            </div>
                            <div class="ranking">
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
                                <span><span class="nota_jogo">{{$game['metacritic']}}</span>/100</span>
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
                <div class="outras_imagens">
                    {{-- @foreach ( $game as $)

                    @endforeach --}}
                </div>
                <div class="user_comentarios">
                    @foreach ( $comments as $comentario )
                        <div class="comentario">
                            <div class="foto_usuario">
                                <img src="{{$comentario->user->profile_photo_url}}" alt="commentarios">
                            </div>
                            <div class="informações_comentario">
                                <span>{{$comentario->user->name}}</span>
                                @if ($comentario->rating >= 8)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <div class="quadrado_rating" style="background-color: #6ECC8E;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating >= 5)
                                <div class="rating">
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <div class="quadrado_rating" style="background-color:#96D9E0;"></div>
                                    <span><span class="finalizado">finalizado</span> em <span class="finalizado">{{$comentario->finalizado}}</span></span>
                                </div>
                                @elseif ($comentario->rating >= 1)
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
                                    <div class="quadrado_rating" style="background-color:#CC697B;"></div>
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
                                    <img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt="Favoritar comentário" id="like_comment">
                                    <span id="number_like">{{$comentario->likes_count}}</span>
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
