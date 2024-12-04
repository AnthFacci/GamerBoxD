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

class listGames extends Controller
{
    protected $RAWG;

    public function __construct(RAWG $rawg) {
        $this->RAWG = $rawg;
    }
    public function index(){
        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();
        $favoritos = favorite::where('user_id',$userId)->orderBy('created_at')->get();
        $games = new Collection();
        foreach ($favoritos as $favorito) {
            $gameId = $favorito->game_id;
            $gameData = $this->RAWG->makeRequestById('games', $gameId);
            if ($gameData) {
                $games->push($gameData);
            }
        }
        Log::info($favoritos);
        Log::info($games);
        return view('favorites', compact('games', 'informacoes_user'));
    }
    public function sessao(){
        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();
        $playlists = playlist::where('user_id', $userId)->get();
        session(['informacoes_user' => $informacoes_user]);
        Log::info($informacoes_user);
        Log::info($playlists);
        return view('dashboard', compact('informacoes_user', 'playlists'));
    }
    public function lista($id){
        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();
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
        Log::info($playlist);
        Log::info($games);
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
    public function remove_game($playlist_id, $game_id){
        $playlist_games = playlist_games::where('game_id', $game_id)
        ->where('playlist_id', $playlist_id)
        ->first();

        Log::info($playlist_games . 'PLAYLIST GAME');
        if ($playlist_games) {
        // Se o favorito existir, deleta
        $playlist_games->delete();
        return response()->json([
        'success' => true,
        'message' => 'Favorito removido com sucesso!',
        ]);
        }
    }
}
