<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\Controller;
use Illuminate\Http\Request;

use App\Models\Poem;
use App\Jobs\GeneratePoem;
use App\Actions\Poem\GeneratePrompt;
use App\Clients\HTTP\OpenAI;
use App\Models\FeatureType;
use App\Models\PoemFeature;
use App\Http\Requests\API\V1\Poem\CreateRequest;
use App\Http\Resources\API\V1\PoemResource;

use Illuminate\Support\Facades\DB;
use Generator;


class PoemController extends Controller
{

    protected $wait_seconds = 10;

    public function index(Request $request) {

     dd($request);
     $this->success(Poem::where([
                  "user_id" => request()->user()->id,
          ])->get());
    }

    public function show(Request $request) {


     dd($request);
          $poem = Poem::where([
          //     "user_id" => request()->user()->id, // TODO: eventually we could make poems private and only accessible to their owners
               "id"      => $request->id,
          ])->first();

          return (empty($poem))
                    ? $this->failure("Poem not found.", status: 404)
                    : $this->success(["poem"  => new PoemResource($poem)]);
 
    }

    public function create(CreateRequest $request) 
    {

          dd($request);
          $poem = Poem::create([
               "user_id" => request()->user()->id,
               "topic"  => $request->topic ?? NULL
          ]);
          $poem->save();

 
          // Create poem features from request data
          $types = FeatureType::all()->pluck("name")->toArray();

          foreach ($types as $type) {
               if ($request->input($type))
                    DB::table((new PoemFeature())->table)->insert(["poem_id" => $poem->id, "feature_id" => intval($request->input($type))]);
          }

          // OpenAI's API can be 2-20+ seconds of processing and round-trip, so to avoid blocking
          // and timing out, queue the job to be processed asynchronously and give back only the ID.
          dispatch(new GeneratePoem($poem));

 

          return $this->success([ "id" => $poem->id ] );          
 
    }

    public function update(Request $request)
    {
             $poem = Poem::where([
                  "user_id" => request()->user()->id,
                  "id"      => $request->id,
                  'title'   => $request->title
             ]);

             return $this->success();

    }

    public function destroy(Request $request)
    {
             $poem = Poem::where([
                  "user_id" => request()->user()->id,
                  "id"      => $request->id,
             ]);

             $poem->delete();

             return $this->success();
    }


}
