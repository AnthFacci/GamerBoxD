<x-guest-layout :informacoes_user="$informacoes_user">
    @push('scripts')
        <script src="{{ asset('js/perfil_user.js') }}" defer></script>
    @endpush
    @push('style')
        <link rel="stylesheet" href="{{asset('css/perfil_user.css')}}">
    @endpush
    <div class="main--content--perfil">
        <div class="main--content--perfil--fotos--titulos">
            <h1>{{$informacoes_user['name']}}</h1>
            @if (isset($informacoes_user['picture']))
                <?php
                    Log::info($informacoes_user->toArray());
                ?>
                <img src="data:image/jpeg;base64,{{ base64_encode($informacoes_user['picture']) }}" alt="">
            @else
                <img src="{{$informacoes_user['profile_photo_url']}}" alt="">
            @endif
        </div>
        <div class="main--content--perfil--playlist-reviews-likes">
            <div class="main--content--perfil--playlist-reviews-likes-tabsTitle">
                <button class="tabsTitle--tablinks" onclick="openTab(event, 'playlist')"><img src="{{asset('svg/playlist.svg')}}" alt=""></button>
                <button class="tabsTitle--tablinks" onclick="openTab(event, 'reviews')"><img src="{{asset('svg/mention.svg')}}" alt=""></button>
                <button class="tabsTitle--tablinks" onclick="openTab(event, 'likes')"><img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt=""></button>
            </div>
            <div class="main--content--perfil--playlist-reviews-likes--tabsContent">
                  <div id="playlist" class="tabcontent">
                    @if(isset($informacoes_user->playlists) && count($informacoes_user->playlists) > 0)
                        @foreach ($informacoes_user->playlists as $playlist)
                            <div class="tabcontent--playlist">
                                <span>{{$playlist->name}}</span>
                            </div>
                        @endforeach
                    @else
                        <p>Nenhuma playlist encontrada.</p>
                    @endif
                  </div>

                  <div id="reviews" class="tabcontent">
                    @if(isset($informacoes_user->reviews) && count($informacoes_user->reviews) > 0)
                        @foreach ($informacoes_user->reviews as $review )
                            <a href="{{route('jogo', ['id' => $review->game_id])}}" class="tabcontent--review">
                                <div class="tabcontent--review--img">
                                    <img src="{{$review->info_games['results'][0]['image'] ?? null}}" alt="">
                                </div>
                                <div class="tabcontent--review--content">
                                    <div class="tabcontent--review--content--message">
                                        <span>{{$review->content}}</span>
                                    </div>
                                    <div class="tabcontent--review--content--informations">
                                        <div class="tabcontent--review--content--informations--platform--rating">
                                            <div class="platform">
                                                @if (Str::startsWith($review->finalizado, 'playstation'))
                                                    <img src="{{asset('svg/playstation.svg')}}" alt="">
                                                @elseif(Str::startsWith($review->finalizado, 'xbox'))
                                                    <img src="{{asset('svg/xbox.svg')}}" alt="">
                                                @elseif(Str::startsWith($review->finalizado, 'switch'))
                                                    <img src="{{asset('svg/nintendo-switch.svg')}}" alt="">
                                                @elseif(Str::startsWith($review->finalizado, 'pc'))
                                                    <img src="{{asset('svg/pc.svg')}}" alt="">
                                                @endif
                                            </div>
                                            <div class="raiting">
                                                @if ((int)$review->rating <= 4)
                                                    <div class="quadrado ruim"></div>
                                                    <div class="quadrado ruim"></div>
                                                    <div class="quadrado ruim"></div>
                                                @elseif ((int)$review->rating >= 5 && (int)$review->rating <= 7)
                                                    <div class="quadrado mid"></div>
                                                    <div class="quadrado mid"></div>
                                                    <div class="quadrado mid"></div>
                                                @elseif ((int)$review->rating >= 8 && (int)$review->rating <= 10)
                                                    <div class="quadrado bom"></div>
                                                    <div class="quadrado bom"></div>
                                                    <div class="quadrado bom"></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tabcontent--review--content--informations--status">
                                            <span>{{$review->status}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p>Nenhuma review escrita :\</p>
                    @endif
                  </div>

                  <div id="likes" class="tabcontent">
                    @if(isset($informacoes_user->likes) && count($informacoes_user->likes) > 0)
                        @foreach ($informacoes_user->likes as $like )
                            <a href="{{route('perfil.user', ['id' => $like->user->id])}}" class="tabcontent--review">
                                <div class="tabcontent--review--img">
                                    <img src="{{$like->info_games['results'][0]['image'] ?? null}}" alt="">
                                </div>
                                <div class="tabcontent--review--content">
                                    <div class="tabcontent--review--content--message">
                                        <span>{{$like->comment->content}}</span>
                                    </div>
                                    <div class="tabcontent--review--content--informations">
                                        <div class="tabcontent--review--content--informations--platform--rating">
                                            <div class="platform">
                                                @if (Str::startsWith($review->finalizado, 'playstation'))
                                                    <img src="{{asset('svg/playstation.svg')}}" alt="">
                                                @elseif(Str::startsWith($review->finalizado, 'xbox'))
                                                    <img src="{{asset('svg/xbox.svg')}}" alt="">
                                                @elseif(Str::startsWith($review->finalizado, 'switch'))
                                                    <img src="{{asset('svg/nintendo-switch.svg')}}" alt="">
                                                @elseif(Str::startsWith($review->finalizado, 'pc'))
                                                    <img src="{{asset('svg/pc.svg')}}" alt="">
                                                @endif
                                            </div>
                                            <div class="raiting">
                                                @if ((int)$like->comment->rating <= 4)
                                                    <div class="quadrado ruim"></div>
                                                    <div class="quadrado ruim"></div>
                                                    <div class="quadrado ruim"></div>
                                                @elseif ((int)$like->comment->rating >= 5 && (int)$like->comment->rating <= 7)
                                                    <div class="quadrado mid"></div>
                                                    <div class="quadrado mid"></div>
                                                    <div class="quadrado mid"></div>
                                                @elseif ((int)$like->comment->rating >= 8 && (int)$like->comment->rating <= 10)
                                                    <div class="quadrado bom"></div>
                                                    <div class="quadrado bom"></div>
                                                    <div class="quadrado bom"></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tabcontent--review--content--informations--status">
                                            <span>{{$like->comment->status}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p>Nenhuma review curtida :\</p>
                    @endif
                  </div>
            </div>
        </div>
    </div>
</x-guest-layout>
