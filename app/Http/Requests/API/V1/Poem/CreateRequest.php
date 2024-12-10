<?php

namespace App\Http\Requests\API\V1\Poem;

use App\Models\FeatureType;
use App\Http\Requests\API\V1\Request;


class CreateRequest extends Request
{

    public function rules()
    {
 
        $rules = [];
 
        // Add validation rules for each feature type, including nullable and in the list of available features.
       foreach (FeatureType::all() as $type) {
            $rules[$type->name] = ["sometimes", "nullable", "in:".implode(",", collect($type->features->pluck("id"))->toArray())];
        };


        return array_merge(parent::rules(), $rules, [
               "topic" =>  "sometimes|nullable|string",
        ]);
    }

 

 
 
}
