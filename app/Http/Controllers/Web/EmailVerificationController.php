<?php

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;

class EmailVerificationController extends Controller
{

    public function verify(Request $request)
    {

        try {
            $user = User::findOrFail((int) $request->id);
        } catch (Exception $e) {
            abort(404);
        }

        if (is_null($user->email_verified_at) && !empty($user->id ?? NULL) && hash_equals(sha1($user->email), $request->hash))
        {
            $user->email_verified_at = now();
            $user->save();
            
            return view('verify.success');
        }

        return view('verify.fail');
    }
}
