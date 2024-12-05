<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RAWG;
use DateTime;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    protected $RAWG;

    public function __construct(RAWG $RAWG)
    {
        $this->RAWG = $RAWG;
    }

    public function index(){
        $dataParamsLanc = (new DateTime())->format('Y-m-d');
        $dataLancPassado = (new DateTime())->modify('-7 days')->format('Y-m-d');
        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();
        Log::info($informacoes_user);
        $params = [
            'page' => 1,
            'page_size' => 5,
            'ordering' => '-added',
            'dates' => $dataLancPassado . ',' . $dataParamsLanc,
        ];
        $data = $this->RAWG->makeRequest('games', $params);
        $data = $data['results'];
        // dd($data);
        return view('home', compact('data', 'informacoes_user'));
    }
}
