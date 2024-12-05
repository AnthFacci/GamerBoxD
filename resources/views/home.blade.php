<x-guest-layout>
    @push('scripts')
        <script src="{{ asset('js/home.js') }}" defer></script>
    @endpush
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
    {{-- MAIN SECTION --}}
    <div class="container-fluid flex-grow-1 d-flex h-auto">
      <div class="flex-grow-1 d-flex justify-content-center align-items-center class-custom">
        <div class="normal">
            <div class="img">
                <img src="{{$data[0]['background_image']}}" alt="Imagem dentro da div" class="masked-image" id="imagemCruz">
            </div>
        </div>
        <div class="normal_three">
          <div class="d-flex justify-content-center align-items-center rounded-circle overflow-hidden custom-round-image" style="width: 180px; height: 180px;">
            <img src="{{$data[1]['background_image']}}" alt="Imagem dentro da div" class="w-100 h-100" style="object-fit: cover; object-position: center;" />
          </div>
          <div class="d-flex justify-content-center align-items-center rounded-circle overflow-hidden custom-round-image2" style="width: 180px; height: 180px;">
            <!-- <a href="{{route('jogo', ['id' => $data[0]['id']])}}"> -->
              <img src="{{$data[2]['background_image']}}" alt="Imagem dentro da div" class="w-100 h-100" style="object-fit: cover; object-position: center;" />
            <!-- </a> -->
          </div>
          <div class="d-flex justify-content-center align-items-center rounded-circle overflow-hidden custom-round-image" style="width: 180px; height: 180px;">
            <img src="{{$data[3]['background_image']}}" alt="Imagem dentro da div" class="w-100 h-100" style="object-fit: cover; object-position: center;" />
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
