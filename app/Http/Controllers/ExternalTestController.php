<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExternalTestController extends Controller
{
    public function index()
    {
        $datas = Http::get('https://pokeapi.co/api/v2/pokemon?limit=151');

        $datas = $datas->object();

        return view('external', ['datas' => $datas->results]);
    }
}
