<?php

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AboutController extends Controller
{


    public function index(Request $request)
    {
        //TODO: about this application
        return view('about');
    }
}
