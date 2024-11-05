<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RAWG;

class HomeController extends Controller
{

    protected $RAWG;

    public function __construct(RAWG $RAWG)
    {
        $this->RAWG = $RAWG; 
    }

    public function index(){
        $params = [
            'page' => 1,
            'page_size' => 5,
            'ordering' => '-added',
            'dates' => '2024-09-01,2024-10-31'
        ];
        $data = $this->RAWG->makeRequest('games', $params);
        $data = $data['results'];
        // dd($data);
        return view('home', compact('data'));
    }
}
