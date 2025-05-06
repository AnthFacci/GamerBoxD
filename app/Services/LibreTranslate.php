<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LibreTranslate
{
    private string $url;

    public function __construct() {
        $this->url = config('services.translate.base_uri');
    }

    public function makeRequest(string $text, string $from = 'en', string $to = 'pt'): ?string
    {
        $response = Http::post($this->url, [
            'q'         => $text,
            'source'    => $from,
            'target'    => $to
        ]);

        if ($response->successful()) {
            return $response->json()['translatedText'] ?? null;
        }

        return null;
    }
}
