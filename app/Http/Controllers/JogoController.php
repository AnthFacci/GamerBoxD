<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LibreTranslate;
use App\Services\RAWG;
use App\Models\Comment;
use App\Models\commentsreaction;
use App\Models\favorite;
use App\Models\playlist;
use Illuminate\Support\Facades\Log;
use App\Models\playlist_games;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class JogoController extends Controller
{
    private $Translate;
    protected $RAWG;
    protected $cacheTime = 3600;

    public function __construct(RAWG $rawg, LibreTranslate $Translate) {
        $this->RAWG      = $rawg;
        $this->Translate = $Translate;
    }

    public function index($id){
        $userId = auth()->id();
        $cacheKeyUser = 'user_infos' . $userId;
        $cacheIsFavorite = 'IsFavorit'. $userId;
        $cachePlaylists = 'PlaylistsInsideGame' . $userId;
        $cacheGame = 'game_infos' . $id;
        $CacheStores = 'games_stores_infos' . $id;
        $CacheCommentOnGame = 'commentsOnGame' . $id;

        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            Log::info('Cache entregou os user info no games');
        }else{
            $informacoes_user = User::where('id', $userId)->first();
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
        }

        if(Cache::has($cacheIsFavorite)){
            $favorite = Cache::get($cacheIsFavorite);
            Log::info('O cache entregou o favorito!');
        }else{
            $favorite = Favorite::where('game_id', $id)
            ->where('user_id', $userId)
            ->first();
            if(isset($favorite->id)){
                $favorite = true;
            }else{
                $favorite = false;
            }

            Cache::put($cacheIsFavorite, $favorite, $this->cacheTime);
        }

        if(Cache::has($cachePlaylists)){
            $playlists = Cache::get($cachePlaylists);
            Log::info('Cache entregou a playlist dentro da pag jogo');
        }else{
            $playlists = playlist::where('user_id', $userId)->get();
            Cache::put($cachePlaylists, $playlists, $this->cacheTime);
        }

        if(Cache::has($cacheGame)){
            $game = Cache::get($cacheGame);
            Log::info('Cache entregou os dados do game');
        }else{
            $game = $this->RAWG->makeRequestById('games', $id);
            if($game['description_raw'] != null){
                $game['description_raw'] = $this->Translate->makeRequest($game['description_raw']);
            }
            Cache::put($cacheGame, $game, $this->cacheTime);
        }

        if(Cache::has($CacheStores)){
            $stores = Cache::get($CacheStores);
            Log::info('Cache entregou as infos stores do game!');
        }else{
            $stores = $this->RAWG->makeRequestTwoBar('games', 'stores', $id);
            Cache::put($CacheStores, $stores, $this->cacheTime);
        }

        if(Cache::has($CacheCommentOnGame)){
            $comments = Cache::get($CacheCommentOnGame);
            Log::info('Log entregou os comentários feitos no game!');
        }else{
            $comments = Comment::with('user')->withCount('likes')->where('game_id', $id)->orderBy('created_at')->get();
            Cache::put($CacheCommentOnGame, $comments, $this->cacheTime);
        }

        Log::info($game);
        // Log::info('Esse é o primeiro comentário: '. $comments);
        // Log::info($game);
        // Log::info($stores);
        // if($stores != null){
        //     $store = $stores[0]['url'];
        //     Log::info($store . 'eiittaa');
        // }
        return view('jogo', compact('game', 'comments', 'playlists', 'informacoes_user', 'favorite', 'stores'));
    }
    public function storeReview(Request $request)
    {
        $userId = auth()->id();
        Log::info('Requisição recebida: ', $request->all());
        Log::info('USERID: ' . $userId);

        // Validação
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'rating' => 'required|min:1|max:10',
        ]);

        // Lógica de armazenamento (exemplo)
        // Suponha que você tenha um modelo Review
        Log::info('Requisição feita: ' . json_encode($request->all()));
        try {
            Comment::create([
                'user_id' => $userId,
                'game_id' => $request->id_game, // Suponha que o ID do jogo esteja sendo enviado
                'content' => $validated['content'],
                'finalizado' => $request->finalizado,
                'rating' => $validated['rating'],
                'status' => $request->status,
            ]);
            Cache::forget('commentsOnGame' . $request->id_game);
            return response()->json([
                'success' => true,
                'message' => 'Review enviada com sucesso!',
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao salvar a review: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar a review. Tente novamente mais tarde.',
            ], 500);
        }
    }
    public function like(Request $request){
        Log::info($request);
        try {
            $like = commentsreaction::where('comment_id', $request->comment_id)
            ->where('user_id', $request->user_id)->first();
            Log::info($like);
            if($like){
                Log::info($like);
                $like->delete();
                Log::info('teste');
                Log::info($request->id_game);
                Cache::forget('commentsOnGame' . $request->id_game);
                return response()->json([
                    'success' => true,
                    'delete' => true,
                    'message' => 'Review descurtida!',
                ]);
            }else{
                commentsreaction::create([
                    'reaction_type' => $request->reaction_type,
                    'comment_id' => $request->comment_id,
                    'user_id' => $request->user_id
                ]);
                Log::info('teste triste');
                Cache::forget('commentsOnGame' . $request->id_game);
                return response()->json([
                    'success' => true,
                    'delete' => false,
                    'message' => 'Review curtida com sucesso!',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Erro ao salvar a review: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro ao curtir a review. Tente novamente mais tarde.',
            ], 500);
        }
    }
    public function favorite(Request $request){
        Log::info($request);
        $userId = auth()->id();

        try {
            // Verifica se o favorito já existe
            $favorite = Favorite::where('game_id', $request->game_id)
                                ->where('user_id', $userId)
                                ->first();

            if ($favorite) {
                // Se o favorito existir, deleta
                $favorite->delete();
                Cache::forget("favoritos_infos{$userId}");
                Cache::forget("IsFavorit{$userId}");
                return response()->json([
                    'success' => true,
                    'message' => 'Favorito removido com sucesso!',
                ]);
            } else {
                // Se o favorito não existir, cria um novo
                Favorite::create([
                    'game_id' => $request->game_id,
                    'user_id' => $userId
                ]);
                Cache::forget("favoritos_infos{$userId}");
                Cache::forget("IsFavorit{$userId}");
                return response()->json([
                    'success' => true,
                    'message' => 'Favorito adicionado com sucesso!',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Erro ao processar o favorito: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar o favorito. Tente novamente mais tarde.',
            ], 500);
        }
    }
    public function store_list(Request $request){
        try {
            // Verifica se o favorito já existe
            $GameInPlaylist = playlist_games::where('game_id', $request->id_game)
                                ->where('playlist_id', $request->id_playlist)
                                ->first();

            if ($GameInPlaylist) {
                return response()->json([
                    'success' => true,
                    'message' => 'Game Já existe na Lista',
                ]);
            } else {
                // Se o favorito não existir, cria um novo
                playlist_games::create([
                    'playlist_id' => $request->id_playlist,
                    'game_id' => $request->id_game
                ]);
                Cache::forget("playlist_games_info{$request->id_playlist}");
                return response()->json([
                    'success' => true,
                    'message' => 'Game adicionado com sucesso!',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Erro ao processar o Game na lista: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar o game. Tente novamente mais tarde.',
            ], 500);
        }
    }

}
