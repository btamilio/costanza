<?php

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class APIController extends Controller
{


    public function index(Request $request)
    {
        return view('api');
    }
}
