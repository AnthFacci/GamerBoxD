<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RAWG;
use App\Services\GamerPower;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    protected $RAWG;
    protected $GamerPower;
    protected $userId;
    protected $cacheTime = 3600;
    protected $cacheKeyGames = 'games_infos';
    protected $cacheKeyGiveways = 'giveways_infos';

    public function __construct(RAWG $RAWG, GamerPower $GamerPower)
    {
        $this->RAWG = $RAWG;
        $this->GamerPower = $GamerPower;
    }

    public function index(){
        $userId = auth()->id();
        $cacheKeyUser = 'user_infos' . $userId;

        $dataParamsLanc = (new DateTime())->format('Y-m-d');
        $dataLancPassado = (new DateTime())->modify('-7 days')->format('Y-m-d');

        if(Cache::has($cacheKeyUser)){
            $informacoes_user = Cache::get($cacheKeyUser);
            Log::info('Cache entregou os dados do usuário!');
            Log::info($informacoes_user);
        }else{
            $informacoes_user = User::where('id', $userId)->first();
            Cache::put($cacheKeyUser, $informacoes_user, $this->cacheTime);
            Log::info($informacoes_user);
        }

        // $informacoes_user = User::where('id', $userId)->first();

        $params = [
            'page' => 1,
            'page_size' => 7,
            'ordering' => '-added,-rating',
            'dates' => $dataLancPassado . ',' . $dataParamsLanc,
        ];

        if(Cache::has($this->cacheKeyGames)){
            $data = Cache::get($this->cacheKeyGames);
            Log::info('O cache entreou os dados dos games!');
        }else{
            $data = $this->RAWG->makeRequest('games', $params);
            $data = $data['results'];
            Cache::put($this->cacheKeyGames, $data, $this->cacheTime);
        }

        // Chamando api de giveways
        if(Cache::has($this->cacheKeyGiveways)){
            $data_giveways = Cache::get($this->cacheKeyGiveways);
            Log::info('O cache entregou os dados do Giveways!');
        }else{
            $data_giveways = $this->GamerPower->makeRequest();
            Cache::put($this->cacheKeyGiveways, $data_giveways, $this->cacheTime);
        }

        return view('home', compact('data', 'informacoes_user', 'data_giveways'));
    }
}
