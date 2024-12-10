<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Http\Requests\API\V1\Request;

class TokenCreateRequest extends Request
{ 

    public function rules()
    {
        return [
            "email" => "required|email"
        ];
    }

 
 
}
