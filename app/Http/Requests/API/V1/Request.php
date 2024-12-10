<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;



class Request extends FormRequest
{
    protected $stopOnFirstFailure = TRUE;


    public function rules()
    {
        return [];
    }


    protected function failedAuthorization()
    {
        return response()->json([
            'success' => FALSE,
            'errors' => ['Authorization Failed'],
        ], 401);

    }


    // force a JSON response on error
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => FALSE,
            'errors' => $validator->errors(),
        ], 417)); 
    }
}
