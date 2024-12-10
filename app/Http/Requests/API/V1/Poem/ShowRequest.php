<?php

namespace App\Http\Requests\API\V1\Poem;

use App\Models\FeatureType;
use App\Http\Requests\API\V1\Request;


class ShowRequest extends Request
{

    public function rules()
    {

        return array_merge(parent::rules(), [
               "id" =>  "required|numeric|in:poems,id",
        ]);
    }

 
}
