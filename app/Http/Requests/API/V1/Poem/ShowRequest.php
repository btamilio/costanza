<?php

namespace App\Http\Requests\API\V1\Poem;

use App\Models\FeatureType;
use App\Http\Requests\API\V1\Request;


class ShowRequest extends Request
{
    protected function prepareForValidation(): void
    {
        $routeId = $this->route('id');

        if ($routeId !== null) {
            $this->merge(['id' => $routeId]);
        }
    }

    public function rules()
    {

        return array_merge(parent::rules(), [
               "id" =>  "required|numeric|exists:poems,id",
        ]);
    }

 
}
