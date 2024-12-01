<?php

namespace App\Services;

use Illuminate\Support\Facades\Http; // Para fazer requisições HTTP
use Illuminate\Support\Facades\Log;

class RAWG
{
    protected $baseUri;
    protected $apiKey;

    // Construtor para inicializar a base URI e a chave da API
    public function __construct()
    {
        $this->baseUri = config('services.api.base_uri');
        $this->apiKey = config('services.api.key');
    }

    // Método privado para centralizar a lógica de requisição
    public function makeRequest($endpoint, $params = [])
    {

        $params['key'] = $this->apiKey;
        $queryString = http_build_query($params);
        $url = "{$this->baseUri}{$endpoint}?{$queryString}";
        Log::info($url);
        $response = Http::withHeaders([
        ])->get($url);
        // Tratamento de erros ou formatação de resposta pode ser feito aqui
        if ($response->failed()) {
            throw new \Exception("Erro ao fazer requisição: " . $response->body());
        }

        return $response->json();
    }

    public function makeRequestWithLink($url){
        $response = Http::withHeaders([])->get($url);

        if ($response->failed()) {
            throw new \Exception("Erro ao fazer requisição: " . $response->body());
        }

        return $response->json();
    }

    public function makeRequestById($endpoint, $id){
        $url = "{$this->baseUri}{$endpoint}/{$id}?key={$this->apiKey}";
        Log::info($url);
        $response = Http::withHeaders([])->get($url);

        if ($response->failed()) {
            throw new \Exception("Erro ao fazer requisição: " . $response->body());
        }

        return $response->json();
    }

}
