<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\API\V1\TokenCreateRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
 
use Illuminate\Support\Facades\Hash;
use App\Jobs\Email\SendVerification;      
 

class TokenController extends Controller
{

    // not currently used
    public function index(Request $request)
    {
         return response()->json([
            'success' => TRUE,
            'data'   => ["tokens" => $request()->user->tokens() ]
        ], 200);

    }


    public function create(TokenCreateRequest $request)
    {

        // create a user if one does not exist
        $user = User::where(['email' =>  $request->input("email") ])->firstOr(function() use ($request) {
            SendVerification::dispatch( User::create(['email' => $request->input("email") ]));
            return $this->success(notice: "Email address registered! Please look for a verification email...", status: 201);
        });

        if (empty($user->email_verified_at))
              return $this->failure("Hmm. Looks like that email address still needs to be verified? Please see the API docs if you need to resend.", 403);

        if ($user->tokens()->count() > 9)
              return $this->failure("Looks like you already have a token or nine. See the documentation if you need to purge some?");
 
        return response()->json([
            'success' => TRUE,
            'token'   => $user->createToken($user->email, ["costanza"])->plainTextToken
        ], 201);
    }

    //TODO: public function update(Request $request){};


    // not currently used
    public function destroy(Request $request)
    {
         return response()->json([
            'success' => TRUE,
            'data'   => ["tokens" => $request()->user->tokens() ]
        ], 200);

    }




}
