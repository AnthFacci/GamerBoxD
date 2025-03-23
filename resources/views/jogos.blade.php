<x-guest-layout :informacoes_user="$informacoes_user">
    @push('scripts')
        <script src="{{ asset('js/jogos.js') }}" defer></script>
    @endpush
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
      {{-- MAIN SECTION --}}
        <div class="container-fluid flex-grow-1 d-flex flex-column h-auto mb-5" style="margin-top: 60px;">
            {{-- CAROUSEL DE LANÇAMENTOS --}}
            {{-- <div class="lancamentos">
                <h1>novos Lançamentos <small><a href="{{route('catalogo')}}">(ver tudo)</a></small></h1>
                <div class="carousel_lanc">
                    <div class="btn_hr">
                        <hr>
                        <div class="btn_caro">
                            <button id="right_lancamento"><img src="{{ asset('svg/right.svg') }}" alt="seta para direita carousel lançamentos" class="arrows"></button>
                            <button id="left_lancamento"><img src="{{ asset('svg/left.svg') }}" alt="seta para esquerda carousel lançamentos" class="arrows"></button>
                        </div>
                    </div> --}}
                    {{-- <div class="cards_lancamentos" id="cards_lancamentos">
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
                    </div> --}}
                {{-- </div>
            </div> --}}
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
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @elseif (floatval($jogo['rating']) > 0 && floatval($jogo['rating'] <= 2 ))
                                <div class="card" style="background-color: #CC697B;">
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                @elseif (floatval($jogo['rating']) > 2 && floatval($jogo['rating'] <= 3.7 ))
                                <div class="card" style="background-color: #96D9E0;">
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
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
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                            @endif
                                        </div>
                                    </a>
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
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @elseif (floatval($jogo['rating']) > 0 && floatval($jogo['rating'] <= 2 ))
                                <div class="card" style="background-color: #CC697B;">
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @elseif (floatval($jogo['rating']) > 2 && floatval($jogo['rating'] <= 3.7 ))
                                <div class="card" style="background-color: #96D9E0;">
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
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
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                             @endif
                                        </div>
                                    </a>
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
                                        <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                            <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                            <div class="nome_nota">
                                                <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                                @if ($jogo['rating'] == 0)
                                                    <p class="nt_lancamento">-</p>
                                                @else
                                                    <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                                @endif
                                            </div>
                                        </a>
                                </div>
                            @elseif (floatval($jogo['rating']) > 0 && floatval($jogo['rating'] <= 2 ))
                                <div class="card" style="background-color: #CC697B;">
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                @elseif (floatval($jogo['rating']) > 2 && floatval($jogo['rating'] <= 3.7 ))
                                <div class="card" style="background-color: #96D9E0;">
                                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
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
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']) * 20) }}</p>
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
