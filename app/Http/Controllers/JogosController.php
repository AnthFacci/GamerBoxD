<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RAWG;
use DateTime;
use Illuminate\Http\Request;

class JogosController extends Controller
{

    protected $RAWG;

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
            'ordering' => '-released',
            'dates' => $dataLancPassado . ',' . $dataParamsLanc,
        ];

        $paramsMaisAcessados = [
            'ordering' => '-added',
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

        $dataLancamentos = $this->RAWG->makeRequest('games', $paramsNovosLancamentos);
        $dataAcessados = $this->RAWG->makeRequest('games', $paramsMaisAcessados);
        $dataEmBreve = $this->RAWG->makeRequest('games', $paramsBreve);
        $dataAvaliados = $this->RAWG->makeRequest('games', $paramsMaisAvaliados);
        return view('jogos', compact('dataLancamentos', 'dataAcessados', 'dataEmBreve', 'dataAvaliados', 'informacoes_user'));
    }
}
