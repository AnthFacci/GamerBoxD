<x-guest-layout :informacoes_user="$informacoes_user">
    @push('style')
        <link rel="stylesheet" href="{{asset('css/gift.css')}}">
    @endpush

    <div class="container-main-card">
        <div class="container-main-card-primeiro">
            <div class="container-main-card-img">
                <img src="{{$data_giveways['image']}}" alt="">
            </div>
            <div class="container-main-card-title">
                <h1>{{$data_giveways['title']}}</h1>
            </div>
            <div class="container-main-card-informations">
                <span class="container-main-card-informations-titles">Plataformas</span>
                <div class="container-main-card-informations-img">
                    @foreach (array_map('trim', explode(',', $data_giveways['platforms'])) as $platform)
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
                <hr>
                    <div class="container-main-card-information-date">
                        <img src="{{asset('svg/date.svg')}}" alt="">
                        <span>{{$data_giveways['end_date']}}</span>
                    </div>
                <hr>
                    <div class="container-main-card-informations-type">
                        <span class="container-main-card-informations-type-titles">Tipo:</span>
                        <span>{{$data_giveways['type']}}</span>
                    </div>
            </div>
        </div>
        <div class="container-main-card-segundo">
            <div class="container-main-card-segundo-informations">
                <div class="container-main-card-segundo-informations-about">
                    <h1>Sobre este prêmio</h1>
                    <span>{{$data_giveways['description']}}</span>
                </div>
                <div class="container-main-card-segundo-informations-instructions">
                    <h1>Instruções</h1>
                    <span>{!! nl2br(e($data_giveways['instructions'])) !!}</span>
                </div>
            </div>
            <div class="container-main-card-segundo-actions">
                <div class="container-main-card-segundo-actions-graph">
                    <img src="{{asset('svg/graph.svg')}}" alt="">
                </div>
                <div class="container-main-card-segundo-actions-claimed">
                    <img src="{{asset('svg/people.svg')}}" alt="">
                    <span>{{$data_giveways['users']}}+</span>
                </div>
                <div class="container-main-card-segundo-actions-button">
                    <a href="{{$data_giveways['open_giveaway_url']}}" target="_blank"> Resgate o Prêmio</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
