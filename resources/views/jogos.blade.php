<x-guest-layout :informacoes_user="$informacoes_user">
    @push('scripts')
        <script src="{{ asset('js/jogos.js') }}" defer></script>
    @endpush
    @push('style')
        <link rel="stylesheet" href="{{asset('css/home-carrosell.css')}}">
    @endpush
    <div class="container--carrossel">
        <div class="container--carrossel--2">
            <div class="container--carrossel--1--title">
                <h1>Mais Acessados 🔥</h1>
            </div>
            <div class="container--carrossel-images">
                <img src="{{asset('svg/right.svg')}}" class="container--carrossel-images-seta seta-esquerda">
                @foreach ($dataAcessados['results'] as $jogo)
                    @if(intval($jogo['rating'] == 0))
                        <div class="container--carrossel-images--jogos sem-nota">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif(intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                        <div class="container--carrossel-images--jogos ruim">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ $jogo['metacritic'] }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                        <div class="container--carrossel-images--jogos bom">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ $jogo['metacritic'] }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="container--carrossel-images--jogos otimo">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ $jogo['metacritic'] }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
                <img src="{{asset('svg/left.svg')}}" class="container--carrossel-images-seta seta-direita">
            </div>
        </div>
        <div class="container--carrossel--1">
            <div class="container--carrossel--1--title">
                <h1>Novos Lançamentos 🎮</h1>
            </div>
            <div class="container--carrossel-images">
                <img src="{{asset('svg/right.svg')}}" class="container--carrossel-images-seta seta-esquerda">
                @foreach ($dataLancamentos['results'] as $jogo)
                    @if(intval($jogo['rating'] == 0))
                        <div class="container--carrossel-images--jogos sem-nota">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif(intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                        <div class="container--carrossel-images--jogos ruim">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ number_format(intval($jogo['rating']) * 20) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                        <div class="container--carrossel-images--jogos bom">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ number_format(intval($jogo['rating']) * 20) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="container--carrossel-images--jogos otimo">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ number_format(intval($jogo['rating']) * 20) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
                <img src="{{asset('svg/left.svg')}}" class="container--carrossel-images-seta seta-direita">
            </div>
        </div>
        <div class="container--carrossel--4">
            <div class="container--carrossel--1--title">
                <h1>Maiores Notas ⭐</h1>
            </div>
            <div class="container--carrossel-images">
                <img src="{{asset('svg/right.svg')}}" class="container--carrossel-images-seta seta-esquerda">
                @foreach ($dataAvaliados['results'] as $jogo)
                    @if(intval($jogo['metacritic']) === 0)
                        <div class="container--carrossel-images--jogos sem-nota">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif(intval($jogo['metacritic']) >= 1 && intval($jogo['metacritic'] <= 49 ))
                        <div class="container--carrossel-images--jogos ruim">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ $jogo['metacritic'] }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif (intval($jogo['rating']) >= 50 && intval($jogo['rating'] <= 74 ))
                        <div class="container--carrossel-images--jogos bom">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ $jogo['metacritic'] }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="container--carrossel-images--jogos otimo">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{$jogo['metacritic']}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
                <img src="{{asset('svg/left.svg')}}" class="container--carrossel-images-seta seta-direita">
            </div>
        </div>
        <div class="container--carrossel--3">
            <div class="container--carrossel--1--title">
                <h1>Em breve ⏳</h1>
            </div>
            <div class="container--carrossel-images">
                <img src="{{asset('svg/right.svg')}}" class="container--carrossel-images-seta seta-esquerda">
                @foreach ($dataEmBreve['results'] as $jogo)
                    @if(intval($jogo['rating'] == 0))
                        <div class="container--carrossel-images--jogos sem-nota">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif(intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                        <div class="container--carrossel-images--jogos ruim">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ number_format(intval($jogo['rating'])* 20) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                        <div class="container--carrossel-images--jogos bom">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ number_format(intval($jogo['rating'])* 20) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="container--carrossel-images--jogos otimo">
                            <a href="{{route('jogo', ['id' => $jogo['id']])}}">
                                <div class="container--carrossel-images--jogos--img">
                                    @if(empty($jogo['background_image']))
                                        <img src="{{asset('svg/no-image.png')}}" alt="imagem do {{$jogo['name']}}">
                                    @else
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}">
                                    @endif
                                </div>
                                <div class="container--carrossel-images--jogos--title">
                                    <div class="container--carrossel-images--jogos--title--nome">
                                        <p class="name">{{ $jogo['name'] }}</p>
                                    </div>
                                    <div class="container--carrossel-images--jogos--title--nota">
                                        <p class="rating">{{ number_format(intval($jogo['rating'])* 20) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
                <img src="{{asset('svg/left.svg')}}" class="container--carrossel-images-seta seta-direita">
            </div>
        </div>
    </div>
</x-guest-layout>
