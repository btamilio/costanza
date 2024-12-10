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

use DB;

class PoetryController extends Controller
{


    public function index(Request $request)
    {
        return view('poetry');
    }

    public function show (Request $request, $id)
    {
 
        $poem = Poem::find($id) ?? []; 

        if (empty($poem))
            abort(404);

        return view("poem", [ "poem" => $poem ]);
    }



    public function create(CreateRequest $request)
    {
        $types = FeatureType::all()->pluck("name")->toArray();
        $user_id = 1; // dedicated "anonymous" user

        $poem = Poem::create([
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
