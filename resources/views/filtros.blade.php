<x-guest-layout>
    @push('scripts')
        <script type="module" src="{{ asset('js/filtros.js') }}" defer></script>
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
    @push('style')
        <link rel="stylesheet" href="{{asset('css/filtros.css')}}">
    @endpush
    @push('style')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <div class="container-fluid flex-grow-1 d-flex h-auto mt-4 custom-padding">
            <div class="filtros">
                <div class="titulo">
                    <h1>filtros</h1><small><a href="">limpar</a></small>
                </div>
                <hr>
                {{-- Filtro categoria --}}
                <div class="categoria">
                    <form action="" method="get" class="form_categoria">
                        <h1>categoria</h1>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="action" id="acao" name="genres[]">
                            <label class="form-check-label" for="acao">
                              ação
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="adventure" id="aventura" name="genres[]">
                            <label class="form-check-label" for="aventura">
                              aventura
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="casual" id="casual" name="genres[]">
                            <label class="form-check-label" for="casual">
                              casual
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="racing" id="corrida" name="genres[]">
                            <label class="form-check-label" for="corrida">
                              corrida
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="sports" id="esportes" name="genres[]">
                            <label class="form-check-label" for="esportes">
                              esportes
                            </label>
                        </div>
                    </form>
                </div>
                <hr>
                 {{-- Filtro plataforma --}}
                 <div class="plataforma">
                    <form action="" method="get" class="form_plataforma">
                        <h1>categoria</h1>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="8" id="3ds" name="platforms[]">
                            <label class="form-check-label" for="3ds">
                              nintendo 3ds
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="7" id="switch" name="platforms[]">
                            <label class="form-check-label" for="switch">
                              nitendo switch
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="4" id="pc" name="platforms[]">
                            <label class="form-check-label" for="pc">
                              pc
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="187" id="ps5" name="platforms[]">
                            <label class="form-check-label" for="ps5">
                              playstation 5
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="186" id="xbpx" name="platforms[]">
                            <label class="form-check-label" for="xbpx">
                              xbox series x/s
                            </label>
                        </div>
                    </form>
                </div>
                <hr>
                {{-- Filtro lançamentos --}}

                <div class="lancamentos">
                    <form action="" method="get" class="form_lancamentos">
                        <h1>lançamentos</h1>
                        <div class="form-group d-flex flex-column">
                            <input type="range" class="custom-range" min="1958" max="2024" step="0.5" id="anos_lancamento">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>1958</span>
                                {{-- Depois colocar de forma dinâmica o ano atual --}}
                                <span>2024</span>
                            </div>
                         </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="released" id="embreve" name="released">
                            <label class="form-check-label" for="embreve">
                              em breve
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="jogos">
                <div class="pesquisa_ordenar">
                    <form action="" method="get">
                        <div id="search">
                            <input type="text" name="jogo_especifico" id="jogo_input" placeholder="pesquisa" class="jogo_input">
                            <button id="pesquisar"><i class="fas fa-search"></i></button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-custom d-flex justify-center align-items-center align-content-center   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              <span>Action</span>
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                          </div>
                    </form>
                </div>

                <div class="all_games" id="all_games">
                    <div class="card_jogos" id="card_jogos"></div>
                    {{-- <div class="pagination">
                        <div class="previous"><span>anterior</span></div>
                        <div class="paginas">
                            <div class="pag_anterior" id="pag_anterior"><span>1</span></div>
                            <div class="pag_atual" id="pag_atual"><span>2</span></div>
                            <div class="pag_prox" id="pag_prox"><span>3</span></div>
                        </div>
                        <div class="next">próximo</div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
