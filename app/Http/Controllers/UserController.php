<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\playlist;
use App\Models\Comment;
use App\Services\RAWG;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected $RAWG;

    public function __construct(RAWG $RAWG) {
       $this->RAWG = $RAWG;
    }

    protected $cacheTime = 60;

    public function index($id){
        $cacheKeyUser = 'user_infos' . $id;

        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            Log::info('Cache retornou informações do usuário!');
            Log::info($informacoes_user->likes);
        }else{
            $informacoes_user = User::with('playlists.jogos', 'reviews.likes', 'likes.comment', 'likes.user')->where('id', $id)->first();
            foreach ($informacoes_user->reviews as $reviews) {
                $cacheKeyImage = 'game_screenshots_' . $reviews->game_id;

                if(Cache::has($cacheKeyImage)) {
                    $reviews->info_games = Cache::get($cacheKeyImage);
                } else {
                    $info_games = $this->RAWG->makeRequestTwoBar('games', 'screenshots', $reviews->game_id);
                    $reviews->info_games = $info_games;
                    Cache::put($cacheKeyImage, $info_games, $this->cacheTime);
                }
            }
            foreach ($informacoes_user->likes as $likes) {
                $cacheKeyImage = 'game_screenshots_likes' . $likes->comment->game_id;

                if(Cache::has($cacheKeyImage)) {
                    $likes->info_games = Cache::get($cacheKeyImage);
                } else {
                    $info_games = $this->RAWG->makeRequestTwoBar('games', 'screenshots', $likes->comment->game_id);
                    $likes->info_games = $info_games;
                    Cache::put($cacheKeyImage, $info_games, $this->cacheTime);
                }
            }

            Log::info($informacoes_user->likes);
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
        }

        return view('perfil', compact('informacoes_user'));
    }
}
