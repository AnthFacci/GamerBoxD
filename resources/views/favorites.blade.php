<x-app-layout :informacoes_user="$informacoes_user">
    @push('style')
        <link rel="stylesheet" href="{{asset('css/perfil.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ asset('js/favorites.js') }}" defer></script>
    @endpush
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
                    <a href="{{route('home')}}" class="nav-link_real">home</a>
                    <a href="{{route('jogos')}}" class="nav-link_real">jogos</a>
                    <a href="{{route('catalogo')}}" class="nav-link_real">filtros</a>
                    <a href="{{route('dashboard')}}" class="nav-link_real"><img src="{{$informacoes_user->profile_photo_url}}" alt=""></a>
                </div>
            </div>
        </div>
    </nav> --}}

    <main class="fav my-5">
        <h1 class="text-center mb-4" style="color: white;">favoritos</h1>
        <div class="listas-fav">
            @foreach ($games as $jogo)
            @if (intval($jogo['rating'] == 0))
                <div class="card_fav" style="background-color: #BCBCBC;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_fav">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
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
            @elseif (intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                <div class="card_fav" style="background-color: #CC697B;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_fav">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
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
            @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                <div class="card_fav" style="background-color: #6ECC8E;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_fav">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
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
                <div class="card_fav" style="background-color: #53e584;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_fav">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
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
      </main>

      @push('style')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      @endpush
      @push('style')
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      @endpush
      @push('style')
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      @endpush
      @push('style')
        <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      @endpush
</x-app-layout>
