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
            <img src="{{$informacoes_user['profile_photo_url']}}" alt="">
        </div>
        <div class="main--content--perfil--playlist-reviews-likes">
            <div class="main--content--perfil--playlist-reviews-likes-tabsTitle">
                <button class="tabsTitle--tablinks" onclick="openCity(event, 'London')"><img src="{{asset('svg/playlist.svg')}}" alt=""></button>
                <button class="tabsTitle--tablinks" onclick="openCity(event, 'Paris')"><img src="{{asset('svg/mention.svg')}}" alt=""></button>
                <button class="tabsTitle--tablinks" onclick="openCity(event, 'Tokyo')"><img src="{{asset('svg/game/heart-svgrepo-com.svg')}}" alt=""></button>
            </div>
            <div class="main--content--perfil--playlist-reviews-likes--tabsContent">
                  <div id="London" class="tabcontent">
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

                  <div id="Paris" class="tabcontent">
                    @if(isset($informacoes_user->reviews) && count($informacoes_user->reviews) > 0)
                        @foreach ($informacoes_user->reviews as $review )
                            <div class="tabcontent--review">
                                <div class="tabcontent--review--img">
                                    <img src="#" alt="">
                                </div>
                                <div class="tabcontent--review--content">

                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Nenhuma review escrita :\</p>
                    @endif
                  </div>

                  <div id="Tokyo" class="tabcontent">
                    @if(isset($informacoes_user->likes) && count($informacoes_user->likes) > 0)
                        @foreach ($informacoes_user->likes as $like )
                            <div class="tabcontent--review">
                                <div class="tabcontent--review--img">
                                    <img src="#" alt="">
                                </div>
                                <div class="tabcontent--review--content">

                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Nenhuma review curtida :\</p>
                    @endif
                  </div>
            </div>
        </div>
    </div>
</x-guest-layout>
