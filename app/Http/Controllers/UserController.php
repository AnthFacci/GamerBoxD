<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\playlist;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected $cacheTime = 60;

    public function index($id){
        $cacheKeyUser = 'user_infos' . $id;

        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            Log::info($informacoes_user);
            Log::info($informacoes_user->likes);
            Log::info('Cache retornou informações do usuário!');
        }else{
            $informacoes_user = User::with('playlists.jogos', 'reviews.likes')->where('id', $id)->first();
            // $informacoes_user_playlist = playlist::where('user_id', $id)->get();
            Log::info($informacoes_user);
            Log::info($informacoes_user->likes);
            // Log::info($informacoes_user_playlist);
            // Log::info($informacoes_user->playlist);
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
        }

        return view('perfil', compact('informacoes_user'));
    }
}
