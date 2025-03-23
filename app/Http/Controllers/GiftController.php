<?php

namespace App\Http\Controllers;
use App\Services\GamerPower;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class GiftController extends Controller
{
    protected $GamerPower;
    protected $Carbon;
    protected $cacheTime = 3600;

    public function __construct(GamerPower $GamerPower, Carbon $Carbon)
    {
        $this->GamerPower = $GamerPower;
        $this->Carbon = $Carbon;
    }

    public function index($id)
    {
        $cacheKey = 'giveways' . $id;

        $userId = auth()->id();
        $informacoes_user = User::where('id', $userId)->first();

        if(Cache::has($cacheKey)){
            Log::info('Dados do giveway especifico obtido por cache!');
            $data_giveways = Cache::get($cacheKey);
        }else{
            // Chamando api de giveways
            $data_giveways = $this->GamerPower->makeRequestIndividual($id);
            Cache::put($cacheKey, $data_giveways, $this->cacheTime);
        }

        if($data_giveways['end_date'] = 'N/A'){
            $data_giveways['end_date'] = 'Ativo indefinidamente';
        }else{
            $data_giveways['end_date'] = $this->Carbon::parse($data_giveways['end_date'])->format('d/m/Y');
        }

        return view('gift', compact('informacoes_user', 'data_giveways'));
    }
}
