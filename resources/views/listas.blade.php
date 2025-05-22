<x-app-layout :informacoes_user="$informacoes_user">
    @push('style')
        <link rel="stylesheet" href="{{asset('css/perfil.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ asset('js/listas.js') }}" defer></script>
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
                    <a href="{{route('home')}}" class="nav-link_real">página inicial</a>
                    <a href="{{route('jogos')}}" class="nav-link_real">home</a>
                    <a href="{{route('catalogo')}}" class="nav-link_real">jogos</a>
                    <a href="{{route('dashboard')}}" class="nav-link_real"><img src="{{$informacoes_user->profile_photo_url}}" alt=""></a>
                </div>
            </div>
        </div>
    </nav> --}}

    <main class="fav my-5">
        @isset($playlist)
            <h1 class="text-center mb-4 title-custom">{{ $playlist->name }}</h1>
        @endisset
        <div class="listas-fav">
            @forelse ($games as $jogo)
            @if (intval($jogo['rating'] == 0))
                <div class="card_list" style="background-color: #BCBCBC;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_fav">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
                        <div class="nome_nota">
                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                            @if ($jogo['rating'] == 0)
                                <p class="nt_lancamento">-</p>
                            @else
                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating'])* 20)  }}</p>
                            @endif
                        </div>
                    </a>
                    <div class="excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista">
                        <p>Excluir</p>
                    </div>
                    {{-- <img src="{{asset('svg/bin-svgrepo-com.svg')}}" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista" class="trash-icon-lista"> --}}
                    {{-- <button class="btn-excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})">Excluir</button> --}}
                </div>
            @elseif (intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                <div class="card_list" style="background-color: #CC697B;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_fav">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
                        <div class="nome_nota">
                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                            @if ($jogo['rating'] == 0)
                                <p class="nt_lancamento">-</p>
                            @else
                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating'])* 20)  }}</p>
                            @endif
                        </div>
                    </a>
                    <div class="excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista">
                        <p>Excluir</p>
                    </div>
                    {{-- <img src="{{asset('svg/bin-svgrepo-com.svg')}}" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista" class="trash-icon-lista"> --}}
                    {{-- <button class="btn-excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})">Excluir</button> --}}
                </div>
            @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                <div class="card_list" style="background-color: #6ECC8E;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_fav">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
                        <div class="nome_nota">
                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                            @if ($jogo['rating'] == 0)
                                <p class="nt_lancamento">-</p>
                            @else
                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating'])* 20)  }}</p>
                            @endif
                        </div>
                    </a>
                    <div class="excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista">
                        <p>Excluir</p>
                    </div>
                    {{-- <img src="{{asset('svg/bin-svgrepo-com.svg')}}" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista" class="trash-icon-lista"> --}}
                    {{-- <button class="btn-excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})">Excluir</button> --}}
                </div>
            @else
                <div class="card_list" style="background-color: #53e584;">
                    <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                        <div class="img_card_list">
                            @if(empty($jogo['background_image']))
                                <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @else
                                <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento_fav">
                            @endif
                        </div>
                        <div class="nome_nota_list">
                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                            @if ($jogo['rating'] == 0)
                                <p class="nt_lancamento">-</p>
                            @else
                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating'])* 20)  }}</p>
                            @endif
                        </div>
                    </a>
                    <div class="excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista">
                        <p>Excluir</p>
                    </div>
                    {{-- <img src="{{asset('svg/bin-svgrepo-com.svg')}}" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})" alt="excluir lista" class="trash-icon-lista"> --}}
                    {{-- <button class="btn-excluir" onclick="excluirJogo(event, {{ $jogo['id'] }}, {{$playlist->id}})">Excluir</button> --}}
                </div>
            @endif
            @empty
            <h1 class="text-center mb-4 title-custom w-100 h1-custom-list">falta adicionar jogos na lista :-/</h1>
            @endforelse
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
