<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImovelMapController extends Controller
{
    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('imovels.map');
    }
}
