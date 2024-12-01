<x-guest-layout>
    @push('scripts')
        <script src="{{ asset('js/home.js') }}" defer></script>
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
            <a href="{{route('jogos')}}">Jogos</a>
            <a href="#">Listas</a>
          </div>
        </div>
      </div>
    </nav>
    {{-- MAIN SECTION --}}
    <div class="container-fluid flex-grow-1 d-flex border border-danger h-auto">
      <div class="flex-grow-1 d-flex justify-content-center align-items-center class-custom">
        <div class="normal">
            <img src="{{$data[0]['background_image']}}" alt="Imagem dentro da div" class="masked-image" id="imagemCruz">
        </div>
        <div class="normal_three">
          <div class="d-flex justify-content-center align-items-center rounded-circle overflow-hidden custom-round-image1" style="width: 180px; height: 180px;">
            <img src="{{$data[1]['background_image']}}" alt="Imagem dentro da div" class="w-100 h-100" style="object-fit: cover; object-position: center;" />
          </div>
          <div class="d-flex justify-content-center align-items-center rounded-circle overflow-hidden custom-round-image2" style="width: 180px; height: 180px;">
            <img src="{{$data[2]['background_image']}}" alt="Imagem dentro da div" class="w-100 h-100" style="object-fit: cover; object-position: center;" />
          </div>
          <div class="d-flex justify-content-center align-items-center rounded-circle overflow-hidden custom-round-image3" style="width: 180px; height: 180px;">
            <img src="{{$data[3]['background_image']}}" alt="Imagem dentro da div" class="w-100 h-100" style="object-fit: cover; object-position: center;" />
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
