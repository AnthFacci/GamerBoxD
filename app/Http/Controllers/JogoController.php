<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RAWG;
use App\Models\Comment;
use App\Models\commentsreaction;
use App\Models\favorite;
use App\Models\playlist;
use Illuminate\Support\Facades\Log;
use App\Models\playlist_games;
use App\Models\User;

class JogoController extends Controller
{
    protected $RAWG;

    public function __construct(RAWG $rawg) {
        $this->RAWG = $rawg;
    }
    public function index($id){
        $userId = auth()->id();
        $favorite = Favorite::where('game_id', $id)
        ->where('user_id', $userId)
        ->first();
        if(isset($favorite->id)){
            $favorite = true;
        }else{
            $favorite = false;
        }
        Log::info($favorite . 'faovorito');
        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();
        $playlists = playlist::where('user_id', $userId)->get();
        $game = $this->RAWG->makeRequestById('games', $id);
        $stores = $this->RAWG->makeRequestTwoBar('games', 'stores', $id);
        $comments = Comment::with('user')->withCount('likes')->where('game_id', $id)->orderBy('created_at')->get();
        Log::info('Esse é o primeiro comentário: '. $comments);
        // Log::info($game);
        Log::info($stores);
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
