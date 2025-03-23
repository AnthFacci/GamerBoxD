<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecomendationController extends Controller
{
    public function index(){
        Log::info('Entrei na tela nova!');

        return view('recomendation');
    }
}
