<?php

namespace App\Services;

use Illuminate\Support\Facades\Http; // Para fazer requisições HTTP

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
        $response = Http::withHeaders([
        ])->get($url);     
        // Tratamento de erros ou formatação de resposta pode ser feito aqui
        if ($response->failed()) {
            throw new \Exception("Erro ao fazer requisição: " . $response->body());
        }
    
        return $response->json(); 
    }
}
