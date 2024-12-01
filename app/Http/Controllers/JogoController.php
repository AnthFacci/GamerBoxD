<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RAWG;
use App\Models\Comment;
use App\Models\commentsreaction;
use Illuminate\Support\Facades\Log;

class JogoController extends Controller
{
    protected $RAWG;

    public function __construct(RAWG $rawg) {
        $this->RAWG = $rawg;
    }
    public function index($id){
        $game = $this->RAWG->makeRequestById('games', $id);
        $comments = Comment::with('user')->withCount('likes')->where('game_id', $id)->orderBy('created_at')->get();
        Log::info('Esse é o primeiro comentário: '. $comments);
        return view('jogo', compact('game', 'comments'));
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
        try {
            Comment::create([
                'user_id' => $userId,
                'game_id' => $request->id_game, // Suponha que o ID do jogo esteja sendo enviado
                'content' => $validated['content'],
                'finalizado' => $request->finalizado,
                'rating' => $validated['rating'],
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

}
