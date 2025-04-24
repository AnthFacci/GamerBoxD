<?php

namespace App\Services;

use Illuminate\Support\Facades\Http; // Para fazer requisições HTTP
use Illuminate\Support\Facades\Log;

class ApiNews
{
        protected $Url;
        protected $token = null;

        public function __construct()
        {
            $this->Url = config('ApiNews.Login.Url');
        }

        public function login(){

            $UrlLogin = $this->Url . '/users/login';

            $response = Http::withHeaders([
                'Accept'    => 'application/json',
            ])->withBody(json_encode([
                'email'     => config('ApiNews.Login.Email'),
                'password'  => config('ApiNews.Login.Password')
            ]), 'application/json')->post($UrlLogin);

            if ($response->failed()) {
                throw new \Exception("Erro ao fazer requisição: " . $response->body());
            }

            $this->token = $response['data'];
            return $response->json();
        }

        public function makeRequest(){

            if($this->token === null){
                $this->login();
            }

            $UrlNews = $this->Url . '/news';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
            ])->get($UrlNews);

            if ($response->failed()) {
                throw new \Exception("Erro ao fazer requisição: " . $response->body());
            }


            Log::info($response);
            return $response->json();
        }

}
