<?php

namespace App\Services;

use Illuminate\Support\Facades\Http; // Para fazer requisições HTTP
use Illuminate\Support\Facades\Log;

class GamerPower
{
        protected $Url = 'https://gamerpower.com/api/giveaways?sort-by=popularity&sort-by=date';
        protected $Url_gift = 'https://gamerpower.com/api/giveaway?id=';

        public function makeRequest(){

            $response = Http::withHeaders([
            ])->get($this->Url);

            if ($response->failed()) {
                throw new \Exception("Erro ao fazer requisição: " . $response->body());
            }


            Log::info($response);
            return $response->json();
        }

        public function makeRequestIndividual($param_id){

            $this->Url_gift = $this->Url_gift . $param_id;

            $response = Http::withHeaders([
            ])->get($this->Url_gift);

            if ($response->failed()) {
                throw new \Exception("Erro ao fazer requisição: " . $response->body());
            }


            Log::info($response);
            return $response->json();
        }


}
