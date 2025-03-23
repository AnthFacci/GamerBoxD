<x-guest-layout :informacoes_user="$informacoes_user">
    @push('scripts')
        <script src="{{ asset('js/home.js') }}" defer></script>
    @endpush
    @push('style')
        <link rel="stylesheet" href="{{asset('css/pagina_inicial.css')}}">
    @endpush
    <div class="Container--images">
        <div class="Container--images--card">
            <a href="{{route('jogo', ['id' => $data[0]['id']])}}">
                <img src="{{$data[0]['background_image']}}" alt="Imagem dentro da div">
            </a>
        </div>
        <div class="Container--images--card">
            <a href="{{route('jogo', ['id' => $data[1]['id']])}}">
                <img src="{{$data[1]['background_image']}}" alt="Imagem dentro da div">
            </a>
        </div>
        <div class="Container--images--card">
            <a href="{{route('jogo', ['id' => $data[2]['id']])}}">
                <img src="{{$data[2]['background_image']}}" alt="Imagem dentro da div">
            </a>
        </div>
        <div class="Container--images--card">
            <a href="{{route('jogo', ['id' => $data[3]['id']])}}">
                <img src="{{$data[3]['background_image']}}" alt="Imagem dentro da div">
            </a>
        </div>
        <div class="Container--images--card">
            <a href="{{route('jogo', ['id' => $data[4]['id']])}}">
                <img src="{{$data[4]['background_image']}}" alt="Imagem dentro da div">
            </a>
        </div>
        <div class="Container--images--card">
            <a href="{{route('jogo', ['id' => $data[5]['id']])}}">
                <img src="{{$data[5]['background_image']}}" alt="Imagem dentro da div">
            </a>
        </div>
        <div class="Container--images--card">
            <a href="{{route('jogo', ['id' => $data[6]['id']])}}">
                <img src="{{$data[6]['background_image']}}" alt="Imagem dentro da div">
            </a>
        </div>
    </div>
    <div class="Container--Ancor--Noticias">
        <a href="#giveways" class="Container--Ancor--Noticias--Ancor">
            <img src="{{asset('svg/down.svg')}}" alt="">
        </a>
    </div>
    <div class="Container--Main--Giveway" id="giveways">
        <div class="Container--Main--Giveway--Title">
            <h1>Ganhe jogos grátis e Brindes!</h1>
        </div>
        <div class="Container--Giveways">
            @foreach (array_slice($data_giveways, 0, 9) as $data)
                <div class="Container--Giveways--items">
                    <a href="{{route('premios', ['id' => $data['id']])}}" target="_blank">
                        <div class="Container--Giveways--items--ancor-img">
                            <img src="{{$data['image']}}" alt="">
                        </div>
                        <div class="Container--Giveways--items--ancor-infos">
                            <div class="Container--Giveways--items-ancor--infos-span">
                                <span>{{$data['title']}}</span>
                            </div>
                            <div class="Container--Giveways--items--ancor--infos--images">
                                @foreach (array_map('trim', explode(',', $data['platforms'])) as $platform)
                                    @if (Str::startsWith($platform, 'Playstation'))
                                        <img src="{{asset('svg/playstation.svg')}}" alt="">
                                    @elseif(Str::startsWith($platform, 'Xbox'))
                                        <img src="{{asset('svg/xbox.svg')}}" alt="">
                                    @elseif(Str::startsWith($platform, 'Nintendo'))
                                        <img src="{{asset('svg/nintendo-switch.svg')}}" alt="">
                                    @elseif ($platform == 'Steam')
                                        <img src="{{asset('svg/steam.svg')}}" alt="">
                                    @elseif ($platform == 'Android')
                                        <img src="{{asset('svg/android.svg')}}" alt="">
                                    @elseif ($platform == 'iOS')
                                        <img src="{{asset('svg/apple.svg')}}" alt="">
                                    @elseif (Str::startsWith($platform, 'Epic'))
                                        <img src="{{asset('svg/epic.svg')}}" alt="">
                                    @elseif($platform == 'Itch.io')
                                        <img src="{{asset('svg/itch-dot-io.svg')}}" alt="">
                                    @elseif($platform == 'PC')
                                        <img src="{{asset('svg/pc.svg')}}" alt="">
                                    @else
                                        <img src="{{asset('svg/broken-chain.svg')}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
