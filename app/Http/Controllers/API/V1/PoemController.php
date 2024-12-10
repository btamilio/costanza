<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\Controller;
use Illuminate\Http\Request;

use App\Models\Poem;
use App\Jobs\GeneratePoem;

use App\Clients\HTTP\OpenAI;

use App\Http\Requests\API\V1\Poem\CreateRequest;
use App\Http\Resources\API\V1\PoemResource;

use Generator;


class PoemController extends Controller
{

    protected $wait_seconds = 10;

    public function index(Request $request) {

     $this->success(Poem::where([
                  "user_id" => request()->user()->id,
          ])->get());
    }

    public function show(Request $request) {

          $poem = Poem::where([
          //     "user_id" => request()->user()->id,
               "id"      => $request->id,
          ])->first();

          return (empty($poem))
                    ? $this->failure("Poem not found.", status: 404)
                    : $this->success(["poem"  => new PoemResource($poem)]);
 
    }

    public function create(CreateRequest $request) {
 
          $prompt = "POEM PROMPT: the pen is mightier. STANZAS: 2 FOOT: Iambic METER: pentameter";

          // moderation check...
          if ((new OpenAI())->getModerationStatus($prompt))  
               return $this->failure("Your prompt was flagged for content moderation. Please try again.", status: 451);

          $poem = Poem::create([
               "user_id" => request()->user()->id,
               "topic"  => $prompt,
          ]);

          GeneratePoem::dispatch($poem);

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
