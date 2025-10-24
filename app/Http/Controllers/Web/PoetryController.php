<?php

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

 
use App\Http\Requests\API\V1\Poem\CreateRequest;
use App\Http\Requests\API\V1\Poem\ShowRequest;

use App\Models\Poem;
use App\Jobs\GeneratePoem;
use App\Models\Feature;
use App\Models\FeatureType;
use App\Models\PoemFeature;

use Illuminate\Support\Facades\DB;

class PoetryController extends Controller
{


    public function index(Request $request)
    {

        return view('poetry');
    }

    public function show (ShowRequest $request)
    {

        return view("poem", ["poem" => (Poem::find($request->route('id'))) ]);

    }



    public function create(CreateRequest $request)
    {
 
 
        $types = FeatureType::all()->pluck("name")->toArray();
        $user_id = 1; // a dedicated "anonymous" user

        $poem = new Poem([
            "user_id"    =>  $user_id, 
            "topic"      =>  $request->topic ?? NULL
        ]);
         $poem->save();
 
        foreach ($types as $type) {
            if ($request->input($type)) 
                 DB::table((new PoemFeature())->table)->insert([ "poem_id" => $poem->id, "feature_id" => intval($request->input($type)) ]);
        }
 

        // Generate poem in the background using Laravel's queue system.
        GeneratePoem::dispatch($poem);

        return redirect()->route('poem.show', ['id' => $poem->id ]);
    }

}
