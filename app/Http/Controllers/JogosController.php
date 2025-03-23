<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RAWG;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class JogosController extends Controller
{

    protected $RAWG;
    protected $cacheTime = 3600;
    protected $cacheKeyLancamentos = 'lancamentos_infos';
    protected $cacheKeyAcessados = 'Acessados_infos';
    protected $cacheKeyEmBreve = 'EmBreve_infos';
    protected $cacheKeyAvaliados = 'Avaliados_infos';

    public function __construct(RAWG $RAWG)
    {
        $this->RAWG = $RAWG;
    }

    public function index(){
        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();
        // Datas para o carousel lançamentos
        $dataParamsLanc = (new DateTime())->format('Y-m-d');
        $dataLancPassado = (new DateTime())->modify('-7 days')->format('Y-m-d');
        // Datas para o carousel de em breve
        $dataParamsEmBreve = (new DateTime())->format('Y-m-d');
        $dataEmBreveFutura = (new DateTime())->modify('+2 months')->format('Y-m-d');
        $paramsNovosLancamentos = [
            'ordering' => '-released,-rating',
            'dates' => $dataLancPassado . ',' . $dataParamsLanc,
        ];

        $paramsMaisAcessados = [
            'ordering' => '-added,-metacritic',
            'page_size' => '20',
        ];

        $paramsBreve = [
            'ordering' => '-released',
            'page_size' => '20',
            'dates' => $dataParamsEmBreve .','. $dataEmBreveFutura,
        ];

        $paramsMaisAvaliados = [
            'ordering' => '-rating',
            'page_size' => '20',
        ];

        if(Cache::has($this->cacheKeyLancamentos)){
            $dataLancamentos = Cache::get($this->cacheKeyLancamentos);
            Log::info('Carrousel de lançamentos os dados foram entregues pelo cache!');
        }else{
            $dataLancamentos = $this->RAWG->makeRequest('games', $paramsNovosLancamentos);
            cache::put($this->cacheKeyLancamentos, $dataLancamentos, $this->cacheTime);
        }

        if(Cache::has($this->cacheKeyAcessados)){
            $dataAcessados = Cache::get($this->cacheKeyAcessados);
            Log::info('Cache entregou os dados acessados');
        }else{
            $dataAcessados = $this->RAWG->makeRequest('games', $paramsMaisAcessados);
            Cache::put($this->cacheKeyAcessados, $dataAcessados, $this->cacheTime);
        }

        if(Cache::has($this->cacheKeyEmBreve)){
            $dataEmBreve = Cache::get($this->cacheKeyEmBreve);
            Log::info('Cache entregou os dados em breve');
        }else{
            $dataEmBreve = $this->RAWG->makeRequest('games', $paramsBreve);
            Cache::put($this->cacheKeyEmBreve, $dataEmBreve, $this->cacheTime);
        }

        if(Cache::has($this->cacheKeyAvaliados)){
            $dataAvaliados = Cache::get($this->cacheKeyAvaliados);
            Log::info('Cache entregou os dados avaliados');
        }else{
            $dataAvaliados = $this->RAWG->makeRequest('games', $paramsMaisAvaliados);
            Cache::put($this->cacheKeyAvaliados, $dataAvaliados, $this->cacheTime);
        }


        return view('jogos', compact('dataLancamentos', 'dataAcessados', 'dataEmBreve', 'dataAvaliados', 'informacoes_user'));
    }
}
