<x-app-layout :informacoes_user="$informacoes_user">
    @push('style')
        <link rel="stylesheet" href="{{asset('css/perfil.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ asset('js/dashboard.js') }}" defer></script>
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

    <main class="container my-5">
        <div class="foto_nome">
            <div class="infos">
                {{-- <img src="{{$informacoes_user->profile_photo_url}}" alt=""> --}}
                <img
                 src="data:image/jpeg;base64,{{ base64_encode($informacoes_user->picture) }}"
                 alt="Foto do usuário">
                <span>{{$informacoes_user->name}}</span>
            </div>
            <div class="actions">
                <a href="{{route('perfil.user', ['id' => $informacoes_user->id])}}" id="see_profile" aria-expanded="false"><img src="{{asset('svg/eye-quadrado.svg')}}" alt=""></a>
                <a href="#" id="form_image" aria-expanded="false"><img src="{{asset('svg/edit.svg')}}" alt=""></a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <img src="{{ asset('svg/exit-svgrepo-com.svg') }}" alt="deslogar" class="img_deslogar">
                    </button>
                </form>
            </div>
        </div>
        <div class="listas">
            <a href="{{route('favorites')}}">
                <div class="favoritos fix-box">
                    <span>favoritos</span>
                </div>
            </a>
            @foreach ($playlists as $playlist)
            <a href="{{route('listas', ['id' => $playlist->id])}}" class="ancor_lista">
                <div class="favoritos fix-box">
                    <span>{{$playlist->name}}</span>
                    <img src="{{asset('svg/bin-svgrepo-com.svg')}}" onclick="excluirJogo(event, {{ $informacoes_user->id }}, {{$playlist->id}})" alt="excluir lista" class="trash-icon">
                </div>
            </a>
            @endforeach
            <div class="adicionar_lista">
                <img onclick="addPlaylist()" src="{{asset('svg/game/plus-svgrepo-com.svg')}}" alt="adicionar nova lista">
         </div>

        <div class="add_picture" id="add_picture">
            <form action="{{route('store.picture')}}" method="post" id="form_picture">
                @csrf
                <input type="file" name="imagem">
                <button type="submit">Enviar</button>
            </form>
        </div>
        <div class="menu_listas" id="menuListas">
                    {{-- <input class="input_menuListas" type="text" placeholder="pesquisar listas" id="pesquisar"> --}}
                    <input class="input_menuListas" type="text" placeholder="adicione uma nova lista" name="nm_lista" id="nm_lista">
                    <button class="btn-criar" id="btn-criar">+ criar nova lista</button>
                    <hr>
                    <ul>
                        @foreach ($playlists as $playlist )
                            <li><a href="{{route('listas', ['id' => $playlist->id])}}">{{$playlist->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
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
