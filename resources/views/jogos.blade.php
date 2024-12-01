<x-guest-layout>
    @push('scripts')
        <script src="{{ asset('js/jogos.js') }}" defer></script>
    @endpush
    <div class="text-white min-vh-100 d-flex flex-column">
      {{-- NAVBAR SECTION --}}
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
      {{-- MAIN SECTION --}}
        <div class="container-fluid flex-grow-1 d-flex flex-column h-auto mb-5">
            {{-- CAROUSEL DE LANÇAMENTOS --}}
            <div class="lancamentos">
                <h1>novos Lançamentos <small><a href="{{route('catalogo')}}">(ver tudo)</a></small></h1>
                <div class="carousel_lanc">
                    <div class="btn_hr">
                        <hr>
                        <div class="btn_caro">
                            <button id="right_lancamento"><img src="{{ asset('svg/right.svg') }}" alt="seta para direita carousel lançamentos" class="arrows"></button>
                            <button id="left_lancamento"><img src="{{ asset('svg/left.svg') }}" alt="seta para esquerda carousel lançamentos" class="arrows"></button>
                        </div>
                    </div>
                    <div class="cards_lancamentos" id="cards_lancamentos">
                        @foreach ($dataLancamentos['results'] as $jogo)
                            @if (intval($jogo['rating'] == 0))
                                <div class="card" style="background-color: #BCBCBC;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @elseif (intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                                <div class="card" style="background-color: #CC697B;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                                <div class="card" style="background-color: #6ECC8E;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="card" style="background-color: #53e584;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- CAROUSEL MAIS ACESSADOS --}}
            <div class="lancamentos">
                <h1>mais acessados <small><a href="{{route('catalogo')}}">(ver tudo)</a></small></h1>
                <div class="carousel_lanc">
                    <div class="btn_hr">
                        <hr>
                        <div class="btn_caro">
                            <button id="right_acessados"><img src="{{ asset('svg/right.svg') }}" alt="seta para direita carousel mais acessados" class="arrows"></button>
                            <button id="left_acessados"><img src="{{ asset('svg/left.svg') }}" alt="seta para esquerda carousel mais acessados" class="arrows"></button>
                        </div>
                    </div>
                    <div class="cards_acessados" id="cards_acessados">
                        @foreach ($dataAcessados['results'] as $jogo)
                            @if (intval($jogo['rating'] == 0))
                                <div class="card" style="background-color: #BCBCBC;">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                </div>
                            @elseif (intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                                <div class="card" style="background-color: #CC697B;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                                <div class="card" style="background-color: #6ECC8E;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="card" style="background-color: #53e584;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- CAROUSEL EM BREVE --}}
            <div class="lancamentos">
                <h1>em breve <small><a href="{{route('catalogo')}}">(ver tudo)</a></small></h1>
                <div class="carousel_lanc">
                    <div class="btn_hr">
                        <hr>
                        <div class="btn_caro">
                            <button id="right_breve"><img src="{{ asset('svg/right.svg') }}" alt="seta para direita carousel mais acessados" class="arrows"></button>
                            <button id="left_breve"><img src="{{ asset('svg/left.svg') }}" alt="seta para esquerda carousel mais acessados" class="arrows"></button>
                        </div>
                    </div>
                    <div class="cards_breve" id="cards_breve">
                        @foreach ($dataEmBreve['results'] as $jogo)
                            @if (intval($jogo['rating'] == 0))
                                <div class="card" style="background-color: #BCBCBC;">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                </div>
                            @elseif (intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                                <div class="card" style="background-color: #CC697B;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                                <div class="card" style="background-color: #6ECC8E;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="card" style="background-color: #53e584;">
                                    <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                    <div class="nome_nota">
                                        <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                        @if ($jogo['rating'] == 0)
                                            <p class="nt_lancamento">-</p>
                                        @else
                                            <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- CAROUSEL MAIS BEM AVALIADOS --}}
            <div class="lancamentos">
                <h1>mais bem avaliados <small><a href="{{route('catalogo')}}">(ver tudo)</a></small></h1>
                <div class="carousel_lanc">
                    <div class="btn_hr">
                        <hr>
                        <div class="btn_caro">
                            <button id="right_avaliados"><img src="{{ asset('svg/right.svg') }}" alt="seta para direita carousel mais avaliados" class="arrows"></button>
                            <button id="left_avaliados"><img src="{{ asset('svg/left.svg') }}" alt="seta para esquerda carousel mais avaliados" class="arrows"></button>
                        </div>
                    </div>
                    <div class="cards_avaliados" id="cards_avaliados">
                        @foreach ($dataAvaliados['results'] as $jogo)
                            @if (intval($jogo['rating'] == 0))
                                <div class="card" style="background-color: #BCBCBC;">
                                        <a href="">
                                            <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                            <div class="nome_nota">
                                                <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                                @if ($jogo['rating'] == 0)
                                                    <p class="nt_lancamento">-</p>
                                                @else
                                                    <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                                @endif
                                            </div>
                                        </a>
                                </div>
                            @elseif (intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                                <div class="card" style="background-color: #CC697B;">
                                    <a href="">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                                <div class="card" style="background-color: #6ECC8E;">
                                    <a href="">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @else
                                <div class="card" style="background-color: #53e584;">
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
  </x-guest-layout>
