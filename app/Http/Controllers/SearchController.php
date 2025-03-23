<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');

        if(!$query){
            return response()->json([]);
        }

        $result = User::where('name', 'LIKE', "%". $query . "%")->orderBy('name', 'asc')->get();

        return response()->json($result);
    }
}
