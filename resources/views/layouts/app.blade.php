@props(['informacoes_user'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="{{asset('css/layout_guest.css')}}" rel="stylesheet" />
        {{-- Script JS --}}
        <script src="{{asset('js/layout_guest.js')}}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
        @stack('style')
        @stack('style')
        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="Main--container">
            <header>
                <nav class="navbar">
                        <div class="navbar--image">
                            <a href="{{route('home')}}">
                                <img src="{{asset('svg/logo.png')}}" alt="logo gamerboxd" width="auto" height="auto" loading="lazy">
                            </a>
                        </div>

                        {{-- <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> --}}
                        <span class="menu-toggle" id="menu-toggle" aria-expanded="false">☰</span>

                        <div class="navbar--ancors" id="navbarNav">
                            <div class="navbar--ancors-limit" id="navbarNavLimit">
                                @if (auth()->check())
                                    <a href="#" id="btn-show-search" class="navbar--ancors--limite--children" aria-expanded="false"><img src="{{asset('svg/search.svg')}}" alt="" class="navbar--ancors--limite--children-img"></a>
                                    <a href="{{route('home')}}" class="navbar--ancors--limite--children">Home</a>
                                    <a href="{{route('jogos')}}" class="navbar--ancors--limite--children">Em Alta</a>
                                    <a href="{{route('catalogo')}}" class="navbar--ancors--limite--children">Jogos</a>
                                    @if (isset($informacoes_user->picture))
                                        <a href="{{route('dashboard')}}" class="navbar--ancors--limite--children"><img src="data:image/jpeg;base64,{{ base64_encode($informacoes_user->picture) }}" alt=""></a>
                                    @else
                                        <a href="{{route('dashboard')}}" class="navbar--ancors--limite--children"><img src="{{$informacoes_user->profile_photo_url}}" alt=""></a>
                                    @endif
                                @else
                                    <a href="#" id="btn-show-search" class="navbar--ancors--limite--children" aria-expanded="false"><img src="{{asset('svg/search.svg')}}" alt="" class="navbar--ancors--limite--children-img"></a>
                                    <a href="{{route('home')}}" class="navbar--ancors--limite--children" >Home</a>
                                    <a href="{{route('jogos')}}" class="navbar--ancors--limite--children">Em Alta</a>
                                    <a href="{{route('catalogo')}}" class="navbar--ancors--limite--children">Jogos</a>
                                    <a href="{{route('login')}}" class="navbar--ancors--limite--children">Login</a>
                                    <a href="{{route('register')}}" class="navbar--ancors--limite--children">Criar Conta</a>
                                @endif
                            </div>
                        </div>
                </nav>
            </header>
            <div class="main--search">
                <div class="main--search--input">
                    <input type="text" name="search_user" id="search_user" placeholder="Digite o nome do usuário">
                    <img src="{{asset('svg/search.svg')}}" alt="">
                </div>
                <div class="main--search--result" id="main--search--result">

                </div>
                <div class="main--search--full--page">
                    <a href="{{route('search.screen')}}">Acesse a página de pesquisa completa</a>
                    <span>Máximo: Quatro resultados</span>
                </div>
            </div>
            <div class="main--content">
                {{ $slot }}
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')
        @stack('scripts')
        @stack('scripts')
        @stack('scripts')
    </body>
</html>
