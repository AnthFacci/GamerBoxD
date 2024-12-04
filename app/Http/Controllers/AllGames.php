<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RAWG;
use DateTime;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AllGames extends Controller
{
    protected $RAWG;

    public function __construct(RAWG $RAWG) {
        $this->RAWG = $RAWG;
    }

    public function index(){
        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();
        return view('filtros', compact('informacoes_user'));
    }

    public function carregarJogos(Request $request){

        $dados = $request->all();
        $opcoes = [
            'page_size' =>12
        ];
        Log::info('Dados recebidos:', $dados);

        if (!$dados) {
            return response()->json(['error' => 'Nenhum checkbox marcado.'], 400); // 400 para erro de requisição
        }

        if(isset($dados['genres'])){
            $opcoes['genres'] = null;
        }
        elseif(isset($dados['platforms'])){
            $opcoes['platforms'] = null;
        }
        elseif(isset($dados['released'])){
            $dataParamsEmBreve = (new DateTime())->format('Y-m-d');
            $dataEmBreveFutura = (new DateTime())->modify('+2 months')->format('Y-m-d');
            $opcoes['ordering'] = 'released';
            $opcoes['dates'] = $dataParamsEmBreve .','. $dataEmBreveFutura;
            Log::info('Opções:', $opcoes);
        }


        foreach ($dados as $key => $value) {
            if($key == 'genres'){
                $opcoes['genres'] = implode(',',$value);
            }else if($key == 'platforms'){
                $opcoes['platforms'] = implode(',',$value);
            }
        }

        $games = $this->RAWG->makeRequest('games', $opcoes);


        // Retorna uma resposta JSON
        return json_encode($games);
    }

    public function carregarJogosByLink(Request $request){
        Log::info('ENTREI NESSA PORRA');
        $dados = $request->all();
        $nextLink = null;
        $previousLink = null;
        $content = null;
        Log::info($dados);


        if(isset($dados['next'])){
            $nextLink = $dados['next'];
            $content = $this->RAWG->makeRequestWithLink($nextLink);
        }elseif(isset($dados['previous'])){
            $previousLink = $dados['previous'];
            $content = $this->RAWG->makeRequestWithLink($previousLink);
        }
        else {
            Log::info("A chave 'next' não foi encontrada no array.");
        }

        return json_encode($content);
    }

    public function searchByName(Request $request){
        $dados = $request->all();
        $opcoes = [
            'page_size' =>12
        ];
        if(isset($dados['name'])){
            $opcoes['search'] = $dados['name'];
        }

        $games = $this->RAWG->makeRequest('games', $opcoes);

        return json_encode($games);
    }
}
