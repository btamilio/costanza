<?php

namespace App\Http\Controllers\Web;

 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Feature;
use App\Models\FeatureType;
use App\Models\Poem;


class HomeController extends Controller
{


    public function index(Request $request)
    {

        return view('home', [
            "feature_types"         =>  FeatureType::whereNot("hidden", 1)->orderBy("sort_order")->orderBy("label")->with("features")->get()->toArray(),
            "inspiration_adjective" => "amazing", // TODO: make this dynamic
            'prompt_prompt'         => "Do you want to build a poem?"  // TODO: make this dynamic
        ]);
    }


 
}
