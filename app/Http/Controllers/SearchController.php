<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{

    protected $cacheTime = 3600;

    public function index(Request $request)
    {
        $query = $request->query('q');

        if(!$query){
            return response()->json([]);
        }

        if(auth()->check()){
            $userId = auth()->id();
            $result = User::where('name', 'LIKE', "%". $query . "%")->where('id', '!=', $userId)->orderBy('name', 'asc')->get();
        }else{
            $result = User::where('name', 'LIKE', "%". $query . "%")->orderBy('name', 'asc')->get();
        }

        $result->transform(function ($user) {
            if ($user->picture) {
                $user->picture = 'data:image/jpeg;base64,' . base64_encode($user->picture);
            }
            return $user;
        });
        return response()->json($result);
    }

    public function searchScreen(){

        $userId = auth()->id();
        $cacheKeyUser = 'user_infos' . $userId;

        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            Log::info('Cache retornou informações do usuário!');
        }else{
            $informacoes_user = User::where('id', $userId)->first();
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
        }

        return view('search', compact('informacoes_user'));
    }
}
