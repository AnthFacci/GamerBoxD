<?php

namespace App\Http\Controllers;
use App\Models\favorite;
use App\Models\playlist;
use App\Models\playlist_games;
use App\Services\RAWG;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class listGames extends Controller
{
    protected $RAWG;
    protected $userId;
    protected $cacheTime = 3600;
    protected $cacheKeyUser;

    public function __construct(RAWG $rawg) {
        $this->RAWG = $rawg;
    }

    public function index(){

        $userId = auth()->id();
        $cacheKeyUser = 'user_infos' . $userId;
        $cacheKeyFavoritos = 'favoritos_infos' . $userId;

        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            Log::info('Cache entregou info users favoritos!');
        }else{
            $informacoes_user = User::where('id', $userId)->first();
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
        }

        // $informacoes_user = User::where('id', $this->userId)->first();

        if(Cache::has($cacheKeyFavoritos)){
            $games = Cache::get($cacheKeyFavoritos);
            Log::info('Cache entregou os favoritos!');
        }else{
            $favoritos = favorite::where('user_id',$userId)->orderBy('created_at')->get();
            $games = new Collection();
            foreach ($favoritos as $favorito) {
                $gameId = $favorito->game_id;
                $gameData = $this->RAWG->makeRequestById('games', $gameId);
                if ($gameData) {
                    $games->push($gameData);
                }
            }
            Cache::put($cacheKeyFavoritos, $games, $this->cacheTime);
        }

        // $favoritos = favorite::where('user_id',$this->userId)->orderBy('created_at')->get();
        // $games = new Collection();
        // foreach ($favoritos as $favorito) {
        //     $gameId = $favorito->game_id;
        //     $gameData = $this->RAWG->makeRequestById('games', $gameId);
        //     if ($gameData) {
        //         $games->push($gameData);
        //     }
        // }

        return view('favorites', compact('games', 'informacoes_user'));
    }

    public function sessao(){

        $userId = auth()->id();
        $cacheKeyUser = 'user_infos' . $userId;
        $cacheKeyPlaylists = 'Playlists_infos' . $userId;

        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            // var_dump($informacoes_user);
            Log::info('Cache entregou info users dashboard!');
        }else{
            $informacoes_user = User::where('id', $userId)->first();
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
        }

        // $informacoes_user = User::where('id', $this->userId)->first();
        // Log::info($informacoes_user . 'oi');

        if(Cache::has($cacheKeyPlaylists)){
            $playlists = Cache::get($cacheKeyPlaylists);
            Log::info('Cache entregou os dados das playlists!');
        }else{
            $playlists = playlist::where('user_id', $userId)->get();
            Cache::put($cacheKeyPlaylists, $playlists, $this->cacheTime);
        }

        // $playlists = playlist::where('user_id', $this->userId)->get();

        session(['informacoes_user' => $informacoes_user]);
        // Log::info($informacoes_user);
        // dd($informacoes_user);
        return view('dashboard', compact('informacoes_user', 'playlists'));
    }

    public function lista($id){
        $userId = auth()->id();
        $cacheKeyUser = 'user_infos' . $userId;
        $cacheKeyPlaylist = 'playlist_info' . $id;
        $cacheKeyPlaylistGames = 'playlist_games_info' . $id;
        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            Log::info('Cache entregou as infos do usuário na playlist!');
        }else{
            $informacoes_user = User::where('id', $userId)->first();
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
        }

        if(Cache::has($cacheKeyPlaylistGames) && Cache::has($cacheKeyPlaylist)){
            $playlist = Cache::get($cacheKeyPlaylist);
            $games = Cache::get($cacheKeyPlaylistGames);
            Log::info('Cache entregou os games da playlist');
        }else{
            $favoritos = playlist_games::with('playlist')->where('playlist_id',$id)->orderBy('created_at')->get();
            $playlist = $favoritos->first()?->playlist;
            $games = new Collection();
            foreach ($favoritos as $favorito) {
                $gameId = $favorito->game_id; // Supondo que o campo seja 'game_id'
                $gameData = $this->RAWG->makeRequestById('games', $gameId); // Fazendo a requisição
                if ($gameData) {
                    $games->push($gameData); // Adiciona o dado do jogo na coleção
                }
            }
            Cache::put($cacheKeyPlaylist, $playlist, $this->cacheTime);
            Cache::put($cacheKeyPlaylistGames, $games, $this->cacheTime);
        }

        return view('listas', compact('games', 'playlist', 'informacoes_user'));
    }

    public function store_list(Request $request){
        $userId = auth()->id();

        Log::info('Request seco: ', ['request' => $request]);
        Log::info('Request All: ', ['data' => $request->all()]);

        try {
            playlist::create([
                'user_id' =>$userId,
                'name' => $request->name
            ]);
            Cache::forget("Playlists_infos{$userId}");
            Cache::forget("PlaylistsInsideGame{$userId}");
            return response()->json([
                'success' => true,
                'message' => 'Sucesso ao cadastrar nova lista.',
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar a review. Tente novamente mais tarde.',
            ], 500);
        }
    }

    public function store_picture (Request $request)
    {
        try {
            $userId = auth()->id();

            if ($request->hasFile('imagem')) {
                $arquivo = $request->file('imagem');
                $conteudo = file_get_contents($arquivo);
                User::where('id', $userId)->update(['picture' => $conteudo]);
            }

            Cache::forget('user_infos' . $userId);
            return response()->json([
                'success' => true,
                'message' => 'Imagem atualizada com sucesso',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 500);
        }
    }

    public function remove_game($playlist_id, $game_id){
        $playlist_games = playlist_games::where('game_id', $game_id)
        ->where('playlist_id', $playlist_id)
        ->first();

        Log::info($playlist_games . 'PLAYLIST GAME');
        if ($playlist_games) {
        // Se o favorito existir, deleta
        $playlist_games->delete();

        Cache::forget("playlist_games_info{$playlist_id}");

        return response()->json([
        'success' => true,
        'message' => 'Favorito removido com sucesso!',
        ]);
        }
    }

    public function remove_list($playlist_id, $user_id){
        $playlist = playlist::where('user_id', $user_id)
        ->where('id', $playlist_id)
        ->first();

        Log::info($playlist . 'PLAYLIST GAME');
        if ($playlist) {
        // Se o favorito existir, deleta
        $playlist->delete();
        Cache::forget("Playlists_infos{$user_id}");
        return response()->json([
        'success' => true,
        'message' => 'Favorito removido com sucesso!',
        ]);
        }
    }
}
